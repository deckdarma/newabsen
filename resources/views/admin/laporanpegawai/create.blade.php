@extends('admin.adminlayouts.adminlayout')

@section('head')
    <!-- BEGIN PAGE LEVEL STYLES -->
    {!! HTML::style("assets/global/plugins/bootstrap-datepickerabsen/css/bootstrap-datepickerabsen.css") !!}
    {!! HTML::style("assets/global/plugins/select2/css/select2.css")!!}
    {!! HTML::style("assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css")!!}
    <!-- END PAGE LEVEL STYLES -->
    <style>
        .btn.active {
            opacity: 2 !important;
        }
    </style>
@stop


@section('mainarea')
@if($loggedAdmin->company->datashift==1)	
<script type="text/javascript">

    window.location.replace("../error");
</script>

@else

@endif

    <!-- BEGIN PAGE HEADER-->
    <div class="page-head">
        <div class="page-title"><h1>
         Laporan Pegawai
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
                <span class="active"> Laporan Pegawai</span>
            </li>

        </ul>

    </div>
    <!-- END PAGE HEADER-->
    <!-- BEGIN PAGE CONTENT-->

    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div id="load">

                @if(Session::get('success'))
                    <div class="alert alert-success">{{ Session::get('success') }}</div>
                @endif

            </div>
			<?php 
$datanull = NULL;
$datacom = $loggedAdmin->company_id;

$cekpegawai = count(DB::select(DB::raw("SELECT * FROM employees WHERE status='active' AND company_id ='".$datacom."' AND shift='0' AND designation !='".$datanull."' "))); ?>
<?php $cekasn = count(DB::select(DB::raw("SELECT * FROM employees WHERE statusmupeg = 'ASN' AND status='active' AND shift='0' AND company_id ='".$datacom."' AND designation !='".$datanull."' "))); ?>
<?php $cekphl = count(DB::select(DB::raw("SELECT * FROM employees WHERE statusmupeg = 'PHL' AND status='active' AND shift='0' AND company_id ='".$datacom."' AND designation !='".$datanull."' "))); ?>

@if ($cekpegawai != 0)			  

<div class="row">
<div class="col-md-6">
    <div class="portlet light bordered">
        <div class="portlet-title">
            <div class="caption font-dark">
          LAPORAN ASN
            </div>
        </div>
        <div class="portlet-body">
			<div style="
    margin-bottom: 10px;
"> Silahkan Klik Tombol di Bawah dan pilih ASN, dan Aplikasi akan menampilkan data ASN yang anda pilih, 
			sebagai informasi jika OPD anda memiliki ASN sebanyak: {{ $cekasn }} org
			</div>
	      	   <a style="width:100%" onclick="loadView('{{ route('admin.laporanpegawai.index') }}')" class="btn green">
                 LIHAT LAPORAN ASN 
                </a>
	   

    </div>
    </div>
</div>


<div class="col-md-6">
    <div class="portlet light bordered">
        <div class="portlet-title">
            <div class="caption font-dark">
             LAPORAN PHL
            </div>
        </div>
        <div class="portlet-body">
				<div style="
    margin-bottom: 10px;
"> Silahkan Klik Tombol di Bawah dan pilih PHL, dan Aplikasi akan menampilkan data PHL yang anda pilih, 
			sebagai informasi jika OPD anda memiliki PHL sebanyak: {{ $cekphl }} org
			</div>
	          <a style="width:100%" onclick="loadView('{{ route('admin.laporanphl.index') }}')" class="btn green">
                 LIHAT LAPORAN PHL
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
    {!! HTML::script("assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js")!!}
    {!! HTML::script("assets/admin/pages/scripts/table-managed.js")!!}
    {!! HTML::script("assets/global/plugins/bootstrap-datepickerabsen/js/bootstrap-datepickerabsen.js")!!}
    {!! HTML::script("assets/admin/pages/scripts/components-pickersabsen.js")!!}



@stop
