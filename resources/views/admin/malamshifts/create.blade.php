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
        Jadwal Shift
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
                <span class="active"> Jadwal Shift</span>
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
<?PHP 
$tampilsudah = $shiftpagi+$shiftsiang+$shiftmalam;
$belumada=$cekpegawai-$tampilsudah;?>




    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div id="load">

                @if(Session::get('success'))
                    <div class="alert alert-success">{{ Session::get('success') }}</div>
                @endif

            </div>
	
@if ($cekpegawai != 0)		          
						
			    <div class="row">
			<div class="col-md-12">
						    <div class="portlet light bordered">
        <div class="portlet-title">
					
			  
						<div style="
    text-align: center;
    font-size: 24px;
">JADWAL PENGATURAN KERJA BERDASARKAN SHIFT  </div>
		<div style="font-size:18px;text-align: center;margin-bottom: 20px;">{{ $loggedAdmin->company->company_name }} </div>												
							
                            </div>
				  
							<div style=" padding-top:5px;
    text-align: center;font-size: 17px;
"><span class="label label-primary">Total Pegawai Shift : {{ $cekpegawai  }} org</span> / <span class="label label-primary">Belum Ada Jadwal :	{{ $belumada  }} org</span> / <span class="label label-primary">Sudah Ada Jadwal : {{ $totalshiftpeg }} org</span></div>	
			                            </div>
                            </div>
							
						
 <?php
$date_jumat12 = date('Y-m-d');
$timestamp12 = strtotime($date_jumat12);
$tampilkanharidata2212= date("l", $timestamp12 );
$tampilkanharidata22 = strtolower($tampilkanharidata2212);

if ($tampilkanharidata22 == "sunday") $carinamahari = "Minggu";
elseif ($tampilkanharidata22 == "monday") $carinamahari = "Senin";
elseif ($tampilkanharidata22 == "tuesday") $carinamahari = "Selasa";
elseif ($tampilkanharidata22 == "wednesday") $carinamahari = "Rabu";
elseif ($tampilkanharidata22 == "thursday") $carinamahari = "Kamis";
elseif ($tampilkanharidata22 == "friday") $carinamahari = "Jumat";
elseif ($tampilkanharidata22 == "saturday") $carinamahari = "Sabtu";
?>							
							
<div class="col-md-4">
    <div class="portlet light bordered">
        <div class="portlet-title">
            <div class="caption font-dark">
			
			
     JADWAL  SHIFT PAGI 
            </div>
        </div>
        <div class="portlet-body">
		<div style="
    font-size: 16px;
	text-transform: uppercase;
    margin-bottom: 10px;
">HARI KERJA <b>{{ $carinamahari }}</b> : 
@if ($tampilkanharidata22 == "friday")
{{ $tampilpagi->jam_masuk_jumat }} s/d {{ $tampilpagi->jam_pulang_jumat }}
@else
{{ $tampilpagi->jam_masuk }} s/d {{ $tampilpagi->jam_pulang }}	
@endif
<BR>
<div class="col-md-12"> <div class="row"><h5  style="padding-top:10px;    margin: 0px;    padding-bottom: 10px;">Jadwal Pegawai yang masuk pada Shift Pagi tanggal : {{ date('d M Y') }} Sebanyak: <span style="font-weight:bold;">{{ $shiftpagi  }} org</span></h5> </div></div>
</div>
	      	   <a style="width:100%" onclick="loadView('{{ route('admin.malamshift.shiftpagi') }}')" class="btn  green">
                  INPUT JADWAL TGL: {{ date('d M Y') }}
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
                                <h4 class="block">Pegawai Tidak di Temukan</h4>
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
