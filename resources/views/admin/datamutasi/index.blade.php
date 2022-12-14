@extends('admin.adminlayouts.adminlayout')

@section('head')
    <!-- BEGIN PAGE LEVEL STYLES -->
    {!! HTML::style("assets/global/plugins/select2/css/select2.css")!!}
    {!! HTML::style("assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css")!!}
    {!! HTML::style("assets/global/plugins/datatables/plugins/responsive/responsive.bootstrap.css")!!}
    <!-- END PAGE LEVEL STYLES -->

@stop


@section('mainarea')


    <!-- BEGIN PAGE HEADER-->
    <div class="page-head">
        <div class="page-title"><h1>
       Data Mutasi
            </h1></div>
    </div>
    <div class="page-bar">
        <ul class="page-breadcrumb breadcrumb">
            <li>
                <a onclick="loadView('{{ route('admin.dashboard.index') }}')">{{trans('core.dashboard')}}</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span class="active">Data Mutasi</span>
            </li>

        </ul>

    </div>   
<div class="row">
        <div class="col-md-12">

            <!-- BEGIN EXAMPLE TABLE PORTLET-->

            <div class="portlet light bordered">

                <div class="portlet-body">
                  <div class="table-toolbar">
                        <div class="row">
                            <div class="col-xs-6">
                                <div class="btn-group">
                            
                                </div>
                            </div>
                     <div class="col-xs-12">
					 
<?php 
$caricompanyid = $loggedAdmin->company_id;
$mutasimasuk = count(DB::select(DB::raw("SELECT * FROM employees WHERE company_id='".$caricompanyid."' AND mutasi='1'"))); 
$mutasikeluar = count(DB::select(DB::raw("SELECT * FROM employees WHERE darimutasi='".$caricompanyid."' AND mutasi='1'"))); 

?>


                               <div class="pull-left">
                          
                                    <a href="javascript:;" onclick="loadView('{{route('admin.datamutasi.terima')}}')"                 " class="btn purple">
<i class="fa fa-signout"></i> <span
                                   class="hidden-xs">Lihat Mutasi Masuk <span style="
    background: #136c08;
    padding: 0px 5px;
    border-radius: 3px !important;
">{{ $mutasimasuk }}</span></span>
</a>

                                  <a href="javascript:;" onclick="loadView('{{route('admin.mutasikeluar.index')}}')"                 " class="btn blue">
<i class="fa fa-signout"></i> <span
                                   class="hidden-xs">Lihat Mutasi Keluar <span style="
    background: #136c08;
    padding: 0px 5px;
    border-radius: 3px !important;
">{{ $mutasikeluar }}</span></span>
</a>
               </div>                           </div>
                        </div>
                    </div>

                         <table  class="table table-bordered">
                  <thead>
                    <tr>
              
                      <th>Nama</th>
                      <th>ASN/PHL</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
				  			<?php $countdatapeg=0; ?>
                    @foreach($tasks as $task)
					<?php $countdatapeg++; ?>
                    <tr>
			
					 @if ($task->designation == NULL)
                      <td >{{ $task->full_name }}</td>
				   	@else
						 <td style="background: #ecffed;">{{ $task->full_name }}</td>
						@endif
					
                      <td>
					  @if ($task->statusmupeg == "ASN")
						<span id="status2" class="label label-success" style="background-color: #e38213;">ASN</span>
						@else 
						<span id="status2" class="label label-success" style="background-color: #5a5a5a;">PHL</span>
							
						@endif
						  
					  </td>
                      <td>
					
						<a class="btn purple btn-sm margin-bottom-5" href="{{ route('admin.datamutasi.edit', $task->id) }}" ><i class="fa fa-exchange"></i><span class="hidden-sm hidden-xs"> Klik Mutasi </span></a>
				
					  </td>
                    </tr>
                    @endforeach

					@if ($countdatapeg == 0)
					 <tr>
					    <td colspan="3" style="    text-align: center;
    font-size: 16px;
    background: #f8f9e6;">Maaf tidak ada pegawai yang dapat di tampilkan atau di mutasi..!   </td>
		@endif
					</tr>
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
    {!! HTML::script("assets/global/plugins/datatables/plugins/responsive/dataTables.responsive.js")!!}
    {!! HTML::script("assets/global/plugins/datatables/plugins/responsive/responsive.bootstrap.js")!!}

 


    <!-- END PAGE LEVEL PLUGINS -->

  <script type="text/javascript">
  
       
  
  $(function () {
    $("#tableasds").DataTable();

    $( "#tablecontents" ).sortable({
      items: "tr",
      cursor: 'move',
      opacity: 0.6,
      update: function() {
          sendOrderToServer();
      }

    });

    function sendOrderToServer() {

      var order = [];
      $('tr.row1').each(function(index,element) {
        order.push({
          id: $(this).attr('data-id'),
          position: index+1
        });
      });

      $.ajax({
        type: "POST", 
        dataType: "json", 
   url: "{{ route('admin.datamutasi.index') }}",
 data: {
          order:order,
          _token: '{{csrf_token()}}'
        },
        success: function(response) {
            if (response.status == "success") {
              console.log(response);
            } else {
              console.log(response);
            }
        }
      });

    }
  });

</script>
@stop
