@extends('admin.adminlayouts.adminlayout')

@section('head')
    <!-- BEGIN PAGE LEVEL STYLES -->
    {!! HTML::style('assets/global/plugins/uniform/css/uniform.default.min.css')!!}
    {!! HTML::style("assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css")!!}
    {!! HTML::style("assets/global/plugins/bootstrap-datepickerabsen/css/bootstrap-datepickerabsen.css")!!}
    {!! HTML::style("assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css")!!}
    {!! HTML::style("assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css")!!}
    {!! HTML::style("assets/global/plugins/bootstrap-form-editable/bootstrap3-editable/css/bootstrap-editable.css")!!}
    <!-- BEGIN THEME STYLES -->
@stop


@section('mainarea')


    <!-- BEGIN PAGE HEADER-->
    <div class="page-head">
        <div class="page-title"><h1>
             Jadwal Shift Sore
            </h1></div>
    </div>
    <div class="page-bar">
        <ul class="page-breadcrumb breadcrumb">
            <li>
                <a onclick="loadView('{{ route('admin.dashboard.index') }}')">{{trans('core.dashboard')}}</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <a onclick="loadView('{{ route('admin.datashifts.create') }}')">Index Jadwal</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span class="active">Jadwal Shift Sore</span>
            </li>
        </ul>

    </div>
    <!-- END PAGE HEADER-->
    <!-- BEGIN PAGE CONTENT-->
    <div class="row">
        <div class="col-md-12">
            <div class="portlet light bordered">
                <div class="portlet-body form">
            
                        <div class="table-toolbar margin-top-15">
                            <div class="row">
                                <div class="col-md-4">
                                    {!! Form::open(['route'=>["admin.siangshifts.create"], 'method' => 'GET', 'class' => "form-inline", 'id' => "new_date"]) !!}
                                    <div class="btn-group">
                                        <div class="input-group input-medium date date-picker "
                                             data-date-viewmode="years" id="date_change">
                                            <input type="text" class="form-control " name="date"
                                                   placeholder="@lang("core.selectDate")"
                                                   readonly id="siangshift_date" value="{{ $date->format('d-m-Y') }}">
                                            <span class="input-group-btn">
															   <button class="btn default" type="button"><i
                                                                           class="fa fa-calendar"></i></button>
															   </span>
                                        </div>
                                    </div>
                                    {{--<button class="btn blue" type="submit">{{trans('core.btnSubmit')}}</button>--}}
                                    {!! Form::close() !!}
                                </div>
						
                            </div>
                        </div>
                  

                        @if(count($datashift)==0)
                            <div class="note note-warning">
                                <h4 class="block">Pegawai Shift Tidak di temukan</h4>
                                <p>Tidak ada Pegawai Shift yang dapat di tampilkan saat ini, silahkan tambahkan Pegawai Shift terlebih dahulu.</p>
                            </div>
                        @else
                            {!! Form::open(['route' => ["admin.siangshifts.update", $date->format("Y-m-d")], 'class'=>'form-horizontal ajax_form', 'method'=>'PATCH']) !!}
                       
                     
 
                       

 	     <div class="text-left">
                     <input type="hidden" id="siangshiftDetails"
                                               name="siangshiftDetails[]">
                                        <button type="button" id="update_siangshift" class="btn red"
                                                onclick="ajaxUpdateDatashift()"><i class="fa fa-plus"></i>  Tambahkan Shift Sore <span
                                        id="date_heading">{{ $date->format("d-M-Y") }} @if($date->isToday())
                                        (Hari Ini)@endif</span>
                                        </button>
                     
                            </div>
							
							
				
							
				
					
					   <table class="table table-striped table-bordered table-hover responsive dataTable no-footer dtr-inline collapsed"
                                   id="siangshiftTable">
                                <thead>
                                <tr>
       
                                    <th>Nama</th>
                                    <th>Pilih Aksi</th>
                                    <th>Status Shift</th>
                            
                                
                                </tr>
                                </thead>
                                <tbody>
                                </tbody>
                     
                            </table>
                            {!!   Form::close()  !!}
                  
                    @endif
                </div>
                <!-- END EXAMPLE TABLE PORTLET-->
            </div>
        </div>
        <!-- END PAGE CONTENT-->
    </div>
<style>
.dataTables_scrollBody {
    border-bottom: 0px solid #c2cad8 !important;
}


.dataTables_scrollBody {
overflow: hidden !important;
}


.bootstrap-switch.bootstrap-switch-animate .bootstrap-switch-container {
    -webkit-transition: margin-left .5s;
    height: 29px;
    transition: margin-left .5s;
}

.data1338 {
background-color: #367cd3;
}

.data1427 {
background-color: #ff5b5b;
}
.data1428 {
background-color: #32c5d2;
}
</style>


@stop

@section('footerjs')

    <!-- BEGIN PAGE LEVEL PLUGINS -->
    {!! HTML::script("assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js")!!}
    {!! HTML::script('assets/global/plugins/uniform/jquery.uniform.min.js')!!}
    {!! HTML::script("assets/global/plugins/moment.min.js") !!}
    {!! HTML::script("assets/global/plugins/bootstrap-datepickerabsen/js/bootstrap-datepickerabsen.js")!!}
    {!! HTML::script("assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js")!!}
    {!! HTML::script("assets/global/plugins/datatables/datatables.min.js")!!}
    {!! HTML::script("assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js")!!}
    {!! HTML::script("assets/global/plugins/datatables/plugins/responsive/dataTables.responsive.min.js")!!}
    {!! HTML::script("assets/admin/pages/scripts/components-pickers.js")!!}
    {!! HTML::script('assets/js/ajaxform/jquery.form.min.js')!!}
    {!! HTML::script('assets/js/commonjs.js')!!}
    {!! HTML::script('assets/global/plugins/bootstrap-form-editable/bootstrap3-editable/js/bootstrap-editable.min.js')!!}



    <!-- END PAGE LEVEL PLUGINS -->

    <script>
        var siangshiftData = {};
        var employeeIDs = [];

        jQuery(document).ready(function () {
            //ComponentsPickers.init();
            loadDataTable();
        });

    </script>

    <script>
        $('.timepicker').timepicker({
            autoclose: true,
            minuteStep: 3,
            disableMousewheel: true,
            disableFocus: true
        });

        var bindDatePicker = function (element) {
            $(element).timepicker({
                autoclose: true,
                minuteStep: 3,
                disableMousewheel: true,
                disableFocus: true
            });
        };

        var table;

        function loadDataTable() {
            table = $('#siangshiftTable').dataTable({

                "bProcessing": false,
                "bServerSide": true,
                "ajax": {
                    "url": "{{ URL::route("admin.siangshift.ajax_siangshift") }}",
                    "data": function (d) {
                        d.date = $('#siangshift_date').val();
                    }
                },
                "aaSorting": [[0, "desc"]],
                    "autoWidth": true,
                "autoHeight": true,

                columns: [
                    {data: 'eID', name: 'eID', sWidth: "20%"},
                    {data: 'status', name: 'status', sWidth: "30%"},
                    {data: 'date', name: 'date', sWidth: "20%"}
                ],
                "lengthMenu": [
                    [-1],
                    ["All"] // change per page values here
                ],
                iDisplayLength: -1,
                sPaginationType: "full_numbers",
                fnCreatedRow: function (nRow, aData, iDisplayIndex) {
                    var bs = $(nRow).find(".make-bs-switch");

                    if (!bs.data("bootstrap-switch")) {
                        bs.bootstrapSwitch();
                    }

                    var timepicker = $(nRow).find('.timepicker');
                    bindDatePicker(timepicker);
                    $(nRow).find('.late_checkbox').uniform('refresh');
                    $(nRow).find('.half-day-checkbox').uniform('refresh');
                    $(nRow).find('.form-edit').editable({
                        url: ''
                    });

                    $(nRow).find("input").on("change switchChange.bootstrapSwitch", function () {
                        var employeeID = $(nRow).find("input[name='employees[]']").val();
                        var obj = {
                            employeeID: employeeID,
                            status: $(nRow).find(".make-bs-switch").bootstrapSwitch('state'),
                            leaveType: $(nRow).find(".leaveType").val()
                        };
                        siangshiftData[employeeID] = obj;
                    });

                },
                "fnInitComplete": function () {
                    $(".dataTables_info").addClass("hidden");
                    $(".dataTable").removeClass("hidden");
                },
                            scrollY: false,
             scrollCollapse: true,
			paging: false,
                deferRender: true
//		 bInfo : false

            });

        }

        function showHide(id) {
            if ($('#checkbox' + id + ':checked').val() == 'on') {
                $('#leaveForm' + id).addClass("hidden");
            } else {
                $('#leaveForm' + id).removeClass("hidden");

                var leaveType = $('#leaveType' + id).val();
                if (leaveType == 'half day') {
                    $('#halfLeaveType' + id).show();
                }
            }
        }

 

        $('#date_change').datepickerabsen({
            format: "dd-mm-yyyy",
            todayHighlight: true,
            toggleActive: true,
            autoclose: true
        }).on('changeDate', function (e) {
            var url = "{{ route("admin.siangshifts.edit", "#id") }}";
            var date = moment($('#siangshift_date').val(), 'DD-MM-YYYY').format('YYYY-MM-DD');
            url = url.replace("#id", date);
            loadView(url);
        });

        function ajaxUpdateDatashift() {

            var data = JSON.stringify(siangshiftData);

            var date = $('#siangshift_date').val();
            var url = "{{ route("admin.siangshifts.update", "#id") }}";
            url = url.replace("#id", date);

            $.ajax({
                url: url,
                dataType: 'json',
                data: {data: data, _method: "PATCH", _token: "{{ csrf_token() }}"},
                method: 'POST',
                beforeSend: function () {
                    $('#update_siangshift').attr("disabled", true);
                },
                success: function (response) {
                    $('#update_siangshift').attr("disabled", false);
                    showResponseMessage(response, 'error');
                    var route = "{{ route("admin.siangshifts.edit", "#id") }}";
                    var date = moment(response.date);

                    var url = route.replace("#id", date.format("YYYY-MM-DD"));
                    loadView(url);
                },
                error: function (xhr, textStatus, thrownError) {
                    resposeArray = {
                        "status": "fail",
                        "errorCode": "unkonwn",
                        "message": "Problem logging in, please try again!"
                    };
                    showResponseMessage(resposeArray, "error");
                }
            });
            return false;
        }

        function siangshiftRow(id) {

            loadingButton("#update_row" + id);
            var status = null;
            var leave_type = null;
        

            if ($('#checkbox' + id).is(":checked") == true) {
                status = "alpha";
            } else {
                status = "hadir";
                leave_type = $('#leaveType' + id).val();
    
            }

  

            $.ajax({
                type: "POST",
                url: "{!! route('admin.siangshift.update.row') !!}",
                data: {
                    "id": id,
                    "status": status,
                    "leave_type": leave_type
                }
            }).done(function (response) {
                unloadingButton("#update_row" + id);
                showResponseMessage(response, 'error');
 

                $("#updateCell" + id).parent("td").html(response.divHTML);

                $('.form-edit').editable({
                    url: ''
                });

            }).fail(function (response) {
                unloadingButton("#update_row" + id);
                showToastrMessage("@lang("messages.generalError")", "@lang("core.error")", "error");
            });
        }
    </script>
	

@stop
