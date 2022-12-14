<?php

namespace App\Http\Controllers\Admin;

use App\Classes\Reply;
use App\Http\Controllers\AdminBaseController;
use App\Http\Requests\Admin\DataPemimpin\DeleteRequest;
use App\Http\Requests\Admin\DataPemimpin\StoreRequest;
use App\Http\Requests\Admin\DataPemimpin\UpdateRequest;
use App\Models\Datapemimpin;
use App\Models\Employee;
use App\Models\Designation;
use Illuminate\Support\Facades\View;
use Yajra\DataTables\Facades\DataTables;

/**
 * Class DatapemimpinsController
 * @package App\Http\Controllers\Admin
 */
class DatapemimpinsController extends AdminBaseController
{


    public function __construct()
    {
        parent::__construct();
        $this->pageTitle = 'Data Kepemimpinan';
        $this->attendanceOpen = 'active';
        $this->dataPemimpinActive = 'active';


    }

    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {

		   $this->pegawai = Datapemimpin::where('datapemimpins.company_id', '=', $this->company_id)
		   ->leftJoin('employees', 'datapemimpins.idpemimpin', '=', 'employees.id')
		   ->leftJoin('designation', 'employees.designation', '=', 'designation.id')
		   ->select('datapemimpins.id as idpem',
		   'employees.full_name as full_name',
		   'datapemimpins.namajabatan as namajabatan',
		   'datapemimpins.idpemimpin as idpemimpin',
		   'designation.designation as jabatan',
		   )
		  ->get();
		  
        $this->dataPemimpins = Datapemimpin::all();
        return View::make('admin.datapemimpins.index', $this->data);
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function ajaxDataPemimpin()
    {
       $result = Datapemimpin::select('id', 'idpemimpin', 'namajabatan')
		->where('company_id', '=', $this->company_id);

        return DataTables::of($result)
		  ->addColumn('idpemimpin', function ($row) {
                $employee = Employee::find($row->idpemimpin);
                           return $employee->decryptToCollection()->full_name;
            })  
		  ->addColumn('namajabatan', function ($row) {
			    $employee = Employee::find($row->idpemimpin);
                $designat = Designation::find($employee->designation);

                return $employee->designation;
            })  
            ->addColumn('edit', function ($row) {
                return '<a  class="btn purple btn-sm margin-bottom-10"  onclick="showEdit(' . $row->id . ')"><i class="fa fa-edit"></i> <span class="hidden-sm hidden-xs">' . trans("core.btnViewEdit") . '</span></a>
                          <a href="javascript:;" onclick="del(' . $row->id . ')" class="btn red btn-sm margin-bottom-10">
                        <i class="fa fa-trash"></i> <span class="hidden-sm hidden-xs">' . trans("core.btnDelete") . '</span></a> ';
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
        Datapemimpin::create($request->toArray());

        return Reply::success('Berhasil di Tambahkan');
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $this->datapemimpin = Datapemimpin::find($id);
		 
		 $this->datapem = Employee::where('status', '=', 'active')
		  ->where('status', '=', 'active')
		  ->where('employees.designation', '!=', NULL)
		  ->where('employees.statusmupeg', '=', 'ASN')
		  	  ->where('employees.shift', '=', '0')
		
		->orderBy('employees.order', 'desc')
		  ->where('employees.company_id', '=', $this->company_id)
		  ->get();
		  
		  
		  	$this->datapemnojab = Datapemimpin::where('idpemimpin', '=', '0')
			 ->where('company_id', '=', $this->company_id)
			 ->where('id', '=', $id)
		  ->count();
        return View::make('admin.datapemimpins.edit', $this->data);
    }
 
    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
		 
	      $datapem = Employee::where('status', '=', 'active')
		  ->where('status', '=', 'active')
		  ->where('employees.designation', '!=', NULL)
		  ->where('employees.statusmupeg', '=', 'ASN')
		  ->where('employees.shift', '=', '0')
		
		->orderBy('employees.order', 'desc')
		  ->where('employees.company_id', '=', $this->company_id)
		  ->get();
       return View::make('admin.datapemimpins.create', compact('datapem'), $this->data);
    }

    /**
     * @param UpdateRequest $request
     * @param $id
     * @return array
     */
    public function update(UpdateRequest $request, $id)
    {
        $datapemimpin = Datapemimpin::findOrFail($id);
        $datapemimpin->update($request->toArray());
        return Reply::success('Datapemimpin updated successfully');
    }

    /**
     * @param DeleteRequest $request
     * @param $id
     * @return array
     */
    public function destroy(DeleteRequest $request, $id)
    {
        Datapemimpin::destroy($id);

        return Reply::success('messages.dataPemimpinDeleteMessage');


    }

}
