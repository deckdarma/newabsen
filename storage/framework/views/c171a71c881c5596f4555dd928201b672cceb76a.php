<?php $__env->startSection('head'); ?>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('mainarea'); ?>


    <!-- BEGIN PAGE HEADER-->
    <div class="page-head">
        <div class="page-title"><h1>
                Pengaturan Akun
            </h1></div>
    </div>
    <div class="page-bar">
        <ul class="page-breadcrumb breadcrumb">
            <li>
                <a onclick="loadView('<?php echo e(route('admin.dashboard.index')); ?>')"><?php echo e(trans('core.dashboard')); ?></a>
                <i class="fa fa-circle"></i>
            </li>
         
            <li>
                <span class="active">  Pengaturan Akun</span>
            </li>
        </ul>

    </div>
    <!-- END PAGE HEADER-->
    <!-- BEGIN PAGE CONTENT-->
    <div class="row">
        <div class="col-lg-12">
            <div id="load">
                

                
            </div>
        </div>
        <div class="col-md-6">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->


            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <i class="fa fa-lock font-dark"></i>Informasi Login
                    </div>
                    <div class="tools">
                    </div>
                </div>

                <div class="portlet-body form">

                    <!------------------------ BEGIN FORM---------------------->
                    <?php echo Form::open(['class'=>'form-horizontal ajax-form-login']); ?>


                    <div class="form-body">
                        <div class="form-group">
                            <label class="col-md-4 control-label">Dinas: <span class="required">
                                        * </span>
                            </label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="name" placeholder="Nama Dinas"
                                       value="<?php echo e($admin->name); ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label"><?php echo e(trans('core.loginEmail')); ?>: <span class="required">
                                            * </span>
                            </label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="email"
                                       placeholder="<?php echo app('translator')->get("core.loginEmail"); ?>" value="<?php echo e($admin->email); ?>">
                            </div>
                        </div>
                        <input type="hidden" name="type" value="login">
                        <!------------------------- END FORM ----------------------->

                    </div>
                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-offset-4 col-md-9">
                                <button type="button" onclick="updateLogin();return false;" class="btn green"><i
                                            class="fa fa-check"></i> <?php echo e(trans('core.btnUpdate')); ?> Informasi Login</button>

                            </div>
                        </div>
                    </div>
                    <?php echo Form::close(); ?>

                </div>
                <!-- END EXAMPLE TABLE PORTLET-->

            </div>
        </div>
        <div class="col-md-6">
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <i class="fa fa-key font-dark"></i>Ganti Kata Sandi
                    </div>
                    <div class="tools">
                    </div>
                </div>

                <div class="portlet-body form">

                    <!------------------------ BEGIN FORM Change Password---------------------->
                    <?php echo Form::open(['class'=>'form-horizontal ajax-form-password']); ?>


                    <div class="form-body">

                        <div class="form-group">
                            <label class="col-md-4 control-label">Sandi Baru: <span class="required">
                                                                        * </span>
                            </label>
                            <div class="col-md-6">
                                <input type="password" class="form-control" name="password"
                                       placeholder="Ketik Sandi Baru">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Ulangi Sandi Baru: <span
                                        class="required">
                                                                            * </span>
                            </label>
                            <div class="col-md-6">
                                <input type="password" class="form-control" name="password_confirmation"
                                       placeholder="Ketik Ulangi Sandi Baru">
                            </div>
                        </div>
                        <!------------------------- END FORM Change Password ----------------------->

                    </div>
                    <input type="hidden" name="type" value="password">
                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-offset-4 col-md-9">
                                <button type="button" onclick="updatePassword();return false;" class="btn green"><i
                                            class="fa fa-check"></i> <?php echo e(trans('core.btnUpdate')); ?> Kata Sandi</button>

                            </div>
                        </div>
                    </div>
                    <?php echo Form::close(); ?>

                </div>
                <!-- END EXAMPLE TABLE PORTLET-->

            </div>
        </div>
    </div>
    <!-- END PAGE CONTENT-->

<style>
body {
    margin: 0;
    overflow-x: hidden;
}
</style>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('footerjs'); ?>



    <script>

        function updateLogin() {
            $.easyAjax({
                type: 'POST',
                url: "<?php echo e(route(admin()->type.'.profile_settings.update')); ?>",
                data: $(".ajax-form-login").serialize(),
                container: ".ajax-form-login",
            });
        }
        function updatePassword() {
            $.easyAjax({
                type: 'POST',
                url: "<?php echo e(route(admin()->type.'.profile_settings.update')); ?>",
                data: $(".ajax-form-password").serialize(),
                container: ".ajax-form-password",
            });
        }
    </script>
    <!-- END PAGE LEVEL PLUGINS -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.adminlayouts.adminlayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\newabsen\resources\views/admin/profile_settings/edit.blade.php ENDPATH**/ ?>