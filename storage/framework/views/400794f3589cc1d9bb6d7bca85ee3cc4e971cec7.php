<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
        <h4 class="modal-title"><strong><i
                        class="fa fa-edit"></i> <?php echo e(trans('core.editDepartment')); ?></strong></h4>
    </div>
    <div class="modal-body">

        <?php echo Form::open(['method' => 'PATCH', 'url' => '','class'=>'horizontal-form ajax_form','id'=>'edit_form']); ?>

        <div id="error_edit"></div>
        <div class="form-body">
            <div class="form-group">
                <label class="control-label"><?php echo e(trans('core.department')); ?></label>
                <input class="form-control" name="name" id="edit_name" type="text"
                       value="<?php echo e($department->name); ?>" placeholder="<?php echo e(trans('core.department')); ?>"/>

            </div>

            <div id="deptresponse"></div>
			                <label class="control-label"><?php echo e(trans('core.jabatannama')); ?></label>
							
							
            <?php $__currentLoopData = $department->designations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index=>$designation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="form-group" id="edit_field">
                    <div>
                        <input class="form-control designation form-control-inline input-medium"
                               name="designation[<?php echo e($index); ?>]"
                               value="<?php echo e($designation->designation); ?>"
                               type="text" placeholder="<?php echo e(trans('core.designation')); ?>"/>
                        <input type="hidden" name="designationID[<?php echo e($index); ?>]" value="<?php echo e($designation->id); ?>">
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <div id="insertBefore_edit"></div>
            <button type="button" onclick="addMoreEdit();"
                    class="btn btn-sm green form-control-inline">
                <?php echo e(trans('core.addMoreDesignation')); ?> <i class="fa fa-plus"></i>
            </button>
         
        </div>
        <!-- END FORM-->
    </div>
    <div class="modal-footer">
        <div class="form-actions">
            <button type="button" class="btn dark btn-outline"
                    data-dismiss="modal"><?php echo e(trans("core.btnCancel")); ?></button>
            <button type="button" id="edit_submit" onclick="updateSubmit(<?php echo e($department->id); ?>);return false;"
                    class="btn green"><i
                        class="fa fa-edit"></i> <?php echo e(trans('core.btnUpdate')); ?></button>
        </div>

    </div>
    <?php echo Form::close(); ?>

</div>
<?php /**PATH C:\xampp\htdocs\newabsen\resources\views/admin/departments/edit.blade.php ENDPATH**/ ?>