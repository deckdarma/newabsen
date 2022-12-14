<?php

namespace App\Http\Controllers\Admin;

use App\Classes\Files;
use App\Classes\Reply;
use App\Http\Controllers\AdminBaseController;
use App\Models\Bank_detail;
use App\Models\Department;
use App\Models\Golonganpeg;
use App\Models\LeaveApplication;
use App\Models\Designation;
use App\Models\EmailTemplate;
use App\Models\Datashift;
use App\Models\Employee;
use App\Models\Datapemimpin;
use App\Models\Attendance;
use App\Models\Payroll;
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
use App\Http\Requests\Admin\Employee\StoreRequest;
use App\Http\Requests\Admin\Employee\EditRequest;
use App\Http\Requests\Admin\Employee\UpdateRequest;
use App\Http\Requests\Admin\Employee\UploadRequest;


/**
 * Class EmployeesController
 * This Controller is for the all the related function applied on employees
 */
class EmployeesController extends AdminBaseController
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
		
		$this->pegawai = Employee::where('employees.company_id', '=', $this->company_id)
		

		   ->select(
		   'employees.full_name as full_name',
		   'employees.id as iddata',
		
		   'employees.designation as designation',
		   )
		   		->where('employees.designation', '!=', NULL)
		   	->orderBy('employees.statusmupeg', 'asc')
				->orderBy('employees.order', 'asc')
		  ->get();
		  
			  $this->carinojab = Employee::join('designation', 'employees.designation', '=', 'designation.id')
			->where('employees.company_id', '=', $this->company_id)	
			->where('employees.designation', '!=', NULL)
			->count();
	

			$this->totalaktif = Employee::select('id','full_name','status','statusmupeg','designation','created_at')
			->where('designation', '!=', NULL)
			->where('company_id', '=', $this->company_id)	
			->count();
			
        $this->employeesActive = 'active';

  $this->totalpegawi = Employee::orderBy('order','ASC')->select('id','full_name','status','statusmupeg','designation','created_at')
			->where('designation', '=', NULL)
			->where('company_id', '=', $this->company_id)	
			->orderBy('statusmupeg', 'asc')
			
			->count();


        $this->total = Employee::manager(admin()->id)
            ->count();

        // Check logged in user can create employee according to this currecnt plan
        $this->checkCanCreateEmployee();

        return View::make('admin.employees.index', $this->data);
    }






	
	
	
    # Datatable ajax request
    public function ajax_employees()
    {
        $result = Employee::manager(admin()->id)
            ->select('employees.id','employees.shift', 'employees.employeeID as employeeID', 'employees.profile_image', 'employees.full_name','employees.statusmupeg', 'department.name', 'designation.designation', DB::raw('1 as work'), 'employees.status', 'employees.created_at')
            ->orderBy('statusmupeg', 'asc')
            ->orderBy('order', 'desc')
         
			->get();

        return DataTables::of($result)
            ->addColumn('edit', function ($row) {

                $string = '<a class="btn purple btn-sm margin-bottom-5" href="javascript:;" onclick="loadView(\'' .
                    route("admin.employees.edit", $row->id) .
                    '\');"><i class="fa fa-edit"></i><span class="hidden-sm hidden-xs"> ' .
                    trans("core.btnViewEdit") . '</span></a>
					
					
					<a class="btn blue btn-sm margin-bottom-5" href="javascript:;" onclick="loadView(\'' .
                    route("admin.datamutasi.edit", $row->id) .
                    '\');"><i class="fa fa-exchange"></i><span class="hidden-sm hidden-xs"> Mutasi</span></a>
							';

                return $string;
            })
            ->editColumn('status', function ($row) {
                $color = ['active' => 'success', 'inactive' => 'danger'];

                return "<span id='status{$row->id}' class='label label-{$color[$row->status]}'>" .
                    trans("core." . $row->status) . "</span>";
            })
            ->editColumn('profile_image', function ($row) {
                $employee = Employee::where('employeeID', '=', $row->employeeID)
                    ->first();
                return \HTML::image($employee->profile_image_url, 'ProfileImage', ['height' => '80px', 'width' => '80px']);
            })
//
            ->editColumn('statusmupeg', function ($row) {
           
		   if ($row->statusmupeg != "PHL") {
			 if ($row->shift != 1) {  
		      return "<span id='status2' class='label label-success' style='background-color: #e38213;'>ASN</span>"; 
			 }else{
			   return "<span id='status2' class='label label-success' style='background-color: #e38213;'>ASN / SHIFT</span>"; 
			
			} 
			 
			 }else{
			 if ($row->shift != 1) {  
  return "<span id='status2' class='label label-success' style='background-color: #5a5a5a;'>PHL</span>"; 
			  
			 }else{
  return "<span id='status2' class='label label-success' style='background-color: #5a5a5a;'>PHL / SHIFT</span>"; 
			   
			
			} 
			  }
			   
			   
return $row->statusmupeg;
   
            })->editColumn('full_name', function ($row) {
                if ($row->statusmupeg != "PHL") {
		      return "".$row->decryptToCollection()->full_name."<br>".$row->employeeID.""; 
			   }else{
		      return "".$row->decryptToCollection()->full_name.""; 
			   }

	
            })->editColumn('uid', function ($row) {
       
		      return "<div style='font-size: 13px;font-weight: bold;text-align: center;background: #0d1e6b;color: #fff;padding: 2px 5px;border-radius: 3px !important;;'>".$row->id."</div>"; 
			

	
            })
			
			
			
			
            ->removeColumn("id")
            ->rawColumns(['uid','edit', 'status', 'full_name', 'profile_image', 'statusmupeg'])
            ->make();
    }

    /**
     * Show the form for creating a new employee
     */
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

        return View::make('admin.employees.create', $this->data);
    }

    /**
     * @param StoreRequest $request
     * @return array|bool
     * @throws \Exception
     */
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

        return Reply::redirect(route('admin.employees.index'), 'messages.employeeAddMessage');
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
        $this->employee = Employee::find($id);

        $this->designation = Designation::find($this->employee->designation);
        $this->golonganpeg = Golonganpeg::get();


        $doc = [];

        foreach ($this->employee->documents as $documents) {
            $doc[$documents->type] = $documents->document_url;
        }

        $this->documents = $doc;

        return View::make('admin.employees.edit', $this->data);
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




    public function destroy(Requests\Admin\Employee\DeleteRequest $request,$id)
    {
	$companyid = $this->data["company_id"];
        Employee::destroy($id);
		LeaveApplication::where('employee_id', '=', $id)

                ->delete();
		
		Payroll::where('employee_id', '=', $id)->delete();
		Attendance::where('employee_id', '=', $id)->delete();
		Salary::where('employee_id', '=', $id)->delete();
		Datashift::where('employee_id', '=', $id)->delete();
		Datapemimpin::where('idpemimpin', '=', $id)->delete();
		
        return Reply::success("Berhasil di Hapus");
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
