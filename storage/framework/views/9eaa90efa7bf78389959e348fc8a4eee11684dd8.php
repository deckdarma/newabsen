
    <!-- BEGIN EXAMPLE TABLE PORTLET-->

    
    <div id="error"></div>
	    <div class="row">
    
       <div class="col-md-12 text-center">
            <div class="portlet light bordered">
                <div class="portlet-body">

<div style="text-align: center;font-weight: bold;font-size: 25px;">	FORMULIR KINERJA DAN KEHADIRAN  <?php $__currentLoopData = $datanama; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>   (<?php echo e($data->statusmupeg); ?>)   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>	 </div>
<div style="text-align: center;font-weight: bold;font-size: 20px;margin-top:-5px">BULAN 
						<?php  switch ($databulan) { case '1':     echo 'JANUARI';     break; case '2':     echo 'FEBRUARI';     break; case '3':     echo 'MARET';     break; case '4':     echo 'APRIL';     break; case '5':     echo 'MEI';     break; case '6':     echo 'JUNI';     break; case '7':     echo 'JULI';     break; case '8':     echo 'AGUSTUS';     break; case '9':     echo 'SEPTEMBER';     break; 	case '10':     echo 'OKTOBER';     break; 	case '11':     echo 'NOVEMBER';     break; 		case '12':     echo 'DESEMBER';     break; 		default:     echo '';     break; } ?>
						TAHUN <?php echo e($datatahun); ?>      </div>
		<div style="text-align: center;font-weight: bold;font-size: 18px;margin-bottom:20px;text-transform: uppercase;margin-top:-3px">NAMA : 
<?php $__currentLoopData = $datanama; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<?php echo e($data->full_name); ?> 
<?php if($data->statusmupeg == "ASN"): ?>
/ NIP : <?php echo e($data->employeeID); ?> 
<?php endif; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>	
<br>
<?php

switch($databulan){case '01':$angkabulan = '1';break;case '02':$angkabulan = '2';break;case '03':$angkabulan = '3';break;   	case '04':$angkabulan = '4';break;	case '05':$angkabulan = '5';break;	case '06':$angkabulan = '6';break;	case '07':$angkabulan = '7';break;	case '08':$angkabulan = '8';break;	case '09':$angkabulan = '9';break;	default:$angkabulan = $databulan;break;}

?>
<?php
$bln1 = date("m")-1;
$dateA = Date("Y-$bln1");
$dateB = "$datatahun-$angkabulan";

?> 

		</div>		
                </div>
            </div>

        </div>			
       <input type="hidden" class="form-control only-num" id="hourly_rate" name="hourly_rate"  value="0" disabled>
		<input type="hidden" class="form-control only-num" id="overtime_hours"  name="overtime_hours" value="0">
		<input type="hidden" class="form-control only-num" id="overtime_pay" name="overtime_pay" value="0">
		 <input type="hidden" class="form-control"  name="status"  value="paid">
			 <input type="hidden" class="form-control only-num" id="basic" name="basic" placeholder="<?php echo app('translator')->get("core.basicSalary"); ?> " value="<?php echo e($basicSalary); ?>" readonly>
			   <input type="hidden" class="form-control only-num" id="expense_claim" name="expense"  placeholder="Ketik Tambahan TPP" value="<?php echo e($expense); ?>">










<div class="col-md-6">
    <div class="portlet light bordered">
        <div class="portlet-title">
            <div class="caption font-dark">
              POTONGAN KETERANGAN
            </div>
        </div>
        <div class="portlet-body">
		<?php


	$nnn =0;
	$hitung_ontime =0;
	$jumlahontime  =0;

	$hitung_skor1 = 0;
	$hitung_skor2 = 0;
	$hitung_skor3 = 0;
	$hitung_skor4 = 0;
	$hitungapelpagi = 0;
	$hitungapelsore = 0;
	$cepatpulangcount = 0;
	$countcariliburan = 0;
	$jumlahharikerja = 0;
	$hitungtanpaketers = 0;
	$hitungcountdinas = 0;
	$hitungcountketerangan2 = 0;
	$TOTALhasilskorCDT = 0;
	$TotalcatatnCDTsCDT = 0;
	$TotalnCDT = 0;
	
	$totalhasilskor1 = 0;
$totalhasilskor2 = 0;
$totalhasilskor3 = 0;
$totalhasilskor4 = 0;
$totalhasilskor5 = 0;
$totalhasilskor6 = 0;
$totalhasilskor7 = 0;
$totalhasilskor8 = 0;
$totalcatatn1s1 = 0;
$totalcatatn2s2 = 0;
$totalcatatn3s3 = 0;
$totalcatatn4s4 = 0;
$totalcatatn5s5 = 0;
$totalcatatn6s6 = 0;
$totalcatatn7s7 = 0;
$totalcatatn8s8 = 0;	
	


	?>	
	
<?php if($loggedAdmin->company->datashift==1): ?>	
<?php
	foreach ($presntasiabsen as $persen) {
$datapersen= $persen->potongan_shift;
}
?>	

<?php else: ?>
<?php
	foreach ($presntasiabsen as $persen) {
$datapersen= $persen->potongan;
}
?>		
<?php endif; ?>


<?php if($loggedAdmin->company->datashift==1): ?>	
<?php $__currentLoopData = $leavetype; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				
<div class="form-group" style="margin-bottom: 0px;" id="allowance<?php echo e($data->id); ?>">
<?php


//shift
$dataku  = $data->singkat;
$hitungcountdinas = count(DB::select(DB::raw("SELECT liburshifts.date FROM attendance LEFT JOIN liburshifts ON attendance.date = liburshifts.date WHERE attendance.leaveType ='".$dataku."'  AND attendance.status ='absent' AND application_status ='approved' AND MONTH(liburshifts.date)=" . $databulan . "  AND YEAR(liburshifts.date)=" . $datatahun . "  AND attendance.employee_id=" . $noidapegs)));
$hitungcountdinas2 = count(DB::select(DB::raw("SELECT liburshifts.date FROM attendance LEFT JOIN liburshifts ON attendance.date = liburshifts.date WHERE attendance.leaveType ='".$dataku."' AND attendance.status ='absent' AND application_status ='approved' AND MONTH(attendance.date)=" . $databulan . "  AND YEAR(attendance.date)=" . $datatahun . "   AND attendance.employee_id=" . $noidapegs)));
$hitungcountketerangan = $hitungcountdinas2-$hitungcountdinas;

$hitungcountketerangan2 += $hitungcountdinas2-$hitungcountdinas;



$nCDT=$data->potongan_shift;
$TotalnCDT +=$data->potongan_shift;
$sCDT=$hitungcountketerangan;
$catatnCDTsCDT = $nCDT*$sCDT;
$TotalcatatnCDTsCDT += $nCDT*$sCDT;
$hasilnCDTsCDT = $catatnCDTsCDT/100;

$aCDT=$datapersen;
$bCDT=$hasilnCDTsCDT;
$hasilskorCDT = $aCDT*$bCDT;
$TOTALhasilskorCDT += $aCDT*$bCDT;

?> 
 <div class="col-md-7 margin-bottom-1">

<input type="text" class="form-control" name="allowanceTitle[]" value="<?php echo e($data->leaveType); ?> (<?php echo e($data->singkat); ?>)  = <?php echo e($hitungcountketerangan); ?>x" readonly>
</div>
<div class="col-md-3 margin-bottom-10" > <input type="text" class="form-control" value="<?php echo e($catatnCDTsCDT); ?>x<?php echo e($datapersen); ?>%" readonly></div>
<div class="col-md-2  margin-bottom-10">
                    <input type="text" class="form-control" value="<?php echo e($hasilskorCDT); ?>" name="allowance[]" readonly>
                </div>
            </div>
	
			
	 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>  

<?php else: ?>
<?php $__currentLoopData = $leavetype; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				
<div class="form-group" style="margin-bottom: 0px;" id="allowance<?php echo e($data->id); ?>">
<?php
//normal
$dataku  = $data->singkat;
$hitungcountdinas = count(DB::select(DB::raw("SELECT holidays.date FROM attendance LEFT JOIN holidays ON attendance.date = holidays.date WHERE attendance.leaveType ='".$dataku."' AND attendance.status ='absent' AND application_status ='approved' AND MONTH(holidays.date)=" . $databulan . "  AND YEAR(holidays.date)=" . $datatahun . " AND attendance.employee_id=" . $noidapegs)));
$hitungcountdinas2 = count(DB::select(DB::raw("SELECT holidays.date FROM attendance LEFT JOIN holidays ON attendance.date = holidays.date WHERE attendance.leaveType ='".$dataku."' AND attendance.status ='absent' AND application_status ='approved' AND MONTH(attendance.date)=" . $databulan . "  AND YEAR(attendance.date)=" . $datatahun . " AND attendance.employee_id=" . $noidapegs)));
$hitungcountketerangan = $hitungcountdinas2-$hitungcountdinas;

$hitungcountketerangan2 += $hitungcountdinas2-$hitungcountdinas;




$nCDT=$data->potongan;
$TotalnCDT +=$data->potongan;
$sCDT=$hitungcountketerangan;
$catatnCDTsCDT = $nCDT*$sCDT;
$TotalcatatnCDTsCDT += $nCDT*$sCDT;
$hasilnCDTsCDT = $catatnCDTsCDT/100;

$aCDT=$datapersen;
$bCDT=$hasilnCDTsCDT;
$hasilskorCDT = $aCDT*$bCDT;
$TOTALhasilskorCDT += $aCDT*$bCDT;

?> 
 <div class="col-md-7 margin-bottom-1">
<input type="text" class="form-control" name="allowanceTitle[]" value="<?php echo e($data->leaveType); ?> (<?php echo e($data->singkat); ?>)  = <?php echo e($hitungcountketerangan); ?>x" readonly>
</div>
<div class="col-md-3 margin-bottom-10" > <input type="text" class="form-control" value="<?php echo e($catatnCDTsCDT); ?>x<?php echo e($datapersen); ?>%" readonly></div>
<div class="col-md-2  margin-bottom-10">
                    <input type="text" class="form-control" value="<?php echo e($hasilskorCDT); ?>" name="allowance[]" readonly>
                </div>
            </div>
	
			
	 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>  
<?php endif; ?>


	
	
 
<div class="form-group" style="margin-bottom: 0px;" id="allowance25">
 
                <div class="col-md-7 margin-bottom-1">
                    <input type="text" class="form-control" style="background: #f9fbe4;font-weight: bold;" value="JUMLAH (PEMOTONGAN) = ( <?php echo e($hitungcountketerangan2); ?>x )" readonly="">
                </div>
				<div class="col-md-3 margin-bottom-10"> <input type="text" style="background: #f9fbe4;font-weight: bold;" class="form-control" value="<?php echo e($TotalcatatnCDTsCDT); ?>x<?php echo e($datapersen); ?>%" readonly=""></div>
                <div class="col-md-2  margin-bottom-10">
                    <input type="text" class="allowance form-control" style="background: #f9fbe4;font-weight: bold;" value="<?php echo e($TOTALhasilskorCDT); ?>"  readonly="">
                </div>
  
</div>
			
			
			

			


    </div>
    </div>
</div>


<div class="col-md-6">
    <div class="portlet light bordered">
        <div class="portlet-title">
            <div class="caption font-dark">
     DATA URAIAN SKOR
            </div>
        </div>
        <div class="portlet-body">




<?php if($loggedAdmin->company->datashift==1): ?>	
<?php $__currentLoopData = $attendanceas_shift; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<?php
//shift
$date_jumat_count = $data->datatanggal;
$timestamp_count = strtotime($date_jumat_count);
$carihari_count= date("l", $timestamp_count );
$tampilkanhari_count = strtolower($carihari_count);

?>
	 

 
<?php if($data->status == "present"): ?>

<!-- STAR PERIODE --> <?php if($data->tanggalperiode ==  $data->datatanggal): ?>
 
<?php if($tampilkanhari_count == "sunday" ): ?> <?php else: ?>   
<?php if($tampilkanhari_count == "friday" ): ?>

<?php		
$jam_buka_periode_jumat = $data->jam_masuk_jumat; 
$jam_pulang_periode_jumat = $data->jam_pulang_jumat; 
$jam_akhir_masuk_periode_jumat = $data->jam_akhir_masuk_jumat; 
$jam_akhir_pulang_periode_jumat = $data->jam_akhir_pulang_jumat; 
$ontime_masuk_periode_jumat = $data->ONTIME_masuk_jumat; 
$ontime_pulang_periode_jumat = $data->ONTIME_pulang_jumat; 
$skor1_mulai_periode_jumat = $data->SKOR1_masuk_jumat;
$skor1_akhir_periode_jumat = $data->SKOR1_pulang_jumat;
$skor2_mulai_periode_jumat = $data->SKOR2_masuk_jumat; 
$skor2_akhir_periode_jumat = $data->SKOR2_pulang_jumat;
$skor3_mulai_periode_jumat = $data->SKOR3_masuk_jumat;
$skor3_akhir_periode_jumat = $data->SKOR3_pulang_jumat;
$skor4_mulai_periode_jumat = $data->SKOR4_masuk_jumat;
$skor4_akhir_periode_jumat = $data->SKOR4_pulang_jumat;
$data_periode_jumat = $data->masuk;
$jammulai_periode_jumat = date("H:i:s", strtotime($data_periode_jumat));



			if (( strtotime($jammulai_periode_jumat) >= strtotime("$jam_buka_periode_jumat") ) and (strtotime($jammulai_periode_jumat) <= strtotime("$ontime_pulang_periode_jumat"))  )
			$status4="ONTIME";
		
		
		
			else if (( strtotime($jammulai_periode_jumat) >= strtotime("$skor1_mulai_periode_jumat") ) and (strtotime($jammulai_periode_jumat) <= strtotime("$skor1_akhir_periode_jumat"))  )
			$status4="SKOR1";
			else if (( strtotime($jammulai_periode_jumat) >= strtotime("$skor2_mulai_periode_jumat") ) and (strtotime($jammulai_periode_jumat) <= strtotime("$skor2_akhir_periode_jumat"))  )
			$status4="SKOR2";
			else if (( strtotime($jammulai_periode_jumat) >= strtotime("$skor3_mulai_periode_jumat") ) and (strtotime($jammulai_periode_jumat) <= strtotime("$skor3_akhir_periode_jumat"))  )
			$status4="SKOR3";
		
			else if (( strtotime($jammulai_periode_jumat) >= strtotime("$skor4_mulai_periode_jumat") ) and (strtotime($jammulai_periode_jumat) <= strtotime("$skor4_akhir_periode_jumat")))
			$status4="SKOR4";

			else if (( strtotime($jammulai_periode_jumat) >= strtotime("$jam_akhir_masuk_periode_jumat") ) and (strtotime($jammulai_periode_jumat) <= strtotime("24:00:00"))  )
			$status4= "1";

			else if (( strtotime("00:00:00") <= strtotime("$jam_buka_periode_jumat") )  )
			$status4= "1";


if ($data->pulang != "00:00:00") { 
if (( strtotime($data->pulang) >=  strtotime($jam_pulang_periode_jumat)) and (strtotime($data->pulang) <= strtotime($jam_akhir_pulang_periode_jumat))) { 
} else { 
$cepatpulangcount++;
 } 

} else { 
$cepatpulangcount++; 

} 



if($status4 !=  "1") {	

		$hitungtanpaketers++;

} else { 		
}		
		
?>	


<?php else: ?>
<?php		
$jam_buka_periode = $data->jam_masuk; 
$jam_pulang_periode = $data->jam_pulang; 
$jam_akhir_masuk_periode = $data->jam_akhir_masuk; 
$jam_akhir_pulang_periode = $data->jam_akhir_pulang; 
$ontime_masuk_periode = $data->ONTIME_masuk; 
$ontime_pulang_periode = $data->ONTIME_pulang; 
$skor1_mulai_periode = $data->SKOR1_masuk;
$skor1_akhir_periode = $data->SKOR1_pulang;
$skor2_mulai_periode = $data->SKOR2_masuk; 
$skor2_akhir_periode = $data->SKOR2_pulang;
$skor3_mulai_periode = $data->SKOR3_masuk;
$skor3_akhir_periode = $data->SKOR3_pulang;
$skor4_mulai_periode = $data->SKOR4_masuk;
$skor4_akhir_periode = $data->SKOR4_pulang;
$data_periode = $data->masuk;
$jammulai_periode = date("H:i:s", strtotime($data_periode));



			if (( strtotime($jammulai_periode) >= strtotime("$jam_buka_periode") ) and (strtotime($jammulai_periode) <= strtotime("$ontime_pulang_periode"))  )
			$status4="ONTIME";
			
		
			
			else if (( strtotime($jammulai_periode) >= strtotime("$skor1_mulai_periode") ) and (strtotime($jammulai_periode) <= strtotime("$skor1_akhir_periode"))  )
			$status4="SKOR1";
			else if (( strtotime($jammulai_periode) >= strtotime("$skor2_mulai_periode") ) and (strtotime($jammulai_periode) <= strtotime("$skor2_akhir_periode"))  )
			$status4="SKOR2";
			else if (( strtotime($jammulai_periode) >= strtotime("$skor3_mulai_periode") ) and (strtotime($jammulai_periode) <= strtotime("$skor3_akhir_periode"))  )
			$status4="SKOR3";
		
			else if (( strtotime($jammulai_periode) >= strtotime("$skor4_mulai_periode") ) and (strtotime($jammulai_periode) <= strtotime("$skor4_akhir_periode")))
			$status4="SKOR4";

			else if (( strtotime($jammulai_periode) >= strtotime("$jam_akhir_masuk_periode") ) and (strtotime($jammulai_periode) <= strtotime("24:00:00"))  )
			$status4= "1";

			else if (( strtotime("00:00:00") <= strtotime("$jam_buka_periode") )  )
			$status4= "1";

if ($data->pulang != "00:00:00") { 
if (( strtotime($data->pulang) >=  strtotime($jam_pulang_periode)) and (strtotime($data->pulang) <= strtotime($jam_akhir_pulang_periode))) { 
} else { 
$cepatpulangcount++;
 } 

} else { 
$cepatpulangcount++; 

} 

if($status4 !=  "1") {	
		
		$hitungtanpaketers++;

} else { 		
}

?>







<?php endif; ?>
<?php endif; ?>
<!-- ELSE PERIODE -->  <?php else: ?>
 
<?php if($tampilkanhari_count == "sunday" ): ?> <?php else: ?>  
<?php if($tampilkanhari_count == "friday" ): ?>
<?php

$jam_buka_normal_jumat = $data->jam_masuk_normal_jumat; 
$jam_pulang_normal_jumat = $data->jam_pulang_normal_jumat; 
$jam_akhir_masuk_normal_jumat = $data->jam_akhir_masuk_normal_jumat; 
$jam_akhir_pulang_normal_jumat = $data->jam_akhir_pulang_normal_jumat; 
$ontime_masuk_normal_jumat = $data->ONTIME_masuk_normal_jumat; 
$ontime_pulang_normal_jumat = $data->ONTIME_pulang_normal_jumat; 
$skor1_mulai_normal_jumat = $data->SKOR1_masuk_normal_jumat;
$skor1_akhir_normal_jumat = $data->SKOR1_pulang_normal_jumat;
$skor2_mulai_normal_jumat = $data->SKOR2_masuk_normal_jumat; 
$skor2_akhir_normal_jumat = $data->SKOR2_pulang_normal_jumat;
$skor3_mulai_normal_jumat = $data->SKOR3_masuk_normal_jumat;
$skor3_akhir_normal_jumat = $data->SKOR3_pulang_normal_jumat;
$skor4_mulai_normal_jumat = $data->SKOR4_masuk_normal_jumat;
$skor4_akhir_normal_jumat = $data->SKOR4_pulang_normal_jumat;
$data_normal_jumat = $data->masuk;
$jammulai_normal_jumat = date("H:i:s", strtotime($data_normal_jumat));


			if (( strtotime($jammulai_normal_jumat) >= strtotime("$jam_buka_normal_jumat") ) and (strtotime($jammulai_normal_jumat) <= strtotime("$ontime_pulang_normal_jumat"))  )
			$status4="ONTIME";
			
		
			
			else if (( strtotime($jammulai_normal_jumat) >= strtotime("$skor1_mulai_normal_jumat") ) and (strtotime($jammulai_normal_jumat) <= strtotime("$skor1_akhir_normal_jumat"))  )
			$status4="SKOR1";
			else if (( strtotime($jammulai_normal_jumat) >= strtotime("$skor2_mulai_normal_jumat") ) and (strtotime($jammulai_normal_jumat) <= strtotime("$skor2_akhir_normal_jumat"))  )
			$status4="SKOR2";
			else if (( strtotime($jammulai_normal_jumat) >= strtotime("$skor3_mulai_normal_jumat") ) and (strtotime($jammulai_normal_jumat) <= strtotime("$skor3_akhir_normal_jumat"))  )
			$status4="SKOR3";
		
			else if (( strtotime($jammulai_normal_jumat) >= strtotime("$skor4_mulai_normal_jumat") ) and (strtotime($jammulai_normal_jumat) <= strtotime("$skor4_akhir_normal_jumat")))
			$status4="SKOR4";

			else if (( strtotime($jammulai_normal_jumat) >= strtotime("$jam_akhir_masuk_normal_jumat") ) and (strtotime($jammulai_normal_jumat) <= strtotime("24:00:00"))  )
			$status4= "1";

			else if (( strtotime("00:00:00") <= strtotime("$jam_buka_normal_jumat") )  )
			$status4= "1";


if ($data->pulang != "00:00:00") { 
if (( strtotime($data->pulang) >=  strtotime($jam_pulang_normal_jumat)) and (strtotime($data->pulang) <= strtotime($jam_akhir_pulang_normal_jumat))) { 
} else { 
$cepatpulangcount++;
 } 

} else { 
$cepatpulangcount++; 

} 

if($status4 !=  "1") {	
			
		$hitungtanpaketers++;

} else { 		
}
?>	

<?php else: ?>
<?php

$jam_buka_normal = $data->jam_masuk_normal; 
$jam_pulang_normal = $data->jam_pulang_normal; 
$jam_akhir_masuk_normal = $data->jam_akhir_masuk_normal; 
$jam_akhir_pulang_normal = $data->jam_akhir_pulang_normal; 
$ontime_masuk_normal = $data->ONTIME_masuk_normal; 
$ontime_pulang_normal = $data->ONTIME_pulang_normal; 
$skor1_mulai_normal = $data->SKOR1_masuk_normal;
$skor1_akhir_normal = $data->SKOR1_pulang_normal;
$skor2_mulai_normal = $data->SKOR2_masuk_normal; 
$skor2_akhir_normal = $data->SKOR2_pulang_normal;
$skor3_mulai_normal = $data->SKOR3_masuk_normal;
$skor3_akhir_normal = $data->SKOR3_pulang_normal;
$skor4_mulai_normal = $data->SKOR4_masuk_normal;
$skor4_akhir_normal = $data->SKOR4_pulang_normal;
$data_normal = $data->masuk;
$jammulai_normal = date("H:i:s", strtotime($data_normal));


			if (( strtotime($jammulai_normal) >= strtotime("$jam_buka_normal") ) and (strtotime($jammulai_normal) <= strtotime("$ontime_pulang_normal"))  )
			$status4="ONTIME";
			
	
			
			else if (( strtotime($jammulai_normal) >= strtotime("$skor1_mulai_normal") ) and (strtotime($jammulai_normal) <= strtotime("$skor1_akhir_normal"))  )
			$status4="SKOR1";
			else if (( strtotime($jammulai_normal) >= strtotime("$skor2_mulai_normal") ) and (strtotime($jammulai_normal) <= strtotime("$skor2_akhir_normal"))  )
			$status4="SKOR2";
			else if (( strtotime($jammulai_normal) >= strtotime("$skor3_mulai_normal") ) and (strtotime($jammulai_normal) <= strtotime("$skor3_akhir_normal"))  )
			$status4="SKOR3";
		
			else if (( strtotime($jammulai_normal) >= strtotime("$skor4_mulai_normal") ) and (strtotime($jammulai_normal) <= strtotime("$skor4_akhir_normal")))
			$status4="SKOR4";

			else if (( strtotime($jammulai_normal) >= strtotime("$jam_akhir_masuk_normal") ) and (strtotime($jammulai_normal) <= strtotime("24:00:00"))  )
			$status4= "1";

			else if (( strtotime("00:00:00") <= strtotime("$jam_buka_normal") )  )
			$status4= "1";

if ($data->pulang != "00:00:00") { 
if (( strtotime($data->pulang) >=  strtotime($jam_pulang_normal)) and (strtotime($data->pulang) <= strtotime($jam_akhir_pulang_normal))) { 
} else { 
$cepatpulangcount++;
 } 

} else { 
$cepatpulangcount++; 

}

if($status4 !=  "1") {	
		
		$hitungtanpaketers++;

} else { 		
}
?>	



<?php endif; ?>

<?php endif; ?>
<!-- END PERIODE --> <?php endif; ?>	


	<?php 

switch ($status4)
{ 
case 'ONTIME': 
$hitung_ontime++;
break; 
case 'SKOR1': 
$hitung_skor1++;
break; 
case 'SKOR2': 
$hitung_skor2++;
break; 
 case 'SKOR3':
$hitung_skor3++;			
break; 
case 'SKOR4':
$hitung_skor4++;			
break; 
case '1':
$nnn++;			
break; 
} 
?>
<?php if($data->apel_pagi ==  "1") {
$hitungapelpagi++;	
}
?>
<?php if($data->apel_sore ==  "1") {
$hitungapelsore++;	
}
?>


<?php endif; ?>

<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>		



<?php else: ?>
	



<?php $__currentLoopData = $attendanceas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<?php
//normal
$date_jumat_count = $data->datatanggal;
$timestamp_count = strtotime($date_jumat_count);
$carihari_count= date("l", $timestamp_count );
$tampilkanhari_count = strtolower($carihari_count);

?>
	 

 
<?php if($data->status == "present"): ?>

<!-- STAR PERIODE --> <?php if($data->tanggalperiode ==  $data->datatanggal): ?>
<?php if($tampilkanhari_count == "saturday" ): ?> <?php else: ?>   
<?php if($tampilkanhari_count == "sunday" ): ?> <?php else: ?>   
<?php if($tampilkanhari_count == "friday" ): ?>

<?php		
$jam_buka_periode_jumat = $data->jam_masuk_jumat; 
$jam_pulang_periode_jumat = $data->jam_pulang_jumat; 
$jam_akhir_masuk_periode_jumat = $data->jam_akhir_masuk_jumat; 
$jam_akhir_pulang_periode_jumat = $data->jam_akhir_pulang_jumat; 
$ontime_masuk_periode_jumat = $data->ONTIME_masuk_jumat; 
$ontime_pulang_periode_jumat = $data->ONTIME_pulang_jumat; 
$skor1_mulai_periode_jumat = $data->SKOR1_masuk_jumat;
$skor1_akhir_periode_jumat = $data->SKOR1_pulang_jumat;
$skor2_mulai_periode_jumat = $data->SKOR2_masuk_jumat; 
$skor2_akhir_periode_jumat = $data->SKOR2_pulang_jumat;
$skor3_mulai_periode_jumat = $data->SKOR3_masuk_jumat;
$skor3_akhir_periode_jumat = $data->SKOR3_pulang_jumat;
$skor4_mulai_periode_jumat = $data->SKOR4_masuk_jumat;
$skor4_akhir_periode_jumat = $data->SKOR4_pulang_jumat;
$data_periode_jumat = $data->masuk;
$jammulai_periode_jumat = date("H:i:s", strtotime($data_periode_jumat));



			if (( strtotime($jammulai_periode_jumat) >= strtotime("$jam_buka_periode_jumat") ) and (strtotime($jammulai_periode_jumat) <= strtotime("$ontime_pulang_periode_jumat"))  )
			$status4="ONTIME";
		
		
		
			else if (( strtotime($jammulai_periode_jumat) >= strtotime("$skor1_mulai_periode_jumat") ) and (strtotime($jammulai_periode_jumat) <= strtotime("$skor1_akhir_periode_jumat"))  )
			$status4="SKOR1";
			else if (( strtotime($jammulai_periode_jumat) >= strtotime("$skor2_mulai_periode_jumat") ) and (strtotime($jammulai_periode_jumat) <= strtotime("$skor2_akhir_periode_jumat"))  )
			$status4="SKOR2";
			else if (( strtotime($jammulai_periode_jumat) >= strtotime("$skor3_mulai_periode_jumat") ) and (strtotime($jammulai_periode_jumat) <= strtotime("$skor3_akhir_periode_jumat"))  )
			$status4="SKOR3";
		
			else if (( strtotime($jammulai_periode_jumat) >= strtotime("$skor4_mulai_periode_jumat") ) and (strtotime($jammulai_periode_jumat) <= strtotime("$skor4_akhir_periode_jumat")))
			$status4="SKOR4";

			else if (( strtotime($jammulai_periode_jumat) >= strtotime("$jam_akhir_masuk_periode_jumat") ) and (strtotime($jammulai_periode_jumat) <= strtotime("24:00:00"))  )
			$status4= "1";

			else if (( strtotime("00:00:00") <= strtotime("$jam_buka_periode_jumat") )  )
			$status4= "1";


if ($data->pulang != "00:00:00") { 
if (( strtotime($data->pulang) >=  strtotime($jam_pulang_periode_jumat)) and (strtotime($data->pulang) <= strtotime($jam_akhir_pulang_periode_jumat))) { 
} else { 
$cepatpulangcount++;
 } 

} else { 
$cepatpulangcount++; 

} 



if($status4 !=  "1") {	

		$hitungtanpaketers++;

} else { 		
}		
		
?>	


<?php else: ?>
<?php		
$jam_buka_periode = $data->jam_masuk; 
$jam_pulang_periode = $data->jam_pulang; 
$jam_akhir_masuk_periode = $data->jam_akhir_masuk; 
$jam_akhir_pulang_periode = $data->jam_akhir_pulang; 
$ontime_masuk_periode = $data->ONTIME_masuk; 
$ontime_pulang_periode = $data->ONTIME_pulang; 
$skor1_mulai_periode = $data->SKOR1_masuk;
$skor1_akhir_periode = $data->SKOR1_pulang;
$skor2_mulai_periode = $data->SKOR2_masuk; 
$skor2_akhir_periode = $data->SKOR2_pulang;
$skor3_mulai_periode = $data->SKOR3_masuk;
$skor3_akhir_periode = $data->SKOR3_pulang;
$skor4_mulai_periode = $data->SKOR4_masuk;
$skor4_akhir_periode = $data->SKOR4_pulang;
$data_periode = $data->masuk;
$jammulai_periode = date("H:i:s", strtotime($data_periode));



			if (( strtotime($jammulai_periode) >= strtotime("$jam_buka_periode") ) and (strtotime($jammulai_periode) <= strtotime("$ontime_pulang_periode"))  )
			$status4="ONTIME";
			
		
			
			else if (( strtotime($jammulai_periode) >= strtotime("$skor1_mulai_periode") ) and (strtotime($jammulai_periode) <= strtotime("$skor1_akhir_periode"))  )
			$status4="SKOR1";
			else if (( strtotime($jammulai_periode) >= strtotime("$skor2_mulai_periode") ) and (strtotime($jammulai_periode) <= strtotime("$skor2_akhir_periode"))  )
			$status4="SKOR2";
			else if (( strtotime($jammulai_periode) >= strtotime("$skor3_mulai_periode") ) and (strtotime($jammulai_periode) <= strtotime("$skor3_akhir_periode"))  )
			$status4="SKOR3";
		
			else if (( strtotime($jammulai_periode) >= strtotime("$skor4_mulai_periode") ) and (strtotime($jammulai_periode) <= strtotime("$skor4_akhir_periode")))
			$status4="SKOR4";

			else if (( strtotime($jammulai_periode) >= strtotime("$jam_akhir_masuk_periode") ) and (strtotime($jammulai_periode) <= strtotime("24:00:00"))  )
			$status4= "1";

			else if (( strtotime("00:00:00") <= strtotime("$jam_buka_periode") )  )
			$status4= "1";

if ($data->pulang != "00:00:00") { 
if (( strtotime($data->pulang) >=  strtotime($jam_pulang_periode)) and (strtotime($data->pulang) <= strtotime($jam_akhir_pulang_periode))) { 
} else { 
$cepatpulangcount++;
 } 

} else { 
$cepatpulangcount++; 

} 

if($status4 !=  "1") {	
		
		$hitungtanpaketers++;

} else { 		
}

?>




<?php endif; ?>	


<?php endif; ?>
<?php endif; ?>
<!-- ELSE PERIODE -->  <?php else: ?>
<?php if($tampilkanhari_count == "saturday" ): ?> <?php else: ?>   
<?php if($tampilkanhari_count == "sunday" ): ?> <?php else: ?>  
<?php if($tampilkanhari_count == "friday" ): ?>
<?php

$jam_buka_normal_jumat = $data->jam_masuk_normal_jumat; 
$jam_pulang_normal_jumat = $data->jam_pulang_normal_jumat; 
$jam_akhir_masuk_normal_jumat = $data->jam_akhir_masuk_normal_jumat; 
$jam_akhir_pulang_normal_jumat = $data->jam_akhir_pulang_normal_jumat; 
$ontime_masuk_normal_jumat = $data->ONTIME_masuk_normal_jumat; 
$ontime_pulang_normal_jumat = $data->ONTIME_pulang_normal_jumat; 
$skor1_mulai_normal_jumat = $data->SKOR1_masuk_normal_jumat;
$skor1_akhir_normal_jumat = $data->SKOR1_pulang_normal_jumat;
$skor2_mulai_normal_jumat = $data->SKOR2_masuk_normal_jumat; 
$skor2_akhir_normal_jumat = $data->SKOR2_pulang_normal_jumat;
$skor3_mulai_normal_jumat = $data->SKOR3_masuk_normal_jumat;
$skor3_akhir_normal_jumat = $data->SKOR3_pulang_normal_jumat;
$skor4_mulai_normal_jumat = $data->SKOR4_masuk_normal_jumat;
$skor4_akhir_normal_jumat = $data->SKOR4_pulang_normal_jumat;
$data_normal_jumat = $data->masuk;
$jammulai_normal_jumat = date("H:i:s", strtotime($data_normal_jumat));


			if (( strtotime($jammulai_normal_jumat) >= strtotime("$jam_buka_normal_jumat") ) and (strtotime($jammulai_normal_jumat) <= strtotime("$ontime_pulang_normal_jumat"))  )
			$status4="ONTIME";
			
		
			
			else if (( strtotime($jammulai_normal_jumat) >= strtotime("$skor1_mulai_normal_jumat") ) and (strtotime($jammulai_normal_jumat) <= strtotime("$skor1_akhir_normal_jumat"))  )
			$status4="SKOR1";
			else if (( strtotime($jammulai_normal_jumat) >= strtotime("$skor2_mulai_normal_jumat") ) and (strtotime($jammulai_normal_jumat) <= strtotime("$skor2_akhir_normal_jumat"))  )
			$status4="SKOR2";
			else if (( strtotime($jammulai_normal_jumat) >= strtotime("$skor3_mulai_normal_jumat") ) and (strtotime($jammulai_normal_jumat) <= strtotime("$skor3_akhir_normal_jumat"))  )
			$status4="SKOR3";
		
			else if (( strtotime($jammulai_normal_jumat) >= strtotime("$skor4_mulai_normal_jumat") ) and (strtotime($jammulai_normal_jumat) <= strtotime("$skor4_akhir_normal_jumat")))
			$status4="SKOR4";

			else if (( strtotime($jammulai_normal_jumat) >= strtotime("$jam_akhir_masuk_normal_jumat") ) and (strtotime($jammulai_normal_jumat) <= strtotime("24:00:00"))  )
			$status4= "1";

			else if (( strtotime("00:00:00") <= strtotime("$jam_buka_normal_jumat") )  )
			$status4= "1";


if ($data->pulang != "00:00:00") { 
if (( strtotime($data->pulang) >=  strtotime($jam_pulang_normal_jumat)) and (strtotime($data->pulang) <= strtotime($jam_akhir_pulang_normal_jumat))) { 
} else { 
$cepatpulangcount++;
 } 

} else { 
$cepatpulangcount++; 

} 

if($status4 !=  "1") {	
			
		$hitungtanpaketers++;

} else { 		
}
?>	

<?php else: ?>
<?php

$jam_buka_normal = $data->jam_masuk_normal; 
$jam_pulang_normal = $data->jam_pulang_normal; 
$jam_akhir_masuk_normal = $data->jam_akhir_masuk_normal; 
$jam_akhir_pulang_normal = $data->jam_akhir_pulang_normal; 
$ontime_masuk_normal = $data->ONTIME_masuk_normal; 
$ontime_pulang_normal = $data->ONTIME_pulang_normal; 
$skor1_mulai_normal = $data->SKOR1_masuk_normal;
$skor1_akhir_normal = $data->SKOR1_pulang_normal;
$skor2_mulai_normal = $data->SKOR2_masuk_normal; 
$skor2_akhir_normal = $data->SKOR2_pulang_normal;
$skor3_mulai_normal = $data->SKOR3_masuk_normal;
$skor3_akhir_normal = $data->SKOR3_pulang_normal;
$skor4_mulai_normal = $data->SKOR4_masuk_normal;
$skor4_akhir_normal = $data->SKOR4_pulang_normal;
$data_normal = $data->masuk;
$jammulai_normal = date("H:i:s", strtotime($data_normal));


			if (( strtotime($jammulai_normal) >= strtotime("$jam_buka_normal") ) and (strtotime($jammulai_normal) <= strtotime("$ontime_pulang_normal"))  )
			$status4="ONTIME";
			
	
			
			else if (( strtotime($jammulai_normal) >= strtotime("$skor1_mulai_normal") ) and (strtotime($jammulai_normal) <= strtotime("$skor1_akhir_normal"))  )
			$status4="SKOR1";
			else if (( strtotime($jammulai_normal) >= strtotime("$skor2_mulai_normal") ) and (strtotime($jammulai_normal) <= strtotime("$skor2_akhir_normal"))  )
			$status4="SKOR2";
			else if (( strtotime($jammulai_normal) >= strtotime("$skor3_mulai_normal") ) and (strtotime($jammulai_normal) <= strtotime("$skor3_akhir_normal"))  )
			$status4="SKOR3";
		
			else if (( strtotime($jammulai_normal) >= strtotime("$skor4_mulai_normal") ) and (strtotime($jammulai_normal) <= strtotime("$skor4_akhir_normal")))
			$status4="SKOR4";

			else if (( strtotime($jammulai_normal) >= strtotime("$jam_akhir_masuk_normal") ) and (strtotime($jammulai_normal) <= strtotime("24:00:00"))  )
			$status4= "1";

			else if (( strtotime("00:00:00") <= strtotime("$jam_buka_normal") )  )
			$status4= "1";

if ($data->pulang != "00:00:00") { 
if (( strtotime($data->pulang) >=  strtotime($jam_pulang_normal)) and (strtotime($data->pulang) <= strtotime($jam_akhir_pulang_normal))) { 
} else { 
$cepatpulangcount++;
 } 

} else { 
$cepatpulangcount++; 

}

if($status4 !=  "1") {	
		
		$hitungtanpaketers++;

} else { 		
}
?>	



<?php endif; ?>
	<?php endif; ?>
<?php endif; ?>
<!-- END PERIODE --> <?php endif; ?>	


	<?php 

switch ($status4)
{ 
case 'ONTIME': 
$hitung_ontime++;
break; 
case 'SKOR1': 
$hitung_skor1++;
break; 
case 'SKOR2': 
$hitung_skor2++;
break; 
 case 'SKOR3':
$hitung_skor3++;			
break; 
case 'SKOR4':
$hitung_skor4++;			
break; 
case '1':
$nnn++;			
break; 
} 
?>
<?php if($data->apel_pagi ==  "1") {
$hitungapelpagi++;	
}
?>
<?php if($data->apel_sore ==  "1") {
$hitungapelsore++;	
}
?>


<?php endif; ?>

<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>		
<?php endif; ?>

	

<?php for($i = 0; $i < $daysInMonth; $i++): ?>


 
 <?php if($loggedAdmin->company->datashift==1): ?>	
<?php
 $today = $i;
switch($today){case '1':$datahari = '01';break;case '2':$datahari = '02';break;case '3':$datahari = '03';break;   	case '4':$datahari = '04';break;	case '5':$datahari = '05';break;	case '6':$datahari = '06';break;	case '7':$datahari = '07';break;	case '8':$datahari = '08';break;	case '9':$datahari = '09';break;	default:$datahari = $today;break;}

$carilibur2 = count(DB::select(DB::raw("SELECT * FROM liburshifts WHERE  DAY(date)=" . $datahari . " AND MONTH(date)=" . $databulan . "  AND YEAR(date)=" . $datatahun . " ")));

if ($carilibur2 =="1")  {
	$countcariliburan++;
} else {
$jumlahharikerja++;

}

?>

<?php else: ?>
<?php
 $today = $i;
switch($today){case '1':$datahari = '01';break;case '2':$datahari = '02';break;case '3':$datahari = '03';break;   	case '4':$datahari = '04';break;	case '5':$datahari = '05';break;	case '6':$datahari = '06';break;	case '7':$datahari = '07';break;	case '8':$datahari = '08';break;	case '9':$datahari = '09';break;	default:$datahari = $today;break;}

$carilibur2 = count(DB::select(DB::raw("SELECT * FROM holidays WHERE  DAY(date)=" . $datahari . " AND MONTH(date)=" . $databulan . "  AND YEAR(date)=" . $datatahun . " ")));

if ($carilibur2 =="1")  {
	$countcariliburan++;
} else {
$jumlahharikerja++;

}

?>
<?php endif; ?>

<?php endfor; ?>		


	

		
<?php $__currentLoopData = $dataskor; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

<?php if($data->num_of_leave2 =="1"): ?> 


<?php if($loggedAdmin->company->datashift==1): ?>	
<?php
$n1=$data->potongan_shift;
$s1=$hitung_skor1;
$catatn1s1 = $n1*$s1;
$totalcatatn1s1 += $n1*$s1;
$hasiln1s1 = $catatn1s1/100;

$a1=$datapersen;
$b1=$hasiln1s1;
$hasilskor1 = $a1*$b1;
$totalhasilskor1 += $a1*$b1;

?>

<?php else: ?>
<?php
$n1=$data->potongan;
$s1=$hitung_skor1;
$catatn1s1 = $n1*$s1;
$totalcatatn1s1 += $n1*$s1;
$hasiln1s1 = $catatn1s1/100;

$a1=$datapersen;
$b1=$hasiln1s1;
$hasilskor1 = $a1*$b1;
$totalhasilskor1 += $a1*$b1;

?>	
<?php endif; ?>
            <div class="form-group" style="margin-bottom: 0px;" id="deduction<?php echo e($data->id); ?>">


                <div class="col-md-7 margin-bottom-1">
                    <input type="text" class="form-control" value="<?php echo e($data->dataSkor); ?> (<?php echo e($data->singkat); ?>) = <?php echo e($hitung_skor1); ?>x" name="deductionTitle[]" readonly>
                </div>
				<div class="col-md-3 margin-bottom-10" > <input type="text" class="form-control" value="<?php echo e($catatn1s1); ?>x<?php echo e($datapersen); ?>%" readonly></div>
                <div class="col-md-2  margin-bottom-10">
                    <input type="text" class="form-control" value="<?php echo e($hasilskor1); ?>" name="deduction[]" readonly>
                </div>
        
            </div>
<?php endif; ?>

<?php if($data->num_of_leave2 =="2"): ?> 


<?php if($loggedAdmin->company->datashift==1): ?>	
<?php
$n2=$data->potongan_shift;
$s2=$hitung_skor2;
$catatn2s2 = $n2*$s2;
$totalcatatn2s2 += $n2*$s2;
$hasiln2s2 = $catatn2s2/100;

$a2=$datapersen;
$b2=$hasiln2s2;
$hasilskor2 = $a2*$b2;
$totalhasilskor2 += $a2*$b2;

?>

<?php else: ?>
<?php
$n2=$data->potongan;
$s2=$hitung_skor2;
$catatn2s2 = $n2*$s2;
$totalcatatn2s2 += $n2*$s2;
$hasiln2s2 = $catatn2s2/100;

$a2=$datapersen;
$b2=$hasiln2s2;
$hasilskor2 = $a2*$b2;
$totalhasilskor2 += $a2*$b2;

?>	
<?php endif; ?>
            <div class="form-group" style="margin-bottom: 0px;" id="deduction<?php echo e($data->id); ?>">


                <div class="col-md-7 margin-bottom-1">
                    <input type="text" class="form-control" value="<?php echo e($data->dataSkor); ?> (<?php echo e($data->singkat); ?>) = <?php echo e($hitung_skor2); ?>x" name="deductionTitle[]" readonly>
                </div>
				<div class="col-md-3 margin-bottom-10" > <input type="text" class="form-control" value="<?php echo e($catatn2s2); ?>x<?php echo e($datapersen); ?>%" readonly></div>
                <div class="col-md-2  margin-bottom-10">
                    <input type="text" class="form-control" value="<?php echo e($hasilskor2); ?>" name="deduction[]" readonly>
                </div>
        
            </div>
<?php endif; ?>

<?php if($data->num_of_leave2 =="3"): ?> 


<?php if($loggedAdmin->company->datashift==1): ?>	
<?php
$n3=$data->potongan_shift;
$s3=$hitung_skor3;
$catatn3s3 = $n3*$s3;
$totalcatatn3s3 += $n3*$s3;
$hasiln3s3 = $catatn3s3/100;

$a3=$datapersen;
$b3=$hasiln3s3;
$hasilskor3 = $a3*$b3;
$totalhasilskor3 += $a3*$b3;

?>

<?php else: ?>
<?php
$n3=$data->potongan;
$s3=$hitung_skor3;
$catatn3s3 = $n3*$s3;
$totalcatatn3s3 += $n3*$s3;
$hasiln3s3 = $catatn3s3/100;

$a3=$datapersen;
$b3=$hasiln3s3;
$hasilskor3 = $a3*$b3;
$totalhasilskor3 += $a3*$b3;

?>
<?php endif; ?>
            <div class="form-group" style="margin-bottom: 0px;" id="deduction<?php echo e($data->id); ?>">


                <div class="col-md-7 margin-bottom-1">
                    <input type="text" class="form-control" value="<?php echo e($data->dataSkor); ?> (<?php echo e($data->singkat); ?>) = <?php echo e($hitung_skor3); ?>x" name="deductionTitle[]" readonly>
                </div>
				<div class="col-md-3 margin-bottom-10" > <input type="text" class="form-control" value="<?php echo e($catatn3s3); ?>x<?php echo e($datapersen); ?>%" readonly></div>
                <div class="col-md-2  margin-bottom-10">
                    <input type="text" class="form-control" value="<?php echo e($hasilskor3); ?>" name="deduction[]" readonly>
                </div>
        
            </div>
<?php endif; ?>


<?php if($data->num_of_leave2 =="4"): ?> 


<?php if($loggedAdmin->company->datashift==1): ?>	
<?php
$n4=$data->potongan_shift;
$s4=$hitung_skor4;
$catatn4s4 = $n4*$s4;
$totalcatatn4s4 += $n4*$s4;
$hasiln4s4 = $catatn4s4/100;

$a4=$datapersen;
$b4=$hasiln4s4;
$hasilskor4 = $a4*$b4;
$totalhasilskor4 += $a4*$b4;

?>

<?php else: ?>
<?php
$n4=$data->potongan;
$s4=$hitung_skor4;
$catatn4s4 = $n4*$s4;
$totalcatatn4s4 += $n4*$s4;
$hasiln4s4 = $catatn4s4/100;

$a4=$datapersen;
$b4=$hasiln4s4;
$hasilskor4 = $a4*$b4;
$totalhasilskor4 += $a4*$b4;

?>	
<?php endif; ?>
            <div class="form-group" style="margin-bottom: 0px;" id="deduction<?php echo e($data->id); ?>">


                <div class="col-md-7 margin-bottom-1">
                    <input type="text" class="form-control" value="<?php echo e($data->dataSkor); ?> (<?php echo e($data->singkat); ?>) = <?php echo e($hitung_skor4); ?>x" name="deductionTitle[]" readonly>
                </div>
				<div class="col-md-3 margin-bottom-10" > <input type="text" class="form-control" value="<?php echo e($catatn4s4); ?>x<?php echo e($datapersen); ?>%" readonly></div>
                <div class="col-md-2  margin-bottom-10">
                    <input type="text" class="form-control" value="<?php echo e($hasilskor4); ?>" name="deduction[]" readonly>
                </div>
        
            </div>
<?php endif; ?>


<?php if($data->num_of_leave2 =="5"): ?> 


<?php if($loggedAdmin->company->datashift==1): ?>	
<?php
$n5=$data->potongan_shift;
$s5=$hitungapelpagi;
$catatn5s5 = $n5*$s5;
$totalcatatn5s5 += $n5*$s5;
$hasiln5s5 = $catatn5s5/100;

$a5=$datapersen;
$b5=$hasiln5s5;
$hasilskor5 = $a5*$b5;
$totalhasilskor5 += $a5*$b5;

?>

<?php else: ?>
<?php
$n5=$data->potongan;
$s5=$hitungapelpagi;
$catatn5s5 = $n5*$s5;
$totalcatatn5s5 += $n5*$s5;
$hasiln5s5 = $catatn5s5/100;

$a5=$datapersen;
$b5=$hasiln5s5;
$hasilskor5 = $a5*$b5;
$totalhasilskor5 += $a5*$b5;

?>
<?php endif; ?>
            <div class="form-group" style="margin-bottom: 0px;" id="deduction<?php echo e($data->id); ?>">


                <div class="col-md-7 margin-bottom-1">
                    <input type="text" class="form-control" value="<?php echo e($data->dataSkor); ?> (<?php echo e($data->singkat); ?>) = <?php echo e($hitungapelpagi); ?>x" name="deductionTitle[]" readonly>
                </div>
				<div class="col-md-3 margin-bottom-10" > <input type="text" class="form-control" value="<?php echo e($catatn5s5); ?>x<?php echo e($datapersen); ?>%" readonly></div>
                <div class="col-md-2  margin-bottom-10">
                    <input type="text" class="form-control" value="<?php echo e($hasilskor5); ?>" name="deduction[]" readonly>
                </div>
        
            </div>
<?php endif; ?>


<?php if($data->num_of_leave2 =="6"): ?> 


<?php if($loggedAdmin->company->datashift==1): ?>	
<?php
$n6=$data->potongan_shift;
$s6=$hitungapelsore;
$catatn6s6 = $n6*$s6;
$totalcatatn6s6 += $n6*$s6;
$hasiln6s6 = $catatn6s6/100;

$a6=$datapersen;
$b6=$hasiln6s6;
$hasilskor6 = $a6*$b6;
$totalhasilskor6 += $a6*$b6;

?>

<?php else: ?>
<?php
$n6=$data->potongan;
$s6=$hitungapelsore;
$catatn6s6 = $n6*$s6;
$totalcatatn6s6 += $n6*$s6;
$hasiln6s6 = $catatn6s6/100;

$a6=$datapersen;
$b6=$hasiln6s6;
$hasilskor6 = $a6*$b6;
$totalhasilskor6 += $a6*$b6;

?>	
<?php endif; ?>
            <div class="form-group" style="margin-bottom: 0px;" id="deduction<?php echo e($data->id); ?>">


                <div class="col-md-7 margin-bottom-1">
                    <input type="text" class="form-control" value="<?php echo e($data->dataSkor); ?> (<?php echo e($data->singkat); ?>) = <?php echo e($hitungapelsore); ?>x" name="deductionTitle[]" readonly>
                </div>
				<div class="col-md-3 margin-bottom-10" > <input type="text" class="form-control" value="<?php echo e($catatn6s6); ?>x<?php echo e($datapersen); ?>%" readonly></div>
                <div class="col-md-2  margin-bottom-10">
                    <input type="text" class="form-control" value="<?php echo e($hasilskor6); ?>" name="deduction[]" readonly>
                </div>
        
            </div>
<?php endif; ?>


<?php if($data->num_of_leave2 =="7"): ?> 


<?php if($loggedAdmin->company->datashift==1): ?>	
<?php
$n7=$data->potongan_shift;
$s7=$cepatpulangcount;
$catatn7s7 = $n7*$s7;
$totalcatatn7s7 += $n7*$s7;
$hasiln7s7 = $catatn7s7/100;

$a7=$datapersen;
$b7=$hasiln7s7;
$hasilskor7 = $a7*$b7;
$totalhasilskor7 += $a7*$b7;

?>

<?php else: ?>
<?php
$n7=$data->potongan;
$s7=$cepatpulangcount;
$catatn7s7 = $n7*$s7;
$totalcatatn7s7 += $n7*$s7;
$hasiln7s7 = $catatn7s7/100;

$a7=$datapersen;
$b7=$hasiln7s7;
$hasilskor7 = $a7*$b7;
$totalhasilskor7 += $a7*$b7;

?>
<?php endif; ?>
            <div class="form-group" style="margin-bottom: 0px;" id="deduction<?php echo e($data->id); ?>">


                <div class="col-md-7 margin-bottom-1">
                    <input type="text" class="form-control" value="<?php echo e($data->dataSkor); ?> (<?php echo e($data->singkat); ?>) = <?php echo e($cepatpulangcount); ?>x" name="deductionTitle[]" readonly>
                </div>
				<div class="col-md-3 margin-bottom-10" > <input type="text" class="form-control" value="<?php echo e($catatn7s7); ?>x<?php echo e($datapersen); ?>%" readonly></div>
                <div class="col-md-2  margin-bottom-10">
                    <input type="text" class="form-control" value="<?php echo e($hasilskor7); ?>" name="deduction[]" readonly>
                </div>
        
            </div>
<?php endif; ?>


<?php if($data->num_of_leave2 =="8"): ?> 
		<?php $hitungjumlahket = $jumlahharikerja-$hitungtanpaketers-$hitungcountketerangan2 ?>

<?php if($loggedAdmin->company->datashift==1): ?>	
<?php
$n8=$data->potongan_shift;
$s8=$hitungjumlahket;
$catatn8s8 = $n8*$s8;
$totalcatatn8s8 += $n8*$s8;
$hasiln8s8 = $catatn8s8/100;

$a8=$datapersen;
$b8=$hasiln8s8;
$hasilskor8 = $a8*$b8;
$totalhasilskor8 += $a8*$b8;

?>


<?php else: ?>
<?php
$n8=$data->potongan;
$s8=$hitungjumlahket;
$catatn8s8 = $n8*$s8;
$totalcatatn8s8 += $n8*$s8;
$hasiln8s8 = $catatn8s8/100;

$a8=$datapersen;
$b8=$hasiln8s8;
$hasilskor8 = $a8*$b8;
$totalhasilskor8 += $a8*$b8;

?>

<?php endif; ?>
            <div class="form-group" style="margin-bottom: 0px;" id="deduction<?php echo e($data->id); ?>">


                <div class="col-md-7 margin-bottom-1">
                    <input type="text" class="form-control" value="<?php echo e($data->dataSkor); ?> (<?php echo e($data->singkat); ?>) = <?php echo e($hitungjumlahket); ?>x" name="deductionTitle[]" readonly>
                </div>
				<div class="col-md-3 margin-bottom-10" > <input type="text" class="form-control" value="<?php echo e($catatn8s8); ?>x<?php echo e($datapersen); ?>%" readonly></div>
                <div class="col-md-2  margin-bottom-10">
                    <input type="text" class="form-control" value="<?php echo e($hasilskor8); ?>" name="deduction[]" readonly>
                </div>
        
            </div>
<?php endif; ?>


<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>





<?php $hitungjumlahskors = $hitung_skor1+$hitung_skor2+$hitung_skor3+$hitung_skor4+$hitungapelpagi+$hitungapelsore+$cepatpulangcount+$hitungjumlahket; ?>
<?php $presentasehitungskors = $totalhasilskor1+$totalhasilskor2+$totalhasilskor3+$totalhasilskor4+$totalhasilskor5+$totalhasilskor6+$totalhasilskor7+$totalhasilskor8; ?>
<?php $totalhitungskorssemua = $totalcatatn1s1+$totalcatatn2s2+$totalcatatn3s3+$totalcatatn4s4+$totalcatatn5s5+$totalcatatn6s6+$totalcatatn7s7+$totalcatatn8s8; ?>
<div class="form-group" style="margin-bottom: 0px;" id="allowance25">
 
                <div class="col-md-7 margin-bottom-1">
                    <input type="text" class="form-control" style="background: #f9fbe4;font-weight: bold;" value="JUMLAH (SKOR) = ( <?php echo e($hitungjumlahskors); ?>x )" readonly="">
                </div>
				<div class="col-md-3 margin-bottom-10"> <input type="text" style="background: #f9fbe4;font-weight: bold;" class="form-control" value="<?php echo e($totalhitungskorssemua); ?>x<?php echo e($datapersen); ?>%" readonly=""></div>
                <div class="col-md-2  margin-bottom-10">
                    <input type="text" class="deduction form-control" style="background: #f9fbe4;font-weight: bold;" value="<?php echo e($presentasehitungskors); ?>"  readonly="">
                </div>
  
</div>
		
			
			


	

        </div>
    </div>
</div>






<div class="col-md-12">
    <div class="portlet light bordered">
        <div class="portlet-title">
            <div class="caption font-dark">
        FORMULIR KINERJA DAN KEHADIRAN
            </div>
        </div>
        <div class="portlet-body">


		
<?php  
$jumlahkandatasemua = $presentasehitungskors+$TOTALhasilskorCDT;
$aJUMS=$datapersen;
$bJUMS=$jumlahkandatasemua;
$hasilskorJUMS = $aJUMS-$bJUMS;
$cektotalskorpeg=$hasilskorJUMS*100;
?>


<?php if(strtotime($dateB) > strtotime($dateA)): ?>
<div class="note note-warning margin-top-15" style="font-size: 15px;    font-weight: 550;
 ">
MAAF, ANDA BELUM DAPAT MENCATAT LAPORAN KINERJA DAN KEHADIRAN KARENA BULAN 
						<?php  switch ($databulan) { case '1':     echo 'JANUARI';     break; case '2':     echo 'FEBRUARI';     break; case '3':     echo 'MARET';     break; case '4':     echo 'APRIL';     break; case '5':     echo 'MEI';     break; case '6':     echo 'JUNI';     break; case '7':     echo 'JULI';     break; case '8':     echo 'AGUSTUS';     break; case '9':     echo 'SEPTEMBER';     break; 	case '10':     echo 'OKTOBER';     break; 	case '11':     echo 'NOVEMBER';     break; 		case '12':     echo 'DESEMBER';     break; 		default:     echo '';     break; } ?>
						TAHUN <?php echo e($datatahun); ?>  ADALAH BULAN DAN TAHUN BERJALAN
</div>
<?php else: ?>
	
<?php $__currentLoopData = $datanama; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $databagi): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<?php if($databagi->statusmupeg == "ASN"): ?>
	
<?php if($basicSalary == 0): ?>

<div class="note note-danger margin-top-15" style="font-size: 15px;    font-weight: 550;
 ">
HARAP TAMBAHKAN NILAI TPP TERLEBIH DAHULU DI EDIT DATA PEGAWAI  <a href="../employees/<?php echo e($databagi->dataid); ?>/edit">KLIK DISINI</a>
</div>

<?php else: ?>
<table border="0" width="100%" class="table table-bordered" style="text-align: center;    font-size: 11px;">
<tbody>
	
<tr>
<td colspan="3">HASIL PENGHASILAN BOBOT KINERJA	</td>
<td colspan="3">PEMOTONGAN</td>
<td rowspan="2">TOTAL BOBOT</td>
<td rowspan="2">NILAI TPP</td>
<td rowspan="2">TAMBAHAN TPP</td>
<td rowspan="2">JUMLAH KOTOR</td>
<?php $__currentLoopData = $datagols; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<td rowspan="2">PPh 21<br><div style="color:red"><?php echo e($data->golonganPeg); ?> / <?php echo e($data->potongan); ?>%</div>
<input  type="hidden"  name="pph_pegawai"  value="<?php echo e($data->potongan); ?>%">
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>	
</td>
<td rowspan="2">IWP 1% (Rp)</td>
<td rowspan="2">JUMLAH BERSIH</td>

</tr>
	
	<tr>
<td>JUMLAH SKOR PRESTASI KEHADIRAN</td>
<td>JUMLAH SKOR PRESTASI KERJA </td>
<td>TOTAL</td>
<td>PEMOTONGAN CUTI</td>
<td>PEMOTONGAN HUKUMAN DISIPLIN</td>
<td>TOTAL</td>
	</tr>

<tr>
<td>(%)</td>
<td>(%)</td>
<td>(%)</td>
<td>(%)</td>
<td>(%)</td>
<td>(%)</td>
<td>(%)</td>
<td>(Rp)</td>
<td>(Rp)</td>
<td>(Rp)</td>
<td>(%)</td>
<td>(Rp)</td>	
<td>(Rp)</td>	
</tr>
	
	<tr>
<td>1</td>
<td>2</td>
<td>3=1+1</td>
<td>4</td>
<td>5</td>
<td>6=4+5)</td>
<td>7=3-6)</td>
<td>8</td>	
<td>9</td>
<td>10=7x8+9</td>
<td>11</td>
<td>12=(1/100)*(8+9)</td>
<td>13=10-11-12</td>

	</tr>



	
<tr>
<td style="vertical-align: middle;width: 50px;">
<input type="hidden"  id="datakehadiranlihat"  value="0" style="width: 70px;    text-align: left;" class="form-control" id="b2" required="">
<input type="text" onkeypress="validate(event)" name="jumlah_prestasi_kehadiran" style="width: 70px; background-color: #f6dbdb; text-align: center;" class="form-control" id="totalkehadirandata" readonly>
</td>

<td style="vertical-align: middle;width: 70px;">
<input type="hidden"  style="width: 50px;" value="<?php echo e($cektotalskorpeg); ?>" id="a2"  readonly>
<input type="number"   min="0" step="5" max="60"  id="b2" name="jumlah_prestasi_kinerja" value="0" style="width: 70px;    text-align: center;" class="form-control" id="b2" required>

</td>

<td style="vertical-align: middle;width: 60px;">
<input type="text" id="hasil2" placeholder="-" style="width: 60px;text-align: center;background-color: #f6dbdb;" name="total_prestasi_kinerja" class="form-control" readonly>	
</td>

<td style="vertical-align: middle;">
<input oninput="process(this)" type="number" style="width: 60px;text-align: center;" class="form-control" name="pemotongan_cuti_kinerja" value="0" id="c2">
</td>

<td style="vertical-align: middle;">
<input oninput="process(this)" type="number" style="width: 60px;text-align: center;" class="form-control" name="pemotongan_hukuman_kinerja" value="0" id="d2">
</td>

<td style="vertical-align: middle;">
<input type="text" id="hasil3" placeholder="-" name="total_pemotongan_kinerja" style="width: 50px;text-align: center;background-color: #f6dbdb;" class="form-control" readonly>
</td>

<td style="vertical-align: middle;width: 50px;">
<input type="text" id="hasil4" placeholder="-" class="form-control" name="total_bobot_kinerja" readonly style="width: 70px;    text-align: center;background-color: #f6dbdb;">
</td>

<td style="vertical-align: middle; text-align: center;">
<?php echo e($basicSalary); ?><input type="hidden" id="h2" value="<?php echo e($basicSalary); ?>" name="nilai_tpp_kinerja" placeholder="-" style="width: 80px; text-align: center;background-color: #f6dbdb;" class="noborder" readonly>
</td>
		

<td style="vertical-align: middle;">
<input oninput="process(this)" type="number" style="width: 100%;text-align: center;" class="form-control" name="tambahan_tpp_rp" value="0" id="hasiltpp">
<input oninput="process(this)" type="hidden" style="width: 100%;text-align: center;" class="form-control"  value="0" id="hasil9">
</td>
		
<td style="vertical-align: middle;">
<input type="text" id="hasil5" name="jumlah_kotor_kinerja" placeholder="-" class="form-control" style="width: 100%;text-align: center;background-color: #f6dbdb;" readonly>
</td>

<td style="vertical-align: middle;width: 95px;">	

<?php $__currentLoopData = $datagols; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<input type="hidden" id="p2" value="<?php echo e($data->potongan); ?>" readonly="">
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>	

<input type="text" id="hasil6" placeholder="-" name="nilai_pajak_kinerja" class="form-control" style="width: 95px;text-align: center;background-color: #f6dbdb;" readonly>
</td>
<td style="vertical-align: middle;"><input type="text" id="hasil8" name="jumlah_iwp" placeholder="-" class="form-control" style="width: 100%;text-align: center;background-color: #f6dbdb;" readonly>
</td>
<td style="vertical-align: middle;">
<input type="text" id="hasil7" name="jumlah_bersih_keseluruhan" placeholder="-" class="form-control" style="width: 100%;text-align: center;background-color: #f6dbdb;" readonly>
</td>



</tr>
	
	
	
	




</tbody>
</table>
<?php endif; ?>



<?php else: ?>
	





<?php if($basicSalary == 0): ?>

<div class="note note-danger margin-top-15" style="font-size: 15px;    font-weight: 550;
 ">
HARAP TAMBAHKAN NILAI HONORIUM TERLEBIH DAHULU DI EDIT DATA PEGAWAI
</div>

<?php else: ?>


<table border="0" width="100%" class="table table-bordered" style="text-align: center;    font-size: 11px;">
<tbody>
	<tr>
	
	
		<td colspan="3">
			HASIL PENGHASILAN BOBOT KINERJA		
			</td>

		<td rowspan="2">
	TOTAL BOBOT

</td>


		<td rowspan="2">
		NILAI HONOR

</td>


		<td rowspan="2">
		JUMLAH KOTOR

</td>
		<td rowspan="2">
	PPh 21<br>
	<div style="color:red">	0%</div>

</td>
		<td rowspan="2">
		JUMLAH BERSIH

</td>

	</tr>
	<tr>
		<td>
			JUMLAH SKOR PRESTASI KEHADIRAN
</td>
		<td>
		JUMLAH SKOR PRESTASI KERJA 
</td>
		<td>
	TOTAL 
</td>


	</tr>
	<tr>
		<td>
		(%)
</td>
		<td>
			(%)
</td>
		<td>
		(%)
</td>
		<td>
		(%)
</td>
	

					<td>
		(Rp)</td>
				<td>
		(Rp)</td>
				<td>
		(%)</td>
				<td>
		(Rp)</td>
		
	</tr>
	<tr>


		<td>
	1</td>
		<td>
	2</td>
		<td>
		3=1+2
</td>


		<td>
4
</td>
		<td>
			5</td>
			

		<td>
		6=4x5
		</td>
		<td>
	7
</td>
		<td>
	8=6-7
</td>

	</tr>
	
	<tr>
<input  type="hidden"  name="pph_pegawai"  value="0%">

<td style="vertical-align: middle;width: 50px;">
<input type="hidden"  id="datakehadiranlihat"  value="0" style="width: 70px;    text-align: left;" class="form-control" id="b2" required="">
<input type="text" onkeypress="validate(event)" name="jumlah_prestasi_kehadiran" style="width: 70px; background-color: #f6dbdb; text-align: center;" class="form-control" id="totalkehadirandata" readonly>
</td>
<td style="vertical-align: middle;width: 70px;">
<input type="hidden"  style="width: 50px;" value="<?php echo e($cektotalskorpeg); ?>" id="a2"  readonly>
<input type="number"   min="0" step="5" max="60"  id="b2" name="jumlah_prestasi_kinerja" value="0" style="width: 70px;    text-align: center;" class="form-control" id="b2" required>

</td>
<td style="vertical-align: middle;width: 60px;">
<input type="text" id="hasil2" placeholder="-" style="width: 60px;text-align: center;background-color: #f6dbdb;" name="total_prestasi_kinerja" class="form-control" readonly>	
</td>
		

			
<input oninput="process(this)" type="hidden" style="width: 60px;text-align: center;" class="form-control" name="pemotongan_cuti_kinerja" value="0" id="c2">
<input oninput="process(this)" type="hidden" style="width: 60px;text-align: center;" class="form-control" name="pemotongan_hukuman_kinerja" value="0" id="d2">
<input type="hidden" id="hasil3" placeholder="-" name="total_pemotongan_kinerja" style="width: 50px;text-align: center;background-color: #f6dbdb;" class="form-control" readonly>
<td style="vertical-align: middle;width: 50px;">
<input type="text" id="hasil4" placeholder="-" class="form-control" name="total_bobot_kinerja" readonly style="width: 70px;    text-align: center;background-color: #f6dbdb;">
</td>
<td style="vertical-align: middle; text-align: center;width: 200px;">
<?php echo e($basicSalary); ?><input type="hidden" id="h2" value="<?php echo e($basicSalary); ?>" name="nilai_tpp_kinerja" placeholder="-" style="width: 200px; text-align: center;background-color: #f6dbdb;" class="noborder" readonly>
</td>
<input oninput="process(this)" type="hidden" style="width: 100%;text-align: center;" class="form-control" name="tambahan_tpp_rp" value="0" id="hasiltpp">
<input oninput="process(this)" type="hidden" style="width: 100%;text-align: center;" class="form-control"  value="0" id="hasil9">
		
<td style="vertical-align: middle;width: 200px;">
<input type="text" id="hasil5" name="jumlah_kotor_kinerja" placeholder="-" class="form-control" style="text-align: center;background-color: #f6dbdb;" readonly>
</td>
		
		
<td style="vertical-align: middle;width: 95px;">	

<input type="hidden" id="p2" value="0" readonly="">
<input type="text" id="hasil6" placeholder="-" name="nilai_pajak_kinerja" class="form-control" style="width: 95px;text-align: center;background-color: #f6dbdb;" readonly>
<input type="hidden"  name="jumlah_iwp" value="0" class="form-control" style="width: 100%;text-align: center;background-color: #f6dbdb;" readonly>
</td>
<td style="vertical-align: middle;">
<input type="text" id="hasil12" name="jumlah_bersih_keseluruhan" placeholder="-" class="form-control" style="width: 100%;text-align: center;background-color: #f6dbdb;" readonly>
</td>

	</tr>
	
	
	
	
	



</tbody>
</table>
<?php endif; ?>











<?php endif; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>	
<?php endif; ?>













	
<?php if(strtotime($dateB) > strtotime($dateA)): ?>
<?php else: ?>		
          


<?php $__currentLoopData = $datanama; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

<?php if($data->statusmupeg == "ASN"): ?>
 <input type="hidden" class="form-control"  name="pay_date" value="<?php echo e($datatahun); ?>-<?php echo e($databulan); ?>-01" readonly> 		
<?php else: ?>	
	 <input type="hidden" class="form-control"  name="pay_date" value="0000-00-00" readonly> 		
<?php endif; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>		
		





            <div class="form-group" style="margin-bottom: 0px;display:none" >
                <label class="control-label col-md-3"><?php echo app('translator')->get("core.totalAllowances"); ?> (<?php echo e($loggedAdmin->company->currency_symbol); ?>)</label>

                <div class="col-md-7 margin-bottom-1">
                    <input type="text" class="form-control" id="total_allowance" name="total_allowance"
                           placeholder="<?php echo app('translator')->get("core.total"); ?>" value="0" readonly>
						   
						         
                </div>
            </div>
            <div class="form-group" style="margin-bottom: 0px;display:none" >
                <label class="control-label col-md-3"><?php echo app('translator')->get("core.totalDeductions"); ?> (<?php echo e($loggedAdmin->company->currency_symbol); ?>)</label>

                <div class="col-md-7 margin-bottom-1">
                    <input type="text" class="form-control" id="total_deduction" name="total_deduction"
                           placeholder="<?php echo app('translator')->get("core.total"); ?>" value="0" readonly>
                </div>
            </div>
            <div class="form-group" style="margin-bottom: 0px;display:none" >
                <label class="control-label col-md-3"><?php echo app('translator')->get("core.netSalary"); ?> (<?php echo e($loggedAdmin->company->currency_symbol); ?>)</label>

                <div class="col-md-7 margin-bottom-1">
                    <input type="text" class="form-control"  name="net_salary" value="<?php echo e($basicSalary); ?>"
                           value="0" readonly>
                </div>
            </div>
			
<?php endif; ?>
        </div>
    </div>
</div>

<?php if(strtotime($dateB) > strtotime($dateA)): ?>
<?php else: ?>	
	
<?php if($basicSalary == 0): ?>
<?php else: ?>
<div class="col-md-12 text-center">
    <div class="portlet light bordered">
        <div class="portlet-body">
            <button type="button" class="btn btn-success btn-lg" onclick="submitData();return false;">TAMBAHKAN KINERJA DAN KEHADIRAN</button>
        </div>

    </div>
    </div>
<?php endif; ?>		
	
	
<?php endif; ?>	
<style>
.table td, .table th {
    font-size: 11px;
}
</style>
<style>
.table-bordered > tbody > tr > td, .table-bordered > tfoot > tr > th, .table-bordered > tfoot > tr > td {
    border: 1px solid #c2cad8;
}

.table-responsive {
    overflow-x: hidden;
    min-height: 0.01%;
}

</style><?php /**PATH C:\xampp\htdocs\newabsen\resources\views/admin/payrolls/create_add.blade.php ENDPATH**/ ?>