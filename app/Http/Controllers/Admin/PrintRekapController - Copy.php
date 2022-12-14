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

class PrintRekapController extends AdminBaseController
{
    public function __construct()
    {
        parent::__construct();
      parent::__construct();
        $this->attendanceOpen = 'active';
        $this->pageTitle = trans("Cetak Rekapitulasi");

   }

    /*
     * This is the view page of attendance.
     */
    public function index()
    {

        $this->viewPrintRekapActive = 'active';

        return View::make('admin.printrekap.payrolls-sheet', $this->data);
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
$payrolls = [];



foreach ($staffs as $staff) {
	
$s = Employee::leftJoin('payrolls', 'employees.id', '=', 'payrolls.employee_id',)
->where('payrolls.month', '=', $request->month)
->where('payrolls.year', '=', $request->year)
->where('employees.id', $staff->id)
->where('payrolls.company_id', $this->company_id)
          ->where('employees.status', '=', 'active')
	 ->where('employees.statusmupeg', '=', '')	  
->get();

array_push($payrolls, $s);
}
$this->holidays = Holiday::get(); 	
$this->namadinas = Company::where('id', '=', $this->company_id)->get();
$this->employeeAttendence = $payrolls;


        $view = View::make('admin.printrekap.load', $this->data)->render();

        return Reply::successWithDataNew($view);
    }

}

