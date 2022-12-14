@extends('admin.adminlayouts.adminlayout')

@section('head')


    <!-- BEGIN PAGE LEVEL STYLES -->
    {!! HTML::style("assets/global/plugins/select2/css/select2.css")!!}
    {!! HTML::style("assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css")!!}
    <!-- END PAGE LEVEL STYLES -->

@stop


@section('mainarea')


    <!-- BEGIN PAGE HEADER-->
    <div class="page-head">
        <div class="page-title"><h1>
      IP Address Fingerprint
            </h1></div>
    </div>
    <div class="page-bar">
        <ul class="page-breadcrumb breadcrumb">
            <li>
                <a onclick="loadView('{{route('admin.dashboard.index')}}')">{{trans('core.dashboard')}}</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span class="active">IP Address</span>
            </li>

        </ul>

    </div>
    <!-- END PAGE HEADER-->
    <!-- BEGIN PAGE CONTENT-->
    <div class="row">
        <div class="col-md-12">


            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div id="load">

                {{--INLCUDE ERROR MESSAGE BOX--}}

                {{--END ERROR MESSAGE BOX--}}

            </div>
            <div class="portlet light bordered">

                <div class="portlet-body">
                    <div class="table-toolbar">
                        <div class="row ">
                            <div class="col-md-6">

                                <a class="btn green" data-toggle="modal"
                                   onclick="loadView('{{URL::route('admin.fingerprint_machines.create')}}')">
                                 Tambahkan IP Address
                                    <i class="fa fa-plus"></i> </a>
                            </div>
                      
                        </div>
                    </div>


                    <table class="table table-striped table-bordered table-hover" id="notices">
                        <thead>
                        <tr>
                            <th width="1%"> @lang("core.serialNo") </th>
                            <th width="15%"> OPD </th>
                            <th> Nama Mesin </th>
                            <th> IP Adress </th>
                            <th> Comkey </th>
                            <th> Status IP</th>
                            <th> Normal/Shift </th>
                            <th> Status Shift </th>
                            <th> {{trans('core.action')}} </th>
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
    {{--MODAL CALLING END--}}
@stop



@section('footerjs')


    <!-- BEGIN PAGE LEVEL PLUGINS -->
    {!! HTML::script("assets/global/plugins/select2/js/select2.min.js")!!}
    {!! HTML::script("assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js")!!}
    {!! HTML::script("assets/global/plugins/datatables/datatables.min.js")!!}
    {!! HTML::script("assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js")!!}

    <!-- END PAGE LEVEL PLUGINS -->

    <script>


        var table = $('#notices').dataTable({
            processing: true,
            serverSide: true,
            {!! $datatabble_lang !!}
            "ajax": "{{ URL::route("admin.ajax_finger") }}",
            "aaSorting": [[4, "desc"]],
            columns: [
                {data: 'id', name: 'id'},
                {data: 'company_id', name: 'company_id'},
                {data: 'dinas', name: 'dinas'},
                {data: 'ip', name: 'ip'},
                {data: 'comkey', name: 'comkey'},
                {data: 'status', name: 'status'},
                {data: 'shift', name: 'shift'},
                {data: 'idshift', name: 'idshift'},
                {data: 'edit', name: 'edit'},
            ],
            "lengthMenu": [
                [5, 15, 20, -1],
                [5, 15, 20, "All"] // change per page values here
            ],

            "sPaginationType": "full_numbers",
            "fnRowCallback": function (nRow, aData, iDisplayIndex) {
                var oSettings = this.fnSettings();
                $("td:first", nRow).html(oSettings._iDisplayStart + iDisplayIndex + 1);
                return nRow
            }

        });


        function del(id) {

            $('#deleteModal').modal('show');

            $("#deleteModal").find('#info').html('Apakah anda yakin ingin menghapus ?');

            $('#deleteModal').find("#delete").off().click(function () {

                var url = "{{ route('admin.fingerprint_machines.destroy',':id') }}";
                url = url.replace(':id', id);

                var token = "{{ csrf_token() }}";

                $.easyAjax({
                    type: 'DELETE',
                    url: url,
                    data: {'_token': token},
                    container: "#deleteModal",
                    success: function (response) {
                        $('#deleteModal').modal('hide');
                        table.fnDraw();
                    }
                });

            });
        }
    </script>
@stop
