<?php $__env->startSection('head'); ?>
    <?php echo HTML::style("assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css"); ?>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('mainarea'); ?>


    <!-- BEGIN PAGE HEADER-->
    <div class="page-head">
        <div class="page-title"><h1>
                <?php echo e($pageTitle); ?>

            </h1></div>
    </div>
    <div class="page-bar">
        <ul class="page-breadcrumb breadcrumb">
            <li>
                <a onclick="loadView('<?php echo e(route('admin.dashboard.index')); ?>')"><?php echo e(trans('core.dashboard')); ?></a>
                <i class="fa fa-circle"></i>
            </li>

            <li>
                <span class="active"><?php echo app('translator')->get("core.admins"); ?></span>

            </li>

        </ul>

    </div>
    <!-- END PAGE HEADER-->
    <!-- BEGIN PAGE CONTENT-->
    <div class="row">
        <div class="col-md-12">


            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div id="load">


            </div>
            <div class="portlet light bordered">

                <div class="portlet-body">
                    <div class="table-toolbar">
                        <div class="row ">
						<?php if($verifikasi2 == "1"): ?>
                            <div class="col-md-6">
                                <a class="btn green" onclick="showAdd();">
                                  Tambah Admin Baru   
                                    <i class="fa fa-plus"></i> </a>        

									<a class="btn purple" onclick="showEdit(1);return false;">
                                   Edit Akun <?php echo e($verifikasi3); ?>   
                                    <i class="fa fa-edit"></i> </a>
									
							
                            </div>
                            <?php else: ?>
								
							<?php endif; ?>
                        </div>
                    </div>


                    <table class="table table-striped table-bordered table-hover" id="admins">
                        <thead>
                        <tr>
                            <th> NO.</th>
                            <th> Nama</th>
                            <th> <?php echo e(trans('core.email')); ?> </th>
                            <th>Status Admin </th>
                            <th class="text-center"> <?php echo e(trans('core.actions')); ?> </th>
                        </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
            <!-- END EXAMPLE TABLE PORTLET-->

        </div>
    </div>

    

    <div id="static_edit" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog" id="edit-form-body">
            <div class="modal-content">

                <div class="modal-body" id="edit-modal-body">
                </div>
            </div>

        </div>
    </div>


    <?php echo $__env->make('admin.common.delete', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('admin.common.show-modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->stopSection(); ?>



<?php $__env->startSection('footerjs'); ?>


    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <?php echo HTML::script("assets/global/plugins/datatables/datatables.min.js"); ?>

    <?php echo HTML::script("assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js"); ?>

    <?php echo HTML::script("assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js"); ?>


    <!-- END PAGE LEVEL PLUGINS -->

    <script>


        var table = $('#admins').dataTable({
            <?php echo $datatabble_lang; ?>

            processing: true,
            serverSide: true,
            "ajax": "<?php echo e(URL::route("admin.ajax_superadmin_users")); ?>",
            "aaSorting": [[3, "desc"]],
            columns: [
                {data: 'id', name: 'id'},
                {data: 'name', name: 'name'},
                {data: 'email', name: 'email'},
                {data: 'type', name: 'type'},
                {data: 'edit', name: 'edit'}
            ],
            "lengthMenu": [
                [15, 25, 50, -1],
                [15, 25, 50, "All"] // change per page values here
            ],
            "sPaginationType": "full_numbers",
            "fnRowCallback": function (nRow, aData, iDisplayIndex) {
                var oSettings = this.fnSettings();
                $("td:first", nRow).html(oSettings._iDisplayStart + iDisplayIndex + 1);
                return nRow;
            }

        });


        // Show Delete Modal
        function del(id, name) {

            $('#deleteModal').modal('show');

            $("#deleteModal").find('#info').html('Are you sure ! You want to delete?');

            $('#deleteModal').find("#delete").off().click(function () {

                var url = "<?php echo e(route('admin.superadmin_users.destroy',':id')); ?>";
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

            });
        }

        function showEdit(id) {
            var url = "<?php echo e(route('admin.superadmin_users.edit',':id')); ?>";
            url = url.replace(':id', id);
            $.ajaxModal('#showModal', url);

        }

        function showAdd() {
            var url = "<?php echo e(route('admin.superadmin_users.create')); ?>";
            $.ajaxModal('#showModal', url);

        }

        function addAdminSubmit() {

            url = "<?php echo e(route('admin.superadmin_users.store')); ?>";
            $.easyAjax({
                type: 'POST',
                url: url,
                container: '.ajax_form',
                data: $('.ajax_form').serialize(),
                success: function (response) {
                    if (response.status === "success") {
                        $('#showModal').modal('hide');
                        table.fnDraw();
                    }

                }
            });
        }

        function updateAdminSubmit(id) {
            var url = "<?php echo e(route('admin.superadmin_users.update',':id')); ?>";
            url = url.replace(':id', id);
            $.easyAjax({
                type: 'PUT',
                url: url,
                container: '.ajax_form',
                data: $('.ajax_form').serialize(),
                success: function (response) {
                    if (response.status === "success") {
                        $('#showModal').modal('hide');
                        table.fnDraw();
                    }

                }
            });
        }

    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.adminlayouts.adminlayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\newabsen\resources\views/admin/superadmin_users/index.blade.php ENDPATH**/ ?>