@extends('admin.adminlayouts.adminlayout')

@section('head')

    <!-- BEGIN PAGE LEVEL STYLES -->
    {!!  HTML::style('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css')!!}
    {!!  HTML::style('assets/global/plugins/bootstrap-datepickerabsen/css/bootstrap-datepickerabsen3.css')!!}
    {!!  HTML::style("assets/global/plugins/cropper/cropper.min.css")!!}
    <!-- END PAGE LEVEL STYLES -->
@stop


@section('mainarea')

		@if ($employee->mutasi == 0)
		@else
					
<script type="text/javascript">

    window.location.replace("../");
</script>
					
		@endif

		@if ($employee->designation == NULL)
		@else
					
<script type="text/javascript">

    window.location.replace("../");
</script>
					
		@endif
    <!-- BEGIN PAGE HEADER-->
    <div class="page-head">
        <div class="page-title"><h1>
         	@if ($employee->statusmupeg =="")
             Tarik Data Pegawai
		  @else
			 Tarik Data PHL
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
                <a onclick="loadView('{{route('admin.pegawaibaru.index')}}')">Index Data</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span class="active">      	@if ($employee->statusmupeg =="")
             Tarik Data Pegawai
		  @else
			 Tarik Data PHL
			  @endif</span>
            </li>
        </ul>
		
    </div>            <!-- END PAGE HEADER-->
	                 <div class="">
                          
                                    <a style="margin-bottom:10px;" href="javascript:;" onclick="loadView('{{route('admin.pegawaibaru.index')}}')"                 " class="btn blue">
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
                    <div class="actions">

                        <a href="javascript:;" onclick="UpdateDetails('{!! $employee->id !!}','personal')"

                           class="btn btn-sm btn-success ">
                            <i class="fa fa-save"></i> Simpan Informasi Pegawai  </a>
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
                            <label class="control-label col-md-3">{{trans('core.image')}}
                                {!! help_text("employeeImageSize") !!}
                            </label>

                            <div class="col-md-9">

                                <!-- Modal -->
                                <div class="modal fade" id="cropModal" aria-labelledby="modalLabel" role="dialog"
                                     tabindex="-1" data-backdrop="static">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="modalLabel">Crop Image</h4>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div>
                                                            <img id="cropImage" src="" alt="" style="max-height: 500px">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" id="cropButton" class="btn btn-primary"
                                                        data-dismiss="modal">Crop Selected
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-new thumbnail" style="width: 200px; height: 200px;">
                                        {!! HTML::image($employee->profile_image_url,'ProfileImage',['height'=>'80px', "id" => "imagePath"])!!}
                                        <input type="hidden" name="hiddenImage" value="{{$employee->profile_image}}">
                                    </div>

                                    <input type="hidden" value="" name="cropData" id="cropData"/>

                                    <div class="fileinput-preview fileinput-exists thumbnail" id="result"
                                         style="max-width: 200px; max-height: 200px;"></div>
                                    <div>
									<span class="btn default btn-file">
										<span class="fileinput-new">
											{{ trans('core.selectImage')}} </span>
										<span class="fileinput-exists">
											{{ trans('core.change')}} </span>
										<input type="file" id="picImage" name="profile_image">
									</span>
                                        <a href="#" class="btn red fileinput-exists" data-dismiss="fileinput">
                                            {{ trans('core.remove')}} </a>
                                    </div>
                                </div>
                                <div class="clearfix margin-top-10">
                                    {{--                                    {!! trans('messages.imageSizeLimit', ["size" => '872x724 pixels']) !!}--}}
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Nama Lengkap<span
                                        class="required">* </span></label>

                            <div class="col-md-9">
                                <input type="text" name="full_name" placeholder="Ketik Nama Lengkap" class="form-control" value="{{$employee->full_name}}">
                            </div>
                        </div>
                              <input type="hidden" name="father_name" class="form-control" value="kabbangai">

                        <div class="form-group">
                            <label class="control-label col-md-3">Tanggal Lahir</label>

                            <div class="col-md-3">
                                <div class="input-group input-medium date date-picker" data-date-format="dd-mm-yyyy"
                                     data-date-viewmode="years">
                                    <input type="text" class="form-control" name="date_of_birth" readonly
                                           value="@if(empty($employee->date_of_birth))@else{{date('d-m-Y',strtotime($employee->date_of_birth))}}@endif">
                                    <span class="input-group-btn">
									<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
								</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Kelamin</label>

                            <div class="col-md-9">
                                <select class="form-control" name="gender">

                                    <option value="male" @if($employee->gender=='male') selected @endif>Laki-Laki</option>
                                    <option value="female" @if($employee->gender=='female') selected @endif>Wanita
                                    </option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label">No. Hanphone</label>

                            <div class="col-md-9">
                                <input type="text" name="mobile_number"    placeholder="Ketik No HP"  class="form-control"
                                       value="{{$employee->mobile_number}}">
									     <span class="help-block">Kosongkan Jika tidak diperlukan</span>
                            </div>
                        </div>
              
                        <div class="form-group">
                            <label class="col-md-3 control-label">Alamat </label>

                            <div class="col-md-9">
							<textarea name="permanent_address" class="form-control"
                                      rows="3">{{$employee->permanent_address}}</textarea>
									   <span class="help-block">Kosongkan Jika tidak diperlukan</span>
                            </div>
                        </div>

     <div class="form-group">
                            <label class="col-md-3 control-label">No. Urut Pegawai
							<span
                                        class="required">* </span></label>
							</label>

                            <div class="col-md-9">
                                <input type="text" name="order"    placeholder="Ketik Angka Nomor Urut"  class="form-control dattanomors"
                                       value="{{$employee->order}}">
									     <span class="help-block">Urutan Pegawai</span>
                            </div>
                        </div>
                     <input type="hidden" name="email" class="form-control" value="pegawai{{$employee->id}}@banggaikab.go.id">
                                                      <input type="hidden" name="password" value="123456" class="form-control"> 
		
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
                    <div class="actions">
                        <a href="javascript:;"
                           onclick="UpdateDetails('{{$employee->id}}','company');return false"
                           class="btn btn-sm btn-success ">
                            <i class="fa fa-save"></i> Simpan Data Dinas/Badan  </a>
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
                         @if ($employee->statusmupeg =="")
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
	     	@if ($employee->statusmupeg =="PHL")
					   <input type="hidden" name="firstphl" value="1" class="form-control"> 
					@else
					   <input type="hidden" name="firstphl" value="0" class="form-control"> 
					@endif
						
					     		@if ($employee->statusmupeg =="")
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
                                       value="08-06-2022">
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

           
                      <hr>
                        <h4><strong>
						       	@if ($employee->statusmupeg =="") Jumlah TPP	@else Honorium PHL	@endif
						</strong></h4>
                        <div id="salaryData">
                            @foreach($employee->salaries as $salary)
							   @if(($salary->type=='basic'))
                                <div id="salary{{$salary->id}}">
                                    <div class="form-group">
                                        <div class="col-md-5">
                                            @if(($salary->type=='basic' || $salary->type=='hourly_rate'))
                                                <input type="hidden" class="form-control" name="type[{{$salary->id}}]"
                                                       value="{{$salary->type}}">
                                                <label class="control-label">@if ($employee->statusmupeg =="") Jumlah TPP	@else Jumlah Honor	@endif</label>
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
						
              <div style="padding:10px; margin-bottom:10px;   background-color: #f5f3d0;">

			  		   	@if ($employee->statusmupeg =="") 
			  Maaf tidak di temukan Nilai TPP Silahkan klik tombol di bawah
							@else 
				Maaf tidak di temukan Honorium Silahkan klik tombol di bawah
							
							@endif
			  </div>
						<a href="javascript: ;" onclick="showSalary({{$employee->id}})" class="btn green">
                                            <span class="hidden-xs">
											   	@if ($employee->statusmupeg =="") Tambahkan TPP 	@else Tambahkan Honor	@endif
											
											</span><i class="fa fa-plus"></i>
                                        </a>
				
                        </div>
						
						
						  @else
							  
						  @foreach($employee->salaries as $salary)
							   @if(($salary->type=='basic'))
                                <div id="salary{{$salary->id}}">
                                    <div class="form-group">
                                  

                                        <div class="col-md-5">
                                            <input type="hidden" class="form-control" name="salary[{{$salary->id}}]"
                                                   value="{{$salary->salary}}">
                                        </div>

                              
                                    </div>
                                </div>
							@endif
                            @endforeach
						  @endif
        
                    </div>
                    {!! Form::close()!!}


                    {{----------------Company Form end -------------}}

                </div>
            </div>

      
        </div>
    </div>
<style>
.bootstrap-switch.bootstrap-switch-animate .bootstrap-switch-container {
    -webkit-transition: margin-left .5s;
    height: 32px;
    transition: margin-left .5s;
}
</style>


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

            var url = "{{ route('admin.pegawaibaru.update',':id') }}";
            url = url.replace(':id', id);
            $.easyAjax({
                type: 'POST',
                url: url,
                container: form_id,
                file: true,
                   alertDiv: alert_div,
				        success: function (response) {
                    if (response.status == "success") {
              	location.reload(true);
				
                    }

                }
            });
        }

    </script>


@stop
