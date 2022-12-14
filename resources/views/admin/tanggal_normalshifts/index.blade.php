@extends('admin.adminlayouts.adminlayout')

@section('head')
    <!-- BEGIN PAGE LEVEL STYLES -->
    {!! HTML::style("assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css") !!}
    <!-- END PAGE LEVEL STYLES -->

{!! HTML::style('front_assets/plugins/sky-forms/version-2.0.1/css/custom-sky-forms.css') !!}


@stop


@section('mainarea')

    <!-- BEGIN PAGE HEADER-->
    <div class="page-head">
        <div class="page-title"><h1>
Pengaturan Periode  Absensi OPD Normal Shift
            </h1></div>
    </div>
    <div class="page-bar">
        <ul class="page-breadcrumb breadcrumb">
            <li>
                <a onclick="loadView('{{route('admin.dashboard.index')}}')">@lang('core.dashboard')</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span class="active">Pengaturan Periode  Absensi OPD Normal Shift</span>
            </li>

        </ul>

    </div>            <!-- END PAGE HEADER-->            <!-- BEGIN PAGE CONTENT-->


    <div class="row">
        <div class="col-md-12">

            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div id="load">


            </div>
            <div class="portlet light bordered">

                <div class="portlet-body">
          
        <div class="table-toolbar">
		
		       
                        <div class="row">
                    <div class="col-md-12 form-group text-right">
                                <a class="btn blue" onclick="showAdd()">
                           Tambahkan Periode Tanggal 
                                    <i class="fa fa-plus"></i> </a>
									
									 
                            </div>
                            <div class="col-md-6">
                            </div>
                        </div>
                    </div>
                    <table class="table table-striped table-bordered table-hover" id="applications">
                        <thead>
                        <tr>
                            <th>@lang('core.id')</th>
                            <th>Nama Periode</th>
                  
                            <th>Tanggal</th>
                            <th>Jumlah Hari</th>
                        

                       
                            <th>@lang('core.status')</th>
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
    </div>            <!-- END PAGE CONTENT-->


    {{--Reject--}}

    {{--MODAL CALLING--}}
    @include('admin.common.delete')
    @include('admin.common.show-modal')
    {{--MODAL CALLING END--}}

@stop



@section('footerjs')


    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    {!! HTML::script("assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js")!!}
    {!! HTML::script("assets/global/plugins/datatables/datatables.min.js")!!}
    {!! HTML::script("assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js")!!}
    {!! HTML::script("assets/admin/pages/scripts/table-managed.js")!!}
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- END PAGE LEVEL PLUGINS -->
    {!! HTML::script("assets/global/plugins/datatables/plugins/bootstrap/jquery.inputmask.bundle.js")!!}
<!-- JS Implementing Plugins -->
{!! HTML::script('front_assets/plugins/back-to-top.js') !!}

<!-- Scrollbar -->

{!! HTML::script('front_assets/plugins/scrollbar/src/perfect-scrollbar.js') !!}


    <script>



        var table = $('#applications').dataTable({
            processing: true,
            serverSide: true,
            "aaSorting": [[0, "desc"]],
            {!! $datatabble_lang !!}
            "ajax": "{{ URL::route('admin.tanggal_normalshifts') }}",
            "columns": [
                {data: 'id', name: 'id'},
                {data: 'judul_nama', name: 'judul_nama'},
        
                {data: 'start_date', name: 'start_date'},
                {data: 'days', name: 'days'},
        
  
 
                {data: 'application_status', name: 'application_status'},
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
                return nRow;
            }

        });


        function del(id) {

            $('#deleteModal').modal('show');

            $("#deleteModal").find('#info').html("@lang("messages.tanggalNormalshiftDeleteConfirm")");
            $('#deleteModal').find("#delete").off().click(function () {
                var url = "{{ route('admin.tanggal_normalshifts.destroy',':id') }}";
                url = url.replace(':id', id);
                $.ajax({
                    type: "DELETE",
                    url: url,
                    dataType: 'json',
                    data: {"id": id}
                }).done(function (response) {
                    if (response.success == "deleted") {

                        $('#deleteModal').modal('hide');
                        $('#row' + id).fadeOut(500);
                        table._fnDraw();
                        showToastrMessage("@lang("messages.tanggalNormalshiftDeleteMessage")", '{{__('core.success')}}', 'success');
                    }
                });
            })
        }

        function show_application(id) {
            var url = "{!!  route('admin.tanggal_normalshifts.show',':id')  !!}";
            url = url.replace(':id', id);
            $.ajaxModal('#showModal', url);
        }

        function showAdd() {
            var url = "{{ route('admin.tampilshiftabsen.create') }}";
            $.ajaxModal('#showModal', url);

        }    
		

		
      function showEdit(id) {
            var url = "{{ route('admin.tampilshiftabsen.edit',':id') }}";
            url = url.replace(':id', id);
            $.ajaxModal('#showModal', url);

      
        }
		
	
		    function addUpdateLeaveType(id) {

            if (typeof id != 'undefined') {
                var url = "{{ route('admin.tampilshiftabsen.update',':id') }}";
                url = url.replace(':id', id);
            } else {
                url = "{{route('admin.tampilshiftabsen.store')}}";
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
						    window.location.reload();
                    }

                }
            });
        }

    </script>
         
			
@stop