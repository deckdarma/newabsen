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
@include('admin.dataapel.col2_periode_jumat')
@else
@include('admin.dataapel.col2_periode')	
@endif
<!-- ELSE PERIODE --> @else
		
@if ($tampilkanhari == "friday")
@include('admin.dataapel.col2_normal_jumat')
@else
@include('admin.dataapel.col2_normal')	

@endif
<!-- END PERIODE --> @endif
				





@else
	

@if($row->status == "absent")
<span class="label label-success">{{  $row->keterangan }} ({{  $row->singkatan }})</span>
@else
    <span class="label label-danger">Belum Absen</span>
@endif



@endif



@endif