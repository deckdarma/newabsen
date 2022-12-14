<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>

        <h4 class="modal-title"><strong>
                <i class="la la-edit"></i>Edit Keterangan</strong></h4>
    </div>
    <div class="modal-body">
        <div class="panel-body form">

            <!-- BEGIN FORM-->

            {!!  Form::open(['method' => 'PUT', 'id' => 'leave_type_update_form', 'class'=>'form-horizontal'])  !!}

            <div class="form-body">
                <div class="form-group">
                    <label class="col-md-4 control-label">Nama Keterangan<span
                                class="required">
                                        * </span>
                    </label>

                    <div class="col-md-6">
                        <input type="text" class="form-control input-medium date-picker" id="leaveType"
                               name="leaveType"
                               value="{{ $leavetype->leaveType }}"
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
                               value="{{ $leavetype->num_of_leave}}"
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
					        <option value="1" @if($leavetype->waktumundur=='1') selected @endif>YA</option>
                                    <option value="0" @if($leavetype->waktumundur=='0') selected @endif>TIDAK
                                    </option>
			
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
                               value="{{ $leavetype->potongan}}"
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
                               value="{{ $leavetype->potongan_shift}}"
                               placeholder="Ketik Potongan dalam angka"
                        >
                        <span class="help-block"></span>
						     <small class="help-block">Misalnya: 1 atau 1.5</small>
                    </div>
                </div>
				
				
				
				
				
				         <input type="hidden" class="form-control only-num  input-medium date-picker restrict-uppercase"
                                       name="singkat" id="singkat"  value="{{ $leavetype->singkat}}"
                                       placeholder="Ketik Singkatan Huruf Besar" 
                              readonly >
            </div>


            <div class="form-actions">
                <div class="row">
                    <div class="col-md-offset-3 col-md-9">
                        <button type="button" onclick="addUpdateLeaveType({{$leavetype->id}})"
                                class="btn btn-primary"> @if(isset($leavetype))<i class="la la-edit"></i>  @lang('core.btnUpdate') @else
                                <i class="la la-plus"></i>   @lang('core.btnSubmit') @endif</button>

                    </div>
                </div>
            </div>
        {!!  Form::close()  !!}
        <!-- END FORM-->
        </div>
    </div>
    <!-- END EXAMPLE TABLE PORTLET-->
</div>



										      <script id="rendered-js" >
restrictChars('.restrict-numbers-only', '1234567890');
restrictChars('.restrict-money', '1234567890.');
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

    </script>