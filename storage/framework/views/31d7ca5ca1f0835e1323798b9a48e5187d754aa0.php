<?php if($tampilkanhari == "friday"): ?>


<?php if($carilibur !="1"): ?>  
  <?php if($status !="absent"): ?>

<?php if($totalStatusCount != "0"): ?>
		<?php if($status4 !=  "1"): ?>	
<td style="background: #229517;text-align: center;color: #fff;">Normal Jumat</td>


		

<td><span class="label  label-<?php echo e($status4); ?>"><?php echo e($status4); ?> (<?php echo e($masuk); ?>) </span>  </td>




<?php if($pulang != "00:00:00"): ?>
<?php if(( strtotime($pulang) >=  strtotime($jam_pulang_normal_jumat)) and (strtotime($pulang) <= strtotime($jam_akhir_pulang_normal_jumat))): ?>	
<td><center><span class="label label-success">Pulang (<?php echo e($pulang); ?>)</span></center></td>

<?php else: ?>
<td style="color:#fff;text-align: center;background-color: #eb939a;"><span class="label label-danger">Pulang Cepat</span> <?php echo e($pulang); ?> </td>
<?php endif; ?>

<?php else: ?>
<td style="color:#fff;text-align: center;background-color: #eb939a;"><span class="label label-danger">Pulang Cepat</span></td>

<?php endif; ?>		


<?php if($pulang != "00:00:00"): ?>
<?php if(( strtotime($pulang) >=  strtotime($jam_pulang_normal_jumat)) and (strtotime($pulang) <= strtotime($jam_akhir_pulang_normal_jumat))): ?>	
<td><center><span class="label label-success"><?php echo e($jamkerjapeg); ?></span></center></td>

<?php else: ?>
<td style="text-align: center;background: #eeefe8;"><span class="label label-danger">0 jam, 0 menit </td>
<?php endif; ?>

<?php else: ?>
<td style="text-align: center;background: #eeefe8;"><span class="label label-danger">0 jam, 0 menit</span></td>
<?php endif; ?>


<?php if($apelpagi ==  "1"): ?>
<td style="color:#fff;text-align: center;background-color: #e07315;">Tidak Apel Pagi</td>
<?php else: ?>
<td style="color:#fff;text-align: center;background-color: #26c281;">&#10004;</td>
<?php endif; ?>

<?php if($apelsore ==  "1"): ?>
<td style="color:#fff;text-align: center;background-color: #e07315;">Tidak Apel Sore</td>
<?php else: ?>
<td style="color:#fff;text-align: center;background-color: #26c281;">&#10004;</td>
<?php endif; ?>

<?php else: ?>
<td colspan="6" style="background-color: #f00;color: #fff;text-align:center;">TANPA KETERANGAN YANG SAH</td>
<?php endif; ?>
<?php else: ?>
<td colspan="6" style="background-color: #f00;color: #fff;text-align:center;">TANPA KETERANGAN YANG SAH</td>
<?php endif; ?>
<?php else: ?>
<td colspan="6" style="text-align:center;background: #1280cf;color:#fff;"><?php echo e($namaketerangan); ?> (<?php echo e($leaveType); ?>)</td>
<?php endif; ?>	


	

<?php else: ?>
<td colspan="6" style="text-align:center;background: #4e1010;color:#fff;">HARI LIBUR / TIDAK ADA JAM KERJA</td>
<?php endif; ?>		



<?php else: ?>



<?php if($carilibur !="1"): ?>  
  <?php if($status !="absent"): ?>

<?php if($totalStatusCount != "0"): ?>
		<?php if($status4 !=  "1"): ?>	
<td style="background: #229517;text-align: center;color: #fff;">Normal</td>


		

<td><span class="label  label-<?php echo e($status4); ?>"> <?php echo e($status4); ?>  (<?php echo e($masuk); ?>)</span>  </td>




<?php if($pulang != "00:00:00"): ?>
<?php if(( strtotime($pulang) >=  strtotime($jam_pulang_normal)) and (strtotime($pulang) <= strtotime($jam_akhir_pulang_normal))): ?>	
<td><center><span class="label label-success">Pulang (<?php echo e($pulang); ?>)</span></center></td>

<?php else: ?>
<td style="color:#fff;text-align: center;background-color: #eb939a;"><span class="label label-danger">Pulang Cepat</span> <?php echo e($pulang); ?> </td>
<?php endif; ?>

<?php else: ?>
<td style="color:#fff;text-align: center;background-color: #eb939a;"><span class="label label-danger">Pulang Cepat</span></td>

<?php endif; ?>		


<?php if($pulang != "00:00:00"): ?>
<?php if(( strtotime($pulang) >=  strtotime($jam_pulang_normal)) and (strtotime($pulang) <= strtotime($jam_akhir_pulang_normal))): ?>	
<td><center><span class="label label-success"><?php echo e($jamkerjapeg); ?></span></center></td>

<?php else: ?>
<td style="text-align: center;background: #eeefe8;"><span class="label label-danger">0 jam, 0 menit </td>
<?php endif; ?>

<?php else: ?>
<td style="text-align: center;background: #eeefe8;"><span class="label label-danger">0 jam, 0 menit</span></td>
<?php endif; ?>


<?php if($apelpagi ==  "1"): ?>
<td style="color:#fff;text-align: center;background-color: #e07315;">Tidak Apel Pagi</td>
<?php else: ?>
<td style="color:#fff;text-align: center;background-color: #26c281;">&#10004;</td>
<?php endif; ?>

<?php if($apelsore ==  "1"): ?>
<td style="color:#fff;text-align: center;background-color: #e07315;">Tidak Apel Sore</td>
<?php else: ?>
<td style="color:#fff;text-align: center;background-color: #26c281;">&#10004;</td>
<?php endif; ?>

<?php else: ?>
<td colspan="6" style="background-color: #f00;color: #fff;text-align:center;">TANPA KETERANGAN YANG SAH</td>
<?php endif; ?>
<?php else: ?>
<td colspan="6" style="background-color: #f00;color: #fff;text-align:center;">TANPA KETERANGAN YANG SAH</td>
<?php endif; ?>
<?php else: ?>
<td colspan="6" style="text-align:center;background: #1280cf;color:#fff;"><?php echo e($namaketerangan); ?> (<?php echo e($leaveType); ?>)</td>
<?php endif; ?>	


	

<?php else: ?>
<td colspan="6" style="text-align:center;background: #4e1010;color:#fff;">HARI LIBUR / TIDAK ADA JAM KERJA</td>
<?php endif; ?>		

<?php endif; ?><?php /**PATH C:\xampp\htdocs\newabsen\resources\views/admin/laporanpegawai/data_normal.blade.php ENDPATH**/ ?>