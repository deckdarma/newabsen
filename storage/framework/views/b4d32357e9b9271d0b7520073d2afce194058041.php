<?php $__env->startSection('head'); ?>
    <!-- BEGIN PAGE LEVEL STYLES -->

    <?php echo HTML::style("assets/global/plugins/bootstrap-select/css/bootstrap-select.min.css"); ?>

    <?php echo HTML::style("assets/global/plugins/select2/css/select2.css"); ?>

    <?php echo HTML::style("assets/global/plugins/jquery-multi-select/css/multi-select.css"); ?>

    <?php echo HTML::style("assets/global/plugins/bootstrap-summernote/summernote.css"); ?>


    <!-- BEGIN THEME STYLES -->

<?php $__env->stopSection(); ?>


<?php $__env->startSection('mainarea'); ?>


    <!-- BEGIN PAGE HEADER-->
    <div class="page-head">
        <div class="page-title"><h1>
            Edit Ip Address
            </h1></div>
    </div>
    <div class="page-bar">
        <ul class="page-breadcrumb breadcrumb">
            <li>
                <a onclick="loadView('<?php echo e(route('admin.dashboard.index')); ?>')"><?php echo e(trans('core.dashboard')); ?></a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <a onclick="loadView('<?php echo e(route('admin.fingerprint_machines.index')); ?>')">Index IP</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span class="active">Edit Ip Address</span>
            </li>
        </ul>

    </div>
    <!-- END PAGE HEADER-->
    <!-- BEGIN PAGE CONTENT-->


    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->

            

            


            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-red-sunglo">
                        <i class="fa fa-edit font-red-sunglo"></i>Edit IP Address
                    </div>
     
                </div>

                <div class="portlet-body form">

                    <!-- BEGIN FORM-->
                    <?php echo Form::open(array('route'=>["admin.fingerprint_machines.update",$notice->id],'class'=>'form-horizontal ajax_form','method'=>'PATCH')); ?>



                    <div class="form-body">
	<div class="form-group">
                            <label class="col-md-2 control-label">Pilih OPD: <span class="required">
                                        * </span>
                            </label>
                            <div class="col-md-6">
                                             <select class="form-control select2me" id="company_id" name="company_id">
						   <option selected disabled>Silahkan Pilih OPD</option>
                <?php $__currentLoopData = $namadinas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $opd): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($opd->id); ?>" <?php if($notice->company_id==$opd->id): ?> selected <?php endif; ?>><?php echo e($opd->company_name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">Nama Mesin: <span class="required">
                                        * </span>
                            </label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="dinas"
                                       placeholder="Ketik Nama Mesin" value="<?php echo e($notice->dinas); ?>">
                                <span class="help-block"></span>
                            </div>
                        </div>
						
						
						       <div class="form-group">
                            <label class="col-md-2 control-label">IP Address: <span class="required">
                                        * </span>
                            </label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="ip"
                                       placeholder="Ketik IP Address" value="<?php echo e($notice->ip); ?>">
                                <span class="help-block"></span>
                            </div>
                        </div>
						
						
						
						       <div class="form-group">
                            <label class="col-md-2 control-label">Comkey: <span class="required">
                                        * </span>
                            </label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="comkey"
                                       placeholder="Ketik Comkey" value="<?php echo e($notice->comkey); ?>" readonly>
									   			   <small>Comkey di setting = 0</small>
                                <span class="help-block"></span>
                            </div>
                        </div>
						
						         <div class="form-group">
                            <label class="col-md-2 control-label">IP Normal/Shift: <span class="required">
                                                            * </span>
                            </label>
                            <div class="col-md-6">
                                <select class="form-control" name="shift">
                                           <option value="0" <?php if($notice->shift == 0): ?> selected <?php endif; ?>>OPD Normal</option>
                <option value="1" <?php if($notice->shift == 1): ?> selected <?php endif; ?>>OPD Shift</option>
                                </select>
<small>Jika anda memilih OPD Shift berarti IP hanya tampil pada Shift</small>
                            </div>
                        </div>

                 
				 			         <div class="form-group">
                            <label class="col-md-2 control-label">Pilih Shift: <span class="required">
                                                            * </span>
                            </label>
                            <div class="col-md-6">
                                <select class="form-control" name="idshift">
               <option value="0" <?php if($notice->idshift == 0): ?> selected <?php endif; ?>>Tidak Ada Shift</option>
                <option value="1338" <?php if($notice->idshift == 1338): ?> selected <?php endif; ?>>Shift Pagi</option>
                <option value="1427" <?php if($notice->idshift == 1427): ?> selected <?php endif; ?>>Shift Sore</option>
                <option value="1428" <?php if($notice->idshift == 1428): ?> selected <?php endif; ?>>Shift Malam</option>
                                </select>
			<small>Jika anda memilih OPD Normal, Silahkan Pilih Tidak Ada Shift</small>
                            </div>
                        </div>
				 
				 
                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo e(trans('core.status')); ?>: <span class="required">
                                                            * </span>
                            </label>
                            <div class="col-md-6">
                                <select class="form-control" name="status">
                                           <option value="1" <?php if($notice->status == 1): ?> selected <?php endif; ?>>Aktif</option>
                <option value="0" <?php if($notice->status == 0): ?> selected <?php endif; ?>>Tidak Aktif</option>
                                </select>

                            </div>
                        </div>
						
						
						
						 
               


                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-3 col-md-9">
                                    <button type="button" class="btn green" id="noticeUpdate"
                                            onclick="ajaxUpdateNotice(<?php echo e($notice->id); ?>)">
                                        <i class="fa fa-check"></i> <?php echo app('translator')->get("core.btnUpdate"); ?> Pembaruan</button>


                                </div>
                            </div>
                        </div>
                    <?php echo Form::close(); ?>

                    <!-- END FORM-->

                    </div>
                </div>
                <!-- END EXAMPLE TABLE PORTLET-->

            </div>
        </div>
    </div>
    <!-- END PAGE CONTENT-->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footerjs'); ?>

    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <?php echo HTML::script("assets/global/plugins/bootstrap-select/js/bootstrap-select.min.js"); ?>

    <?php echo HTML::script("assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js"); ?>

    <?php echo HTML::script("assets/global/plugins/select2/js/select2.js"); ?>

    <?php echo HTML::script("assets/global/plugins/jquery-multi-select/js/jquery.multi-select.js"); ?>


    <?php echo HTML::script('assets/js/ajaxform/jquery.form.min.js'); ?>

    <script>
	        $.fn.select2.defaults.set("theme", "bootstrap");
        $('.select2me').select2({
            placeholder: "Select",
            width: '100%',
            allowClear: false
        });


        function ajaxUpdateNotice(id) {

            var val = $('#description').val();

            var url = "<?php echo e(route('admin.fingerprint_machines.update',':id')); ?>";
            url = url.replace(':id', id);
            $.easyAjax({
                type: 'POST',
                url: url,
                container: '.ajax_form',
                data: $('.ajax_form').serialize(),
            });

        }
    </script>
    <!-- END PAGE LEVEL PLUGINS -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.adminlayouts.adminlayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\newabsen\resources\views/admin/fingerprint_machines/edit.blade.php ENDPATH**/ ?>