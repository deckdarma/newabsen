<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>

        <h4 class="modal-title"><strong>
                <i class="la la-edit"></i> Form Edit Golongan  {{ $golonganpeg->golonganPeg }}</strong></h4>
    </div>
    <div class="modal-body">
        <div class="panel-body form">

            <!-- BEGIN FORM-->

            {!!  Form::open(['method' => 'PUT', 'id' => 'leave_type_update_form', 'class'=>'form-horizontal'])  !!}

            <div class="form-body">
                <div class="form-group">	
                    <label class="col-md-4 control-label">Golongan {{ $golonganpeg->golonganPeg }}<span
                                class="required">
                                        * </span>
						
                    </label>

                    <div class="col-md-6">
                        <input type="text" class="form-control input-medium date-picker" id="golonganPeg"
                               name="golonganPeg"
                               value="{{ $golonganpeg->golonganPeg }}"
                               placeholder="Ketik Data Nama Apel">
                        <span class="help-block"></span>
                    </div>
                </div>

                <div class="form-group" style="display:none;">
                    <label class="col-md-4 control-label">Nomor Urut
                        <span
                                class="required">
                                        * </span>
                        </span>
                    </label>

                    <div class="col-md-6">
                        <input type="text" class="form-control only-num input-medium date-picker restrict-numbers-only"
                          
                               value="{{ $golonganpeg->num_of_leave}}"
                               placeholder="{{trans('core.noOfDays')}}"
                        disabled>            <input type="hidden" class="form-control only-num input-medium date-picker restrict-numbers-only"
                               name="num_of_leave" id="num_of_leave"
                               value="{{ $golonganpeg->num_of_leave}}"
                               placeholder="{{trans('core.noOfDays')}}"
                        >
                        <span class="help-block"></span>
                    </div>
                </div>
				
				
				
				
				        <div class="form-group">
                    <label class="col-md-4 control-label">Potongan
                        <span
                                class="required">
                                        * </span>
                        </span>
                    </label>

                    <div class="col-md-6">
                        <input type="text" class="form-control only-num input-medium date-picker restrict-money"
                               name="potongan" id="potongan"
                               value="{{ $golonganpeg->potongan}}"
                               placeholder="Ketik Potongan dalam angka"
                        >
                        <span class="help-block"></span>
						     <small class="help-block">Misalnya: 0%, 5% atau 15%</small>
                    </div>
                </div>
				
				
				
				
				
								<div class="form-group" style="display:none">
                            <label class="col-md-4 control-label">Singkatan
                                <span
                                        class="required">
                                        * </span>
                                </span>
                            </label>

                            <div class="col-md-6">
                                <input type="text" class="form-control only-num  input-medium date-picker restrict-uppercase"
                                       name="singkat" id="singkat"  value="{{ $golonganpeg->singkat}}"
                                       placeholder="Ketik Singkatan Huruf Besar" 
                               >
                                <span class="help-block"></span>
								@if ($golonganpeg->id == "28") 
     			  <small class="help-block">Catatan: singkatan tidak boleh ada yang sama Misalnya: PULANGCEPAT</small>
								@else
				                           <small class="help-block">Catatan: singkatan tidak boleh ada yang sama Misalnya: APELPAGI, APELSORE</small>		
							@endif
                            </div>
                        </div>
            </div>


            <div class="form-actions">
                <div class="row">
                    <div class="col-md-offset-8 col-md-12">
					             <button type="button" onClick="refreshPage()"  type="button" data-dismiss="modal"
                        class="btn dark btn-outline">Tutup</button>
                        <button type="button" onclick="addUpdateGolonganPeg({{$golonganpeg->id}})"
                                class="btn btn-primary"> @if(isset($golonganpeg))<i class="la la-edit"></i>  @lang('core.btnUpdate') @else
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
restrictChars('.restrict-money', '1234567890%');
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
function refreshPage(){
    window.location.reload();
} 
    </script>