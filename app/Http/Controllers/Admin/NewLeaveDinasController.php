<?php

namespace App\Http\Controllers\Admin;

use App\Classes\Reply;
use App\Http\Controllers\AdminBaseController;

use App\Http\Requests\Admin\LeaveApplication\StoreRequest;
use App\Http\Requests\Admin\LeaveApplication\UpdateRequest;
use App\Models\LeaveApplication;
use App\Models\Leavetype;
use App\Models\Employee;
use Illuminate\Support\Facades\View;
use Yajra\DataTables\Facades\DataTables;

/**
 * Class LeavetypesController
 * @package App\Http\Controllers\Admin
 */
class NewLeaveDinasController extends AdminBaseController
{


    public function __construct()
    {
        parent::__construct();
        $this->leaveApplicationOpen = 'active open';
   	    $this->pageTitle = "Tambah Keterangan";
	        $this->varMenuActive = 'active';
    }


    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $this->leaveApplications = LeaveApplication::all();
        return View::make('admin.newleave_dl.index', $this->data);
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
		
		
	

        $this->leavetype = LeaveApplication::find($id);
      
			$leavetypes = Leavetype::all();

	$leavetypes_shift = Leavetype::get();
       $this->employees = Employee::select('id', 'full_name', 'employeeID', 'statusmupeg')
            ->where('status', '=', 'active')
			->orderBy('employees.order', 'desc')
			->orderBy('employees.statusmupeg', 'asc')
            ->get();

        return View::make('admin.newleave_dl.edit', compact('leavetypes'), $this->data);
    }

    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
				    $this->pageTitle = "Tambah Keterangan Perjalanan Dinas";
	$leavetypes = Leavetype::all();
       $this->employees = Employee::select('id', 'full_name', 'employeeID', 'statusmupeg')
            ->where('status', '=', 'active')
				->where('designation', '!=', NULL)
							  ->orderBy('employees.statusmupeg', 'asc')
	  ->orderBy('employees.order', 'desc')
            ->get();

        return View::make('admin.newleave_dl.create', compact('leavetypes'), $this->data);

    }

    /**
     * @param UpdateRequest $request
     * @param $id
     * @return array
     */
    public function update(UpdateRequest $request, $id)
    {
        $LeaveApplication = LeaveApplication::findOrFail($id);
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
