@extends('admin.adminlayouts.adminlayout')

@section('head')

    <!-- BEGIN PAGE LEVEL STYLES -->
    {!! HTML::style("assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css")!!}
    {!! HTML::style("assets/global/plugins/datatables/plugins/responsive/responsive.bootstrap.css")!!}
@stop

@section('mainarea')


    <!-- BEGIN PAGE HEADER-->
    <div class="page-head">
        <div class="page-title"><h1>
               Presentasi Absensi
            </h1></div>
    </div>
    <div class="page-bar">
        <ul class="page-breadcrumb breadcrumb">
            <li>
                <a onclick="loadView('{{route('admin.dashboard.index')}}')">@lang('core.dashboard')</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span class="active"> Presentasi Absensi</span>

            </li>

        </ul>

    </div>
    <!-- END PAGE HEADER-->

    <div id="load">
        {{--INLCUDE ERROR MESSAGE BOX--}}

        {{--END ERROR MESSAGE BOX--}}
    </div>
    <!-- BEGIN PAGE CONTENT-->

    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet light bordered">

                <div class="portlet-body">

                    <table class="table table-striped table-bordered table-hover dataTable no-footer" id="presentAbsensi">
                        <thead>
                        <tr>
                            <th> Nama</th>
                   
                            <th> Persen % OPD Normal</th>
                            <th> Persen % OPD Shift</th>
                       
                            <th> @lang('core.action')  </th>
                        </tr>
                        </thead>
                        <tbody>


                        </tbody>
                    </table>
                </div>
            </div>
            <!-- END EXAMPLE TABLE PORTLET-->

        </div>
    </div>
    <!-- END PAGE CONTENT-->

    {{--MODAL CALLING--}}
    @include('admin.common.delete')
    @include('admin.common.show-modal')
    {{--MODAL CALLING END--}}

@stop


@section('footerjs')

    <!-- BEGIN PAGE LEVEL PLUGINS -->
    {!! HTML::script("assets/global/plugins/datatables/datatables.min.js")!!}
    {!! HTML::script("assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js")!!}
    {!! HTML::script("assets/global/plugins/datatables/plugins/responsive/dataTables.responsive.js")!!}
    {!! HTML::script("assets/global/plugins/datatables/plugins/responsive/responsive.bootstrap.js")!!}

    <!-- END PAGE LEVEL PLUGINS -->

    <script>

        var table = $('#presentAbsensi').dataTable({
            "cache": true,
            "bProcessing": true,
            "bServerSide": true,
            "bDestroy": true,
            "order": [[1, "asc"]],
            "ajax": "{{ URL::route("admin.presentabsensis.ajax_list") }}",
            "aoColumns": [
                {data: 'presentAbsensi', name: 'presentAbsensi'},

                {data: 'potongan', name: 'potongan'},
                {data: 'potongan_shift', name: 'potongan_shift'},
    
                {data: 'edit', name: 'edit'},
            ],
            "lengthMenu": [
                [15, 30, 50, -1],
                [15, 30, 50, "All"] // change per page values here
            ],
            "language": {
                "emptyTable": "No data available",
                "search": '',
                "searchPlaceholder": "Search..."
            },
            "sPaginationType": "full_numbers",
            "fnRowCallback": function (nRow, aData, iDisplayIndex) {
                var row = $(nRow);
                row.attr("id", 'row' + aData['0']);
            }

        });



        function showEdit(id, presentAbsensi, num, pot) {
            var url = "{{ route('admin.presentabsensis.edit',':id') }}";
            url = url.replace(':id', id);
            $.ajaxModal('#showModal', url);

            $("#edit_presentAbsensi").val(presentAbsensi);
            $("#edit_num_of_leave").val(num);
            $("#edit_potongan").val(pot);
        }



        function addUpdatePresentAbsensi(id) {

            if (typeof id != 'undefined') {
                var url = "{{ route('admin.presentabsensis.update',':id') }}";
                url = url.replace(':id', id);
            } else {
                url = "{{route('admin.presentabsensis.store')}}";
            }
            $.easyAjax({
                type: 'POST',
                url: url,
                container: '#leave_type_update_form',
                data: $('#leave_type_update_form').serialize(),
                success: function (response) {
                    if (response.status == "success") {
                        $('#showModal').modal('hide');
                        table.fnDraw();
                    }

                }
            });
        }
    </script>
	
	


@stop
