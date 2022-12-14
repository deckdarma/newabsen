@extends('admin.adminlayouts.adminlayout')

@section('head')
    <!-- BEGIN PAGE LEVEL STYLES -->

    {!! HTML::style("assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css") !!}
    <!-- END PAGE LEVEL STYLES -->

{!! HTML::style('front_assets/plugins/sky-forms/version-2.0.1/css/custom-sky-forms.css') !!}
    {!! HTML::style("assets/global/plugins/select2/css/select2.css")!!}
    {!! HTML::style("assets/global/plugins/select2/css/select2-bootstrap.min.css")!!}

    <!-- BEGIN THEME STYLES -->

@stop


@section('mainarea')
  @if(admin()->unikid =='0')

	<script type="text/javascript">

    window.location.replace("../error");
</script> 
	  @else 
 

    <!-- BEGIN PAGE HEADER-->
    <div class="page-head">
        <div class="page-title"><h1>
             Form Buat Keterangan
            </h1></div>
    </div>
    <div class="page-bar">
        <ul class="page-breadcrumb breadcrumb">
            <li>
                <a onclick="loadView('{{route('admin.dashboard.index')}}')">{{trans('core.dashboard')}}</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <a onclick="loadView('{{ route('admin.leave_applicationsadmin.index') }}')">Data Keterangan</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span class="active">Form Buat Keterangan</span>
            </li>

        </ul>

    </div>
    <!-- END PAGE HEADER-->

    <!-- BEGIN PAGE CONTENT-->
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->

            {{--INLCUDE ERROR MESSAGE BOX--}}

            {{--END ERROR MESSAGE BOX--}}


            <div class="portlet light bordered">
                        <div class="portlet-title">
                    <div class="caption font-blue">
                        <i class="fa fa-plus font-blue"></i> Form Buat Keterangan
                    </div>
        
                </div>
                <div class="portlet-body form">
            {!! Form::open(array('class'=>'form-horizontal ','method'=>'POST','id'=>'leave_type_update_form')) !!}
            <div class="modal-body">
                <div class="portlet-body form">
                    <!-- BEGIN FORM-->
                    <div class="form-body">
					  <div class="form-group">
					  	     <input type="hidden" name="days" id="days" value="0">
                    <input type="hidden" name="leaveformType" id="leaveformType" value="date_range">
                    <input type="hidden" name="createby"  value="1">
                            <label class="col-md-4 control-label">NAMA OPD
                                <span
                                        class="required">
                                         </span>
                                </span>
                            </label>

                            <div class="col-md-6">
                         <select name="company_id" class="form-control select2me" >
     <option selected disabled>Pilih OPD Pegawai</option>
     @foreach($namaopd as $dataop)
     <option value="{{ $dataop->id}}">{{ $dataop->company_name }}</option>
     @endforeach
    </select>
                                <span class="help-block"></span>
                            </div>
                        </div>
					
					
                        <div class="form-group">
				
			


	
						
						
                            <label class="col-md-4 control-label">Nama Pegawai<span
                                        class="required">
                                        * </span>
                            </label>

                            <div class="col-md-6">
                                   <select class="form-control select2me" id="employee_id" name="employee_id">
						   <option selected disabled>Silahkan Pilih Pegawai</option>
                @foreach($employees as $employee)
                                            <option value="{{$employee->id}}">{{$employee->full_name}} ({{ $employee->statusmupeg }})</option>
                                     
									 @endforeach
            </select>
                                <span class="help-block"></span>
                            </div>
                        </div>
						
						              <div class="form-group">
                            <label class="col-md-4 control-label">Nomor/Surat
                                <span
                                        class="required">
                                         </span>
                                </span>
                            </label>

                            <div class="col-md-6">
                                             <input class="form-control " type="text" name="no_surat" id="no_surat"
                                           placeholder="Ketik Nomor Surat">
										     <small>Dapat di kosongkan</small>
                                <span class="help-block"></span>
                            </div>
                        </div>
						
						
						

                        <div class="form-group">
                            <label class="col-md-4 control-label">Tanggal Mulai
                                <span
                                        class="required">
                                        * </span>
                                </span>
                            </label>

                            <div class="col-md-6">
                                             <input class="form-control" type="text" name="start_date" id="start_date"
                                           placeholder="Tanggal Mulai" readonly>
                                <span class="help-block"></span>
                            </div>
                        </div>
						
						
						
						   <div class="form-group">
                            <label class="col-md-4 control-label">Tanggal Berakhir
                                <span
                                        class="required">
                                        * </span>
                                </span>
                            </label>

                            <div class="col-md-6">
                                   <input class="form-control" type="text" name="end_date" id="end_date"
                                           placeholder="Tanggal Berakhir" readonly>
                                <span class="help-block"></span>
                            </div>
                        </div> 
						
						
						
						<div class="form-group">
                            <label class="col-md-4 control-label" style="padding: 0px;">
                                   <span
                                        class="required">
                                        </span>
                             
                            </label>

                            <div class="col-md-6">
                   Total Hari
                       
                            <span id="daysSelected" class="badge rounded-2x badge-red">0</span>

                       
                            </div>
                        </div>
					
						            <div class="form-group">
                            <label class="col-md-4 control-label">Pilih Keterangan
                                <span
                                        class="required">
                                        * </span>
                                </span>
                            </label>

                            <div class="col-md-6">
                            <select class="form-control select2me" id="date_range_leaveType" name="leaveType">
						   <option selected disabled>Pilih Keterangan</option>
                @foreach($leavetypes as $idku)
			
					
                    <option value="{{ $idku->singkat }}">{{ $idku->leaveType }} ({{ $idku->singkat }})</option>
				
				 
				
                @endforeach
            </select>
                                <span class="help-block"></span>
                              
                            </div>
                        </div>
						
						
						
						
						
						
						
						
						
								            <div class="form-group">
                            <label class="col-md-4 control-label">Ketik Alasan
                                
                                <span
                                        class="required">
                                        * </span>
                                </span>
                            </label>

                            <div class="col-md-6">
                                    <textarea class="form-control" name="reason"></textarea>
                                <span class="help-block"></span>
                         <small>Silahkan Ketik beberapa kata</small>
                            </div>
                        </div>
						
						
						
						
						
                    </div>
                    <!-- END FORM-->
                </div>
            </div>

               <div class="modal-footer">
                <div class="row">
                    <div style="text-align:center;">
		
                 <button type="button" onclick="addUpdateLeaveType();return false;" class="btn green btn-lg">
                            <i class="fa fa-check"></i> Lanjutkan Buat Keterangan</button>

                    </div>
                </div>
            </div>
            {!!  Form::close()  !!}

      <!-- END FORM-->

                    </div>
                </div>
                <!-- END EXAMPLE TABLE PORTLET-->

            </div>
        </div>
    </div>
    <!-- END PAGE CONTENT-->
  @endif 

@stop

@section('footerjs')


    {!! HTML::script("assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js")!!}
    {!! HTML::script("assets/global/plugins/datatables/datatables.min.js")!!}
    {!! HTML::script("assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js")!!}
    {!! HTML::script("assets/admin/pages/scripts/table-managed.js")!!}

    {!! HTML::script("assets/global/plugins/jquery-multi-select/js/jquery.multi-select.js")!!}

<!-- JS Implementing Plugins -->
{!! HTML::script('front_assets/plugins/back-to-top.js') !!}

<!-- Scrollbar -->

{!! HTML::script('front_assets/plugins/scrollbar/src/perfect-scrollbar.js') !!}

  	      <script id="rendered-js" >
			        $.fn.select2.defaults.set("theme", "bootstrap");
        $('.select2me').select2({
            placeholder: "Select",
            width: '100%',
            allowClear: false
        });								  
											  
    jQuery(document).ready(function ($) {
        "use strict";
        $('.contentHolder').perfectScrollbar();

        $('#start_date').datepicker({
            dateFormat: 'yy-mm-dd',
            prevText: '<i class="fa fa-angle-left"></i>',
            nextText: '<i class="fa fa-angle-right"></i>',
          

            onSelect: function (selectedDate) {

                var diff = ($("#end_date").datepicker("getDate") -
                    $("#start_date").datepicker("getDate")) /
                    1000 / 60 / 60 / 24 + 1; // days
                if ($("#end_date").datepicker("getDate") != null) {
                    $('#daysSelected').html(diff);
                    $('#days').val(diff);
                }
                $('#end_date').datepicker('option', 'minDate', selectedDate);
            }
        });
        $('#end_date').datepicker({
            dateFormat: 'yy-mm-dd',
            prevText: '<i class="fa fa-angle-left"></i>',
            nextText: '<i class="fa fa-angle-right"></i>',
            onSelect: function (selectedDate) {

                $('#start_date').datepicker('option', 'maxDate', selectedDate);

                var diff = ($("#end_date").datepicker("getDate") -
                    $("#start_date").datepicker("getDate")) /
                    1000 / 60 / 60 / 24 + 1; // days
                if ($("#start_date").datepicker("getDate") != null) {
                    $('#daysSelected').html(diff);
                    $('#days').val(diff);
                }

            }
        });

    });


	    function addUpdateLeaveType(id) {

            if (typeof id != 'undefined') {
                var url = "{{ route('admin.newleaveadmin.update',':id') }}";
                url = url.replace(':id', id);
            } else {
                url = "{{route('admin.newleaveadmin.store')}}";
            }
            $.easyAjax({
                type: 'POST',
                url: url,
                container: '#leave_type_update_form',
                data: $('#leave_type_update_form').serialize(),
                success: function (response) {
                    if (response.status == "success") {
     window.location.replace("../leave_applicationsadmin");
                    }

                }
            });
        }



 

    </script>
	
@stop


									