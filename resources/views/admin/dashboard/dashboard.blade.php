@extends('admin.adminlayouts.adminlayout')

@section('head')
    {!! HTML::style("assets/global/plugins/fullcalendar/fullcalendar.min.css") !!}
@stop

@section('mainarea')

    <div class="page-head">
        <div class="page-title">
            <h1>
                <b style="font-weight: 400">@if($loggedAdmin->type=='superadmin'){{ $loggedAdmin->company->company_name }} @endif</b> HALAMAN BERANDA
            </h1>
        </div>
    </div>
    <div class="page-bar">
        <ul class="page-breadcrumb breadcrumb">
            <li>
              <div style="font-size: 16px;
    color: #585858;
    font-weight: 500;text-transform: uppercase;">  SELAMAT DATANG {{ $loggedAdmin->company->company_name }} Di HALAMAN ADMIN </div>
            </li>
        </ul>

    </div>


    @if($loggedAdmin->company->license_expired == 0)
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="dashboard-stat blue-madison">
                    <div class="visual">
                        <i class="fa fa-users"></i>
                    </div>
                    <div class="details">
                        <div class="number count">
                            {{$employee_count}}
                        </div>
                        <div class="desc">
                           Jumah Pegawai Keseluruhan
                        </div>
                    </div>
                    <a class="more" onclick="loadView('{{route('admin.employees.index') }}')">
                        LIHAT PEGAWAI <i class="m-icon-swapright m-icon-white"></i>
                    </a>
                </div>
            </div>

     

        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="dashboard-stat green-haze">
                        <div class="visual">
                            <i class="fa fa-users"></i>
                        </div>
                        <div class="details">
                            <div class="number count">
                                {{$jumlah_asn}}
                            </div>
                            <div class="desc">
                                Jumlah ASN
                            </div>
                        </div>
                        <a class="more" onclick="loadView('{{ route('admin.employees.create') }}')">
                            TAMBAH ASN <i class="m-icon-swapright m-icon-white"></i>
                        </a>
                    </div>
                </div>



          
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="dashboard-stat green-haze">
                        <div class="visual">
                            <i class="fa fa-users"></i>
                        </div>
                        <div class="details">
                            <div class="number count">
                                {{$jumlah_phl}}
                            </div>
                            <div class="desc">
                               Jumlah PHL
                            </div>
                        </div>
                        <a class="more" onclick="loadView('{{ route('admin.pegawaibaru.create') }}')">
                           TAMBAH PHL  <i class="m-icon-swapright m-icon-white"></i>
                        </a>
                    </div>
                </div>
				
				
				       <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="dashboard-stat red-intense">
                    <div class="visual">
                        <i class="fa fa-briefcase"></i>
                    </div>
                    <div class="details">
                        <div class="number count">
                            {{$department_count}}
                        </div>
                        <div class="desc">
                            {{ trans('core.totalDepartments') }}
                        </div>
                    </div>
                    <a class="more" onclick="loadView('{{route('admin.departments.index') }}')">
                        LIHAT BIDANG <i class="m-icon-swapright m-icon-white"></i>
                    </a>
                </div>
            </div>
				
       
        </div>
  
   

        <div class="row ">
		
     
                <div class="col-md-6">
                    <div class="portlet light bordered">
                        <div class="portlet-title">
                            <div class="caption font-blue">
                            
                         Report Rekapitulasi TPP
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div id="expenseChart" style="width: 100%; height: 400px; margin: 0 auto"></div>
                        </div>
                    </div>

                </div>
        
     
		
            <div class="col-md-6 col-sm-6">
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption font-dark">
                            <i class="fa fa-birthday-cake font-dark"></i>Pegawai Berulang Tahun Pada Bulan {{ trans("core.".date('F')) }} 
                        </div>

                    </div>
                    <div class="portlet-body">
                        <div class="scroller" style="height: 300px;" data-always-visible="1" data-rail-visible="0">
                            <ul class="feeds">


                                @forelse($current_month_birthdays as $birthday)
                                    <li>
                                        <div class="col1">
                                            <div class="cont">
                                                <div class="cont-col1">
                                                    <div class="label label-sm">
                                                        {!! HTML::image($birthday->profile_image_url,'ProfileImage',['class'=>"rounded-x",'width'=>'25px'])!!}
                                                    </div>
                                                </div>

                                                <div class="cont-col2">
                                                    <div class="desc">
                                                        <span><strong>{{$birthday->full_name}}</strong>  Berulang tahun tanggal</span>
                                                        <strong>{{date('d F ',strtotime($birthday->date_of_birth)) }}</strong>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </li>

                                @empty
                                    <p class="text-center"
                                       style="padding: 4px; margin-top: 26%;">{{ trans('messages.noBirthdays') }}</p>
                                @endforelse

                            </ul>
                        </div>

                    </div>
                </div>
            </div>
           
        </div>






    @endif
    <!-- END DASHBOARD STATS -->
@stop

@section('footerjs')
    @if($loggedAdmin->company->license_expired == 0)

        <!-- BEGIN PAGE LEVEL PLUGINS -->
        {!! HTML::script("assets/global/plugins/moment.min.js")!!}
        {!! HTML::script("assets/global/plugins/fullcalendar/fullcalendar.min.js")!!}
        {!! HTML::script("assets/global/plugins/fullcalendar/lang-all.js")!!}
        {!! HTML::script("assets/global/plugins/highcharts/js/highcharts.js")!!}
        {!! HTML::script("assets/global/plugins/highcharts/js/modules/exporting.js")!!}

        <script>

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
                                right: 'prev,next,today'
                            };
                        }

                        $('#calendar').fullCalendar('destroy'); // destroy the calendar
                        $('#calendar').fullCalendar({ //re-initialize the calendar
                            lang: '{{ Lang::getLocale() }}',
                            header: h,
                            defaultView: 'month',
                            eventRender: function (event, element, view) {

                                var i = document.createElement('i');
                                // Add all your other classes here that are common, for demo just 'fa'
                                i.className = 'fa';
                                /*'ace-icon fa yellow bigger-250 '*/
                                i.classList.add(event.icon);
                                element.find('div.fc-content').prepend(i);


                                if (event.className == "holiday") {
                                    var dataToFind = moment(event.start).format('YYYY-MM-DD');
                                    $('.fc-day[data-date="' + dataToFind + '"]').css('background', '#fcebb6');
                                }
                            },
                            events: function (start, end, timezone, callback) {
                                jQuery.ajax({
                                    url: '{{route('admin.attendance.ajax_load_calender') }}',
                                    type: 'POST',
                                    dataType: 'json',
                                    data: {
                                        start: start.format(),
                                        end: end.format()

                                    },
                                    success: function (doc) {
                                        var events = [];
                                        if (!!doc) {
                                            $.map(doc, function (r) {

                                                if (r.type == "attendance") {
                                                    type = r.type;

                                                    if (r.title == "all present") {
                                                        icon = 'fa-check';
                                                        bgcolor = '';
                                                    } else {
                                                        icon = 'no';
                                                        bgcolor = '#e50000';
                                                    }

                                                    eClassName = '';
                                                } else if (r.type == 'birthday') {
                                                    type = r.type;
                                                    icon = 'fa-birthday-cake';
                                                    bgcolor = 'green';
                                                    eClassName = ''
                                                } else {
                                                    type = 'holiday';
                                                    icon = 'fa-tree';
                                                    bgcolor = '#444D58';
                                                    eClassName = 'holiday'
                                                }
                                                events.push({
                                                    className: eClassName,
                                                    icon: icon,
                                                    type: type,
                                                    color: bgcolor,
                                                    id: r.id,
                                                    title: r.title,
                                                    start: r.date

                                                });
                                            });
                                        }
                                        callback(events);
                                    }
                                });
                            }

                        });
                    }
                };
            }();

            $(function () {

                $('#expenseChart').highcharts({
                    chart: {
                        type: 'column'
                    },
                    title: {
                        text: 'Report Rekapitulasi TPP Tahun ' + new Date().getFullYear()
                    },
                    xAxis: {
                        categories: [
                            'JAN',
                            'FEB',
                            'MAR',
                            'APR',
                            'MEI',
                            'JUN',
                            'JUL',
                            'AGS',
                            'SEP',
                            'OKT',
                            'NOV',
                            'DES'
                        ],
                        crosshair: true
                    },
                    yAxis: {
                        min: 0,
                        title: {
                            useHTML: true,
                            text: 'Jumlah Bersih'
                        }
                    },
                    tooltip: {
                        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                            '<td style="padding:0"><b>Rp. {point.y:.1f} </b></td></tr>',
                        footerFormat: '</table>',
                        shared: true,
                        useHTML: true
                    },
                    plotOptions: {
                        column: {
                            pointPadding: 0.2,
                            borderWidth: 0
                        }
                    },
                    series: [{
                     name: 'Data Bulan',
                        data: [{!! $expense !!} ]

                    }]
                });
            });

            jQuery(document).ready(function () {
                Calendar.init();
            });
        </script>
        <script>
            $('.count').each(function () {
                $(this).prop('Counter', 0).animate({
                    Counter: $(this).text()
                }, {
                    duration: 2000,
                    easing: 'swing',
                    step: function (now) {
                        $(this).text(Math.ceil(now));
                    }
                });
            });
        </script>
    @endif
@stop
