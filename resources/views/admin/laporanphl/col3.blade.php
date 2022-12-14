<div id="updateCell{{ $row->employeeID }}">
@if($row->date == null)
-
@else

	
@if($row->status == "present")
<?php
$date_jumat = $row->tanggalabsen;
$timestamp = strtotime($date_jumat);
$carihari= date("l", $timestamp );
$tampilkanhari = strtolower($carihari);
?>

<!-- STAR PERIODE -->
@if($row->tanggalperiode ==  $row->tanggalabsen)
@if ($tampilkanhari == "friday")
@include('admin.attendances.col3_periode_jumat')
@else
@include('admin.attendances.col3_periode')	
@endif
<!-- ELSE PERIODE -->  @else


@if ($tampilkanhari == "friday")
@include('admin.attendances.col3_normal_jumat')
@else
@include('admin.attendances.col3_normal')	
@endif


<!-- END PERIODE --> @endif





@else
-
@endif
@endif



</div>
