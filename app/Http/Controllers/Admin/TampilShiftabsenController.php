<?php

namespace App\Http\Controllers\Admin;

use App\Classes\Reply;
use App\Http\Controllers\AdminBaseController;

use App\Http\Requests\Admin\TanggalNormalshift\StoreRequest;
use App\Http\Requests\Admin\TanggalNormalshift\UpdateRequest;
use App\Models\TanggalNormalshift;
use App\Models\Dataskor;


use Illuminate\Support\Facades\View;
use Yajra\DataTables\Facades\DataTables;

/**
 * Class LeavetypesController
 * @package App\Http\Controllers\Admin
 */
class TampilShiftabsenController extends AdminBaseController
{


    public function __construct()
    {
        parent::__construct();
        $this->tanggalNormalshiftOpen = 'active open';
        $this->pageTitle = trans('core.tanggalNormalshift');

    }


    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $this->tanggalNormalshifts = TanggalNormalshift::all();
        return View::make('admin.tampilshiftabsen.index', $this->data);
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function ajaxLeaveType()
    {
		

		
		
		
		
             $result = TanggalNormalshift::select('id', 
			 'start_date', 
			 'end_date', 
			 'days', 
         			 
'jam_masuk',
'jam_akhir_masuk',
'jam_pulang',
'jam_akhir_pulang',			 
			 
'id_ONTIME',
'ONTIME_masuk',
'ONTIME_pulang',
'ONTIME_persen',


'id_SKOR1',
'SKOR1_masuk',
'SKOR1_pulang',
'SKOR1_persen',

'id_SKOR2',
'SKOR2_masuk',
'SKOR2_pulang',
'SKOR2_persen',

'id_SKOR3',
'SKOR3_masuk',
'SKOR3_pulang',
'SKOR3_persen',

'id_SKOR4',
'SKOR4_masuk',
'SKOR4_pulang',
'SKOR4_persen',




			 'application_status',  
			 'judul_nama');

          
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
        TanggalNormalshift::create($request->toArray());

        return Reply::success('Berhasil Menambahkan Periode Baru');
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
		
		
	

        $this->leavetype = TanggalNormalshift::find($id);
      
		$dataskorsa = Dataskor::where('unikid', '1')->get();
		$tampilan = Dataskor::where('unikid', '2')->orwhere('unikid', '3')->orwhere('unikid', '4')->orwhere('unikid', '5')
		->get();
	
   
        return View::make('admin.tampilshiftabsen.edit', compact('dataskorsa','tampilan'),  $this->data);
    }

    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
		$dataskorsa = Dataskor::where('unikid', '1')->get();
		$tampilan = Dataskor::where('unikid', '2')->orwhere('unikid', '3')->orwhere('unikid', '4')->orwhere('unikid', '5')
		
		->get();



        return View::make('admin.tampilshiftabsen.create', compact('dataskorsa','tampilan'), $this->data);

    }

    /**
     * @param UpdateRequest $request
     * @param $id
     * @return array
     */
    public function update(UpdateRequest $request, $id)
    {
        $TanggalNormalshift = TanggalNormalshift::findOrFail($id);
        $TanggalNormalshift->update($request->toArray());
        return Reply::success('Anda Berhasil mengedit periode Absen');
    }

    /**
     * @param DeleteRequest $request
     * @param $id
     * @return array
     */
    public function destroy(DeleteRequest $request, $id)
    {
        TanggalNormalshift::destroy($id);

        return Reply::success('messages.leaveTypeDeleteMessage');


    }

}
