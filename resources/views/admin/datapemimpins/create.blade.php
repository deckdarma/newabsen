     	<?php
	$dataidcom =$loggedAdmin->company->id;
	       $caridatatotal = count(DB::select(DB::raw("SELECT * FROM datapemimpins WHERE company_id='".$dataidcom."' ")));
    
	?>
	@if($caridatatotal !=4)

<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>

        <h4 class="modal-title"><strong><i
                        class="la la-plus"></i>  Tambah Data Kepemimpinan</strong></h4>
    </div>
    <div class="modal-body">
        <div class="panel-body form">
            {!! Form::open(array('class'=>'form-horizontal ','method'=>'POST','id'=>'leave_type_update_form')) !!}
            <div class="modal-body">
                <div class="portlet-body form">
                    <!-- BEGIN FORM-->
                    <div class="form-body">
					
					
				<?php $Kepala = count(DB::select(DB::raw("SELECT * FROM datapemimpins WHERE company_id='".$dataidcom."' AND namajabatan='Kepala OPD' ")));?>
				<?php $Sekretaris = count(DB::select(DB::raw("SELECT * FROM datapemimpins WHERE company_id='".$dataidcom."' AND namajabatan='Sekretaris' ")));?>
				<?php $Kepegawaian = count(DB::select(DB::raw("SELECT * FROM datapemimpins WHERE company_id='".$dataidcom."' AND namajabatan='Kepegawaian' ")));?>
				<?php $Bendahara = count(DB::select(DB::raw("SELECT * FROM datapemimpins WHERE company_id='".$dataidcom."' AND namajabatan='Bendahara' ")));?>

				
		
@if ($Kepala == 0)
	<div class="note note-success" style="font-size: 18px;">
                       Silahkan Pilih Nama Kepala OPD
      </div>
	  	<input type="hidden" name="namajabatan" value="Kepala OPD">
	  	<input type="hidden" name="order" value="1">
  
	@else

@if ($Sekretaris == 0)
	
		<div class="note note-success" style="font-size: 18px;">
                       Silahkan Pilih Nama Sekretaris OPD
      </div>
	  	<input type="hidden" name="namajabatan" value="Sekretaris">
	  	<input type="hidden" name="order" value="2">


					
@else
	
@if ($Kepegawaian == 0)
	
		<div class="note note-success" style="font-size: 18px;">
                       Silahkan Pilih Nama Kepegawaian OPD
      </div>
	  	<input type="hidden" name="namajabatan" value="Kepegawaian">
	  	<input type="hidden" name="order" value="3">



@else
	
		<div class="note note-success" style="font-size: 18px;">
                       Silahkan Pilih Nama Bendahara OPD
      </div>
	  	<input type="hidden" name="namajabatan" value="Bendahara">
	  	<input type="hidden" name="order" value="4">


@endif




@endif	
@endif				
				
					
                          <div class="form-group">	
               
	<input type="hidden" name="company_id" value="{{ $loggedAdmin->company->id }}">
                    <div class="col-md-12">
                             <select class="form-control select2me" id="idpemimpin" name="idpemimpin">
						   <option selected disabled>Silahkan Pilih Nama</option>
						    <option value="0">KOSONGKAN JABATAN</option>
								@foreach($datapem as $opd)
                                            <option value="{{$opd->id}}">{{$opd->full_name}}</option>
                                 @endforeach
            </select>
                        <span class="help-block"></span>
                    </div>
                </div>

           
			
					
                </div>

			
                        </div>
                    </div>
                    <!-- END FORM-->
                </div>
            </div>

            <div class="modal-footer">
                <div class="row">
                    <div class="col-md-offset-3 col-md-9">
					        <button type="button"   type="button" data-dismiss="modal"
                        class="btn dark btn-outline">Tutup</button>
                        <button type="button" onclick="addUpdateDataPemimpin();return false;" class="btn green">
                            <i class="fa fa-check"></i> @lang('core.btnSubmit')</button>

                    </div>
                </div>
            </div>
            {!!  Form::close()  !!}

        </div>
    </div>
    <!-- END EXAMPLE TABLE PORTLET-->
</div>

										    @endif