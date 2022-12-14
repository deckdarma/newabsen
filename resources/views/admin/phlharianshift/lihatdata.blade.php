@extends('admin.adminlayouts.adminlayout')

@section('head')
    <!-- BEGIN PAGE LEVEL STYLES -->

    {!! HTML::style("assets/global/plugins/select2/css/select2.css")!!}

    <!-- END PAGE LEVEL STYLES -->
    <style>
        .btn.active {
            opacity: 2 !important;
        }
    </style>
@stop


@section('mainarea')


    <!-- BEGIN PAGE HEADER-->
    <div class="page-head">
        <div class="page-title"><h1>
         Laporan Harian ASN/PHL Shift
            </h1></div>
        <div class="page-toolbar">
            <!-- BEGIN THEME PANEL -->
  
            <!-- END THEME PANEL -->
        </div>
    </div>
    <div class="page-bar">
        <ul class="page-breadcrumb breadcrumb">
            <li>
                <a onclick="loadView('{{ route('admin.dashboard.index') }}')">{{trans('core.dashboard')}}</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span class="active"> Laporan Harian ASN/PHL Shift</span>
            </li>

        </ul>

    </div>
    <!-- END PAGE HEADER-->
    <!-- BEGIN PAGE CONTENT-->
<? 
date_default_timezone_set('Asia/Makassar');
$tanggal = date('Y-m-d'); ?>
	
<?php 
$datanull = NULL;
$datacom = $loggedAdmin->company_id;

$cekpegawai = count(DB::select(DB::raw("SELECT * FROM employees WHERE status='active' AND company_id ='".$datacom."' AND shift='1' AND designation !='".$datanull."' "))); ?>
<?php $cekasn = count(DB::select(DB::raw("SELECT * FROM employees WHERE statusmupeg = 'ASN' AND status='active' AND shift='1' AND company_id ='".$datacom."' AND designation !='".$datanull."' "))); ?>
<?php $cekphl = count(DB::select(DB::raw("SELECT * FROM employees WHERE statusmupeg = 'PHL' AND status='active' AND shift='1' AND company_id ='".$datacom."' AND designation !='".$datanull."' "))); ?>
<?PHP $belumasn=$cekasn-$hadirasn;?>
<?PHP $belumphl=$cekphl-$hadirphl;?>
@if ($cekasn ==0)
<?PHP $prosentaseasn= 0; ?>	
@else
<?PHP $prosentaseasn= round(($hadirasn/$cekasn)* 100); ?>
@endif

@if ($cekphl ==0)
<?PHP $prosentasephl= 0; ?>	

@else
<?PHP $prosentasephl= round(($hadirphl/$cekphl)* 100); ?>
@endif
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div id="load">

                @if(Session::get('success'))
                    <div class="alert alert-success">{{ Session::get('success') }}</div>
                @endif

            </div>
											  <?php
$date_jumat12 = date('Y-m-d');
$timestamp12 = strtotime($date_jumat12);
$tampilkanharidata2212= date("l", $timestamp12 );
$tampilkanharidata22 = strtolower($tampilkanharidata2212);

$timestamp = strtotime($date_jumat12);
$carihari= date("l", $timestamp );
$tampilkanhari = strtolower($carihari);
$waktu = Date("H:i:s");

if ($tampilkanharidata22 == "sunday") $carinamahari = "Minggu";
elseif ($tampilkanharidata22 == "monday") $carinamahari = "Senin";
elseif ($tampilkanharidata22 == "tuesday") $carinamahari = "Selasa";
elseif ($tampilkanharidata22 == "wednesday") $carinamahari = "Rabu";
elseif ($tampilkanharidata22 == "thursday") $carinamahari = "Kamis";
elseif ($tampilkanharidata22 == "friday") $carinamahari = "Jumat";
elseif ($tampilkanharidata22 == "saturday") $carinamahari = "Sabtu";
?>

@if ($cekpegawai != 0)		          
						
			    <div class="row">
			
<div class="col-md-6">
    <div class="portlet light bordered">
        <div class="portlet-title">
            <div class="caption font-dark">
          LAPORAN HARIAN ASN (SHIFT)
            </div>
        </div>
        <div class="portlet-body">
		<div style="
    font-size: 16px;
    margin-bottom: 10px;
">Data Statistik Kehadiran ASN Pada Tanggal, {{ date('d M Y') }}<BR>
<div class="col-md-4"> <div class="row"><h5  style="padding-top:10px;    margin: 0px;    padding-bottom: 10px;font-weight: bold;">SUDAH ABSEN: <span>{{ $hadirasn  }}</span> org</h5> </div></div>
<div class="col-md-4"> <div class="row"><h5 style="padding-top:10px;    margin: 0px;    padding-bottom: 10px;font-weight: bold;">BELUM ABSEN: <span>{{ $belumasn  }}</span> org</h5> </div></div>
<div class="col-md-4"> <div class="row"><h5 style="padding-top:10px;    margin: 0px;    padding-bottom: 10px;font-weight: bold;">PRESENTASI HADIR: <span>{{ $prosentaseasn }}%</span></h5> </div></div>
</div>
	      	   <a style="width:100%" onclick="loadView('{{ route('admin.asnharianshift.asndata') }}')" class="btn  green">
LIHAT LAPORAN ASN Tgl: {{ date('d M Y') }}
                </a>
	   

    </div>
    </div>
</div>


<div class="col-md-6">
    <div class="portlet light bordered">
        <div class="portlet-title">
            <div class="caption font-dark">
             LAPORAN HARIAN PHL (SHIFT)
            </div>
        </div>
        <div class="portlet-body">
<div style="
    font-size: 16px;
    margin-bottom: 10px;
">Data Statistik Kehadiran PHL Pada Tanggal, {{ date('d M Y') }}<BR>
<div class="col-md-4"> <div class="row"><h5  style="padding-top:10px;    margin: 0px;    padding-bottom: 10px;font-weight: bold;">SUDAH ABSEN: <span>{{ $hadirphl  }}</span> org</h5> </div></div>
<div class="col-md-4"> <div class="row"><h5 style="padding-top:10px;    margin: 0px;    padding-bottom: 10px;font-weight: bold;">BELUM ABSEN: <span>{{ $belumphl  }}</span> org</h5> </div></div>
<div class="col-md-4"> <div class="row"><h5 style="padding-top:10px;    margin: 0px;    padding-bottom: 10px;font-weight: bold;">PRESENTASI HADIR: <span>{{ $prosentasephl }}%</span></h5> </div></div>
</div>
	          <a style="width:100%" onclick="loadView('{{ route('admin.phlharianshift.phldata') }}')" class="btn purple">
                 LIHAT LAPORAN PHL Tgl: {{ date('d M Y') }}
                </a>


    </div>
    </div>
</div>

</div>

@else
	<div class="row">
	<div class="col-md-12">
    <div class="portlet light bordered">
  
<div class="note note-warning">
                                <h4 class="block">Pegawai Shift Tidak di Temukan</h4>
                                <p>Tidak ada pegawai yang dapat di tampilkan saat ini, silahkan tambahkan pegawai terlebih dahulu.</p>
</div>

</div>
</div>
</div>

@endif
       
            <!-- END EXAMPLE TABLE PORTLET-->

        </div>
    </div>
    <!-- END PAGE CONTENT-->



@stop


@section('footerjs')

    <!-- BEGIN PAGE LEVEL PLUGINS -->
    {!! HTML::script("assets/global/plugins/select2/js/select2.min.js")!!}
    {!! HTML::script("assets/global/plugins/datatables/datatables.min.js")!!}

    {!! HTML::script("assets/admin/pages/scripts/table-managed.js")!!}

    {!! HTML::script("assets/admin/pages/scripts/components-pickersabsen.js")!!}



@stop
