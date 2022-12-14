<div id="updateCell<?php echo e($row->employeeID); ?>">
<?php if($row->date == null): ?>
  -
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
<?php echo $__env->make('admin.attendances.col4_periode_jumat', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php else: ?>
<?php echo $__env->make('admin.attendances.col4_periode', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>	
<?php endif; ?>
<!-- ELSE PERIODE --> <?php else: ?>
	<?php if($tampilkanhari == "friday"): ?>
<?php echo $__env->make('admin.attendances.col4_normal_jumat', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php else: ?>
<?php echo $__env->make('admin.attendances.col4_normal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>	
<?php endif; ?>	

<!-- END PERIODE --> <?php endif; ?>
				
<?php else: ?>
-
<?php endif; ?>
















<?php endif; ?>

</div>

<?php /**PATH C:\xampp\htdocs\newabsen\resources\views/admin/laporanphl/col4.blade.php ENDPATH**/ ?>