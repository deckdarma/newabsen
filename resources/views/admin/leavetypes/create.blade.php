<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>

        <h4 class="modal-title"><strong><i
                        class="la la-plus"></i>  Tambah Jenis Keterangan</strong></h4>
    </div>
    <div class="modal-body">
        <div class="panel-body form">
            {!! Form::open(array('class'=>'form-horizontal ','method'=>'POST','id'=>'leave_type_update_form')) !!}
            <div class="modal-body">
                <div class="portlet-body form">
                    <!-- BEGIN FORM-->
                    <div class="form-body">
                 <div class="form-group">
                    <label class="col-md-4 control-label">Nama Keterangan<span
                                class="required">
                                        * </span>
                    </label>

                    <div class="col-md-6">
                        <input type="text" class="form-control input-medium date-picker" id="leaveType"
                               name="leaveType"
                              
                               placeholder="Ketik Nama Keterangan">
                        <span class="help-block"></span>
                    </div>
                </div>

                         <div class="form-group">
                    <label class="col-md-4 control-label">{{trans('core.noOfDays')}}
                        <span
                                class="required">
                                        * </span>
                        </span>
                    </label>

                    <div class="col-md-6">
                        <input type="text" class="form-control only-num input-medium date-picker restrict-numbers-only"
                               name="num_of_leave" id="num_of_leave"
                              
                               placeholder="{{trans('core.noOfDays')}}"
                        >
                        <span class="help-block"></span>
                    </div>
                </div>
				
				
				
				
				
				
				
				
				
					            <div class="form-group">
                            <label class="col-md-4 control-label">Waktu Mundur
                                <span
                                        class="required">
                                        * </span>
                                </span>
                            </label>

                            <div class="col-md-6">
                            <select class="form-control"  name="waktumundur">
					        <option selected disabled>Pilih Waktu Mundur</option>
					        <option value="1" >YA</option>
                             <option value="0" >TIDAK</option>
			
            </select>
                                <span class="help-block"></span>
                                <small class="help-block">Catatan: Jika anda pilih "YA" berarti Keterangan ini tidak bisa mundur tanggal</small>  
                            </div>
                        </div>
				
				
					        <div class="form-group">
                    <label class="col-md-4 control-label">Potongan OPD Normal
                        <span
                                class="required">
                                        * </span>
                        </span>
                    </label>

                    <div class="col-md-6">
                        <input type="text" class="form-control only-num input-medium date-picker restrict-money"
                               name="potongan" id="potongan"
                       
                               placeholder="Ketik Potongan dalam angka"
                        >
                        <span class="help-block"></span>
						     <small class="help-block">Misalnya: 1 atau 1.5</small>
                    </div>
                </div>
				
				
				
									   <div class="form-group">
                    <label class="col-md-4 control-label">Potongan OPD Shift
                        <span
                                class="required">
                                        * </span>
                        </span>
                    </label>

                    <div class="col-md-6">
                        <input type="text" class="form-control only-num input-medium date-picker restrict-money"
                               name="potongan_shift" id="potongan_shift"
                        
                               placeholder="Ketik Potongan dalam angka"
                        >
                        <span class="help-block"></span>
						     <small class="help-block">Misalnya: 1 atau 1.5</small>
                    </div>
                </div>
				
				
				
				
									   <div class="form-group">
                    <label class="col-md-4 control-label">Ketik Singkatan 
                        <span
                                class="required">
                                        * </span>
                        </span>
                    </label>

                    <div class="col-md-6">
                  	
				       <input type="text" class="form-control only-num  input-medium date-picker restrict-uppercase"
                                       name="singkat" id="singkat"  
                                       placeholder="Ketik Singkatan Huruf Besar" 
                              >
				
                        <span class="help-block"></span>
						     <small class="help-block">Ketik Singkatan tidak boleh ada yang sama</small>
                    </div>
                </div>
				
				
				
				
				
			
				
                    </div>
                    <!-- END FORM-->
                </div>
            </div>

            <div class="modal-footer">
                <div class="row">
                    <div class="col-md-offset-3 col-md-9">
                        <button type="button" onclick="addUpdateLeaveType();return false;" class="btn green">
                            <i class="fa fa-check"></i> @lang('core.btnSubmit')</button>

                    </div>
                </div>
            </div>
            {!!  Form::close()  !!}

        </div>
    </div>
    <!-- END EXAMPLE TABLE PORTLET-->
</div>


