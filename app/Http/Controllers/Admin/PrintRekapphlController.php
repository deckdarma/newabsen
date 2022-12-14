<?php

namespace App\Http\Controllers\Admin;

use App\Classes\Reply;
use App\Http\Controllers\AdminBaseController;
use App\Models\Attendance;
use App\Models\Company;
use App\Models\EmailTemplate;
use App\Models\Employee;
use App\Models\Holiday;
use App\Models\Payroll;
use App\Models\Datapemimpin;
use App\Models\Patokanabsen;
use App\Models\Leavetype;
use Carbon\Carbon;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;

use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\Attendance\UpdateRequest;
use App\Http\Requests;

/*
 * Attendance Controller of Admin Panel
 */

class PrintRekapphlController extends AdminBaseController
{
    public function __construct()
    {
        parent::__construct();
      parent::__construct();
        $this->hrMenuActive = 'active';
        $this->pageTitle = trans("Cetak Rekapitulasi");

   }

    /*
     * This is the view page of attendance.
     */
    public function index()
    {

        $this->viewPrintRekapphlActive = 'active';

        return View::make('admin.printrekapphl.payrolls-sheet', $this->data);
    }







    public function filterPayroll(Request $request)
    {
  

   $this->daysInMonth = cal_days_in_month(CAL_GREGORIAN, $request->month, $request->year);
   $this->databulan = $request->month;
   $month = $request->month;
   $this->datatahun = $request->year;
   $this->idinas = $this->company_id;
   $this->noidapegs = $request->employee_id;
   
$staffs = Employee::where('company_id', '=', $this->company_id)->get();
$month = $request->month;
$year = $request->year;
  $companyid = $this->company_id;

$this->employeeAttendence = Employee::where('employees.company_id', '=', $companyid)
            ->leftJoin("payrolls", function ($query) use ($year, $month) {
             $query->on("payrolls.employee_id", "=", "employees.id");
             $query->on("payrolls.month", "=", \DB::raw('"' . $month . '"'));
             $query->on("payrolls.year", "=", \DB::raw('"' . $year . '"'));
            })

	
		->select( 'employees.id as idpegawai', 
  'employees.shift as datashift',
	  'employees.full_name as full_name',
	  'employees.employeeID as employeeID',
	  'payrolls.jumlah_prestasi_kehadiran as jumlah_prestasi_kehadiran',
	  'payrolls.jumlah_prestasi_kinerja as jumlah_prestasi_kinerja',
	  'payrolls.total_prestasi_kinerja as total_prestasi_kinerja',
	  'payrolls.pemotongan_cuti_kinerja as pemotongan_cuti_kinerja',
	  'payrolls.pemotongan_hukuman_kinerja as pemotongan_hukuman_kinerja',
	  'payrolls.total_pemotongan_kinerja as total_pemotongan_kinerja',
	  'payrolls.total_bobot_kinerja as total_bobot_kinerja',
	  'payrolls.nilai_tpp_kinerja as nilai_tpp_kinerja',
	  'payrolls.tambahan_tpp_rp as tambahan_tpp_rp',
	  'payrolls.jumlah_kotor_kinerja as jumlah_kotor_kinerja',
	  'payrolls.nilai_pajak_kinerja as nilai_pajak_kinerja',
	  'payrolls.jumlah_iwp as jumlah_iwp',
	  'payrolls.jumlah_bersih_keseluruhan as jumlah_bersih_keseluruhan',
	  'payrolls.id as idpay'

	 
	  )
      ->where("employees.status", "active")
      ->where("employees.statusmupeg", 'PHL')
	  ->orderBy('employees.statusmupeg', 'asc')
	  ->where('employees.designation', '!=', NULL)

	  ->orderBy('employees.order', 'desc')
      ->get();


$this->holidays = Holiday::get(); 	
$this->namadinas = Company::where('id', '=', $this->company_id)->get();

$this->kepaladinas = Datapemimpin::where('datapemimpins.company_id', '=', $this->company_id)
		   ->leftJoin('employees', 'datapemimpins.idpemimpin', '=', 'employees.id')
		   ->leftJoin('designation', 'employees.designation', '=', 'designation.id')
		   ->select('datapemimpins.id as idpem',
		   'employees.full_name as full_name',
		   'employees.employeeID as employeeID',
		   'datapemimpins.namajabatan as namajabatan',
		   'designation.designation as jabatan',
		   )
		   	  ->where('datapemimpins.namajabatan', '=', 'Kepala OPD')
		  ->get()
		  ->first();
		  
$this->bendahara = Datapemimpin::where('datapemimpins.company_id', '=', $this->company_id)
		   ->leftJoin('employees', 'datapemimpins.idpemimpin', '=', 'employees.id')
		   ->leftJoin('designation', 'employees.designation', '=', 'designation.id')
		   ->select('datapemimpins.id as idpem',
		   'employees.full_name as full_name',
		   'employees.employeeID as employeeID',
		   'datapemimpins.namajabatan as namajabatan',
		   'designation.designation as jabatan',
		   )
		   	  ->where('datapemimpins.namajabatan', '=', 'Bendahara')
		  ->get()
		  ->first();		  
		  

        $view = View::make('admin.printrekapphl.load', $this->data)->render();

        return Reply::successWithDataNew($view);
    }

}

