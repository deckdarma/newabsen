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
use App\Models\Employee;
use App\Models\Company;
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
use App\Http\Requests\Admin\DataMutasi\StoreRequest;
use App\Http\Requests\Admin\DataMutasi\EditRequest;
use App\Http\Requests\Admin\DataMutasi\UpdateRequest;
use App\Http\Requests\Admin\DataMutasi\UploadRequest;


/**
 * Class EmployeesController
 * This Controller is for the all the related function applied on employees
 */
class DataMutasiController extends AdminBaseController
{

    public static $MAX_EMPLOYEES = 100;

    /**
     * Constructor for the Employees
     */

    public function __construct()
    {
        parent::__construct();

        $this->employeesOpen = 'active open';
        $this->MutasiActive = 'active';
        $this->pageTitle = trans('pages.employees.title');
    }


    public function index()
    {
     $this->pageTitle = "Data Mutasi Pegawai";
        $this->MutasiActive = 'active';
        $this->tasks = Employee::orderBy('order','ASC')->select('id','full_name','status','statusmupeg','designation','created_at')
			->where('designation', '!=', NULL)
			->orderBy('statusmupeg', 'asc')

		->get();
		
        return View::make('admin.datamutasi.index', $this->data);
    }
	
    public function terima()
    {
     $this->pageTitle = "Mutasi Masuk";

        $this->tasks = Employee::orderBy('order','ASC')
		->join('companies', 'employees.darimutasi', '=', 'companies.id')
		->select('employees.id','employees.darimutasi','employees.full_name','employees.status','companies.company_name','employees.statusmupeg','employees.designation')
			->where('designation', '=', NULL)
			->where('mutasi', '=', 1)
			->where('company_id', '=', $this->company_id)
			->orderBy('statusmupeg', 'asc')

		->get();
		
        return View::make('admin.datamutasi.terima', $this->data);
    }


	
	
	
	
	



 

    /**
     * @param EditRequest $request
     * @param $id
     * @return \Illuminate\Contracts\View\View
     */
     public function edit(EditRequest $request, $id)
    {
        $this->pageTitle = "Mutasi Pegawai";

        $this->MutasiActive = 'active';

        $this->department = Department::pluck('name', 'department.id as id');
        $this->departmentno = Department::all();
        $this->employee = Employee::find($id);

        $this->designation = Designation::find($this->employee->designation);
        $this->golonganpeg = Golonganpeg::get();
        $this->namaopd = Company::get();


        $doc = [];

        foreach ($this->employee->documents as $documents) {
            $doc[$documents->type] = $documents->document_url;
        }

        $this->documents = $doc;

        return View::make('admin.datamutasi.edit', $this->data);
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

        return View::make('admin.datamutasi.create', $this->data);
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

 

        if ($request->updateType == 'company') {
                  $companyDetails = $employee;

     
            $companyDetails->designation = $request->designation;
    
            $companyDetails->mutasi = $request->mutasi;
            $companyDetails->status = $request->mutasi;
	
            $companyDetails->company_id = $request->company_id;
            $companyDetails->darimutasi = $request->darimutasi;
			$companyDetails->save();

            if (isset($request->salary)) {
                foreach ($request->salary as $index => $value) {
                    $salaryDetails = Salary::find($index);
                    $salaryDetails->type = $request->type[$index];
                    $salaryDetails->salary = $value;
                    $salaryDetails->save();
                }
            }

        Payroll::where('employee_id', '=',   $id)
		->update(['company_id' => $request->company_id]);     

		LeaveApplication::where('employee_id', '=',   $id)
		->update(['company_id' => $request->company_id]);		     


            return Reply::success('Company Details updated successfully');

        }

   

    


    }



    /**
     * Remove the specified employee from storage.
     */





}
