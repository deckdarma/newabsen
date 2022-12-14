<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" onClick="refreshPage()" ></button>

        <h4 class="modal-title"><strong><i
                        class="la la-plus"></i>Edit Data Normal Absensi</strong></h4>
    </div>
    <div class="modal-body" style="padding-top: 0px;">
        <div class="panel-body form">
            {!!  Form::open(['method' => 'PUT', 'id' => 'leave_type_update_form', 'class'=>'form-horizontal'])  !!}
            <div class="modal-body">
                <div class="portlet-body form">
                    <!-- BEGIN FORM-->
                    <div class="form-body"  style="padding-top: 10px;">
					
		
					
	
						
		
						
						
						
										 <div class="form-group" style="background: #ecdeed;padding: 5px;border-radius: 3px;">
						
              <div style="font-size: 15px;font-weight: bold;padding-left: 15px;padding-bottom:5px">Jam Masuk Senin-Kamis</div>
	        
                            <div class="col-md-6">Mulai Jam Masuk <span class="required">*  </span>
			
                             <input class="form-control " type="text" name="jam_masuk"  value="{{ $normalabsensi->jam_masuk }}" id="jam_masuk"  >
							 <span class="help-block"></span>
                            </div>
							
							<div class="col-md-6">Tutup Absen Masuk  <span class="required">*  </span>
                            <input class="form-control " type="text" name="jam_akhir_masuk"  value="{{ $normalabsensi->jam_akhir_masuk }}" id="jam_akhir_masuk"  >
							<span class="help-block"></span>
                            </div>
							
													      <script id="rendered-js" >
$("#jam_masuk").inputmask({"mask": "99:99:99"});
$("#jam_akhir_masuk").inputmask({"mask": "99:99:99"});
	</script>
						
                        </div>
						
						
													 <div class="form-group" style="background: #ecdeed;padding: 5px;border-radius: 3px;">
						
              <div style="font-size: 15px;font-weight: bold;padding-left: 15px;padding-bottom:5px">Jam Masuk Juma'at</div>
	        
                            <div class="col-md-6">Mulai Jam Masuk <span class="required">*  </span>
			
                             <input class="form-control " type="text" name="jam_masuk_jumat"   value="{{ $normalabsensi->jam_masuk_jumat }}" id="jam_masuk_jumat"  >
							 <span class="help-block"></span>
                            </div>
							
							<div class="col-md-6">Tutup Absen Masuk  <span class="required">*  </span>
                            <input class="form-control " type="text" name="jam_akhir_masuk_jumat"  value="{{ $normalabsensi->jam_akhir_masuk_jumat }}"  id="jam_akhir_masuk_jumat"  >
							<span class="help-block"></span>
                            </div>
							
	<script id="rendered-js" >
$("#jam_masuk_jumat").inputmask({"mask": "99:99:99"});
$("#jam_akhir_masuk_jumat").inputmask({"mask": "99:99:99"});
	</script>
						
                        </div>
						
						
						
								 <div class="form-group" style="background: #cae4f2;padding: 5px;border-radius: 3px;">
						
              <div style="font-size: 15px;font-weight: bold;padding-left: 15px;padding-bottom:5px">Jam Pulang Senin-Kamis</div>
	        
                            <div class="col-md-6">Mulai Jam Pulang <span class="required">*  </span>
			
                             <input class="form-control " type="text" name="jam_pulang" value="{{ $normalabsensi->jam_pulang }}"  id="jam_pulang"  >
							 <span class="help-block"></span>
                            </div>
							
							<div class="col-md-6">Tutup Absen Pulang  <span class="required">*  </span>
                            <input class="form-control " type="text" name="jam_akhir_pulang" value="{{ $normalabsensi->jam_akhir_pulang }}"  id="jam_akhir_pulang"  >
							<span class="help-block"></span>
                            </div>
							
													      <script id="rendered-js" >
$("#jam_pulang").inputmask({"mask": "99:99:99"});
$("#jam_akhir_pulang").inputmask({"mask": "99:99:99"});
	</script>
						
                        </div>
						
															 <div class="form-group" style="background: #cae4f2;padding: 5px;border-radius: 3px;">
						
              <div style="font-size: 15px;font-weight: bold;padding-left: 15px;padding-bottom:5px">Jam Pulang Juma'at</div>
	        
                            <div class="col-md-6">Mulai Jam Pulang <span class="required">*  </span>
			
                             <input class="form-control " type="text" name="jam_pulang_jumat" value="{{ $normalabsensi->jam_pulang_jumat }}"  id="jam_pulang_jumat"  >
							 <span class="help-block"></span>
                            </div>
							
							<div class="col-md-6">Tutup Absen Pulang  <span class="required">*  </span>
                            <input class="form-control " type="text" name="jam_akhir_pulang_jumat" value="{{ $normalabsensi->jam_akhir_pulang_jumat }}"  id="jam_akhir_pulang_jumat"  >
							<span class="help-block"></span>
                            </div>
							
													      <script id="rendered-js" >
$("#jam_pulang_jumat").inputmask({"mask": "99:99:99"});
$("#jam_akhir_pulang_jumat").inputmask({"mask": "99:99:99"});
	</script>
						
                        </div>				
						
						
						
						
						
					
                              @foreach($dataskorsa as $data)
							  			<?php 
						
						$datasingkat = $data->singkat;
						$datamasuk = "_masuk";
						$carimasuk = $datasingkat.''.$datamasuk;
						
						$datapulang= "_pulang";
						$caripulang = $datasingkat.''.$datapulang;
						
						$dataid= "id_";
						$cariid = $dataid.''.$datasingkat;
						

						?>
						 @if ($data->num_of_leave == '0')
					    <div class="form-group" style="background: #d4f5d2;padding: 5px;border-radius: 3px;">
					@else
						 <div class="form-group" style="background: #eaf1cf;padding: 5px;border-radius: 3px;">
						@endif
              <div style="font-size: 15px;font-weight: bold;padding-left: 15px;padding-bottom:5px">{{ $data->dataSkor }} Senin s/d Kamis</div>
	        
                            <div class="col-md-6">Jam Mulai Skors  <span class="required">*  </span>
							<input class="form-control" type="hidden" name="id_{{ $data->singkat }}"  value="{{$normalabsensi->$cariid}}"  id="id_{{ $data->singkat }}" >
                             <input class="form-control " type="text" name="{{ $data->singkat }}_masuk"  value="{{$normalabsensi->$carimasuk}}" id="{{ $data->singkat }}_masuk"  >
							 <span class="help-block"></span>
                            </div>
							
							<div class="col-md-6">Jam Akhir Skors  <span class="required">*  </span>
                            <input class="form-control " type="text" name="{{ $data->singkat }}_pulang" value="{{$normalabsensi->$caripulang}}"   id="{{ $data->singkat }}_pulang"  >
							<span class="help-block"></span>
                            </div>
							
				
						
                        </div>
						
									  			<?php 
						
						$datasingkat_jumat = $data->singkat;
						$datamasuk_jumat = "_masuk_jumat";
						$carimasuk_jumat = $datasingkat_jumat.''.$datamasuk_jumat;
						
						$datapulang_jumat = "_pulang_jumat";
						$caripulang_jumat = $datasingkat_jumat.''.$datapulang_jumat;
						
						$dataid_jumat = "id_jumat_";
						$cariid_jumat = $dataid_jumat.''.$datasingkat_jumat;
						
		
						?>
								 @if ($data->num_of_leave == '0')
					    <div class="form-group" style="background: #dde8e1;padding: 5px;border-radius: 3px;">
					@else
						 <div class="form-group" style="background: #e5e6d5;padding: 5px;border-radius: 3px;">
						@endif
              <div style="font-size: 15px;font-weight: bold;padding-left: 15px;padding-bottom:5px">{{ $data->dataSkor }} Jumat</div>
	        
                            <div class="col-md-6">Jam Mulai Skors  <span class="required">*  </span>
							<input class="form-control" type="hidden" name="id_jumat_{{ $data->singkat }}" value="{{$normalabsensi->$cariid_jumat}}"   id="id_jumat_{{ $data->singkat }}"  required>
                             <input class="form-control " type="text" name="{{ $data->singkat }}_masuk_jumat" value="{{$normalabsensi->$carimasuk_jumat}}"  id="{{ $data->singkat }}_masuk_jumat"  required>
							 <span class="help-block"></span>
                            </div>
							
							<div class="col-md-6">Jam Akhir Skors  <span class="required">*  </span>
                            <input class="form-control " type="text" name="{{ $data->singkat }}_pulang_jumat"  value="{{$normalabsensi->$caripulang_jumat}}" id="{{ $data->singkat }}_pulang_jumat"  required>
							<span class="help-block"></span>
                            </div>
							
				
                        </div>
			
						
						
						
										      <script id="rendered-js" >
$("#{{ $data->singkat }}_pulang_jumat").inputmask({"mask": "99:99:99"});
$("#{{ $data->singkat }}_masuk_jumat").inputmask({"mask": "99:99:99"});
	</script>
	
											      <script id="rendered-js" >
$("#{{ $data->singkat }}_pulang").inputmask({"mask": "99:99:99"});
$("#{{ $data->singkat }}_masuk").inputmask({"mask": "99:99:99"});
	</script>


				   @endforeach
						
						
	

	
						
						
						
						
						
                    </div>
                    <!-- END FORM-->
                </div>
            </div>

            <div class="modal-footer">
                <div class="row">
                    <div class="col-md-offset-3 col-md-9">
					                                  <button type="button" onClick="refreshPage()"  type="button" data-dismiss="modal"
                        class="btn dark btn-outline">Tutup</button>
                 <button type="button" onclick="addUpdateNormalAbsensi({{$normalabsensi->id}})" class="btn purple">
                            <i class="fa fa-edit"></i>Lanjutkan Edit Absensi Normal</button>
							   

                    </div>
                </div>
            </div>
            {!!  Form::close()  !!}

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
