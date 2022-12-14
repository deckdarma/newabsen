<?php

namespace App\Http\Controllers\Admin;

use App\Classes\Reply;
use App\Http\Controllers\AdminBaseController;
use App\Http\Requests\Admin\PresentAbsensi\DeleteRequest;
use App\Http\Requests\Admin\PresentAbsensi\StoreRequest;
use App\Http\Requests\Admin\PresentAbsensi\UpdateRequest;
use App\Models\Presentabsensi;
use Illuminate\Support\Facades\View;
use Yajra\DataTables\Facades\DataTables;

/**
 * Class PresentabsensisController
 * @package App\Http\Controllers\Admin
 */
class PresentabsensisController extends AdminBaseController
{


    public function __construct()
    {
        parent::__construct();
        $this->pageTitle = 'Present Absensi';
        $this->attendanceOpen = 'active';
        $this->presentAbsensiActive = 'active';
        $this->pageTitle = 'Present Absensi';

    }

    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $this->presentAbsensis = Presentabsensi::all();
        return View::make('admin.presentabsensis.index', $this->data);
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function ajaxPresentAbsensi()
    {
        $result = Presentabsensi::select('id', 'presentAbsensi', 'num_of_leave', 'potongan','potongan_shift', 'singkat');

        return DataTables::of($result)
            ->addColumn('edit', function ($row) {
                return '<a  class="btn purple btn-sm margin-bottom-10"  onclick="showEdit(' . $row->id . ',\'' . addslashes($row->presentAbsensi) . '\',\'' . $row->num_of_leave . '\')"><i class="fa fa-edit"></i> <span class="hidden-sm hidden-xs">' . trans("core.btnViewEdit") . '</span></a>
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
        Presentabsensi::create($request->toArray());

        return Reply::success('Berhasil di Tambahkan');
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $this->presentabsensi = Presentabsensi::find($id);
        return View::make('admin.presentabsensis.edit', $this->data);
    }
    public function edit_cepat($id)
    {
        $this->presentabsensi = Presentabsensi::find($id);
        return View::make('admin.presentabsensis.edit_cepat', $this->data);
    }

    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        return View::make('admin.presentabsensis.create');
    }

    /**
     * @param UpdateRequest $request
     * @param $id
     * @return array
     */
    public function update(UpdateRequest $request, $id)
    {
        $presentabsensi = Presentabsensi::findOrFail($id);
        $presentabsensi->update($request->toArray());
        return Reply::success('Presentasi Absensi Berhasil di Update');
    }

    /**
     * @param DeleteRequest $request
     * @param $id
     * @return array
     */
    public function destroy(DeleteRequest $request, $id)
    {
        Presentabsensi::destroy($id);

        return Reply::success('messages.presentAbsensiDeleteMessage');


    }

}
