<?php $__env->startSection('head'); ?>
    <!-- BEGIN PAGE LEVEL STYLES -->
    <?php echo HTML::style("assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css"); ?>

    <!-- END PAGE LEVEL STYLES -->

<?php echo HTML::style('front_assets/plugins/sky-forms/version-2.0.1/css/custom-sky-forms.css'); ?>



<?php $__env->stopSection(); ?>


<?php $__env->startSection('mainarea'); ?>

    <!-- BEGIN PAGE HEADER-->
    <div class="page-head">
        <div class="page-title"><h1>
            Data Keterangan
            </h1></div>
    </div>
    <div class="page-bar">
        <ul class="page-breadcrumb breadcrumb">
            <li>
                <a onclick="loadView('<?php echo e(route('admin.dashboard.index')); ?>')"><?php echo app('translator')->get('core.dashboard'); ?></a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span class="active"> Data Keterangan</span>
            </li>

        </ul>

    </div>            <!-- END PAGE HEADER-->            <!-- BEGIN PAGE CONTENT-->


    <div class="row">
        <div class="col-md-12">

            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div id="load">


            </div>
            <div class="portlet light bordered">

                <div class="portlet-body">
          
        <div class="table-toolbar">
		
		       
                        <div class="row">
                    <div class="col-md-12 form-group text-right">
                                <a class="btn green" onclick="loadView('<?php echo e(route('admin.newleave.create')); ?>')">
                           Tambahkan Keterangan Lainnya
                                    <i class="fa fa-plus"></i> </a>
									
									               <a class="btn blue" onclick="loadView('<?php echo e(route('admin.newleave_dl.create')); ?>')">
                           Tambahkan Keterangan Perjalanan Dinas
                                    <i class="fa fa-plus"></i> </a>
                            </div>
                            <div class="col-md-6">
                            </div>
                        </div>
                    </div>
                    <table style="border: 1px solid #c2cad8;" class="table table-striped table-bordered table-hover" id="applications">
                        <thead>
                        <tr>
                            <th><?php echo app('translator')->get('core.id'); ?></th>
                            <th>Nama</th>
                            <th>Tanggal</th>
                            <th>Jumlah Hari</th>
                            <th>Keterangan</th>

                            <th>Alasan</th>
                            <th>Dibuat</th>
                            <th><?php echo app('translator')->get('core.status'); ?></th>
                            <th>Aksi</th>

                        </tr>
                        </thead>
                        <tbody>

                        </tbody>

                    </table>
                </div>
            </div>
            <!-- END EXAMPLE TABLE PORTLET-->

        </div>
    </div>            <!-- END PAGE CONTENT-->


    

    
    <?php echo $__env->make('admin.common.delete', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('admin.common.show-modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    

<?php $__env->stopSection(); ?>



<?php $__env->startSection('footerjs'); ?>


    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <?php echo HTML::script("assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js"); ?>

    <?php echo HTML::script("assets/global/plugins/datatables/datatables.min.js"); ?>

    <?php echo HTML::script("assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js"); ?>

    <?php echo HTML::script("assets/admin/pages/scripts/table-managed.js"); ?>

    <!-- END PAGE LEVEL PLUGINS -->
    <!-- END PAGE LEVEL PLUGINS -->

<!-- JS Implementing Plugins -->
<?php echo HTML::script('front_assets/plugins/back-to-top.js'); ?>


<!-- Scrollbar -->

<?php echo HTML::script('front_assets/plugins/scrollbar/src/perfect-scrollbar.js'); ?>



    <script>



        var table = $('#applications').dataTable({
            processing: true,
            serverSide: true,
				"oLanguage" : {
					"sEmptyTable" : "Tidak Di Temukan Keterangan"
				},
            "aaSorting": [[0, "desc"]],
            <?php echo $datatabble_lang; ?>

            "ajax": "<?php echo e(URL::route('admin.leave_applications')); ?>",
            "columns": [
                {data: 'id', name: 'id'},
                {data: 'full_name', name: 'full_name'},
                {data: 'start_date', name: 'start_date'},
                {data: 'days', name: 'days'},
                {data: 'leaveType', name: 'leaveType'},
                {data: 'reason', name: 'reason'},
                {data: 'applied_on', name: 'applied_on'},
                {data: 'application_status', name: 'application_status'},
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
                return nRow;
            }

        });


        function del(id) {

            $('#deleteModal').modal('show');

            $("#deleteModal").find('#info').html("<?php echo app('translator')->get("messages.leaveApplicationDeleteConfirm"); ?>");
            $('#deleteModal').find("#delete").off().click(function () {
                var url = "<?php echo e(route('admin.leave_applications.destroy',':id')); ?>";
                url = url.replace(':id', id);
                $.ajax({
                    type: "DELETE",
                    url: url,
                    dataType: 'json',
                    data: {"id": id}
                }).done(function (response) {
                    if (response.success == "deleted") {

                        $('#deleteModal').modal('hide');
                        $('#row' + id).fadeOut(500);
                        table._fnDraw();
                        showToastrMessage("<?php echo app('translator')->get("messages.leaveApplicationDeleteMessage"); ?>", '<?php echo e(__('core.success')); ?>', 'success');
                    }
                });
            })
        }

        function show_application(id) {
            var url = "<?php echo route('admin.leave_applications.show',':id'); ?>";
            url = url.replace(':id', id);
            $.ajaxModal('#showModal', url);
        }

		
      function showEdit(id, leaveType, num, pot) {
            var url = "<?php echo e(route('admin.newleave.edit',':id')); ?>";
            url = url.replace(':id', id);
            $.ajaxModal('#showModal', url);

            $("#edit_leaveType").val(leaveType);
            $("#edit_halfDayType").val(num);
            $("#edit_reason").val(pot);
        }
		
		      function showEdit_dl(id, leaveType, num, pot) {
            var url = "<?php echo e(route('admin.newleave_dl.edit',':id')); ?>";
            url = url.replace(':id', id);
            $.ajaxModal('#showModal', url);

            $("#edit_leaveType").val(leaveType);
            $("#edit_halfDayType").val(num);
            $("#edit_reason").val(pot);
        }
		
		    function addUpdateLeaveType(id) {

            if (typeof id != 'undefined') {
                var url = "<?php echo e(route('admin.newleave.update',':id')); ?>";
                url = url.replace(':id', id);
            } else {
                url = "<?php echo e(route('admin.newleave.store')); ?>";
            }
            $.easyAjax({
                type: 'POST',
                url: url,
                container: '#leave_type_update_form',
                data: $('#leave_type_update_form').serialize(),
                success: function (response) {
                    if (response.status == "success") {
                        $('#showModal').modal('hide');
                        table.fnDraw();
						    window.location.reload();
                    }

                }
            });
        }

    </script>
			  <script>
function refreshPage(){
    window.location.reload();
} 



</script>	         
			
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.adminlayouts.adminlayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\newabsen\resources\views/admin/leave_applications/index.blade.php ENDPATH**/ ?>