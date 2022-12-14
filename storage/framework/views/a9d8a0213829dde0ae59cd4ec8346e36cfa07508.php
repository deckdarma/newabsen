<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" onClick="refreshPage()"></button>
    <h4 class="modal-title">Lihat Keterangan</h4>
    </div>
    <div class="modal-body">
        <div class="portlet-body form">
            <div class="row">
                <label class="control-label col-md-3"><strong>Nama</strong></label>
                <div class="col-md-9">
                    <?php echo e($leave_application->employee->full_name); ?>

                </div>
            </div>
            <br>
            <div class="row">
                <label class="control-label col-md-3"><strong>Keterangan</strong></label>
                <div class="col-md-9">
       
				<?php $__currentLoopData = $leavetypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $idku): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<?php if($idku->singkat != $leave_application->leaveType ): ?>  <?php else: ?>
					<?php echo e($idku->leaveType); ?> (<?php echo e($idku->singkat); ?>)
				<?php endif; ?>
		
				
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
            <br>
            <div class="row">
                <label class="control-label col-md-3"><strong>Tanggal</strong></label>
                <div class="col-md-9">
                    <?php if(!isset($leave_application->end_date)): ?>
                        <?php echo date('d-M-Y',strtotime($leave_application->start_date)); ?>

                    <?php else: ?>
                        <?php echo date('d-M-Y',strtotime($leave_application->start_date)); ?> s/d <?php echo date('d-M-Y',strtotime($leave_application->end_date)); ?>

                    <?php endif; ?>
                </div>
            </div>

            <br>
            <div class="row">
                <label class="control-label col-md-3"><strong>Jumlah Hari</strong></label>
                <div class="col-md-9">
                    <?php echo e($leave_application->days); ?>

                </div>
            </div>
            <div class="row">
                <label class="control-label col-md-3"><strong>Alasan</strong></label>
                <div class="col-md-9">
                    <?php echo e($leave_application->reason); ?>

                </div>
            </div>
            <br>
            <div class="row">
                <label class="control-label col-md-3"><strong><?php echo app('translator')->get("core.appliedOn"); ?></strong></label>
                <div class="col-md-9">
                    <?php echo date('d-M-Y',strtotime($leave_application->applied_on)); ?>

                </div>
            </div>
            <br>
            <div class="row">
                <label class="control-label col-md-3"><strong><?php echo app('translator')->get("core.status"); ?></strong></label>
                <div class="col-md-9 text-uppercase">
                    <?php if($leave_application->application_status=='rejected'): ?>
                        <span class="label label-danger"><?php echo e(trans("core.".$leave_application->application_status)); ?></span>
                    <?php elseif($leave_application->application_status == 'approved'): ?>
                        <span class="label label-success"><?php echo e(trans("core.".$leave_application->application_status)); ?></span>
                    <?php elseif($leave_application->application_status == 'pending'): ?>
                        <span class="label label-info"><?php echo e(trans("core.".$leave_application->application_status)); ?></span>
                    <?php endif; ?>
                </div>
            </div>
            <br>


        </div>
    </div>
	        <?php if($leave_application->application_status=='pending'): ?>
    <div class="modal-footer">

            <div class="form-actions">
                <div class="row">
                    <div class="col-md-offset-3 col-md-9">
                        <input type="submit" name="application_status" data-loading-text="<?php echo app('translator')->get("core.updating"); ?>..." class="btn green" value="Terima" data-toggle="modal" href="#static_approve" onclick="show_approve(<?php echo e($leave_application->id); ?>);return false;">
          
                        <button type="button" data-dismiss="modal" onClick="refreshPage()" class="btn dark btn-outline"><?php echo e(trans("core.btnCancel")); ?></button>
                    </div>
                </div>
            </div>
     

    </div>
		<?php else: ?>
			
		    <div class="modal-footer">

            <div class="form-actions">
                <div class="row">
                    <div class="col-md-offset-3 col-md-9">
                   <button type="button" data-dismiss="modal" onClick="refreshPage()" class="btn dark btn-outline"><?php echo e(trans("core.btnCancel")); ?></button>
                    </div>
                </div>
            </div>
     

    </div>
	   <?php endif; ?>
</div>

<?php /**PATH C:\xampp\htdocs\newabsen\resources\views/admin/leave_applications/show.blade.php ENDPATH**/ ?>