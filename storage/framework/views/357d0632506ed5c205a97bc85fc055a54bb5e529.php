<?php $__env->startSection('head'); ?>
    <!-- BEGIN PAGE LEVEL STYLES -->
    <?php echo HTML::style("assets/global/plugins/select2/css/select2.css"); ?>

    <?php echo HTML::style("assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css"); ?>

    <!-- END PAGE LEVEL STYLES -->

<?php $__env->stopSection(); ?>


<?php $__env->startSection('mainarea'); ?>
    <div class="page-head">
        <!-- BEGIN PAGE HEADER-->
        <div class="page-head">
            <div class="page-title"><h1>
                    <?php echo e(trans('pages.departments.indexTitle')); ?>

                </h1></div>

        </div>
        <ul class="page-breadcrumb breadcrumb">
            <li>
                <a onclick="loadView('<?php echo e(route('admin.dashboard.index')); ?>')"><?php echo e(trans('core.dashboard')); ?></a>
                <i class="fa fa-circle"></i>
            </li>

            <li>
                <span class="active"><?php echo e(trans('core.departments')); ?></span>
            </li>

        </ul>

        <!-- END PAGE HEADER-->

        <div id="load">
            

            
        </div>

        <!-- BEGIN PAGE CONTENT-->
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet light bordered">
                    <div class="portlet-body">
                        <?php if($loggedAdmin->manager!=1): ?>
                            <div class="table-toolbar">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="btn-group">
                                            <a class="btn green" onclick="showAdd();">
                                                <?php echo e(trans('core.btnAddDepartment')); ?>

                                                <i class="fa fa-plus"></i> </a>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>
                                        <?php echo app('translator')->get('core.serialNo'); ?>
                                    </th>
                                    <th>
                                        <?php echo e(trans('core.departmentName')); ?>

                                    </th>
                                    <th>
                                        <?php echo e(trans('core.designations')); ?>

                                    </th>
                                    <?php if($loggedAdmin->manager!=1): ?>
                                        <th>
                                            <?php echo e(trans('core.actions')); ?>

                                        </th>
                                    <?php endif; ?>
                                </tr>
                                </thead>
                                <tbody>
                                
                                <?php $__empty_1 = true; $__currentLoopData = $departments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index=>$department): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr id="row<?php echo e($department->id); ?>">
                                        <td>
                                            <?php echo e($index+1); ?>

                                        </td>
                                        <td>
                                            <?php echo e($department->name); ?>


                                        </td>

                                        <td>
                                            <ol>
                                                <?php $__currentLoopData = $department->designations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $desig): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <li>   <?php echo e($desig->designation); ?></li>

                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </ol>
                                        </td>
                                        <?php if($loggedAdmin->manager!=1): ?>
                                            <td class=" ">
                                                <a class="btn purple btn-sm margin-bottom-10" data-toggle="modal"
                                                   href="#edit_static"
                                                   onclick="showEdit(<?php echo e($department->id); ?>,'<?php echo e(addslashes($department->name)); ?>')"><i
                                                            class="fa fa-edit"></i> <?php echo e(trans('core.btnViewEdit')); ?></a>

                                                <a class="btn red btn-sm margin-bottom-10" style="width: 94px"
                                                   href="javascript:;"
                                                   onclick="del(<?php echo e($department->id); ?>,'<?php echo e($department->name); ?>')"><i
                                                            class="fa fa-trash"></i> <?php echo e(trans('core.btnDelete')); ?></a>
                                            </td>
                                        <?php endif; ?>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <tr>
                                        <td colspan="4" class="text-center"> <?php echo app('translator')->get('messages.noDeptTable'); ?></td>
                                    </tr>
                                <?php endif; ?>
                                

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- END EXAMPLE TABLE PORTLET-->

            </div>
        </div>
        <!-- END PAGE CONTENT-->


        

    </div>

    


    
    <?php echo $__env->make('admin.common.delete', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('admin.common.show-modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    
<?php $__env->stopSection(); ?>



<?php $__env->startSection('footerjs'); ?>

    <script>


        function addMore() {
            var $insertBefore = $('#insertBefore');
            var $i = $('.designation').length;
            $('<div class="form-group"><div><input class="form-control input-medium designation"  name="designation[' + $i + ']" type="text"  placeholder="<?php echo e(trans('core.designation')); ?> #' + ($i + 1) + '"/></div></div>').insertBefore($insertBefore);
        }


        //-----EDIT Modal


        function addMoreEdit() {
            var $insertBefore_edit = $('#insertBefore_edit');
            var $j = $('.designation').length;
            $(' <div class="form-group" id="edit_field"><input class="form-control designation form-control-inline input-medium"  name="designation[' + $j + ']" type="text"  placeholder="<?php echo e(trans('core.designation')); ?> #' + ($j + 1) + '"/></div>').insertBefore($insertBefore_edit);
        };

        function del(id, dept) {

            $('#deleteModal').modal('show');
            $("#deleteModal").find('#info').html('<?php echo __('messages.departmentDeleteConfirm'); ?> <strong>' + dept + '</strong>?<br>' +
                '<br><div class="note note-warning">' +
                '<?php echo __('messages.deleteNoteDepartment'); ?>' +
                '</div>');

            $('#deleteModal').find("#delete").off().click(function () {
                var url = "<?php echo e(route('admin.departments.destroy',':id')); ?>";
                url = url.replace(':id', id);
                var token = "<?php echo e(csrf_token()); ?>";

                $.easyAjax({
                    type: 'DELETE',
                    url: url,
                    data: {'_token': token},
                    container: "#deleteModal",
                    success: function (response) {
                        if (response.status === "success") {
                            $('#deleteModal').modal('hide');
                            table.fnDraw();
                        }
                    }
                });
            })

        }

        

            
            
            
            

            
            

            
            

            

                
                

                

            
                
                
            

            
                
                

                
                    
                    
                    
                    
                    
                        
                            
                            
                            
                            
                            
                                
                                    
                                
                            

                            
                            
                        
                            
                            
                        

                    
                    

                    
                
            
        

        function showEdit(id,name) {
            var url = "<?php echo e(route('admin.departments.edit',':id')); ?>";
            url = url.replace(':id', id);
            $.ajaxModal('#showModal', url);

        }

        function showAdd() {
            var url = "<?php echo e(route('admin.departments.create')); ?>";
            $.ajaxModal('#showModal', url);
            var $insertBefore = $('#insertBefore');
            var $i = 0;

        }

        function addSubmit() {
            $.easyAjax({
                type: 'POST',
                url: "<?php echo e(route('admin.departments.store')); ?>",
                container: '.ajax_form',
                data: $('.ajax_form').serialize(),
                success: function (response) {
                    if (response.status === "success") {
                        $('#showModal').modal('hide');
                    }

                }
            });
        }

        function updateSubmit(id) {
            var url = "<?php echo e(route('admin.departments.update',':id')); ?>";
            url = url.replace(':id', id);
            $.easyAjax({
                type: 'POST',
                url: url,
                container: '.ajax_form',
                data: $('.ajax_form').serialize(),
                success: function (response) {
                    if (response.status === "success") {
                        $('#showModal').modal('hide');
                    }

                }
            });
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.adminlayouts.adminlayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\newabsen\resources\views/admin/departments/index.blade.php ENDPATH**/ ?>