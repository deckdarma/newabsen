

<?php $__env->startSection('head'); ?>
    <!-- BEGIN PAGE LEVEL STYLES -->

    <?php echo HTML::style("assets/global/plugins/select2/css/select2.css"); ?>


    <!-- END PAGE LEVEL STYLES -->
    <style>
        .btn.active {
            opacity: 2 !important;
        }
    </style>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('mainarea'); ?>


    <!-- BEGIN PAGE HEADER-->
    <div class="page-head">
        <div class="page-title"><h1>
         Laporan Harian ASN/PHL 
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
                <span class="active"> Laporan Harian ASN/PHL</span>
            </li>

        </ul>

    </div>
    <!-- END PAGE HEADER-->
    <!-- BEGIN PAGE CONTENT-->
<? 
date_default_timezone_set('Asia/Makassar');
$tanggal = date('Y-m-d'); ?>
	
<?php 
$datanull = NULL;
$datacom = $loggedAdmin->company_id;

$cekpegawai = count(DB::select(DB::raw("SELECT * FROM employees WHERE status='active' AND company_id ='".$datacom."' AND shift='0' AND designation !='".$datanull."' "))); ?>
<?php $cekasn = count(DB::select(DB::raw("SELECT * FROM employees WHERE statusmupeg = 'ASN' AND status='active' AND shift='0' AND company_id ='".$datacom."' AND designation !='".$datanull."' "))); ?>
<?php $cekphl = count(DB::select(DB::raw("SELECT * FROM employees WHERE statusmupeg = 'PHL' AND status='active' AND shift='0' AND company_id ='".$datacom."' AND designation !='".$datanull."' "))); ?>
<?PHP $belumasn=$cekasn-$hadirasn;?>
<?PHP $belumphl=$cekphl-$hadirphl;?>
<?php if($cekasn ==0): ?>
<?PHP $prosentaseasn= 0; ?>	
<?php else: ?>
<?PHP $prosentaseasn= round(($hadirasn/$cekasn)* 100); ?>
<?php endif; ?>

<?php if($cekphl ==0): ?>
<?PHP $prosentasephl= 0; ?>	

<?php else: ?>
<?PHP $prosentasephl= round(($hadirphl/$cekphl)* 100); ?>
<?php endif; ?>
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div id="load">

                <?php if(Session::get('success')): ?>
                    <div class="alert alert-success"><?php echo e(Session::get('success')); ?></div>
                <?php endif; ?>

            </div>
											  <?php
$date_jumat12 = date('Y-m-d');
$timestamp12 = strtotime($date_jumat12);
$tampilkanharidata2212= date("l", $timestamp12 );
$tampilkanharidata22 = strtolower($tampilkanharidata2212);

$timestamp = strtotime($date_jumat12);
$carihari= date("l", $timestamp );
$tampilkanhari = strtolower($carihari);
$waktu = Date("H:i:s");

if ($tampilkanharidata22 == "sunday") $carinamahari = "Minggu";
elseif ($tampilkanharidata22 == "monday") $carinamahari = "Senin";
elseif ($tampilkanharidata22 == "tuesday") $carinamahari = "Selasa";
elseif ($tampilkanharidata22 == "wednesday") $carinamahari = "Rabu";
elseif ($tampilkanharidata22 == "thursday") $carinamahari = "Kamis";
elseif ($tampilkanharidata22 == "friday") $carinamahari = "Jumat";
elseif ($tampilkanharidata22 == "saturday") $carinamahari = "Sabtu";
?>

<?php if($cekpegawai != 0): ?>		          
						
			    <div class="row">
				<div class="col-md-12">
						    <div class="portlet light bordered">
        <div class="portlet-title">
					
			  <?php if(isset($periode_tangal->date)): ?>

                            <div class="note note-success" style="font-size: 18px;">
                                <div ></div>
                                Jenis Absen di alihkan sebagai : <?php echo e($periode_tangal->nama_event); ?>  / <span class="label label-info">Pada Hari <?php echo e($carinamahari); ?></span>
		
                            </div>
							 <?php else: ?>

							<div class="note note-success" style="font-size: 18px; background-color: #c8f3c0;border-color: #8bcc5f;">
                            Jenis Absen yang di gunakan : Normal / <span class="label label-success">Pada Hari <?php echo e($carinamahari); ?></span>
                            </div>
							<?php endif; ?>
							
							
                            </div>
	<?php if(isset($periode_tangal->date)): ?>
		<?php if($tampilkanhari == "friday"): ?> 
			Jam Masuk <?php echo e($carinamahari); ?> <?php echo e($periode_tangal->jam_masuk_jumat); ?>	/ Jam Pulang <?php echo e($carinamahari); ?> 	<?php echo e($periode_tangal->jam_pulang_jumat); ?>	 
							
			<?php else: ?>  
			Jam Masuk <?php echo e($carinamahari); ?> <?php echo e($periode_tangal->jam_masuk); ?>	/ Jam Pulang <?php echo e($carinamahari); ?> 	<?php echo e($periode_tangal->jam_pulang); ?>		
			<?php endif; ?>
		 <?php else: ?>
			<?php if($tampilkanhari == "friday"): ?> 
			Jam Masuk <?php echo e($carinamahari); ?> <?php echo e($normal_tangal->jam_masuk_jumat); ?>	/ Jam Pulang <?php echo e($carinamahari); ?> 	<?php echo e($normal_tangal->jam_pulang_jumat); ?>	 
							
			<?php else: ?>  
			Jam Masuk <?php echo e($carinamahari); ?> <?php echo e($normal_tangal->jam_masuk); ?>	/ Jam Pulang <?php echo e($carinamahari); ?> 	<?php echo e($normal_tangal->jam_pulang); ?>		
			<?php endif; ?>
        <?php endif; ?>                    </div>
                            </div>
<div class="col-md-6">
    <div class="portlet light bordered">
        <div class="portlet-title">
            <div class="caption font-dark">
          LAPORAN HARIAN ASN
            </div>
        </div>
        <div class="portlet-body">
		<div style="
    font-size: 16px;
    margin-bottom: 10px;
">Data Statistik Kehadiran ASN Pada Tanggal, <?php echo e(date('d M Y')); ?><BR>
<div class="col-md-4"> <div class="row"><h5  style="padding-top:10px;    margin: 0px;    padding-bottom: 10px;font-weight: bold;">SUDAH ABSEN: <span><?php echo e($hadirasn); ?></span> org</h5> </div></div>
<div class="col-md-4"> <div class="row"><h5 style="padding-top:10px;    margin: 0px;    padding-bottom: 10px;font-weight: bold;">BELUM ABSEN: <span><?php echo e($belumasn); ?></span> org</h5> </div></div>
<div class="col-md-4"> <div class="row"><h5 style="padding-top:10px;    margin: 0px;    padding-bottom: 10px;font-weight: bold;">PRESENTASI HADIR: <span><?php echo e($prosentaseasn); ?>%</span></h5> </div></div>
</div>
	      	   <a style="width:100%" href="<?php echo e(route('admin.attendance.asndata')); ?>" class="btn  green">
                  LIHAT LAPORAN ASN Tgl: <?php echo e(date('d M Y')); ?>

                </a>
	   

    </div>
    </div>
</div>


<div class="col-md-6">
    <div class="portlet light bordered">
        <div class="portlet-title">
            <div class="caption font-dark">
             LAPORAN HARIAN PHL
            </div>
        </div>
        <div class="portlet-body">
<div style="
    font-size: 16px;
    margin-bottom: 10px;
">Data Statistik Kehadiran PHL Pada Tanggal, <?php echo e(date('d M Y')); ?><BR>
<div class="col-md-4"> <div class="row"><h5  style="padding-top:10px;    margin: 0px;    padding-bottom: 10px;font-weight: bold;">SUDAH ABSEN: <span><?php echo e($hadirphl); ?></span> org</h5> </div></div>
<div class="col-md-4"> <div class="row"><h5 style="padding-top:10px;    margin: 0px;    padding-bottom: 10px;font-weight: bold;">BELUM ABSEN: <span><?php echo e($belumphl); ?></span> org</h5> </div></div>
<div class="col-md-4"> <div class="row"><h5 style="padding-top:10px;    margin: 0px;    padding-bottom: 10px;font-weight: bold;">PRESENTASI HADIR: <span><?php echo e($prosentasephl); ?>%</span></h5> </div></div>
</div>
	          <a style="width:100%" href="<?php echo e(route('admin.laporanphl.phldata')); ?>"  class="btn purple">
                 LIHAT LAPORAN PHL Tgl: <?php echo e(date('d M Y')); ?>

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


    <?php echo HTML::script("assets/admin/pages/scripts/table-managed.js"); ?>


    <?php echo HTML::script("assets/admin/pages/scripts/components-pickersabsen.js"); ?>




<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.adminlayouts.adminlayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\newabsen\resources\views/admin/attendances/create.blade.php ENDPATH**/ ?>