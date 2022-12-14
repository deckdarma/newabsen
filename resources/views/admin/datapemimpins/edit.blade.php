<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>

        <h4 class="modal-title"><strong>
                <i class="la la-edit"></i> Form Edit Data Kepemimpinan</strong></h4>
    </div>
    <div class="modal-body">
        <div class="panel-body form">

            <!-- BEGIN FORM-->

            {!!  Form::open(['method' => 'PUT', 'id' => 'leave_type_update_form', 'class'=>'form-horizontal'])  !!}

            <div class="form-body">
	
					
@if ($datapemimpin->namajabatan== "Kepala OPD")
	<div class="note note-success" style="font-size: 18px;">
                       Silahkan Pilih Nama Kepala OPD
      </div>


  
	@else

@if ($datapemimpin->namajabatan == "Sekretaris")
	
		<div class="note note-success" style="font-size: 18px;">
                       Silahkan Pilih Nama Sekretaris OPD
      </div>




					
@else
	
@if ($datapemimpin->namajabatan == "Kepegawaian")
	
		<div class="note note-success" style="font-size: 18px;">
                       Silahkan Pilih Nama Kepegawaian OPD
      </div>

	



@else
	
		<div class="note note-success" style="font-size: 18px;">
                       Silahkan Pilih Nama Bendahara OPD
      </div>
	



@endif




@endif	
@endif		
                <div class="form-group">	
         

                    <div class="col-md-12">
                             <select class="form-control select2me" id="idpemimpin" name="idpemimpin">
						   <option selected disabled>Silahkan Pilih Nama</option>
						   @if($datapemnojab == 0) 
						  			 <option value="0" >KOSONGKAN JABATAN</option>	
					  		@foreach($datapem as $opd)
                                            <option value="{{$opd->id}}" @if($datapemimpin->idpemimpin==$opd->id) selected @endif>{{$opd->full_name}}</option>
                                 @endforeach
								
							@else
					 <option value="0" selected>TIDAK ADA PEJABAT</option>	
				 		  		@foreach($datapem as $opd)
                                            <option value="{{$opd->id}}" >{{$opd->full_name}}</option>
                                 @endforeach
						@endif
            </select>
                        <span class="help-block"></span>
                    </div>
                </div>

           
				
				
			

				
						
            </div>


            <div class="form-actions">
                <div class="row">
                    <div class="col-md-offset-8 col-md-12">
					             <button type="button" onClick="refreshPage()"  type="button" data-dismiss="modal"
                        class="btn dark btn-outline">Tutup</button>
                        <button type="button" onclick="addUpdateDataPemimpin({{$datapemimpin->id}})"
                                class="btn btn-primary"> @if(isset($datapemimpin))<i class="la la-edit"></i>  @lang('core.btnUpdate') @else
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