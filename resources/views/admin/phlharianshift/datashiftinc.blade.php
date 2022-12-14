
<?php
$date_jumat_for = $row->dateshifs;
$timestamp_for = strtotime($date_jumat_for);
$carihari_for= date("l", $timestamp_for);
$tampilkanhari_for = strtolower($carihari_for);

?>

<!-- PILAH JUMAT --> @if ($tampilkanhari_for == "friday")


@if ($row->iddateshif == "1338" )
<?php
//shif pagi normal
$jam_buka_normal = $row->jam_masuk_normal_jumat; 
$jam_pulang_normal = $row->jam_pulang_normal_jumat; 
$jam_akhir_masuk_normal = $row->jam_akhir_masuk_normal_jumat; 
$jam_akhir_pulang_normal = $row->jam_akhir_pulang_normal_jumat; 
$ontime_masuk_normal = $row->ONTIME_masuk_normal_jumat; 
$ontime_pulang_normal = $row->ONTIME_pulang_normal_jumat; 
$skor1_mulai_normal = $row->SKOR1_masuk_normal_jumat;
$skor1_akhir_normal = $row->SKOR1_pulang_normal_jumat;
$skor2_mulai_normal = $row->SKOR2_masuk_normal_jumat; 
$skor2_akhir_normal = $row->SKOR2_pulang_normal_jumat;
$skor3_mulai_normal = $row->SKOR3_masuk_normal_jumat;
$skor3_akhir_normal = $row->SKOR3_pulang_normal_jumat;
$skor4_mulai_normal = $row->SKOR4_masuk_normal_jumat;
$skor4_akhir_normal = $row->SKOR4_pulang_normal_jumat;
$data_normal = $row->masuk;
$data_normal_pulang = $row->pulang;
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



?>
@endif



@if ($row->iddateshif == "1427" )
<?php
//shif siang normal
$jam_buka_normal = $row->jam_masuk_normal_jumat; 
$jam_pulang_normal = $row->jam_pulang_normal_jumat; 
$jam_akhir_masuk_normal = $row->jam_akhir_masuk_normal_jumat; 
$jam_akhir_pulang_normal = $row->jam_akhir_pulang_normal_jumat; 
$ontime_masuk_normal = $row->ONTIME_masuk_normal_jumat; 
$ontime_pulang_normal = $row->ONTIME_pulang_normal_jumat; 
$skor1_mulai_normal = $row->SKOR1_masuk_normal_jumat;
$skor1_akhir_normal = $row->SKOR1_pulang_normal_jumat;
$skor2_mulai_normal = $row->SKOR2_masuk_normal_jumat; 
$skor2_akhir_normal = $row->SKOR2_pulang_normal_jumat;
$skor3_mulai_normal = $row->SKOR3_masuk_normal_jumat;
$skor3_akhir_normal = $row->SKOR3_pulang_normal_jumat;
$skor4_mulai_normal = $row->SKOR4_masuk_normal_jumat;
$skor4_akhir_normal = $row->SKOR4_pulang_normal_jumat;
$data_normal = $row->masuk;
$data_normal_pulang = $row->pulang;
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



?>	
@endif

@if ($row->iddateshif == "1428" )
<?php
//shif malam normal
$jam_buka_normal = $row->jam_masuk_normal_jumat; 
$jam_pulang_normal = $row->jam_pulang_normal_jumat; 
$jam_akhir_masuk_normal = $row->jam_akhir_masuk_normal_jumat; 
$jam_akhir_pulang_normal = $row->jam_akhir_pulang_normal_jumat; 
$ontime_masuk_normal = $row->ONTIME_masuk_normal_jumat; 
$ontime_pulang_normal = $row->ONTIME_pulang_normal_jumat; 
$skor1_mulai_normal = $row->SKOR1_masuk_normal_jumat;
$skor1_akhir_normal = $row->SKOR1_pulang_normal_jumat;
$skor2_mulai_normal = $row->SKOR2_masuk_normal_jumat; 
$skor2_akhir_normal = $row->SKOR2_pulang_normal_jumat;
$skor3_mulai_normal = $row->SKOR3_masuk_normal_jumat;
$skor3_akhir_normal = $row->SKOR3_pulang_normal_jumat;
$skor4_mulai_normal = $row->SKOR4_masuk_normal_jumat;
$skor4_akhir_normal = $row->SKOR4_pulang_normal_jumat;
$data_normal = $row->masuk;

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









?>	
@endif

<!-- PILAH ELSE JUMAT --> @else


@if ($row->iddateshif == "1338" )
<?php
//shif pagi normal
$jam_buka_normal = $row->jam_masuk_normal; 
$jam_pulang_normal = $row->jam_pulang_normal; 
$jam_akhir_masuk_normal = $row->jam_akhir_masuk_normal; 
$jam_akhir_pulang_normal = $row->jam_akhir_pulang_normal; 
$ontime_masuk_normal = $row->ONTIME_masuk_normal; 
$ontime_pulang_normal = $row->ONTIME_pulang_normal; 
$skor1_mulai_normal = $row->SKOR1_masuk_normal;
$skor1_akhir_normal = $row->SKOR1_pulang_normal;
$skor2_mulai_normal = $row->SKOR2_masuk_normal; 
$skor2_akhir_normal = $row->SKOR2_pulang_normal;
$skor3_mulai_normal = $row->SKOR3_masuk_normal;
$skor3_akhir_normal = $row->SKOR3_pulang_normal;
$skor4_mulai_normal = $row->SKOR4_masuk_normal;
$skor4_akhir_normal = $row->SKOR4_pulang_normal;
$data_normal = $row->masuk;
$data_normal_pulang = $row->pulang;
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




?>
@endif

@if ($row->iddateshif == "1427" )
<?php
//shif siang normal
$jam_buka_normal = $row->jam_masuk_normal; 
$jam_pulang_normal = $row->jam_pulang_normal; 
$jam_akhir_masuk_normal = $row->jam_akhir_masuk_normal; 
$jam_akhir_pulang_normal = $row->jam_akhir_pulang_normal; 
$ontime_masuk_normal = $row->ONTIME_masuk_normal; 
$ontime_pulang_normal = $row->ONTIME_pulang_normal; 
$skor1_mulai_normal = $row->SKOR1_masuk_normal;
$skor1_akhir_normal = $row->SKOR1_pulang_normal;
$skor2_mulai_normal = $row->SKOR2_masuk_normal; 
$skor2_akhir_normal = $row->SKOR2_pulang_normal;
$skor3_mulai_normal = $row->SKOR3_masuk_normal;
$skor3_akhir_normal = $row->SKOR3_pulang_normal;
$skor4_mulai_normal = $row->SKOR4_masuk_normal;
$skor4_akhir_normal = $row->SKOR4_pulang_normal;
$data_normal = $row->masuk;
$data_normal_pulang = $row->pulang;
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



?>	
@endif

@if ($row->iddateshif == "1428" )
<?php
//shif malam normal
$jam_buka_normal = $row->jam_masuk_normal; 
$jam_pulang_normal = $row->jam_pulang_normal; 
$jam_akhir_masuk_normal = $row->jam_akhir_masuk_normal; 
$jam_akhir_pulang_normal = $row->jam_akhir_pulang_normal; 
$ontime_masuk_normal = $row->ONTIME_masuk_normal; 
$ontime_pulang_normal = $row->ONTIME_pulang_normal; 
$skor1_mulai_normal = $row->SKOR1_masuk_normal;
$skor1_akhir_normal = $row->SKOR1_pulang_normal;
$skor2_mulai_normal = $row->SKOR2_masuk_normal; 
$skor2_akhir_normal = $row->SKOR2_pulang_normal;
$skor3_mulai_normal = $row->SKOR3_masuk_normal;
$skor3_akhir_normal = $row->SKOR3_pulang_normal;
$skor4_mulai_normal = $row->SKOR4_masuk_normal;
$skor4_akhir_normal = $row->SKOR4_pulang_normal;
$data_normal = $row->masuk;

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










?>	
@endif


<!-- PILAH ENDIF JUMAT --> @endif


@if($status422 !=  "1")
<div class="label  label-{{  $status422 }}">{{  $status422 }}</div>


@if ($row->pulangkantor != "00:00:00")
	
@if ($row->iddateshif == "1338" OR $row->iddateshif == "1427")

@if (( strtotime($row->pulangkantor) >=  strtotime($jam_pulang_normal)) and (strtotime($row->pulangkantor) <= strtotime($jam_akhir_pulang_normal)))


@else
	 <div class="label label-success" style="background-color: #d33636;margin-bottom:3px;    display: block;">Pulang Cepat</div>
@endif

@endif



@if ($row->iddateshif == "1428")
<?php
$row->pulangkantor_normal = $row->pulangkantor;
$jammulai_normal_pulang = date("H:i:s", strtotime($row->pulangkantor_normal));


if (( strtotime($jammulai_normal_pulang) >= strtotime("00:00:00") ) and (strtotime($jammulai_normal_pulang) <= strtotime("$jam_pulang_normal"))  )
$status45= "2";

else if (( strtotime($jammulai_normal_pulang) >= strtotime("$jam_pulang_normal") ) and (strtotime($jammulai_normal_pulang) <= strtotime("$jam_akhir_pulang_normal"))  )	
$status45= "1";

else if (( strtotime("$jam_akhir_pulang_normal") <= strtotime("24:00:00") )  )
$status45= "2";
?>

@if ($status45 == "1")	

@else
	 <div class="label label-success" style="background-color: #d33636;margin-bottom:3px;    display: block;">Pulang Cepat</div>
@endif


@endif

@else

	 <div class="label label-success" style="background-color: #d33636;margin-bottom:3px;    display: block;">Pulang Cepat</div>
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
