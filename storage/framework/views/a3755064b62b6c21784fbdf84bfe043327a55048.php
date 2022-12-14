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

						<div style="text-align: center;font-weight: bold;font-size: 25px;">	REKAPITULASI TAMBAHAN PENGHASILAN PEGAWAI   </div>
						<div class="comnames"><?php echo e($loggedAdmin->company->company_name); ?></div>
						<div class="comnames2">BULAN 
						<?php  switch ($databulan) { case '1':     echo 'JANUARI';     break; case '2':     echo 'FEBRUARI';     break; case '3':     echo 'MARET';     break; case '4':     echo 'APRIL';     break; case '5':     echo 'MEI';     break; case '6':     echo 'JUNI';     break; case '7':     echo 'JULI';     break; case '8':     echo 'AGUSTUS';     break; case '9':     echo 'SEPTEMBER';     break; 	case '10':     echo 'OKTOBER';     break; 	case '11':     echo 'NOVEMBER';     break; 		case '12':     echo 'DESEMBER';     break; 		default:     echo '';     break; } ?>
						TAHUN <?php echo e($datatahun); ?>      </div>

        <table border="0" width="100%" class="table table-bordered">
    <tbody>
<tr>
		<td rowspan="3" style="vertical-align:middle;">
			NO</td>
		<td rowspan="3" style="width:20%;vertical-align:middle;">
			NAMA PEGAWAI</td>
		<td colspan="3" style="vertical-align:middle;">
			HASIL PENGHASILAN BOBOT KINERJA		
			</td>
		<td colspan="3" style="vertical-align:middle;">
			PEMOTONGAN 		
</td>
		<td rowspan="2" style="vertical-align:middle;">
	TOTAL BOBOT

</td>
		<td rowspan="2" style="vertical-align:middle;">
		NILAI TPP

</td>

		<td rowspan="2" style="vertical-align:middle;">
		TAMBAHAN TPP

</td>
		<td rowspan="2" style="vertical-align:middle;">
		JUMLAH KOTOR

</td>

		<td rowspan="2" style="vertical-align:middle;">
		IWP 1% (RP)

</td>
		<td rowspan="2" style="vertical-align:middle;">
	PPh 21

</td>
		<td rowspan="2" style="vertical-align:middle;">
		JUMLAH BERSIH

</td>
		<td rowspan="3" style="vertical-align:middle;">
	<div class="noprint">AKSI EDIT</div>
	<div class="yeprint">	TANDA TANGAN</div>


</td>
	</tr>
	<tr>
		<td style="vertical-align:middle;">
			JUMLAH SKOR PRESTASI KEHADIRAN
</td>
		<td style="vertical-align:middle;">
		JUMLAH SKOR PRESTASI KERJA 
</td>
		<td style="vertical-align:middle;">
	TOTAL 
</td>
		<td style="vertical-align:middle;">
			PEMOTONGAN CUTI
</td>
		<td style="vertical-align:middle;">
		PEMOTONGAN HUKUMAN DISIPLIN
</td>
		<td style="vertical-align:middle;">
			TOTAL
</td>
	</tr>
	<tr>
		<td style="vertical-align:middle;">
		(%)
</td>
		<td style="vertical-align:middle;">
			(%)
</td>
		<td style="vertical-align:middle;">
		(%)
</td>
		<td style="vertical-align:middle;">
		(%)
</td>
		<td style="vertical-align:middle;">
		(%)</td>
		<td style="vertical-align:middle;">
		(%)</td>
				<td style="vertical-align:middle;">
		(%)</td>
				<td style="vertical-align:middle;">
		(Rp)</td>
					<td style="vertical-align:middle;">
		(Rp)</td>
				<td style="vertical-align:middle;">
		(Rp)</td>	<td style="vertical-align:middle;">
		(Rp)</td>
				<td style="vertical-align:middle;">
		(%)</td>
				<td style="vertical-align:middle;">
		(Rp)</td>
		
	</tr>
	<tr>
		<td>
		1
</td>
		<td>
			2</td>
		<td>
	3</td>
		<td>
	4</td>
		<td>
		5=3+4
</td>
		<td>
		6
</td>
		<td>
	7</td>
		<td>
		8=6+7)
</td>
		<td>
	9=5-8)
</td>
		<td>
			10</td>
			
					<td>
			11</td>
		<td>
		12=9x10+11
		</td>	
		<td>
		13=(1/100)*(10+11)
		</td>
		<td>
		14
</td>
		<td>
	15=12-13-14
</td>
		<td>
			16</td>
	</tr>
<?php
$tambahan_tpp_total = 0;
$jumlah_kotor_total = 0;
$nilai_pajak_total = 0;
$jumlah_iwp_total = 0;
$jumlah_bersih_total = 0;
?>

<?php $__currentLoopData = $employeeAttendence; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $payrolls): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<?php
$caricount = count(DB::select(DB::raw("SELECT * FROM payrolls WHERE  month='".$databulan."' AND year='".$datatahun."'   AND company_id='".$idinas."' AND employee_id='".$payrolls->idpegawai."' ")));
 ?>
 
<tr>
<td style=" vertical-align: middle; "><?php echo e($key + 1); ?></td>
<td style="  padding: 10px;  text-align: left;vertical-align: middle;"><b><?php echo e($payrolls->full_name); ?><br></b><?php echo e($payrolls->employeeID); ?></td>	
 <?php if($caricount =="0"): ?>	
<td colspan="13" style="background: #fbf7f7;text-align: center;">BELUM ADA REKAP PADA BULAN <?php echo e($databulan); ?> TAHUN <?php echo e($datatahun); ?></td>	
<?php if($loggedAdmin->company->datashift==1): ?>
<?php if($payrolls->datashift ==1): ?>	
<td style=" vertical-align: middle; "><div class="noprint"><a style="width:100%" href="shitkinerjas/create" class="btn btn-danger btn-sm" >Tambah</a></div></td>
<?php else: ?>
<td style=" vertical-align: middle; "><div class="noprint"><a style="width:100%" href="payrolls/create" class="btn btn-danger btn-sm" >Tambah</a></div></td>
	
<?php endif; ?>

<?php else: ?>

<td style=" vertical-align: middle; "><div class="noprint"><a style="width:100%" href="payrolls/create" class="btn btn-danger btn-sm" >Tambah</a></div></td>

<?php endif; ?>
<?php else: ?>

<td style=" vertical-align: middle; "><?php echo e($payrolls->jumlah_prestasi_kehadiran); ?></td>
<td style=" vertical-align: middle; "><?php echo e($payrolls->jumlah_prestasi_kinerja); ?></td>
<td style=" vertical-align: middle; "><?php echo e($payrolls->total_prestasi_kinerja); ?></td>
<td style=" vertical-align: middle; "><?php echo e($payrolls->pemotongan_cuti_kinerja); ?></td>
<td style=" vertical-align: middle; "><?php echo e($payrolls->pemotongan_hukuman_kinerja); ?></td>
<td style=" vertical-align: middle; "><?php echo e($payrolls->total_pemotongan_kinerja); ?></td>
<td style=" vertical-align: middle; "><?php echo e($payrolls->total_bobot_kinerja); ?></td>
<td style=" vertical-align: middle; ">
<?php
$number0 = $payrolls->nilai_tpp_kinerja;
$nilai_tpp_kinerja = number_format ($number0, 0, ',', '.');
?>

<?php echo e($nilai_tpp_kinerja); ?></td>
<td style=" vertical-align: middle; ">
<?php
$number1 = $payrolls->tambahan_tpp_rp;
$tambahan_tpp_rp = number_format ($number1, 0, ',', '.');
$tambahan_tpp_total += $payrolls->tambahan_tpp_rp;
?>
<?php echo e($tambahan_tpp_rp); ?>

</td>			
<td style=" vertical-align: middle; ">
<?php
$number2 = $payrolls->jumlah_kotor_kinerja;
$jumlah_kotor_kinerja = number_format ($number2, 0, ',', '.');
$jumlah_kotor_total += $payrolls->jumlah_kotor_kinerja;
?>

<?php echo e($jumlah_kotor_kinerja); ?>

</td>	
<td style=" vertical-align: middle; ">
<?php
$number3 = $payrolls->nilai_pajak_kinerja;
$nilai_pajak_kinerja = number_format ($number3, 0, ',', '.');
$nilai_pajak_total += $payrolls->nilai_pajak_kinerja;
?>

<?php echo e($nilai_pajak_kinerja); ?>

</td>	
<td style=" vertical-align: middle; ">
<?php
$number3 = $payrolls->jumlah_iwp;
$jumlah_iwp = number_format ($number3, 0, ',', '.');
$jumlah_iwp_total += $payrolls->jumlah_iwp;
?>

<?php echo e($jumlah_iwp); ?>

</td>
<td style=" vertical-align: middle; ">
<?php
$number3 = $payrolls->jumlah_bersih_keseluruhan;
$jumlah_bersih_keseluruhan = number_format ($number3, 0, ',', '.');
$jumlah_bersih_total += $payrolls->jumlah_bersih_keseluruhan;
?>

<?php echo e($jumlah_bersih_keseluruhan); ?></td>

<?php if($loggedAdmin->company->datashift==1): ?>
<?php if($payrolls->datashift ==1): ?>	
<td style=" vertical-align: middle; "><div class="noprint"><a style="width:100%" href="shitkinerjas/<?php echo e($payrolls->idpay); ?>/edit" class="btn btn-success btn-sm" >Edit</a></div></td>
<?php else: ?>
<td style=" vertical-align: middle; "><div class="noprint"><a style="width:100%" href="payrolls/<?php echo e($payrolls->idpay); ?>/edit" class="btn btn-success btn-sm" >Edit</a></div></td>
	
<?php endif; ?>

<?php else: ?>

<td style=" vertical-align: middle; "><div class="noprint"><a style="width:100%" href="payrolls/<?php echo e($payrolls->idpay); ?>/edit" class="btn btn-success btn-sm" >Edit</a></div></td>


<?php endif; ?>

<?php endif; ?>			
</tr>




 
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php
$caricountdata = count(DB::select(DB::raw("SELECT * FROM payrolls WHERE  month='".$databulan."' AND year='".$datatahun."'   AND company_id='".$idinas."' AND pay_date !='0000-00-00'  ")));
 ?>
<?php if($caricountdata == 0): ?>
<tr style="background: #f5dede;font-size:15px;">
<td colspan="16" style="  padding: 10px;  text-align: center;vertical-align: middle;"><b>JUMLAH KESELURUHAN TIDAK DI TEMUKAN</b></td>
</tr>	
<?php else: ?>
<tr style="background:green;font-size:15px;">
<td colspan="10" style="  padding: 10px; color: #fff; text-align: center;vertical-align: middle;"><b>JUMLAH KESELURUHAN</b></td>
<td style=" vertical-align: middle;font-weight:bold;color: #fff;  ">
<?php
$total1 = $tambahan_tpp_total;
$tambahan_tpp_total_rp = number_format ($total1, 0, ',', '.');

?>
<?php echo e($tambahan_tpp_total_rp); ?></td>
<td style=" vertical-align: middle;font-weight:bold;color: #fff;  ">
<?php
$total2 = $jumlah_kotor_total;
$jumlah_kotor_total_rp = number_format ($total2, 0, ',', '.');

?>

<?php echo e($jumlah_kotor_total_rp); ?></td>
<td style=" vertical-align: middle;font-weight:bold;color: #fff;  ">
<?php
$total3 = $nilai_pajak_total;
$nilai_pajak_total_rp = number_format ($total3, 0, ',', '.');

?>
<?php echo e($nilai_pajak_total_rp); ?></td>
<td style=" vertical-align: middle;font-weight:bold;color: #fff;  ">
<?php
$total4 = $jumlah_iwp_total;
$jumlah_iwp_total_rp = number_format ($total4, 0, ',', '.');

?>
<?php echo e($jumlah_iwp_total_rp); ?></td>
<td style=" vertical-align: middle;font-weight:bold;color: #fff;  ">
<?php
$total5 = $jumlah_bersih_total;
$jumlah_bersih_total_rp = number_format ($total5, 0, ',', '.');

?>

<?php echo e($jumlah_bersih_total_rp); ?></td>
<td style=" vertical-align: middle; ">


	-
</td>
					
	</tr>

<?php endif; ?>	
	
    </tbody>
</table>



<?php
$countkepala = count(DB::select(DB::raw("SELECT * FROM datapemimpins WHERE  company_id='".$idinas."' AND namajabatan ='Kepala OPD'  ")));
$countkepalanojab = count(DB::select(DB::raw("SELECT * FROM datapemimpins WHERE  company_id='".$idinas."' AND idpemimpin ='0' AND namajabatan ='Kepala OPD'  ")));
$countbendahara = count(DB::select(DB::raw("SELECT * FROM datapemimpins WHERE  company_id='".$idinas."' AND namajabatan ='Bendahara'  ")));
$countbendaharanojab = count(DB::select(DB::raw("SELECT * FROM datapemimpins WHERE  company_id='".$idinas."' AND namajabatan ='Bendahara' AND idpemimpin ='0'  ")));
 ?>


<div class="yeprint">
<table style="width:100%;text-align:center;font-size:13px;margin-top:70px;">
  <tr>


  </tr>
  <tr >
    <td style="vertical-align:middle;padding:0px 50px; text-transform: uppercase;border:0px;">
	<div style=" text-transform: uppercase;margin-bottom:70px;">
<?php if($countkepala == 1 ): ?>	
<?php if($countkepalanojab == 1 ): ?>	
KEPALA 	
<?php else: ?> 

<?php echo e($kepaladinas->jabatan); ?> 
<?php endif; ?>
<?php else: ?> 
KEPALA
<?php endif; ?>
</div>
	
<?php if($countkepala == 1 ): ?>	
<?php if($countkepalanojab == 1 ): ?>
....................................<div style="font-size:13px;">NIP....................................</div>	
<?php else: ?>  
	
<?php echo e($kepaladinas->full_name); ?><div style="font-size:13px;">NIP: <?php echo e($kepaladinas->employeeID); ?> </div>
<?php endif; ?>
<?php else: ?>  
....................................<div style="font-size:13px;">NIP....................................</div>	
<?php endif; ?>
	</td>
	
    <td  style="vertical-align:middle;padding:0px 50px; text-transform: uppercase;border:0px;"><div style=" text-transform: uppercase;margin-bottom:70px;">BENDAHARA PENGELUARAN</div>
<?php if($countbendahara == 1 ): ?> 
<?php if($countbendaharanojab == 1 ): ?>	
	....................................<div style="font-size:13px;">NIP....................................</div>
<?php else: ?> 
<?php echo e($bendahara->full_name); ?> <div style="font-size:13px;">NIP: <?php echo e($bendahara->employeeID); ?></div></td>
<?php endif; ?>
<?php else: ?>  
	....................................<div style="font-size:13px;">NIP....................................</div>	
<?php endif; ?>
  </tr>

</table>
</div>



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

  .noprint {
display:block;
  }  
  .yeprint {
display:none;
  }
 .comnames{
text-align: center;font-weight: bold;font-size: 20px;text-transform: uppercase;margin-top: -5px;	 
	 
 }
 
  .comnames2{
text-align: center;font-weight: bold;font-size: 15px;text-transform: uppercase;margin-top: -5px;margin-bottom:20px; 
 }
</style>
<textarea id="printing-css" style="display:none;">
 .comnames{
text-align: center;font-weight: bold;font-size: 20px;text-transform: uppercase;margin-top: 0px;	 
	 
 }
   .comnames2{
text-align: center;font-weight: bold;font-size: 15px;text-transform: uppercase;margin-top: 0px;margin-bottom:20px; 
 }
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
  .noprint {
display:none;
  }
  
    .yeprint {
display:block;
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
</script><?php /**PATH C:\xampp\htdocs\newabsen\resources\views/admin/printrekap/load.blade.php ENDPATH**/ ?>