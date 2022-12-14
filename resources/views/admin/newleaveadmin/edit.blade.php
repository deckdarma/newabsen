  @if(admin()->unikid =='0')

	<script type="text/javascript">

    window.location.replace("../error");
</script> 
	  @else 
<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" onClick="refreshPage()" ></button>

        <h4 class="modal-title"><strong><i
                        class="la la-plus"></i>Edit Keterangan</strong></h4>
    </div>
    <div class="modal-body">
        <div class="panel-body form">

      {!!  Form::open(['method' => 'PUT', 'id' => 'leave_type_update_form', 'class'=>'form-horizontal'])  !!}
            <div class="modal-body">
                <div class="portlet-body form">
                    <!-- BEGIN FORM-->
                    <div class="form-body">
					
										  <div class="form-group">
		     <input type="hidden" name="days" id="days" value="{{ $leavetype->days}}">
                    <input type="hidden" name="leaveformType" id="leaveformType" value="date_range">
						
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
     <option value="{{ $dataop->id}}" @if($leavetype->company_id == $dataop->id) selected @endif>{{ $dataop->company_name }}</option>
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
            			<div style="
    padding: 8px 10px 5px 10px;
    border: 1px solid #a78b8b;
    background: #f7e4e4;
">	
			   @foreach($employees as $nama)
		@if ($nama->id == $leavetype->employee_id) 
		 {{$nama->nama}}   
		  @endif
                @endforeach 
			</div>
			 <input style="background-color: #fcf0f0;border: 1px solid #c19696;" class="form-control"  id="employee_id" name="employee_id" type="hidden" value="{{ $leavetype->employee_id}}" 
                                           readonly>
									
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
                                             <input class="form-control" type="text" value="{{ $leavetype->no_surat}}" name="no_surat" id="no_surat"
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
                      
										      <input class="form-control"   value="{{ $leavetype->start_date}}" type="text"  name="start_date"  id="start_date" readonly>
						
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
                                   <input class="form-control" type="text" value="{{ $leavetype->end_date}}" name="end_date" id="end_date"
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
                       
                            <span id="daysSelected" class="badge rounded-2x badge-red">{{ $leavetype->days}}</span>

                       
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
                            <select class="form-control" id="date_range_leaveType" name="leaveType">
					
                @foreach($leavetypes as $idku)
				
					
                    <option value="{{ $idku->singkat }}" @if($leavetype->leaveType == $idku->singkat) selected @endif>{{ $idku->leaveType }} ({{ $idku->singkat }})</option>
					 
				
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
                                    <textarea class="form-control" name="reason">{{ $leavetype->reason}}</textarea>
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
                    <div class="col-md-offset-3 col-md-9">
					                                  <button type="button" onClick="refreshPage()"  type="button" data-dismiss="modal"
                        class="btn dark btn-outline">Tutup</button>

							
							   
         <button type="button" onclick="addUpdateLeaveType({{$leavetype->id}})"
                                class="btn purple"> @if(isset($leavetype))<i class="fa fa-edit"></i>  Lanjutkan Edit Keterangan @else
                                <i class="fa fa-plus"></i>   Lanjutkan Buat Keterangan @endif</button>
                    </div>
                </div>
            </div>
            {!!  Form::close()  !!}

        </div>
    </div>
    <!-- END EXAMPLE TABLE PORTLET-->
</div>
  @endif 

<script id="rendered-js" >
											  
									  
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





	


	document.getElementById("datedis").disabled = true;	
	document.getElementById("disnama").disabled = true;	
    </script>