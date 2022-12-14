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
           Laporan Harian ASN (Shift)
            </h1></div>
    </div>
    <div class="page-bar">
        <ul class="page-breadcrumb breadcrumb">
            <li>
                <a onclick="loadView('{{ route('admin.dashboard.index') }}')">{{trans('core.dashboard')}}</a>
                <i class="fa fa-circle"></i>
            </li>
    
            <li>
                <span class="active"> Laporan Harian ASN (Shift)</span>
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
                                    {!! Form::open(['route'=>["admin.asnharianshift.create"], 'method' => 'GET', 'class' => "form-inline", 'id' => "new_date"]) !!}
                                    <div class="btn-group">
                                        <div class="input-group input-medium date date-picker "
                                             data-date-viewmode="years" id="date_change">
                                            <input type="text" class="form-control " name="date"
                                                   placeholder="@lang("core.selectDate")"
                                                   readonly id="attendence_date" value="{{ $date->format('Y-m-d') }}">
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
                  

                        @if(count($attendance)==0)
                            <div class="note note-warning">
                                <h4 class="block">ASN tidak di temukan</h4>
                                <p>Tidak ada ASN yang dapat di tampilkan saat ini, silahkan tambahkan ASN terlebih dahulu.</p>
                            </div>
                        @else
                           <div id="alert_box"></div>
			
               
 	     <div class="text-left">
		 <a href="javascript:printDiv('id-elemen-yang-ingin-di-print');" class="btn green"> <i class="fa fa-print"></i>  Print <span
                                        id="date_heading">{{ $date->format("d-M-Y") }} @if($date->isToday())
                                        (Hari Ini)@endif</span></a>
									
										<?php 
			$dataabsenpresent = $dataabsenlihatcount+$datapresentlihatcount	;				
										
			$jumlahbelum = $datashiflihatcount-$dataabsenpresent; ?>		
                     		 <a href="javascript:printDiv('id-elemen-yang-ingin-di-print');" class="btn green"> <i class="fa fa-print"></i>  Print <span
                                        id="date_heading">( {{ $jumlahbelum }} ) ASN yang Belum Absen</span></a>
                            </div>
							<div id="id-elemen-yang-ingin-di-print"> 
							<div class="yeprint">
							<div style="text-align: center;font-weight: bold;font-size: 25px;">	LAPORAN HARIAN ASN (SHIFT)        </div>
							<div style="text-align: center;font-weight: bold;font-size: 20px;text-transform: uppercase;margin-top: 0px;">  {{ $loggedAdmin->company->company_name }}  </div>
							<div style="text-align: center;font-weight: bold;font-size: 15px;text-transform: uppercase;margin-top: 0px;margin-bottom:20px;">TANGGAL,  
						{{ $date->format("d M Y") }}  </div>
						
                            <table style="width:100%" class="table table-striped table-bordered table-hover responsive dataTable no-footer dtr-inline collapsed">
						     <tbody> <tr>
                          			 		
                                    <td style="width:25%;font-size:18px;padding:5px 10px;font-weight:bold">Nama Lengkap</td>
                                    <td style="width:25%;font-size:18px;padding:5px 10px;font-weight:bold">Keterangan</td>
                                    <td style="width:25%;font-size:18px;padding:5px 10px;font-weight:bold">Skor</td>
                                    <td style="width:25%;font-size:18px;padding:5px 10px;font-weight:bold">Masuk/Pulang</td>
                                
                                </tr>
								  </tbody>
							</table>	
						</div>
						

			
			
	
						
                            <table style="width:100%" class="table table-striped table-bordered table-hover responsive dataTable no-footer dtr-inline collapsed"
                                   id="attendanceTable">
                                <thead>
                                <tr>
                          					
                                    <th style="width:25% !important;">Nama Lengkap</th>
                                    <th  style="width:25% !important">Keterangan</th>
                                    <th  style="width:25% !important">Skor</th>
                                    <th  style="width:25% !important">Masuk/Pulang</th>
                                
                                </tr>
                                </thead>
								
						
                          
                             <tbody>
		              
                             </tbody>
                       
                            </table>
						</div>
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

  .noprint {
display:block;
  }  
  .yeprint {
display:none;
  }
.dataTables_scrollBody {
overflow: hidden !important;
}

.table > tbody > tr > td {
    padding: 8px 8px 5px 8px;

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
<textarea id="printing-css" style="display:none;">
.dataTables_scrollBody {
    border-bottom: 0px solid #c2cad8 !important;
}
    @page 
    {
        size:  A4 landscape;   /* auto is the initial value */
        margin: 10px 20px ;  /* this affects the margin in the printer settings */
		
    }

    html
    {
        background-color: #FFFFFF; 
        margin: 0px;  /* this affects the margin on the html before sending to printer */
    }


.table {
    font-family: sans-serif;
    color: #232323;
    border-collapse: collapse;
	font-size:10px;text-align:left;
width:100%
}
  .noprint {
display:none;
  }
  
    .yeprint {
display:block;
  } 

.table, td {
border: 1px solid #000;
padding: 2px 2px 0px 2px;
font-size:15px;
width: 25%;
}

body {

    overflow-x: hidden;
}

div.dataTables_wrapper div.dataTables_filter {
    text-align: center;
    display: none;
}
div.dataTables_wrapper div.dataTables_info {
    text-align: center;
    display: none;
}

thead {
display: none;
}

.datalebar {
width: 25%;
}
.label {
    text-shadow: none !important;
    font-size: 14px;
    font-weight: 300;
    padding: 3px 6px 3px 6px;
    color: #fff;
    font-family: "Open Sans", sans-serif;
}
.label-danger {
    background-color: #ed6b75;
}
.label-success {
    background-color: #36c6d3;
}
.label-ONTIME {

    background: #3d9e0f !important;
margin-bottom:3px;
	 color: #fff;    display: block;
}

.label-SKOR1 {
    background: #eeec09 !important;
	 color: #000;
	 margin-bottom:3px;    display: block;
}

.label-SKOR2 {
    background: #eeec09 !important;
	 color: #000;
	 margin-bottom:3px;    display: block;
}

.label-SKOR3 {
    background: #eeec09 !important;
	 color: #000;
	 margin-bottom:3px;    display: block;
}


.label-SKOR4 {
     background: #eeec09 !important;
	 color: #000;
	 margin-bottom:3px;    display: block;
}

.label-pulangcepat {
   background: #eeec09 !important;  
	display: block;
	 color: #000;
}

</textarea>
<iframe id="printing-frame" name="print_frame" src="about:blank" style="display:none;"></iframe>
<script type="text/javascript">
function printDiv(elementId) {
 var a = document.getElementById('printing-css').value;
 var b = document.getElementById(elementId).innerHTML;
 window.frames["print_frame"].document.title = document.title;
 window.frames["print_frame"].document.body.innerHTML = '<style>' + a + '</style>' + b;
 window.frames["print_frame"].window.focus();
 window.frames["print_frame"].window.print();
}
</script>
@stop

@section('footerjs')

    <!-- BEGIN PAGE LEVEL PLUGINS -->
    {!! HTML::script("assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js")!!}
    {!! HTML::script('assets/global/plugins/uniform/jquery.uniform.min.js')!!}
    {!! HTML::script("assets/global/plugins/moment.min.js") !!}
    {!! HTML::script("assets/global/plugins/bootstrap-datepickerabsen/js/bootstrap-datepickerabsen.js")!!}
    {!! HTML::script("assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js")!!}
    {!! HTML::script("assets/global/plugins/datatables/datatables.js")!!}
    {!! HTML::script("assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js")!!}

    {!! HTML::script("assets/admin/pages/scripts/components-pickersabsen.js")!!}
    {!! HTML::script('assets/js/ajaxform/jquery.form.min.js')!!}
    {!! HTML::script('assets/js/commonjs.js')!!}
    {!! HTML::script('assets/global/plugins/bootstrap-form-editable/bootstrap3-editable/js/bootstrap-editable.min.js')!!}




    <!-- END PAGE LEVEL PLUGINS -->

    <script>
        var attendanceData = {};
        var employeeIDs = [];

        jQuery(document).ready(function () {
            //ComponentsPickers.init();
            loadDataTable();
        });

    </script>

    <script>
        $('.timepicker').timepicker({
            autoclose: true,
            minuteStep: 4,
            disableMousewheel: true,
            disableFocus: true
        });

        var bindDatePicker = function (element) {
            $(element).timepicker({
                autoclose: true,
                minuteStep: 4,
                disableMousewheel: true,
                disableFocus: true
            });
        };

        var table;

        function loadDataTable() {
            table = $('#attendanceTable').dataTable({




                "bProcessing": false,
                "bServerSide": true,
                "ajax": {
                    "url": "{{ URL::route("admin.asnharianlapor.ajax_attendance_belum") }}",
                    "data": function (d) {
                        d.date = $('#attendence_date').val();
                    }
                },
                "aaSorting": [[0, "desc"]],
                "autoWidth": true,
                "autoHeight": true,

                columns: [
                    {data: 'eID', name: 'eID', sWidth: "25%"},
                    {data: 'status', name: 'status', sWidth: "25%"},
                    {data: 'date', name: 'date', sWidth: "25%"},
                    {data: 'clock_in', name: 'clock_in', sWidth: "25%"},
               
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
                            leaveType: $(nRow).find(".leaveType").val(),
                            halfDay: $(nRow).find(".half-day-checkbox").prop("checked"),
                            reason: $(nRow).find(".reason").val(),
                            clock_in: $(nRow).find(".clockin").val(),
                            clock_out: $(nRow).find(".clockout").val(),
                            late: $(nRow).find(".late_checkbox").prop("checked")
                        };
                        attendanceData[employeeID] = obj;
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

        function halfDayToggle(id, value) {

            if (value == 'half day') {
//			 $('#halfDayLabel').show(100);
                $('#halfLeaveType' + id).show(100);
            } else {
                $('#halfLeaveType' + id).hide(100);
            }

        }

        $('#date_change').datepickerabsen({
			
            format: "yyyy-mm-dd",
            todayHighlight: true,
            toggleActive: true,

            autoclose: true
        }).on('changeDate', function (e) {
            var url = "{{ route("admin.asnharianshift.create", "#id") }}";
            var date = moment($('#attendence_date').val(), 'YYYY-MM-DD').format('YYYY-MM-DD');
            url = url.replace("#id", date);
            loadView(url);
        });




$('.datePicker').datepickerabsen({ beforeShowDay: unavailable });
        function ajaxUpdateAttendance() {

            var data = JSON.stringify(attendanceData);

            var date = $('#attendence_date').val();
            var url = "{{ route("admin.asnharianshift.update", "#id") }}";
            url = url.replace("#id", date);

            $.ajax({
                url: url,
                dataType: 'json',
                data: {data: data, _method: "PATCH", _token: "{{ csrf_token() }}"},
                method: 'POST',
                beforeSend: function () {
                    $('#update_attendence').attr("disabled", true);
                },
                success: function (response) {
                    $('#update_attendence').attr("disabled", false);
                    showResponseMessage(response, 'error');
                    var route = "{{ route("admin.asnharianshift.create", "#id") }}";
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

     
    </script>
	


	
@stop
