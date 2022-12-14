<?php $__env->startSection('head'); ?>
    <style>
        .btn.active {
            opacity: 2 !important;
        }
    </style>
		    <?php echo HTML::style("assets/global/plugins/select2/css/select2.css"); ?>

    <?php echo HTML::style("assets/global/plugins/select2/css/select2-bootstrap.min.css"); ?>

    <?php echo HTML::style("assets/global/plugins/jquery-multi-select/css/multi-select.css"); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('mainarea'); ?>

    <!-- BEGIN PAGE HEADER-->
	
    <div class="page-head">
        <div class="page-title"><h1>
Print Rekap TPP (ASN)
            </h1></div>
    
    </div>
    <div class="page-bar">
        <ul class="page-breadcrumb breadcrumb">
            <li>
                <a onclick="loadView('<?php echo e(route('admin.dashboard.index')); ?>')"><?php echo e(trans('core.dashboard')); ?></a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span class="active">  Print Rekap TPP (ASN)</span>
            </li>

        </ul>

    </div>
    <!-- END PAGE HEADER-->
    <!-- BEGIN PAGE CONTENT-->

    <div class="row">
        <div class="col-md-12">

            <div class="portlet light bordered">
                <div class="portlet-body">
                    <div class="row filter-row">
                   <?php  $bulan = date("n")-1;  ?>
                        <div class="col-sm-3 col-xs-6">
                            <div class="form-group form-focus">
                                <label class="control-label">Pilih Bulan </label>
                                <select class="form-control select2me floating" name="month">
                             <option value="1" <?php if(1 == $bulan): ?> selected="selected"<?php endif; ?>>Januari</option>
                             <option value="2" <?php if(2 == $bulan): ?> selected="selected"<?php endif; ?>>Februari</option>
                             <option value="3" <?php if(3 == $bulan): ?> selected="selected"<?php endif; ?>>Maret</option>
                                        <option value="4"<?php if(4 == $bulan): ?> selected="selected"<?php endif; ?>>April</option>
                                        <option value="5"<?php if(5 == $bulan): ?> selected="selected"<?php endif; ?>>Mei</option>
                                        <option value="6"<?php if(6== $bulan): ?> selected="selected"<?php endif; ?> >Juni</option>
                                        <option value="7"<?php if(7 == $bulan): ?> selected="selected"<?php endif; ?>>Juli</option>
                                        <option value="8"<?php if(8 == $bulan): ?> selected="selected"<?php endif; ?>>Agustus</option>
                                        <option value="9"<?php if(9 == $bulan): ?> selected="selected"<?php endif; ?>>September</option>
                                        <option value="10"<?php if(10 == $bulan): ?> selected="selected"<?php endif; ?>>Oktober</option>
                                        <option value="11"<?php if(11 == $bulan): ?> selected="selected"<?php endif; ?>>November</option>
                                        <option value="12"<?php if(12 == $bulan): ?> selected="selected"<?php endif; ?>>Desember</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-3 col-xs-6">
                            <div class="form-group form-focus">
                                <label class="control-label">Pilih Tahun</label>
                                <?php echo Form::selectYear('year', 2015, date('Y'),date('Y'),['class' => 'form-control select2me floating']); ?>

                            </div>
                        </div>
                        <div class="col-sm-3 col-xs-6">
                            <div class="form-group form-focus">
                                <label class="control-label">&nbsp;</label>
                                <a href="javascript:;" class="btn btn-success btn-block" onclick="filter(); return false;"> Klik Pencarian </a>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="table-responsive" id="rekaprekap-sheet">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('footerjs'); ?>
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <?php echo HTML::script("assets/global/plugins/bootstrap-select/js/bootstrap-select.min.js"); ?>

    <?php echo HTML::script("assets/global/plugins/select2/js/select2.min.js"); ?>

    <?php echo HTML::script("assets/global/plugins/jquery-multi-select/js/jquery.multi-select.js"); ?>

    <!-- END PAGE LEVEL PLUGINS -->

    <!-- END PAGE LEVEL PLUGINS -->
    <script type="text/javascript">
	        $.fn.select2.defaults.set("theme", "bootstrap");
        $('.select2me').select2({
            placeholder: "Select",
            width: '100%',
            allowClear: false
        });

	
       var filter = () => {
            var data = {
                employee_id: $("select[name='employee_id']").val(),
                month: $("select[name='month']").val(),
                year: $("select[name='year']").val(),
                _token: '<?php echo e(csrf_token()); ?>'
            };

            var url = "<?php echo e(route('admin.rekaprekap.filter')); ?>";
            $.easyAjax({
                type: 'POST',
                url: url,
                container: '#rekaprekap-sheet',
                data: data,
                success: function (res) {
                    if (res.status === 'success') {
                        $('#rekaprekap-sheet').html(res.data);
                    }
                }
            });
        };
       jQuery(document).ready(function () {
           filter();
       });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.adminlayouts.adminlayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\newabsen\resources\views/admin/printrekap/payrolls-sheet.blade.php ENDPATH**/ ?>