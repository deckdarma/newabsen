@extends('admin.adminlayouts.adminlayout')

@section('head')


    <!-- BEGIN PAGE LEVEL STYLES -->

    {!! HTML::style("assets/global/plugins/bootstrap-select/css/bootstrap-select.min.css") !!}
    {!! HTML::style("assets/global/plugins/bootstrap-datepickerabsen/css/bootstrap-datepickerabsen.css") !!}
    {!! HTML::style("assets/global/plugins/jquery-multi-select/css/multi-select.css") !!}
    {!! HTML::style("assets/global/plugins/fullcalendar/fullcalendar.min.css") !!}

    <!-- END PAGE LEVEL STYLES -->

@stop


@section('mainarea')

    <!-- BEGIN PAGE HEADER-->
    <div class="page-head">
        <div class="page-title"><h1>
                Hari Libur Non Shift  - {{ $current_year }}
            </h1></div>
    </div>
    <div class="page-bar">
        <ul class="page-breadcrumb breadcrumb">
            <li>
                <a onclick="loadView('{{route('admin.dashboard.index')}}')">{{trans('core.dashboard')}}</a>
                <i class="fa fa-circle"></i>
            </li>

            <li>
                <span class="active"> Hari Libur Non Shift</span>
            </li>
        </ul>

    </div>
    <!-- END PAGE HEADER-->
    <!-- BEGIN PAGE CONTENT-->

    <div id="load">
        {{--INLCUDE ERROR MESSAGE BOX--}}

        {{--END ERROR MESSAGE BOX--}}
    </div>

    <div class="portlet light bordered">
        <div class="portlet-body">
            <div class="row">
                <div class="col-md-3">
                    {{--<div class="row margin-bottom-10">--}}
                    {{--{!!  Form::open(['route' => 'admin.liburshifts.change_year', 'method' => 'get']) !!}--}}
                    <div class="margin-bottom-10">
                        <a class="btn green btn-block" data-toggle="modal" href="#static">
                            {{trans('core.btnAddLiburshift')}}
                            <i class="fa fa-plus"></i> </a>
                    </div>
                    <hr>
                    <div class="margin-bottom-10">
                        <div class="input-group  date date-picker-year" data-date-viewmode="years">
							<span class="input-group-btn">
								<button class="btn default" type="button">
									<i class="fa fa-calendar"></i> @lang("core.year"):
								</button>
							</span>
                            <input type="text" class="form-control" readonly="" id="year" name="year"
                                   value="{{$current_year}}">
                        </div>
                    </div>
                    {{--{!! Form::close() !!}--}}
                    {{--</div>--}}
                    <ul class="ver-inline-menu tabbable margin-bottom-10">
                        @foreach($months as $key => $month)
                            <li @if($month == $currentMonth) class="active" @endif >
                                <a data-toggle="tab" href="#{{ $month }}"
                                   onclick="gotoDate('{{ \Carbon\Carbon::parse("first day of ".$month." ".$year)->format("Y-m-d") }}')">
                                    <i class="fa fa-calendar"></i> {{ trans('core.'.$month.'') }} </a>
                                <span class="after">
							</span>
                            </li>
                        @endforeach

                    </ul>
                </div>
                <div class="col-md-9">
                    <div id="calendar"></div>
                </div>
            </div>
            <!-- END PAGE CONTENT-->
        </div>
    </div>
    {{--Add Liburshifts MODALS--}}

    <div id="static" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title"><strong>{{trans('core.addLiburshifts')}}</strong></h4>
                </div>
                {!! Form::open(array('route'=>"admin.liburshifts.store",'class'=>'form-horizontal ajax_form','method'=>'POST')) !!}
                <div class="modal-body">
                    <!-- BEGIN FORM-->
                    <ul class="nav nav-tabs">
                        <li class="active">
                            <a href="#tab_1" data-toggle="tab">@lang("core.commonLiburshifts")</a>
                        </li>
                        <li>
                            <a href="#tab_2" data-toggle="tab">@lang("core.customLiburshift")</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade active in" id="tab_1">
                            <div class="form-body">
                                <div class="form-group last">
                                    <div class="col-md-12">
                                        <select multiple="multiple" class="multi-select" id="liburshifts_list"
                                                name="liburshifts_list[]">
                                            <optgroup label="@lang("core.occasionsCaps")">
                                                @foreach($liburshifts_list as $liburshift_item)
                                                    <option value="{{ $liburshift_item->date }}|{{ $liburshift_item->name }}"
                                                            @if($liburshifts->contains("date", $liburshift_item->date)) selected
                                                            rel="previouslySelected" @endif>{{ \Carbon\Carbon::parse($liburshift_item->date)->format("M j, Y") }}
                                                        - {{ $liburshift_item->name }}</option>
                                                @endforeach
                                            </optgroup>
                                            {{--<optgroup label="@lang("core.customCaps")">--}}
                                            {{--@foreach($liburshifts as $liburshift)--}}
                                            {{--<option value="{{ $liburshift->date }}|{{ $liburshift->occassion }}" selected rel="previouslySelected">{{ \Carbon\Carbon::parse($liburshift->date)->format("M j") }} - {{ $liburshift->occassion }}</option>--}}
                                            {{--@endforeach--}}
                                            {{--</optgroup>--}}
                                            <optgroup label="@lang("core.sundaysCaps")">
                                                @foreach($all_sundays as $sunday)
                                                    @if(!($liburshifts_list->contains("date", $sunday)))
                                                        <option value="{{ $sunday }}|@lang("core.officeOff")"
                                                                @if($liburshifts->contains("date", $sunday)) selected
                                                                rel="previouslySelected" @endif>{{ \Carbon\Carbon::parse($sunday)->format("M j, Y") }}</option>
                                                    @endif
                                                @endforeach
                                            </optgroup>
                                            <optgroup label="@lang("core.saturdaysCaps")">
                                                @foreach($all_saturdays as $saturday)
                                                    @if(!($liburshifts_list->contains("date", $saturday)))
                                                        <option value="{{ $saturday }}|@lang("core.officeOff")"
                                                                @if($liburshifts->contains("date", $saturday)) selected
                                                                rel="previouslySelected" @endif>{{ \Carbon\Carbon::parse($saturday)->format("M j, Y") }}</option>
                                                    @endif
                                                @endforeach
                                            </optgroup>
                                            <optgroup label="@lang("core.fridaysCaps")">
                                                @foreach($all_fridays as $friday)
                                                    @if(!($liburshifts_list->contains("date", $friday)))
                                                        <option value="{{ $friday }}|@lang("core.officeOff")"
                                                                @if($liburshifts->contains("date", $friday)) selected
                                                                rel="previouslySelected" @endif>{{ \Carbon\Carbon::parse($friday)->format("M j, Y") }}</option>
                                                    @endif
                                                @endforeach
                                            </optgroup>
                                        </select>


                                        <input type="hidden" name="removedLiburshifts" id="removedLiburshifts">
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="tab-pane fade" id="tab_2">
                            <div class="form-body">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div>
                                            <input class="form-control form-control-inline input-medium date-picker"
                                                   data-date-format="dd-mm-yyyy" name="date[0]" type="text" value=""
                                                   placeholder="{{trans('core.date')}}"/>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div>
                                            <input class="form-control form-control-inline" type="text" name="occasion[0]"
                                                   placeholder="{{trans('core.occasion')}}"/>
                                        </div>
                                    </div>

                                </div>
                                <div id="insertBefore"></div>
                                <input type="hidden" name="removedLiburshifts" id="removedLiburshifts">
                                <button type="button" id="plusButton" class="btn btn-sm green form-control-inline">
                                    {{trans('core.add')}} {{trans('core.more')}} <i class="fa fa-plus"></i>
                                </button>

                            </div>
                        </div>
                    </div>


                    <!-- END FORM-->
                </div>
                <div class="modal-footer">
                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-offset-3 col-md-9">
                                <button type="button" data-loading-text="{{trans('core.btnSubmitting')}}..."
                                        class="btn green" onclick="ajaxUpdateLiburshifts()"
                                        id="updateLiburshifts">{{trans('core.btnSubmit')}}</button>

                            </div>
                        </div>
                    </div>
                </div>
            {!!  Form::close()  !!}
            <!-- END EXAMPLE TABLE PORTLET-->
            </div>

        </div>
    </div>

    {{--Add Liburshifts MODALS--}}

    {{--MODAL CALLING--}}
    @include('admin.common.delete')
    {{--MODAL CALLING END--}}

@stop

@section('footerjs')

    {{--Page Level JS--}}
    {!! HTML::script("assets/global/plugins/bootstrap-select/js/bootstrap-select.min.js") !!}
    {!! HTML::script("assets/global/plugins/bootstrap-datepickerabsen/js/bootstrap-datepickerabsen.js") !!}
    {!! HTML::script("assets/global/plugins/jquery-multi-select/js/jquery.multi-select.js") !!}
    {!! HTML::script("assets/global/plugins/jquery.quicksearch.js") !!}
    {!! HTML::script('assets/js/ajaxform/jquery.form.min.js')!!}
    {!! HTML::script("assets/global/plugins/moment.min.js")!!}
    {!! HTML::script("assets/global/plugins/fullcalendar/fullcalendar.min.js")!!}
    {!! HTML::script("assets/global/plugins/fullcalendar/lang-all.js")!!}
    {!! HTML::script("assets/admin/pages/scripts/components-pickersabsen.js") !!}
    {{--Page Level js end--}}
    <script>
        ComponentsPickers.init();

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
                        eventColor: "#E7505A",
                        @if($year != $current_year)
                        defaultDate: moment("{{ \Carbon\Carbon::parse("first day of january ".$current_year)->format("Y-m-d") }}"),
                        @endif
                        eventRender: function (event, element, view) {

                            var i = document.createElement('i');
                            i.className = 'fa';
                            i.classList.add("fa-trash");
                            i.classList.add("btn");
                            i.classList.add("grey-mint");
                            i.classList.add("btn-xs");
                            i.addEventListener("click", function () {
                                del(event.id, event.start);
                            });
                            element.find('div.fc-content').prepend(i);
                        },
                        events: [
                                @foreach($liburshifts as $liburshift)
                            {
                                "title": "{!! $liburshift->occassion !!}",
                                "start": "{{ $liburshift->date }}",
                                "id": {{ $liburshift->id }}},
                            @endforeach
                        ]

                    });
                }
            };
        }();

        Calendar.init();

        function gotoDate(date) {
            $("#calendar").fullCalendar("gotoDate", date);
        }

        function ajaxUpdateLiburshifts() {


            // Prepare list of removed liburshifts
            var list = "";
            $("#liburshifts_list").find("option[rel='previouslySelected']:not(:selected)").each(function () {
                list += $(this).val() + "~";
            });

            $("#removedLiburshifts").val(list);

            $.easyAjax({
                url: "{!! route('admin.liburshifts.store') !!}",
                type: "POST",
                data: $(".ajax_form").serialize(),
                container: ".ajax_form",
            });

        }

        $('#liburshifts_list').multiSelect({
            selectableOptgroup: true,
            selectableHeader: "<label><strong>@lang("core.liburshiftsList")</strong></label><input type='text' class='form-control' autocomplete='off' placeholder='@lang("core.searchList")'>",
            selectionHeader: "<label><strong>@lang("core.selectedLiburshifts")</strong></label><input type='text' class='form-control' autocomplete='off' placeholder='@lang("core.searchList")'>",
            afterInit: function (ms) {
                var that = this,
                    $selectableSearch = that.$selectableUl.prev(),
                    $selectionSearch = that.$selectionUl.prev(),
                    selectableSearchString = '#' + that.$container.attr('id') + ' .ms-elem-selectable:not(.ms-selected)',
                    selectionSearchString = '#' + that.$container.attr('id') + ' .ms-elem-selection.ms-selected';

                that.qs1 = $selectableSearch.quicksearch(selectableSearchString)
                    .on('keydown', function (e) {
                        if (e.which === 40) {
                            that.$selectableUl.focus();
                            return false;
                        }
                    });

                that.qs2 = $selectionSearch.quicksearch(selectionSearchString)
                    .on('keydown', function (e) {
                        if (e.which == 40) {
                            that.$selectionUl.focus();
                            return false;
                        }
                    });
            },
            afterSelect: function () {
                this.qs1.cache();
                this.qs2.cache();
            },
            afterDeselect: function () {
                this.qs1.cache();
                this.qs2.cache();
            }
        });

        var $insertBefore = $('#insertBefore');
        var $i = 0;

        $('#plusButton').click(function () {
            $i = $i + 1;
            $(' <div class="col-md-6"> ' +
                '<div class="form-group"><div><input class="form-control form-control-inline input-medium date-picker' + $i + '" name="date[' + $i + ']" type="text" value="" placeholder="{{trans('core.date')}}"/></div></div></div>' +
                '<div class="col-md-6"><div class="form-group"><div><input class="form-control form-control-inline" name="occasion[' + $i + ']" type="text" value="" placeholder="{{trans('core.occasion')}}"/></div></div><div>' +
                '</div>').insertBefore($insertBefore);
            $.fn.datepickerabsen.defaults.format = "dd-mm-yyyy";
            $('.date-picker' + $i).datepickerabsen();
        });

        function del(id, date) {

            $('#deleteModal').modal("show");
            $('#deleteModal').find('#info').html(prepareMessage("@lang("messages.liburshiftDeleteConfirm")", ":liburshift", date.format("Do MMM, YYYY")));
            $('#deleteModal').find("#delete").off().click(function () {
                var url = "{{ route('admin.liburshifts.destroy',':id') }}";
                url = url.replace(':id', id);
                var token = "{{ csrf_token() }}";
                $.easyAjax({
                    type: 'DELETE',
                    url: url,
                    data: {'_token': token, "id": id},
                    container: "#deleteModal",
                    success: function (response) {
                        $('#calendar').fullCalendar("removeEvents", id);
                        $("#liburshifts_list").find("option[value^='" + date.format("YYYY-MM-DD") + "']").prop("selected", false).removeAttr("selected");
                        $('#liburshifts_list').multiSelect('refresh');
                        $('#deleteModal').modal('hide');

                        $('#row' + id).fadeOut(500);
                    }
                });


            });

        }

        $(".date-picker-year").datepickerabsen({
            format: "yyyy", // Notice the Extra space at the beginning
            viewMode: "years",
            minViewMode: "years"
        }).on('changeDate', function (e) {
            $(this).datepickerabsen('hide');
            var year = $('#year').val();
            loadView('{{url('super-admin/liburshifts/index').'/'}}' + year.replace(/\s/g, ''));
        });


    </script>
@stop
