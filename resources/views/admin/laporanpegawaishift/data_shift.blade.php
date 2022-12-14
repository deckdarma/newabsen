

@if ($tampilkanhari == "friday")



  @if ($status !="absent" )


@if ($totalStatusCount != "0" )
		@if($status4 !=  "1")	
<td style="text-align: left;color: #fff;    text-transform: uppercase;" class="normal{{ $iddateshif }}">{{ $namashift }}</td>


		

<td><span class="label  label-{{  $status4 }}">{{  $status4 }} ({{ $masuk }}) </span>  </td>




@if ($pulang != "00:00:00")
	
@if ($iddateshif == "1338" OR $iddateshif == "1427")

@if (( strtotime($pulang) >=  strtotime($jam_pulang_normal_jumat)) and (strtotime($pulang) <= strtotime($jam_akhir_pulang_normal_jumat)))
<td><center><span class="label label-success">Pulang ({{ $pulang }})</span></center></td>

@else
<td style="color:#fff;text-align: center;background-color: #eb939a;"><span class="label label-danger">Pulang Cepat</span> {{ $pulang }} </td>
@endif

@endif



@if ($iddateshif == "1428")
<?php
$pulang_normal_jumat = $pulang;
$jammulai_normal_jumat = date("H:i:s", strtotime($pulang_normal_jumat));


if (( strtotime($jammulai_normal_jumat) >= strtotime("00:00:00") ) and (strtotime($jammulai_normal_jumat) <= strtotime("$jam_pulang_normal_jumat"))  )
$status45= "2";

else if (( strtotime($jammulai_normal_jumat) >= strtotime("$jam_pulang_normal_jumat") ) and (strtotime($jammulai_normal_jumat) <= strtotime("$jam_akhir_pulang_normal_jumat"))  )	
$status45= "1";

else if (( strtotime("$jam_akhir_pulang_normal_jumat") <= strtotime("24:00:00") )  )
$status45= "2";
?>

@if ($status45 == "1")	
<td><center><span class="label label-success">Pulang ({{ $pulang }})</span></center></td>

@else
<td style="color:#fff;text-align: center;background-color: #eb939a;"><span class="label label-danger">Pulang Cepat</span> {{ $pulang }} </td>
@endif


@endif

@else
<td style="color:#fff;text-align: center;background-color: #eb939a;"><span class="label label-danger">Blm Pulang</span></td>
@endif





@if ($pulang != "00:00:00")
	
@if ($iddateshif == "1338" OR $iddateshif == "1427")

@if (( strtotime($pulang) >=  strtotime($jam_pulang_normal)) and (strtotime($pulang) <= strtotime($jam_akhir_pulang_normal)))	
<td><center><span class="label label-success"> {{ $jamkerjapeg }}</span></center></td>

@else
<td style="text-align: center;background: #eeefe8;"><span class="label label-danger">0 jam, 0 menit</span></td>
@endif

@endif



@if ($iddateshif == "1428")
<?php
$pulang_normal_jumat = $pulang;
$jammulai_normal_jumat = date("H:i:s", strtotime($pulang_normal_jumat));


if (( strtotime($jammulai_normal_jumat) >= strtotime("00:00:00") ) and (strtotime($jammulai_normal_jumat) <= strtotime("$jam_pulang_normal_jumat"))  )
$status45= "2";

else if (( strtotime($jammulai_normal_jumat) >= strtotime("$jam_pulang_normal_jumat") ) and (strtotime($jammulai_normal_jumat) <= strtotime("$jam_akhir_pulang_normal_jumat"))  )	
$status45= "1";

else if (( strtotime("$jam_akhir_pulang_normal_jumat") <= strtotime("24:00:00") )  )
$status45= "2";

$d11 = new DateTime($masuk);
$d22 = new DateTime('24:00:00');
$interval1 = $d22->diff($d11);
$jammasukkerjajam = $interval1->format('%H:%I:%S');


$d13 = new DateTime('00:00:00');
$d24 = new DateTime($pulang);
$interval2 = $d24->diff($d13);
$jampulangkerjajam = $interval2->format('%H:%I:%S');


$times = array($jammasukkerjajam,$jampulangkerjajam); 
$seconds = 0; foreach ( $times as $time ) { list( $g, $i, $s ) = explode( ':', $time ); $seconds += $g * 3600; $seconds += $i * 60; $seconds += $s; } $hours = floor( $seconds / 3600 ); $seconds -= $hours * 3600; $minutes = floor( $seconds / 60 ); $seconds -= $minutes * 60; 



?>

@if ($status45 == "1")	
<td><center><span class="label label-success"> {{ $hours }} jam, {{ $minutes }} menit</span></center></td>

@else
<td style="text-align: center;background: #eeefe8;"><span class="label label-danger">0 jam, 0 menit</span></td>
@endif


@endif

@else
<td style="text-align: center;background: #eeefe8;"><span class="label label-danger">0 jam, 0 menit</span></td>
@endif




@if($apelpagi ==  "1")
<td style="color:#fff;text-align: center;background-color: #e07315;">Tidak Apel Pagi</td>
@else
<td style="color:#fff;text-align: center;background-color: #26c281;">&#10004;</td>
@endif

@if($apelsore ==  "1")
<td style="color:#fff;text-align: center;background-color: #e07315;">Tidak Apel Sore</td>
@else
<td style="color:#fff;text-align: center;background-color: #26c281;">&#10004;</td>
@endif

@else
<td colspan="6" style="background-color: #f00;color: #fff;text-align:center;">TANPA KETERANGAN YANG SAH</td>
@endif
@else
<td colspan="6" style="background-color: #f00;color: #fff;text-align:center;">TANPA KETERANGAN YANG SAH</td>
@endif


@else
<td colspan="6" style="text-align:center;background: #1280cf;color:#fff;">{{ $namaketerangan }} ({{ $leaveType }})</td>
@endif	


	





@else



  
  @if ($status !="absent" )


@if ($totalStatusCount != "0" )

		@if($status4 !=  "1" )	
<td style="text-align: left;color: #fff;text-transform: uppercase;" class="normal{{ $iddateshif }}">{{ $namashift }}</td>


		

<td><span class="label  label-{{  $status4 }}"> {{ $status4 }}  ({{ $masuk }})</span>  </td>




@if ($pulang != "00:00:00")
	
@if ($iddateshif == "1338" OR $iddateshif == "1427")

@if (( strtotime($pulang) >=  strtotime($jam_pulang_normal)) and (strtotime($pulang) <= strtotime($jam_akhir_pulang_normal)))	
<td><center><span class="label label-success">Pulang ({{ $pulang }})</span></center></td>

@else
<td style="color:#fff;text-align: center;background-color: #eb939a;"><span class="label label-danger">Pulang Cepat</span> {{ $pulang }} </td>
@endif

@endif



@if ($iddateshif == "1428")
<?php
$pulang_normal = $pulang;
$jammulai_normal = date("H:i:s", strtotime($pulang_normal));


if (( strtotime($jammulai_normal) >= strtotime("00:00:00") ) and (strtotime($jammulai_normal) <= strtotime("$jam_pulang_normal"))  )
$status44= "2";

else if (( strtotime($jammulai_normal) >= strtotime("$jam_pulang_normal") ) and (strtotime($jammulai_normal) <= strtotime("$jam_akhir_pulang_normal"))  )	
$status44= "1";

else if (( strtotime("$jam_akhir_pulang_normal") <= strtotime("24:00:00") )  )
$status44= "2";


?>

@if ($status44 == "1")	
<td><center><span class="label label-success">Pulang ({{ $pulang }})</span></center></td>

@else
<td style="color:#fff;text-align: center;background-color: #eb939a;"><span class="label label-danger">Pulang Cepat</span> {{ $pulang }} </td>
@endif


@endif

@else
<td style="color:#fff;text-align: center;background-color: #eb939a;"><span class="label label-danger">Blm Pulang</span></td>
@endif		




@if ($pulang != "00:00:00")
	
@if ($iddateshif == "1338" OR $iddateshif == "1427")

@if (( strtotime($pulang) >=  strtotime($jam_pulang_normal)) and (strtotime($pulang) <= strtotime($jam_akhir_pulang_normal)))	
<td><center><span class="label label-success"> {{ $jamkerjapeg }}</span></center></td>

@else
<td style="text-align: center;background: #eeefe8;"><span class="label label-danger">0 jam, 0 menit</span></td>
@endif

@endif



@if ($iddateshif == "1428")
<?php
$pulang_normal = $pulang;
$jammulai_normal = date("H:i:s", strtotime($pulang_normal));


if (( strtotime($jammulai_normal) >= strtotime("00:00:00") ) and (strtotime($jammulai_normal) <= strtotime("$jam_pulang_normal"))  )
$status44= "2";

else if (( strtotime($jammulai_normal) >= strtotime("$jam_pulang_normal") ) and (strtotime($jammulai_normal) <= strtotime("$jam_akhir_pulang_normal"))  )	
$status44= "1";

else if (( strtotime("$jam_akhir_pulang_normal") <= strtotime("24:00:00") )  )
$status44= "2";

$d11 = new DateTime($masuk);
$d22 = new DateTime('24:00:00');
$interval1 = $d22->diff($d11);
$jammasukkerjajam = $interval1->format('%H:%I:%S');


$d13 = new DateTime('00:00:00');
$d24 = new DateTime($pulang);
$interval2 = $d24->diff($d13);
$jampulangkerjajam = $interval2->format('%H:%I:%S');


$times = array($jammasukkerjajam,$jampulangkerjajam); 
$seconds = 0; foreach ( $times as $time ) { list( $g, $i, $s ) = explode( ':', $time ); $seconds += $g * 3600; $seconds += $i * 60; $seconds += $s; } $hours = floor( $seconds / 3600 ); $seconds -= $hours * 3600; $minutes = floor( $seconds / 60 ); $seconds -= $minutes * 60; 



?>

@if ($status44 == "1")	
<td><center><span class="label label-success"> {{ $hours }} jam, {{ $minutes }} menit</span></center></td>

@else
<td style="text-align: center;background: #eeefe8;"><span class="label label-danger">0 jam, 0 menit</span></td>
@endif


@endif

@else
<td style="text-align: center;background: #eeefe8;"><span class="label label-danger">0 jam, 0 menit</span></td>
@endif




@if($apelpagi ==  "1")
<td style="color:#fff;text-align: center;background-color: #e07315;">Tidak Apel Pagi</td>
@else
<td style="color:#fff;text-align: center;background-color: #26c281;">&#10004;</td>
@endif

@if($apelsore ==  "1")
<td style="color:#fff;text-align: center;background-color: #e07315;">Tidak Apel Sore</td>
@else
<td style="color:#fff;text-align: center;background-color: #26c281;">&#10004;</td>
@endif

@else
<td colspan="6" style="background-color: #f00;color: #fff;text-align:center;">TANPA KETERANGAN YANG SAH</td>
@endif
@else
<td colspan="6" style="background-color: #f00;color: #fff;text-align:center;">TANPA KETERANGAN YANG SAH</td>
@endif



@else
<td colspan="6" style="text-align:center;background: #1280cf;color:#fff;">{{ $namaketerangan }} ({{ $leaveType }})</td>
@endif	

		

@endif

