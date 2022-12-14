@extends('admin.adminlayouts.adminlayout')

@section('head')

    <!-- BEGIN PAGE LEVEL STYLES -->
    {!!  HTML::style('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css')!!}
    {!!  HTML::style('assets/global/plugins/bootstrap-datepickerabsen/css/bootstrap-datepickerabsen3.css')!!}
    {!!  HTML::style("assets/global/plugins/cropper/cropper.min.css")!!}
    <!-- END PAGE LEVEL STYLES -->
@stop


@section('mainarea')
<?php 
$caricompanyid = $loggedAdmin->company_id;
$mutasikeluar = count(DB::select(DB::raw("SELECT * FROM employees WHERE darimutasi='".$caricompanyid."' AND id='".$idget."' AND mutasi='1'"))); 

?>

@if ($mutasikeluar == 0)
	<script type="text/javascript">

    window.location.replace("error");
</script>
@endif
      @foreach($employeed as $employee)


    <!-- BEGIN PAGE HEADER-->
    <div class="page-head">
        <div class="page-title"><h1>
       Form Batalkan Mutasi
            </h1></div>
    </div>
    <div class="page-bar">
        <ul class="page-breadcrumb breadcrumb">
            <li>
                <a onclick="loadView('{{route('admin.dashboard.index')}}')">{{trans('core.dashboard')}}</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <a onclick="loadView('{{route('admin.mutasikeluar.index')}}')">Index Data</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span class="active"> Form Batalkan Mutasi</span>
            </li>
        </ul>
		
    </div>            <!-- END PAGE HEADER-->
	                 <div class="">
                          
                                    <a style="margin-bottom:10px;" href="javascript:;" onclick="loadView('{{route('admin.mutasikeluar.index')}}')"                 " class="btn blue">
<i class="fa fa-reply"></i> <span
                                   class="hidden-xs">Kembali Ke Index</span>
</a>
               </div>
    <div class="row ">
	  <div class="col-md-6 col-sm-6">
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-purple-wisteria">
                        <i class="fa fa-user font-purple-wisteria"></i>{{trans('core.personalDetails')}}
                    </div>
       
                </div>


                <div class="portlet-body">


                    {{--------------------Personal Info Form--------------------------------------------}}

                    {!!  Form::open(['method' => 'PUT','class'   =>  'form-horizontal','id'  =>  'personal_details_form','files'=>true])!!}

                    <input type="hidden" name="updateType" class="form-control" value="personalInfo">


                    @if (Session::get('errorPersonal'))

                        <div class="alert alert-danger alert-dismissable ">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                            @foreach (Session::get('errorPersonal') as $error)
                                <p><strong><i class="fa fa-warning"></i></strong> {!!  $error !!}</p>
                            @endforeach
                        </div>
                    @endif


                    <div class="form-body">
                
                    <div class="form-group">
                            <label class="col-md-3 control-label">Nama Lengkap :</label>

                            <div class="col-md-9" style="    margin-top: 8px;">
      {{$employee->full_name}}
                            </div>
                        </div>
										@if ($employee->statusmupeg =="ASN")
						<div class="form-group">
                            <label class="col-md-3 control-label">{{trans('core.employeeID')}} :</label>

                            <div class="col-md-9" style="    margin-top: 8px;">
                       {{ $employee->employeeID }}
                            </div>
                        </div>
		 @else

		@endif
                        
                        <div class="form-group">
                            <label class="control-label col-md-3">Tanggal Lahir :</label>

                            <div class="col-md-9" style="    margin-top: 8px;">
                        @if(empty($employee->date_of_birth))Tidak di isi @else{{date('d-m-Y',strtotime($employee->date_of_birth))}}@endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Kelamin :</label>

                            <div class="col-md-9" style="    margin-top: 8px;">
        
					    @if($employee->gender=='male') Laki-Laki @endif
					@if($employee->gender=='female') Wanita @endif
                            </div>
                        </div>

                      <div class="form-group">
                            <label class="col-md-3 control-label">No. Hanphone :</label>

                            <div class="col-md-9" style="    margin-top: 8px;">

	@if($employee->mobile_number==NULL) - @else {{$employee->mobile_number}} @endif
                            </div>
                        </div>
              
                        <div class="form-group">
                            <label class="col-md-3 control-label">Alamat Lengkap :</label>

                            <div class="col-md-9" style="    margin-top: 8px;">
	
									   	@if($employee->permanent_address==NULL) - @else {{$employee->permanent_address}} @endif
                            </div>
                        </div>
	

                     
						   			  <div class="form-group">
                            <label class="col-md-3 control-label">Status :</label>

                            <div class="col-md-9" style="    margin-top: 8px;">
							{{ $employee->statusmupeg}}
                            </div>
                        </div>
	     	
						
					     		@if ($employee->statusmupeg =="ASN")
            	 <div class="form-group">
                            <label class="col-md-3 control-label">Golongan :</label>

                            <div class="col-md-9" style="    margin-top: 8px;">
				
							
							@foreach ($golonganpeg as $data)
@if($employee->golongan==$data->id) {{ $data->golonganPeg }} @endif
							@endforeach
                            </div>
                        </div>
		 @else

		@endif
						
						
						


                   
         
                        <div class="form-group">
                            <label class="control-label col-md-3">Keaktifkan :</label>

                            <div class="col-md-9" style="    margin-top: 8px;">
					@if($employee->status=='active') Aktif @endif
					@if($employee->status=='inactive') NonAktif @endif
                         
                            </div>
                        </div>

               
              
            
   </div>
                    {!! Form::close()!!}
                </div>
            </div>
        </div>


        <div class="col-md-6 col-sm-6">
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-red-sunglo">
                        <i class="fa fa-industry font-red-sunglo"></i>{{trans('core.companyDetails')}}
                    </div>
          
                </div>
                <div class="portlet-body">

                  {!! Form::open(['method' => 'PUT','class'   =>  'form-horizontal','id'  =>  'companydata_details_form']) !!}

                    <input type="hidden" name="updateType" class="form-control" value="companydata">

                    <div id="alert_company">
                        {{--INLCUDE ERROR MESSAGE BOX--}}

                        {{--END ERROR MESSAGE BOX--}}
                    </div>

                    <div class="form-body">
                <div class="note note-warning margin-top-15" style="font-size: 15px; ">
  Apakah anda yakin ingin membatalkan mutasi pegawai dengan nama : <b>{{ $employee->full_name }}</b> dengan tujuan mutasi :
  <b>{{ $employee->company_name }}</b>, Jika anda tetap melanjutkan pemabatalan mutasi harap melengkapi form di bawah ini, silahkan pilih Bidang dan Jabatan. 
                            </div>
                <input type="hidden" name="company_id" class="form-control" value="{{ $employee->darimutasi }}">
                <input type="hidden" name="darimutasi" class="form-control" value="0">

                <input type="hidden" name="mutasi" class="form-control" value="0">

       <div class="form-group">
          <label class="col-md-3 control-label">{{trans('core.department')}}<span
                                        class="required">* </span></label>

                            <div class="col-md-9">
                          <select class="form-control select2me" id="department" onchange="dept();return false;" name="department">
			@if ($employee->designation == NULL)
					@foreach ($departmentno as $data)
                 	 <option value="{{ $data->id }}" >{{ $data->name }}</option>
					@endforeach 
					
				@else
					
					@foreach ($departmentno as $data)
                 	 <option value="{{ $data->id }}" @if($designation->department_id==$data->id) selected @endif>{{ $data->name }}</option>
					@endforeach 
					
					@endif
						
						  </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">{{trans('core.designation')}}<span
                                        class="required">* </span></label>

                            <div class="col-md-9">

                                <select class="select2me form-control" name="designation" id="designation">

                                </select>
                            </div>
                        </div>
        
                    </div>
                    {!! Form::close()!!}
<hr>
      <div class="actions" style="text-align: center;">
                        <a href="javascript:;"
                           onclick="UpdateDetails('{{$employee->id}}','companydata');return false"
                           class="btn btn-lg btn-success ">
                            <i class="fa fa-save"></i> Lanjutkan Pembatalan </a>
                    </div>

                </div>
            </div>

      
        </div>
		   
    </div>


@stop



@section('footerjs')


    <!-- BEGIN PAGE LEVEL PLUGINS -->
    {!! HTML::script('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js')!!}
    {!! HTML::script("assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js")!!}
    {!! HTML::script('assets/global/plugins/bootstrap-datepickerabsen/js/bootstrap-datepickerabsen.js')!!}
    {!! HTML::script('assets/admin/pages/scripts/components-pickersabsen.js')!!}
    {!! HTML::script("assets/global/plugins/cropper/cropper.min.js")!!}

    <!-- END PAGE LEVEL PLUGINS -->




  

    <script>
        jQuery(document).ready(function () {
            ComponentsPickers.init();
            dept();
        });


        function dept() {

            $.getJSON("{{ route('admin.departments.ajax_designation')}}",
                {department_id: $('#department').val()},
                function (data) {
                    var model = $('#designation');
                    model.empty();
                    var selected = '';
                    var match = '{{ $employee->designation}}';
                    $.each(data, function (index, element) {
                        if (element.id == match) selected = 'selected';
                        else selected = '';
                        model.append("<option value='" + element.id + "' " + selected + ">" + element.designation + "</option>");
                    });

                });


        }
        // Javascript function to update the company info and Bank Info
        function UpdateDetails(id, type) {

            var form_id = '#' + type + '_details_form';
            var alert_div = '#' + type + '_alert';

            var url = "{{ route('admin.mutasikeluar.update',':id') }}";
            url = url.replace(':id', id);
            $.easyAjax({
                type: 'POST',
                url: url,
                container: form_id,
                file: true,
                   alertDiv: alert_div,
				        success: function (response) {
                    if (response.status == "success") {
              	window.location.replace("../../mutasikeluar");
				
                    }

                }
            });
        }



    </script>
 @endforeach

@stop
