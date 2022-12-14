<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
        <h4 class="modal-title"><strong><i
                        class="fa fa-plus"></i> <?php echo e(trans('core.newDepartment')); ?>

            </strong></h4>
    </div>
    <?php echo Form::open(array('class'=>'horizontal-form ajax_form','method'=>'POST','id'=>'add_form')); ?>

    <div class="modal-body">

        <div class="form-body">
            <div class="form-group">
                <div>
                    <label class="control-label"><?php echo e(trans('core.department')); ?></label>
                    <input class="form-control" name="name" type="text" value=""
                           placeholder=""/>
                </div>
            </div>

            <div class="form-group">
                <div>
                    <label class="control-label"><?php echo e(trans('core.designations')); ?></label>
                    <input class="form-control input-medium designation"
                           name="designation[0]" type="text" value=""
                           placeholder="<?php echo e(trans('core.designation')); ?> #1"/>
                </div>
            </div>
            <div id="insertBefore"></div>
            <div class="form-group">
                <button type="button" id="plusButton" onclick="addMore();return false;" class="btn btn-sm green form-control-inline">
                    <?php echo e(trans('core.addMoreDesignation')); ?> <i class="fa fa-plus"></i>
                </button>
            </div>

        </div>

        <!-- END FORM-->
    </div>
    <div class="modal-footer">
        <div class="form-actions">
            <button type="button" class="btn dark btn-outline"
                    data-dismiss="modal"><?php echo e(trans("core.btnCancel")); ?></button>
            <button type="button" id="submitbutton_add"
                    class="btn green" onclick="addSubmit();return false;"><i
                        class="fa fa-check"></i> <?php echo e(trans('core.btnSubmit')); ?></button>
        </div>
    </div>
<?php echo Form::close(); ?>


<!-- END EXAMPLE TABLE PORTLET-->
</div>

<?php /**PATH C:\xampp\htdocs\newabsen\resources\views/admin/departments/create.blade.php ENDPATH**/ ?>