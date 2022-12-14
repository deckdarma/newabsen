<div class="table-toolbar">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="btn-group">
                             <a href="javascript:printDiv('id-elemen-yang-ingin-di-print');" class="btn green"> <i class="fa fa-print"></i>  Print Halaman ini</a>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                    </div>
                                </div>
                            </div>
							

<div id="id-elemen-yang-ingin-di-print"> 

						<div style="text-align: center;font-weight: bold;font-size: 25px;">	LAPORAN BULANAN PEGAWAI (ASN/PHL)        </div>
						<div style="text-align: center;font-weight: bold;font-size: 20px;text-transform: uppercase;margin-top: -5px;">{{ $loggedAdmin->company->company_name }} </div>
						<div style="text-align: center;font-weight: bold;font-size: 15px;text-transform: uppercase;margin-top: 0px;margin-bottom:20px;">BULAN 
						<?php  switch ($databulan) { case '1':     echo 'JANUARI';     break; case '2':     echo 'FEBRUARI';     break; case '3':     echo 'MARET';     break; case '4':     echo 'APRIL';     break; case '5':     echo 'MEI';     break; case '6':     echo 'JUNI';     break; case '7':     echo 'JULI';     break; case '8':     echo 'AGUSTUS';     break; case '9':     echo 'SEPTEMBER';     break; 	case '10':     echo 'OKTOBER';     break; 	case '11':     echo 'NOVEMBER';     break; 		case '12':     echo 'DESEMBER';     break; 		default:     echo '';     break; } ?>
						TAHUN {{ $datatahun }}      </div>

<div class="catatan">Catatan : Laporan Bulanan tidak menghitung skor hanya menghitung pegawai yang melakukan absen masuk, absen pulang keterangan dan tanpa keterangan.</div>


<div class="penjelasan">Penjealsan Kode: <span class="hadir">HD : Hadir</span>  / <span class="keterangan">DK : Dengan Keterangan</span>   /  <span class="libur">LB : Libur</span> / <span class="tanpa">TK : Tanpa Keterangan</span> /  <span class="pulang">SP : Sudah Pulang</span></div>
        <table border="0" width="100%" class="table table-bordered">
    <tbody>
       <tr>
        <td>Pegawai</td>
		       @for ($i = 1; $i <= $daysInMonth; $i++)

@if($loggedAdmin->company->datashift==1)	
<?php
$carilibur = count(DB::select(DB::raw("SELECT * FROM liburshifts WHERE  DAY(date)=" . $i . " AND MONTH(date)=" . $databulan . "  AND YEAR(date)=" . $datatahun . " ")));

 ?>

@else
<?php
$carilibur = count(DB::select(DB::raw("SELECT * FROM holidays WHERE  DAY(date)=" . $i . " AND MONTH(date)=" . $databulan . "  AND YEAR(date)=" . $datatahun . " ")));

 ?>
@endif 
 
 @if ($carilibur =="1")
        <td><span style="color:#ff0000">{{ $i }}</span></td>
	@else
		  <td>{{ $i }}</td>
	@endif
	    @endfor
		  <td>HADIR</td>
		  <td>KET</td>
		  <td>TANPAKET</td>
	  </tr>
      <?php $totalstaff=0;    ?>
@foreach ($employeeAttendence as $attendance)
    @foreach ($attendance as $staff)
     <?php $totalstaff++;    ?>

	 
	 
	 
	 
		 <tr>
			  @if ($staff->statusmupeg == "ASN")    
      <td style="width:180px;background: #fdf6e6;">{{ $staff->full_name }}<div style="font-size: 11px;">NIP {{ $staff->employeeID }}</div></td>				  
				  @endif
      
	    @if ($staff->statusmupeg == "PHL")    
      <td style="width:180px;">{{ $staff->full_name }}</td>				  
				  @endif
               <?php
			   $totalPresentCount = 0; 
			   $totalPresentCountHADIR = 0; 
			   $jumlahharikerja = 0; 
			   $hitungcountcounthadir = 0; 
			   $hitungcountcountket = 0; 
			   $totalpulang = 0; 
?>
         @for ($i = 1; $i <= $daysInMonth; $i++)
			 
		 <?php
$today = $i;
switch($today){case '1':$datahari = '01';break;case '2':$datahari = '02';break;case '3':$datahari = '03';break;   	case '4':$datahari = '04';break;	case '5':$datahari = '05';break;	case '6':$datahari = '06';break;	case '7':$datahari = '07';break;	case '8':$datahari = '08';break;	case '9':$datahari = '09';break;	default:$datahari = $today;break;}
$bulan = $databulan;
switch($bulan){case '1':$bulanini = '01';break;case '2':$bulanini = '02';break;case '3':$bulanini = '03';break;   	case '4':$bulanini = '04';break;	case '5':$bulanini = '05';break;	case '6':$bulanini = '06';break;	case '7':$bulanini = '07';break;	case '8':$bulanini = '08';break;	case '9':$bulanini = '09';break;	default:$bulanini = $bulan;break;}



$date_create = $datatahun . '-' . $bulanini . '-'.$datahari;
 $pre_abs = '-';
 $pre_abs_pulang = '-';


 ?>
	 

@if($loggedAdmin->company->datashift==1)	
<?php
$carilibur_data = count(DB::select(DB::raw("SELECT * FROM liburshifts WHERE  DAY(date)=" . $datahari . " AND MONTH(date)=" . $databulan . "  AND YEAR(date)=" . $datatahun . " ")));

if ($carilibur_data =="1")  {

} else {
$jumlahharikerja++;

}
?>

@else
<?php
$carilibur_data = count(DB::select(DB::raw("SELECT * FROM holidays WHERE  DAY(date)=" . $datahari . " AND MONTH(date)=" . $databulan . "  AND YEAR(date)=" . $datatahun . " ")));

if ($carilibur_data =="1")  {

} else {
$jumlahharikerja++;

}
?>
@endif
 
                @foreach ($staff->attendance as $att)
 
                        <?php
                         $date_to_check = date('Y-m-d', strtotime($att->date));
                        ?>
     
						 
                        @if ($date_create == $date_to_check) 



@if($loggedAdmin->company->datashift==1)	
 <?php
$hitungcounthadir= count(DB::select(DB::raw("SELECT liburshifts.date FROM attendance LEFT JOIN liburshifts ON attendance.date = liburshifts.date WHERE attendance.status ='present' AND  liburshifts.date='".$date_to_check."'   AND attendance.employee_id=" . $att->employee_id)));
$hitungcountket = count(DB::select(DB::raw("SELECT liburshifts.date FROM attendance LEFT JOIN liburshifts ON attendance.date = liburshifts.date WHERE attendance.status ='absent' AND application_status ='approved' AND  liburshifts.date='".$date_to_check."'  AND attendance.employee_id=" . $att->employee_id)));

$hitungcountcounthadir += $hitungcounthadir;
$hitungcountcountket += $hitungcountket;

?>	

@else
 <?php
$hitungcounthadir= count(DB::select(DB::raw("SELECT holidays.date FROM attendance LEFT JOIN holidays ON attendance.date = holidays.date WHERE attendance.status ='present' AND  holidays.date='".$date_to_check."'   AND attendance.employee_id=" . $att->employee_id)));
$hitungcountket = count(DB::select(DB::raw("SELECT holidays.date FROM attendance LEFT JOIN holidays ON attendance.date = holidays.date WHERE attendance.status ='absent' AND application_status ='approved' AND  holidays.date='".$date_to_check."'  AND attendance.employee_id=" . $att->employee_id)));

$hitungcountcounthadir += $hitungcounthadir;
$hitungcountcountket += $hitungcountket;

?>	
@endif 

				 @if ($att->keluar != "00:00:00")
					<?php $pre_abs_pulang = 'SP';
						$totalpulang++;    
                            ?>
			  
						@endif		
						 @if ($att->status == "present")
		
                            <?php
                                $pre_abs = 'HD';
                                $totalPresentCountHADIR++;
                            ?>
						 @endif
						 
						 @if ($att->status == "absent")
							 <?php
                                $pre_abs = 'DK';
                                $totalPresentCount++;
                            ?>
                       @endif

  
					   @else
                       @endif
	
						

            
                @endforeach
			
@if ($carilibur_data =="1")		
<td style="padding:0px;"><div class="libur">LB</div></td>
@else
@if ($pre_abs == "HD")	
			<td><div class="hadir">{{ $pre_abs }} </div>
	
	@if ($pre_abs_pulang == "SP")	

	<div class="pulang" style="margin-top:1px;">{{ $pre_abs_pulang }} </div>
	</td>
@else
@endif	


@else
@if ($pre_abs == "DK")		
<td style="padding:0px;"><div class="keterangan">{{ $pre_abs }}</div></td>
@else
<td style="padding:0px;"><div class="tanpa">TK</div></td>
@endif



 @endif
@endif


            @endfor
	<?php $totalhadirdata = $totalPresentCountHADIR-$hitungcountcounthadir;
			$totalasbenket = $totalPresentCount-$hitungcountcountket;
			?>

		<td class="datatotal">{{ $totalhadirdata }}</td>
		<td class="datatotal">{{ $totalasbenket }}</td>
		
		<?php $totaltanpaket = $jumlahharikerja-$totalhadirdata-$totalasbenket; ?>
		<td class="datatotal">{{ $totaltanpaket }}</td>
		

        </tr>


	 
	 
	 
	 
	 
	 
	 
    @endforeach
@endforeach
@if ($totalstaff ==0)
 <tr>
<?php $totaldaysm = $daysInMonth+4; ?>
 <td style="text-align: center;
    font-size: 16px;
    
    padding: 10px;
    background: #fff1f1;
   " colspan="{{$totaldaysm}}">Tidak ada pegawai yang dapat di tampilkan</td>
   </tr>
@endif
    </tbody>
</table>


</div>
<style>
.table-bordered > tbody > tr > td, .table-bordered > tfoot > tr > th, .table-bordered > tfoot > tr > td {
    border: 1px solid #c2cad8;
	    color: #34495e;
		font-size: 12px;
}

.table-responsive {
    overflow-x: hidden;
    min-height: 0.01%;
}
</style>
<style>
.libur { 

    background: #670808;
    padding: 0px 5px;
    color: #fff;
    border-radius: 5px !important;
    
    text-align: center;
	font-size:11px;

}

.datatotal { 


    padding: 0px 5px;

    font-weight: 550;
    
    text-align: center;
	font-size:18px;

}

.keterangan { 

    background: #1066a0;
    padding: 0px 5px;
    color: #fff;
    border-radius: 5px !important;
    
    text-align: center;
	font-size:11px;
}

.hadir { 

    background: #189d12;
    padding: 0px 5px;
    color: #fff;
    border-radius: 5px !important;
    
    text-align: center;
		font-size:11px;

}

.tanpa { 

    background: #ff1313;
    padding: 0px 5px;
    color: #fff;
    border-radius: 5px !important;
    
    text-align: center;
		font-size:11px;

}

.pulang { 

    background: #7849da;
    padding: 0px 5px;
    color: #fff;
    border-radius: 5px !important;
    
    text-align: center;
		font-size:11px;

}
.catatan {
	    color: #ff0000;
    background: #e8e8e8;
    padding: 10px;
    border-radius: 5px !important;
    margin-bottom: 5px;
    font-size: 12px;
    font-weight: 550;
}

.penjelasan {
	background: #eef0eb;
    padding: 10px;
    border-radius: 5px !important;
    margin-bottom: 20px;
}
</style>
        
			
<textarea id="printing-css" style="display:none;">

    @page 
    {
        size:  A4 landscape;   /* auto is the initial value */
        margin: 10px 20px ;  /* this affects the margin in the printer settings */
		
    }

    html
    {
        background-color: #FFFFFF; 
        margin: 0px;  /* this affects the margin on the html before sending to printer */
    }

 
.table {
    font-family: sans-serif;
    color: #232323;
    border-collapse: collapse;
	font-size:10px;text-align:left;

}

.table, th, td {
    border: 1px solid #000;
    padding: 2px 2px;;

}
body {

    overflow-x: hidden;
}

.libur { 

    background: #670808;
    padding: 0px 5px;
    color: #fff;
    border-radius: 5px !important;
    
    text-align: center;
	font-size:11px;

}

.datatotal { 


    padding: 0px 5px;

    font-weight: 550;
    
    text-align: center;
	font-size:18px;

}

.keterangan { 

    background: #1066a0;
    padding: 0px 5px;
    color: #fff;
    border-radius: 5px !important;
    
    text-align: center;
	font-size:11px;
}

.hadir { 

    background: #189d12;
    padding: 0px 5px;
    color: #fff;
    border-radius: 5px !important;
    
    text-align: center;
		font-size:11px;

}

.tanpa { 

    background: #ff1313;
    padding: 0px 5px;
    color: #fff;
    border-radius: 5px !important;
    
    text-align: center;
		font-size:11px;

}

.pulang { 

    background: #7849da;
    padding: 0px 5px;
    color: #fff;
    border-radius: 5px !important;
    
    text-align: center;
		font-size:11px;

}
.catatan {
	    color: #ff0000;
    background: #e8e8e8;
    padding: 10px;
    border-radius: 5px !important;
    margin-bottom: 5px;
    font-size: 12px;
    font-weight: 550;
		width:100%;
}

.penjelasan {
	background: #eef0eb;
    padding: 10px;
    border-radius: 5px !important;
    margin-bottom: 10px;
	width:100%;
}

</textarea>
<iframe id="printing-frame" name="print_frame" src="about:blank" style="display:none;"></iframe>
<script type="text/javascript">
function printDiv(elementId) {
 var a = document.getElementById('printing-css').value;
 var b = document.getElementById(elementId).innerHTML;
 window.frames["print_frame"].document.title = document.title;
 window.frames["print_frame"].document.body.innerHTML = '<style>' + a + '</style>' + b;
 window.frames["print_frame"].window.focus();
 window.frames["print_frame"].window.print();
}
</script>