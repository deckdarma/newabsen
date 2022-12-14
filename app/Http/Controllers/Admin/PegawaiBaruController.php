<?php

namespace App\Http\Controllers\Admin;

use App\Classes\Files;
use App\Classes\Reply;
use App\Http\Controllers\AdminBaseController;
use App\Models\Bank_detail;
use App\Models\Department;
use App\Models\Golonganpeg;
use App\Models\Designation;
use App\Models\EmailTemplate;
use App\Models\Employee;

use App\Models\Employee_document;
use App\Models\Salary;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests;
use App\Http\Requests\Admin\PegawaiBaru\StoreRequest;
use App\Http\Requests\Admin\PegawaiBaru\EditRequest;
use App\Http\Requests\Admin\PegawaiBaru\UpdateRequest;
use App\Http\Requests\Admin\PegawaiBaru\UploadRequest;


/**
 * Class EmployeesController
 * This Controller is for the all the related function applied on employees
 */
class PegawaiBaruController extends AdminBaseController
{

    public static $MAX_EMPLOYEES = 100;

    /**
     * Constructor for the Employees
     */

    public function __construct()
    {
        parent::__construct();

        $this->employeesOpen = 'active open';
        $this->peopleMenuActive = 'active';
        $this->pageTitle = trans('pages.employees.title');
    }


    public function index()
    {
     $this->pageTitle = trans('pages.employees.editTitle');

        $this->tasks = Employee::orderBy('order','ASC')->select('id','full_name','status','statusmupeg','designation','created_at')
			->where('designation', '=', NULL)
					->where('company_id', '=', $this->company_id)
			->where('mutasi', '=', 0)
			->orderBy('statusmupeg', 'asc')

		->get();
		
        return View::make('admin.pegawaibaru.index', $this->data);
    }
	


    public function updateOrder(Request $request)
    {
        $tasks = Employee::all();

        foreach ($tasks as $task) {
            $task->timestamps = false; // To disable update_at field updation
            $id = $task->id;

            foreach ($request->order as $order) {
                if ($order['id'] == $id) {
                    $task->update(['order' => $order['position']]);
                }
            }
        }
        
        return response('Update Successfully.', 200);
    }
	
	
	
	
	
	



 

    /**
     * @param EditRequest $request
     * @param $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(EditRequest $request, $id)
    {
        $this->pageTitle = trans('pages.employees.editTitle');

        $this->employeesActive = 'active';

        $this->department = Department::pluck('name', 'department.id as id');
        $this->departmentno = Department::all();
        $this->employee = Employee::find($id);

        $this->designation = Designation::find($this->employee->designation);
        $this->golonganpeg = Golonganpeg::get();


        $doc = [];

        foreach ($this->employee->documents as $documents) {
            $doc[$documents->type] = $documents->document_url;
        }

        $this->documents = $doc;

        return View::make('admin.pegawaibaru.edit', $this->data);
    }
    public function create()
    {
        $this->pageTitle = trans('pages.employees.createTitle');
        $this->employeesActive = 'active';
        $this->department = Department::select('department.id as id', 'name')
            ->company($this->company_id)
            ->manager(admin()->id)
            ->pluck('name', 'department.id');
     $this->golonganpeg = Golonganpeg::get();
        $this->data["pageTitle"] = trans("core.btnAddEmployee");

        // Check logged in user can create employee according to this currecnt plan
        $this->checkCanCreateEmployee();

        return View::make('admin.pegawaibaru.create', $this->data);
    }

 
    public function store(StoreRequest $request)
    {
        $input = $request->all();
        $data = $request->all();
        // Check logged in user can create employee according to this currecnt plan
        $this->checkCanCreateEmployee();

        if (!$this->canCreateEmployee) {
            \App::abort("500");

            return false;
        }

        \DB::beginTransaction();
        try {

            $employee = Employee::create($input);

            if ($request->hasFile('profile_image')) {
                $file = new Files();
                $filename = $file->upload($request->file('profile_image'), 'profile_images', null, 800, false);
                $employee->profile_image = $filename;
                $employee->save();
            }

            //  Insert into salary table
            $salary = ($input['basicSalary'] != '') ? $input['basicSalary'] : 0;

            Salary::create([
                    'employee_id' => $employee->id,
                    'type' => 'basic',
                    'remarks' => trans('core.basicSalary'),
                    'salary' => $salary
                ]
            );

            $salary = ($input['hourlyRate'] != '') ? $input['hourlyRate'] : 0;
            Salary::create([
                    'employee_id' => $employee->id,
                    'type' => 'hourly_rate',
                    'remarks' => 'Hourly Rate',
                    'salary' => $salary]
            );

            if ($request->account_name != '' && $request->account_number != '') {
                $data['employee_id'] = $employee->id;
                Bank_detail::create($data);
            }

            // -------------- UPLOAD THE DOCUMENTS  -----------------
            $documents = ['resume', 'offerLetter', 'joiningLetter', 'contract', 'IDProof'];


            foreach ($documents as $document) {

                if ($request->hasFile($document)) {
                    $file = new Files();
                    $filename = $file->upload($request->file($document), 'employee_documents/' . $document, null, null, false);
                    Employee_document::create([
                        'employee_id' => $employee->id,
                        'filename' => $filename,
                        'type' => $document
                    ]);
                }
            }


        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }

        DB::commit();

        return Reply::redirect(route('admin.pegawaibaru.index'), 'messages.employeeAddMessage');
    }
    /**
     * @param UpdateRequest $request
     * @param $id
     * @return array
     * @throws \Exception
     */
    public function update(UpdateRequest $request, $id)
    {
        // Check employee Company
        $employee = Employee::find($id);

        if ($request->updateType == 'bank') {
            $bankDetails = Bank_detail::firstOrNew(['employee_id' => $id]);
            $bankDetails->account_name = $request->account_name;
            $bankDetails->account_number = $request->account_number;
            $bankDetails->bank = $request->bank;
            $bankDetails->bin = $request->bin;
            $bankDetails->tax_payer_id = $request->tax_payer_id;
            $bankDetails->branch = $request->branch;
            $bankDetails->save();

            return Reply::success('Bank details updated successfully');

        }

        if ($request->updateType == 'company') {
            $companyDetails = $employee;

            $companyDetails->employeeID = $request->employeeID;
            $companyDetails->designation = $request->designation;
            $companyDetails->joining_date = $request->joining_date;
            $companyDetails->annual_leave = $request->annual_leave;
			$companyDetails->statusmupeg = $request->statusmupeg;
            $companyDetails->golongan = $request->golongan;
            $companyDetails->shift = $request->shift;
            $companyDetails->firstphl = $request->firstphl;
            $companyDetails->exit_date = (trim($request->exit_date) != '') ? date('Y-m-d', strtotime($request->exit_date)) : null;

            $companyDetails->status = ($request->status != 'active') ? 'inactive' : 'active';
            $companyDetails->save();

            if (isset($request->salary)) {
                foreach ($request->salary as $index => $value) {
                    $salaryDetails = Salary::find($index);
                    $salaryDetails->type = $request->type[$index];
                    $salaryDetails->salary = $value;
                    $salaryDetails->save();
                }
            }

            return Reply::success('Company Details updated successfully');

        }

        if ($request->updateType == 'personalInfo') {

            $data = $request->all();
            if ($data['password'] == '') {
                unset($data['password']);
            }
            $employee->update($data);

            // Profile Image Upload
            if ($request->profile_image) {
                $file = new Files();
                $filename = $file->upload($request->profile_image, 'profile_images');
                $employee->profile_image = $filename;
                $employee->save();
            }

            return Reply::success('messages.personalUpdateSuccess');


        }

        if ($request->updateType == 'documents') {
            // UPLOAD THE DOCUMENTS  -----------------
            $documents = ['resume', 'offerLetter', 'joiningLetter', 'contract', 'IDProof'];

            foreach ($documents as $document) {

                if ($request->hasFile($document)) {
                    $file = new Files();
                    $filename = $file->upload($request->file($document), 'employee_documents/' . $document, null, null, false);
                    $employeeDocument = Employee_document::firstOrNew(['employee_id' => $id, 'type' => $document]);
                    $employeeDocument->filename = $filename;
                    $employeeDocument->type = $document;
                    $employeeDocument->save();
                }
            }

            return Reply::success('messages.documentsUpdateSuccess');
            // END UPLOAD THE DOCUMENTS**********

        }


    }


 

    /**
     * Remove the specified employee from storage.
     */

    public function destroy(Requests\Admin\Employee\DeleteRequest $request,$id)
    {

        Employee::destroy($id);

        return Reply::success("messages.successDelete");
    }



 

  

 


 

    public function checkCanCreateEmployee()
    {
        $currentTotalEmployee = Employee::manager(admin()->id)->count();
        $planTotalEmployee = admin()->company->subscriptionPlan->end_user_count;

        if ($currentTotalEmployee < $planTotalEmployee) {
            $this->canCreateEmployee = true;
        } else {
            $this->canCreateEmployee = false;
        }
    }
}
