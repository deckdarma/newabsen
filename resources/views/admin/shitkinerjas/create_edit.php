
    <!-- BEGIN EXAMPLE TABLE PORTLET-->

    {{--INLCUDE ERROR MESSAGE BOX--}}
    <div id="error"></div>
	    <div class="row">
    {{--END ERROR MESSAGE BOX--}}
       <div class="col-md-12 text-center">
            <div class="portlet light bordered">
                <div class="portlet-body">

<div style="text-align: center;font-weight: bold;font-size: 25px;">	FORMULIR KINERJA DAN KEHADIRAN SHIFT  @foreach ($datanama as $data)   ({{ $data->statusmupeg }})   @endforeach	 </div>
<div style="text-align: center;font-weight: bold;font-size: 20px;margin-top:-5px">BULAN 
						<?php  switch ($databulan) { case '1':     echo 'JANUARI';     break; case '2':     echo 'FEBRUARI';     break; case '3':     echo 'MARET';     break; case '4':     echo 'APRIL';     break; case '5':     echo 'MEI';     break; case '6':     echo 'JUNI';     break; case '7':     echo 'JULI';     break; case '8':     echo 'AGUSTUS';     break; case '9':     echo 'SEPTEMBER';     break; 	case '10':     echo 'OKTOBER';     break; 	case '11':     echo 'NOVEMBER';     break; 		case '12':     echo 'DESEMBER';     break; 		default:     echo '';     break; } ?>
						TAHUN {{ $datatahun }}      </div>
		<div style="text-align: center;font-weight: bold;font-size: 18px;margin-bottom:20px;text-transform: uppercase;margin-top:-3px">NAMA : 
@foreach ($datanama as $data)
{{ $data->full_name }} 
@if($data->statusmupeg == "ASN")
/ NIP : {{ $data->employeeID }} 
@endif
@endforeach	
<br>
<?php

switch($databulan){case '01':$angkabulan = '1';break;case '02':$angkabulan = '2';break;case '03':$angkabulan = '3';break;   	case '04':$angkabulan = '4';break;	case '05':$angkabulan = '5';break;	case '06':$angkabulan = '6';break;	case '07':$angkabulan = '7';break;	case '08':$angkabulan = '8';break;	case '09':$angkabulan = '9';break;	default:$angkabulan = $databulan;break;}

?>
<?php
$bln1 = date("m")-1;
$dateA = Date("Y-$bln1");
$dateB = "$datatahun-$angkabulan";

?> 

		</div>		
                </div>
            </div>

        </div>			
       <input type="hidden" class="form-control only-num" id="hourly_rate" name="hourly_rate"  value="0" disabled>
		<input type="hidden" class="form-control only-num" id="overtime_hours"  name="overtime_hours" value="0">
		<input type="hidden" class="form-control only-num" id="overtime_pay" name="overtime_pay" value="0">
		 <input type="hidden" class="form-control"  name="status"  value="paid">
			 <input type="hidden" class="form-control only-num" id="basic" name="basic" placeholder="@lang("core.basicSalary") " value="{{$basicSalary}}" readonly>
			   <input type="hidden" class="form-control only-num" id="expense_claim" name="expense"  placeholder="Ketik Tambahan TPP" value="{{$expense}}">









{{--Allowances--}}
<div class="col-md-6">
    <div class="portlet light bordered">
        <div class="portlet-title">
            <div class="caption font-dark">
              POTONGAN KETERANGAN
            </div>
        </div>
        <div class="portlet-body">
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
	$TOTALhasilskorCDT = 0;
	$TotalcatatnCDTsCDT = 0;
	$TotalnCDT = 0;
	
	$totalhasilskor1 = 0;
$totalhasilskor2 = 0;
$totalhasilskor3 = 0;
$totalhasilskor4 = 0;
$totalhasilskor5 = 0;
$totalhasilskor6 = 0;
$totalhasilskor7 = 0;
$totalhasilskor8 = 0;
$totalcatatn1s1 = 0;
$totalcatatn2s2 = 0;
$totalcatatn3s3 = 0;
$totalcatatn4s4 = 0;
$totalcatatn5s5 = 0;
$totalcatatn6s6 = 0;
$totalcatatn7s7 = 0;
$totalcatatn8s8 = 0;	
	
foreach ($presntasiabsen as $persen) {
$datapersen= $persen->potongan;
}

	?>	
	
	
@for ($i = 0; $i < $daysInMonth; $i++)
<?php
 $today = $i;
switch($today){case '1':$datahari = '01';break;case '2':$datahari = '02';break;case '3':$datahari = '03';break;   	case '4':$datahari = '04';break;	case '5':$datahari = '05';break;	case '6':$datahari = '06';break;	case '7':$datahari = '07';break;	case '8':$datahari = '08';break;	case '9':$datahari = '09';break;	default:$datahari = $today;break;}

$carilibur2 = count(DB::select(DB::raw("SELECT * FROM holidays WHERE  DAY(date)=" . $datahari . " AND MONTH(date)=" . $databulan . "  AND YEAR(date)=" . $datatahun . " ")));
$jumlahharikerja++;
if ($carilibur2 =="1")  {
	$countcariliburan++;
} else {


}

?>

 
@endfor		
	
	@foreach ($leavetype as $data)
            <div class="form-group" id="allowance{{ $data->id }}">
<?php
$dataku  = $data->singkat;
$hitungcountdinas = count(DB::select(DB::raw("SELECT holidays.date FROM attendance LEFT JOIN holidays ON attendance.date = holidays.date WHERE attendance.leaveType ='".$dataku."' AND attendance.status ='absent' AND application_status ='approved' AND MONTH(holidays.date)=" . $databulan . "  AND YEAR(holidays.date)=" . $datatahun . " AND attendance.employee_id=" . $noidapegs)));
$hitungcountdinas2 = count(DB::select(DB::raw("SELECT holidays.date FROM attendance LEFT JOIN holidays ON attendance.date = holidays.date WHERE attendance.leaveType ='".$dataku."' AND attendance.status ='absent' AND application_status ='approved' AND MONTH(attendance.date)=" . $databulan . "  AND YEAR(attendance.date)=" . $datatahun . " AND attendance.employee_id=" . $noidapegs)));
$hitungcountketerangan = $hitungcountdinas2;
$hitungcountketerangan2 += $hitungcountdinas2;


?> 

                <div class="col-md-7 margin-bottom-10">
                    <input type="text" class="form-control" name="allowanceTitle[]" value="{{ $data->leaveType }} ({{ $data->singkat }})  = {{ $hitungcountketerangan }}x" readonly>
                </div>
				<div class="col-md-5 margin-bottom-10" > <input type="text" class="form-control" value="Jumlah = {{ $hitungcountketerangan }}x" readonly></div>
            

           
            </div>
	 @endforeach   

			
			

			


    </div>
    </div>
</div>
{{--Allowances End--}}
{{--Deductions--}}
<div class="col-md-6">
    <div class="portlet light bordered">
        <div class="portlet-title">
            <div class="caption font-dark">
     DATA URAIAN SKOR
            </div>
        </div>
        <div class="portlet-body">


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
<?php $hitungjumlahket = $jumlahharikerja-$jumlahhadirkehadiran ?>

	
		
@foreach ($dataskor as $data)


@if ($data->num_of_leave2 =="1") 

            <div class="form-group" id="deduction{{ $data->id }}">


                <div class="col-md-7 margin-bottom-10">
                    <input type="text" class="form-control" value="{{ $data->dataSkor }} ({{ $data->singkat }})x " name="deductionTitle[]" readonly>
                </div>
				<div class="col-md-5 margin-bottom-10" > <input type="text" class="form-control" value="Jumlah = {{ $hitung_skor1 }}x" readonly></div>
             
        
            </div>
@endif

@if ($data->num_of_leave2 =="2") 

            <div class="form-group" id="deduction{{ $data->id }}">


                <div class="col-md-7 margin-bottom-10">
                    <input type="text" class="form-control" value="{{ $data->dataSkor }} ({{ $data->singkat }})" name="deductionTitle[]" readonly>
                </div>
				<div class="col-md-5 margin-bottom-10" > <input type="text" class="form-control" value="Jumlah = {{ $hitung_skor2 }}x" readonly></div>
             
        
            </div>
@endif

@if ($data->num_of_leave2 =="3") 

            <div class="form-group" id="deduction{{ $data->id }}">


                <div class="col-md-7 margin-bottom-10">
                    <input type="text" class="form-control" value="{{ $data->dataSkor }} ({{ $data->singkat }})" name="deductionTitle[]" readonly>
                </div>
				<div class="col-md-5 margin-bottom-10" > <input type="text" class="form-control" value="Jumlah = {{ $hitung_skor3 }}x" readonly></div>
               
        
            </div>
@endif


@if ($data->num_of_leave2 =="4") 

            <div class="form-group" id="deduction{{ $data->id }}">


                <div class="col-md-7 margin-bottom-10">
                    <input type="text" class="form-control" value="{{ $data->dataSkor }} ({{ $data->singkat }})" name="deductionTitle[]" readonly>
                </div>
				<div class="col-md-5 margin-bottom-10" > <input type="text" class="form-control" value="Jumlah = {{ $hitung_skor4 }}x" readonly></div>
            
        
            </div>
@endif





@if ($data->num_of_leave2 =="7") 

            <div class="form-group" id="deduction{{ $data->id }}">


                <div class="col-md-7 margin-bottom-10">
                    <input type="text" class="form-control" value="{{ $data->dataSkor }} ({{ $data->singkat }})" name="deductionTitle[]" readonly>
                </div>
				<div class="col-md-5 margin-bottom-10" > <input type="text" class="form-control" value="Jumlah = {{ $cepatpulangcount }}x" readonly></div>
        
        
            </div>
@endif


@if ($data->num_of_leave2 =="8") 

            <div class="form-group" id="deduction{{ $data->id }}">


                <div class="col-md-7 margin-bottom-10">
                    <input type="text" class="form-control" value="{{ $data->dataSkor }}" name="deductionTitle[]" readonly>
                </div>
				<div class="col-md-5 margin-bottom-10" > <input type="text" class="form-control" value="Jumlah = {{ $hitungjumlahket }}x" readonly></div>
          
        
            </div>
@endif


@endforeach
  



	

        </div>
    </div>
</div>


<div class="col-md-12 text-center">
            <div class="portlet light bordered">
                <div class="portlet-body">


<table border="0" width="100%" class="table table-bordered" style="text-align: center;">
	<tbody><tr>
		
		<td rowspan="2" style="font-size:11px;vertical-align: middle;">
			NAMA</td>
				<td style="font-size:11px;vertical-align: middle;">
			SKOR 1</td>
			<td style="font-size:10px;vertical-align: middle;">
		SKOR 2</td>
			<td style="font-size:10px;vertical-align: middle;">
		SKOR 3</td>
			<td style="font-size:10px;vertical-align: middle;">
		SKOR 4</td>
			<td style="font-size:10px;vertical-align: middle;">
		SKOR 5</td>
			<td style="font-size:10px;vertical-align: middle;">
	SKOR 6</td>
				<td style="font-size:10px;vertical-align: middle;">
		SKOR 7</td>
			<td style="font-size:10px;vertical-align: middle;">
	SKOR 8</td>
			<td style="font-size:10px;vertical-align: middle;">
	SKOR 9</td>
		<td style="font-size:11px;vertical-align: middle;">
			SKOR 10</td>
		<td rowspan="2" style="font-size:11px;vertical-align: middle;">
			Jumlah SKOR 1 s/d 10</td>
		<td rowspan="2" style="font-size:11px;vertical-align: middle;">
			SKOR PRESTASI KEHADIRAN</td>
	</tr>
	<tr>
		<td style="font-size:11px">
	Terlambat s/d 15 </td>
		<td style="font-size:11px">
		Terlambat       15 - 60</td>
		<td style="font-size:11px">
		Terlambat            60 - 120</td>
		<td style="font-size:11px">
			Terlambat            &gt; 120</td>
		<td style="font-size:11px">
		Cepat Pulang</td>
		<td style="font-size:11px">
			Cuti Sakit</td>
		<td style="font-size:11px">
		Cuti diLuar Tanggungan Negara</td>
		<td style="font-size:11px">
	Cuti Besar </td>
			<td style="font-size:11px">
		Dengan Keterangan Sah (Izin/sakit)</td>
		<td style="font-size:11px">
		Tanpa Keterangan</td>

	</tr>
	<tr>


<td width="25%" style="text-align: left;font-size:11px">
<b>@foreach ($datanama as $data)
{{ $data->full_name }}
@endforeach	</b><br>
			Jumlah Hari Kertidakhadiran<br>
			Jumlah Hari Kerja
			</td>
			
	@foreach ($dataskor as $data)	

	@if ($data->num_of_leave2 =="1") 
	<?php

$a1=$data->potongan;
$b1=$hitung_skor1;
$perkalian_sk1 = $a1*$b1;

$sk1=100;
$p_sk1=$perkalian_sk1;
$hasil_sk1 = $sk1-$p_sk1;


?>	
	
		<td style="font-size:11px">{{ $hasil_sk1 }}<br>
		{{ $hitung_skor1 }} 
		<br>
		{{ $jumlahharikerja }}			
		</td>
	@endif
	
	@if ($data->num_of_leave2 =="2")
	<?php

$a2=$data->potongan;
$b2=$hitung_skor2;
$perkalian_sk2 = $a2*$b2;

$sk2=100;
$p_sk2=$perkalian_sk2;
$hasil_sk2 = $sk2-$p_sk2;


?>	
	
		<td style="font-size:11px">{{ $hasil_sk2 }}<br> {{ $hitung_skor2 }}
		<br>
			{{ $jumlahharikerja }}			
		</td>
	@endif	
	
	@if ($data->num_of_leave2 =="3")
<?php
$a3=$data->potongan;
$b3=$hitung_skor3;
$perkalian_sk3 = $a3*$b3;

$sk3=100;
$p_sk3=$perkalian_sk3;
$hasil_sk3 = $sk3-$p_sk3;

?>
		
		<td style="font-size:11px">{{ $hasil_sk3 }}<br> {{ $hitung_skor3 }} 
		<br>
			{{ $jumlahharikerja }}				
		</td>
	@endif	
	
	@if ($data->num_of_leave2 =="4")
	<?php
$a4=$data->potongan;
$b4=$hitung_skor4;
$perkalian_sk4 = $a4*$b4;

$sk4=100;
$p_sk4=$perkalian_sk4;
$hasil_sk4 = $sk4-$p_sk4;

?>	
	
		<td style="font-size:11px">{{ $hasil_sk4 }}<br> {{ $hitung_skor4 }}
		<br>
		{{ $jumlahharikerja }}			
		</td>
	@endif		
	

@if ($data->num_of_leave2 =="7")
<?php
$a7=$data->potongan;
$b7=$cepatpulangcount;
$perkalian_sk7 = $a7*$b7;

$sk7=100;
$p_sk7=$perkalian_sk7;
$hasil_sk7 = $sk7-$p_sk7;

?>
 	
		<td style="font-size:11px">{{ $hasil_sk7 }}<br> {{ $hitung_skor4 }} 
		<br>
		{{ $jumlahharikerja }}		
		</td>
@endif	
	
		@endforeach

	@foreach ($leavetype as $data)
@if ($data->singkat =="RSCS")
<?php
$datakuRSCS  = $data->singkat;
$hitungRSCS = count(DB::select(DB::raw("SELECT holidays.date FROM attendance LEFT JOIN holidays ON attendance.date = holidays.date WHERE attendance.leaveType ='".$datakuRSCS."' AND attendance.status ='absent' AND application_status ='approved' AND MONTH(attendance.date)=" . $databulan . "  AND YEAR(attendance.date)=" . $datatahun . " AND attendance.employee_id=" . $noidapegs)));



$aRSCS=$data->potongan;
$bRSCS=$hitungRSCS;
$perkalian_skRSCS = $aRSCS*$bRSCS;

$skRSCS=100;
$p_skRSCS=$perkalian_skRSCS;
$hasil_skRSCS = $skRSCS-$p_skRSCS;

?>
	
		<td style="font-size:11px">{{ $hasil_skRSCS }}<br> {{ $hitungRSCS }}	
		<br>
			{{ $jumlahharikerja }}			
		</td>
@endif		
		
@if ($data->singkat =="RSCDTN")
<?php
$datakuRSCDTN  = $data->singkat;
$hitungRSCDTN = count(DB::select(DB::raw("SELECT holidays.date FROM attendance LEFT JOIN holidays ON attendance.date = holidays.date WHERE attendance.leaveType ='".$datakuRSCDTN."' AND attendance.status ='absent' AND application_status ='approved' AND MONTH(attendance.date)=" . $databulan . "  AND YEAR(attendance.date)=" . $datatahun . " AND attendance.employee_id=" . $noidapegs)));



$aRSCDTN=$data->potongan;
$bRSCDTN=$hitungRSCDTN;
$perkalian_skRSCDTN = $aRSCDTN*$bRSCDTN;

$skRSCDTN=100;
$p_skRSCDTN=$perkalian_skRSCDTN;
$hasil_skRSCDTN = $skRSCDTN-$p_skRSCDTN;

?>
	
		<td style="font-size:11px">{{ $hasil_skRSCDTN }}<br> {{ $hitungRSCDTN }}	
		<br>
			{{ $jumlahharikerja }}			
		</td>
@endif	


@if ($data->singkat =="RSCB")
<?php
$datakuRSCB  = $data->singkat;
$hitungRSCB = count(DB::select(DB::raw("SELECT holidays.date FROM attendance LEFT JOIN holidays ON attendance.date = holidays.date WHERE attendance.leaveType ='".$datakuRSCB."' AND attendance.status ='absent' AND application_status ='approved' AND MONTH(attendance.date)=" . $databulan . "  AND YEAR(attendance.date)=" . $datatahun . " AND attendance.employee_id=" . $noidapegs)));



$aRSCB=$data->potongan;
$bRSCB=$hitungRSCB;
$perkalian_skRSCB = $aRSCB*$bRSCB;

$skRSCB=100;
$p_skRSCB=$perkalian_skRSCB;
$hasil_skRSCB = $skRSCB-$p_skRSCB;

?>
	
		<td style="font-size:11px">{{ $hasil_skRSCB }}<br> {{ $hitungRSCB }}	
		<br>
			{{ $jumlahharikerja }}			
		</td>
@endif	
	
@if ($data->singkat =="RSDKS")
<?php
$datakuRSDKS  = $data->singkat;
$hitungRSDKS = count(DB::select(DB::raw("SELECT holidays.date FROM attendance LEFT JOIN holidays ON attendance.date = holidays.date WHERE attendance.leaveType ='".$datakuRSDKS."' AND attendance.status ='absent' AND application_status ='approved' AND MONTH(attendance.date)=" . $databulan . "  AND YEAR(attendance.date)=" . $datatahun . " AND attendance.employee_id=" . $noidapegs)));



$aRSDKS=$data->potongan;
$bRSDKS=$hitungRSDKS;
$perkalian_skRSDKS = $aRSDKS*$bRSDKS;

$skRSDKS=100;
$p_skRSDKS=$perkalian_skRSDKS;
$hasil_skRSDKS = $skRSDKS-$p_skRSDKS;

?>
	
		<td style="font-size:11px">{{ $hasil_skRSDKS }}<br> {{ $hitungRSDKS }}	
		<br>
			{{ $jumlahharikerja }}			
		</td>
@endif	

@if ($data->singkat =="RSTB")
<?php
$datakuRSTB  = $data->singkat;
$hitungRSTB = count(DB::select(DB::raw("SELECT holidays.date FROM attendance LEFT JOIN holidays ON attendance.date = holidays.date WHERE attendance.leaveType ='".$datakuRSTB."' AND attendance.status ='absent' AND application_status ='approved' AND MONTH(attendance.date)=" . $databulan . "  AND YEAR(attendance.date)=" . $datatahun . " AND attendance.employee_id=" . $noidapegs)));

?>

@endif

@if ($data->singkat =="RSCT")
<?php
$datakuRSCT  = $data->singkat;
$hitungRSCT = count(DB::select(DB::raw("SELECT holidays.date FROM attendance LEFT JOIN holidays ON attendance.date = holidays.date WHERE attendance.leaveType ='".$datakuRSCT."' AND attendance.status ='absent' AND application_status ='approved' AND MONTH(attendance.date)=" . $databulan . "  AND YEAR(attendance.date)=" . $datatahun . " AND attendance.employee_id=" . $noidapegs)));

?>

@endif

@endforeach
<?php
$aTNPA=$hitungjumlahket;
$bRSCT= $hitungRSCT;
$cRSTB= $hitungRSTB;
$datatanpakethitung = $aTNPA+$bRSCT+$cRSTB;
?>


						
@foreach ($dataskor as $data)
@if ($data->num_of_leave2 =="8") 

<?php

$a0=$data->potongan;
$b0=$jumlahharikerja;
$hasiltotal_absent = $a0/$b0;


$a1=$hasiltotal_absent;
$b1=100;
$hasilabsent_nilai = $a1*$b1;

$a2=$hasilabsent_nilai;
$b2=$datatanpakethitung;
$hasil_absenthasil = $a2*$b2;

$a3=100;
$b3=$hasil_absenthasil;
$hasil_sk8 = $a3-$b3;



?>
	

		<td style="font-size:11px">{{ number_format($hasil_sk8,2,",",".") }}<br> {{ $datatanpakethitung }}	
		<br>
			{{ $jumlahharikerja }}			
		</td>
	
@endif
@endforeach


		<td style="    vertical-align: middle;    font-weight: bold;">
<?php

$jumlahskorfinal = $hasil_sk1+$hasil_sk2+$hasil_sk3+$hasil_sk4+$hasil_sk7+$hasil_skRSCS+$hasil_skRSCDTN+$hasil_skRSCB+$hasil_skRSDKS+$hasil_sk8;

?>	
					
			
			{{ number_format($jumlahskorfinal,2,",",".") }}

			</td>
			<td style="    vertical-align: middle;    font-weight: bold;">
				<?php
											
$ahasil=1000;
$bhasil=$jumlahskorfinal;
$hasilskor_prestasi = $ahasil-$bhasil;


$askor=100;
$bskor=$hasilskor_prestasi;
$lihathasil_skor = $askor-$bskor;

$alihat=$lihathasil_skor;
$blihat=100;
$dapatnilai_skor = $alihat/$blihat;

$atotals=$dapatnilai_skor;
$btotals=50;
$total_skorpegawaifinal = $atotals*$btotals;


?>	
			{{ number_format($total_skorpegawaifinal,2,",",".") }}
			</td>
	</tr>
	
	
	

</tbody>
</table>

		
                </div>
            </div>

        </div>











{{--Deductions End--}}
{{--Gross--}}
<div class="col-md-12">
    <div class="portlet light bordered">
        <div class="portlet-title">
            <div class="caption font-dark">
        FORMULIR KINERJA DAN KEHADIRAN
            </div>
        </div>
        <div class="portlet-body">
		
<?php  
$jumlahkandatasemua = $total_skorpegawaifinal;
$aJUMS=$datapersen;
$bJUMS=$jumlahkandatasemua;
$hasilskorJUMS = $aJUMS-$bJUMS;
$cektotalskorpeg=$hasilskorJUMS*100;
?>
@if(strtotime($dateB) > strtotime($dateA))
<div class="note note-warning margin-top-15" style="font-size: 15px;    font-weight: 550;
 ">
MAAF, ANDA BELUM DAPAT MENCATAT LAPORAN KINERJA DAN KEHADIRAN KARENA BULAN 
						<?php  switch ($databulan) { case '1':     echo 'JANUARI';     break; case '2':     echo 'FEBRUARI';     break; case '3':     echo 'MARET';     break; case '4':     echo 'APRIL';     break; case '5':     echo 'MEI';     break; case '6':     echo 'JUNI';     break; case '7':     echo 'JULI';     break; case '8':     echo 'AGUSTUS';     break; case '9':     echo 'SEPTEMBER';     break; 	case '10':     echo 'OKTOBER';     break; 	case '11':     echo 'NOVEMBER';     break; 		case '12':     echo 'DESEMBER';     break; 		default:     echo '';     break; } ?>
						TAHUN {{ $datatahun }}  ADALAH BULAN DAN TAHUN BERJALAN
</div>
@else
	
@foreach ($datanama as $databagi)
@if($databagi->statusmupeg == "ASN")
	
@if($basicSalary == 0)

<div class="note note-danger margin-top-15" style="font-size: 15px;    font-weight: 550;
 ">
HARAP TAMBAHKAN NILAI TPP TERLEBIH DAHULU DI EDIT DATA PEGAWAI
</div>

@else
<table border="0" width="100%" class="table table-bordered" style="text-align: center;    font-size: 11px;">
<tbody>
	
<tr>
<td colspan="3">HASIL PENGHASILAN BOBOT KINERJA	</td>
<td colspan="3">PEMOTONGAN</td>
<td rowspan="2">TOTAL BOBOT</td>
<td rowspan="2">NILAI TPP</td>
<td rowspan="2">TAMBAHAN TPP</td>
<td rowspan="2">JUMLAH KOTOR</td>
@foreach ($datagols as $data)
<td rowspan="2">PPh 21<br><div style="color:red">{{ $data->golonganPeg }} / {{ $data->potongan }}%</div>
<input  type="hidden"  name="pph_pegawai"  value="{{ $data->potongan }}%">
@endforeach	
</td>
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

<tr>
<td>(%)</td>
<td>(%)</td>
<td>(%)</td>
<td>(%)</td>
<td>(%)</td>
<td>(%)</td>
<td>(%)</td>
<td>(Rp)</td>
<td>(Rp)</td>
<td>(Rp)</td>
<td>(%)</td>
<td>(Rp)</td>	
<td>(Rp)</td>	
</tr>
	
	<tr>
<td>1</td>
<td>2</td>
<td>3=1+1</td>
<td>4</td>
<td>5</td>
<td>6=4+5)</td>
<td>7=3-6)</td>
<td>8</td>	
<td>9</td>
<td>10=7x8+9</td>
<td>11</td>
<td>12=(1/100)*(8+9)</td>
<td>13=10-11-12</td>

	</tr>



	
<tr>
<td style="vertical-align: middle;width: 50px;">
<input type="hidden"  id="datakehadiranlihat"  value="0" style="width: 70px;    text-align: left;" class="form-control" id="b2" required="">
<input type="text" onkeypress="validate(event)" name="jumlah_prestasi_kehadiran" style="width: 70px; background-color: #f6dbdb; text-align: center;" class="form-control" id="totalkehadirandata" readonly>
</td>

<td style="vertical-align: middle;width: 70px;">
<input type="hidden"  style="width: 50px;" value="{{ $jumlahkandatasemua }}" id="a2"  readonly>
<input type="number"   min="0" step="5" max="60"  id="b2" name="jumlah_prestasi_kinerja" value="0" style="width: 70px;    text-align: center;" class="form-control" id="b2" required>

</td>

<td style="vertical-align: middle;width: 60px;">
<input type="text" id="hasil2" placeholder="-" style="width: 60px;text-align: center;background-color: #f6dbdb;" name="total_prestasi_kinerja" class="form-control" readonly>	
</td>

<td style="vertical-align: middle;">
<input oninput="process(this)" type="number" style="width: 60px;text-align: center;" class="form-control" name="pemotongan_cuti_kinerja" value="0" id="c2">
</td>

<td style="vertical-align: middle;">
<input oninput="process(this)" type="number" style="width: 60px;text-align: center;" class="form-control" name="pemotongan_hukuman_kinerja" value="0" id="d2">
</td>

<td style="vertical-align: middle;">
<input type="text" id="hasil3" placeholder="-" name="total_pemotongan_kinerja" style="width: 50px;text-align: center;background-color: #f6dbdb;" class="form-control" readonly>
</td>

<td style="vertical-align: middle;width: 50px;">
<input type="text" id="hasil4" placeholder="-" class="form-control" name="total_bobot_kinerja" readonly style="width: 70px;    text-align: center;background-color: #f6dbdb;">
</td>

<td style="vertical-align: middle; text-align: center;">
{{$basicSalary}}<input type="hidden" id="h2" value="{{$basicSalary}}" name="nilai_tpp_kinerja" placeholder="-" style="width: 80px; text-align: center;background-color: #f6dbdb;" class="noborder" readonly>
</td>
		

<td style="vertical-align: middle;">
<input oninput="process(this)" type="number" style="width: 100%;text-align: center;" class="form-control" name="tambahan_tpp_rp" value="0" id="hasiltpp">
<input oninput="process(this)" type="hidden" style="width: 100%;text-align: center;" class="form-control"  value="0" id="hasil9">
</td>
		
<td style="vertical-align: middle;">
<input type="text" id="hasil5" name="jumlah_kotor_kinerja" placeholder="-" class="form-control" style="width: 100%;text-align: center;background-color: #f6dbdb;" readonly>
</td>

<td style="vertical-align: middle;width: 95px;">	

@foreach ($datagols as $data)
<input type="hidden" id="p2" value="{{ $data->potongan }}" readonly="">
@endforeach	

<input type="text" id="hasil6" placeholder="-" name="nilai_pajak_kinerja" class="form-control" style="width: 95px;text-align: center;background-color: #f6dbdb;" readonly>
</td>
<td style="vertical-align: middle;"><input type="text" id="hasil8" name="jumlah_iwp" placeholder="-" class="form-control" style="width: 100%;text-align: center;background-color: #f6dbdb;" readonly>
</td>
<td style="vertical-align: middle;">
<input type="text" id="hasil7" name="jumlah_bersih_keseluruhan" placeholder="-" class="form-control" style="width: 100%;text-align: center;background-color: #f6dbdb;" readonly>
</td>



</tr>
	
	
	
	




</tbody>
</table>
@endif



@else
	





@if($basicSalary == 0)

<div class="note note-danger margin-top-15" style="font-size: 15px;    font-weight: 550;
 ">
HARAP TAMBAHKAN NILAI HONORIUM TERLEBIH DAHULU DI EDIT DATA PEGAWAI
</div>

@else


<table border="0" width="100%" class="table table-bordered" style="text-align: center;    font-size: 11px;">
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
	<tr>
		<td>
		(%)
</td>
		<td>
			(%)
</td>
		<td>
		(%)
</td>
		<td>
		(%)
</td>
	

					<td>
		(Rp)</td>
				<td>
		(Rp)</td>
				<td>
		(%)</td>
				<td>
		(Rp)</td>
		
	</tr>
	<tr>


		<td>
	1</td>
		<td>
	2</td>
		<td>
		3=1+2
</td>


		<td>
4
</td>
		<td>
			5</td>
			

		<td>
		6=4x5
		</td>
		<td>
	7
</td>
		<td>
	8=6-7
</td>

	</tr>
	
	<tr>
<input  type="hidden"  name="pph_pegawai"  value="0%">

<td style="vertical-align: middle;width: 50px;">
<input type="hidden"  id="datakehadiranlihat"  value="0" style="width: 70px;    text-align: left;" class="form-control" id="b2" required="">
<input type="text" onkeypress="validate(event)" name="jumlah_prestasi_kehadiran" style="width: 70px; background-color: #f6dbdb; text-align: center;" class="form-control" id="totalkehadirandata" readonly>
</td>
<td style="vertical-align: middle;width: 70px;">
<input type="hidden"  style="width: 50px;" value="{{ $jumlahkandatasemua }}" id="a2"  readonly>
<input type="number"   min="0" step="5" max="60"  id="b2" name="jumlah_prestasi_kinerja" value="0" style="width: 70px;    text-align: center;" class="form-control" id="b2" required>

</td>
<td style="vertical-align: middle;width: 60px;">
<input type="text" id="hasil2" placeholder="-" style="width: 60px;text-align: center;background-color: #f6dbdb;" name="total_prestasi_kinerja" class="form-control" readonly>	
</td>
		

			
<input oninput="process(this)" type="hidden" style="width: 60px;text-align: center;" class="form-control" name="pemotongan_cuti_kinerja" value="0" id="c2">
<input oninput="process(this)" type="hidden" style="width: 60px;text-align: center;" class="form-control" name="pemotongan_hukuman_kinerja" value="0" id="d2">
<input type="hidden" id="hasil3" placeholder="-" name="total_pemotongan_kinerja" style="width: 50px;text-align: center;background-color: #f6dbdb;" class="form-control" readonly>
<td style="vertical-align: middle;width: 50px;">
<input type="text" id="hasil4" placeholder="-" class="form-control" name="total_bobot_kinerja" readonly style="width: 70px;    text-align: center;background-color: #f6dbdb;">
</td>
<td style="vertical-align: middle; text-align: center;width: 200px;">
{{$basicSalary}}<input type="hidden" id="h2" value="{{$basicSalary}}" name="nilai_tpp_kinerja" placeholder="-" style="width: 200px; text-align: center;background-color: #f6dbdb;" class="noborder" readonly>
</td>
<input oninput="process(this)" type="hidden" style="width: 100%;text-align: center;" class="form-control" name="tambahan_tpp_rp" value="0" id="hasiltpp">
<input oninput="process(this)" type="hidden" style="width: 100%;text-align: center;" class="form-control"  value="0" id="hasil9">
		
<td style="vertical-align: middle;width: 200px;">
<input type="text" id="hasil5" name="jumlah_kotor_kinerja" placeholder="-" class="form-control" style="text-align: center;background-color: #f6dbdb;" readonly>
</td>
		
		
<td style="vertical-align: middle;width: 95px;">	

<input type="hidden" id="p2" value="0" readonly="">
<input type="text" id="hasil6" placeholder="-" name="nilai_pajak_kinerja" class="form-control" style="width: 95px;text-align: center;background-color: #f6dbdb;" readonly>
<input type="hidden"  name="jumlah_iwp" value="0" class="form-control" style="width: 100%;text-align: center;background-color: #f6dbdb;" readonly>
</td>
<td style="vertical-align: middle;">
<input type="text" id="hasil12" name="jumlah_bersih_keseluruhan" placeholder="-" class="form-control" style="width: 100%;text-align: center;background-color: #f6dbdb;" readonly>
</td>

	</tr>
	
	
	
	
	



</tbody>
</table>
@endif











@endif
@endforeach	
@endif













	
@if(strtotime($dateB) > strtotime($dateA))
@else		
          


@foreach ($datanama as $data)

@if($data->statusmupeg == "ASN")
 <input type="hidden" class="form-control"  name="pay_date" value="{{ $datatahun }}-{{ $databulan }}-01" readonly> 		
@else	
	 <input type="hidden" class="form-control"  name="pay_date" value="0000-00-00" readonly> 		
@endif
@endforeach		
		





            <div class="form-group" style="display:none">
                <label class="control-label col-md-3">@lang("core.totalAllowances") ({{$loggedAdmin->company->currency_symbol}})</label>

                <div class="col-md-7 margin-bottom-10">
                    <input type="text" class="form-control" id="total_allowance" name="total_allowance"
                           placeholder="@lang("core.total")" value="0" readonly>
						   
						         
                </div>
            </div>
            <div class="form-group" style="display:none">
                <label class="control-label col-md-3">@lang("core.totalDeductions") ({{$loggedAdmin->company->currency_symbol}})</label>

                <div class="col-md-7 margin-bottom-10">
                    <input type="text" class="form-control" id="total_deduction" name="total_deduction"
                           placeholder="@lang("core.total")" value="0" readonly>
                </div>
            </div>
            <div class="form-group" style="display:none">
                <label class="control-label col-md-3">@lang("core.netSalary") ({{$loggedAdmin->company->currency_symbol}})</label>

                <div class="col-md-7 margin-bottom-10">
                    <input type="text" class="form-control"  name="net_salary" value="{{$basicSalary}}"
                           value="0" readonly>
                </div>
            </div>
			
@endif
        </div>
    </div>
</div>
{{--Gross End--}}
@if(strtotime($dateB) > strtotime($dateA))
@else	
	
@if($basicSalary == 0)
@else
<div class="col-md-12 text-center">
    <div class="portlet light bordered">
        <div class="portlet-body">
            <button type="button" class="btn btn-success btn-lg" onclick="submitData();return false;">TAMBAHKAN KINERJA DAN KEHADIRAN</button>
        </div>

    </div>
    </div>
@endif		
	
	
@endif	
<style>
.table td, .table th {
    font-size: 11px;
}
</style>
<style>
.table-bordered > tbody > tr > td, .table-bordered > tfoot > tr > th, .table-bordered > tfoot > tr > td {
    border: 1px solid #c2cad8;
}

.table-responsive {
    overflow-x: hidden;
    min-height: 0.01%;
}
</style>