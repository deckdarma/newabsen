

<?php


$jam_buka = $row->jam_masuk_jumat; 
$jam_pulang_jumat = $row->jam_pulang_jumat; 
$jam_akhir_masuk_jumat = $row->jam_akhir_masuk_jumat; 
$jam_akhir_pulang_jumat = $row->jam_akhir_pulang_jumat; 
$ontime_masuk_jumat = $row->ONTIME_masuk_jumat; 
$ontime_pulang_jumat = $row->ONTIME_pulang_jumat; 
$skor1_mulai = $row->SKOR1_masuk_jumat;
$skor1_akhir = $row->SKOR1_pulang_jumat;
$skor2_mulai = $row->SKOR2_masuk_jumat; 
$skor2_akhir = $row->SKOR2_pulang_jumat;
$skor3_mulai = $row->SKOR3_masuk_jumat;
$skor3_akhir = $row->SKOR3_pulang_jumat;
$skor4_mulai = $row->SKOR4_masuk_jumat;
$skor4_akhir = $row->SKOR4_pulang_jumat;
?>

<?php

$data = $row->absenmasuk;


$jammulai = date("H:i:s", strtotime($data));

	
			if (( strtotime($jammulai) >= strtotime("$jam_buka") ) and (strtotime($jammulai) <= strtotime("$ontime_pulang_jumat"))  )
			$status="ONTIME";
			else if (( strtotime($jammulai) >= strtotime("$jam_buka") ) and (strtotime($jammulai) <= strtotime("$ontime_pulang_jumat"))  )
			$status="ONTIME";
			else if (( strtotime($jammulai) >= strtotime("$skor1_mulai") ) and (strtotime($jammulai) <= strtotime("$skor1_akhir"))  )
			$status="SKOR1";
			else if (( strtotime($jammulai) >= strtotime("$skor2_mulai") ) and (strtotime($jammulai) <= strtotime("$skor2_akhir"))  )
			$status="SKOR2";
			else if (( strtotime($jammulai) >= strtotime("$skor3_mulai") ) and (strtotime($jammulai) <= strtotime("$skor3_akhir"))  )
			$status="SKOR3";
		
			else if (( strtotime($jammulai) >= strtotime("$skor4_mulai") ) and (strtotime($jammulai) <= strtotime("$skor4_akhir")))
			$status="SKOR4";
		

				
			else if (( strtotime($jammulai) >= strtotime("$jam_akhir_masuk_jumat") ) and (strtotime($jammulai) <= strtotime("24:00:00"))  )
			$status= "1";

		
			else if (( strtotime("00:00:00") <= strtotime("$jam_buka") )  )
			$status= "1";



?>
@if($status !=  "1")	


	<div class="label  label-{{  $status }}">Masuk: <i class="fa fa-clock-o"></i> {{ $row->clock_in }}</div>
	
	

@if($row->pulangkantor != "00:00:00")
	@if (( strtotime($row->pulangkantor) >=  strtotime($row->jam_pulang_jumat)) and (strtotime($row->pulangkantor) <= strtotime($row->jam_akhir_pulang_jumat)))
	<div class="label  label-success" style="background-color: #1d319f;margin-bottom:3px;    display: block;">Pulang: <i class="fa fa-clock-o"></i> {{ $row->clock_out }}</div>

		 @else
<div class="label label-success" style="background-color: #d33636;margin-bottom:3px;    display: block;">Belum Pulang</div>
@endif
@else
<div class="label label-success" style="background-color: #d33636;margin-bottom:3px;    display: block;">Belum Pulang</div>
@endif
 




@else
-
@endif