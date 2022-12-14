<?php if($row->date == null): ?>
    <span class="label label-danger">Belum Absen</span>
<?php else: ?>
<?php if($row->status == "present"): ?>
	
<?php
$date_jumat = $row->tanggalabsen;
$timestamp = strtotime($date_jumat);
$carihari= date("l", $timestamp );
$tampilkanhari = strtolower($carihari);
?>



<!-- STAR PERIODE --> <?php if($row->tanggalperiode ==  $row->tanggalabsen): ?>

<?php if($tampilkanhari == "friday"): ?>
<?php echo $__env->make('admin.dataapel.col2_periode_jumat', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php else: ?>
<?php echo $__env->make('admin.dataapel.col2_periode', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>	
<?php endif; ?>
<!-- ELSE PERIODE --> <?php else: ?>
		
<?php if($tampilkanhari == "friday"): ?>
<?php echo $__env->make('admin.dataapel.col2_normal_jumat', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php else: ?>
<?php echo $__env->make('admin.dataapel.col2_normal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>	

<?php endif; ?>
<!-- END PERIODE --> <?php endif; ?>
				





<?php else: ?>
	

<?php if($row->status == "absent"): ?>
<span class="label label-success"><?php echo e($row->keterangan); ?> (<?php echo e($row->singkatan); ?>)</span>
<?php else: ?>
    <span class="label label-danger">Belum Absen</span>
<?php endif; ?>



<?php endif; ?>



<?php endif; ?><?php /**PATH C:\xampp\htdocs\newabsen\resources\views/admin/dataapel/col2.blade.php ENDPATH**/ ?>