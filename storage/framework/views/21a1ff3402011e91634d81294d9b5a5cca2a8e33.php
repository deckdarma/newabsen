<!-- BEGIN HEADER -->


<div class="page-header navbar navbar-fixed-top">
    <!-- BEGIN HEADER INNER -->
    <div class="page-header-inner">
        <!-- BEGIN LOGO -->
        <div class="page-logo">
            <a href="javascript:;">
                <?php if(admin()->type =='admin'): ?>
                    <img src="<?php echo e($loggedAdmin->company->logo_image_url); ?>" height="50px">
                <?php else: ?>
                    <img src="<?php echo e($setting->logo_image_url); ?>" height="50px">
                <?php endif; ?>

            </a>
            <div class="menu-toggler sidebar-toggler">
                <!-- DOC: Remove the above "hide" to enable the sidebar toggler button on header -->
            </div>
        </div>
        <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse"
           data-target=".navbar-collapse"> </a>
        <!-- END LOGO -->
        <div class="page-actions hidden-xs">
          <div class="btn-group hidden-sm hidden-xs" style="margin-top: -5px;">
                             <?php if(admin()->type =='admin'): ?>
	
	   <?php else: ?>
				 <a style="margin-top:12px;" href=""
                                               onclick="LihatTampilanAPP();return false;" class="btn btn-sm dropdown-toggle btn-outline">
                        <span class=""><strong>Lihat Tampilan Absen</strong> <i
                                    class="fa fa-arrow-right"></i> </span>
                    
                    </a>
					
				
						   
					     <?php endif; ?>
                </div>
        </div>
        <!-- BEGIN TOP NAVIGATION MENU -->

        <div class="page-top">
            <div class="top-menu">

                <ul class="nav navbar-nav pull-right">
                    <?php if($loggedAdmin->company && $loggedAdmin->company->license_expired != 1): ?>
                        <?php if(isset($pending_applications)): ?>
                            <li class="dropdown dropdown-extended dropdown-notification" id="header_notification_bar">
                                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"
                                   data-hover="dropdown" data-close-others="true">
                                    <i class="icon-bell"></i>

                                    <?php if(count($pending_applications)): ?>
                                        <span class="badge badge-default">
											<?php echo e(count($pending_applications)); ?>

                            </span>
                                    <?php endif; ?>

                                </a>


                                <ul class="dropdown-menu">
                                    <li class="external">
                                        <h3><span class="bold"><?php echo e(count($pending_applications)); ?> Tertunda</span>
                                            Pemberitahuan</h3>

                                    </li>
                                    <?php if(count($pending_applications)): ?>
                                        <li>
                                            <ul class="dropdown-menu-list scroller" style="height: 250px;"
                                                data-handle-color="#637283">
                                                <?php $__empty_1 = true; $__currentLoopData = $pending_applications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pending): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                                    <li>
                                                        <a data-toggle="modal" href="#static_leave_requests"
                                                           onclick="show_application_notification(<?php echo e($pending->id); ?>);return false;">
                                                            <span class="time"><?php echo e(date('d-M-Y',strtotime($pending->created_at))); ?></span>
                                                            <span class="details">
                									<span class="label label-sm label-icon label-success">
                									<i class="fa fa-bell-o"></i>
                									</span>
                									 <strong></strong>Membahkan Keterangan = <?php echo e($pending->leaveType); ?> <?php if(!isset($pending->end_date)): ?>
                                                                  Pada  <?php echo e(date('d-M-Y',strtotime($pending->start_date))); ?>

                                                                <?php else: ?>
                                                                 Pada   <?php echo e(date('d-M-Y',strtotime($pending->start_date))); ?>

                                                                    s/d  <?php echo e(date('d-M-Y',strtotime($pending->end_date))); ?>

                                                                <?php endif; ?>
                                                    </span>
                                                        </a>
                                                    </li>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                                    <li>
                                                    </li>
                                                <?php endif; ?>


                                            </ul>
                                        </li>
                                    <?php endif; ?>
                                </ul>
                            </li>
                        <?php endif; ?>
                    <?php endif; ?>
                    

                    <li class="dropdown dropdown-user">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown"
                           data-close-others="true">


                                <span class="username hidden-sm hidden-xs">
                  <?php echo e($loggedAdmin->name); ?>  </span>
                            <i class="fa fa-angle-down"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-default">
                            <li>
                                <a href="<?php echo e(route(admin()->type.'.profile_settings.edit')); ?>">
                                    <i class="icon-user"></i> Pengaturan Akun</a>
                            </li>

                            <li class="divider">
                            </li>
                   
                            <li>
                                <a href="<?php echo e(URL::route('admin.logout')); ?> " id="logout-form">
                                    <i class="icon-logout"></i> Keluar / Logout </a>
                            </li>
                        </ul>
                    </li>
                    <!-- END USER LOGIN DROPDOWN -->

                </ul>
            </div>
        </div>
        <!-- END TOP NAVIGATION MENU -->
    </div>
    <!-- END HEADER INNER -->
    <div class="page-header-menu">
        <div class="container-fluid">
            <!-- END HEADER SEARCH BOX -->
            <!-- BEGIN MEGA MENU -->
            <!-- DOC: Apply "hor-menu-light" class after the "hor-menu" class below to have a horizontal menu with white background -->
            <!-- DOC: Remove data-hover="dropdown" and data-close-others="true" attributes below to disable the dropdown opening on mouse hover -->
            <div class="hor-menu ">
                <ul class="nav navbar-nav">
                    <?php if($loggedAdmin->type=='superadmin'): ?>
                        <?php echo $__env->make('admin.include.superadmin_menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                    <?php endif; ?>
                    
                    <?php if(isset($loggedAdmin->company) && $loggedAdmin->type !=='superadmin'): ?>
                        <?php if($loggedAdmin->company->license_expired  == 0): ?>
                            
                            <li class="nav-item  <?php if($loggedAdmin->type=='admin'): ?>start <?php endif; ?> <?php echo e(isset($dashboardActive) ? $dashboardActive : ''); ?>">
                                <a class="nav-link" href="<?php echo e(URL::to('admin')); ?>">
                                    <i class="icon-home"></i>
                                    <span class="title">Beranda</span>
                                    <span class="selected"></span>
                                </a>
                            </li>
                            

                            <li class="menu-dropdown classic-menu-dropdown <?php echo e(isset($peopleMenuActive) ? $peopleMenuActive : ''); ?>">
                                <a href="javascript:;">
                                    <i class="fa fa-bank"></i> <?php echo app('translator')->get('menu.people'); ?>
                                    <i class="fa fa-angle-down"></i>
                                </a>
                                <ul class="dropdown-menu pull-left">
               
                                        <li class="nav-item <?php echo e(isset($departmentActive) ? $departmentActive : ''); ?>">
                                            <a class="nav-link"
                                               href="<?php echo e(route('admin.departments.index')); ?>">
                                                <i class="fa fa-briefcase"></i>
                                                <span class="title"><?php echo e(__('menu.department')); ?></span>
                                                <span class="selected"></span>
                                            </a>

                                        </li>
                                
                                    <li class="nav-item <?php echo e(isset($employeesActive) ? $employeesActive : ''); ?>">
                                        <a class="nav-link"
                                           href="<?php echo e(route('admin.employees.index')); ?>">
                                            <i class="fa fa-group"></i>
                                            <span class="title">Pegawai ASN/PHL</span>
                                            <span class="selected"></span>

                                        </a>
                                    </li>
											
	<?php 
$caricompanyid = $loggedAdmin->company_id;
$mutasimasuk = count(DB::select(DB::raw("SELECT * FROM employees WHERE company_id='".$caricompanyid."' AND mutasi='1'"))); 
$mutasikeluar = count(DB::select(DB::raw("SELECT * FROM employees WHERE darimutasi='".$caricompanyid."' AND mutasi='1'"))); 

?>
									
									
									<li class="nav-item <?php echo e(isset($MutasiActive) ? $MutasiActive : ''); ?>">
                                        <a class="nav-link"
                                           href="<?php echo e(route('admin.datamutasi.terima')); ?>">
                                            <i class="fa fa-arrow-right"></i>
                                            <span class="title">Mutasi Masuk 
<?php if($mutasimasuk == 0): ?> <?php else: ?>
<span style="
    background: #136c08;
    padding: 0px 5px;
    border-radius: 3px !important;
"><?php echo e($mutasimasuk); ?></span></span>

<?php endif; ?>
                                            <span class="selected"></span>

                                        </a>
                                    </li>	
									
									
													<li class="nav-item <?php echo e(isset($MutasiKeluarActive) ? $MutasiKeluarActive : ''); ?>">
                                        <a class="nav-link"
                                           href="<?php echo e(route('admin.mutasikeluar.index')); ?>">
                                            <i class="fa  fa-arrow-left"></i>
                                            <span class="title">Mutasi Keluar
<?php if($mutasikeluar == 0): ?> <?php else: ?>											
<span style="
    background: #136c08;
    padding: 0px 5px;
    border-radius: 3px !important;
"><?php echo e($mutasikeluar); ?>

</span>	
<?php endif; ?>
											
											</span>
                                            <span class="selected"></span>

                                        </a>
                                    </li>	
									
          <li class="nav-item <?php echo e(isset($dataPemimpinActive) ? $dataPemimpinActive : ''); ?>">
                                        <a class="nav-link"
                                           href="<?php echo e(route('admin.datapemimpins.index')); ?>">
                                            <i class="fa fa-sitemap"></i>
                                            <span class="title">Data Kepemimpinan</span>
                                            <span class="selected"></span>

                                        </a>
                                    </li>
									
						
                                </ul>
                            </li>        


			
			
			               <?php if($loggedAdmin->company->datashift==1): ?>

			   <li class="menu-dropdown classic-menu-dropdown <?php echo e(isset($shifMenuActive) ? $shifMenuActive : ''); ?>">
                                <a href="javascript:;">
                                    <i class="fa fa-list-alt"></i> Data Shift
                                    <i class="fa fa-angle-down"></i>
                                </a>
                        <ul class="dropdown-menu pull-left">
                 

                                   			
									   <li class="nav-item <?php echo e(isset($datashiftOpen) ? $datashiftOpen : ''); ?>">
                                            <a class="nav-link"
                                               href="<?php echo e(route('admin.datashifts.create')); ?>">
                                                <i class="fa  fa-calendar-o"></i>
                                                Jadwal Shift</a>
                                        </li>
										
                           		   <li class="nav-item <?php echo e(isset($phldatashifMenuActive) ? $phldatashifMenuActive : ''); ?>">
                                            <a class="nav-link"
                                               href="<?php echo e(route('admin.phlharianshift.lihatdata')); ?>">
                                                <i class="fa  fa-calendar"></i>
                                                Laporan Harian  Shift</a>
                                        </li>
										
										
											   <li class="nav-item <?php echo e(isset($LaporanhiftOpenpeg) ? $LaporanhiftOpenpeg : ''); ?>">
                                            <a class="nav-link"
                                               href="<?php echo e(route('admin.datashift.laporanpeg')); ?>">
                                                <i class="fa  fa-clipboard"></i>
                                                Laporan Pegawai Shift</a>
                                        </li>
										
													   <li class="nav-item <?php echo e(isset($LaporanbulhiftOpenpeg) ? $LaporanbulhiftOpenpeg : ''); ?>">
                                            <a class="nav-link"
                                               href="<?php echo e(route('admin.asnharianshift.index')); ?>">
                                                <i class="fa  fa-server"></i>
                                                Laporan Bulanan Shift</a>
                                        </li>
										
									
                                </ul>
                            </li>
          <?php endif; ?>
			
			
			


                            <li class="menu-dropdown classic-menu-dropdown <?php echo e(isset($hrMenuActive) ? $hrMenuActive : ''); ?>">
                                <a href="javascript:;">
                                    <i class="fa fa-list-alt"></i> Data Rekap
                                    <i class="fa fa-angle-down"></i>
                                </a>
                                <ul class="dropdown-menu pull-left">
                 
        
                             
                                        
                                        <li class="nav-item <?php echo e(isset($payrollActive) ? $payrollActive : ''); ?>">
                                            <a class="nav-link"
                                               href="<?php echo e(route('admin.payrolls.index')); ?>">
                                    <i class="fa fa-edit"></i>
                                                <span class="title">Catat Kinerja</span>
                                                <span class="selected "></span>
                                            </a>

                                        </li>
                              
									<?php if($loggedAdmin->company->datashift==1): ?>
	
									
										   		   <li class="nav-item <?php echo e(isset($shitkinerjaActive) ? $shitkinerjaActive : ''); ?>">
                                            <a class="nav-link"
                                               href="<?php echo e(route('admin.shitkinerjas.index')); ?>">
                                                <i class="fa   fa-edit"></i>
                                                Catat Kinerja Shift</a>
                                        </li>
             
									<?php endif; ?>
                                
                                        
                                        <li class="nav-item <?php echo e(isset($viewPrintRekapActive) ? $viewPrintRekapActive : ''); ?>">
                                            <a class="nav-link"
                                               href="<?php echo e(route('admin.printrekap.index')); ?>">
                                    <i class="fa fa-print"></i>
                                                <span class="title">Print Rekap TPP</span>
                                                <span class="selected "></span>
                                            </a>

                                        </li>
                                
									
									
									        <?php if($loggedAdmin->type=='superadmin' || $loggedAdmin->company->payroll_feature==1): ?>
                                        
                                        <li class="nav-item <?php echo e(isset($viewPrintRekapphlActive) ? $viewPrintRekapphlActive : ''); ?>">
                                            <a class="nav-link"
                                               href="<?php echo e(route('admin.printrekapphl.index')); ?>">
                                    <i class="fa fa-print"></i>
                                                <span class="title">Print Rekap Honor</span>
                                                <span class="selected "></span>
                                            </a>

                                        </li>
                                    <?php endif; ?>
									

                                    


             
                                </ul>
                            </li>














       <li class="menu-dropdown classic-menu-dropdown <?php echo e(isset($varMenuActive) ? $varMenuActive : ''); ?>">
                                <a href="javascript:;">
                                    <i class="fa fa-bullhorn"></i> Variabel Absensi
                                    <i class="fa fa-angle-down"></i>
                                </a>
                                <ul class="dropdown-menu pull-left">
                 

		          <li class="nav-item <?php echo e(isset($viewDataApelActive) ? $viewDataApelActive : ''); ?>">
                                            <a class="nav-link"
                                               href="<?php echo e(route('admin.dataapel.create')); ?>">
                                                <i class="fa   fa-black-tie"></i>
                                                Data Apel</a>
                                        </li>
										


                                   			
							
                          
                 
                                            
                                            <li class="nav-item <?php echo e(isset($leaveApplicationOpen) ? $leaveApplicationOpen : ''); ?>">
                                                <a class="nav-link"
                                                   href="<?php echo e(route('admin.leave_applications.index')); ?>">
                                                    <i class="fa  fa-book"></i>
                                                    <span class="title"><?php echo e(__('menu.leaveApplication')); ?></span>
                                                    <span class="selected "></span>
                                                </a>

                                            </li>
                                  

                                        

             
                                </ul>
                            </li>







                            <?php if($loggedAdmin->type=='superadmin' || $loggedAdmin->company->attendance_feature==1): ?>
                                
                                <li class="menu-dropdown classic-menu-dropdown <?php echo e(isset($attendanceOpen) ? $attendanceOpen : ''); ?>">
                                    <a href="javascript:;" class="nav-link nav-toggle">
                                        <i class="fa  fa-database"></i>
                                        <span class="title">Laporan Absensi</span>
                                        <i class="fa fa-angle-down"></i>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li class="nav-item <?php echo e(isset($markAttendanceActive) ? $markAttendanceActive : ''); ?>">
                                            <a class="nav-link"
                                               href="<?php echo e(route('admin.attendances.create')); ?>">
                                                <i class="fa  fa-calendar"></i>
                                                <?php echo e(__('menu.markAttendance')); ?></a>
                                        </li>
										
										<?php if($loggedAdmin->company->datashift==1): ?>	
		<li class="nav-item <?php echo e(isset($viewPegawaiActive) ? $viewPegawaiActive : ''); ?>">
                                            <a class="nav-link"
                                               href="<?php echo e(route('admin.laporannonshifpegawai.create')); ?>">
                                                <i class="fa  fa-clipboard"></i>
                                                Laporan Pegawai</a>
                                        </li>

<?php else: ?>
		<li class="nav-item <?php echo e(isset($viewPegawaiActive) ? $viewPegawaiActive : ''); ?>">
                                            <a class="nav-link"
                                               href="<?php echo e(route('admin.laporanpegawai.create')); ?>">
                                                <i class="fa  fa-clipboard"></i>
                                                Laporan Pegawai</a>
                                        </li>
<?php endif; ?>
										
										
								
                                        <li class="nav-item <?php echo e(isset($viewAttendanceActive) ? $viewAttendanceActive : ''); ?>">
                                            <a class="nav-link"
                                               href="<?php echo e(route('admin.attendances.index')); ?>">
                                                <i class="fa  fa-server"></i>
                                                <?php echo e(__('menu.viewAttendance')); ?></a>
                                        </li>
										
									
										
							
                                    </ul>
                                </li>
                            <?php endif; ?>

                            





                        <?php endif; ?>
                        
                        <li class="menu-dropdown classic-menu-dropdown <?php echo e(isset($csettingOpen) ? $csettingOpen : ''); ?>">
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <i class="icon-settings"></i>
                                <span class="title">Pengaturan</span>
                               
                                    <i class="fa fa-angle-down"></i>
                               
                            </a>
                            <ul class="dropdown-menu pull-left">

                   
                                <?php if($loggedAdmin->company->license_expired == 0): ?>
                                    <?php if($loggedAdmin->type!='superadmin'): ?>
                                        <?php if($loggedAdmin->manager!=1): ?>
                                            <li class="nav-item <?php echo e(isset($csettingActive) ? $csettingActive : ''); ?>">
                                                <a class="nav-link"
                                                   href="<?php echo e(route('admin.general_setting.edit')); ?>">
                                                    <i class="fa  fa-cog"></i>
                                                   Pengaturan Utama</a>
                                            </li>
                                        <?php endif; ?>
                                    <?php endif; ?>

                                    <?php if($loggedAdmin->type!='superadmin'): ?>
                                        <li class="nav-item <?php echo e(isset($profileSettingActive) ? $profileSettingActive : ''); ?>">
                                            <a class="nav-link"
                                               href="<?php echo e(route('admin.profile_settings.edit','profile')); ?>')">
                                                <i class="fa fa-user"></i>
                                               Pengaturan Akun</a>
                                        </li>
                                    <?php endif; ?>

                      
                                <?php endif; ?>
                            </ul>
                        </li>

	<?php if($loggedAdmin->company->datashift==1): ?>
         <li class="menu-dropdown classic-menu-dropdown <?php echo e(isset($csettingOpenss) ? $csettingOpenss : ''); ?>">
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <i class="fa fa-laptop"></i>
                                <span class="title">Tampilan</span>
                               
                                    <i class="fa fa-angle-down"></i>
                               
                            </a>
                            <ul class="dropdown-menu pull-left">
			<li class="nav-item ">
                                                <a class="nav-link" target="_blank"
                                                   href="http://172.107.10.22/mesintarik/public/nonshift/<?php echo e($loggedAdmin->company->id); ?>/lihat">
                                                    <i class="fa fa-laptop"></i>
                                                   Non Shift</a>
                                            </li>
                       
                           			<li class="nav-item ">
                                                <a class="nav-link" target="_blank"
                                                   href="http://172.107.10.22/mesintarik/public/pagi/<?php echo e($loggedAdmin->company->id); ?>/lihat">
                                                    <i class="fa fa-laptop"></i>
                                                   Shift Pagi</a>
                                            </li>
											
												<li class="nav-item ">
                                                <a class="nav-link" target="_blank"
                                                   href="http://172.107.10.22/mesintarik/public/siang/<?php echo e($loggedAdmin->company->id); ?>/lihat">
                                                    <i class="fa fa-laptop"></i>
                                                   Shift Sore</a>
                                            </li>
                               
							   
							   											<li class="nav-item ">
                                                <a class="nav-link" target="_blank"
                                                   href="http://172.107.10.22/mesintarik/public/malam/<?php echo e($loggedAdmin->company->id); ?>/lihat">
                                                    <i class="fa fa-laptop"></i>
                                                   Shift Malam</a>
                                            </li>

                            </ul>
                        </li>

<?php else: ?>
	
<li class="nav-item <?php echo e($fingerprint_MachineActive??''); ?>">
    <a class="nav-link" target="_blank"
       href="http://172.107.10.22/mesintarik/public/tampilan/<?php echo e($loggedAdmin->company->id); ?>/lihat">
        <i class="fa fa-laptop"></i>
       Tampilan</a>
</li>
 <?php endif; ?>
 
                    <?php endif; ?>
                    
                </ul>
            </div>
            <!-- END MEGA MENU -->
        </div>
    </div>
</div>
<!-- END HEADER -->



<?php echo Form::open(['url'=>'','id'=>'edit_form_leave','method'=>'PATCH']); ?>

<div id="static_leave_requests" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content" id="modal-data-leave">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <span class="caption-subject font-red-sunglo bold uppercase">Leave Application</span>
            </div>
            <div class="modal-body" id="load-data">
                
            </div>
        </div>

    </div>
</div>
<?php echo Form::close(); ?>



<div id="static_screen_lock" class="modal fade" tabindex="-1" style="z-index: 999999;" data-backdrop="static"
     data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content" id="modal-data-leave">
            <div class="modal-header">
                <center>
                    <div class="reg-block-header">
                        <h2><img src="<?php echo e($setting->logo_image_url); ?>" height="50px"></h2>
                    </div>
                </center>
                <h2 class="text-center"><?php echo e($loggedAdmin->name); ?></h2>
                <h5 class="email text-center">
                    <?php echo e($loggedAdmin->email); ?> </h5>
                   <h5 class="locked text-center"><strong>Admin Sudah di Kunci</strong></h5><br/>
            </div>
            <div class="modal-body" id="load-data">
                <?php echo Form::open(array('url' => '','class' =>'form')); ?>

                <div id='alert'></div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-md-8 col-md-offset-2">
                            <div class="input-group margin-bottom-20">
                                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                <input type="password" class="form-control" name="password" placeholder="Password"
                                       id="password">
                                <input type="hidden" class="form-control" name="email" value="<?php echo e($loggedAdmin->email); ?>">
                                <span class="input-group-btn">
                                    <button type="submit" class="btn red" onclick="loginCheck();return false;"
                                            id="submitbutton" style="margin-left: 5px;"><i
                                                class="fa fa-arrow-circle-right"></i></button>
                                </span>
                            </div>
                            <!-- /input-group -->
                            <div class="relogin text-center">
                                <a href="<?php echo e(URL::to('admin/logout')); ?>">
                                    Bukan <strong><?php echo e($loggedAdmin->name); ?></strong>? </a>
                            </div>
                        </div>
                    </div>


                </div>
                <?php echo Form::close(); ?>

            </div>
        </div>

    </div>
</div>


<script>
    function show_application_notification(id) {
        $("#load-data").html('<div class="text-center"><?php echo HTML::image('assets/loader.gif'); ?></div>');
        $('#edit_form_leave').attr('action', "<?php echo URL::to('admin/leave_applications/"+id+"'); ?>");
        $.ajax({
            type: "GET",
            url: "<?php echo URL::to('admin/leave_applications/"+id+"'); ?>"

        }).done(function (response) {
            $('#modal-data-leave').html(response);
//
        });
    }

    function changeLanguage(lang) {
        $.ajax({
            type: 'GET',
            url: "<?php echo e(route('admin.change_language')); ?>",
            dataType: "JSON",
            data: {
                'locale': lang
            },
            success: function (response) {
                if (response.success === 'success') {
                    window.location.reload();
                }

            },
            error: function (xhr, textStatus, thrownError) {

            }
        });
    }

    function changeCompany(com_id) {
        $.ajax({
            type: 'GET',
            url: "<?php echo e(route('admin.change_company')); ?>",
            dataType: "JSON",
            data: {
                'company_id': com_id
            },
            success: function (response) {
                if (response.success === 'success') {
                    window.location.reload();
                }

            },
            error: function (xhr, textStatus, thrownError) {

            }
        });
    }
</script>
<?php /**PATH C:\xampp\htdocs\newabsen\resources\views/admin/include/header.blade.php ENDPATH**/ ?>