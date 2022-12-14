<?php

namespace App\Http\Controllers\Admin;

use App\Classes\Reply;
use App\Http\Controllers\AdminBaseController;
use App\Http\Requests\Admin\GolonganPeg\DeleteRequest;
use App\Http\Requests\Admin\GolonganPeg\StoreRequest;
use App\Http\Requests\Admin\GolonganPeg\UpdateRequest;
use App\Models\Golonganpeg;
use Illuminate\Support\Facades\View;
use Yajra\DataTables\Facades\DataTables;

/**
 * Class GolonganpegsController
 * @package App\Http\Controllers\Admin
 */
class GolonganpegsController extends AdminBaseController
{


    public function __construct()
    {
        parent::__construct();
        $this->pageTitle = 'GolonganPeg';
        $this->attendanceOpen = 'active';
        $this->golonganPegActive = 'active';
        $this->pageTitle = trans('pages.awards.indexTitle');

    }

    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $this->golonganPegs = Golonganpeg::all();
        return View::make('admin.golonganpegs.index', $this->data);
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function ajaxGolonganPeg()
    {
        $result = Golonganpeg::select('id', 'golonganPeg', 'num_of_leave', 'potongan', 'singkat');

        return DataTables::of($result)
            ->addColumn('edit', function ($row) {
                return '<a  class="btn purple btn-sm margin-bottom-10"  onclick="showEdit(' . $row->id . ',\'' . addslashes($row->golonganPeg) . '\',\'' . $row->num_of_leave . '\')"><i class="fa fa-edit"></i> <span class="hidden-sm hidden-xs">' . trans("core.btnViewEdit") . '</span></a>
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
        Golonganpeg::create($request->toArray());

        return Reply::success('Berhasil di Tambahkan');
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $this->golonganpeg = Golonganpeg::find($id);
        return View::make('admin.golonganpegs.edit', $this->data);
    }


    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        return View::make('admin.golonganpegs.create');
    }

    /**
     * @param UpdateRequest $request
     * @param $id
     * @return array
     */
    public function update(UpdateRequest $request, $id)
    {
        $golonganpeg = Golonganpeg::findOrFail($id);
        $golonganpeg->update($request->toArray());
        return Reply::success('Golonganpeg updated successfully');
    }

    /**
     * @param DeleteRequest $request
     * @param $id
     * @return array
     */
    public function destroy(DeleteRequest $request, $id)
    {
        Golonganpeg::destroy($id);

        return Reply::success('messages.golonganPegDeleteMessage');


    }

}
