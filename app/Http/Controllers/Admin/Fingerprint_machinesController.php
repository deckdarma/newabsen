<?php

namespace App\Http\Controllers\Admin;

use App\Classes\Reply;
use App\Http\Controllers\AdminBaseController;
use App\Http\Requests\Admin\Fingerprint_machine\EditRequest;
use App\Http\Requests\Admin\Fingerprint_machine\StoreRequest;
use App\Http\Requests\Admin\Fingerprint_machine\UpdateRequest;
use App\Models\Fingerprint_machine;
use App\Models\Company;
use Illuminate\Support\Facades\View;
use Yajra\DataTables\Facades\DataTables;

/**
 * Class Fingerprint_machinesController
 * @package App\Http\Controllers\Admin
 */
class Fingerprint_machinesController extends AdminBaseController
{

    public function __construct()
    {
        parent::__construct();
        $this->pageTitle = 'Tambahkan IP Mesin';
        $this->fingerprint_MachineOpen = 'active open';
        $this->fingerprint_MachineActive = 'active';
    }

    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $this->fingerprint_machines = Fingerprint_machine::orderBy('created_at', 'DESC')->get();
        return View::make('admin.fingerprint_machines.index', $this->data);
    }

    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
			    $this->namadinas = Company::all();
		       return View::make('admin.fingerprint_machines.create', $this->data);
    
    }

    /**
     * @param CreateRequest $request
     * @return array
     */
    public function store(StoreRequest $request)
    {

        Fingerprint_machine::create($request->toArray());

        return Reply::redirect(route('admin.fingerprint_machines.index'));

    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function ajax_finger()
    {
        $result = Fingerprint_machine::select('id', 'ip', 'comkey', 'dinas', 'status', 'company_id', 'shift', 'idshift')
            ->orderBy('created_at', 'desc');

        return DataTables::of($result)
            ->editColumn('shift', function ($row) {
      
				
					if($row->shift == 0) {
				return  "<span class='label label-success' style='background-color:#292a2a;'>OPD Normal</span>";
				} else {
				return  "<span class='label label-success' style='background-color:#0b9595;'>OPD Shift</span>";
				}
            }) 
			->editColumn('idshift', function ($row) {
      
				
			if($row->idshift == 0) {
				return  "<span class='label label-success' style='background-color:#292a2a;'>Tidak Ada</span>";

				}
				
					if($row->idshift == 1338) {
				return  "<span class='label label-success' style='background-color:#188ae2;'>Shift Pagi</span>";

				}
						if($row->idshift == 1427) {
				return  "<span class='label label-success' style='background-color:#ff5b5b;'>Shift Sore</span>";

				}
				
							if($row->idshift == 1428) {
				return  "<span class='label label-success' style='background-color:#10c469;'>Shift Malam</span>";

				}
				
            })
            ->editColumn('status', function ($row) {
				

                $color = [
                    '1' => 'success',
                    '0' => 'danger'
                ];
				if($row->status == 1) {
				$rowadata = "IP Aktif";
				} else {
				$rowadata = "Tidak Aktif";
				}

				$IP = $row->ip;
				$connect =  @fsockopen($IP, '80', $errno, $errstr, 1);
				      if ($connect) {

			$rowmesin = "<span class='label label-success'>Mesin terkoneksi</span>";
      } else {
		  	$rowmesin = "<span class='label label-danger'>Mesin tidak terkoneksi</span>";

		}
				

	  
                return '<span class="label label-' . $color[$row->status] . '">' . $rowadata . '</span>  /  ' . $rowmesin . '';
            })->addColumn('edit', function ($row) {
                return '
				<a  class="btn purple btn-sm margin-bottom-10"  onclick="loadView(\'' . route("admin.fingerprint_machines.edit", $row->id) . '\');"><i class="fa fa-edit"></i> <span class="hidden-sm hidden-xs">' . trans("core.btnViewEdit") . '</span></a>

                          <a href="javascript:;" onclick="del(\'' . $row->id . '\');return false;" class="btn red btn-sm margin-bottom-10">
                        <i class="fa fa-trash"></i> <span class="hidden-sm hidden-xs">' . trans("core.btnDelete") . '</span></a>
						';
            })
			
			
			->addColumn('company_id', function ($row) {
				
					 $namadinas = Company::find($row->company_id);
           return $namadinas->company_name;
            })
            ->escapeColumns(['edit', 'status', 'shift', 'idshift'])
            ->rawColumns(['status', 'edit', 'shift', 'idshift'])
            ->make(true);
    }

    /**
     * @param EditRequest $request
     * @param $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(EditRequest $request,$id)
    {
        $this->notice = Fingerprint_machine::find($id);
    $this->namadinas = Company::all();
        return View::make('admin.fingerprint_machines.edit', $this->data);
		
    }
  public function show($id)
    {
      $mesin = Fingerprint_machine::find($id);
      $IP = $mesin->ip;
      // $port = $mesin->port;
        $this->notice = Fingerprint_machine::find($id);
    $this->connect =  @fsockopen($IP, '80', $errno, $errstr, 1);
      // $connect = @fsockopen($IP, $port, $errno, $errstr, 1);
       return View::make('admin.fingerprint_machines.show', $this->data);
	  

    }

    public function update(UpdateRequest $request, $id)
    {
        $fingerprint_Machine = Fingerprint_machine::findOrFail($id);
        $fingerprint_Machine->update($request->toArray());


		        return Reply::redirect(route('admin.fingerprint_machines.index'));
    }

    /**
     * @param $id
     * @return array
     */
    public function destroy($id)
    {
        Fingerprint_machine::destroy($id);
        return Reply::success('Deleted successfully');
    }

}
