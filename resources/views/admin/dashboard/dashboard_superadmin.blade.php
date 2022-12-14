@extends('admin.adminlayouts.adminlayout')

@section('head')

    <!-- BEGIN PAGE LEVEL STYLES -->
    {!! HTML::style("assets/global/plugins/select2/css/select2.css")!!}
    {!! HTML::style("assets/global/plugins/fullcalendar/fullcalendar.min.css")!!}
    <!-- BEGIN THEME STYLES -->

@stop
@section('mainarea')


    <!-- BEGIN PAGE HEADER-->
    <div class="page-head">
        <div class="page-title"><h1>
 Halaman Super Admin
            </h1></div>
    </div>
    <div class="page-bar">
        <ul class="page-breadcrumb breadcrumb">
            <li>
                <span class="active">Selamat Datang di Halaman Super Admin</span>
            </li>
        </ul>

    </div>
    <!-- END PAGE HEADER-->



    <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="dashboard-stat green">
                <div class="visual">
                    <i class="fa fa-bank"></i>
                </div>
                <div class="details">
                    <div class="number count">
                        {{$loggedAdmin->company_count}}
                    </div>
                    <div class="desc">
                Jumlah OPD
                    </div>
                </div>
                <a class="more" href="{{route('admin.companies.index') }}">
                   Lihat Semua <i class="m-icon-swapright m-icon-white"></i>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="dashboard-stat yellow-crusta ">
                <div class="visual">
                    <i class="fa fa-user"></i>
                </div>
                <div class="details">
                    <div class="number count">
                        {{ $jumlah_asn }}

                    </div>
                    <div class="desc">
                    Jumlah ASN
                    </div>
                </div>
                <div class="more" >
				Jumlah ASN Yang Aktif Dari Semua OPD
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="dashboard-stat red-intense">
                <div class="visual">
                    <i class="fa fa-user"></i>
                </div>
                <div class="details">
                    <div class="number  count">
 {{ $jumlah_phl }}
                    </div>

                    <div class="desc">
                       Jumlah PHL
                    </div>
                </div>
                  <div class="more" >
				Jumlah PHL Yang Aktif Dari Semua OPD
                </div>
            </div>
        </div>
		
		
		
		
		   <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="dashboard-stat red-intense" style="background-color: #79e3bc;">
                <div class="visual">
                    <i class="fa fa-desktop"></i>
                </div>
                <div class="details">
                    <div class="number  count">
 {{ $jumlah_ip }}
                    </div>

                    <div class="desc">
                       Jumlah IP Mesin
                    </div>
                </div>
                  <div class="more" style="background-color: #1e997c;">
				Jumlah IP Yang Aktif Dari Semua OPD
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-md-6 col-sm-6">
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-th-large font-blue"></i>
                        <span class="caption-subject font-blue bold uppercase">OPD AKTIF MINGGU INI</span>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="scroller" style="height: 300px;" data-always-visible="1" data-rail-visible="0">
                        <ul class="feeds">

                            @foreach($company_lists as $company_data)
                                <li>
                                    <div class="col1">
                                       <div class="cont-col2">
                                            <div class="desc"><a
                                                        onclick="loadView('{{route('admin.companies.edit', [$company_data->id])}}')">{{$company_data->company_name}}</a>

                                            </div>
                                        </div>

                                    </div>
                                    <div class="col2">
                                        <div class="date" style="font-size:11px;">{{$company_data->last_in_words}}</div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="scroller-footer">
                        <div class="btn-arrow-link pull-right">
                            <a onclick="loadView('{{route('admin.companies.index')}}')">Lihat Semua OPD</a>
                            <i class="icon-arrow-right"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
		
		        <div class="col-md-6 col-sm-6" id="earningReport">
            <div class="portlet light bordered ">
                <div class="portlet-title">
                    <div class="caption font-blue">
Jumlah TPP Bersih Dari OPD
                    </div>
                    <div class="btn-group pull-right">
                        <span class="control-label"><strong>Cari Tahun:</strong></span>
                        {!!  Form::select('employee_id', $earningYearFilter ,'all',['class' => 'form-control input-sm input-small input-inline ','id'=>'filterYear','data-placeholder'=> trans("core.selectAnEmployee").'...'])  !!}
                    </div>
                </div>
                <div class="portlet-body">
                    <div id="earningChart" style="width: 100%; height: 400px; margin: 0 auto">

                    </div>
                </div>
            </div>

        </div>
		
    </div>



@stop

@section('footerjs')


    <!-- BEGIN PAGE LEVEL PLUGINS -->

    {!! HTML::script("assets/global/plugins/select2/js/select2.min.js")!!}
    {!! HTML::script("assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js")!!}
    {!! HTML::script("assets/pages/scripts/dashboard.min.js")!!}
    {!! HTML::script("assets/admin/pages/scripts/components-dropdowns.js")!!}
    {!! HTML::script("assets/global/plugins/moment.min.js")!!}
    {!! HTML::script("assets/global/plugins/fullcalendar/fullcalendar.min.js")!!}
    {!! HTML::script("assets/global/plugins/fullcalendar/lang-all.js")!!}
    {!! HTML::script("assets/global/plugins/highcharts/js/highcharts.js")!!}
    {!! HTML::script("assets/global/plugins/highcharts/js/modules/exporting.js")!!}





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

    <!-- END PAGE LEVEL PLUGINS -->

    <script>
        $(document).ready(
            initChart([{!! $earning !!} ], new Date().getFullYear())
        );

        function initChart(earning, year) {

            $('#earningChart').highcharts({
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Jumlah TPP Bersih Tahun ' + year
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
                        text: 'Jumlah TPP'
                    }
                },
                tooltip: {
                    headerFormat: '<span style="font-size:10px">Total TPP</span><table>',
                    pointFormat: '<tr><td> Rp </td>' +
                        '<td style="padding:0"><b> {point.y:.1f}</b></td></tr>',
                    footerFormat: '</table>',
                    shared: true,
                    useHTML: true
                },
                plotOptions: {
                    column: {
                        pointPadding: 0.2,
                        borderWidth: 0,
                        dataLabels: {
                            enabled: true,
                            formatter: function () {
                                return Highcharts.numberFormat(this.y, 2);
                            }
                        },
                    }

                },
                series: [{
                    name: 'Data Bulan',
                    data: earning

                }]
            });
        }

        $('#filterYear').select2().on("select2:select", function (e) {

            var year = $('#filterYear').val();
            var url = "{{ route('admin.earning.report',':year') }}";
            url = url.replace(':year', year);
            $.ajax({
                type: "get",
                url: url,
                dataType: 'json',
                data: {"year": $('#filterYear').val()},

                beforeSend: function () {
                    $("#earningChart").html('<div style="margin-left:48%">{!!  HTML::image('assets/loader.gif') !!}</div>');
                },
                success: function (response) {
                    if (response.success == "success") {
                        $("#earningChart").html('');

                        var array = response.earningReport.split(',');
                        array.forEach(function (item, i) {
                            if (item == "''") {
                                array[i] = '';
                            } else {
                                array[i] = parseFloat(item)
                            }
                        });
                        console.log(array);
                        initChart(array, year);
                    }
                }

            });
        });
        @if(\Froiden\Envato\Functions\EnvatoUpdate::showReview())
            $('#reviewModal').modal('show');

            function hideReviewModal(type){
                var url = "{{ route('hide-review-modal',':type') }}";
                url = url.replace(':type', type);

                $.easyAjax({
                    url: url,
                    type: "GET",
                    container: "#reviewModal",
                });
            }
        @endif
    </script>


@stop
