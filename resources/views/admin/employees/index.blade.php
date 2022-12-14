@extends('admin.adminlayouts.adminlayout')

@section('head')
    <!-- BEGIN PAGE LEVEL STYLES -->
    {!!  HTML::style("assets/global/plugins/select2/css/select2.css")!!}
    {!!  HTML::style("assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css")!!}
    {!!  HTML::style("assets/global/plugins/datatables/plugins/responsive/responsive.bootstrap.css")!!}
    <!-- END PAGE LEVEL STYLES -->

@stop


@section('mainarea')


    <div class="page-head">
        <div class="page-title"><h1>
         Data Pegawai ASN/PHL
            </h1></div>
    </div>
    <div class="page-bar">
        <ul class="page-breadcrumb breadcrumb">
            <li>
                <a onclick="loadView('{{ route('admin.dashboard.index') }}')">{{ trans('core.dashboard') }}</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span class="active">Pegawai ASN/PHL</span>

            </li>

        </ul>

    </div>
    <!-- END PAGE HEADER-->
    <!-- BEGIN PAGE CONTENT-->

    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->

            <div class="portlet light bordered">

                <div class="portlet-body">
                    <div class="table-toolbar">
                        <div class="row">
                            <div class="col-xs-6">
                                <div class="btn-group">
                                    {{--@if($canCreateEmployee)--}}
                                        <a href="javascript: ;" onclick="addEmployee()" class="btn green">
                                            <span class="hidden-xs"> Tambah Pegawai Baru (ASN) </span><i
                                                    class="fa fa-plus"></i>
                                        </a>
										
									
                                    {{--@endif--}}
									
									
									        {{--@if($canCreateEmployee)--}}
                                        <a style="margin-left:10px" href="javascript: ;" onclick="addEmployeePHL()" class="btn purple">
                                            <span class="hidden-xs"> Tambah Baru (PHL) </span><i
                                                    class="fa fa-plus"></i>
                                        </a>
										
									
                                    {{--@endif--}}
                                </div>
                            </div>
         
                        </div>
                    </div>

@if($totalpegawi == 0)
@else
<div class="note note-warning margin-top-15" style="font-size: 18px; ">
                            Terdapat ({{ $totalpegawi }}) data pegawai yang harus di tarik silahkan <a href="{{route('admin.pegawaibaru.index')}}">klik disini </a>
                            </div>
@endif
		<?php $hitungjumlah = $totalaktif-$carinojab; ?>

						
			@if($hitungjumlah != 0)		
				
			                <div class="note note-warning margin-top-15" style="font-size: 15px; ">
<h4>Data Pegawai yang tidak memiliki Bidang dan Jabatan</h4>

            <table style="background:#fff;" class="table table-striped table-bordered custom-table datatable dataTable no-footerr">

					  <thead>
                        <tr>
                            <th> Nama Pegawai </th>
                            <th> Jabatan </th>
        
                            <th> @lang('core.action')  </th>
                        </tr>
                        </thead>
                        <tbody>

@foreach ($pegawai as $row)
<?php $carinojab2 = count(DB::select(DB::raw("SELECT * FROM designation WHERE id='".$row->designation."' ")));?>
@if($carinojab2 ==0)	 
<tr role="row" class="odd" id="rowundefined">

<td class="sorting_1">{{ $row->full_name }}</td>
<td class="sorting_1">Belum Ada Jabatan</td>
<td>

<a class="btn purple btn-sm margin-bottom-5" href="{{ route('admin.tambahjabatan.edit', $row->iddata) }}" ><i class="fa fa-plus"></i><span class="hidden-sm hidden-xs"> Tambah Jabatan </span></a>
						
 
</td></tr>
@endif

@endforeach 
                        </tbody>
                    </table>
					</div>
@endif

                    <table style="border: 1px solid #c2cad8;" class="table table-striped table-bordered table-hover responsive hidden"
                           id="sample_employees">
                        <thead>
                        <tr>
                      <th style="text-align: center" class="all">
                           User ID
                            </th>
                            <th class="text-center min-tablet" style="width:80px;">
                              Foto
                            </th>
                             <th style="text-align: center" class="all">
                            Nama Lengkap
                            </th>
                            <th class="text-center min-desktop">
                                {{ trans('core.department') }}
                            </th>
                            <th class="text-center min-desktop">
                                {{ trans('core.designation') }}
                            </th>
                            <th class="text-center min-desktop">
                               Status
                            </th>

                            <th class="text-center min-desktop">
                            Keaktifkan
                            </th>
                            <th class="never">Created AT</th>
                            <th class="text-center min-tablet">
                                {{ trans('core.actions') }}
                            </th>
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

    <div id="empAddWarningModal" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">{{trans('core.confirmation')}}</h4>
                </div>
                <div class="modal-body" id="addEmployeeInfo">
                    <p>
                        {{ trans('messages.addNewEmployeeWarning') }}
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal"
                            class="btn dark btn-outline">{{trans('core.btnCancel')}}</button>
                    <a href="javascript: ;" onclick="confirmAddEmployee()" class="btn green">
                        <span class="hidden-xs"> {{ trans('core.btnConfirm') }} </span>
                    </a>
                </div>
            </div>
        </div>
    </div>

@stop


@section('footerjs')


    <!-- BEGIN PAGE LEVEL PLUGINS -->
    {!!  HTML::script("assets/global/plugins/select2/js/select2.min.js") !!}
    {!!  HTML::script("assets/global/plugins/datatables/datatables.min.js") !!}
    {!!  HTML::script("assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js") !!}
    {!! HTML::script("assets/global/plugins/datatables/plugins/responsive/dataTables.responsive.js")!!}
    {!! HTML::script("assets/global/plugins/datatables/plugins/responsive/responsive.bootstrap.js")!!}

    <!-- END PAGE LEVEL PLUGINS -->
    <script>
        var total = "{{ $total }}";
        // begin first table
        var table = $('#sample_employees').dataTable({
            {!! $datatabble_lang !!}
            processing: true,
            serverSide: true,
			  destroy: false,
		"oLanguage" : {
					"sEmptyTable" : "Tidak Di Temukan Pegawai"
				},
            "ajax": "{{ route("admin.ajax_employees") }}",
            "autoWidth": true,
            "aaSorting": [[0, "desc"]],
            columns: [
			{data: 'uid', name: 'uid', "bSortable": true},
            {data: 'profile_image', name: 'profile_image', "bSortable": false, "searchable": false},

				{data: 'full_name', name: 'full_name', "bSortable": true},
 
                {data: 'name', name: 'name', "bSortable": true},
                {data: 'designation', name: 'designation', "bSortable": true},
                {data: 'statusmupeg', name: 'statusmupeg', "bSortable": false},
                {data: 'status', name: 'status', "bSortable": true},
                {data: 'created_at', name: 'created_at', "bSortable": false, width: "150px"},
                {data: 'edit', name: 'edit', "bSortable": false},
            ],

            "lengthMenu": [
                [5, 15, 20, -1],
                [5, 15, 20, "All"] // change per page values here
            ],
            // set the initial value
            "pageLength": 15,
            "sPaginationType": "full_numbers",
            "columnDefs": [{  // set default column settings
                'orderable': false,
                'targets': [0]
            }, {  // set default column settings
                'targets': [7],
                "visible": false,
                "searchable": false
            }
            ],
            "fnInitComplete": function () {
                $(".dataTables_length").addClass("hidden-xs");
                $(this).removeClass("hidden");
            },
            "order": [
                [7, "DESC"]
            ]
        });


        function del(id, name) {

            $('#deleteModal').modal('show');

            var confirmMsg = '{!! trans('messages.deleteConfirm', ["name" => ":name"]) !!}';
            confirmMsg = confirmMsg.replace(":name", name);

            $("#deleteModal").find('#info').html(confirmMsg);

            $('#deleteModal').find("#delete").off().click(function () {

                var url = "{{ route('admin.employees.destroy',':id') }}";
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

            });
        }


        function addEmployee() {
            var planUser = '{{ admin()->company->subscriptionPlan->end_user_count }}';
            if ( parseInt(planUser) >= parseInt(total) ) {
                loadView('{{route('admin.employees.create') }}')

            } else {
                $('#empAddWarningModal').modal('show');
            }
        }
		
		        function addEmployeePHL() {
            var planUser = '{{ admin()->company->subscriptionPlan->end_user_count }}';
            if ( parseInt(planUser) >= parseInt(total) ) {
                loadView('{{route('admin.pegawaibaru.create') }}')

            } else {
                $('#empAddWarningModal').modal('show');
            }
        }

        function confirmAddEmployee() {
            $('#empAddWarningModal').modal('hide');
            loadView('{{route('admin.billing.change_plan') }}');
        }

    </script>
@stop
