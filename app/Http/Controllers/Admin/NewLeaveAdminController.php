<?php

namespace App\Http\Controllers\Admin;

use App\Classes\Reply;
use App\Http\Controllers\AdminBaseController;

use App\Http\Requests\Admin\LeaveApplication\StoreRequest;
use App\Http\Requests\Admin\LeaveApplication\UpdateRequest;
use App\Models\LeaveApplication;
use App\Models\LeaveApplication2;
use App\Models\Leavetype;
use App\Models\Employee;
use App\Models\Employee2;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Yajra\DataTables\Facades\DataTables;

/**
 * Class LeavetypesController
 * @package App\Http\Controllers\Admin
 */
class NewLeaveAdminController extends AdminBaseController
{


    public function __construct()
    {
        parent::__construct();
        $this->absMenuActive = 'active';
	        $this->DataKetActive = 'active';
		    $this->pageTitle = "Tambah Keterangan";

    }


    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $this->leaveApplications = LeaveApplication::all();
        return View::make('admin.newleaveadmin.index', $this->data);
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function ajaxLeaveType()
    {
		

		
		
		
		
         $result = LeaveApplication::select('id', 'start_date', 'end_date', 'days', 'leaveType', 'reason', 'applied_on', 'application_status', 'halfDayType', 'no_surat');

          
        return DataTables::of($result)
            ->addColumn('edit', function ($row) {
                return '';
            })
            ->removeColumn('id')
            ->rawColumns(['edit'])
            ->escapeColumns(['edit'])
            ->make(true);
    }

    /**
     * @param CreateRequest $request
     * @return array
     */
    public function store(StoreRequest $request)
    {
		

        LeaveApplication::create($request->toArray());
		


        return Reply::success('Berhasil di Tambahkan');
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
		
		
	

        $this->leavetype = LeaveApplication2::find($id);
   
		
		$leavetypes = Leavetype::all();
       $this->employees = Employee2::select('id', 'full_name as nama', 'employeeID', 'statusmupeg')
      ->where('status', '=', 'active')
      ->get();
 $this->namaopd = DB::table('companies')
         ->groupBy('id')
         ->get();
        return View::make('admin.newleaveadmin.edit', compact('leavetypes'), $this->data);
    }

    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
		    $this->pageTitle = "Tambah Keterangan Lainnya";
		$leavetypes = Leavetype::all();


$this->employees =	DB::table('employees')
->select('id', 'full_name', 'employeeID', 'statusmupeg', 'company_id')
          ->where('status', '=', 'active')
            ->where('designation', '!=', NULL)
		->orderBy('employees.statusmupeg', 'asc')
	  ->orderBy('employees.order', 'desc')
->get();

 $this->namaopd = DB::table('companies')
         ->groupBy('id')
         ->get();

   return View::make('admin.newleaveadmin.create', compact('leavetypes'), $this->data);

    }




    /**
     * @param UpdateRequest $request
     * @param $id
     * @return array
     */
    public function update(UpdateRequest $request, $id)
    {
        $LeaveApplication = LeaveApplication2::findOrFail($id);
        $LeaveApplication->update($request->toArray());
        return Reply::success('LeaveApplication updated successfully');
    }

    /**
     * @param DeleteRequest $request
     * @param $id
     * @return array
     */
    public function destroy(DeleteRequest $request, $id)
    {
        LeaveApplication::destroy($id);

        return Reply::success('messages.leaveTypeDeleteMessage');


    }

}
