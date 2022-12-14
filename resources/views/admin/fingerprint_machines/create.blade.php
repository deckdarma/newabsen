@extends('admin.adminlayouts.adminlayout')

@section('head')
    <!-- BEGIN PAGE LEVEL STYLES -->
{!! HTML::style('front_assets/plugins/sky-forms/version-2.0.1/css/custom-sky-forms.css') !!}
    {!! HTML::style("assets/global/plugins/select2/css/select2.css")!!}
    {!! HTML::style("assets/global/plugins/select2/css/select2-bootstrap.min.css")!!}
    {!! HTML::style("assets/global/plugins/bootstrap-summernote/summernote.css")!!}

    <!-- BEGIN THEME STYLES -->

@stop


@section('mainarea')


    <!-- BEGIN PAGE HEADER-->
    <div class="page-head">
        <div class="page-title"><h1>
                Tambah Ip Address
            </h1></div>
    </div>
    <div class="page-bar">
        <ul class="page-breadcrumb breadcrumb">
            <li>
                <a onclick="loadView('{{route('admin.dashboard.index')}}')">{{trans('core.dashboard')}}</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <a onclick="loadView('{{ route('admin.fingerprint_machines.index') }}')">Index IP</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span class="active">Tambah Ip Address</span>
            </li>

        </ul>

    </div>
    <!-- END PAGE HEADER-->

    <!-- BEGIN PAGE CONTENT-->
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->

            {{--INLCUDE ERROR MESSAGE BOX--}}

            {{--END ERROR MESSAGE BOX--}}


            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-blue">
                        <i class="fa fa-plus font-blue"></i> Tambah Ip Address
                    </div>
        
                </div>

                <div class="portlet-body form">

                    <!-- BEGIN FORM-->
                    {!! Form::open(array('route'=>"admin.fingerprint_machines.store",'class'=>'form-horizontal ajax_form','method'=>'POST')) !!}

                    <div class="form-body">

	<div class="form-group">
                            <label class="col-md-2 control-label">Pilih OPD: <span class="required">
                                        * </span>
                            </label>
                            <div class="col-md-6">
                                             <select class="form-control select2me" id="company_id" name="company_id">
						   <option selected disabled>Silahkan Pilih OPD</option>
                @foreach($namadinas as $opd)
                                            <option value="{{$opd->id}}">{{$opd->company_name}}</option>
                                        @endforeach
            </select>
                                <span class="help-block"></span>
                            </div>
                        </div>
						

                                   <div class="form-group">
                            <label class="col-md-2 control-label">Nama Mesin: <span class="required">
                                        * </span>
                            </label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="dinas"
                                       placeholder="Ketik Nama Mesin" >
                                <span class="help-block"></span>
                            </div>
                        </div>               
						
					
						
						       <div class="form-group">
                            <label class="col-md-2 control-label">IP Address: <span class="required">
                                        * </span>
                            </label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="ip"
                                       placeholder="Ketik IP Address" >
                                <span class="help-block"></span>
                            </div>
                        </div>
						
						
									       <div class="form-group">
                            <label class="col-md-2 control-label">Comkey: <span class="required">
                                        * </span>
                            </label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="comkey"
                                       placeholder="Ketik Comkey" value="0" readonly>
									   <small>Comkey di setting = 0</small>
                                <span class="help-block"></span>
                            </div>
                        </div>
						
						
					
        <div class="form-group">
                            <label class="col-md-2 control-label">IP Normal/Shift: <span class="required">
                                                            * </span>
                            </label>
                            <div class="col-md-6">
                                <select class="form-control" name="shift">
								    <option selected disabled>
                                         Pilih Status IP Normal/Shift</option>
                                    <option value="0">OPD Normal</option>
                                    <option value="1">OPD Shift</option>
                                </select>
		<small>Jika anda memilih OPD Shift berarti IP hanya tampil pada Shift</small>
                            </div>
                        </div>
	
						
        <div class="form-group">
                            <label class="col-md-2 control-label">Pilih Shift: <span class="required">
                                                            * </span>
                            </label>
                            <div class="col-md-6">
                                <select class="form-control" name="idshift">
								    <option selected disabled>
                                        Pilih Shift</option>
                                    <option value="0">Tidak Ada Shift</option>
                                    <option value="1338">Shift Pagi</option>
                                    <option value="1427">Shift Sore</option>
                                    <option value="1428">Shift Malam</option>
                                </select>
			<small>Jika anda memilih OPD Normal, Silahkan Pilih Tidak Ada Shift</small>
                            </div>
                        </div>

        <div class="form-group">
                            <label class="col-md-2 control-label">{{trans('core.status')}}: <span class="required">
                                                            * </span>
                            </label>
                            <div class="col-md-6">
                                <select class="form-control" name="status">
								    <option selected disabled>
                                         Pilih Status</option>
                                    <option value="1">
                                          Aktifkan</option>
                                    <option value="0">Tidak Aktifkan</option>
                                </select>

                            </div>
                        </div>

                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-2 col-md-9">

                                    <button type="button" class="btn green" 
                                            onclick="ajaxCreateNotice12()">
                                        {{trans('core.btnSubmit')}} Data </button>

                                </div>
                            </div>
                        </div>
                    {!!  Form::close()  !!}
                    <!-- END FORM-->

                    </div>
                </div>
                <!-- END EXAMPLE TABLE PORTLET-->

            </div>
        </div>
    </div>
    <!-- END PAGE CONTENT-->


@stop

@section('footerjs')

    <!-- BEGIN PAGE LEVEL PLUGINS -->
    {!! HTML::script("assets/global/plugins/bootstrap-select/bootstrap-select.min.js") !!}
    {!! HTML::script("assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js")!!}
    {!! HTML::script("assets/global/plugins/select2/select2.min.js") !!}
    {!! HTML::script("assets/global/plugins/jquery-multi-select/js/jquery.multi-select.js") !!}

    {!! HTML::script('assets/js/ajaxform/jquery.form.min.js')!!}
    <script>

	        $.fn.select2.defaults.set("theme", "bootstrap");
        $('.select2me').select2({
            placeholder: "Select",
            width: '100%',
            allowClear: false
        });

        // Javascript function to update the company info and Bank Info
        function ajaxCreateNotice12() {



            var url = "{{ route('admin.fingerprint_machines.store') }}";
            $.easyAjax({
                type: 'POST',
                url: url,
                container: '.ajax_form',
                 data: $('.ajax_form').serialize(),
            });
        }

    </script>
    <!-- END PAGE LEVEL PLUGINS -->
@stop
