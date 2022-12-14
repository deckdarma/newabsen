<script type="text/javascript">

    window.location.replace("error");
</script>

@extends('admin.adminlayouts.adminlayout')

@section('head')
<!-- BEGIN PAGE LEVEL STYLES -->
    {!! HTML::style("assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css")!!}
    {!! HTML::style("assets/global/plugins/bootstrap-select/css/bootstrap-select.min.css")!!}
    {!! HTML::style("assets/global/plugins/select2/css/select2.css")!!}
    {!! HTML::style("assets/global/plugins/select2/css/select2-bootstrap.min.css")!!}
    {!! HTML::style("assets/global/plugins/jquery-multi-select/css/multi-select.css")!!}
    {!! HTML::style("assets/global/plugins/fullcalendar/fullcalendar.min.css")!!}
<!-- BEGIN THEME STYLES -->
@stop

@section('mainarea')


			<!-- BEGIN PAGE HEADER-->
<div class="page-head">
    <div class="page-title">
        <h1>
            @lang("pages.attendances.indexTitle") - {{ $employee->full_name }}
        </h1>
    </div>
</div>
<div class="page-bar">
    <ul class="page-breadcrumb breadcrumb">
        <li>
            <a onclick="loadView('{{ route('admin.dashboard.index') }}')" >@lang("core.dashboard")</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <a onclick="loadView('{{ route('admin.attendances.index') }}')" >@lang("pages.attendances.indexTitle")</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span class="active">@lang("pages.attendances.editTitle")</span>
        </li>

    </ul>

</div>

<!-- BEGIN PAGE CONTENT-->
<div class="row">
    <div class="col-md-12">


        <div class="portlet light bordered calendar">
            <div class="portlet-title">
                <div class="caption font-green-meadow">
                    <i class="fa fa-user font-green-meadow"></i>{{ $employee->full_name }}
                </div>
            </div>
            <div class="portlet-body text-center">
                <div class="row ">

                    <div class="col-md-4 col-sm-4">
                        <h2>Select</h2>

                        <form role="form form-row-sepe">
                            <div class="form-body alert alert-block alert-info fade in">

                                <div class="row ">

                                    <div class="col-md-12 ">

                                        <div class="form-group">
                                            <label>Nama</label>
                                            <div class="input-group ">


                                                <select class="form-control select2me" name="employee_id" onchange="redirect_to()" id="changeEmployee" disabled>
                                                  
                                                        <option value="{{$employee->id}}" @if($employee->id ==$getids) selected @endif
                                                                >{{$employee->full_name}} (@lang('core.empId'): {{ $employee->employeeID }})</option>
                                              
                                                </select>


                                     
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row ">

                                    <!--/span-->
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>{{trans('core.month')}}</label>

                                            <div class="input-group">
                                                <select class="form-control input-large select2me monthSelect"
                                                        id="monthSelect" name="month"
                                                        onchange="changeMonthYear();return false;">
                                                    <option value="01"
                                                            @if(strtolower(date('F'))=='january')selected='selected'@endif>{{trans('core.January')}}</option>
                                                    <option value="02"
                                                            @if(strtolower(date('F'))=='february')selected='selected'@endif>{{trans('core.February')}}</option>
                                                    <option value="03"
                                                            @if(strtolower(date('F'))=='march')selected='selected'@endif>{{trans('core.March')}}</option>
                                                    <option value="04"
                                                            @if(strtolower(date('F'))=='april')selected='selected'@endif>{{trans('core.April')}}</option>
                                                    <option value="05"
                                                            @if(strtolower(date('F'))=='may')selected='selected'@endif>{{trans('core.May')}}</option>
                                                    <option value="06"
                                                            @if(strtolower(date('F'))=='june')selected='selected'@endif>{{trans('core.June')}}</option>
                                                    <option value="07"
                                                            @if(strtolower(date('F'))=='july')selected='selected'@endif>{{trans('core.July')}}</option>
                                                    <option value="08"
                                                            @if(strtolower(date('F'))=='august')selected='selected'@endif>{{trans('core.August')}}</option>
                                                    <option value="09"
                                                            @if(strtolower(date('F'))=='september')selected='selected'@endif>{{trans('core.September')}}</option>
                                                    <option value="10"
                                                            @if(strtolower(date('F'))=='october')selected='selected'@endif>{{trans('core.October')}}</option>
                                                    <option value="11"
                                                            @if(strtolower(date('F'))=='november')selected='selected'@endif>{{trans('core.November')}}</option>
                                                    <option value="12"
                                                            @if(strtolower(date('F'))=='december')selected='selected'@endif>{{trans('core.December')}}</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row ">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>{{trans('core.year')}}</label>
                                            <select class="form-control input-large select2me" id="yearSelect"
                                                    name="month" onchange="changeMonthYear();return false;">
                                                @for($i=2013;$i<=date('Y');$i++)
                                                    <option value="{{$i}}"
                                                            @if(date('Y')==$i) selected='selected'@endif>{{$i}}</option>
                                                @endfor
                                            </select>
                                        </div>
                                    </div>

                                    <!--/span-->

                                </div>
                                <hr>
                                <div class="row">
								                     <div class="col-md-12">
                                        <div class="alert alert-warning text-center" style="padding: 5px 10px;
    text-align: left;
    color: #2f2f2f;">
                                 
                                            <div>Catatan: Data yang di hitung tidak termasuk hari libur</div>
                                        </div>
                                    </div>
								
                                    <div class="col-md-6">
                                        <div class="alert alert-danger text-center" style="    background-color: #f7f7f7;
    border-color: #e6e6e6;
    color: #000000;">
                                            <strong>Jumlah Kehadiran</strong>
                                            <div id="attendanceReport">-</div>
                                        </div>
                                    </div>
                                    <!--/span-->

                                    <div class="col-md-6">
                                        <div class="alert alert-danger text-center" style="    background-color: #f7f7f7;
    border-color: #e6e6e6;
    color: #000000;">
                                            <strong>Presentase Hadir %</strong>

                                            <div id="attendancePerReport">-</div>
                                        </div>
                                    </div>
									
									
									    <div class="col-md-12">
                                        <div class="alert alert-success text-center" style="    background-color: #f7f7f7;
    border-color: #e6e6e6;
    color: #000000;">
                                                            <div style="    background: #ddd;
    font-size: 18px;
    margin-bottom: 10px;
    border: 1px solid #dbd0d0;">  <strong>Data Skor</strong></div>

                                            <div id="dataskor">-</div>
                                    
                                        </div>
                                    </div>
                                    <!--/span-->
           <div class="col-md-12">
                                        <div class="alert alert-danger text-center" style="    background-color: #f7f7f7;border-color: #e6e6e6;color: #000000;">
                                           <div style="    background: #ddd;
    font-size: 18px;
    margin-bottom: 10px;
    border: 1px solid #dbd0d0;"> <strong>Data Keterangan</strong></div>
                                            <div id="jumlahketerangan">-</div>
                                        </div>
                                    </div>
									
									
									   <div class="col-md-12">
                                        <div class="alert alert-danger text-center" style="    background-color: #f7f7f7;border-color: #e6e6e6;color: #000000;">
                                                           <div style="    background: #ddd;
    font-size: 18px;
    margin-bottom: 10px;
    border: 1px solid #dbd0d0;">   <strong>Uraian Keterangan</strong>   </div>
                                            <div id="uraianketerangan">-</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </form>


                    </div>
                    <div class="col-md-8 col-sm-8">
                        <div id="calendar" class="has-toolbar text-center"></div>
                    </div>
                </div>
                <!-- END CALENDAR PORTLET-->
            </div>
        </div>
    </div>
</div>            <!-- END PAGE CONTENT-->

@stop

@section('footerjs')

        <!-- BEGIN PAGE LEVEL PLUGINS -->
        {!! HTML::script("assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js")!!}
        {!! HTML::script("assets/global/plugins/bootstrap-select/js/bootstrap-select.min.js")!!}
        {!! HTML::script("assets/global/plugins/select2/js/select2.js")!!}
        {!! HTML::script("assets/global/plugins/jquery-multi-select/js/jquery.multi-select.js")!!}
        {!! HTML::script("assets/admin/pages/scripts/components-dropdowns.js")!!}
		{!! HTML::script('assets/admin/pages/scripts/ui-blockui.js')!!}
        {!! HTML::script("assets/global/plugins/moment.min.js")!!}
        {!! HTML::script("assets/global/plugins/fullcalendar/fullcalendar.min.js")!!}
        <!-- END PAGE LEVEL PLUGINS -->
<script>
    jQuery(document).ready(function () {

        Calendar.init();
        showReport();
        UIBlockUI.init();
        ComponentsDropdowns.init();

    });


    function changeMonthYear() {
        var month = $("#monthSelect").val();
        var year = $("#yearSelect").val();

        $('#calendar').fullCalendar('gotoDate', year + '-' + month + '-01');
        showReport();

    }

    function showReport() {

        App.startPageLoading({animate: true});

        window.setTimeout(function () {
            App.stopPageLoading();
        }, 1000);

        var month = $("#monthSelect").val();
        var year = $("#yearSelect").val();
        var employeeID = $("#changeEmployee").val();

        var url = "{{ route('admin.attendance.report',':id') }}";
        url = url.replace(':id', employeeID);
        $.ajax({
            type: "GET",
            url: url,
            dataType: 'json',
		
            data: {"month": month, "year": year, "employee_id": employeeID}

        }).done(function (response) {

            if (response.success == "success") {

                $('#attendanceReport').html(response.presentByWorking);
                $('#attendancePerReport').html(response.attendancePerReport);
                $('#dataskor').html(response.dataskor);
                $('#jumlahketerangan').html(response.jumlahketerangan);
                $('#uraianketerangan').html(response.uraianketerangan);
                $('#tambahanskor').html(response.tambahanskor);

            }
        });
    }
	
	
	
    //Function to redirect to the employees page
    function redirect_to() {

        var employee = $('#changeEmployee').val();
        var url = "{{ route('admin.attendances.show',':id') }}";
        url = url.replace(':id', employee);
        loadView(url);

    }


    var Calendar = function () {


        return {
            //main function to initiate the module
            init: function () {
                Calendar.initCalendar();
            },

            initCalendar: function () {

                if (!jQuery().fullCalendar) {
                    return;
                }


                var date = new Date();

                var d = date.getDate();
                var m = date.getMonth();
                var y = date.getFullYear();

                var h = {};


                if ($('#calendar').parents(".portlet").width() <= 720) {
                    $('#calendar').addClass("mobile");
					
                    h = {
                        left: 'title, prev, next',
                        center: '',
						
                        right: 'today,month'
                    };
                } else {
                    $('#calendar').removeClass("mobile");
                    h = {
                        left: 'title',
						
                        center: '',
                        right: 'prev,next,today,month'
                    };
                }


                $('#calendar').fullCalendar('destroy'); // destroy the calendar
                $('#calendar').fullCalendar({ //re-initialize the calendar
                    lang: '{{Lang::getLocale()}}',
                    header: h,
						weekends: false,
						fixedWeekCount: false,
			
                    defaultView: 'month',
					     buttonText: {
                today: 'Lihat Bulan Sekarang',
                month: 'Bulan'
           },  
		      header: { // layout header

     center: '',

   },
          monthNames: ['Januari','Februar','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'],
    monthNamesShort: ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Ags','Sep','Oct','Nov','Des'],
    dayNames: ['Minggu','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'],
    dayNamesShort: ['Mng','Sen','Sel','Rab','Kam','Jum','Sáb'],
  
                    eventRender: function (event, element) {
                        if (event.className == "holiday") {
                            var dataToFind = moment(event.start).format('YYYY-MM-DD');
                            $('.fc-day[data-date="' + dataToFind + '"]').css('background', 'rgba(255, 224, 205, 1)');
                        }
                    },

                    events: [

                        {{-- Attendance on calendar --}}

                            @foreach($attendance as $attend )
                            {
							


							@if($attend->status=='present')
								
	
	
												//STAR PERIODE
							
								masuk: "Masuk: {{$attend->masuk}}",
								@if($attend->apel_pagi=='1')
									
								apelpagi: "Tidak Apel Pagi",
								@else
								apelpagi: "",
								@endif	
									
								@if($attend->apel_sore=='1')
								apelsore: "Tidak Apel Sore",
								@else
								apelsore: "",	
								@endif		
									
									
									
								@if($attend->keluar=='00:00:00')
								pulang: "",
                                pulangcepat: "Pulang Cepat",
								@else
								pulang: "Pulang: {{$attend->keluar}}",
								pulangcepat: "",
								@endif
								
                                dataskor: "{{$attend->dataskor}}",
								
                                start: '{{$attend->date}}',
								icon : "arrow-circle-o-left",
								      backgroundColor: App.getBrandColor('green')
								//END PERIODE
	
			@endif
					

								
								
							//STAR KELUAR
								@if($attend->status=='absent')
								title: "Keterangan: {{$attend->leaveType}}",
								masuk: "",
                                start: '{{$attend->date}}',
								pulang: "",
								apelpagi: "",
								apelsore: "",
								pulangcepat: "",
                                dataskor: "",
                                backgroundColor: App.getBrandColor('blue')
								@endif
								//END KELUAR
						


						
                            },
                            @endforeach



							             {{--Holidays on Calendar--}}
                            @foreach($attendance2 as $asas)
                            {
						
                                title: "Periode: {{$asas->nama_event}} ",
                                start: '{{$asas->date}}',
                           
								 pulang: "",
								 apelpagi: "",
								 apelsore: "",
								masuk: "",
								   pulangcepat: "",
                                dataskor: "",
                                backgroundColor: App.getBrandColor('grey')
							
                            },
							    @endforeach
							
                            {{--Holidays on Calendar--}}
                            @foreach($holidays as $holiday)
							
                            {
				
                                title: "Hari Libur",
                                start: '{{$holiday->date}}',
								 pulang: "",
								 apelpagi: "",
								 apelsore: "",
								masuk: "",
								   pulangcepat: "",
                                dataskor: "",
                                backgroundColor: App.getBrandColor('red')
						
						
							
                            },

                            @endforeach
                        ],
   eventRender: function(event, element) { 
            element.find('.fc-title').append("<div class=datamasuks>"+event.masuk+"</div><div class=datapulangs>"+event.pulang+"</div><div class="+event.dataskor+">"+event.dataskor+"</div><div class=pulangcepat>"+event.pulangcepat+"</div><div class=tidakapel>"+event.apelpagi+"</div><div class=tidakapel>"+event.apelsore+"</div>"); 
         if(event.icon){          
        element.find(".fc-title").prepend("<div class=ssasd>&nbsp;</div>");
     }

	   },
   

		
		
                });

            }

        };

    }();
    $.fn.select2.defaults.set("theme", "bootstrap");
    $('.select2me').select2({
        placeholder: "Select",
        width: '100%',
        allowClear: false
    });


    {{--INLCUDE ERROR MESSAGE BOX--}}

    {{--END ERROR MESSAGE BOX--}}
</script>
<style>
.ssasd {
margin-top:-32px;
}

</style>

@stop
