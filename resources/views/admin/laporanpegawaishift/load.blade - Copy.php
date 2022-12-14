	       <div class="btn-group" style="margin-bottom:20px;">
                             <a href="javascript:printDiv('printdata');" class="btn green"> <i class="fa fa-print"></i>  Print Halaman ini</a>
                                        </div>
                            
										
<div id="printdata"> 										
						<div style="text-align: center;font-weight: bold;font-size: 25px;">	LAPORAN PEGAWAI (ASN)       </div>
						<div style="text-align: center;font-weight: bold;font-size: 20px;text-transform: uppercase;margin-top: -5px;">{{ $dinasnama->company_name }}</div>
													<div style="text-align: center;font-weight: bold;font-size: 15px;text-transform: uppercase;margin-top: -3px;">NAMA : {{ $data->full_name }} / NIP : {{ $data->employeeID }}</div>
					<div style="text-align: center;font-weight: bold;font-size: 15px;text-transform: uppercase;margin-bottom:20px;">BULAN 
						<?php  switch ($databulan) { case '1':     echo 'JANUARI';     break; case '2':     echo 'FEBRUARI';     break; case '3':     echo 'MARET';     break; case '4':     echo 'APRIL';     break; case '5':     echo 'MEI';     break; case '6':     echo 'JUNI';     break; case '7':     echo 'JULI';     break; case '8':     echo 'AGUSTUS';     break; case '9':     echo 'SEPTEMBER';     break; 	case '10':     echo 'OKTOBER';     break; 	case '11':     echo 'NOVEMBER';     break; 		case '12':     echo 'DESEMBER';     break; 		default:     echo '';     break; } ?>
						TAHUN {{ $datatahun }}      </div>

	<div class="scrollable-table">
        <table border="0" width="100%" class="table table-bordered">
<tbody>
<tr>

<td width="" align="center"><b>TANGGAL</b></td>
<td align="center"><b>JENIS SHIFT</b></td>
<td align="center"><b>MASUK</b></td>
<td align="center"><b>PULANG</b></td>
<td align="center"><b>TOTAL JAM KERJA</b></td>
<td align="center"><b>APEL PAGI</b></td>
<td align="center"><b>APEL SORE</b></td>
</tr>

 
@for ($i = 1; $i <= $daysInMonth; $i++)

<tr>

   <?php 
   $totalMasukCount = 0;
   $totalMasukCountshif = 0;
   $hitungdatashiftss = 0;
   $hitungmasukdata = 0;
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
	$cepatpulangcount_jumat = 0;
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
$datashift = '-';




 ?>

<td>{{ $date_create }} </td>

<?php
$carilibur = count(DB::select(DB::raw("SELECT * FROM holidays WHERE  DAY(date)=" . $datahari . " AND MONTH(date)=" . $databulan . "  AND YEAR(date)=" . $datatahun . " ")));

 ?>


@foreach ($shifpagidata as $shifpagi )
@foreach ($shifsiangdata as $shifsiang )
@foreach ($shifmalamdata as $shifmalam )
@foreach ($attendanceas as $data )


<?php
 $date_to_check = date('Y-m-d', strtotime($data->datatanggal));
 ?>

    @if ($date_create == $date_to_check )

       <?php
        $masuk = $data->masuk;
		$namashift = $data->nama_shift;
		$iddateshif = $data->iddateshif;
		$totalMasukCountshif++;
	

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


@if ($tampilkanhari_for == "friday")
	



@if ($iddateshif == "1338")
	<?php
//shif pagi
$jam_buka_normal_jumat = $shifpagi->jam_masuk_normal_jumat; 
$jam_pulang_normal_jumat = $shifpagi->jam_pulang_normal_jumat; 
$jam_akhir_masuk_normal_jumat = $shifpagi->jam_akhir_masuk_normal_jumat; 
$jam_akhir_pulang_normal_jumat = $shifpagi->jam_akhir_pulang_normal_jumat; 
$ontime_masuk_normal_jumat = $shifpagi->ONTIME_masuk_normal_jumat; 
$ontime_pulang_normal_jumat = $shifpagi->ONTIME_pulang_normal_jumat; 
$skor1_mulai_normal_jumat = $shifpagi->SKOR1_masuk_normal_jumat;
$skor1_akhir_normal_jumat = $shifpagi->SKOR1_pulang_normal_jumat;
$skor2_mulai_normal_jumat = $shifpagi->SKOR2_masuk_normal_jumat; 
$skor2_akhir_normal_jumat = $shifpagi->SKOR2_pulang_normal_jumat;
$skor3_mulai_normal_jumat = $shifpagi->SKOR3_masuk_normal_jumat;
$skor3_akhir_normal_jumat = $shifpagi->SKOR3_pulang_normal_jumat;
$skor4_mulai_normal_jumat = $shifpagi->SKOR4_masuk_normal_jumat;
$skor4_akhir_normal_jumat = $shifpagi->SKOR4_pulang_normal_jumat;
$shifpagi_normal_jumat = $data->masuk;
$jammulai_normal_jumat = date("H:i:s", strtotime($shifpagi_normal_jumat));
?>

<?php
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
@endif	






@if ($iddateshif == "1427")
	<?php
//shif siang jumat
$jam_buka_normal_jumat = $shifsiang->jam_masuk_normal_jumat; 
$jam_pulang_normal_jumat = $shifsiang->jam_pulang_normal_jumat; 
$jam_akhir_masuk_normal_jumat = $shifsiang->jam_akhir_masuk_normal_jumat; 
$jam_akhir_pulang_normal_jumat = $shifsiang->jam_akhir_pulang_normal_jumat; 
$ontime_masuk_normal_jumat = $shifsiang->ONTIME_masuk_normal_jumat; 
$ontime_pulang_normal_jumat = $shifsiang->ONTIME_pulang_normal_jumat; 
$skor1_mulai_normal_jumat = $shifsiang->SKOR1_masuk_normal_jumat;
$skor1_akhir_normal_jumat = $shifsiang->SKOR1_pulang_normal_jumat;
$skor2_mulai_normal_jumat = $shifsiang->SKOR2_masuk_normal_jumat; 
$skor2_akhir_normal_jumat = $shifsiang->SKOR2_pulang_normal_jumat;
$skor3_mulai_normal_jumat = $shifsiang->SKOR3_masuk_normal_jumat;
$skor3_akhir_normal_jumat = $shifsiang->SKOR3_pulang_normal_jumat;
$skor4_mulai_normal_jumat = $shifsiang->SKOR4_masuk_normal_jumat;
$skor4_akhir_normal_jumat = $shifsiang->SKOR4_pulang_normal_jumat;
$shifsiang_normal_jumat = $data->masuk;
$jammulai_normal_jumat = date("H:i:s", strtotime($shifsiang_normal_jumat));
?>

<?php
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
@endif



@if ($iddateshif == "1428")
	<?php
//shif malam jumat
$jam_buka_normal_jumat = $shifmalam->jam_masuk_normal_jumat; 
$jam_pulang_normal_jumat = $shifmalam->jam_pulang_normal_jumat; 
$jam_akhir_masuk_normal_jumat = $shifmalam->jam_akhir_masuk_normal_jumat; 
$jam_akhir_pulang_normal_jumat = $shifmalam->jam_akhir_pulang_normal_jumat; 
$ontime_masuk_normal_jumat = $shifmalam->ONTIME_masuk_normal_jumat; 
$ontime_pulang_normal_jumat = $shifmalam->ONTIME_pulang_normal_jumat; 
$skor1_mulai_normal_jumat = $shifmalam->SKOR1_masuk_normal_jumat;
$skor1_akhir_normal_jumat = $shifmalam->SKOR1_pulang_normal_jumat;
$skor2_mulai_normal_jumat = $shifmalam->SKOR2_masuk_normal_jumat; 
$skor2_akhir_normal_jumat = $shifmalam->SKOR2_pulang_normal_jumat;
$skor3_mulai_normal_jumat = $shifmalam->SKOR3_masuk_normal_jumat;
$skor3_akhir_normal_jumat = $shifmalam->SKOR3_pulang_normal_jumat;
$skor4_mulai_normal_jumat = $shifmalam->SKOR4_masuk_normal_jumat;
$skor4_akhir_normal_jumat = $shifmalam->SKOR4_pulang_normal_jumat;
$shifmalam_normal_jumat = $data->masuk;
$jammulai_normal_jumat = date("H:i:s", strtotime($shifmalam_normal_jumat));
?>

<?php
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
@endif




@else
	

@if ($iddateshif == "1338")
<?php
//shif pagi normal
$jam_buka_normal = $shifpagi->jam_masuk_normal; 
$jam_pulang_normal = $shifpagi->jam_pulang_normal; 
$jam_akhir_masuk_normal = $shifpagi->jam_akhir_masuk_normal; 
$jam_akhir_pulang_normal = $shifpagi->jam_akhir_pulang_normal; 
$ontime_masuk_normal = $shifpagi->ONTIME_masuk_normal; 
$ontime_pulang_normal = $shifpagi->ONTIME_pulang_normal; 
$skor1_mulai_normal = $shifpagi->SKOR1_masuk_normal;
$skor1_akhir_normal = $shifpagi->SKOR1_pulang_normal;
$skor2_mulai_normal = $shifpagi->SKOR2_masuk_normal; 
$skor2_akhir_normal = $shifpagi->SKOR2_pulang_normal;
$skor3_mulai_normal = $shifpagi->SKOR3_masuk_normal;
$skor3_akhir_normal = $shifpagi->SKOR3_pulang_normal;
$skor4_mulai_normal = $shifpagi->SKOR4_masuk_normal;
$skor4_akhir_normal = $shifpagi->SKOR4_pulang_normal;
$shifpagi_normal = $data->masuk;
$jammulai_normal = date("H:i:s", strtotime($shifpagi_normal));

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


@endif


@if ($iddateshif == "1427")
<?php
//shif siang normal
$jam_buka_normal = $shifsiang->jam_masuk_normal; 
$jam_pulang_normal = $shifsiang->jam_pulang_normal; 
$jam_akhir_masuk_normal = $shifsiang->jam_akhir_masuk_normal; 
$jam_akhir_pulang_normal = $shifsiang->jam_akhir_pulang_normal; 
$ontime_masuk_normal = $shifsiang->ONTIME_masuk_normal; 
$ontime_pulang_normal = $shifsiang->ONTIME_pulang_normal; 
$skor1_mulai_normal = $shifsiang->SKOR1_masuk_normal;
$skor1_akhir_normal = $shifsiang->SKOR1_pulang_normal;
$skor2_mulai_normal = $shifsiang->SKOR2_masuk_normal; 
$skor2_akhir_normal = $shifsiang->SKOR2_pulang_normal;
$skor3_mulai_normal = $shifsiang->SKOR3_masuk_normal;
$skor3_akhir_normal = $shifsiang->SKOR3_pulang_normal;
$skor4_mulai_normal = $shifsiang->SKOR4_masuk_normal;
$skor4_akhir_normal = $shifsiang->SKOR4_pulang_normal;
$shifsiang_normal = $data->masuk;
$jammulai_normal = date("H:i:s", strtotime($shifsiang_normal));

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
@endif




@if ($iddateshif == "1428")
<?php
//shif malam normal
$jam_buka_normal = $shifmalam->jam_masuk_normal; 
$jam_pulang_normal = $shifmalam->jam_pulang_normal; 
$jam_akhir_masuk_normal = $shifmalam->jam_akhir_masuk_normal; 
$jam_akhir_pulang_normal = $shifmalam->jam_akhir_pulang_normal; 
$ontime_masuk_normal = $shifmalam->ONTIME_masuk_normal; 
$ontime_pulang_normal = $shifmalam->ONTIME_pulang_normal; 
$skor1_mulai_normal = $shifmalam->SKOR1_masuk_normal;
$skor1_akhir_normal = $shifmalam->SKOR1_pulang_normal;
$skor2_mulai_normal = $shifmalam->SKOR2_masuk_normal; 
$skor2_akhir_normal = $shifmalam->SKOR2_pulang_normal;
$skor3_mulai_normal = $shifmalam->SKOR3_masuk_normal;
$skor3_akhir_normal = $shifmalam->SKOR3_pulang_normal;
$skor4_mulai_normal = $shifmalam->SKOR4_masuk_normal;
$skor4_akhir_normal = $shifmalam->SKOR4_pulang_normal;
$shifmalam_normal = $data->masuk;
$jammulai_normal = date("H:i:s", strtotime($shifmalam_normal));

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

@endif








@endif






@else

@endif	


@endforeach
@endforeach
@endforeach
@endforeach









<?php
$date_jumat = $datatanggal;
$timestamp = strtotime($date_jumat);
$carihari= date("l", $timestamp );
$tampilkanhari = strtolower($carihari);

?>

@include('admin.laporanpegawaishift.data_shift')





</tr>
@endfor


</tbody>
</table>
</div>

@for ($i = 0; $i < $daysInMonth; $i++)
<?php
 $today = $i;
switch($today){case '1':$datahari = '01';break;case '2':$datahari = '02';break;case '3':$datahari = '03';break;   	case '4':$datahari = '04';break;	case '5':$datahari = '05';break;	case '6':$datahari = '06';break;	case '7':$datahari = '07';break;	case '8':$datahari = '08';break;	case '9':$datahari = '09';break;	default:$datahari = $today;break;}
$date_create = $datatahun . '-' . $databulan . '-'.$datahari;
$carilibur2 = count(DB::select(DB::raw("SELECT * FROM holidays WHERE  DAY(date)=" . $datahari . " AND MONTH(date)=" . $databulan . "  AND YEAR(date)=" . $datatahun . " ")));
$jumlahharikerja++;
if ($carilibur2 =="1")  {
	$countcariliburan++;
} else {


}

?>

 
@endfor


        
                 <div class="row rowdata" >
          <div class="col s12 m12 l6">
        <div >
          <table border="0" width="100%" class="table table-bordered" style="margin-top:10px;">

<tbody>
<tr>

	<td colspan="4" style="font-weight: bold;text-align: left;text-align:center">
DATA URAIAN KETERANGAN</td>

</tr>
@foreach ($leavetype as $data)
<?php
$dataku  = $data->singkat;
$hitungcountdinas = count(DB::select(DB::raw("SELECT datashift.date FROM attendance LEFT JOIN datashift ON attendance.date = datashift.date WHERE attendance.leaveType ='".$dataku."' AND datashift.status='hadir' AND attendance.status ='absent' AND attendance.application_status ='approved' AND MONTH(datashift.date)=" . $databulan . "  AND YEAR(datashift.date)=" . $datatahun . " AND attendance.employee_id=" . $noidapegs)));
$hitungcountdinas2 = count(DB::select(DB::raw("SELECT datashift.date FROM attendance LEFT JOIN datashift ON attendance.date = datashift.date WHERE attendance.leaveType ='".$dataku."' AND datashift.status='hadir' AND attendance.status ='absent' AND attendance.application_status ='approved' AND MONTH(attendance.date)=" . $databulan . "  AND YEAR(attendance.date)=" . $datatahun . " AND datashift.employee_id=" . $noidapegs ." AND attendance.employee_id=" . $noidapegs)));
$hitungcountketerangan = $hitungcountdinas2;
$hitungcountketerangan2 += $hitungcountdinas2;
?> 
<tr>
	<td style="font-weight: bold;text-align: left;">{{ $data->leaveType }} ({{ $data->singkat }})</td>
	
	<td width="10">:</td>
	<td> {{ $hitungcountketerangan }} x</td>

</tr>
@endforeach
<tr style="background: #e7eef1;">
	<td style="font-weight: bold;text-align: left;">Jumlah Keterangan</td>
	<td width="10">:</td>

	<td> {{ $hitungcountketerangan2 }} x</td>
</tr>
<tr style="background: #e7eef1;">
	<td style="font-weight: bold;text-align: left;">Presentase Keterangan ({{ $hitungcountketerangan2 }} / {{$jumlahharikerja}}) * 100</td>
	<td width="10">:</td>
<?php $presentketerangan = ($hitungcountketerangan2 / $jumlahharikerja) * 100; 
  $jumlahprsenketerangan = number_format((float)$presentketerangan, 2, '.', '');
?>
	<td> {{ $jumlahprsenketerangan }} % </td>
</tr>

</tbody></table>
              
			  </div>
            </div>
			
			
        <div class="col s12 m12 l6" >
        <div >
          <table border="0" width="100%" class="table table-bordered" style="margin-top:10px;">

<tbody>
<tr>

  
<td colspan="4" style="font-weight: bold;text-align: left;text-align:center">
DATA URAIAN SKOR JUMLAH HARI KERJA {{ $jumlahharikerja }} HARI</td>

</tr>
@for ($i = 1; $i <= $daysInMonth; $i++)
	
<?php
$today = $i;
switch($today){case '1':$datahari = '01';break;case '2':$datahari = '02';break;case '3':$datahari = '03';break;   	case '4':$datahari = '04';break;	case '5':$datahari = '05';break;	case '6':$datahari = '06';break;	case '7':$datahari = '07';break;	case '8':$datahari = '08';break;	case '9':$datahari = '09';break;	default:$datahari = $today;break;}
$bulan = $databulan;
switch($bulan){case '1':$bulanini = '01';break;case '2':$bulanini = '02';break;case '3':$bulanini = '03';break;   	case '4':$bulanini = '04';break;	case '5':$bulanini = '05';break;	case '6':$bulanini = '06';break;	case '7':$bulanini = '07';break;	case '8':$bulanini = '08';break;	case '9':$bulanini = '09';break;	default:$bulanini = $bulan;break;}



$date_create = $datatahun . '-' . $bulanini . '-'.$datahari;

 ?>

 

@foreach ($attendanceas22 as $data)
@if ($data->status == "present")
<?php
 $date_to_check = date('Y-m-d', strtotime($data->datatanggal));
 ?>

    @if ($date_create == $date_to_check)


<?php
$date_jumat_for = $data->datatanggal;
$timestamp_for = strtotime($date_jumat_for);
$carihari_for= date("l", $timestamp_for);
$tampilkanhari_for = strtolower($carihari_for);

?>
<!-- PILAH JUMAT --> @if ($tampilkanhari_for == "friday")

@foreach ($shifpagidata as $shifpagi )
@if ($data->iddateshif == "1338" )
<?php
//shif pagi normal
$jam_buka_normal_jumat = $shifpagi->jam_masuk_normal_jumat; 
$jam_pulang_normal_jumat = $shifpagi->jam_pulang_normal_jumat; 
$jam_akhir_masuk_normal_jumat = $shifpagi->jam_akhir_masuk_normal_jumat; 
$jam_akhir_pulang_normal_jumat = $shifpagi->jam_akhir_pulang_normal_jumat; 
$ontime_masuk_normal_jumat = $shifpagi->ONTIME_masuk_normal_jumat; 
$ontime_pulang_normal_jumat = $shifpagi->ONTIME_pulang_normal_jumat; 
$skor1_mulai_normal_jumat = $shifpagi->SKOR1_masuk_normal_jumat;
$skor1_akhir_normal_jumat = $shifpagi->SKOR1_pulang_normal_jumat;
$skor2_mulai_normal_jumat = $shifpagi->SKOR2_masuk_normal_jumat; 
$skor2_akhir_normal_jumat = $shifpagi->SKOR2_pulang_normal_jumat;
$skor3_mulai_normal_jumat = $shifpagi->SKOR3_masuk_normal_jumat;
$skor3_akhir_normal_jumat = $shifpagi->SKOR3_pulang_normal_jumat;
$skor4_mulai_normal_jumat = $shifpagi->SKOR4_masuk_normal_jumat;
$skor4_akhir_normal_jumat = $shifpagi->SKOR4_pulang_normal_jumat;
$data_normal_jumat = $data->masuk;
$data_normal_jumat_pulang = $data->pulang;
$jammulai_pulang_normal_jumat = date("H:i:s", strtotime($data_normal_jumat_pulang));
$jammulai_normal_jumat = date("H:i:s", strtotime($data_normal_jumat));

if (( strtotime($jammulai_normal_jumat) >= strtotime("$jam_buka_normal_jumat") ) and (strtotime($jammulai_normal_jumat) <= strtotime("$ontime_pulang_normal_jumat"))  )
$status422="ONTIME";

else if (( strtotime($jammulai_normal_jumat) >= strtotime("$skor1_mulai_normal_jumat") ) and (strtotime($jammulai_normal_jumat) <= strtotime("$skor1_akhir_normal_jumat"))  )
$status422="SKOR1";
else if (( strtotime($jammulai_normal_jumat) >= strtotime("$skor2_mulai_normal_jumat") ) and (strtotime($jammulai_normal_jumat) <= strtotime("$skor2_akhir_normal_jumat"))  )
$status422="SKOR2";
else if (( strtotime($jammulai_normal_jumat) >= strtotime("$skor3_mulai_normal_jumat") ) and (strtotime($jammulai_normal_jumat) <= strtotime("$skor3_akhir_normal_jumat"))  )
$status422="SKOR3";
		
else if (( strtotime($jammulai_normal_jumat) >= strtotime("$skor4_mulai_normal_jumat") ) and (strtotime($jammulai_normal_jumat) <= strtotime("$skor4_akhir_normal_jumat")))
$status422="SKOR4";

else if (( strtotime($jammulai_normal_jumat) >= strtotime("$jam_akhir_masuk_normal_jumat") ) and (strtotime($jammulai_normal_jumat) <= strtotime("24:00:00"))  )
$status422= "1";

else if (( strtotime("00:00:00") <= strtotime("$jam_buka_normal_jumat") )  )
$status422= "1";

if ($data->pulang != "00:00:00") { 
if (( strtotime($data->pulang) >=  strtotime($jam_pulang_normal_jumat)) and (strtotime($data->pulang) <= strtotime($jam_akhir_pulang_normal_jumat))) { 
} else { 
$cepatpulangcount++;
 } 

} else { 
$cepatpulangcount++; 

} 


?>
@endif
@endforeach

@foreach ($shifsiangdata as $shifsiang )
@if ($data->iddateshif == "1427" )
<?php
//shif siang normal
$jam_buka_normal_jumat = $shifsiang->jam_masuk_normal_jumat; 
$jam_pulang_normal_jumat = $shifsiang->jam_pulang_normal_jumat; 
$jam_akhir_masuk_normal_jumat = $shifsiang->jam_akhir_masuk_normal_jumat; 
$jam_akhir_pulang_normal_jumat = $shifsiang->jam_akhir_pulang_normal_jumat; 
$ontime_masuk_normal_jumat = $shifsiang->ONTIME_masuk_normal_jumat; 
$ontime_pulang_normal_jumat = $shifsiang->ONTIME_pulang_normal_jumat; 
$skor1_mulai_normal_jumat = $shifsiang->SKOR1_masuk_normal_jumat;
$skor1_akhir_normal_jumat = $shifsiang->SKOR1_pulang_normal_jumat;
$skor2_mulai_normal_jumat = $shifsiang->SKOR2_masuk_normal_jumat; 
$skor2_akhir_normal_jumat = $shifsiang->SKOR2_pulang_normal_jumat;
$skor3_mulai_normal_jumat = $shifsiang->SKOR3_masuk_normal_jumat;
$skor3_akhir_normal_jumat = $shifsiang->SKOR3_pulang_normal_jumat;
$skor4_mulai_normal_jumat = $shifsiang->SKOR4_masuk_normal_jumat;
$skor4_akhir_normal_jumat = $shifsiang->SKOR4_pulang_normal_jumat;
$data_normal_jumat = $data->masuk;
$data_normal_jumat_pulang = $data->pulang;
$jammulai_pulang_normal_jumat = date("H:i:s", strtotime($data_normal_jumat_pulang));
$jammulai_normal_jumat = date("H:i:s", strtotime($data_normal_jumat));

if (( strtotime($jammulai_normal_jumat) >= strtotime("$jam_buka_normal_jumat") ) and (strtotime($jammulai_normal_jumat) <= strtotime("$ontime_pulang_normal_jumat"))  )
$status422="ONTIME";

else if (( strtotime($jammulai_normal_jumat) >= strtotime("$skor1_mulai_normal_jumat") ) and (strtotime($jammulai_normal_jumat) <= strtotime("$skor1_akhir_normal_jumat"))  )
$status422="SKOR1";
else if (( strtotime($jammulai_normal_jumat) >= strtotime("$skor2_mulai_normal_jumat") ) and (strtotime($jammulai_normal_jumat) <= strtotime("$skor2_akhir_normal_jumat"))  )
$status422="SKOR2";
else if (( strtotime($jammulai_normal_jumat) >= strtotime("$skor3_mulai_normal_jumat") ) and (strtotime($jammulai_normal_jumat) <= strtotime("$skor3_akhir_normal_jumat"))  )
$status422="SKOR3";
		
else if (( strtotime($jammulai_normal_jumat) >= strtotime("$skor4_mulai_normal_jumat") ) and (strtotime($jammulai_normal_jumat) <= strtotime("$skor4_akhir_normal_jumat")))
$status422="SKOR4";

else if (( strtotime($jammulai_normal_jumat) >= strtotime("$jam_akhir_masuk_normal_jumat") ) and (strtotime($jammulai_normal_jumat) <= strtotime("24:00:00"))  )
$status422= "1";

else if (( strtotime("00:00:00") <= strtotime("$jam_buka_normal_jumat") )  )
$status422= "1";

if ($data->pulang != "00:00:00") { 
if (( strtotime($data->pulang) >=  strtotime($jam_pulang_normal_jumat)) and (strtotime($data->pulang) <= strtotime($jam_akhir_pulang_normal_jumat))) { 
} else { 
$cepatpulangcount++;
 } 

} else { 
$cepatpulangcount++; 

} 

?>	
@endif
@endforeach


@foreach ($shifmalamdata as $shifmalam )
@if ($data->iddateshif == "1428" )
<?php
//shif malam normal
$jam_buka_normal_jumat = $shifmalam->jam_masuk_normal_jumat; 
$jam_pulang_normal_jumat = $shifmalam->jam_pulang_normal_jumat; 
$jam_akhir_masuk_normal_jumat = $shifmalam->jam_akhir_masuk_normal_jumat; 
$jam_akhir_pulang_normal_jumat = $shifmalam->jam_akhir_pulang_normal_jumat; 
$ontime_masuk_normal_jumat = $shifmalam->ONTIME_masuk_normal_jumat; 
$ontime_pulang_normal_jumat = $shifmalam->ONTIME_pulang_normal_jumat; 
$skor1_mulai_normal_jumat = $shifmalam->SKOR1_masuk_normal_jumat;
$skor1_akhir_normal_jumat = $shifmalam->SKOR1_pulang_normal_jumat;
$skor2_mulai_normal_jumat = $shifmalam->SKOR2_masuk_normal_jumat; 
$skor2_akhir_normal_jumat = $shifmalam->SKOR2_pulang_normal_jumat;
$skor3_mulai_normal_jumat = $shifmalam->SKOR3_masuk_normal_jumat;
$skor3_akhir_normal_jumat = $shifmalam->SKOR3_pulang_normal_jumat;
$skor4_mulai_normal_jumat = $shifmalam->SKOR4_masuk_normal_jumat;
$skor4_akhir_normal_jumat = $shifmalam->SKOR4_pulang_normal_jumat;
$data_normal_jumat = $data->masuk;

$jammulai_normal_jumat = date("H:i:s", strtotime($data_normal_jumat));

if (( strtotime($jammulai_normal_jumat) >= strtotime("$jam_buka_normal_jumat") ) and (strtotime($jammulai_normal_jumat) <= strtotime("$ontime_pulang_normal_jumat"))  )
$status422="ONTIME";

else if (( strtotime($jammulai_normal_jumat) >= strtotime("$skor1_mulai_normal_jumat") ) and (strtotime($jammulai_normal_jumat) <= strtotime("$skor1_akhir_normal_jumat"))  )
$status422="SKOR1";
else if (( strtotime($jammulai_normal_jumat) >= strtotime("$skor2_mulai_normal_jumat") ) and (strtotime($jammulai_normal_jumat) <= strtotime("$skor2_akhir_normal_jumat"))  )
$status422="SKOR2";
else if (( strtotime($jammulai_normal_jumat) >= strtotime("$skor3_mulai_normal_jumat") ) and (strtotime($jammulai_normal_jumat) <= strtotime("$skor3_akhir_normal_jumat"))  )
$status422="SKOR3";
		
else if (( strtotime($jammulai_normal_jumat) >= strtotime("$skor4_mulai_normal_jumat") ) and (strtotime($jammulai_normal_jumat) <= strtotime("$skor4_akhir_normal_jumat")))
$status422="SKOR4";

else if (( strtotime($jammulai_normal_jumat) >= strtotime("$jam_akhir_masuk_normal_jumat") ) and (strtotime($jammulai_normal_jumat) <= strtotime("24:00:00"))  )
$status422= "1";

else if (( strtotime("00:00:00") <= strtotime("$jam_buka_normal_jumat") )  )
$status422= "1";




if ($data->pulang != "00:00:00") { 
$pulang_normal_jumat = $data->pulang;
$jammulai_normal_jumat_pulang = date("H:i:s", strtotime($pulang_normal_jumat));


if (( strtotime($jammulai_normal_jumat_pulang) >= strtotime("00:00:00") ) and (strtotime($jammulai_normal_jumat_pulang) <= strtotime("$jam_pulang_normal_jumat"))  )
$status446= "2";

else if (( strtotime($jammulai_normal_jumat_pulang) >= strtotime("$jam_pulang_normal_jumat") ) and (strtotime($jammulai_normal_jumat_pulang) <= strtotime("$jam_akhir_pulang_normal_jumat"))  )	
$status446= "1";

else if (( strtotime("$jam_akhir_pulang_normal_jumat") <= strtotime("24:00:00") )  )
$status446= "2";

if ($status446 == "1") {

} else {
$cepatpulangcount++; 
} 	

} else { 
$cepatpulangcount++; 

} 






?>	
@endif
@endforeach	

<!-- PILAH ELSE JUMAT --> @else

@foreach ($shifpagidata as $shifpagi )
@if ($data->iddateshif == "1338" )
<?php
//shif pagi normal
$jam_buka_normal = $shifpagi->jam_masuk_normal; 
$jam_pulang_normal = $shifpagi->jam_pulang_normal; 
$jam_akhir_masuk_normal = $shifpagi->jam_akhir_masuk_normal; 
$jam_akhir_pulang_normal = $shifpagi->jam_akhir_pulang_normal; 
$ontime_masuk_normal = $shifpagi->ONTIME_masuk_normal; 
$ontime_pulang_normal = $shifpagi->ONTIME_pulang_normal; 
$skor1_mulai_normal = $shifpagi->SKOR1_masuk_normal;
$skor1_akhir_normal = $shifpagi->SKOR1_pulang_normal;
$skor2_mulai_normal = $shifpagi->SKOR2_masuk_normal; 
$skor2_akhir_normal = $shifpagi->SKOR2_pulang_normal;
$skor3_mulai_normal = $shifpagi->SKOR3_masuk_normal;
$skor3_akhir_normal = $shifpagi->SKOR3_pulang_normal;
$skor4_mulai_normal = $shifpagi->SKOR4_masuk_normal;
$skor4_akhir_normal = $shifpagi->SKOR4_pulang_normal;
$data_normal = $data->masuk;
$data_normal_pulang = $data->pulang;
$jammulai_pulang_normal = date("H:i:s", strtotime($data_normal_pulang));
$jammulai_normal = date("H:i:s", strtotime($data_normal));

if (( strtotime($jammulai_normal) >= strtotime("$jam_buka_normal") ) and (strtotime($jammulai_normal) <= strtotime("$ontime_pulang_normal"))  )
$status422="ONTIME";

else if (( strtotime($jammulai_normal) >= strtotime("$skor1_mulai_normal") ) and (strtotime($jammulai_normal) <= strtotime("$skor1_akhir_normal"))  )
$status422="SKOR1";
else if (( strtotime($jammulai_normal) >= strtotime("$skor2_mulai_normal") ) and (strtotime($jammulai_normal) <= strtotime("$skor2_akhir_normal"))  )
$status422="SKOR2";
else if (( strtotime($jammulai_normal) >= strtotime("$skor3_mulai_normal") ) and (strtotime($jammulai_normal) <= strtotime("$skor3_akhir_normal"))  )
$status422="SKOR3";
		
else if (( strtotime($jammulai_normal) >= strtotime("$skor4_mulai_normal") ) and (strtotime($jammulai_normal) <= strtotime("$skor4_akhir_normal")))
$status422="SKOR4";

else if (( strtotime($jammulai_normal) >= strtotime("$jam_akhir_masuk_normal") ) and (strtotime($jammulai_normal) <= strtotime("24:00:00"))  )
$status422= "1";

else if (( strtotime("00:00:00") <= strtotime("$jam_buka_normal") )  )
$status422= "1";

if ($data->pulang != "00:00:00") { 
if (( strtotime($data->pulang) >=  strtotime($jam_pulang_normal)) and (strtotime($data->pulang) <= strtotime($jam_akhir_pulang_normal))) { 
} else { 
$cepatpulangcount++;
 } 

} else { 
$cepatpulangcount++; 

} 


?>
@endif
@endforeach

@foreach ($shifsiangdata as $shifsiang )
@if ($data->iddateshif == "1427" )
<?php
//shif siang normal
$jam_buka_normal = $shifsiang->jam_masuk_normal; 
$jam_pulang_normal = $shifsiang->jam_pulang_normal; 
$jam_akhir_masuk_normal = $shifsiang->jam_akhir_masuk_normal; 
$jam_akhir_pulang_normal = $shifsiang->jam_akhir_pulang_normal; 
$ontime_masuk_normal = $shifsiang->ONTIME_masuk_normal; 
$ontime_pulang_normal = $shifsiang->ONTIME_pulang_normal; 
$skor1_mulai_normal = $shifsiang->SKOR1_masuk_normal;
$skor1_akhir_normal = $shifsiang->SKOR1_pulang_normal;
$skor2_mulai_normal = $shifsiang->SKOR2_masuk_normal; 
$skor2_akhir_normal = $shifsiang->SKOR2_pulang_normal;
$skor3_mulai_normal = $shifsiang->SKOR3_masuk_normal;
$skor3_akhir_normal = $shifsiang->SKOR3_pulang_normal;
$skor4_mulai_normal = $shifsiang->SKOR4_masuk_normal;
$skor4_akhir_normal = $shifsiang->SKOR4_pulang_normal;
$data_normal = $data->masuk;
$data_normal_pulang = $data->pulang;
$jammulai_pulang_normal = date("H:i:s", strtotime($data_normal_pulang));
$jammulai_normal = date("H:i:s", strtotime($data_normal));

if (( strtotime($jammulai_normal) >= strtotime("$jam_buka_normal") ) and (strtotime($jammulai_normal) <= strtotime("$ontime_pulang_normal"))  )
$status422="ONTIME";

else if (( strtotime($jammulai_normal) >= strtotime("$skor1_mulai_normal") ) and (strtotime($jammulai_normal) <= strtotime("$skor1_akhir_normal"))  )
$status422="SKOR1";
else if (( strtotime($jammulai_normal) >= strtotime("$skor2_mulai_normal") ) and (strtotime($jammulai_normal) <= strtotime("$skor2_akhir_normal"))  )
$status422="SKOR2";
else if (( strtotime($jammulai_normal) >= strtotime("$skor3_mulai_normal") ) and (strtotime($jammulai_normal) <= strtotime("$skor3_akhir_normal"))  )
$status422="SKOR3";
		
else if (( strtotime($jammulai_normal) >= strtotime("$skor4_mulai_normal") ) and (strtotime($jammulai_normal) <= strtotime("$skor4_akhir_normal")))
$status422="SKOR4";

else if (( strtotime($jammulai_normal) >= strtotime("$jam_akhir_masuk_normal") ) and (strtotime($jammulai_normal) <= strtotime("24:00:00"))  )
$status422= "1";

else if (( strtotime("00:00:00") <= strtotime("$jam_buka_normal") )  )
$status422= "1";

if ($data->pulang != "00:00:00") { 
if (( strtotime($data->pulang) >=  strtotime($jam_pulang_normal)) and (strtotime($data->pulang) <= strtotime($jam_akhir_pulang_normal))) { 
} else { 
$cepatpulangcount++;
 } 

} else { 
$cepatpulangcount++; 

} 

?>	
@endif
@endforeach


@foreach ($shifmalamdata as $shifmalam )
@if ($data->iddateshif == "1428" )
<?php
//shif malam normal
$jam_buka_normal = $shifmalam->jam_masuk_normal; 
$jam_pulang_normal = $shifmalam->jam_pulang_normal; 
$jam_akhir_masuk_normal = $shifmalam->jam_akhir_masuk_normal; 
$jam_akhir_pulang_normal = $shifmalam->jam_akhir_pulang_normal; 
$ontime_masuk_normal = $shifmalam->ONTIME_masuk_normal; 
$ontime_pulang_normal = $shifmalam->ONTIME_pulang_normal; 
$skor1_mulai_normal = $shifmalam->SKOR1_masuk_normal;
$skor1_akhir_normal = $shifmalam->SKOR1_pulang_normal;
$skor2_mulai_normal = $shifmalam->SKOR2_masuk_normal; 
$skor2_akhir_normal = $shifmalam->SKOR2_pulang_normal;
$skor3_mulai_normal = $shifmalam->SKOR3_masuk_normal;
$skor3_akhir_normal = $shifmalam->SKOR3_pulang_normal;
$skor4_mulai_normal = $shifmalam->SKOR4_masuk_normal;
$skor4_akhir_normal = $shifmalam->SKOR4_pulang_normal;
$data_normal = $data->masuk;

$jammulai_normal = date("H:i:s", strtotime($data_normal));

if (( strtotime($jammulai_normal) >= strtotime("$jam_buka_normal") ) and (strtotime($jammulai_normal) <= strtotime("$ontime_pulang_normal"))  )
$status422="ONTIME";

else if (( strtotime($jammulai_normal) >= strtotime("$skor1_mulai_normal") ) and (strtotime($jammulai_normal) <= strtotime("$skor1_akhir_normal"))  )
$status422="SKOR1";
else if (( strtotime($jammulai_normal) >= strtotime("$skor2_mulai_normal") ) and (strtotime($jammulai_normal) <= strtotime("$skor2_akhir_normal"))  )
$status422="SKOR2";
else if (( strtotime($jammulai_normal) >= strtotime("$skor3_mulai_normal") ) and (strtotime($jammulai_normal) <= strtotime("$skor3_akhir_normal"))  )
$status422="SKOR3";
		
else if (( strtotime($jammulai_normal) >= strtotime("$skor4_mulai_normal") ) and (strtotime($jammulai_normal) <= strtotime("$skor4_akhir_normal")))
$status422="SKOR4";

else if (( strtotime($jammulai_normal) >= strtotime("$jam_akhir_masuk_normal") ) and (strtotime($jammulai_normal) <= strtotime("24:00:00"))  )
$status422= "1";

else if (( strtotime("00:00:00") <= strtotime("$jam_buka_normal") )  )
$status422= "1";




if ($data->pulang != "00:00:00") { 
$pulang_normal = $data->pulang;
$jammulai_normal_pulang = date("H:i:s", strtotime($pulang_normal));


if (( strtotime($jammulai_normal_pulang) >= strtotime("00:00:00") ) and (strtotime($jammulai_normal_pulang) <= strtotime("$jam_pulang_normal"))  )
$status446= "2";

else if (( strtotime($jammulai_normal_pulang) >= strtotime("$jam_pulang_normal") ) and (strtotime($jammulai_normal_pulang) <= strtotime("$jam_akhir_pulang_normal"))  )	
$status446= "1";

else if (( strtotime("$jam_akhir_pulang_normal") <= strtotime("24:00:00") )  )
$status446= "2";

if ($status446 == "1") {

} else {
$cepatpulangcount++; 
} 	

} else { 
$cepatpulangcount++; 

} 






?>	
@endif
@endforeach	


<!-- PILAH ENDIF JUMAT --> @endif



<?php 



switch ($status422)
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



} 

if($data->apel_pagi ==  1) {
$hitungapelpagi++;	
}

 if($data->apel_sore ==  1) {
$hitungapelsore++;	

 }
 

 
?>	


	@else

	@endif









@endif
@endforeach
@endfor

<?php $jumlahhadirkehadiran = $hitung_ontime+$hitung_skor1+$hitung_skor2+$hitung_skor3+$hitung_skor4 ?>


@foreach ($dataskor as $data)
@if ($data->num_of_leave2 =="0") 
<tr>
	<td style="font-weight: bold;text-align: left;">{{ $data->dataSkor }} ({{ $data->singkat }})</td>
	<td width="10">:</td>
	<td>

	{{ $hitung_ontime }} x

	
	
	</td>
</tr>
@endif

@if ($data->num_of_leave2 =="1") 
<tr>
	<td style="font-weight: bold;text-align: left;">{{ $data->dataSkor }} ({{ $data->singkat }})</td>
	<td width="10">:</td>
	<td>{{ $hitung_skor1 }}  x</td>
</tr>
@endif

@if ($data->num_of_leave2 =="2") 
<tr>
	<td style="font-weight: bold;text-align: left;">{{ $data->dataSkor }} ({{ $data->singkat }})</td>
	<td width="10">:</td>
	<td>{{ $hitung_skor2 }}  x</td>
</tr>
@endif


@if ($data->num_of_leave2 =="3") 
<tr>
	<td style="font-weight: bold;text-align: left;">{{ $data->dataSkor }} ({{ $data->singkat }})</td>
	<td width="10">:</td>
	<td>{{ $hitung_skor3 }}  x</td>
</tr>
@endif



@if ($data->num_of_leave2 =="6") 
<tr>
	<td style="font-weight: bold;text-align: left;">{{ $data->dataSkor }} ({{ $data->singkat }})</td>
	<td width="10">:</td>
	<td>{{ $hitungapelsore }}  x</td>
</tr>
@endif

@if ($data->num_of_leave2 =="7") 
<tr>
	<td style="font-weight: bold;text-align: left;">{{ $data->dataSkor }} ({{ $data->singkat }})</td>
	<td width="10">:</td>

	<td> {{ $cepatpulangcount }} x</td>
</tr>
@endif


@if ($data->num_of_leave2 =="8") 
<tr>
	<td style="font-weight: bold;text-align: left;">{{ $data->dataSkor }} ({{ $data->singkat }})</td>
	<td width="10">:</td>
<?php $hitungjumlahket = $jumlahharikerja-$jumlahhadirkehadiran-$hitungcountketerangan2 ?>
	<td> {{ $hitungjumlahket }} x</td>
</tr>
@endif

@endforeach
<tr style="background: #e7eef1;">
	<td style="font-weight: bold;text-align: left;">Jumlah Kehadiran</td>
	<td width="10">:</td>

	<td> {{ $jumlahhadirkehadiran }} x</td>
</tr>
<tr style="background: #e7eef1;">
	<td style="font-weight: bold;text-align: left;">Presentase Kehadiran ({{ $jumlahhadirkehadiran }} / {{ $jumlahharikerja }}) * 100</td>
	<td width="10">:</td>
<?php $presensentasekeadhiran = ($jumlahhadirkehadiran / $jumlahharikerja) * 100; 
  $jumlahprsenhitung = number_format((float)$presensentasekeadhiran, 2, '.', '');
?>
	<td> {{ $jumlahprsenhitung }} % </td>
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
    font-size: 15px;">Hasil Inputan Nilai TPP Pada Kinerja dan Kehadiran    </div>
	
	<div class="scrollable-table">
<table border="0" width="100%" class="table table-bordered" style="margin-top:10px;text-align:center">
<tbody>
	
<tr>
<td colspan="3">HASIL PENGHASILAN BOBOT KINERJA	</td>
<td colspan="3">PEMOTONGAN</td>
<td rowspan="2">TOTAL BOBOT</td>
<td rowspan="2">NILAI TPP</td>
<td rowspan="2">TAMBAHAN TPP</td>
<td rowspan="2">JUMLAH KOTOR</td>
@foreach ($datatpp as $data)
<td rowspan="2">PPh 21<br><div style="color:red">{{ $data->pph_pegawai }}</div></td>
@endforeach	
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




@foreach ($datatpp as $data)
	
<tr>
<td style="vertical-align: middle;width: 50px;">{{ $data->jumlah_prestasi_kehadiran }}</td>

<td style="vertical-align: middle;width: 70px;">
<input type="hidden" style="width: 50px;" value="0.386" id="a2" readonly="">{{ $data->jumlah_prestasi_kinerja }}</td>

<td style="vertical-align: middle;width: 60px;">{{ $data->total_prestasi_kinerja }}</td>

<td style="vertical-align: middle;">{{ $data->pemotongan_cuti_kinerja }}</td>

<td style="vertical-align: middle;">{{ $data->pemotongan_hukuman_kinerja }}</td>

<td style="vertical-align: middle;">{{ $data->total_pemotongan_kinerja }}</td>

<td style="vertical-align: middle;width: 50px;">{{ $data->total_bobot_kinerja }}</td>

<td style="vertical-align: middle; text-align: center;">
<?php
$number = $data->nilai_tpp_kinerja;
$nilai_tpp_kinerja = number_format ($number, 0, ',', '.');
?>
{{ $nilai_tpp_kinerja }}
</td>
		

<td style="vertical-align: middle;">
<?php
$number1 = $data->tambahan_tpp_rp;
$tambahan_tpp_rp = number_format ($number1, 0, ',', '.');
?>

{{ $tambahan_tpp_rp }}</td>
		
<td style="vertical-align: middle;">
<?php
$number2 = $data->jumlah_kotor_kinerja;
$jumlah_kotor_kinerja = number_format ($number2, 0, ',', '.');
?>
{{ $jumlah_kotor_kinerja }}</td>

<td style="vertical-align: middle;width: 95px;">
<?php
$number3 = $data->nilai_pajak_kinerja;
$nilai_pajak_kinerja = number_format ($number3, 0, ',', '.');
?>
{{ $nilai_pajak_kinerja }}</td>
<td style="vertical-align: middle;">
<?php
$number4 = $data->jumlah_iwp;
$jumlah_iwp = number_format ($number4, 0, ',', '.');
?>
{{ $jumlah_iwp }}</td>
<td style="vertical-align: middle;">
<?php
$number5 = $data->jumlah_bersih_keseluruhan;
$jumlah_bersih_keseluruhan = number_format ($number5, 0, ',', '.');
?>
{{ $jumlah_bersih_keseluruhan }}</td>



</tr>
@endforeach	
	

</tbody>
</table>		
</div>
<?php } else { ?>	
<div style="    font-size: 15px;
    text-align: center;
	margin-top:20px;
    border: 1px solid #936e48;
    background: #f5f4d5;
    padding: 10px;">
                          
                             BELUM ADA KINERJA DAN KEHADIRAN YANG DI TAMBAHKAN PADA BULAN INI
								
                            </div>	
<?php }  ?>		
			
</div>
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

