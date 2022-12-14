<li class="nav-item start <?php echo e(isset($superadmindashboardActive) ? $superadmindashboardActive : ''); ?>">
    <a class="nav-link"
       href="javascript: loadView('<?php echo e(URL::route('superadmin.dashboard.index')); ?>')">
        <i class="fa fa-home"></i>
        <span class="title"><?php echo e(__('menu.dashboard')); ?></span>
        <span class="selected"></span>
    </a>
</li>


<li class="nav-item <?php echo e(isset($companyActive) ? $companyActive : ''); ?>">
    <a class="nav-link"
       href="javascript: loadView('<?php echo e(route('admin.companies.index')); ?>')">
        <i class="fa fa-bank"></i>
        <span class="title">Data OPD</span>
        <span class="selected "></span>
    </a>
</li>
<li class="nav-item <?php echo e(isset($superAdminUserActive) ? $superAdminUserActive : ''); ?>">
    <a class="nav-link"
       href="javascript: loadView('<?php echo e(route('admin.superadmin_users.index')); ?>')">
        <i class="fa fa-user"></i>
        Data Login</a>
</li>









<li class="menu-dropdown classic-menu-dropdown <?php echo e(isset($hrMenuActive) ? $hrMenuActive : ''); ?>">
    <a href="javascript:;">
        <i class="icon-user"></i> Data Absensi
        <i class="fa fa-angle-down"></i>
    </a>
    <ul class="dropdown-menu pull-left">

        <li class="nav-item <?php echo e(isset($leaveTypeActive) ? $leaveTypeActive : ''); ?>">
            <a class="nav-link"
               href="javascript: loadView('<?php echo e(route('admin.leavetypes.index')); ?>')">
                <i class="fa fa-file-text"></i>
                 <?php echo e(__('menu.leaveTypes')); ?></a>
        </li>

        <li class="nav-item <?php echo e(isset($dataSkorActive) ? $dataSkorActive : ''); ?>">
            <a class="nav-link"
               href="javascript: loadView('<?php echo e(route('admin.dataskors.index')); ?>')">
                <i class="fa fa-file-text"></i>
                List Nama Skors</a>
        </li>
				<hr style="margin: 3px 0px; border-top: 1px solid #32669d;">
		      <li class="nav-item <?php echo e(isset($NormalabsensiActive) ? $NormalabsensiActive : ''); ?>">
            <a class="nav-link"
               href="javascript: loadView('<?php echo e(route('admin.normalabsensis.index')); ?>')">
                <i class="fa fa-file-text"></i>
               Jadwal OPD Normal</a>
        </li>
		 <li class="nav-item <?php echo e(isset($tanggalAbsensiActive) ? $tanggalAbsensiActive : ''); ?>">
            <a class="nav-link"
               href="javascript: loadView('<?php echo e(route('admin.tanggal_absensis.index')); ?>')">
                <i class="fa fa-file-text"></i>
               Periode OPD Normal</a>
        </li>
		
		      <li class="nav-item <?php echo e(isset($holidayActive) ? $holidayActive : ''); ?>">
            <a class="nav-link"
               href="javascript: loadView('<?php echo e(route('admin.holidays.index')); ?>')">
                <i class="fa fa-file-text"></i>
               Libur OPD Normal</a>
        </li>
		
		<hr style="margin: 3px 0px; border-top: 1px solid #32669d;">
		
	  <li class="nav-item <?php echo e(isset($NormalshiftabsensiActive) ? $NormalshiftabsensiActive : ''); ?>">
            <a class="nav-link"
               href="javascript: loadView('<?php echo e(route('admin.normalshiftabsensis.index')); ?>')">
                <i class="fa fa-file-text"></i>
               Jadwal OPD Shift</a>
        </li>

   
		
	<li class="nav-item <?php echo e(isset($tanggalNormalshiftActive) ? $tanggalNormalshiftActive : ''); ?>">
            <a class="nav-link"
               href="javascript: loadView('<?php echo e(route('admin.tanggal_normalshifts.index')); ?>')">
                <i class="fa fa-file-text"></i>
               Periode OPD Shift</a>
        </li>
	
  
		
		        <li class="nav-item <?php echo e(isset($liburshiftActive) ? $liburshiftActive : ''); ?>">
            <a class="nav-link"
               href="javascript: loadView('<?php echo e(route('admin.liburshifts.index')); ?>')">
                <i class="fa fa-file-text"></i>
               Libur OPD Shift</a>
        </li>
		
		<hr style="margin: 3px 0px; border-top: 1px solid #32669d;">	
		
		
		   <li class="nav-item <?php echo e(isset($golonganPegActive) ? $golonganPegActive : ''); ?>">
            <a class="nav-link"
               href="javascript: loadView('<?php echo e(route('admin.golonganpegs.index')); ?>')">
                <i class="fa fa-file-text"></i>
               Golongan Pegawai</a>
        </li>
		
				   <li class="nav-item <?php echo e(isset($presentAbsensiActive) ? $presentAbsensiActive : ''); ?>">
            <a class="nav-link"
               href="javascript: loadView('<?php echo e(route('admin.presentabsensis.index')); ?>')">
                <i class="fa fa-file-text"></i>
               Presentasi Absen </a>
        </li>
		
			      <li class="nav-item <?php echo e(isset($JadwalshiftActive) ? $JadwalshiftActive : ''); ?>">
            <a class="nav-link"
               href="javascript: loadView('<?php echo e(route('admin.jadwalshifts.index')); ?>')">
                <i class="fa fa-file-text"></i>
               Jadwal Shift</a>
        </li>
		
		
		                 <li class="nav-item <?php echo e(isset($noticeBoardActive) ? $noticeBoardActive : ''); ?>">
            <a class="nav-link"
               href="javascript: loadView('<?php echo e(route('admin.noticeboards.index')); ?>')">
                <i class="fa fa-file-text"></i>
                 Papan Pengumuman</a>
        </li>





    </ul>
</li>

              


<li class="nav-item <?php echo e($fingerprint_MachineActive??''); ?>">
    <a class="nav-link"
       href="javascript: loadView('<?php echo e(route('admin.fingerprint_machines.index')); ?>')">
        <i class="fa fa-file-text"></i>
       Data IP</a>
</li>

           <?php if(admin()->unikid =='1'): ?>
 <li class="menu-dropdown classic-menu-dropdown <?php echo e(isset($absMenuActive) ? $absMenuActive : ''); ?>">
                                <a href="javascript:;">
                                    <i class="fa fa-list-alt"></i> Data Superadmin
                                    <i class="fa fa-angle-down"></i>
                                </a>
                                <ul class="dropdown-menu pull-left">
                 
        
         
        <li class="nav-item <?php echo e(isset($DataKetActive) ? $DataKetActive : ''); ?>">
                                            <a class="nav-link"
                                               href="javascript: loadView('<?php echo e(route('admin.leave_applicationsadmin.index')); ?>')">
                                    <i class="fa fa-check"></i>
                                                <span class="title">Tambah Keterangan</span>
                                                <span class="selected "></span>
                                            </a>

                                    </li>

        <li class="nav-item <?php echo e(isset($attendancesOpen) ? $attendancesOpen : ''); ?>">
                                            <a class="nav-link"
                                               href="javascript: loadView('<?php echo e(route('admin.kehadiranadmin.index')); ?>')">
                                    <i class="fa fa-check"></i>
                                                <span class="title">Tambah Hadir (ASN)</span>
                                                <span class="selected "></span>
                                            </a>

                                    </li>    

									<li class="nav-item <?php echo e(isset($attendancesOpenPHL) ? $attendancesOpenPHL : ''); ?>">
                                            <a class="nav-link"
                                               href="javascript: loadView('<?php echo e(route('admin.kehadiranadminphl.index')); ?>')">
                                    <i class="fa fa-check"></i>
                                                <span class="title">Tambah Hadir (PHL)</span>
                                                <span class="selected "></span>
                                            </a>

                                    </li>

             
                                </ul>
 </li>
      <?php endif; ?>        




<li class="nav-item <?php echo e($generalSettingActive??''); ?>">
    <a class="nav-link"
      href="javascript: loadView('<?php echo e(route('admin.settings.edit','setting')); ?>')">
        <i class="fa  fa-cog"></i>
      Pengaturan Absensi</a>
</li>



<?php /**PATH C:\xampp\htdocs\newabsen\resources\views/admin/include/superadmin_menu.blade.php ENDPATH**/ ?>