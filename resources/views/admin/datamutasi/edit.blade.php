@extends('admin.adminlayouts.adminlayout')

@section('head')

    <!-- BEGIN PAGE LEVEL STYLES -->
    {!!  HTML::style('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css')!!}
    {!!  HTML::style('assets/global/plugins/bootstrap-datepickerabsen/css/bootstrap-datepickerabsen3.css')!!}
    {!!  HTML::style("assets/global/plugins/cropper/cropper.min.css")!!}
    <!-- END PAGE LEVEL STYLES -->
@stop


@section('mainarea')
		@if ($employee->designation == NULL)
			<script type="text/javascript">

    window.location.replace("../../employees");
</script>
		@else
					

					
		@endif
    <!-- BEGIN PAGE HEADER-->
    <div class="page-head">
        <div class="page-title"><h1>
         	@if ($employee->statusmupeg =="ASN")
       	 Data Mutasi Pegawai
		  @else
		   	 Data Mutasi PHL
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
                <a onclick="loadView('{{route('admin.datamutasi.index')}}')">Index Data</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span class="active">      	@if ($employee->statusmupeg =="ASN")
       	 Data Mutasi Pegawai
		  @else
			 Data Mutasi PHL
			  @endif</span>
            </li>
        </ul>
		
    </div>            <!-- END PAGE HEADER-->
	                 <div class="">
                          
                                    <a style="margin-bottom:10px;" href="javascript:;" onclick="loadView('{{route('admin.datamutasi.index')}}')"                 " class="btn blue">
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
					   <input type="hidden" name="mutasi" value="1" class="form-control"> 
                           	   <input type="hidden" name="designation" value="" class="form-control"> 
						 <input type="hidden" name="darimutasi" value="{{ $employee->company_id}}" class="form-control"> 
				<div class="note note-warning margin-top-15" style="font-size: 15px; ">
   Silahkan Melakukan Mutasi, Pilih salah satu OPD Tujuan Mutasi untuk Nama Bidang dan Jabatan akan di tentukan oleh OPD yang bersangkutan
                            </div>
								 	 <div class="form-group">
                            <label class="col-md-3 control-label">Pilih Dinas<span
                                        class="required">* </span></label>

                            <div class="col-md-9">

    
                               <select class="form-control select2me" name="company_id">
      <option selected disabled>Silahkan Pilih OPD</option>
@foreach ($namaopd as $data)
@if($employee->company_id != $data->id)
      <option value="{{ $data->id }}" >{{ $data->company_name }}</option>
  @endif
                    	 @endforeach           
                                </select>
                            </div>
                        </div>
					
					
                       
        
                    </div>
                    {!! Form::close()!!}
<hr>
  <div class="actions" style="text-align: center;">
                        <a href="javascript:;"
                           onclick="UpdateDetails('{{$employee->id}}','company');return false"
                           class="btn btn-lg btn-success ">
                            <i class="fa fa-exchange"></i> Lanjutkan Mutasi Pegawai </a>
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
	      $.fn.select2.defaults.set("theme", "bootstrap");
        $('.select2me').select2({
            placeholder: "Select",
            width: '100%',
            allowClear: false
        });
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

            var url = "{{ route('admin.datamutasi.update',':id') }}";
            url = url.replace(':id', id);
            $.easyAjax({
                type: 'POST',
                url: url,
                container: form_id,
                file: true,
                   alertDiv: alert_div,
				        success: function (response) {
                    if (response.status == "success") {
             window.location.replace("../../employees");
				
                    }

                }
            });
        }

    </script>


@stop
