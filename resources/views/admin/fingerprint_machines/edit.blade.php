@extends('admin.adminlayouts.adminlayout')

@section('head')
    <!-- BEGIN PAGE LEVEL STYLES -->

    {!! HTML::style("assets/global/plugins/bootstrap-select/css/bootstrap-select.min.css")!!}
    {!! HTML::style("assets/global/plugins/select2/css/select2.css")!!}
    {!! HTML::style("assets/global/plugins/jquery-multi-select/css/multi-select.css")!!}
    {!! HTML::style("assets/global/plugins/bootstrap-summernote/summernote.css")!!}

    <!-- BEGIN THEME STYLES -->

@stop


@section('mainarea')


    <!-- BEGIN PAGE HEADER-->
    <div class="page-head">
        <div class="page-title"><h1>
            Edit Ip Address
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
                <span class="active">Edit Ip Address</span>
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
                    <div class="caption font-red-sunglo">
                        <i class="fa fa-edit font-red-sunglo"></i>Edit IP Address
                    </div>
     
                </div>

                <div class="portlet-body form">

                    <!-- BEGIN FORM-->
                    {!! Form::open(array('route'=>["admin.fingerprint_machines.update",$notice->id],'class'=>'form-horizontal ajax_form','method'=>'PATCH')) !!}


                    <div class="form-body">
	<div class="form-group">
                            <label class="col-md-2 control-label">Pilih OPD: <span class="required">
                                        * </span>
                            </label>
                            <div class="col-md-6">
                                             <select class="form-control select2me" id="company_id" name="company_id">
						   <option selected disabled>Silahkan Pilih OPD</option>
                @foreach($namadinas as $opd)
                                            <option value="{{$opd->id}}" @if($notice->company_id==$opd->id) selected @endif>{{$opd->company_name}}</option>
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
                                       placeholder="Ketik Nama Mesin" value="{{$notice->dinas}}">
                                <span class="help-block"></span>
                            </div>
                        </div>
						
						
						       <div class="form-group">
                            <label class="col-md-2 control-label">IP Address: <span class="required">
                                        * </span>
                            </label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="ip"
                                       placeholder="Ketik IP Address" value="{{$notice->ip}}">
                                <span class="help-block"></span>
                            </div>
                        </div>
						
						
						
						       <div class="form-group">
                            <label class="col-md-2 control-label">Comkey: <span class="required">
                                        * </span>
                            </label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="comkey"
                                       placeholder="Ketik Comkey" value="{{$notice->comkey}}" readonly>
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
                                           <option value="0" @if ($notice->shift == 0) selected @endif>OPD Normal</option>
                <option value="1" @if ($notice->shift == 1) selected @endif>OPD Shift</option>
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
               <option value="0" @if ($notice->idshift == 0) selected @endif>Tidak Ada Shift</option>
                <option value="1338" @if ($notice->idshift == 1338) selected @endif>Shift Pagi</option>
                <option value="1427" @if ($notice->idshift == 1427) selected @endif>Shift Sore</option>
                <option value="1428" @if ($notice->idshift == 1428) selected @endif>Shift Malam</option>
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
                                           <option value="1" @if ($notice->status == 1) selected @endif>Aktif</option>
                <option value="0" @if ($notice->status == 0) selected @endif>Tidak Aktif</option>
                                </select>

                            </div>
                        </div>
						
						
						
						 
               


                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-3 col-md-9">
                                    <button type="button" class="btn green" id="noticeUpdate"
                                            onclick="ajaxUpdateNotice({{$notice->id}})">
                                        <i class="fa fa-check"></i> @lang("core.btnUpdate") Pembaruan</button>


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
    {!! HTML::script("assets/global/plugins/bootstrap-select/js/bootstrap-select.min.js") !!}
    {!! HTML::script("assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js")!!}
    {!! HTML::script("assets/global/plugins/select2/js/select2.js")!!}
    {!! HTML::script("assets/global/plugins/jquery-multi-select/js/jquery.multi-select.js") !!}

    {!! HTML::script('assets/js/ajaxform/jquery.form.min.js')!!}
    <script>
	        $.fn.select2.defaults.set("theme", "bootstrap");
        $('.select2me').select2({
            placeholder: "Select",
            width: '100%',
            allowClear: false
        });


        function ajaxUpdateNotice(id) {

            var val = $('#description').val();

            var url = "{{ route('admin.fingerprint_machines.update',':id') }}";
            url = url.replace(':id', id);
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
