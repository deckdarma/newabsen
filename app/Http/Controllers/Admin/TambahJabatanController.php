<?php

namespace App\Http\Controllers\Admin;

use App\Classes\Files;
use App\Classes\Reply;
use App\Http\Controllers\AdminBaseController;
use App\Models\Bank_detail;
use App\Models\Department;
use App\Models\Golonganpeg;
use App\Models\Payroll2;
use App\Models\LeaveApplication2;
use App\Models\Designation;

use App\Models\Employee2;
use App\Models\Company;

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

use App\Http\Requests\Admin\MutasiKeluar\StoreRequest;
use App\Http\Requests\Admin\MutasiKeluar\EditRequest;
use App\Http\Requests\Admin\MutasiKeluar\UpdateRequest;
use App\Http\Requests\Admin\MutasiKeluar\UploadRequest;


/**
 * Class Employee2sController
 * This Controller is for the all the related function applied on employees
 */
class TambahJabatanController extends AdminBaseController
{

    public static $MAX_EMPLOYEES = 100;

    /**
     * Constructor for the Employee2s
     */

    public function __construct()
    {
        parent::__construct();

        $this->employeesOpen = 'active open';
        $this->TambahJabatanActive = 'active';
        $this->pageTitle = "Tambah Jabatan";
    }


    public function index()
    {

		
        return View::make('admin.tambahjabatan.index', $this->data);
    }
	


  
	
	
	
	
	
	



 

    /**
     * @param EditRequest $request
     * @param $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(EditRequest $request, $id)
    {
        $this->pageTitle = "Form Tambah Jabatan";

        $this->TambahJabatanActive = 'active';

        $this->department = Department::pluck('name', 'department.id as id');
        $this->departmentno = Department::all();

        $this->employeed = DB::table('employees')
		->join('companies', 'employees.company_id', '=', 'companies.id')
		->select('employees.id','employees.full_name',
'employees.status',

'employees.employeeID',
'employees.date_of_birth',
'employees.gender',
'employees.mobile_number',
'employees.golongan',
'employees.permanent_address',

'companies.company_name',
'employees.statusmupeg','employees.designation')
->where('employees.id', '=', $id)
->where('employees.company_id', '=', $this->company_id)	
->get();
       
        $this->idget = $id;
       
        $this->golonganpeg = Golonganpeg::get();

			  $this->carinojab = Employee2::join('designation', 'employees.designation', '=', 'designation.id')
			->where('employees.company_id', '=', $this->company_id)	
			->where('employees.id', '=', $id)	
			->count();
     

        return View::make('admin.tambahjabatan.edit', $this->data);
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
        $employee = Employee2::find($id);
    

            $companyDetails = $employee;

 


		 
            $companyDetails->company_id = $request->company_id;
            $companyDetails->darimutasi = $request->darimutasi;
           $companyDetails->designation = $request->designation;
            $companyDetails->mutasi = $request->mutasi;
                   $companyDetails->save();

         Payroll2::where('employee_id', '=',   $id)
		->update(['payrolls.company_id' => $this->company_id]);     
	LeaveApplication2::where('employee_id', '=',   $id)
		->update(['company_id' => $this->company_id]);	
	
   

            return Reply::success('Berhasil Membatalkan Mutasi Keluar');

   


      


    }


}
