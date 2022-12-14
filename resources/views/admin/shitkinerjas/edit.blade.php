@extends('admin.adminlayouts.adminlayout')

@section('head')

@stop


@section('mainarea')

    <!-- BEGIN PAGE HEADER-->
    <div class="page-head">
        <div class="page-title"><h1>
             Edit Form Kinerja dan Kehadiran
            </h1></div>
    </div>
    <div class="page-bar">
        <ul class="page-breadcrumb breadcrumb">
            <li>
                <a onclick="loadView('{{route('admin.dashboard.index')}}')">@lang("core.dashboard")</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <a onclick="loadView('{{ route('admin.shitkinerjas.index') }}')">Index</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span class="active"> Edit Form Kinerja dan Kehadiran</span>
            </li>
        </ul>

    </div>
@if($shitkinerja->employee->shift == "1")
@else
<script type="text/javascript">

    window.location.replace("../../payrolls/{{ $shitkinerja->id }}/edit");
</script>

@endif


    {!! Form::open(['class'=>'form-horizontal','method'=>'POST','id'=>'salary-form']) !!}

                        
                                    {{--Hidden Values--}}
                                    <input type="hidden" value="{{$shitkinerja->employee->id}}" name="employee_id">
                                    <input type="hidden" value="{{$shitkinerja->month}}" name="month">
                                    <input type="hidden" value="{{$shitkinerja->year}}" name="year">
                                    {{--Hidden values--}}

      
<?php
$daysInMonth = cal_days_in_month(CAL_GREGORIAN, $shitkinerja->month, $shitkinerja->year);	
$databulan =  $shitkinerja->month;
$datatahun = $shitkinerja->year;
				
				?>
        <div class="col-md-12" style="display:none">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        @lang("core.salaryInfo")
                    </div>
                </div>
                <div class="portlet-body">

                    <div class="form-group" style="margin-bottom: 0px;">
                        <label class="control-label col-md-3">@lang("core.hourlyRate")</label>
                        <div class="col-md-7 margin-bottom-100">
                            <input type="text" class="form-control only-num" id="hourly_rate" name="hourly_rate"
                                   placeholder="@lang("core.hourlyRate")" value="{{ $hourly_rate }}" disabled>
                        </div>
                    </div>
                    <div class="form-group" style="margin-bottom: 0px;">
                        <label class="control-label col-md-3">@lang("core.hoursClocked")</label>
                        <div class="col-md-7 margin-bottom-100">
                            <input type="text" class="form-control only-num" id="overtime_hours" name="overtime_hours"
                                   placeholder="@lang("core.hoursClocked")" value="{{$shitkinerja->overtime_hours}}">
                        </div>
                    </div>
                    <div class="form-group" style="margin-bottom: 0px;">
                        <label class="control-label col-md-3">@lang("core.totalHoursPayment")
                            ({{$loggedAdmin->company->currency_symbol}})</label>
                        <div class="col-md-7 margin-bottom-100">
                            <input type="text" class="form-control only-num" id="overtime_pay" name="overtime_pay"
                                   placeholder="overtime_pay" value="{{$shitkinerja->overtime_pay}}">
                        </div>
                    </div>
                    <div class="form-group" style="margin-bottom: 0px;">
                        <label class="control-label col-md-3">@lang("core.basicSalary")
                            ({{$loggedAdmin->company->currency_symbol}})</label>
                        <div class="col-md-7 margin-bottom-100">
                            <input type="text" class="form-control only-num" id="basic" name="basic"
                                   placeholder="@lang("core.basicSalary")" value="{{$shitkinerja->basic}}">
                        </div>
                    </div>
                    <div class="form-group" style="margin-bottom: 0px;">
                        <label class="control-label col-md-3">@lang("core.expenseClaim")
                            ({{$loggedAdmin->company->currency_symbol}})</label>
                        <div class="col-md-7 margin-bottom-100">
                            <input type="text" class="form-control only-num" id="expense_claim" name="expense"
                                   placeholder="@lang("core.expenseClaim")" value="{{$shitkinerja->expense}}">
                        </div>
                    </div>
                    <div class="form-group" style="margin-bottom: 0px;">
                        <label class="control-label col-md-3">@lang("core.status")</label>

                        <div class="col-md-7 margin-bottom-100">
                            <select class="form-control select2me" name="status">
                                <option value="paid" @if($shitkinerja->status == 'paid') selected @endif>Paid</option>
                                <option value="unpaid" @if($shitkinerja->status == 'unpaid') selected @endif>Unpaid</option>
                            </select>
                        </div>
                    </div>
                    <!--/span-->
                </div>

            </div>
        </div>

<div class="row">
        <div class="col-md-12 text-center">
            <div class="portlet light bordered">
                <div class="portlet-body">

             <div style="text-align: center;font-weight: bold;font-size: 25px;">	FORMULIR KINERJA DAN KEHADIRAN SHIFT   ({{ $shitkinerja->employee->statusmupeg }})    </div>
<div style="text-align: center;font-weight: bold;font-size: 20px;margin-top:-5px">BULAN 
						<?php  switch ($shitkinerja->month) { case '1':     echo 'JANUARI';     break; case '2':     echo 'FEBRUARI';     break; case '3':     echo 'MARET';     break; case '4':     echo 'APRIL';     break; case '5':     echo 'MEI';     break; case '6':     echo 'JUNI';     break; case '7':     echo 'JULI';     break; case '8':     echo 'AGUSTUS';     break; case '9':     echo 'SEPTEMBER';     break; 	case '10':     echo 'OKTOBER';     break; 	case '11':     echo 'NOVEMBER';     break; 		case '12':     echo 'DESEMBER';     break; 		default:     echo '';     break; } ?>
						TAHUN {{ $shitkinerja->year }}      </div>
		<div style="text-align: center;font-weight: bold;font-size: 18px;margin-bottom:20px;text-transform: uppercase;margin-top:-3px">NAMA : 

{{ $shitkinerja->employee->full_name }}
@if($shitkinerja->employee->statusmupeg == "ASN")
 / NIP : {{ $shitkinerja->employee->employeeID }} 
@endif

	
		</div>	
                </div>
            </div>

        </div>
        </div>

	<div class="row">

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
<?php
	foreach ($presntasiabsen as $persen) {
$datapersen= $persen->potongan_shift;
}
?>		
@foreach ($leavetype as $data)
            <div class="form-group" style="margin-bottom: 0px;" id="allowance{{ $data->id }}">
<?php
$dataku  = $data->singkat;
$hitungcountdinas = count(DB::select(DB::raw("SELECT datashift.date FROM attendance LEFT JOIN datashift ON attendance.date = datashift.date WHERE attendance.leaveType ='".$dataku."' AND datashift.status='hadir' AND attendance.status ='absent' AND attendance.application_status ='approved' AND MONTH(datashift.date)=" . $databulan . "  AND YEAR(datashift.date)=" . $datatahun . " AND attendance.employee_id=" . $noidapegs)));
$hitungcountdinas2 = count(DB::select(DB::raw("SELECT datashift.date FROM attendance LEFT JOIN datashift ON attendance.date = datashift.date WHERE attendance.leaveType ='".$dataku."' AND datashift.status='hadir' AND attendance.status ='absent' AND attendance.application_status ='approved' AND MONTH(attendance.date)=" . $databulan . "  AND YEAR(attendance.date)=" . $datatahun . " AND datashift.employee_id=" . $noidapegs ." AND attendance.employee_id=" . $noidapegs)));
$hitungcountketerangan = $hitungcountdinas2;
$hitungcountketerangan2 += $hitungcountdinas2;

$nCDT=$data->potongan_shift;
$TotalnCDT +=$data->potongan_shift;
$sCDT=$hitungcountketerangan;
$catatnCDTsCDT = $nCDT*$sCDT;
$TotalcatatnCDTsCDT += $nCDT*$sCDT;
$hasilnCDTsCDT = $catatnCDTsCDT/100;

$aCDT=$datapersen;
$bCDT=$hasilnCDTsCDT;
$hasilskorCDT = $aCDT*$bCDT;
$TOTALhasilskorCDT += $aCDT*$bCDT;
?> 

  <div class="col-md-7 margin-bottom-1">
<input type="text" class="form-control" name="allowanceTitle[]" value="{{ $data->leaveType }} ({{ $data->singkat }})  = {{ $hitungcountketerangan }}x" readonly>
</div>
<div class="col-md-3 margin-bottom-10" > <input type="text" class="form-control" value="{{ $catatnCDTsCDT }}x{{ $datapersen  }}%" readonly></div>
<div class="col-md-2  margin-bottom-10">
                    <input type="text" class="form-control" value="{{ $hasilskorCDT }}" name="allowance[]" readonly>
                </div>
            </div>
@endforeach   

			
	<div class="form-group" style="margin-bottom: 0px;" id="allowance25">
 
                <div class="col-md-7 margin-bottom-1">
                    <input type="text" class="form-control" style="background: #f9fbe4;font-weight: bold;" value="JUMLAH (PEMOTONGAN) = ( {{ $hitungcountketerangan2 }}x )" readonly="">
                </div>
				<div class="col-md-3 margin-bottom-10"> <input type="text" style="background: #f9fbe4;font-weight: bold;" class="form-control" value="{{ $TotalcatatnCDTsCDT }}x{{ $datapersen  }}%" readonly=""></div>
                <div class="col-md-2  margin-bottom-10">
                    <input type="text" class="allowance form-control" style="background: #f9fbe4;font-weight: bold;" value="{{ $TOTALhasilskorCDT }}"  readonly="">
                </div>
  
</div>

			
			
			

			


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
	

		
@foreach ($dataskor as $data)

@if ($data->num_of_leave2 =="1") 
<?php
$n1=$data->potongan;
$s1=$hitung_skor1;
$catatn1s1 = $n1*$s1;
$totalcatatn1s1 += $n1*$s1;
$hasiln1s1 = $catatn1s1/100;

$a1=$datapersen;
$b1=$hasiln1s1;
$hasilskor1 = $a1*$b1;
$totalhasilskor1 += $a1*$b1;

?>
            <div class="form-group" style="margin-bottom: 0px;" id="deduction{{ $data->id }}">


                <div class="col-md-7 margin-bottom-1">
                    <input type="text" class="form-control" value="{{ $data->dataSkor }} ({{ $data->singkat }}) = {{ $hitung_skor1 }}x" name="deductionTitle[]" readonly>
                </div>
				<div class="col-md-3 margin-bottom-10" > <input type="text" class="form-control" value="{{ $catatn1s1 }}x{{ $datapersen  }}%" readonly></div>
                <div class="col-md-2  margin-bottom-10">
                    <input type="text" class="form-control" value="{{ $hasilskor1 }}" name="deduction[]" readonly>
                </div>
        
            </div>
@endif

@if ($data->num_of_leave2 =="2") 
<?php
$n2=$data->potongan;
$s2=$hitung_skor2;
$catatn2s2 = $n2*$s2;
$totalcatatn2s2 += $n2*$s2;
$hasiln2s2 = $catatn2s2/100;

$a2=$datapersen;
$b2=$hasiln2s2;
$hasilskor2 = $a2*$b2;
$totalhasilskor2 += $a2*$b2;

?>
            <div class="form-group" style="margin-bottom: 0px;" id="deduction{{ $data->id }}">


                <div class="col-md-7 margin-bottom-1">
                    <input type="text" class="form-control" value="{{ $data->dataSkor }} ({{ $data->singkat }}) = {{ $hitung_skor2 }}x" name="deductionTitle[]" readonly>
                </div>
				<div class="col-md-3 margin-bottom-10" > <input type="text" class="form-control" value="{{ $catatn2s2 }}x{{ $datapersen  }}%" readonly></div>
                <div class="col-md-2  margin-bottom-10">
                    <input type="text" class="form-control" value="{{ $hasilskor2 }}" name="deduction[]" readonly>
                </div>
        
            </div>
@endif

@if ($data->num_of_leave2 =="3") 
<?php
$n3=$data->potongan;
$s3=$hitung_skor3;
$catatn3s3 = $n3*$s3;
$totalcatatn3s3 += $n3*$s3;
$hasiln3s3 = $catatn3s3/100;

$a3=$datapersen;
$b3=$hasiln3s3;
$hasilskor3 = $a3*$b3;
$totalhasilskor3 += $a3*$b3;

?>
            <div class="form-group" style="margin-bottom: 0px;" id="deduction{{ $data->id }}">


                <div class="col-md-7 margin-bottom-1">
                    <input type="text" class="form-control" value="{{ $data->dataSkor }} ({{ $data->singkat }}) = {{ $hitung_skor3 }}x" name="deductionTitle[]" readonly>
                </div>
				<div class="col-md-3 margin-bottom-10" > <input type="text" class="form-control" value="{{ $catatn3s3 }}x{{ $datapersen  }}%" readonly></div>
                <div class="col-md-2  margin-bottom-10">
                    <input type="text" class="form-control" value="{{ $hasilskor3 }}" name="deduction[]" readonly>
                </div>
        
            </div>
@endif


@if ($data->num_of_leave2 =="4") 
<?php
$n4=$data->potongan;
$s4=$hitung_skor4;
$catatn4s4 = $n4*$s4;
$totalcatatn4s4 += $n4*$s4;
$hasiln4s4 = $catatn4s4/100;

$a4=$datapersen;
$b4=$hasiln4s4;
$hasilskor4 = $a4*$b4;
$totalhasilskor4 += $a4*$b4;

?>
            <div class="form-group" style="margin-bottom: 0px;" id="deduction{{ $data->id }}">


                <div class="col-md-7 margin-bottom-1">
                    <input type="text" class="form-control" value="{{ $data->dataSkor }} ({{ $data->singkat }}) = {{ $hitung_skor4 }}x" name="deductionTitle[]" readonly>
                </div>
				<div class="col-md-3 margin-bottom-10" > <input type="text" class="form-control" value="{{ $catatn4s4 }}x{{ $datapersen  }}%" readonly></div>
                <div class="col-md-2  margin-bottom-10">
                    <input type="text" class="form-control" value="{{ $hasilskor4 }}" name="deduction[]" readonly>
                </div>
        
            </div>
@endif


@if ($data->num_of_leave2 =="5") 
<?php
$n5=$data->potongan;
$s5=$hitungapelpagi;
$catatn5s5 = $n5*$s5;
$totalcatatn5s5 += $n5*$s5;
$hasiln5s5 = $catatn5s5/100;

$a5=$datapersen;
$b5=$hasiln5s5;
$hasilskor5 = $a5*$b5;
$totalhasilskor5 += $a5*$b5;

?>
            <div class="form-group" style="margin-bottom: 0px;" id="deduction{{ $data->id }}">


                <div class="col-md-7 margin-bottom-1">
                    <input type="text" class="form-control" value="{{ $data->dataSkor }} ({{ $data->singkat }}) = {{ $hitungapelpagi }}x" name="deductionTitle[]" readonly>
                </div>
				<div class="col-md-3 margin-bottom-10" > <input type="text" class="form-control" value="{{ $catatn5s5 }}x{{ $datapersen  }}%" readonly></div>
                <div class="col-md-2  margin-bottom-10">
                    <input type="text" class="form-control" value="{{ $hasilskor5 }}" name="deduction[]" readonly>
                </div>
        
            </div>
@endif


@if ($data->num_of_leave2 =="6") 
<?php
$n6=$data->potongan;
$s6=$hitungapelsore;
$catatn6s6 = $n6*$s6;
$totalcatatn6s6 += $n6*$s6;
$hasiln6s6 = $catatn6s6/100;

$a6=$datapersen;
$b6=$hasiln6s6;
$hasilskor6 = $a6*$b6;
$totalhasilskor6 += $a6*$b6;

?>
            <div class="form-group" style="margin-bottom: 0px;" id="deduction{{ $data->id }}">


                <div class="col-md-7 margin-bottom-1">
                    <input type="text" class="form-control" value="{{ $data->dataSkor }} ({{ $data->singkat }}) = {{ $hitungapelsore }}x" name="deductionTitle[]" readonly>
                </div>
				<div class="col-md-3 margin-bottom-10" > <input type="text" class="form-control" value="{{ $catatn6s6 }}x{{ $datapersen  }}%" readonly></div>
                <div class="col-md-2  margin-bottom-10">
                    <input type="text" class="form-control" value="{{ $hasilskor6 }}" name="deduction[]" readonly>
                </div>
        
            </div>
@endif


@if ($data->num_of_leave2 =="7") 
<?php
$n7=$data->potongan;
$s7=$cepatpulangcount;
$catatn7s7 = $n7*$s7;
$totalcatatn7s7 += $n7*$s7;
$hasiln7s7 = $catatn7s7/100;

$a7=$datapersen;
$b7=$hasiln7s7;
$hasilskor7 = $a7*$b7;
$totalhasilskor7 += $a7*$b7;

?>
            <div class="form-group" style="margin-bottom: 0px;" id="deduction{{ $data->id }}">


                <div class="col-md-7 margin-bottom-1">
                    <input type="text" class="form-control" value="{{ $data->dataSkor }} ({{ $data->singkat }}) = {{ $cepatpulangcount }}x" name="deductionTitle[]" readonly>
                </div>
				<div class="col-md-3 margin-bottom-10" > <input type="text" class="form-control" value="{{ $catatn7s7 }}x{{ $datapersen  }}%" readonly></div>
                <div class="col-md-2  margin-bottom-10">
                    <input type="text" class="form-control" value="{{ $hasilskor7 }}" name="deduction[]" readonly>
                </div>
        
            </div>
@endif


@if ($data->num_of_leave2 =="8") 
		<?php $hitungjumlahket = $jumlahharikerja-$hitungtanpaketers-$hitungcountketerangan2 ?>
<?php
$n8=$data->potongan;
$s8=$hitungjumlahket;
$catatn8s8 = $n8*$s8;
$totalcatatn8s8 += $n8*$s8;
$hasiln8s8 = $catatn8s8/100;

$a8=$datapersen;
$b8=$hasiln8s8;
$hasilskor8 = $a8*$b8;
$totalhasilskor8 += $a8*$b8;

?>
            <div class="form-group" style="margin-bottom: 0px;" id="deduction{{ $data->id }}">


                <div class="col-md-7 margin-bottom-1">
                    <input type="text" class="form-control" value="{{ $data->dataSkor }} ({{ $data->singkat }}) = {{ $hitungjumlahket }}x" name="deductionTitle[]" readonly>
                </div>
				<div class="col-md-3 margin-bottom-10" > <input type="text" class="form-control" value="{{ $catatn8s8 }}x{{ $datapersen  }}%" readonly></div>
                <div class="col-md-2  margin-bottom-10">
                    <input type="text" class="form-control" value="{{ $hasilskor8 }}" name="deduction[]" readonly>
                </div>
        
            </div>
@endif


@endforeach





<?php $hitungjumlahskors = $hitung_skor1+$hitung_skor2+$hitung_skor3+$hitung_skor4+$hitungapelpagi+$hitungapelsore+$cepatpulangcount+$hitungjumlahket; ?>
<?php $presentasehitungskors = $totalhasilskor1+$totalhasilskor2+$totalhasilskor3+$totalhasilskor4+$totalhasilskor5+$totalhasilskor6+$totalhasilskor7+$totalhasilskor8; ?>
<?php $totalhitungskorssemua = $totalcatatn1s1+$totalcatatn2s2+$totalcatatn3s3+$totalcatatn4s4+$totalcatatn5s5+$totalcatatn6s6+$totalcatatn7s7+$totalcatatn8s8; ?>
<div class="form-group" style="margin-bottom: 0px;" id="allowance25">
 
                <div class="col-md-7 margin-bottom-1">
                    <input type="text" class="form-control" style="background: #f9fbe4;font-weight: bold;" value="JUMLAH (SKOR) = ( {{ $hitungjumlahskors }}x )" readonly="">
                </div>
				<div class="col-md-3 margin-bottom-10"> <input type="text" style="background: #f9fbe4;font-weight: bold;" class="form-control" value="{{ $totalhitungskorssemua }}x{{ $datapersen  }}%" readonly=""></div>
                <div class="col-md-2  margin-bottom-10">
                    <input type="text" class="deduction form-control" style="background: #f9fbe4;font-weight: bold;" value="{{ $presentasehitungskors }}"  readonly="">
                </div>
  
</div>
  

			
			
			


	

        </div>
    </div>
</div>


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
$jumlahkandatasemua = $presentasehitungskors+$TOTALhasilskorCDT;
$aJUMS=$datapersen;
$bJUMS=$jumlahkandatasemua;
$hasilskorJUMS = $aJUMS-$bJUMS;
$cektotalskorpeg=$hasilskorJUMS*100;
?>

@if($shitkinerja->employee->statusmupeg == "ASN")

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
<input type="hidden"  id="datakehadiranlihat"  value="0" style="width: 70px;    text-align: left;" class="form-control sum" id="b2" required="">
<input type="text" onkeypress="validate(event)"   name="jumlah_prestasi_kehadiran"  style="width: 70px; background-color: #f6dbdb; text-align: center;" class="form-control" id="totalkehadirandata" readonly>
</td>

<td style="vertical-align: middle;width: 70px;">
<input type="hidden"  style="width: 50px;" value="{{ $cektotalskorpeg }}" id="a2"  readonly>
<input type="number"  id="b2" name="jumlah_prestasi_kinerja" value="{{$shitkinerja->jumlah_prestasi_kinerja}}" min="0" step="5" max="60" style="width: 70px;    text-align: center;" class="form-control  sum" id="b2" required>
</td>

<td style="vertical-align: middle;width: 60px;">
<input type="text" id="hasil2" placeholder="-" style="width: 60px;text-align: center;background-color: #f6dbdb;" name="total_prestasi_kinerja" class="form-control  sum" readonly>	
</td>

<td style="vertical-align: middle;">
<input oninput="process(this)" type="number" style="width: 60px;text-align: center;" class="form-control  sum" name="pemotongan_cuti_kinerja" value="{{$shitkinerja->pemotongan_cuti_kinerja}}" id="c2">
</td>

<td style="vertical-align: middle;">
<input oninput="process(this)" type="number" style="width: 60px;text-align: center;" class="form-control  sum" name="pemotongan_hukuman_kinerja" value="{{$shitkinerja->pemotongan_hukuman_kinerja}}" id="d2">
</td>

<td style="vertical-align: middle;">
<input type="text" id="hasil3" placeholder="-" name="total_pemotongan_kinerja" style="width: 50px;text-align: center;background-color: #f6dbdb;" class="form-control" readonly>
</td>

<td style="vertical-align: middle;width: 50px;">
<input type="text" id="hasil4" placeholder="-" class="form-control" name="total_bobot_kinerja" readonly style="width: 70px;    text-align: center;background-color: #f6dbdb;">
</td>

<td style="vertical-align: middle; text-align: center;">

<?php 
$idpegcaris = $shitkinerja->employee->id;
$carisalary = count(DB::select(DB::raw("SELECT * FROM salary WHERE employee_id='".$idpegcaris."' "))); ?>

	@if($carisalary == 0)

<input type="hidden" id="h2" value="0" name="nilai_tpp_kinerja" placeholder="-" style="width: 80px; text-align: center;background-color: #f6dbdb;" class="noborder" readonly>
	
@else
	
@foreach ($sallery as $data)

{{ $data->gajipegawai }}
<input type="hidden" id="h2" value="{{ $data->gajipegawai }}" name="nilai_tpp_kinerja" placeholder="-" style="width: 80px; text-align: center;background-color: #f6dbdb;" class="noborder" readonly>
@endforeach
@endif
</td>
		

<td style="vertical-align: middle;">
<input oninput="process(this)" type="number" style="width: 100%;text-align: center;" class="form-control" name="tambahan_tpp_rp" value="{{$shitkinerja->tambahan_tpp_rp}}" id="hasiltpp">
<input oninput="process(this)" type="hidden" style="width: 100%;text-align: center;" class="form-control"  value="{{$shitkinerja->tambahan_tpp_rp}}" id="hasil9">
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
	
	
	
	




</tbody></table>




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
<input type="hidden"  id="datakehadiranlihat"  value="0" style="width: 70px;    text-align: left;" class="form-control sum" id="b2" required="">
<input type="text" onkeypress="validate(event)"   name="jumlah_prestasi_kehadiran"  style="width: 70px; background-color: #f6dbdb; text-align: center;" class="form-control" id="totalkehadirandata" readonly>
</td>

<td style="vertical-align: middle;width: 70px;">
<input type="hidden"  style="width: 50px;" value="{{ $cektotalskorpeg }}" id="a2"  readonly>
<input type="number"  id="b2" name="jumlah_prestasi_kinerja" value="{{$shitkinerja->jumlah_prestasi_kinerja}}" min="0" step="5" max="60" style="width: 70px;    text-align: center;" class="form-control  sum" id="b2" required>
</td>


<td style="vertical-align: middle;width: 60px;">
<input type="text" id="hasil2" placeholder="-" style="width: 60px;text-align: center;background-color: #f6dbdb;" name="total_prestasi_kinerja" class="form-control  sum" readonly>	
</td>

			
<input oninput="process(this)" type="hidden" style="width: 60px;text-align: center;" class="form-control  sum" name="pemotongan_cuti_kinerja" value="{{$shitkinerja->pemotongan_cuti_kinerja}}" id="c2">
<input oninput="process(this)" type="hidden" style="width: 60px;text-align: center;" class="form-control  sum" name="pemotongan_hukuman_kinerja" value="{{$shitkinerja->pemotongan_hukuman_kinerja}}" id="d2">
<input type="hidden" id="hasil3" placeholder="-" name="total_pemotongan_kinerja" style="width: 50px;text-align: center;background-color: #f6dbdb;" class="form-control" readonly>

<td style="vertical-align: middle;width: 50px;">
<input type="text" id="hasil4" placeholder="-" class="form-control" name="total_bobot_kinerja" readonly style="width: 70px;    text-align: center;background-color: #f6dbdb;">
</td>
<td style="vertical-align: middle; text-align: center;">

<?php 
$idpegcaris = $shitkinerja->employee->id;
$carisalary = count(DB::select(DB::raw("SELECT * FROM salary WHERE employee_id='".$idpegcaris."' "))); ?>

	@if($carisalary == 0)

<input type="hidden" id="h2" value="0" name="nilai_tpp_kinerja" placeholder="-" style="width: 80px; text-align: center;background-color: #f6dbdb;" class="noborder" readonly>
	
@else
	
@foreach ($sallery as $data)

{{ $data->gajipegawai }}
<input type="hidden" id="h2" value="{{ $data->gajipegawai }}" name="nilai_tpp_kinerja" placeholder="-" style="width: 80px; text-align: center;background-color: #f6dbdb;" class="noborder" readonly>
@endforeach
@endif
</td>
<input oninput="process(this)" type="hidden" style="width: 100%;text-align: center;" class="form-control" name="tambahan_tpp_rp" value="{{$shitkinerja->tambahan_tpp_rp}}" id="hasiltpp">
<input oninput="process(this)" type="hidden" style="width: 100%;text-align: center;" class="form-control"  value="{{$shitkinerja->tambahan_tpp_rp}}" id="hasil9">
		
<td style="vertical-align: middle;">
<input type="text" id="hasil5" name="jumlah_kotor_kinerja" placeholder="-" class="form-control" style="width: 100%;text-align: center;background-color: #f6dbdb;" readonly>
</td>
		
		
<td style="vertical-align: middle;width: 95px;">	

<input type="hidden" id="p2" value="0" readonly="">
<input type="text" id="hasil6" placeholder="-" name="nilai_pajak_kinerja" class="form-control" style="width: 95px;text-align: center;background-color: #f6dbdb;" readonly>
<input type="hidden" value="0" name="jumlah_iwp" placeholder="-" class="form-control" style="width: 100%;text-align: center;background-color: #f6dbdb;" readonly>
</td>
<td style="vertical-align: middle;">
<input type="text" id="hasil12" name="jumlah_bersih_keseluruhan" placeholder="-" class="form-control" style="width: 100%;text-align: center;background-color: #f6dbdb;" readonly>
</td>

	</tr>
	
	
	
	
	



</tbody>
</table>










@endif







     <input type="hidden" class="form-control"  name="pay_date" value="{{$shitkinerja->pay_date}}" readonly> 		
		
		

       <input type="hidden" class="form-control" id="total_allowance" name="total_allowance"
                                   placeholder="@lang("core.total")" value="{{$shitkinerja->total_allowance}}" readonly>
     <input type="hidden" class="form-control" id="total_deduction" name="total_deduction"
                                   placeholder="@lang("core.total")" value="{{$shitkinerja->total_deduction}}" readonly>
		             <input type="hidden" class="form-control" id="net_salary" name="net_salary"
                                   placeholder="@lang("core.total")" value="{{round($shitkinerja->net_salary, 2)}}" readonly>

     
                </div>
            </div>
        </div>
        {{--Gross End--}}
        <div class="col-md-12 text-center">
            <div class="portlet light bordered">
                <div class="portlet-body">

                    <button type="button" class="btn purple btn-lg"
                            onclick="submitData();return false;">SIMPAN KINERJA DAN KEHADIRAN</button>
                </div>
            </div>

        </div>


    </div>
    </div>

    {!!  Form::close()  !!}
    <!-- END FORM-->




    {{--Confirm Box Model--}}
    <div id="confirmBox" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Konfirmasi</h4>
                </div>
                <div class="modal-body" id="info">
                    <p>
Form Input Kinerja dan Kehadiran pada Bulan dan Tahun yang anda pilih sudah ada, silahkan klik edit form di bawah.!
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal"
                            class="btn dark btn-outline">Batalkan</button>
                    <button type="button" data-dismiss="modal" class="btn green" id="show"><i
                                class="fa fa-edit"></i> Edit Form</button>
                </div>
            </div>
        </div>
    </div>

    {{--Confirm Box MODAL--}}
    <!-- END PAGE CONTENT-->

@stop

@section('footerjs')


	<script>



 var a=parseFloat($("#a2").val());
        var b=parseFloat($("#b2").val());
        $("#hasil2").val(+(a+b).toFixed(2));
		
			
			var ab=parseFloat($("#a2").val());
			var bb=parseFloat($("#datakehadiranlihat").val());
			$("#totalkehadirandata").val(+(ab+bb).toFixed(2));

			
		var c=parseFloat($("#c2").val());
        var d=parseFloat($("#d2").val());
		  $("#hasil3").val(+(c+d).toFixed(2));
		  
		  
		     var e=parseFloat($("#hasil2").val());
        var f=parseFloat($("#hasil3").val());
		  $("#hasil4").val(+(e-f).toFixed(2));

		  
		  	     var h2=parseFloat($("#h2").val());
				 var n = 100;
        var g=parseFloat($("#hasil4").val());
        var z=parseFloat($("#hasiltpp").val());
		  $("#hasil5").val(+(h2/n*g+z).toFixed(2));
		  
		  
		   	     var o=parseFloat($("#hasil5").val());
				 var s = 100;
        var p2=parseFloat($("#p2").val());
		  $("#hasil6").val(+(o/s*p2).toFixed(2));
		  
		var nt=parseFloat($("#h2").val());
        var tp=parseFloat($("#hasiltpp").val());
		 $("#hasil9").val(+(nt).toFixed(2));
		
		var h9=parseFloat($("#hasil9").val());
        var t1=1;
        var t2=100;

		  $("#hasil8").val(+(t1/t2*h9).toFixed(2));

		  
		  		        var t=parseFloat($("#hasil5").val());
        var l=parseFloat($("#hasil6").val());
        var w=parseFloat($("#hasil8").val());
		  $("#hasil7").val(+(t-l-w).toFixed(0));

		  
		 var t=parseFloat($("#hasil5").val());
        var l=parseFloat($("#hasil6").val());

		  $("#hasil12").val(+(t-l).toFixed(0));

</script>

    <script>
	
	
	
	
        onlyNum('only-num');
        var $insertBeforeA = $('#insertBeforeA');
        var i = $(".allowance").length;
        $('#plusButtonA').click(function () {
            i = $(".allowance").length;
            $('<div class="form-group" style="margin-bottom: 0px;" id="allowance' + i + '">' +
                '<div class="control-label col-md-2"></div>' +
                '<div class="col-md-4 margin-bottom-10">' +
                '<input type="text" class="form-control" name="allowanceTitle[]" placeholder="@lang("core.allowance") ' + i + '">' +
                '</div>' +
                '<div class="col-md-3  margin-bottom-10">' +
                '<input type="text" class="allowance form-control" name="allowance[]" placeholder="@lang("core.value")">' +
                '</div>' +
                '<label class="control-label col-md-1">{{$loggedAdmin->company->currency}}</label> ' +
                ' <div class="col-md-2"> <button type="button" onclick="$(\'#allowance' + i + '\').remove();" class="btn red btn-sm delete">' +
                '<i class="fa fa-close"></i>' +
                '</button></div>' +
                '</div>').insertBefore($insertBeforeA);
            onlyNum('allowance');

        });
        var $insertBeforeD = $('#insertBeforeD');
        var j = $(".deduction").length;
        $('#plusButtonD').click(function () {
            j = $(".deduction").length;
            $('<div class="form-group" style="margin-bottom: 0px;" id="deduction' + j + '">' +
                '<div class="control-label col-md-2"></div>' +
                '<div class="col-md-4 margin-bottom-10">' +
                '<input type="text" class="form-control" name="deductionTitle[]" placeholder="@lang("core.deduction") ' + j + '">' +
                '</div>' +
                '<div class="col-md-3  margin-bottom-10">' +
                '<input type="text" class="deduction form-control" name="deduction[]" placeholder="@lang("core.value")">' +
                '</div>' +
                '<label class="control-label col-md-1">{{$loggedAdmin->company->currency}}</label> ' +
                '<div class="col-md-2"> <button type="button" onclick="$(\'#deduction' + j + '\').remove();" class="btn red btn-sm delete">' +
                '<i class="fa fa-close"></i>' +
                '</button></div>' +
                '</div>').insertBefore($insertBeforeD);
            onlyNum('deduction');

        });
        onlyNum('allowance');
        onlyNum('deduction');

        function check() {
            $('#load').html();
			
            var employee_id = $('#employeeID').val();
            var month = $('#month').val();
            var year = $('#year').val();
            $.ajax({
                type: 'POST',
                url: "{{route('admin.shitkinerjas.check')}}",
                dataType: "JSON",
                data: {'employee_id': employee_id, 'month': month, 'year': year},
                success: function (response) {
                    if (response.success == 'fail') {
                        $('#load').html(response.content);
						
                    } else {
                        $('#confirmBox').appendTo("body").modal('show');
                        $("#deleteModal").find('#info').html('Salary Slip for the selected employee month and year already created.Do you want modify it?');
                        $("#show").click(function () {
                            $('#load').html(response.content);
                            $('#load').append('<input type="hidden" name="type" value="edit">');
                        })
                    }

                },
                error: function (xhr, textStatus, thrownError) {

                }
            });
        }

        function submitData() {
            $('#error').html('<div class="alert alert-info"><span class="fa fa-info"></span> Submitting..</div>');
            $.ajax({
                type: 'POST',
                url: "{{route('admin.shitkinerjas.store')}}",
                dataType: "JSON",
                data: $('#salary-form').serialize(),
                success: function (response) {
                    if (response.status == "error") {
                        $('#error').html('');
                        var arr = response.msg;
                        var alert = '';
                        $.each(arr, function (index, value) {
                            if (value.length != 0) {
                                alert += '<p><span class="fa fa-close"></span> ' + value + '</p>';
                            }
                        });

                        $('#error').append('<div class="alert alert-danger alert-dismissable"><button class="close" data-close="alert"></button> ' + alert + '</div>');
                        $("html, body").animate({scrollTop: 0}, "slow");
                    } else {
                        window.location.href = '{{route('admin.shitkinerjas.index')}}'
                    }

                },
                error: function (xhr, textStatus, thrownError) {

                }
            });
        }

        $(document).on("change keydown paste input", function () {
            calculation();
        });

        function calculation() {
            var allowance = 0.0;
            var hours = 0;
            var hourly_rate = 0.0;
            var deduc = 0.0;
            var basic = 0.0;
            var expense_claim = 0.0;
            var overtime = 0.0;
            basic = $("#basic").val();
            expense_claim = $("#expense_claim").val();

            hourly_rate = $("#hourly_rate").val();
            hours = $("#overtime_hours").val();
			
			 var a=parseFloat($("#a2").val());
        var b=parseFloat($("#b2").val());
        $("#hasil2").val(+(a+b).toFixed(2));
		
			
			var ab=parseFloat($("#a2").val());
			var bb=parseFloat($("#datakehadiranlihat").val());
			$("#totalkehadirandata").val(+(ab+bb).toFixed(2));

			
		var c=parseFloat($("#c2").val());
        var d=parseFloat($("#d2").val());
		  $("#hasil3").val(+(c+d).toFixed(2));
		  
		  
		     var e=parseFloat($("#hasil2").val());
        var f=parseFloat($("#hasil3").val());
		  $("#hasil4").val(+(e-f).toFixed(2));

		  
		  	     var h2=parseFloat($("#h2").val());
				 var n = 100;
        var g=parseFloat($("#hasil4").val());
        var z=parseFloat($("#hasiltpp").val());
		  $("#hasil5").val(+(h2/n*g+z).toFixed(2));
		  
		  
		   	     var o=parseFloat($("#hasil5").val());
				 var s = 100;
        var p2=parseFloat($("#p2").val());
		  $("#hasil6").val(+(o/s*p2).toFixed(2));
		  
		var nt=parseFloat($("#h2").val());
        var tp=parseFloat($("#hasiltpp").val());
		 $("#hasil9").val(+(nt).toFixed(2));
		
		var h9=parseFloat($("#hasil9").val());
        var t1=1;
        var t2=100;

		  $("#hasil8").val(+(t1/t2*h9).toFixed(2));

		  
		  		        var t=parseFloat($("#hasil5").val());
        var l=parseFloat($("#hasil6").val());
        var w=parseFloat($("#hasil8").val());
		  $("#hasil7").val(+(t-l-w).toFixed(0));
		  

		 var t=parseFloat($("#hasil5").val());
        var l=parseFloat($("#hasil6").val());

		  $("#hasil12").val(+(t-l).toFixed(0));
			

            $("#overtime_pay").val(hourly_rate * hours);

            overtime = $("#overtime_pay").val();

            $(".allowance").each(function () {
                if ($(this).val() !== "") {
                    allowance += parseFloat($(this).val());
                }
            });

            $(".deduction").each(function () {
                if ($(this).val() !== "") {
                    deduc += parseFloat($(this).val());
                }

            });

            $("#total_allowance").val(allowance.toFixed(2));
            $("#total_deduction").val(deduc.toFixed(2));

            net_salary = (allowance - deduc) + parseFloat(basic) + parseFloat(overtime) + parseFloat(expense_claim);
            $("#net_salary").val(net_salary.toFixed(2));

        }
add();
$("input").blur(add);

console.log(+(0.1 + 0.2).toFixed(12) );

    </script>

@stop
