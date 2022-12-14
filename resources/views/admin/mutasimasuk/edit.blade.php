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
$idget = $employee->id;
$mutasimasuk = count(DB::select(DB::raw("SELECT * FROM employees WHERE company_id='".$caricompanyid."' AND id='".$idget."' AND mutasi='1'"))); 

?>
		@if ($mutasimasuk == 0)
	
					
<script type="text/javascript">

    window.location.replace("../../datamutasi/terima");
</script>
					
		@endif
		@if ($employee->designation == NULL)
		@else
					
<script type="text/javascript">

    window.location.replace("../../datamutasi/terima");
</script>
					
		@endif
		
		
		@if ($employee->company_id == $loggedAdmin->company_id)
		@else
					
<script type="text/javascript">

    window.location.replace("../../datamutasi/terima");
</script>
					
		@endif
    <!-- BEGIN PAGE HEADER-->
    <div class="page-head">
        <div class="page-title"><h1>
         	@if ($employee->statusmupeg =="ASN")
             Data Mutasi Masuk Pegawai
		  @else
				Data Mutasi Masuk PHL
			  @endif
            </h1></div>
    </div>
    <div class="page-bar">
        <ul class="page-breadcrumb breadcrumb">
            <li>
                <a onclick="loadView('{{route('admin.dashboard.index')}}')">{{trans('core.dashboard')}}</a>
                <i class="fa fa-circle"></i>
            </li>
     
            <li>
                <span class="active">      	@if ($employee->statusmupeg =="ASN")
                  Data Mutasi Masuk Pegawai 
		  @else
			Data Mutasi Masuk PHL 
			  @endif</span>
            </li>
        </ul>
		
    </div>            <!-- END PAGE HEADER-->
	                 <div class="">
                          
                                    <a style="margin-bottom:10px;" href="javascript:;" onclick="loadView('{{route('admin.datamutasi.terima')}}')"                 " class="btn blue">
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
                        <div class="form-group ">
                            <label class="control-label col-md-3">Foto / Gambar :
                                
                            </label>

                            <div class="col-md-9">

              


                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-new thumbnail" style="width: 200px; height: 100%;">
                                        {!! HTML::image($employee->profile_image_url,'ProfileImage',['height'=>'80px', "id" => "imagePath"])!!}
                                        <input type="hidden" name="hiddenImage" value="{{$employee->profile_image}}">
                                    </div>

                                    </div>
                                </div>
                            
                         
                        </div>
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

                  	@if ($employee->statusmupeg =="ASN")
                    <div class="form-group">
                            <label class="control-label col-md-3">Jumlah TPP :</label>
     <div class="col-md-9" style="    margin-top: 8px;">
                            @foreach($employee->salaries as $salary)
							   @if(($salary->type=='basic'))
                                {{$salary->salary}}
								      @endif
                            @endforeach
							
										<?php $caritpp = count(DB::select(DB::raw("SELECT * FROM salary WHERE employee_id='".$employee->id."' ")));?>

						@if($caritpp == 0)
						
						Tidak di isi
						@endif
                           </div>
                        </div>
						
						  @else
							 
						  @endif
              
            
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

                    {{--------------------Company Form--------------------------------------------}}
                    {!! Form::open(['method' => 'PUT','class'   =>  'form-horizontal','id'  =>  'company_details_form']) !!}

                    <input type="hidden" name="updateType" class="form-control" value="company">

                    <div id="alert_company">
                        {{--INLCUDE ERROR MESSAGE BOX--}}

                        {{--END ERROR MESSAGE BOX--}}
                    </div>

                    <div class="form-body">
					
					                 <input type="hidden" name="mutasi" class="form-control" value="0">
									   
									        <input type="hidden" name="darimutasi" class="form-control" value="0">
									        <input type="hidden" name="company_id" class="form-control" value="{{ $loggedAdmin->company_id }}">
                         @if ($employee->statusmupeg =="ASN")
						<div class="form-group">
                            <label class="col-md-3 control-label">{{trans('core.employeeID')}}<span
                                        class="required">* </span></label>

                            <div class="col-md-9">
                                <input type="text" name="employeeID" class="form-control dattanomors"
                                       value="{{ $employee->employeeID }}">
                            </div>
                        </div>
@else
			 <?php

$data = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
$random = rand(1234567890, strlen($data));

?>
		 <input type="hidden" name="employeeID" class="form-control"
                                       value="{{ $random }}">
		@endif
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
						   			  <div class="form-group">
                            <label class="col-md-3 control-label">Status</label>

                            <div class="col-md-9">
                                <select class="form-control" name="statusmupeg">

                                    <option value="ASN" @if($employee->statusmupeg=='') selected @endif>ASN</option>
                                    <option value="PHL" @if($employee->statusmupeg=='PHL') selected @endif>PHL
                                    </option>
                                </select>
                            </div>
                        </div>
						
						
						
						
						
					@if($loggedAdmin->company->datashift==1)
		@if ($employee->statusmupeg == "ASN")
<?php $datashift = "Pegawai"; ?>	
 @else	
	 <?php $datashift = "PHL"; ?>
@endif 
						<div class="form-group">
                            <label class="col-md-3 control-label">{{ $datashift }} Shift<span
                                        class="required">* </span></label>

                            <div class="col-md-9">

                                   <select class="form-control" name="shift">
            <option selected disabled>Pilih Jenis {{ $datashift }} Shift</option>
         
                                    <option value="1" >YA</option>
                                    <option value="0" >TIDAK</option>
                            
                                </select>
								<small>Jika Anda Memilih YA berarti {{ $datashift }} masuk dalam kategori shift</small>
                            </div>
                        </div>	
						@else
						<input type="hidden" name="shift" class="form-control" value="0">
						@endif		
						
						
						
						
						
	     	@if ($employee->statusmupeg =="PHL")
					   <input type="hidden" name="firstphl" value="1" class="form-control"> 
					@else
					   <input type="hidden" name="firstphl" value="0" class="form-control"> 
					@endif
						
					     		@if ($employee->statusmupeg =="ASN")
            	 <div class="form-group">
                            <label class="col-md-3 control-label">Golongan<span
                                        class="required">* </span></label>

                            <div class="col-md-9">

                                   <select class="form-control" name="golongan">
@foreach ($golonganpeg as $data)
                                    <option value="{{ $data->id }}" @if($employee->golongan==$data->id) selected @endif>{{ $data->golonganPeg }}</option>
                    	 @endforeach           
                                </select>
                            </div>
                        </div>
		 @else
		 <input type="hidden" name="golongan" class="form-control" value="15">
		@endif
						
						
						
                  <div class="form-group" style="display:none">
                            <label class="col-md-3 control-label">{{trans('core.annualOrCredit')}} {!! help_text("creditLeaves") !!}</label>

                            <div class="col-md-9">
                                <input type="text" name="annual_leave" class="form-control"
                                       value="0">
                            </div>
                        </div>

                        <div class="form-group" style="display:none">
                            <label class="control-label col-md-3">{{trans('core.dateOfJoining')}}</label>

                            <div class="col-md-3">
                                <div class="input-group input-medium date date-picker" data-date-format="dd-mm-yyyy"
                                     data-date-viewmode="years">
   <input type="text" name="annual_leave" class="form-control"
                                       value="0">
                                    <span class="input-group-btn">
									<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
								</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group" style="display:none">
                            <label class="control-label col-md-3">{{trans('core.exitDate')}} {!! help_text("exitDate") !!}</label>

                            <div class="col-md-3">
                                <div class="input-group input-medium date date-picker" data-date-format="dd-mm-yyyy"
                                     data-date-viewmode="years">
                                    <input type="text" class="form-control" name="exit_date" readonly
                                           value="@if(empty($employee->exit_date)) @else {{date('d-m-Y',strtotime($employee->exit_date))}} @endif">
                                    <span class="input-group-btn">
									<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
								</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Keaktifkan</label>

                            <div class="col-md-9">
                                <input type="checkbox" value="active" onchange="remove_exit();" class="make-switch"
                                       name="status" @if($employee->status=='active')checked
                                       @endif data-on-color="success"
                                       data-on-text="Aktif" data-off-text="NonAktif" data-off-color="danger">
                                <span class="help-block">
							Jika di Nonaktifkan Pegawai tidak akan tampil
							</span>
                            </div>
                        </div>

     <?php
	if($employee->statusmupeg =="ASN") {

	$namdataed = "TPP";	
	} else {
		$namdataed = "Honorium";

	}
	?>
                     
        		
                      <hr>
                        <h4><strong>Jumlah {{ $namdataed }}</strong></h4>
                        <div id="salaryData">
						
						
						
                            @foreach($employee->salaries as $salary)

							   @if(($salary->type=='basic'))

							   
                                <div id="salary{{$salary->id}}">
                                    <div class="form-group">
                                        <div class="col-md-5">
                                            @if(($salary->type=='basic' || $salary->type=='hourly_rate'))
                                                <input type="hidden" class="form-control" name="type[{{$salary->id}}]"
                                                       value="{{$salary->type}}">
                                                <label class="control-label">Jumlah {{ $namdataed }}</label>
                                            @else
                                                <input type="text" class="form-control" name="type[{{$salary->id}}]"
                                                       value="{{$salary->type}}">
                                            @endif
                                        </div>

                                        <div class="col-md-5">
                                            <input type="text" class="form-control" name="salary[{{$salary->id}}]"
                                                   value="{{$salary->salary}}">
                                        </div>

                              
                                    </div>
                                </div>
								      @endif
                            @endforeach
						<?php $caritpp = count(DB::select(DB::raw("SELECT * FROM salary WHERE employee_id='".$employee->id."' ")));?>

						@if($caritpp == 0)
						
              <div style="padding:10px; margin-bottom:10px;   background-color: #f5f3d0;">Maaf tidak di temukan Nilai {{ $namdataed }} Silahkan klik tombol di bawah</div>
						<a href="javascript: ;" onclick="showSalary({{$employee->id}})" class="btn green">
                                            <span class="hidden-xs">Tambahkan {{ $namdataed }} </span><i class="fa fa-plus"></i>
                                        </a>
						@endif
                        </div>
        
                    </div>
                    {!! Form::close()!!}
<hr>
                    <div class="actions" style="text-align:center;margin-top:10px;">
                        <a href="javascript:;"
                           onclick="UpdateDetails('{{$employee->id}}','company');return false"
                           class="btn btn-lg btn-primary ">
                            <i class="fa fa-save"></i> Lanjutkan Terima Mutasi </a>
                    </div>
                    {{----------------Company Form end -------------}}

                </div>
            </div>

      
        </div>
    </div>



    @include('admin.common.show-modal')
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
	
		restrictChars('.restrict-numbers-only', '1234567890');
restrictChars('.dattanomors', '1234567890');
restrictChars('.restrict-lowercase', 'abcdefghijklmnopqrstuvwxyz');
restrictChars('.restrict-uppercase', 'ABCDEFGHIJKLMNOPQRSTUVWXYZ');
restrictChars('.restrict-uppercase-and-lowercase', 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz');
restrictChars('.restrict-numbers-uppercase-lowercase-spaces', '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz ');

function restrictChars(selector, allowedChars) {
  $(selector).on('keypress', function (event) {
    const chr = String.fromCharCode(event.which);
    if (allowedChars.indexOf(chr) < 0) {
      return false;
    }
  });

  $(selector).on('keydown keyup change', function (event) {
    let val = $(this).val();
    let pattern = '[^' + allowedChars + ']';
    let regexp = new RegExp(pattern, 'g');
    $(this).val($(this).val().replace(regexp, ''));
  });
}
	
	
	
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


        // Add New Salary
        function saveSalary(id) {
            var url = "{{ route('admin.salary.store') }}";
            url = url.replace(':id', id);
            $.easyAjax({
                type: 'POST',
                url: url,
                container: '#save_salary',
                data: $('#save_salary').serialize(),
                success: function (response) {
                    if (response.status == "success") {
                        $('#showModal').modal('hide');
                        $('#salaryData').append(response.viewData);
							    window.location.reload();
                    }
                }
            });
        }

        // Show Salary Modal
        function showSalary(id) {
            $('#showModal .modal-dialog').removeClass("modal-md").addClass("modal-lg");
            var url = "{{ route('admin.add-salary-modal',[':id']) }}";
            url = url.replace(':id', id);
            $.ajaxModal('#showModal', url);
            $('#showModal_div').removeClass("modal-dialog modal-lg").addClass("modal-dialog modal-md");
        }

        // Show Delete Modal and delete salary
        function del(id, type) {

            $('#deleteModal').modal('show');

            $("#deleteModal").find('#info').html('Apakah anda yakin ingin menghapus <strong>' + type + '</strong> Salary?.');

            $('#deleteModal').find("#delete").off().click(function () {

                var url = "{{ route('admin.salary.destroy',':id') }}";
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
                            $('#salary' + id).remove();
                        }
                    }
                });

            });
        }


        function remove_exit() {
            if ($("input[name=status]:checked").val() == "active") {
                $("input[name=exit_date]").val("");
            }
        }


        $("input[name=exit_date]").change(function () {
            $("input[name=status]").bootstrapSwitch('state', false);

        });
    </script>

    <script>
        $(function () {

            var $previews = $('.preview');

            $('#cropModal').on('shown.bs.modal', function () {
                var $image = $('#cropImage');
                var $button = $('#cropButton');
                var $result = $('#result');
                var croppable = false;

                $image.cropper({
                    aspectRatio: 1,
                    viewMode: 2,
                    guides: false,
                    zoomable: false,
                    zoomOnTouch: false,
                    zoomOnWheel: false,
                    build: function () {
                        croppable = true;
                    }
                });

                $button.on('click', function () {
                    var croppedCanvas;
                    var roundedCanvas;

                    if (!croppable) {
                        return;
                    }

                    // Crop
                    croppedCanvas = $image.cropper('getCroppedCanvas');

                    // Show
                    $result.html('<img src="' + croppedCanvas.toDataURL() + '">');
                });

            }).on('hidden.bs.modal', function () {
                var $image = $('#cropImage');
                cropBoxData = $image.cropper('getData');
                canvasData = $image.cropper('getCanvasData');
                $image.cropper('destroy');
                $("#cropData").val(JSON.stringify(cropBoxData));
            });
        });

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#cropModal').modal('show');
                    $('#cropImage').attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#picImage").change(function () {
            readURL(this);
        });

        // Javascript function to update the company info and Bank Info
        function UpdateDetails(id, type) {

            var form_id = '#' + type + '_details_form';
            var alert_div = '#' + type + '_alert';

            var url = "{{ route('admin.mutasimasuk.update',':id') }}";
            url = url.replace(':id', id);
            $.easyAjax({
                type: 'POST',
                url: url,
                container: form_id,
                file: true,
                   alertDiv: alert_div,
				        success: function (response) {
                    if (response.status == "success") {
         	window.location.replace("../../datamutasi/terima");
				
                    }

                }
            });
        }

    </script>


@stop
