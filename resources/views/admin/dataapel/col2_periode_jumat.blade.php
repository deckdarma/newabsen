
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

<input type="checkbox"
       id="checkbox{{  $row->employeeID }}"
       onchange="showHide('{{ $row->employeeID }}');return false;"
       class="make-bs-switch md-check"
       data-size="small" name="checkbox[]"
       data-on-color="success" data-on-text="Tampilkan" data-off-text="Tutup"
       data-off-color="danger"
       @if($row->status == "present" || $row->date == null) checked @endif/>
<input type="hidden" name="employees[]" value="{{ $row->employeeID }}">	


<div class="leave-form @if($row->status == "present" || $row->status == null) hidden @endif"
     id="leaveForm{{  $row->employeeID }}">
<div class="row"  >

<div class="col-lg-6 col-md-12">
 <label class="control-label">Masuk</label>

        <div class="input-icon input-icon-sm">
            <i class="fa fa-clock-o"></i>
            <input type="text" class="form-control input-sm {{ $status }}" id="clock_in{{ $row->employeeID }}"
                style="font-size: 13px;   text-align:left;"     value="{{ $row->clock_in }}" disabled>
        </div>
    </div>
	
    <div class="col-lg-6 col-md-12">
@if($row->pulangkantor != "00:00:00")
	@if (( strtotime($row->pulangkantor) >=  strtotime($row->jam_pulang_jumat)) and (strtotime($row->pulangkantor) <= strtotime($row->jam_akhir_pulang_jumat)))

		<label class="control-label">Pulang</label>
        <div class="input-icon input-icon-sm"><i class="fa fa-clock-o"></i>
            <input type="text" class="form-control input-sm" id="clock_out{{$row->employeeID }}"
                   style="background-color: #178492;
    color: #fff;
    font-size: 13px;
	font-weight:bold;
  "     value="{{ $row->clock_out }}" disabled>
        </div>
		 @else
	<label class="control-label">Belum Pulang</label>
 <div class="input-icon input-icon-sm"><i class="fa fa-clock-o"></i>
            <input type="text" style="    background-color: #e93f3f;color: #fff; font-size: 13px; font-weight:bold;  " class="form-control input-sm" id="clock_out{{$row->employeeID }}"
                   value="00:00" disabled>
        </div>
@endif
@else
		<label class="control-label">Belum Pulang</label>
 <div class="input-icon input-icon-sm"><i class="fa fa-clock-o"></i>
            <input type="text" style="    background-color: #e93f3f;color: #fff; font-size: 13px; font-weight:bold;  " class="form-control input-sm" id="clock_out{{$row->employeeID }}"
                   value="00:00" disabled>
        </div>
@endif
    </div>


</div>

<div class="row" >
<div class="leave-form"
     id="leaveForm{{  $row->employeeID }}">
    <div>
           <div class="col-lg-6 col-md-12">
		   <input type="hidden" name="employees[]" value="{{ $row->employeeID }}">
            <label class="control-label">Apel Pagi</label>
            <select class="form-control ApelPagi input-sm"
                    onchange="halfDayToggle({{  $row->employeeID }}, this.value)" id="ApelPagi{{  $row->employeeID }}"
                    name="apel_pagi[]">
               
				       <option value="0" @if($row->apel_pagi=='0') selected @endif>YA</option>
                       <option value="1" @if($row->apel_pagi=='1') selected @endif>TIDAK</option>
            </select>
        </div>
       <div class="col-lg-6 col-md-12">
            <label class="control-label">Apel Sore</label>
            <select class="form-control ApelSore input-sm"
                    onchange="halfDayToggle({{  $row->employeeID }}, this.value)" id="ApelSore{{  $row->employeeID }}"
                    name="apel_sore[]">
               
				       <option value="0" @if($row->apel_sore=='0') selected @endif>YA</option>
                       <option value="1" @if($row->apel_sore=='1') selected @endif>TIDAK</option>
            </select>
        </div>
		
			       <div class="col-lg-12 col-md-12">
		      <center>  <button type="button" style="width:100%;margin-top:8px" class="btn blue btn-sm" id="update_row{{ $row->employeeID }}" onclick="attendanceRow({{ $row->employeeID }})">Kirim Perubahan</button>   </center>  
				      </div>
    </div>
</div>
</div>
</div>
       
@else
<div style="margin: 0px;   ">
 <span class="label label-danger">Belum Absen</span>
</div>
@endif