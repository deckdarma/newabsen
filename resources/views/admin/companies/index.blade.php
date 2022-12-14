@extends('admin.adminlayouts.adminlayout')

@section('head')


    <!-- BEGIN PAGE LEVEL STYLES -->
    {!!  HTML::style("assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css") !!}
    <!-- END PAGE LEVEL STYLES -->

@stop


@section('mainarea')


    <!-- BEGIN PAGE HEADER-->
    <div class="page-head">
        <div class="page-title"><h1>
             Data OPD
            </h1></div>
    </div>
    <div class="page-bar">
        <ul class="page-breadcrumb breadcrumb">

            <span class="active">List Nama OPD</span>

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
                {{--<div class="portlet-title">--}}
                {{--<div class="caption font-dark">--}}
                {{--<i class="fa fa-users font-dark"></i> Company List--}}
                {{--</div>--}}
                {{--<div class="tools">--}}
                {{--</div>--}}
                {{--</div>--}}


                <div class="portlet-body">
                    <div class="table-toolbar">
                        <div class="row ">
                            <div class="col-md-6">

                                <a class="btn green" href="{{route('admin.companies.create')}}">
                                    {{trans('core.btnAddCompany')}}
                                    <i class="fa fa-plus"></i> </a>
                            </div>
                            {{--<div class="col-md-6">--}}
                                {{--<div class="actions pull-right">--}}
                                    {{--<div class="input-group pull-right" style="width: 60%">--}}
                                        {{--<input type="text" class="form-control numOnly" size="5" name="days" id="#days"--}}
                                               {{--placeholder="Days...">--}}
                                        {{--<span class="input-group-btn">--}}
                                            {{--<button class="btn btn-default green" onclick="table._fnDraw();"--}}
                                                    {{--type="button">Filter <i class="fa fa-search"></i></button>--}}
                                          {{--</span>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        </div>
                    </div>


                    <table class="table table-striped table-bordered table-hover" id="company">
                        <thead>
                        <tr>
                 
                            <th> Logo</th>
                            <th> Nama OPD</th>
                            @if(module_enabled('Subdomain'))
                                <th>  Subdomains</th>

                            @else
                                <th> Jml Login</th>
                            @endif
                    
                      
                            <th> {{trans('core.status')}}</th>

                            <th class="text-center"> {{trans('core.action')}} </th>
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


    {{--BloCK Model--}}
    <div id="blockModal" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">{{trans('core.confirmation')}}</h4>
                </div>
                <div class="modal-body" id="blockinfo">
                    <p>
                        {{--Confirm Message Here from Javascript--}}
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal"
                            class="btn dark btn-outline">{{trans('core.btnCancel')}}</button>
                    <button type="button" data-dismiss="modal" class="btn red"
                            id="success"> {{trans('core.btnSubmit')}}</button>
                </div>
            </div>
        </div>
    </div>

    {{--END BLock MODAL--}}

@stop



@section('footerjs')


    <!-- BEGIN PAGE LEVEL PLUGINS -->
    {!! HTML::script("assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js")!!}
    {!! HTML::script("assets/global/plugins/datatables/datatables.min.js")!!}
    {!! HTML::script("assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js")!!}

    <!-- END PAGE LEVEL PLUGINS -->

    <script>

        onlyNum('numOnly');
    

        var table = $('#company').dataTable({
            {!! $datatabble_lang !!}
            processing: true,
            serverSide: true,
            "ajax": {
                "url": "{{ URL::route("admin.ajax_admin_company") }}",
                "data": function (d) {
                    d.days = $('input[name=days]').val();
                }
            },
            autoWidth: false,
            "order": [[0, "desc"]],
            "columns": [

                {'data': 'logo', name: 'logo', "bSortable": false, "width": "10%"},
                {'data': 'company_name', name: 'company_name', "bSortable": true, "width": "35%"},
                {'data': 'number_of_logins', name: 'number_of_logins', "bSortable": true},

       
                {'data': 'status', name: 'companies.status', "bSortable": true},

                {'data': 'edit', name: 'edit', "bSortable": false}

            ],
            "lengthMenu": [
         [15, 25, 50, -1],
                [15, 25, 50, "All"] // change per page values here
            ],

            "sPaginationType": "full_numbers",

            "fnRowCallback": function (nRow, aData, iDisplayIndex) {
                var row = $(nRow);
                if (aData['8'] == 1) {
                    row.css({"background-color": "rgba(240, 235, 64, 0.41)"});
                }

                row.attr("id", 'row' + aData['0']);
            }

        });

        function del(id) {

            $('#deleteModal').modal('show');
            $("#deleteModal").find('#info').html('{{__('messages.deleteConfirmCompany')}} ?');
            $('#deleteModal').find("#delete").off().click(function () {
                var url = "{{ route('admin.companies.destroy',':id') }}";
                url = url.replace(':id', id);
                var token = "{{ csrf_token() }}";
                $.easyAjax({
                    type: 'DELETE',
                    url: url,
                    data: {'_token': token},
                    container: "#deleteModal",
                    success: function (response) {
                        if (response.status === "success") {
                            $('#deleteModal').modal('hide');
                            table.fnDraw();
                        }
                    }
                });
            })

        }

        function blockUnblock(id, status, company) {
            var msg;
            if (status == "active") {
                msg = 'Apakah anda yakin ingin melakukan <span class="label label-danger">Disable</span> ke <b>' + company + '</b>';
            } else {
                msg = 'Apakah anda yakin ingin melakukan <span class="label label-success">Enable</span> ke <b>' + company + '</b>';
            }
            $('#blockModal').appendTo("body").modal('show');
            $('#blockinfo').html(msg);
            $('#blockModal').find("#success").off().click(function () {
                var url = "{{ route('admin.companies.change_status',':id') }}";
                url = url.replace(':id', id);

                $.easyAjax({
                    type: 'POST',
                    url: url,
                    data: {"id": id, 'status': status},
                    container: "#blockModal",
                    success: function (response) {
                        if (response.status === "success") {
                            $('#deleteModal').modal('hide');
                            table.fnDraw();
                        }
                    }
                });

            })

        }
		
		
	

    
        modal.on('bs-modal-hide', function () {
            modal.find('.modal-body').html('Loading...');
        });

        @if(module_enabled('Subdomain'))
        $('body').on('click', '.domain-params', function(){

            var company_id = $(this).data('company-id');
            var company_url = $(this).data('company-url');

            var msg = `You want to notify company admins about company Login URL <br> Company URL: <a href="//${company_url}"><b>${company_url}</b></a>`;

            $('#blockModal').appendTo("body").modal('show');
            $('#blockinfo').html(msg);

            $('#blockModal').find("#success").off().click(function () {
                var token = "{{ csrf_token() }}";

                $.easyAjax({
                    type: 'POST',
                    url: "{{route('notify.domain')}}",
                    data: {'_token': token, 'company_id': company_id},
                    success: function (response) {
                        if (response.status === "success") {
                            $.unblockUI();
                            table._fnDraw();
                        }
                    }
                });

            })
        });
        @endif
    </script>
	
	  @if(admin()->unikid =='1')

	<script type="text/javascript">

	     function blockdld(id, perjalanan, company) {
            var msg;
            if (perjalanan == "active") {
                msg = 'Apakah anda yakin ingin mengubah waktu mundur perjalanan dinas menjadi <span class="label label-danger">Tidak Aktif</span> ke <b>' + company + '</b>';
            } else {
                msg = 'Apakah anda yakin ingin mengubah waktu mundur perjalanan dinas menjadi <span class="label label-success">Aktif</span> ke <b>' + company + '</b>';
            }
            $('#blockModal').appendTo("body").modal('show');
            $('#blockinfo').html(msg);
            $('#blockModal').find("#success").off().click(function () {
                var url = "{{ route('admin.companies.change_perjalanan',':id') }}";
                url = url.replace(':id', id);

                $.easyAjax({
                    type: 'POST',
                    url: url,
                    data: {"id": id, 'perjalanan': perjalanan},
                    container: "#blockModal",
                    success: function (response) {
                        if (response.status === "success") {
                            $('#deleteModal').modal('hide');
                            table.fnDraw();
                        }
                    }
                });

            })

        }
</script> 
	  @else  
	  
	  @endif
@stop
