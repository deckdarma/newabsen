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
         Pengaturan Jadwal Absensi OPD Sistem Shift
            </h1></div>
    </div>
    <div class="page-bar">
        <ul class="page-breadcrumb breadcrumb">
            <li>
                <a onclick="loadView('{{route('admin.dashboard.index')}}')">@lang('core.dashboard')</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span class="active">Pengaturan Absensi Normal Shift</span>

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
          
                    <table class="table table-striped table-bordered table-hover dataTable no-footer" id="Normalshiftabsensi">
                        <thead>
                        <tr>
                 
                            <th>Nama </th>
                            <th>Tanggal </th>
                            <th>Jam Masuk</th>
                      
               
                            <th>Jam Pulang</th>
                        
    
                       
                         
                            <th>Aksi</th>

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
    {!! HTML::script("assets/global/plugins/datatables/plugins/bootstrap/jquery.inputmask.bundle.js")!!}
    <!-- END PAGE LEVEL PLUGINS -->

    <script>

        var table = $('#Normalshiftabsensi').dataTable({
            "cache": true,
            "bProcessing": true,
            "bServerSide": true,
            "bDestroy": true,
            "order": [[1, "asc"]],
            "ajax": "{{ URL::route("admin.normalshiftabsensis.ajax_list") }}",
            "aoColumns": [
      
                {data: 'nama_event', name: 'nama_event'},
        
                {data: 'date', name: 'date'},
                {data: 'jam_masuk', name: 'jam_masuk'},
                {data: 'jam_pulang', name: 'jam_pulang'},
      
        
  
 
     
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

                var url = "{{ route('admin.normalshiftabsensis.destroy',':id') }}";
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

        function showEdit(id) {
            var url = "{{ route('admin.normalshiftabsensis.edit',':id') }}";
            url = url.replace(':id', id);
            $.ajaxModal('#showModal', url);

 
      
        }

        function showAdd() {
            var url = "{{ route('admin.normalshiftabsensis.create') }}";
            $.ajaxModal('#showModal', url);

        }

        function addUpdateNormalshiftAbsensi(id) {

            if (typeof id != 'undefined') {
                var url = "{{ route('admin.normalshiftabsensis.update',':id') }}";
                url = url.replace(':id', id);
            } else {
                url = "{{route('admin.normalshiftabsensis.store')}}";
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