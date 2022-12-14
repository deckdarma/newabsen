				<?php $caritpp = count(DB::select(DB::raw("SELECT * FROM salary WHERE employee_id='".$employee_id."' ")));?>
@if($caritpp != 0)
	<script type="text/javascript">

    window.location.replace("employees");
</script>
	@endif
	<?php
	if($pegdata->statusmupeg =="PHL") {
	$namdata = "Honorium";
	} else {
	$namdata = "Jumlah TPP";	
	}
	?>
<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
        <h4 class="modal-title"><strong>Form Menambahkan  {{ $namdata }}</strong></h4>
    </div>
    <div class="modal-body">
        <div class="portlet-body form">

            <!-------------- BEGIN FORM------------>
            {!! Form::open(array('route'=>"admin.salary.store",'class'=>'form-horizontal','id'=> 'save_salary','method'=>'POST')) !!}
            <input   type="hidden" name="employee_id" value="{{$employee_id}}"/>

            <div class="form-body">

                           <input class="form-control form-control-inline" name="type" type="hidden" value="basic" placeholder="Type"/>
                    
                <div class="form-group" >
					
                    <div class="col-md-12">
					 <div style="font-size:19px"> Tambah {{ $namdata }} {{ $pegdata->full_name }}</div>
                        <input class="form-control form-control-inline dattanomors"  type="text" name="salary" placeholder="Ketik {{ $namdata }} (Rp)"/>
                        <input   type="hidden" name="remarks" value="Added Salary"/>
                    </div>
                </div>
            </div>

            <div >
		

                <div class="row" style="padding-bottom:20px;">
                    <div class="col-md-offset-4 col-md-9">
					       <button type="button" onClick="refreshPage()"  type="button" data-dismiss="modal"
                        class="btn dark btn-outline">Tutup</button>
                        <button type="button" onclick="saveSalary({{$employee_id}});return false;"    class="btn green"><i class="fa fa-check"></i> Submit {{ $namdata }}</button>

                    </div>
                </div>
            </div>
        {!!  Form::close()  !!}
        <!-- -----------END FORM-------->
        </div>
    </div>
    <!-- END EXAMPLE TABLE PORTLET-->
</div>
		<script>
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
</script>