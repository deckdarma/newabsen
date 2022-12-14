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
            Data Keterangan
            </h1></div>
    </div>
    <div class="page-bar">
        <ul class="page-breadcrumb breadcrumb">
            <li>
                <a onclick="loadView('{{route('admin.dashboard.index')}}')">@lang('core.dashboard')</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span class="active"> Data Keterangan</span>
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
                                <a class="btn green" onclick="loadView('{{route('admin.newleaveadmin.create')}}')">
                           Tambahkan Keterangan
                                    <i class="fa fa-plus"></i> </a>
									
									
                            </div>
                            <div class="col-md-6">
                            </div>
                        </div>
                    </div>
                    <table style="border: 1px solid #c2cad8;" class="table table-striped table-bordered table-hover" id="applications">
                     <thead>
                        <tr>
                            <th style="width:5px;">NO</th>
                            <th> @lang('core.leave') </th>
                            <th> @lang('core.leaveNumber')  </th>
                            <th> Potongan </th>
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

<!-- JS Implementing Plugins -->
{!! HTML::script('front_assets/plugins/back-to-top.js') !!}

<!-- Scrollbar -->

{!! HTML::script('front_assets/plugins/scrollbar/src/perfect-scrollbar.js') !!}


    <script>



           var table = $('#applications').dataTable({
            "cache": true,
            "bProcessing": true,
            "bServerSide": true,
            "bDestroy": true,
            "order": [[1, "asc"]],
            "ajax": "{{ URL::route("admin.leave_applications") }}",
            "aoColumns": [
               {data: 'leaveType', name: 'leaveType'},
               {data: 'full_name', name: 'full_name'},
                {data: 'no_surat', name: 'no_surat', "searchable": false},
                {data: 'start_date', name: 'start_date'},
                {data: 'end_date', name: 'end_date'},
                {data: 'edit', name: 'edit'},
            ],
            "lengthMenu": [
                [15, 30, 50, -1],
                [15, 30, 50, "All"] // change per page values here
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

            $("#deleteModal").find('#info').html("@lang("messages.leaveApplicationDeleteConfirm")");
            $('#deleteModal').find("#delete").off().click(function () {
                var url = "{{ route('admin.leave_applications.destroy',':id') }}";
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
                        showToastrMessage("@lang("messages.leaveApplicationDeleteMessage")", '{{__('core.success')}}', 'success');
                    }
                });
            })
        }

 

    </script>
			  <script>
function refreshPage(){
    window.location.reload();
} 



</script>	         
			
@stop
