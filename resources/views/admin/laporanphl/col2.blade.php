<div id="updateCell{{ $row->employeeID }}">
 
@if($row->date == null)
    <span class="label label-danger">Belum Absen</span>
@else
	

@if($row->status == "present")
<?php
$date_jumat = $row->tanggalabsen;
$timestamp = strtotime($date_jumat);
$carihari= date("l", $timestamp );
$tampilkanhari = strtolower($carihari);
?>



<!-- STAR PERIODE --> @if($row->tanggalperiode ==  $row->tanggalabsen)

@if ($tampilkanhari == "friday")
@include('admin.attendances.col2_periode_jumat')
@else
@include('admin.attendances.col2_periode')	
@endif
<!-- ELSE PERIODE --> @else
		
@if ($tampilkanhari == "friday")
@include('admin.attendances.col2_normal_jumat')
@else
@include('admin.attendances.col2_normal')	
@endif
<!-- END PERIODE --> @endif
				


@else
@if($row->idleaveType ==  $row->idketerangan)
<span class="label label-success">{{  $row->keterangan }} ({{  $row->singkatan }})</span>
 @else
	 <span class="label label-success" style="background-color: #d33636;">Keterangan tidak di temukan</span>
@endif	 
 
@endif



@endif


</div>
