<?php if($noidapegs !="all"): ?> 


<div class="table-toolbar">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="btn-group">
                             <a href="javascript:printDiv('id-elemen-yang-ingin-di-print');" class="btn green"> <i class="fa fa-print"></i>  Print Halaman ini</a>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                    </div>
                                </div>
                            </div>


<div id="id-elemen-yang-ingin-di-print"> 

						<div style="text-align: center;font-weight: bold;font-size: 25px;">	LAPORAN PEGAWAI (PHL)</div>
						<div style="text-align: center;font-weight: bold;font-size: 20px;text-transform: uppercase;margin-top: -5px;"><?php echo e($loggedAdmin->company->company_name); ?> </div>
													<div style="text-align: center;font-weight: bold;font-size: 15px;text-transform: uppercase;margin-top: -3px;">NAMA : <?php echo e($namapegawai); ?> </div>
					<div style="text-align: center;font-weight: bold;font-size: 15px;text-transform: uppercase;margin-top: -3px;margin-bottom:20px;">BULAN 
						<?php  switch ($databulan) { case '1':     echo 'JANUARI';     break; case '2':     echo 'FEBRUARI';     break; case '3':     echo 'MARET';     break; case '4':     echo 'APRIL';     break; case '5':     echo 'MEI';     break; case '6':     echo 'JUNI';     break; case '7':     echo 'JULI';     break; case '8':     echo 'AGUSTUS';     break; case '9':     echo 'SEPTEMBER';     break; 	case '10':     echo 'OKTOBER';     break; 	case '11':     echo 'NOVEMBER';     break; 		case '12':     echo 'DESEMBER';     break; 		default:     echo '';     break; } ?>
						TAHUN <?php echo e($datatahun); ?>      </div>

        <table border="0" width="100%" class="table table-bordered">
<tbody>
<tr>

<td width="" align="center"><b>TANGGAL</b></td>
<td align="center"><b>JENIS ABSEN</b></td>
<td align="center"><b>MASUK</b></td>
<td align="center"><b>PULANG</b></td>
<td align="center"><b>TOTAL JAM KERJA</b></td>
<td align="center"><b>APEL PAGI</b></td>
<td align="center"><b>APEL SORE</b></td>
</tr>

 
   <?php for($i = 1; $i <= $daysInMonth; $i++): ?>

<tr>

   <?php 
   $totalMasukCount = 0;
   $totalPulangCount = 0;
   $totalleaveTypeCount = 0;
   $totalStatusCount = 0;
   $totalNamaEventCount = 0;
	$tanggalperiode = 0;
	$datatanggal = 0;




   ?>
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


	?>


<?php
$today = $i;
switch($today){case '1':$datahari = '01';break;case '2':$datahari = '02';break;case '3':$datahari = '03';break;   	case '4':$datahari = '04';break;	case '5':$datahari = '05';break;	case '6':$datahari = '06';break;	case '7':$datahari = '07';break;	case '8':$datahari = '08';break;	case '9':$datahari = '09';break;	default:$datahari = $today;break;}
$bulan = $databulan;
switch($bulan){case '1':$bulanini = '01';break;case '2':$bulanini = '02';break;case '3':$bulanini = '03';break;   	case '4':$bulanini = '04';break;	case '5':$bulanini = '05';break;	case '6':$bulanini = '06';break;	case '7':$bulanini = '07';break;	case '8':$bulanini = '08';break;	case '9':$bulanini = '09';break;	default:$bulanini = $bulan;break;}



$date_create = $datatahun . '-' . $bulanini . '-'.$datahari;
$masuk = 'Tanpa Keterangan';
$pulang = '-';
$status = '-';




 ?>

<td><?php echo e($date_create); ?></td>

<?php
$carilibur = count(DB::select(DB::raw("SELECT * FROM holidays WHERE  DAY(date)=" . $datahari . " AND MONTH(date)=" . $databulan . "  AND YEAR(date)=" . $datatahun . " ")));

 ?>


<?php $__currentLoopData = $attendanceas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

<?php
 $date_to_check = date('Y-m-d', strtotime($data->datatanggal));
 ?>

    <?php if($date_create == $date_to_check): ?>

       <?php
        $masuk = $data->masuk;
		$totalMasukCount++;
        $pulang = $data->pulang;
		
        ?>     
		<?php
		$pulang = $data->pulang;
		$totalPulangCount++;
        ?>
			<?php
		$status = $data->status;
		$totalStatusCount++;
        ?>			
		
		<?php
		$nama_event = $data->nama_event;
		$apelsore = $data->apel_sore;
		$apelpagi = $data->apel_pagi;
        ?>		
		


		
		<?php

		$leaveType = $data->leaveType;
		$namaketerangan = $data->namaketerangan;
	
        ?>
		
			<?php

		$tanggalperiode = $data->tanggalperiode;
		$datatanggal = $data->datatanggal;

?>

<?php
$date_jumat_for = $data->datatanggal;
$timestamp_for = strtotime($date_jumat_for);
$carihari_for= date("l", $timestamp_for);
$tampilkanhari_for = strtolower($carihari_for);


$d1 = new DateTime($data->masuk);
$d2 = new DateTime($data->pulang);
$interval = $d2->diff($d1);
$jamkerjapeg = $interval->format('%H jam, %I menit');

?>

<!-- STAR PERIODE --> <?php if($data->tanggalperiode ==  $data->datatanggal): ?>

<?php if($tampilkanhari_for == "friday"): ?>
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

?>
	
<?php endif; ?>	

<!-- ELSE PERIODE -->  <?php else: ?>
<?php if($tampilkanhari_for == "friday"): ?>
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


?>	

<?php endif; ?>

<!-- END PERIODE --> <?php endif; ?>


<?php else: ?>

<?php endif; ?>	



<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>




<?php
$date_jumat = $datatanggal;
$timestamp = strtotime($date_jumat);
$carihari= date("l", $timestamp );
$tampilkanhari = strtolower($carihari);

?>


<!-- STAR PERIODE --> <?php if($tanggalperiode ==  $datatanggal): ?>

<?php echo $__env->make('admin.laporanphl.data_periode', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!-- ELSE PERIODE -->  <?php else: ?>

<?php echo $__env->make('admin.laporanphl.data_normal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>	
<!-- END PERIODE --> <?php endif; ?>
 




</tr>
<?php endfor; ?>


</tbody>
</table>

<?php for($i = 0; $i < $daysInMonth; $i++): ?>
<?php
 $today = $i;
switch($today){case '1':$datahari = '01';break;case '2':$datahari = '02';break;case '3':$datahari = '03';break;   	case '4':$datahari = '04';break;	case '5':$datahari = '05';break;	case '6':$datahari = '06';break;	case '7':$datahari = '07';break;	case '8':$datahari = '08';break;	case '9':$datahari = '09';break;	default:$datahari = $today;break;}
$date_create = $datatahun . '-' . $databulan . '-'.$datahari;
$carilibur2 = count(DB::select(DB::raw("SELECT * FROM holidays WHERE  DAY(date)=" . $datahari . " AND MONTH(date)=" . $databulan . "  AND YEAR(date)=" . $datatahun . " ")));

if ($carilibur2 =="1")  {
	$countcariliburan++;
} else {
$jumlahharikerja++;

}

?>

 
<?php endfor; ?>


          <div class="row">
        <div class="col-md-6" >
        <div >
          <table border="0" width="100%" class="table table-bordered" style="margin-top:10px;">

<tbody>
<tr>

	<td colspan="4" style="font-weight: bold;text-align: left;text-align:center">
DATA URAIAN KETERANGAN</td>

</tr>
<?php $__currentLoopData = $leavetype; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<?php
$dataku  = $data->singkat;
$hitungcountdinas = count(DB::select(DB::raw("SELECT holidays.date FROM attendance LEFT JOIN holidays ON attendance.date = holidays.date WHERE attendance.leaveType ='".$dataku."' AND attendance.status ='absent' AND application_status ='approved' AND MONTH(holidays.date)=" . $databulan . "  AND YEAR(holidays.date)=" . $datatahun . " AND attendance.employee_id=" . $noidapegs)));
$hitungcountdinas2 = count(DB::select(DB::raw("SELECT holidays.date FROM attendance LEFT JOIN holidays ON attendance.date = holidays.date WHERE attendance.leaveType ='".$dataku."' AND attendance.status ='absent' AND application_status ='approved' AND MONTH(attendance.date)=" . $databulan . "  AND YEAR(attendance.date)=" . $datatahun . " AND attendance.employee_id=" . $noidapegs)));
$hitungcountketerangan = $hitungcountdinas2-$hitungcountdinas;
$hitungcountketerangan2 += $hitungcountdinas2-$hitungcountdinas;
?> 
<tr>
	<td style="font-weight: bold;text-align: left;"><?php echo e($data->leaveType); ?> (<?php echo e($data->singkat); ?>)</td>
	
	<td width="10">:</td>
	<td> <?php echo e($hitungcountketerangan); ?> x</td>

</tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<tr style="background: #e7eef1;">
	<td style="font-weight: bold;text-align: left;">Jumlah Keterangan</td>
	<td width="10">:</td>

	<td> <?php echo e($hitungcountketerangan2); ?> x</td>
</tr>
<tr style="background: #e7eef1;">
	<td style="font-weight: bold;text-align: left;">Presentase Keterangan (<?php echo e($hitungcountketerangan2); ?> / <?php echo e($jumlahharikerja); ?>) * 100</td>
	<td width="10">:</td>
<?php $presentketerangan = ($hitungcountketerangan2 / $jumlahharikerja) * 100; 
  $jumlahprsenketerangan = number_format((float)$presentketerangan, 2, '.', '');
?>
	<td> <?php echo e($jumlahprsenketerangan); ?> % </td>
</tr>

</tbody></table>
              
			  </div>
            </div>
			
			
        <div class="col-md-6" >
        <div >
          <table border="0" width="100%" class="table table-bordered" style="margin-top:10px;">

<tbody>
<tr>

  
<td colspan="4" style="font-weight: bold;text-align: left;text-align:center">
DATA URAIAN SKOR JUMLAH HARI KERJA <?php echo e($jumlahharikerja); ?> HARI</td>

</tr>

<?php $__currentLoopData = $attendanceas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<?php
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


<?php $__currentLoopData = $dataskor; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<?php if($data->num_of_leave2 =="0"): ?> 
<tr>
	<td style="font-weight: bold;text-align: left;"><?php echo e($data->dataSkor); ?> (<?php echo e($data->singkat); ?>)</td>
	<td width="10">:</td>
	<td><?php echo e($hitung_ontime); ?> x</td>
</tr>
<?php endif; ?>

<?php if($data->num_of_leave2 =="1"): ?> 
<tr>
	<td style="font-weight: bold;text-align: left;"><?php echo e($data->dataSkor); ?> (<?php echo e($data->singkat); ?>)</td>
	<td width="10">:</td>
	<td><?php echo e($hitung_skor1); ?>  x</td>
</tr>
<?php endif; ?>

<?php if($data->num_of_leave2 =="2"): ?> 
<tr>
	<td style="font-weight: bold;text-align: left;"><?php echo e($data->dataSkor); ?> (<?php echo e($data->singkat); ?>)</td>
	<td width="10">:</td>
	<td><?php echo e($hitung_skor2); ?>  x</td>
</tr>
<?php endif; ?>


<?php if($data->num_of_leave2 =="3"): ?> 
<tr>
	<td style="font-weight: bold;text-align: left;"><?php echo e($data->dataSkor); ?> (<?php echo e($data->singkat); ?>)</td>
	<td width="10">:</td>
	<td><?php echo e($hitung_skor3); ?>  x</td>
</tr>
<?php endif; ?>


<?php if($data->num_of_leave2 =="4"): ?> 
<tr>
	<td style="font-weight: bold;text-align: left;"><?php echo e($data->dataSkor); ?> (<?php echo e($data->singkat); ?>)</td>
	<td width="10">:</td>
	<td><?php echo e($hitung_skor4); ?>  x</td>
</tr>
<?php endif; ?>


<?php if($data->num_of_leave2 =="5"): ?> 
<tr>
	<td style="font-weight: bold;text-align: left;"><?php echo e($data->dataSkor); ?> (<?php echo e($data->singkat); ?>)</td>
	<td width="10">:</td>
	<td><?php echo e($hitungapelpagi); ?> x</td>
</tr>
<?php endif; ?>


<?php if($data->num_of_leave2 =="6"): ?> 
<tr>
	<td style="font-weight: bold;text-align: left;"><?php echo e($data->dataSkor); ?> (<?php echo e($data->singkat); ?>)</td>
	<td width="10">:</td>
	<td><?php echo e($hitungapelsore); ?>  x</td>
</tr>
<?php endif; ?>

<?php if($data->num_of_leave2 =="7"): ?> 
<tr>
	<td style="font-weight: bold;text-align: left;"><?php echo e($data->dataSkor); ?> (<?php echo e($data->singkat); ?>)</td>
	<td width="10">:</td>
	<td> <?php echo e($cepatpulangcount); ?> x</td>
</tr>
<?php endif; ?>


<?php if($data->num_of_leave2 =="8"): ?> 
<tr>
	<td style="font-weight: bold;text-align: left;"><?php echo e($data->dataSkor); ?> (<?php echo e($data->singkat); ?>)</td>
	<td width="10">:</td>
<?php $hitungjumlahket = $jumlahharikerja-$hitungtanpaketers-$hitungcountketerangan2 ?>
	<td> <?php echo e($hitungjumlahket); ?> x</td>
</tr>
<?php endif; ?>

<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<tr style="background: #e7eef1;">
	<td style="font-weight: bold;text-align: left;">Jumlah Kehadiran</td>
	<td width="10">:</td>
<?php $jumlahhadirkehadiran = $hitung_ontime+$hitung_skor1+$hitung_skor2+$hitung_skor3+$hitung_skor4 ?>
	<td> <?php echo e($jumlahhadirkehadiran); ?> x</td>
</tr>
<tr style="background: #e7eef1;">
	<td style="font-weight: bold;text-align: left;">Presentase Kehadiran (<?php echo e($jumlahhadirkehadiran); ?> / <?php echo e($jumlahharikerja); ?>) * 100</td>
	<td width="10">:</td>
<?php $presensentasekeadhiran = ($jumlahhadirkehadiran / $jumlahharikerja) * 100; 
  $jumlahprsenhitung = number_format((float)$presensentasekeadhiran, 2, '.', '');
?>
	<td> <?php echo e($jumlahprsenhitung); ?> % </td>
</tr>

</tbody></table>
              
			  </div>
            </div>
            </div>
			
<?php
$caridatatpp = count(DB::select(DB::raw("SELECT * FROM payrolls WHERE  month='".$databulan."' AND year='".$datatahun."' AND employee_id=" . $noidapegs)));

if ($caridatatpp =="1")  {

?>		


<div style="  margin-top:10px;  text-transform: uppercase;
    text-align: center;
    font-weight: bold;
    font-size: 15px;">Hasil Inputan Nilai Honorium Pada Kinerja dan Kehadiran    </div>
<table border="0" width="100%" class="table table-bordered" style="margin-top:10px;text-align:center">
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

<?php $__currentLoopData = $datatpp; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>	
	<tr>

<td style="vertical-align: middle;">
<?php echo e($data->jumlah_prestasi_kehadiran); ?>

</td>

<td style="vertical-align: middle;">
<?php echo e($data->jumlah_prestasi_kinerja); ?>

</td>

<td style="vertical-align: middle;">
<?php echo e($data->total_prestasi_kinerja); ?>

</td>

<td style="vertical-align: middle;">
<?php echo e($data->total_bobot_kinerja); ?>

</td>

<td style="vertical-align: middle;">
<?php
$number = $data->nilai_tpp_kinerja;
$nilai_tpp_kinerja = number_format ($number, 0, ',', '.');
?>
<?php echo e($nilai_tpp_kinerja); ?>

</td>

<td style="vertical-align: middle;">
<?php
$number2 = $data->jumlah_kotor_kinerja;
$jumlah_kotor_kinerja = number_format ($number2, 0, ',', '.');
?>
<?php echo e($jumlah_kotor_kinerja); ?></td>
		
		
<td style="vertical-align: middle;width: 95px;">
<?php
$number3 = $data->nilai_pajak_kinerja;
$nilai_pajak_kinerja = number_format ($number3, 0, ',', '.');
?>
<?php echo e($nilai_pajak_kinerja); ?></td>
<td style="vertical-align: middle;">
<?php
$number5 = $data->jumlah_bersih_keseluruhan;
$jumlah_bersih_keseluruhan = number_format ($number5, 0, ',', '.');
?>
<?php echo e($jumlah_bersih_keseluruhan); ?></td>

	</tr>
	
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>		
	
	
	



</tbody>
</table>	

<?php } else { ?>	
<div class="note note-success" style="font-size: 15px;text-align:center;">
                          
                             BELUM ADA KINERJA DAN KEHADIRAN YANG DI TAMBAHKAN PADA BULAN INI
								
                            </div>	
<?php }  ?>		
			
</div>
<style>
.table-bordered > tbody > tr > td, .table-bordered > tfoot > tr > th, .table-bordered > tfoot > tr > td {
    border: 1px solid #c2cad8;
	    color: #34495e;
}

.table-responsive {
    overflow-x: hidden;
    min-height: 0.01%;
}
</style>



<textarea id="printing-css" style="display:none;">
.note.note-success {
    background-color: #c0edf1;
    border-color: #58d0da;
    color: black;
	margin-top:30px;
	padding:20px 0px;
}
    @page  
    {
        size:  A4 portrait;   /* auto is the initial value */
        margin: 10px 20px ;  /* this affects the margin in the printer settings */
		
    }

    html
    {
        background-color: #FFFFFF; 
        margin: 0px;  /* this affects the margin on the html before sending to printer */
    }

 
.table {
    font-family: sans-serif;
        color: #34495e;
    border-collapse: collapse;
	font-size:10px;text-align:left;
    font-weight: bold;
}

.table, th, td {
    border: 1px solid #000;
    padding: 1px 2px;;

}
body {

    overflow-x: hidden;
}

.label-ONTIME {

    background: #3d9e0f !important;
margin-bottom:3px;
	 color: #fff;    display: block;
	  text-align:center;
}

.label-SKOR1 {
    background: #eeec09 !important;
	 color: #000;
	 margin-bottom:3px;    display: block;
	  text-align:center;
}

.label-SKOR2 {
    background: #eeec09 !important;
	 color: #000;
	 margin-bottom:3px;    display: block;
	  text-align:center;
}

.label-SKOR3 {
    background: #eeec09 !important;
	 color: #000;
	 margin-bottom:3px;    display: block;
	  text-align:center;
}


.label-SKOR4 {
     background: #eeec09 !important;
	 color: #000;
	 margin-bottom:3px;    display: block;
	  text-align:center;
}

.label-pulangcepat {
   background: #eeec09 !important;  
	display: block;
	 color: #000;
	 text-align:center;
}

input[type=time]::-webkit-datetime-edit-ampm-field {
  display: none;}
  
input[type='time']::-webkit-calendar-picker-indicator {
    background: none;
    display: none;
}

.label-danger {
    background-color: #ed6b75;
	    color: #fff;
		padding: 1px 6px 1px 6px;
}

</textarea>
<iframe id="printing-frame" name="print_frame" src="about:blank" style="display:none;"></iframe>
<script type="text/javascript">
function printDiv(elementId) {
 var a = document.getElementById('printing-css').value;
 var b = document.getElementById(elementId).innerHTML;
 window.frames["print_frame"].document.title = document.title;
 window.frames["print_frame"].document.body.innerHTML = '<style>' + a + '</style>' + b;
 window.frames["print_frame"].window.focus();
 window.frames["print_frame"].window.print();
}
</script>

 <?php else: ?>
	
<?php endif; ?>



<?php /**PATH C:\xampp\htdocs\newabsen\resources\views/admin/laporanphl/load.blade.php ENDPATH**/ ?>