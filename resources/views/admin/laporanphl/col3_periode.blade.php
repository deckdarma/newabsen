


<?php


$jam_buka = $row->jam_masuk; 
$jam_pulang = $row->jam_pulang; 
$jam_akhir_masuk = $row->jam_akhir_masuk; 
$jam_akhir_pulang = $row->jam_akhir_pulang; 
$ontime_masuk = $row->ONTIME_masuk; 
$ontime_pulang = $row->ONTIME_pulang; 
$skor1_mulai = $row->SKOR1_masuk;
$skor1_akhir = $row->SKOR1_pulang;
$skor2_mulai = $row->SKOR2_masuk; 
$skor2_akhir = $row->SKOR2_pulang;
$skor3_mulai = $row->SKOR3_masuk;
$skor3_akhir = $row->SKOR3_pulang;
$skor4_mulai = $row->SKOR4_masuk;
$skor4_akhir = $row->SKOR4_pulang;
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
@if($status !=  "1")
<div class="label  label-{{  $status }}">{{  $status }}</div>
@if($row->pulangkantor ==  "00:00:00")

	 <div class="label label-success" style="background-color: #d33636;margin-bottom:3px;    display: block;">Pulang Cepat</div>
@else

@if (( strtotime($row->pulangkantor) >=  strtotime($row->jam_pulang)) and (strtotime($row->pulangkantor) <= strtotime($row->jam_akhir_pulang)))
 @else
	 <div class="label label-success" style="background-color: #d33636;margin-bottom:3px;    display: block;">Pulang Cepat</div>
	
@endif

@endif



@if($row->apelpagi ==  "1")
	
	 <div class="label label-success" style="background-color: #e07315;margin-bottom:3px;    display: block;">Tidak Apel Pagi</div>
@else
@endif

@if($row->apelsore ==  "1")

	 <div class="label label-success" style="background-color: #e07315;margin-bottom:3px;    display: block;">Tidak Apel Sore</div>
@else 
@endif




@else
-
@endif
<!-- ELSE PERIODE --> 