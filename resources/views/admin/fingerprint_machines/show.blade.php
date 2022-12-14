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
      @if ($connect)
Mesin terkoneksi
      @else
Mesin tidak terkoneksi
      @endif
                  

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
