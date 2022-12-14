<?php $__env->startSection('head'); ?>


    <!-- BEGIN PAGE LEVEL STYLES -->
    <?php echo HTML::style("assets/global/plugins/select2/css/select2.css"); ?>

    <?php echo HTML::style("assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css"); ?>

    <!-- END PAGE LEVEL STYLES -->

<?php $__env->stopSection(); ?>


<?php $__env->startSection('mainarea'); ?>


    <!-- BEGIN PAGE HEADER-->
    <div class="page-head">
        <div class="page-title"><h1>
      IP Address Fingerprint
            </h1></div>
    </div>
    <div class="page-bar">
        <ul class="page-breadcrumb breadcrumb">
            <li>
                <a onclick="loadView('<?php echo e(route('admin.dashboard.index')); ?>')"><?php echo e(trans('core.dashboard')); ?></a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span class="active">IP Address</span>
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
                            <div class="col-md-6">

                                <a class="btn green" data-toggle="modal"
                                   onclick="loadView('<?php echo e(URL::route('admin.fingerprint_machines.create')); ?>')">
                                 Tambahkan IP Address
                                    <i class="fa fa-plus"></i> </a>
                            </div>
                      
                        </div>
                    </div>


                    <table class="table table-striped table-bordered table-hover" id="notices">
                        <thead>
                        <tr>
                            <th width="1%"> <?php echo app('translator')->get("core.serialNo"); ?> </th>
                            <th width="15%"> OPD </th>
                            <th> Nama Mesin </th>
                            <th> IP Adress </th>
                            <th> Comkey </th>
                            <th> Status IP</th>
                            <th> Normal/Shift </th>
                            <th> Status Shift </th>
                            <th> <?php echo e(trans('core.action')); ?> </th>
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
    <!-- END PAGE CONTENT-->

    
    <?php echo $__env->make('admin.common.delete', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    
<?php $__env->stopSection(); ?>



<?php $__env->startSection('footerjs'); ?>


    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <?php echo HTML::script("assets/global/plugins/select2/js/select2.min.js"); ?>

    <?php echo HTML::script("assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js"); ?>

    <?php echo HTML::script("assets/global/plugins/datatables/datatables.min.js"); ?>

    <?php echo HTML::script("assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js"); ?>


    <!-- END PAGE LEVEL PLUGINS -->

    <script>


        var table = $('#notices').dataTable({
            processing: true,
            serverSide: true,
            <?php echo $datatabble_lang; ?>

            "ajax": "<?php echo e(URL::route("admin.ajax_finger")); ?>",
            "aaSorting": [[4, "desc"]],
            columns: [
                {data: 'id', name: 'id'},
                {data: 'company_id', name: 'company_id'},
                {data: 'dinas', name: 'dinas'},
                {data: 'ip', name: 'ip'},
                {data: 'comkey', name: 'comkey'},
                {data: 'status', name: 'status'},
                {data: 'shift', name: 'shift'},
                {data: 'idshift', name: 'idshift'},
                {data: 'edit', name: 'edit'},
            ],
            "lengthMenu": [
                [5, 15, 20, -1],
                [5, 15, 20, "All"] // change per page values here
            ],

            "sPaginationType": "full_numbers",
            "fnRowCallback": function (nRow, aData, iDisplayIndex) {
                var oSettings = this.fnSettings();
                $("td:first", nRow).html(oSettings._iDisplayStart + iDisplayIndex + 1);
                return nRow
            }

        });


        function del(id) {

            $('#deleteModal').modal('show');

            $("#deleteModal").find('#info').html('Apakah anda yakin ingin menghapus ?');

            $('#deleteModal').find("#delete").off().click(function () {

                var url = "<?php echo e(route('admin.fingerprint_machines.destroy',':id')); ?>";
                url = url.replace(':id', id);

                var token = "<?php echo e(csrf_token()); ?>";

                $.easyAjax({
                    type: 'DELETE',
                    url: url,
                    data: {'_token': token},
                    container: "#deleteModal",
                    success: function (response) {
                        $('#deleteModal').modal('hide');
                        table.fnDraw();
                    }
                });

            });
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.adminlayouts.adminlayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\newabsen\resources\views/admin/fingerprint_machines/index.blade.php ENDPATH**/ ?>