<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminBaseController;
use App\Models\Patokanshiftabsen;
use App\Models\EmailTemplate;
use App\Models\Employee;
use App\Models\Dataskor;
use App\Models\TanggalNormalshift;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;

use Illuminate\Support\Str;

use Yajra\DataTables\Facades\DataTables;

class TanggalNormalshiftsController extends AdminBaseController
{

    public function __construct()
    {
        parent::__construct();
        $this->tanggalNormalshiftActive = 'active open';
        $this->pageTitle = trans('Periode Tanggal Absensi');
    }


    public function index()
    {

   
        return View::make('admin.tanggal_normalshifts.index', $this->data);
    }


    //  Datatable ajax request
    public function ajaxApplications()
    {
      
   
         $result = TanggalNormalshift::select('id as id',  'start_date', 'end_date', 'days',  'application_status', 'created_at', 'judul_nama')
            ->whereNotNull('application_status')
            ->get();

        return DataTables::of($result)->editColumn('start_date', function ($row) {
            $start = Carbon::createFromFormat("Y-m-d", $row->start_date);

            if ($row->end_date == null) {
                $end = clone $start;
            } else {
                $end = Carbon::createFromFormat("Y-m-d", $row->end_date);
            }

            $dates = $start->format("d-M-Y") . ' ' . (isset($row->end_date) ? ' s/d ' . $end->format("d-M-Y") : '');

            return $dates;




        })->editColumn('application_status', function ($row) {
            $color = ['pending' => 'warning', 'approved' => 'success', 'rejected' => 'danger'];

            return "<span class='label label-{$color[$row->application_status]}'>" . trans('core.' . $row->application_status) . "</span>";
        })->removeColumn('halfDayType')->removeColumn('end_date')->addColumn('edit', function ($row) {
            if ($row->application_status == 'pending') {
				
	 
			                $string = '
                         <div class="btn-group">
						 <button class="btn green btn-sm margin-bottom-5" data-toggle="modal" href="#static_approve_tampilan_shift" onclick="show_approve_tampilan_shift(' . $row->id . ');return false;">Setujui</button>
						               <button class="btn btn-danger btn-sm margin-bottom-5" data-toggle="modal" href="#static_reject_tampilan_shift" onclick="show_reject_tampilan_shift(' . $row->id . ');return false;" >Tolak</button>
						<a  class="btn purple btn-sm margin-bottom-5"  onclick="showEdit(' . $row->id . ')"><i class="fa fa-edit"></i> <span class="hidden-sm hidden-xs">Edit</span></a>
          
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
            ->removeColumn('created_at')
            ->rawColumns(['edit', 'application_status',   'start_date'])
            ->make();
    }


    public function show($id)
    {
				$dataskorsa = Dataskor::where('unikid', '1')->get();
		$tampilan = Dataskor::where('unikid', '2')->orwhere('unikid', '3')->orwhere('unikid', '4')->orwhere('unikid', '5')
		
		->get();
        $this->tanggal_normalshift = TanggalNormalshift::find($id);


        return View::make('admin.tanggal_normalshifts.show', compact('dataskorsa','tampilan'), $this->data);
    }


    public function update(Request $request, $id)
    {
        $check = TanggalNormalshift::find($id);

        if ($check == null) {
            return \View::make('admin.errors.noaccess', $this->data);
        }

        $inputs = \request()->all();
        $this->data["data"] = $inputs;

        $tanggal_normalshift = TanggalNormalshift::findOrFail($id);

        $inputs['application_status'] = ($inputs['application_status'] == 'Approve') ? 'approved' : 'rejected';
        $tanggal_normalshift->update($inputs);

        $start = Carbon::createFromFormat("Y-m-d", $tanggal_normalshift->start_date);

        if ($tanggal_normalshift->end_date == null) {
            $end = clone $start;
        } else {
            $end = Carbon::createFromFormat("Y-m-d", $tanggal_normalshift->end_date);
        }


        $diffDays = $end->diffInDays($start);
        $startDate = $start;
        if ($tanggal_normalshift->application_status == 'approved') {
            for ($i = 0; $i <= $diffDays; $i++) {
                $date = $startDate;
               $attendance = Patokanshiftabsen::firstOrCreate(['date' => $date->format("Y-m-d"),
                    'nama_event' => $tanggal_normalshift->judul_nama]);
$attendance->idabsensin = $tanggal_normalshift->id;


$attendance->jam_masuk = $tanggal_normalshift->jam_masuk;
$attendance->jam_pulang = $tanggal_normalshift->jam_pulang;
$attendance->jam_akhir_masuk = $tanggal_normalshift->jam_akhir_masuk; 
$attendance->jam_akhir_pulang= $tanggal_normalshift->jam_akhir_pulang;

 $attendance->id_ONTIME = $tanggal_normalshift->id_ONTIME;
$attendance->ONTIME_masuk = $tanggal_normalshift->ONTIME_masuk;
$attendance->ONTIME_pulang = $tanggal_normalshift->ONTIME_pulang;


$attendance->id_SKOR1 = $tanggal_normalshift->id_SKOR1;
$attendance->SKOR1_masuk = $tanggal_normalshift->SKOR1_masuk;
$attendance->SKOR1_pulang = $tanggal_normalshift->SKOR1_pulang;


$attendance->id_SKOR2 = $tanggal_normalshift->id_SKOR2;
$attendance->SKOR2_masuk = $tanggal_normalshift->SKOR2_masuk;
$attendance->SKOR2_pulang = $tanggal_normalshift->SKOR2_pulang;


$attendance->id_SKOR3 = $tanggal_normalshift->id_SKOR3;
$attendance->SKOR3_masuk = $tanggal_normalshift->SKOR3_masuk;
$attendance->SKOR3_pulang = $tanggal_normalshift->SKOR3_pulang;



$attendance->id_SKOR4 = $tanggal_normalshift->id_SKOR4;
$attendance->SKOR4_masuk = $tanggal_normalshift->SKOR4_masuk;
$attendance->SKOR4_pulang = $tanggal_normalshift->SKOR4_pulang;




$attendance->jam_masuk_jumat = $tanggal_normalshift->jam_masuk_jumat;
$attendance->jam_pulang_jumat = $tanggal_normalshift->jam_pulang_jumat;
$attendance->jam_akhir_masuk_jumat = $tanggal_normalshift->jam_akhir_masuk_jumat; 
$attendance->jam_akhir_pulang_jumat= $tanggal_normalshift->jam_akhir_pulang_jumat;

 $attendance->id_jumat_ONTIME = $tanggal_normalshift->id_jumat_ONTIME;
$attendance->ONTIME_masuk_jumat = $tanggal_normalshift->ONTIME_masuk_jumat;
$attendance->ONTIME_pulang_jumat = $tanggal_normalshift->ONTIME_pulang_jumat;


$attendance->id_jumat_SKOR1 = $tanggal_normalshift->id_jumat_SKOR1;
$attendance->SKOR1_masuk_jumat = $tanggal_normalshift->SKOR1_masuk_jumat;
$attendance->SKOR1_pulang_jumat = $tanggal_normalshift->SKOR1_pulang_jumat;


$attendance->id_jumat_SKOR2 = $tanggal_normalshift->id_jumat_SKOR2;
$attendance->SKOR2_masuk_jumat = $tanggal_normalshift->SKOR2_masuk_jumat;
$attendance->SKOR2_pulang_jumat = $tanggal_normalshift->SKOR2_pulang_jumat;


$attendance->id_jumat_SKOR3 = $tanggal_normalshift->id_jumat_SKOR3;
$attendance->SKOR3_masuk_jumat = $tanggal_normalshift->SKOR3_masuk_jumat;
$attendance->SKOR3_pulang_jumat = $tanggal_normalshift->SKOR3_pulang_jumat;



$attendance->id_jumat_SKOR4 = $tanggal_normalshift->id_jumat_SKOR4;
$attendance->SKOR4_masuk_jumat = $tanggal_normalshift->SKOR4_masuk_jumat;
$attendance->SKOR4_pulang_jumat = $tanggal_normalshift->SKOR4_pulang_jumat;



          
  
                $attendance->save();
                $startDate->addDays(1);
            }
        }




        Session::flash('success', trans("messages.tanggalNormalshiftUpdateMessage"));

        return Redirect::route('admin.tanggal_normalshifts.index');
    }


    public function destroy($id)
    {

        $tanggal_normalshift = TanggalNormalshift::findOrFail($id);




        $start = Carbon::createFromFormat("Y-m-d", $tanggal_normalshift->start_date);
	 $end = Carbon::createFromFormat("Y-m-d", $tanggal_normalshift->end_date);



        $diffDays = $end->diffInDays($start);
        for ($i = 0; $i < $diffDays; $i++) {
            $date = $start->addDays(1);
				Patokanshiftabsen::where('date', '=', $tanggal_normalshift->start_date)
				->delete();

            Patokanshiftabsen::where('date', '=', $date->format('Y-m-d'))
           ->delete();

			     Patokanshiftabsen::where('idabsensin', '=', $tanggal_normalshift->id)
           ->delete();	
				
			      

        }


        TanggalNormalshift::destroy($id);
        $output['success'] = 'deleted';

        return Response::json($output, 200);
		
	
    }

}
