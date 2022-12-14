<?php

namespace App\Http\Controllers\Admin;

use App\Classes\Reply;
use App\Http\Controllers\AdminBaseController;
use App\Http\Requests\Admin\NormalshiftAbsensi\DeleteRequest;
use App\Http\Requests\Admin\NormalshiftAbsensi\StoreRequest;
use App\Http\Requests\Admin\NormalshiftAbsensi\UpdateRequest;
use App\Models\Normalshiftabsensi;
use App\Models\Dataskor;
use Illuminate\Support\Facades\View;
use Yajra\DataTables\Facades\DataTables;

/**
 * Class NormalshiftabsensisController
 * @package App\Http\Controllers\Admin
 */
class NormalshiftabsensisController extends AdminBaseController
{


    public function __construct()
    {
        parent::__construct();
        $this->pageTitle = 'Normal Absensi';
        $this->attendanceOpen = 'active';
        $this->NormalshiftabsensiActive = 'active open';
        $this->pageTitle = 'Normal Absensi';

    }

    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $this->Normalshiftabsensis = Normalshiftabsensi::all();
        return View::make('admin.normalshiftabsensis.index', $this->data);
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function ajaxNormalshiftAbsensi()
    {
        $result = Normalshiftabsensi::select('id','nama_event', 'date', 'jam_masuk', 'jam_pulang');

        return DataTables::of($result)
            ->addColumn('edit', function ($row) {
                return '<a  class="btn purple btn-sm margin-bottom-10"  onclick="showEdit(' . $row->id . ')"><i class="fa fa-edit"></i> <span class="hidden-sm hidden-xs">Lihat dan Edit</span></a>
                    ';
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
        Normalshiftabsensi::create($request->toArray());

        return Reply::success('Berhasil di Tambahkan');
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
				$dataskorsa = Dataskor::where('unikid', '1')->get();
		$tampilan = Dataskor::where('unikid', '2')->orwhere('unikid', '3')->orwhere('unikid', '4')->orwhere('unikid', '5')
		->get();
	
        $this->normalshiftabsensi = Normalshiftabsensi::find($id);
        return View::make('admin.normalshiftabsensis.edit',compact('dataskorsa','tampilan'),  $this->data);
    }

    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        return View::make('admin.normalshiftabsensis.create');
    }

    /**
     * @param UpdateRequest $request
     * @param $id
     * @return array
     */
    public function update(UpdateRequest $request, $id)
    {
        $normalshiftabsensi = Normalshiftabsensi::findOrFail($id);
        $normalshiftabsensi->update($request->toArray());
        return Reply::success('Absensi normal Berhasil di Edit');
    }

    /**
     * @param DeleteRequest $request
     * @param $id
     * @return array
     */
    public function destroy(DeleteRequest $request, $id)
    {
        Normalshiftabsensi::destroy($id);

        return Reply::success('messages.NormalshiftabsensiDeleteMessage');


    }

}
