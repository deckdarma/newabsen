<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminBaseController;
use App\Models\Attendance;
use App\Models\Attendance2;
use App\Models\EmailTemplate;
use App\Models\Employee;
use App\Models\Company;

use App\Models\Employee2;
use App\Models\Leavetype;
use App\Models\LeaveApplication;
use App\Models\LeaveApplication2;


use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

use Yajra\DataTables\Facades\DataTables;

class LeaveApplicationsAdminController extends AdminBaseController
{

    public function __construct()
    {
        parent::__construct();
        $this->leaveApplicationOpen = 'active open';
		        $this->varMenuActive = 'active';
        $this->pageTitle = "Data Keterangan";
    }


    public function index()
    {
		          $this->absMenuActive = 'active';
	        $this->DataKetActive = 'active';

        return View::make('admin.leave_applicationsadmin.index', $this->data);
    }









   //  Datatable ajax request
    public function ajaxApplications()
    {
              $result = LeaveApplication2::join('employees', 'leave_applications.employee_id', '=', 'employees.id')
            ->join('leavetypes', 'leave_applications.leaveType', '=', 'leavetypes.singkat')
            ->join('companies', 'leave_applications.company_id', '=', 'companies.id')
            ->select('leavetypes.singkat as singkatan','companies.id as idcom','companies.company_name','leavetypes.leaveType as namaketerangan', 'leavetypes.waktumundur as waktumundur', 'leave_applications.id as id', 'leave_applications.application_status as status','leave_applications.no_surat as no_surat', 'employees.full_name',  'leave_applications.start_date', 'leave_applications.end_date', 'leave_applications.days', 'leave_applications.leaveType', 'leave_applications.reason', 'leave_applications.applied_on', 'leave_applications.application_status', 'leave_applications.halfDayType', 'leave_applications.created_at','employee_id')
            ->whereNotNull('leave_applications.application_status')
            ->where('leave_applications.createby',  1)
            ->get();
			  
			  
		
        return DataTables::of($result)
        ->addColumn('edit', function ($row) {
            if ($row->application_status == 'pending') {
				
				 
			             $string = '
                         <div class="btn-group">
					
						<a  class="btn purple btn-sm margin-bottom-5"  onclick="showEdit(' . $row->id . ',\'' . addslashes($row->leaveType) . '\',\'' . $row->num_of_leave . '\')"><i class="fa fa-edit"></i> <span class="hidden-sm hidden-xs">Edit</span></a>
          
          
                         <button class="btn purple btn-sm margin-bottom-5" style="background-color: #bd6e19;border-color: #bd6e19;" data-toggle="modal" href="#static" onclick="show_application(' . $row->id . ');return false;" ><i class="fa fa-eye"></i> Lihat</button>
                         <a  href="javascript:;" onclick="del(' . $row->id . ');return false;" class="btn red btn-sm margin-bottom-5">
                         <i class="fa fa-trash"></i> ' . trans('core.btnDelete') . '</a></div>';			 
				 
            } else {
                $string = '<div class="btn-group">
				
                        <button class="btn green btn-sm margin-bottom-5" style="background-color: #bd6e19;border-color: #bd6e19;" data-toggle="modal" href="#static" onclick="show_application(' . $row->id . ');return false;" ><i class="fa fa-eye"></i> Lihat</button>
                        <a  href="javascript:;" onclick="del(' . $row->id . ');return false;" class="btn red btn-sm margin-bottom-5">
                        <i class="fa fa-trash"></i> ' . trans('core.btnDelete') . '</a></div>';
            }

            return $string;
        })
			->editColumn('full_name', function ($row) {
            $employee = Employee2::find($row->employee_id);
            return $employee->decryptToCollection()->full_name;
        })
		->editColumn('company_id', function ($row) {
			
	  $employee = Employee2::find($row->employee_id);		
if ($row->idcom == $employee->company_id) {
            return $row->company_name;
	   } else {	
 return "<span class='label label-danger'>Nama OPD Salah</span>";
		}	   
			
        })
		->editColumn('application_status', function ($row) {
            $color = ['pending' => 'warning', 'approved' => 'success', 'rejected' => 'danger'];

            return "<span class='label label-{$color[$row->application_status]}'>" . trans('core.' . $row->application_status) . "</span>";
        })
		
				->editColumn('start_date', function ($row) {
            $start = Carbon::createFromFormat("Y-m-d", $row->start_date);

            if ($row->end_date == null) {
                $end = clone $start;
            } else {
                $end = Carbon::createFromFormat("Y-m-d", $row->end_date);
            }

            $dates = $start->format("d-M-Y") . ' ' . (isset($row->end_date) ? ' s/d ' . $end->format("d-M-Y") : '');

            return $dates;

        })
            ->removeColumn('id')
            ->rawColumns(['edit','application_status','company_id','start_date'])
            ->escapeColumns(['edit'])
            ->make(true);
   
        
    }












    public function show($id)
    {
		$leavetypes = Leavetype::all();
        $this->leave_application = LeaveApplication2::find($id);
       $this->employees = Employee2::select('id', 'full_name as nama', 'employeeID', 'statusmupeg')
      ->where('status', '=', 'active')
      ->get();
        return View::make('admin.leave_applicationsadmin.show', compact('leavetypes'), $this->data);
    }


    public function update(Request $request, $id)
    {
        $check = LeaveApplication2::find($id);

        if ($check == null) {
            return \View::make('admin.errors.noaccess', $this->data);
        }

        $inputs = \request()->all();
        $this->data["data"] = $inputs;

        $leave_application = LeaveApplication2::findOrFail($id);

        $inputs['application_status'] = ($inputs['application_status'] == 'Approve') ? 'approved' : 'rejected';
        $leave_application->update($inputs);

        $start = Carbon::createFromFormat("Y-m-d", $leave_application->start_date);

        if ($leave_application->end_date == null) {
            $end = clone $start;
        } else {
            $end = Carbon::createFromFormat("Y-m-d", $leave_application->end_date);
        }


        $diffDays = $end->diffInDays($start);
        $startDate = $start;
        if ($leave_application->application_status == 'approved') {
            for ($i = 0; $i <= $diffDays; $i++) {
                $date = $startDate;
                $attendance = Attendance::firstOrCreate(['date' => $date->format("Y-m-d"),
                    'employee_id' => $leave_application->employee_id]);

                $attendance->leaveType = $leave_application->leaveType;
                $attendance->idleaveapli = $leave_application->id;
                $attendance->halfDayType = $leave_application->halfDayType;
                $attendance->reason = $leave_application->reason;
                $attendance->status = 'absent';
                $attendance->applied_on = $leave_application->applied_on;
                $attendance->last_updated_by = admin()->id;
                $attendance->application_status = 'approved';
                $attendance->save();
                $startDate->addDays(1);
            }
        }




        Session::flash('success', trans("messages.leaveApplicationUpdateMessage"));

        return Redirect::route('admin.leave_applicationsadmin.index');
    }


    public function destroy($id)
    {

        $leave_application = LeaveApplication2::findOrFail($id);




        $start = Carbon::createFromFormat("Y-m-d", $leave_application->start_date);
	 $end = Carbon::createFromFormat("Y-m-d", $leave_application->end_date);


   

        $diffDays = $end->diffInDays($start);

 
			
		Attendance::where('idleaveapli', '=', $leave_application->id)
                ->where('employee_id', $leave_application->employee_id)
				->where('clock_in', NULL)  
                ->delete();

    
				
			      
        Attendance::where('employee_id', '=',   $leave_application->employee_id)
		  ->where('idleaveapli', '=', $leave_application->id)
		->update(['status' => 'present', 'application_status' => NULL, 'halfDayType' => NULL,'idleaveapli' => NULL, 'reason' => NULL, 'leaveType' => NULL]);		     




        LeaveApplication2::where('id', $id)  
		->where('createby', 1)  
		->delete();
		
        $output['success'] = 'deleted';

        return Response::json($output, 200);
		
	
    }

}
