@extends('admin.adminlayouts.adminlayout')
@section('head')
    <style>
        .btn.active {
            opacity: 2 !important;
        }
    </style>
		    {!! HTML::style("assets/global/plugins/select2/css/select2.css")!!}
    {!! HTML::style("assets/global/plugins/select2/css/select2-bootstrap.min.css")!!}
    {!! HTML::style("assets/global/plugins/jquery-multi-select/css/multi-select.css")!!}
@stop

@section('mainarea')

    <!-- BEGIN PAGE HEADER-->
	
    <div class="page-head">
        <div class="page-title"><h1>
             Laporan Bulanan (ASN/PHL)
            </h1></div>
    
    </div>
    <div class="page-bar">
        <ul class="page-breadcrumb breadcrumb">
            <li>
                <a onclick="loadView('{{ route('admin.dashboard.index') }}')">{{trans('core.dashboard')}}</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span class="active">Laporan Bulanan (ASN/PHL)</span>
            </li>

        </ul>

    </div>
    <!-- END PAGE HEADER-->
    <!-- BEGIN PAGE CONTENT-->

    <div class="row">
        <div class="col-md-12">

            <div class="portlet light bordered">
                <div class="portlet-body">
                    <div class="row filter-row">
                     
                        <div class="col-sm-3 col-xs-6">
                            <div class="form-group form-focus">
                                <label class="control-label">Pilih Bulan</label>
                                <select class="form-control select2me floating" name="month">
                             <option value="1"
                                                @if (1 == date("n")) selected="selected"@endif>Januari</option>
                                        <option value="2"
                                                @if (2 == date("n")) selected="selected"@endif>Februari</option>
                                        <option value="3"
                                                @if (3 == date("n")) selected="selected"@endif>Maret</option>
                                        <option value="4"
                                                @if (4 == date("n")) selected="selected"@endif>April</option>
                                        <option value="5"
                                                @if (5 == date("n")) selected="selected"@endif>Mei</option>
                                        <option value="6"
                                                @if (6== date("n")) selected="selected"@endif >Juni</option>
                                        <option value="7"
                                                @if (7 == date("n")) selected="selected"@endif>Juli</option>
                                        <option value="8"
                                                @if (8 == date("n")) selected="selected"@endif>Agustus</option>
                                        <option value="9"
                                                @if (9 == date("n")) selected="selected"@endif>September</option>
                                        <option value="10"
                                                @if (10 == date("n")) selected="selected"@endif>Oktober</option>
                                        <option value="11"
                                                @if (11 == date("n")) selected="selected"@endif>November</option>
                                        <option value="12"
                                                @if (12 == date("n")) selected="selected"@endif>Desember</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-3 col-xs-6">
                            <div class="form-group form-focus">
                                <label class="control-label">Pilih Tahun</label>
                                {!!  Form::selectYear('year', 2015, date('Y'),date('Y'),['class' => 'form-control select2me floating'])  !!}
                            </div>
                        </div>
                        <div class="col-sm-3 col-xs-6">
                            <div class="form-group form-focus">
                                <label class="control-label">&nbsp;</label>
                                <a href="javascript:;" class="btn btn-success btn-block" onclick="filter(); return false;"> Klik Pencarian </a>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="table-responsive" id="attendance-sheet">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop


@section('footerjs')
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    {!! HTML::script("assets/global/plugins/bootstrap-select/js/bootstrap-select.min.js")!!}
    {!! HTML::script("assets/global/plugins/select2/js/select2.min.js")!!}
    {!! HTML::script("assets/global/plugins/jquery-multi-select/js/jquery.multi-select.js")!!}
    <!-- END PAGE LEVEL PLUGINS -->

    <!-- END PAGE LEVEL PLUGINS -->
    <script type="text/javascript">
	        $.fn.select2.defaults.set("theme", "bootstrap");
        $('.select2me').select2({
            placeholder: "Select",
            width: '100%',
            allowClear: false
        });

	
       var filter = () => {
            var data = {
                employee_id: $("select[name='employee_id']").val(),
                month: $("select[name='month']").val(),
                year: $("select[name='year']").val(),
                _token: '{{ csrf_token() }}'
            };

            var url = "{{ route('admin.attendance.filter') }}";
            $.easyAjax({
                type: 'POST',
                url: url,
                container: '#attendance-sheet',
                data: data,
                success: function (res) {
                    if (res.status === 'success') {
                        $('#attendance-sheet').html(res.data);
                    }
                }
            });
        };
       jQuery(document).ready(function () {
           filter();
       });
    </script>
@stop
