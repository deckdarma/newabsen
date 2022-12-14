<?php


$jam_buka = $row->jam_masuk_normal; 
$jam_pulang = $row->jam_pulang_normal; 
$jam_akhir_masuk = $row->jam_akhir_masuk_normal; 
$jam_akhir_pulang = $row->jam_akhir_pulang_normal; 
$ontime_masuk = $row->ONTIME_masuk_normal; 
$ontime_pulang = $row->ONTIME_pulang_normal; 
$skor1_mulai = $row->SKOR1_masuk_normal;
$skor1_akhir = $row->SKOR1_pulang_normal;
$skor2_mulai = $row->SKOR2_masuk_normal; 
$skor2_akhir = $row->SKOR2_pulang_normal;
$skor3_mulai = $row->SKOR3_masuk_normal;
$skor3_akhir = $row->SKOR3_pulang_normal;
$skor4_mulai = $row->SKOR4_masuk_normal;
$skor4_akhir = $row->SKOR4_pulang_normal;
?>

<?php

$data = $row->absenmasuk;


$jammulai = date("H:i:s", strtotime($data));

	
			if (( strtotime($jammulai) >= strtotime("$jam_buka") ) and (strtotime($jammulai) <= strtotime("$ontime_pulang"))  )
			$status="ONTIME";
			else if (( strtotime($jammulai) >= strtotime("$jam_buka") ) and (strtotime($jammulai) <= strtotime("$ontime_pulang"))  )
			$status="ONTIME";
			else if (( strtotime($jammulai) >= strtotime("$skor1_mulai") ) and (strtotime($jammulai) <= strtotime("$skor1_akhir"))  )
			$status="SKOR1";
			else if (( strtotime($jammulai) >= strtotime("$skor2_mulai") ) and (strtotime($jammulai) <= strtotime("$skor2_akhir"))  )
			$status="SKOR2";
			else if (( strtotime($jammulai) >= strtotime("$skor3_mulai") ) and (strtotime($jammulai) <= strtotime("$skor3_akhir"))  )
			$status="SKOR3";
		
			else if (( strtotime($jammulai) >= strtotime("$skor4_mulai") ) and (strtotime($jammulai) <= strtotime("$skor4_akhir")))
			$status="SKOR4";
		

				
			else if (( strtotime($jammulai) >= strtotime("$jam_akhir_masuk") ) and (strtotime($jammulai) <= strtotime("24:00:00"))  )
			$status= "1";

		
			else if (( strtotime("00:00:00") <= strtotime("$jam_buka") )  )
			$status= "1";



?>
<?php if($status !=  "1"): ?>
<input type="checkbox"
       id="checkbox<?php echo e($row->employeeID); ?>"
       onchange="showHide('<?php echo e($row->employeeID); ?>');return false;"
       class="make-bs-switch md-check"
       data-size="small" name="checkbox[]"
       data-on-color="success" data-on-text="Tampilkan" data-off-text="Tutup"
       data-off-color="danger"
       <?php if($row->status == "present" || $row->date == null): ?> checked <?php endif; ?>/>
<input type="hidden" name="employees[]" value="<?php echo e($row->employeeID); ?>">	


<div class="leave-form <?php if($row->status == "present" || $row->status == null): ?> hidden <?php endif; ?>"
     id="leaveForm<?php echo e($row->employeeID); ?>">	
<div class="row"  >

<div class="col-lg-6 col-md-12">
 <label class="control-label">Masuk</label>

        <div class="input-icon input-icon-sm">
            <i class="fa fa-clock-o"></i>
            <input type="text" class="form-control input-sm <?php echo e($status); ?>" id="clock_in<?php echo e($row->employeeID); ?>"
                style="font-size: 13px;   text-align:left;"     value="<?php echo e($row->clock_in); ?>" disabled>
        </div>
    </div>
	
    <div class="col-lg-6 col-md-12">
<?php if($row->pulangkantor != "00:00:00"): ?>
	<?php if(( strtotime($row->pulangkantor) >=  strtotime($row->jam_pulang_normal)) and (strtotime($row->pulangkantor) <= strtotime($row->jam_akhir_pulang_normal))): ?>

		<label class="control-label">Pulang</label>
        <div class="input-icon input-icon-sm"><i class="fa fa-clock-o"></i>
            <input type="text" class="form-control input-sm" id="clock_out<?php echo e($row->employeeID); ?>"
                   style="background-color: #178492;
    color: #fff;
    font-size: 13px;
	font-weight:bold;
  "     value="<?php echo e($row->clock_out); ?>" disabled>
        </div>
		 <?php else: ?>
	<label class="control-label">Belum Pulang</label>
 <div class="input-icon input-icon-sm"><i class="fa fa-clock-o"></i>
            <input type="text" style="    background-color: #e93f3f;color: #fff; font-size: 13px; font-weight:bold;  " class="form-control input-sm" id="clock_out<?php echo e($row->employeeID); ?>"
                   value="00:00" disabled>
        </div>
<?php endif; ?>
<?php else: ?>
		<label class="control-label">Belum Pulang</label>
 <div class="input-icon input-icon-sm"><i class="fa fa-clock-o"></i>
            <input type="text" style="    background-color: #e93f3f;color: #fff; font-size: 13px; font-weight:bold;  " class="form-control input-sm" id="clock_out<?php echo e($row->employeeID); ?>"
                   value="00:00" disabled>
        </div>
<?php endif; ?>
    </div>


</div>

<div class="row" >
<div class="leave-form"
     id="leaveForm<?php echo e($row->employeeID); ?>">
    <div>
           <div class="col-lg-6 col-md-12">
		   <input type="hidden" name="employees[]" value="<?php echo e($row->employeeID); ?>">
            <label class="control-label">Apel Pagi</label>
            <select class="form-control ApelPagi input-sm"
                    onchange="halfDayToggle(<?php echo e($row->employeeID); ?>, this.value)" id="ApelPagi<?php echo e($row->employeeID); ?>"
                    name="apel_pagi[]">
               
				       <option value="0" <?php if($row->apel_pagi=='0'): ?> selected <?php endif; ?>>YA</option>
                       <option value="1" <?php if($row->apel_pagi=='1'): ?> selected <?php endif; ?>>TIDAK</option>
            </select>
        </div>
       <div class="col-lg-6 col-md-12">
            <label class="control-label">Apel Sore</label>
            <select class="form-control ApelSore input-sm"
                    onchange="halfDayToggle(<?php echo e($row->employeeID); ?>, this.value)" id="ApelSore<?php echo e($row->employeeID); ?>"
                    name="apel_sore[]">
               
				       <option value="0" <?php if($row->apel_sore=='0'): ?> selected <?php endif; ?>>YA</option>
                       <option value="1" <?php if($row->apel_sore=='1'): ?> selected <?php endif; ?>>TIDAK</option>
            </select>
        </div>
		       <div class="col-lg-12 col-md-12">
		      <center>  <button type="button" style="width:100%;margin-top:8px" class="btn blue btn-sm" id="update_row<?php echo e($row->employeeID); ?>" onclick="attendanceRow(<?php echo e($row->employeeID); ?>)">Kirim Perubahan</button>   </center>  
				      </div>
    </div>
</div>
</div>
</div>
    
<?php else: ?>
<div style="margin: 0px;   ">
 <span class="label label-danger">Belum Absen</span>
</div>
<?php endif; ?><?php /**PATH C:\xampp\htdocs\newabsen\resources\views/admin/dataapel/col2_normal.blade.php ENDPATH**/ ?>