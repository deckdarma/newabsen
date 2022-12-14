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
Jenis Keterangan
            </h1></div>
    </div>
    <div class="page-bar">
        <ul class="page-breadcrumb breadcrumb">
            <li>
                <a onclick="loadView('{{route('admin.dashboard.index')}}')">@lang('core.dashboard')</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span class="active">{{ trans("pages.leaveTypes.indexTitle") }}</span>

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
                    <div class="table-toolbar">
                     <div class="row">
                            <div class="col-md-6">
                                <a class="btn green" onclick="showAdd()">
                                    @lang('core.btnAddLeaveType')
                                    <i class="fa fa-plus"></i> </a>
                            </div>
                            <div class="col-md-6">
                            </div>
                        </div>
                    </div>

                    <table class="table table-striped table-bordered table-hover dataTable no-footer" id="leaveType">
                        <thead>
                        <tr>
                            <th> @lang('core.leave') </th>
                            <th> @lang('core.leaveNumber')  </th>
                            <th> Potongan OPD Normal</th>
                            <th> Potongan OPD Shift</th>
                            <th> Singkatan </th>
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

        var table = $('#leaveType').dataTable({
            "cache": true,
            "bProcessing": true,
            "bServerSide": true,
            "bDestroy": true,
            "order": [[1, "asc"]],
            "ajax": "{{ URL::route("admin.leavetypes.ajax_list") }}",
            "aoColumns": [
                {data: 'leaveType', name: 'leaveType'},
                {data: 'num_of_leave', name: 'num_of_leave', "searchable": false},
                {data: 'potongan', name: 'potongan'},
                {data: 'potongan_shift', name: 'potongan_shift'},
                {data: 'singkat', name: 'singkat'},
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

           // Show Delete Modal
        function del(id, name) {

            $('#deleteModal').modal('show');

            $("#deleteModal").find('#info').html('Apakah anda yakin ingin menghapus <strong>' + name + '</strong> ?');

            $('#deleteModal').find("#delete").off().click(function () {

                var url = "{{ route('admin.leavetypes.destroy',':id') }}";
                url = url.replace(':id', id);

                var token = "{{ csrf_token() }}";

                $.easyAjax({
                    type: 'DELETE',
                    url: url,
                    data: {'_token': token},
                    container: "#deleteModal",
                    success: function (response) {
                        if (response.status == "success") {
                            $('#deleteModal').modal('hide');
                            table.fnDraw();
                        }
                    }
                });

            });
        }

        function showEdit(id, leaveType, num, pot) {
            var url = "{{ route('admin.leavetypes.edit',':id') }}";
            url = url.replace(':id', id);
            $.ajaxModal('#showModal', url);

            $("#edit_leaveType").val(leaveType);
            $("#edit_num_of_leave").val(num);
            $("#edit_potongan").val(pot);
        }


        function showAdd() {
            var url = "{{ route('admin.leavetypes.create') }}";
            $.ajaxModal('#showModal', url);

        }
  
        function addUpdateLeaveType(id) {

            if (typeof id != 'undefined') {
                var url = "{{ route('admin.leavetypes.update',':id') }}";
                url = url.replace(':id', id);
            } else {
                url = "{{route('admin.leavetypes.store')}}";
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
