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
						<div style="text-align: center;font-weight: bold;font-size: 20px;text-transform: uppercase;margin-top: -5px;"><?php echo e($loggedAdmin->company->company_name); ?> </div>
						<div style="text-align: center;font-weight: bold;font-size: 15px;text-transform: uppercase;margin-top: 0px;margin-bottom:20px;">BULAN 
						<?php  switch ($databulan) { case '1':     echo 'JANUARI';     break; case '2':     echo 'FEBRUARI';     break; case '3':     echo 'MARET';     break; case '4':     echo 'APRIL';     break; case '5':     echo 'MEI';     break; case '6':     echo 'JUNI';     break; case '7':     echo 'JULI';     break; case '8':     echo 'AGUSTUS';     break; case '9':     echo 'SEPTEMBER';     break; 	case '10':     echo 'OKTOBER';     break; 	case '11':     echo 'NOVEMBER';     break; 		case '12':     echo 'DESEMBER';     break; 		default:     echo '';     break; } ?>
						TAHUN <?php echo e($datatahun); ?>      </div>

<div class="catatan">Catatan : Laporan Bulanan tidak menghitung skor hanya menghitung pegawai yang melakukan absen masuk, absen pulang keterangan dan tanpa keterangan.</div>


<div class="penjelasan">Penjealsan Kode: <span class="hadir">HD : Hadir</span>  / <span class="keterangan">DK : Dengan Keterangan</span>   /  <span class="libur">LB : Libur</span> / <span class="tanpa">TK : Tanpa Keterangan</span> /  <span class="pulang">SP : Sudah Pulang</span></div>
        <table border="0" width="100%" class="table table-bordered">
    <tbody>
       <tr>
        <td>Pegawai</td>
		       <?php for($i = 1; $i <= $daysInMonth; $i++): ?>

<?php if($loggedAdmin->company->datashift==1): ?>	
<?php
$carilibur = count(DB::select(DB::raw("SELECT * FROM liburshifts WHERE  DAY(date)=" . $i . " AND MONTH(date)=" . $databulan . "  AND YEAR(date)=" . $datatahun . " ")));

 ?>

<?php else: ?>
<?php
$carilibur = count(DB::select(DB::raw("SELECT * FROM holidays WHERE  DAY(date)=" . $i . " AND MONTH(date)=" . $databulan . "  AND YEAR(date)=" . $datatahun . " ")));

 ?>
<?php endif; ?> 
 
 <?php if($carilibur =="1"): ?>
        <td><span style="color:#ff0000"><?php echo e($i); ?></span></td>
	<?php else: ?>
		  <td><?php echo e($i); ?></td>
	<?php endif; ?>
	    <?php endfor; ?>
		  <td>HADIR</td>
		  <td>KET</td>
		  <td>TANPAKET</td>
	  </tr>
      <?php $totalstaff=0;    ?>
<?php $__currentLoopData = $employeeAttendence; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attendance): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php $__currentLoopData = $attendance; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $staff): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
     <?php $totalstaff++;    ?>

	 
	 
	 
	 
		 <tr>
			  <?php if($staff->statusmupeg == "ASN"): ?>    
      <td style="width:180px;background: #fdf6e6;"><?php echo e($staff->full_name); ?><div style="font-size: 11px;">NIP <?php echo e($staff->employeeID); ?></div></td>				  
				  <?php endif; ?>
      
	    <?php if($staff->statusmupeg == "PHL"): ?>    
      <td style="width:180px;"><?php echo e($staff->full_name); ?></td>				  
				  <?php endif; ?>
               <?php
			   $totalPresentCount = 0; 
			   $totalPresentCountHADIR = 0; 
			   $jumlahharikerja = 0; 
			   $hitungcountcounthadir = 0; 
			   $hitungcountcountket = 0; 
			   $totalpulang = 0; 
?>
         <?php for($i = 1; $i <= $daysInMonth; $i++): ?>
			 
		 <?php
$today = $i;
switch($today){case '1':$datahari = '01';break;case '2':$datahari = '02';break;case '3':$datahari = '03';break;   	case '4':$datahari = '04';break;	case '5':$datahari = '05';break;	case '6':$datahari = '06';break;	case '7':$datahari = '07';break;	case '8':$datahari = '08';break;	case '9':$datahari = '09';break;	default:$datahari = $today;break;}
$bulan = $databulan;
switch($bulan){case '1':$bulanini = '01';break;case '2':$bulanini = '02';break;case '3':$bulanini = '03';break;   	case '4':$bulanini = '04';break;	case '5':$bulanini = '05';break;	case '6':$bulanini = '06';break;	case '7':$bulanini = '07';break;	case '8':$bulanini = '08';break;	case '9':$bulanini = '09';break;	default:$bulanini = $bulan;break;}



$date_create = $datatahun . '-' . $bulanini . '-'.$datahari;
 $pre_abs = '-';
 $pre_abs_pulang = '-';


 ?>
	 

<?php if($loggedAdmin->company->datashift==1): ?>	
<?php
$carilibur_data = count(DB::select(DB::raw("SELECT * FROM liburshifts WHERE  DAY(date)=" . $datahari . " AND MONTH(date)=" . $databulan . "  AND YEAR(date)=" . $datatahun . " ")));

if ($carilibur_data =="1")  {

} else {
$jumlahharikerja++;

}
?>

<?php else: ?>
<?php
$carilibur_data = count(DB::select(DB::raw("SELECT * FROM holidays WHERE  DAY(date)=" . $datahari . " AND MONTH(date)=" . $databulan . "  AND YEAR(date)=" . $datatahun . " ")));

if ($carilibur_data =="1")  {

} else {
$jumlahharikerja++;

}
?>
<?php endif; ?>
 
                <?php $__currentLoopData = $staff->attendance; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $att): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
 
                        <?php
                         $date_to_check = date('Y-m-d', strtotime($att->date));
                        ?>
     
						 
                        <?php if($date_create == $date_to_check): ?> 



<?php if($loggedAdmin->company->datashift==1): ?>	
 <?php
$hitungcounthadir= count(DB::select(DB::raw("SELECT liburshifts.date FROM attendance LEFT JOIN liburshifts ON attendance.date = liburshifts.date WHERE attendance.status ='present' AND  liburshifts.date='".$date_to_check."'   AND attendance.employee_id=" . $att->employee_id)));
$hitungcountket = count(DB::select(DB::raw("SELECT liburshifts.date FROM attendance LEFT JOIN liburshifts ON attendance.date = liburshifts.date WHERE attendance.status ='absent' AND application_status ='approved' AND  liburshifts.date='".$date_to_check."'  AND attendance.employee_id=" . $att->employee_id)));

$hitungcountcounthadir += $hitungcounthadir;
$hitungcountcountket += $hitungcountket;

?>	

<?php else: ?>
 <?php
$hitungcounthadir= count(DB::select(DB::raw("SELECT holidays.date FROM attendance LEFT JOIN holidays ON attendance.date = holidays.date WHERE attendance.status ='present' AND  holidays.date='".$date_to_check."'   AND attendance.employee_id=" . $att->employee_id)));
$hitungcountket = count(DB::select(DB::raw("SELECT holidays.date FROM attendance LEFT JOIN holidays ON attendance.date = holidays.date WHERE attendance.status ='absent' AND application_status ='approved' AND  holidays.date='".$date_to_check."'  AND attendance.employee_id=" . $att->employee_id)));

$hitungcountcounthadir += $hitungcounthadir;
$hitungcountcountket += $hitungcountket;

?>	
<?php endif; ?> 

				 <?php if($att->keluar != "00:00:00"): ?>
					<?php $pre_abs_pulang = 'SP';
						$totalpulang++;    
                            ?>
			  
						<?php endif; ?>		
						 <?php if($att->status == "present"): ?>
		
                            <?php
                                $pre_abs = 'HD';
                                $totalPresentCountHADIR++;
                            ?>
						 <?php endif; ?>
						 
						 <?php if($att->status == "absent"): ?>
							 <?php
                                $pre_abs = 'DK';
                                $totalPresentCount++;
                            ?>
                       <?php endif; ?>

  
					   <?php else: ?>
                       <?php endif; ?>
	
						

            
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			
<?php if($carilibur_data =="1"): ?>		
<td style="padding:0px;"><div class="libur">LB</div></td>
<?php else: ?>
<?php if($pre_abs == "HD"): ?>	
			<td><div class="hadir"><?php echo e($pre_abs); ?> </div>
	
	<?php if($pre_abs_pulang == "SP"): ?>	

	<div class="pulang" style="margin-top:1px;"><?php echo e($pre_abs_pulang); ?> </div>
	</td>
<?php else: ?>
<?php endif; ?>	


<?php else: ?>
<?php if($pre_abs == "DK"): ?>		
<td style="padding:0px;"><div class="keterangan"><?php echo e($pre_abs); ?></div></td>
<?php else: ?>
<td style="padding:0px;"><div class="tanpa">TK</div></td>
<?php endif; ?>



 <?php endif; ?>
<?php endif; ?>


            <?php endfor; ?>
	<?php $totalhadirdata = $totalPresentCountHADIR-$hitungcountcounthadir;
			$totalasbenket = $totalPresentCount-$hitungcountcountket;
			?>

		<td class="datatotal"><?php echo e($totalhadirdata); ?></td>
		<td class="datatotal"><?php echo e($totalasbenket); ?></td>
		
		<?php $totaltanpaket = $jumlahharikerja-$totalhadirdata-$totalasbenket; ?>
		<td class="datatotal"><?php echo e($totaltanpaket); ?></td>
		

        </tr>


	 
	 
	 
	 
	 
	 
	 
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php if($totalstaff ==0): ?>
 <tr>
<?php $totaldaysm = $daysInMonth+4; ?>
 <td style="text-align: center;
    font-size: 16px;
    
    padding: 10px;
    background: #fff1f1;
   " colspan="<?php echo e($totaldaysm); ?>">Tidak ada pegawai yang dapat di tampilkan</td>
   </tr>
<?php endif; ?>
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
</script><?php /**PATH C:\xampp\htdocs\newabsen\resources\views/admin/attendances/load.blade.php ENDPATH**/ ?>