<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"  ></button>

        <h4 class="modal-title"><strong><i
                        class="la la-plus"></i>Lihat Data  Periode {{ $tanggal_normalshift->judul_nama }}</strong></h4>
    </div>

        <div class="panel-body form">

            <div class="modal-body" style="
    padding: 0px;
">
                <div class="portlet-body form">
                    <!-- BEGIN FORM-->
                    <div class="form-body"  style="padding-top: 20px 10px 10px 10px">
					
		
					
		

              <div style="font-size: 15px;font-weight: bold;padding-left: 15px;padding-bottom:5px">DATA UTAMA</div>
	                         	
                    <input type="hidden" name="leaveformType" id="leaveformType" value="date_range">
						    <input type="hidden" name="company_id" id="company_id" value="{{ $tanggal_normalshift->company_id }}" value="1">

							
									<div class="col-md-12">Nama Periode <span class="required">*  </span>
                            <input class="form-control" type="text"  value="{{ $tanggal_normalshift->judul_nama }}" placeholder="Ketik Nama Absensi" disabled>
							<span class="help-block"></span>
                            </div>
							
							         <div class="col-md-6">Tanggal  Mulai Periode  <span class="required">*  </span>
				                   <input class="form-control" type="text"  value="{{ $tanggal_normalshift->start_date }}" 
                                           placeholder="Tanggal Mulai" readonly disabled>
							 <span class="help-block"></span>
                            </div>
							
							<div class="col-md-6">Tanggal Akhir Periode <span class="required">*  </span>
                          <input class="form-control" type="text"  value="{{ $tanggal_normalshift->end_date }}" 
                                           placeholder="Tanggal Berakhir" readonly disabled>
							<span class="help-block"></span>
                            </div>
									<div class="col-md-12" style="padding-bottom:20px;">Total Hari
                       
                            <span id="daysSelected" class="badge rounded-2x badge-red">{{ $tanggal_normalshift->days }}</span>
                     
                            </div>
                      
							
						
						
						
   									
						<div style="font-size: 15px;font-weight: bold;padding-left: 15px;padding-bottom:5px">Jam Masuk Senin-Kamis</div>
	        
                            <div class="col-md-6">Mulai Jam Masuk <span class="required">*  </span>
			
                             <input class="form-control " type="text"   value="{{ $tanggal_normalshift->jam_masuk }}"  disabled>
							 <span class="help-block"></span>
                            </div>
							
							<div class="col-md-6" style="padding-bottom:10px;">Tutup Absen Masuk  <span class="required">*  </span>
                            <input class="form-control " type="text"   value="{{ $tanggal_normalshift->jam_akhir_masuk }}"   disabled>
							<span class="help-block"></span>
                            </div>
							

						
                   
					
						
              <div style="font-size: 15px;font-weight: bold;padding-left: 15px;padding-bottom:5px">Jam Masuk Juma'at</div>
	        
                            <div class="col-md-6">Mulai Jam Masuk <span class="required">*  </span>
			
                             <input class="form-control " type="text"    value="{{ $tanggal_normalshift->jam_masuk_jumat }}"  disabled>
							 <span class="help-block"></span>
                            </div>
							
							<div class="col-md-6" style="padding-bottom:10px;">Tutup Absen Masuk  <span class="required">*  </span>
                            <input class="form-control " type="text"   value="{{ $tanggal_normalshift->jam_akhir_masuk_jumat }}"   disabled>
							<span class="help-block"></span>
                            </div>
							

        				
              <div style="font-size: 15px;font-weight: bold;padding-left: 15px;padding-bottom:5px">Jam Pulang Senin-Kamis</div>
	        
                            <div class="col-md-6">Mulai Jam Pulang <span class="required">*  </span>
			
                             <input class="form-control " type="text" value="{{ $tanggal_normalshift->jam_pulang }}"   disabled>
							 <span class="help-block"></span>
                            </div>
							
							<div class="col-md-6" style="padding-bottom:10px;">Tutup Absen Pulang  <span class="required">*  </span>
                            <input class="form-control " type="text" value="{{ $tanggal_normalshift->jam_akhir_pulang }}"   disabled>
							<span class="help-block"></span>
                            </div>
							
	
                  

														
              <div style="font-size: 15px;font-weight: bold;padding-left: 15px;padding-bottom:5px">Jam Pulang Juma'at</div>
	        
                            <div class="col-md-6">Mulai Jam Pulang <span class="required">*  </span>
			
                             <input class="form-control " type="text"  value="{{ $tanggal_normalshift->jam_pulang_jumat }}"  disabled>
							 <span class="help-block"></span>
                            </div>
							
							<div class="col-md-6" style="padding-bottom:10px;">Tutup Absen Pulang  <span class="required">*  </span>
                            <input class="form-control " type="text"  value="{{ $tanggal_normalshift->jam_akhir_pulang_jumat }}"   disabled>
							<span class="help-block"></span>
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
			
              <div style="font-size: 15px;font-weight: bold;padding-left: 15px;padding-bottom:5px">{{ $data->dataSkor }} Senin s/d Kamis</div>
	        
                            <div class="col-md-6">Jam Mulai Skors  <span class="required">*  </span>
							<input class="form-control" type="hidden"  value="{{$tanggal_normalshift->$cariid}}"  disabled>
                             <input class="form-control " type="text"   value="{{$tanggal_normalshift->$carimasuk}}"  disabled>
							 <span class="help-block"></span>
                            </div>
							
							<div class="col-md-6">Jam Akhir Skors  <span class="required">*  </span>
                            <input class="form-control " type="text" value="{{$tanggal_normalshift->$caripulang}}"     disabled>
							<span class="help-block"></span>
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
						
              <div style="font-size: 15px;font-weight: bold;padding-left: 15px;padding-bottom:5px">{{ $data->dataSkor }} Jumat</div>
	        
                            <div class="col-md-6">Jam Mulai Skors  <span class="required">*  </span>
							<input class="form-control" type="hidden"  value="{{$tanggal_normalshift->$cariid_jumat}}"    disabled>
                             <input class="form-control " type="text" value="{{$tanggal_normalshift->$carimasuk_jumat}}"  disabled>
							 <span class="help-block"></span>
                            </div>
							
							<div class="col-md-6">Jam Akhir Skors  <span class="required">*  </span>
                            <input class="form-control " type="text"  value="{{$tanggal_normalshift->$caripulang_jumat}}"   disabled>
							<span class="help-block"></span>
                            </div>
							
						
						
               
			
						


				   @endforeach
						
						
	
						

						
	
						
						
					        <div class="modal-footer" style="
    border-top: none;
">
                <div class="row">
                    <div class="col-md-offset-3 col-md-9">
					  <div style="padding-bottom:10px;">  </div>	
					   @if($tanggal_normalshift->application_status=='pending')
					             <input type="submit" name="application_status" data-loading-text="@lang("core.updating")..." class="btn green" value="Terima / Setujui" data-toggle="modal" href="#static_approve_tampilan_shift" onclick="show_approve_tampilan_shift({{ $tanggal_normalshift->id }});return false;">
                        <input type="submit" name="application_status" data-loading-text="@lang("core.updating")..." class="btn red" value="Batalkan / Tolak" data-toggle="modal" href="#static_reject_tampilan_shift" onclick="show_reject_tampilan_shift(' {{ $tanggal_normalshift->id }} ');return false;">
                    @endif
					                                  <button type="button"   type="button" data-dismiss="modal"
                        class="btn dark btn-outline">Tutup</button>
         
							

                    </div>
                </div>
                </div>
						
						
                    </div>
                    <!-- END FORM-->
                </div>
            </div>


    
        
          
      

        </div>

</div>


	

