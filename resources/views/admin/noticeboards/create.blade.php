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
             Form Buat Papan Pengumuman
            </h1></div>
    </div>
    <div class="page-bar">
        <ul class="page-breadcrumb breadcrumb">
            <li>
                <a onclick="loadView('{{route('admin.dashboard.index')}}')">{{trans('core.dashboard')}}</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <a onclick="loadView('{{ route('admin.noticeboards.index') }}')">Papan Pengumuman</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span class="active">Buat Papan Pengumuman</span>
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
             
                <div class="portlet-body form">

                    <!-- BEGIN FORM-->
                    {!! Form::open(array('route'=>"admin.noticeboards.store",'class'=>'form-horizontal ajax_form','method'=>'POST')) !!}

                    <div class="form-body">

                        <div class="form-group">
                            <label class="col-md-2 control-label">{{trans('core.title')}}: <span class="required">
                                        * </span>
                            </label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="title" id="title"
                                       placeholder="{{trans('core.title')}}">
                                <span class="help-block"></span>
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="col-md-2 control-label">{{trans('core.description')}}: <span class="required">
                                            * </span>
                            </label>
                            <div class="col-md-6">
                                <textarea class="form-control" id="description" name="description"></textarea>
                                <span class="help-block"></span>
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
                                    <option value="active">
                                          Aktifkan</option>
                                    <option value="inactive">Matikan</option>
                                </select>

                            </div>
                        </div>

                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-2 col-md-9">

                                    <button type="button" class="btn green" 
                                            onclick="ajaxCreateNotice12()">
                                       Lanjutkan Buat Papan Pengumuman </button>

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


        // Javascript function to update the company info and Bank Info
        function ajaxCreateNotice12() {



            var url = "{{ route('admin.noticeboards.store') }}";
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
