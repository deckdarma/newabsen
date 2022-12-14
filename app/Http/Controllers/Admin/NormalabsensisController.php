<?php

namespace App\Http\Controllers\Admin;

use App\Classes\Reply;
use App\Http\Controllers\AdminBaseController;
use App\Http\Requests\Admin\NormalAbsensi\DeleteRequest;
use App\Http\Requests\Admin\NormalAbsensi\StoreRequest;
use App\Http\Requests\Admin\NormalAbsensi\UpdateRequest;
use App\Models\Normalabsensi;
use App\Models\Dataskor;
use Illuminate\Support\Facades\View;
use Yajra\DataTables\Facades\DataTables;

/**
 * Class NormalabsensisController
 * @package App\Http\Controllers\Admin
 */
class NormalabsensisController extends AdminBaseController
{


    public function __construct()
    {
        parent::__construct();
        $this->pageTitle = 'Normal Absensi';
        $this->attendanceOpen = 'active';
        $this->NormalabsensiActive = 'active open';
        $this->pageTitle = 'Normal Absensi';

    }

    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $this->Normalabsensis = Normalabsensi::all();
        return View::make('admin.normalabsensis.index', $this->data);
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function ajaxNormalAbsensi()
    {
        $result = Normalabsensi::select('id','nama_event', 'date', 'jam_masuk', 'jam_pulang');

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
        Normalabsensi::create($request->toArray());

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
	
        $this->normalabsensi = Normalabsensi::find($id);
        return View::make('admin.normalabsensis.edit',compact('dataskorsa','tampilan'),  $this->data);
    }

    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        return View::make('admin.normalabsensis.create');
    }

    /**
     * @param UpdateRequest $request
     * @param $id
     * @return array
     */
    public function update(UpdateRequest $request, $id)
    {
        $normalabsensi = Normalabsensi::findOrFail($id);
        $normalabsensi->update($request->toArray());
        return Reply::success('Absensi normal Berhasil di Edit');
    }

    /**
     * @param DeleteRequest $request
     * @param $id
     * @return array
     */
    public function destroy(DeleteRequest $request, $id)
    {
        Normalabsensi::destroy($id);

        return Reply::success('messages.NormalabsensiDeleteMessage');


    }

}
