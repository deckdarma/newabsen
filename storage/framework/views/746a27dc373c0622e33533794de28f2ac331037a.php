

<?php $__env->startSection('head'); ?>
    <!-- BEGIN PAGE LEVEL STYLES -->
    <?php echo HTML::style("assets/global/plugins/bootstrap-datepickerabsen/css/bootstrap-datepickerabsen.css"); ?>

    <?php echo HTML::style("assets/global/plugins/select2/css/select2.css"); ?>

    <?php echo HTML::style("assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css"); ?>

    <!-- END PAGE LEVEL STYLES -->
    <style>
        .btn.active {
            opacity: 2 !important;
        }
    </style>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('mainarea'); ?>
<?php if($loggedAdmin->company->datashift==1): ?>	
<script type="text/javascript">

    window.location.replace("../error");
</script>

<?php else: ?>

<?php endif; ?>

    <!-- BEGIN PAGE HEADER-->
    <div class="page-head">
        <div class="page-title"><h1>
         Laporan Pegawai
            </h1></div>
        <div class="page-toolbar">
            <!-- BEGIN THEME PANEL -->
  
            <!-- END THEME PANEL -->
        </div>
    </div>
    <div class="page-bar">
        <ul class="page-breadcrumb breadcrumb">
            <li>
                <a onclick="loadView('<?php echo e(route('admin.dashboard.index')); ?>')"><?php echo e(trans('core.dashboard')); ?></a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span class="active"> Laporan Pegawai</span>
            </li>

        </ul>

    </div>
    <!-- END PAGE HEADER-->
    <!-- BEGIN PAGE CONTENT-->

    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div id="load">

                <?php if(Session::get('success')): ?>
                    <div class="alert alert-success"><?php echo e(Session::get('success')); ?></div>
                <?php endif; ?>

            </div>
			<?php 
$datanull = NULL;
$datacom = $loggedAdmin->company_id;

$cekpegawai = count(DB::select(DB::raw("SELECT * FROM employees WHERE status='active' AND company_id ='".$datacom."' AND shift='0' AND designation !='".$datanull."' "))); ?>
<?php $cekasn = count(DB::select(DB::raw("SELECT * FROM employees WHERE statusmupeg = 'ASN' AND status='active' AND shift='0' AND company_id ='".$datacom."' AND designation !='".$datanull."' "))); ?>
<?php $cekphl = count(DB::select(DB::raw("SELECT * FROM employees WHERE statusmupeg = 'PHL' AND status='active' AND shift='0' AND company_id ='".$datacom."' AND designation !='".$datanull."' "))); ?>

<?php if($cekpegawai != 0): ?>			  

<div class="row">
<div class="col-md-6">
    <div class="portlet light bordered">
        <div class="portlet-title">
            <div class="caption font-dark">
          LAPORAN ASN
            </div>
        </div>
        <div class="portlet-body">
			<div style="
    margin-bottom: 10px;
"> Silahkan Klik Tombol di Bawah dan pilih ASN, dan Aplikasi akan menampilkan data ASN yang anda pilih, 
			sebagai informasi jika OPD anda memiliki ASN sebanyak: <?php echo e($cekasn); ?> org
			</div>
	      	   <a style="width:100%" onclick="loadView('<?php echo e(route('admin.laporanpegawai.index')); ?>')" class="btn green">
                 LIHAT LAPORAN ASN 
                </a>
	   

    </div>
    </div>
</div>


<div class="col-md-6">
    <div class="portlet light bordered">
        <div class="portlet-title">
            <div class="caption font-dark">
             LAPORAN PHL
            </div>
        </div>
        <div class="portlet-body">
				<div style="
    margin-bottom: 10px;
"> Silahkan Klik Tombol di Bawah dan pilih PHL, dan Aplikasi akan menampilkan data PHL yang anda pilih, 
			sebagai informasi jika OPD anda memiliki PHL sebanyak: <?php echo e($cekphl); ?> org
			</div>
	          <a style="width:100%" onclick="loadView('<?php echo e(route('admin.laporanphl.index')); ?>')" class="btn green">
                 LIHAT LAPORAN PHL
                </a>


    </div>
    </div>
</div>

</div>
<?php else: ?>
	<div class="row">
	<div class="col-md-12">
    <div class="portlet light bordered">
  
<div class="note note-warning">
                                <h4 class="block">Pegawai Tidak di Temukan</h4>
                                <p>Tidak ada pegawai yang dapat di tampilkan saat ini, silahkan tambahkan pegawai terlebih dahulu.</p>
</div>

</div>
</div>
</div>

<?php endif; ?>
       
            <!-- END EXAMPLE TABLE PORTLET-->

        </div>
    </div>
    <!-- END PAGE CONTENT-->



<?php $__env->stopSection(); ?>


<?php $__env->startSection('footerjs'); ?>

    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <?php echo HTML::script("assets/global/plugins/select2/js/select2.min.js"); ?>

    <?php echo HTML::script("assets/global/plugins/datatables/datatables.min.js"); ?>

    <?php echo HTML::script("assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js"); ?>

    <?php echo HTML::script("assets/admin/pages/scripts/table-managed.js"); ?>

    <?php echo HTML::script("assets/global/plugins/bootstrap-datepickerabsen/js/bootstrap-datepickerabsen.js"); ?>

    <?php echo HTML::script("assets/admin/pages/scripts/components-pickersabsen.js"); ?>




<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.adminlayouts.adminlayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\newabsen\resources\views/admin/laporanpegawai/create.blade.php ENDPATH**/ ?>