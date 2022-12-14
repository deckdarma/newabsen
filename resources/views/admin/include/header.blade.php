<!-- BEGIN HEADER -->


<div class="page-header navbar navbar-fixed-top">
    <!-- BEGIN HEADER INNER -->
    <div class="page-header-inner">
        <!-- BEGIN LOGO -->
        <div class="page-logo">
            <a href="javascript:;">
                @if(admin()->type =='admin')
                    <img src="{{ $loggedAdmin->company->logo_image_url }}" height="50px">
                @else
                    <img src="{{ $setting->logo_image_url }}" height="50px">
                @endif

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
                             @if(admin()->type =='admin')
	
	   @else
				 <a style="margin-top:12px;" href=""
                                               onclick="LihatTampilanAPP();return false;" class="btn btn-sm dropdown-toggle btn-outline">
                        <span class=""><strong>Lihat Tampilan Absen</strong> <i
                                    class="fa fa-arrow-right"></i> </span>
                    
                    </a>
					
				
						   
					     @endif
                </div>
        </div>
        <!-- BEGIN TOP NAVIGATION MENU -->

        <div class="page-top">
            <div class="top-menu">

                <ul class="nav navbar-nav pull-right">
                    @if ($loggedAdmin->company && $loggedAdmin->company->license_expired != 1)
                        @if(isset($pending_applications))
                            <li class="dropdown dropdown-extended dropdown-notification" id="header_notification_bar">
                                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"
                                   data-hover="dropdown" data-close-others="true">
                                    <i class="icon-bell"></i>

                                    @if(count($pending_applications))
                                        <span class="badge badge-default">
											{{count($pending_applications)}}
                            </span>
                                    @endif

                                </a>


                                <ul class="dropdown-menu">
                                    <li class="external">
                                        <h3><span class="bold">{{count($pending_applications)}} Tertunda</span>
                                            Pemberitahuan</h3>

                                    </li>
                                    @if(count($pending_applications))
                                        <li>
                                            <ul class="dropdown-menu-list scroller" style="height: 250px;"
                                                data-handle-color="#637283">
                                                @forelse($pending_applications as $pending)
                                                    <li>
                                                        <a data-toggle="modal" href="#static_leave_requests"
                                                           onclick="show_application_notification({{ $pending->id }});return false;">
                                                            <span class="time">{{date('d-M-Y',strtotime($pending->created_at))}}</span>
                                                            <span class="details">
                									<span class="label label-sm label-icon label-success">
                									<i class="fa fa-bell-o"></i>
                									</span>
                									 <strong></strong>Membahkan Keterangan = {{ $pending->leaveType }} @if(!isset($pending->end_date))
                                                                  Pada  {{date('d-M-Y',strtotime($pending->start_date))}}
                                                                @else
                                                                 Pada   {{date('d-M-Y',strtotime($pending->start_date))}}
                                                                    s/d  {{date('d-M-Y',strtotime($pending->end_date))}}
                                                                @endif
                                                    </span>
                                                        </a>
                                                    </li>
                                                @empty
                                                    <li>
                                                    </li>
                                                @endforelse


                                            </ul>
                                        </li>
                                    @endif
                                </ul>
                            </li>
                        @endif
                    @endif
                    {{--Company--}}

                    <li class="dropdown dropdown-user">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown"
                           data-close-others="true">


                                <span class="username hidden-sm hidden-xs">
                  {{ $loggedAdmin->name }}  </span>
                            <i class="fa fa-angle-down"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-default">
                            <li>
                                <a href="{{route(admin()->type.'.profile_settings.edit')}}">
                                    <i class="icon-user"></i> Pengaturan Akun</a>
                            </li>

                            <li class="divider">
                            </li>
                   
                            <li>
                                <a href="{{ URL::route('admin.logout') }} " id="logout-form">
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
                    @if($loggedAdmin->type=='superadmin')
                        @include('admin.include.superadmin_menu')

                    @endif
                    {{--SHOW IF THERE IS COMPANY IN DATABASE--}}
                    @if(isset($loggedAdmin->company) && $loggedAdmin->type !=='superadmin')
                        @if ($loggedAdmin->company->license_expired  == 0)
                            {{---------------------------------------Dashboard-------------------------------}}
                            <li class="nav-item  @if($loggedAdmin->type=='admin')start @endif {{ isset($dashboardActive) ? $dashboardActive : ''}}">
                                <a class="nav-link" href="{{URL::to('admin')}}">
                                    <i class="icon-home"></i>
                                    <span class="title">Beranda</span>
                                    <span class="selected"></span>
                                </a>
                            </li>
                            {{---------------------------------------/Dashboard-------------------------------}}

                            <li class="menu-dropdown classic-menu-dropdown {{ isset($peopleMenuActive) ? $peopleMenuActive : '' }}">
                                <a href="javascript:;">
                                    <i class="fa fa-bank"></i> @lang('menu.people')
                                    <i class="fa fa-angle-down"></i>
                                </a>
                                <ul class="dropdown-menu pull-left">
               
                                        <li class="nav-item {{ isset($departmentActive) ? $departmentActive : ''}}">
                                            <a class="nav-link"
                                               href="{{route('admin.departments.index')}}">
                                                <i class="fa fa-briefcase"></i>
                                                <span class="title">{{__('menu.department')}}</span>
                                                <span class="selected"></span>
                                            </a>

                                        </li>
                                
                                    <li class="nav-item {{ isset($employeesActive) ? $employeesActive : ''}}">
                                        <a class="nav-link"
                                           href="{{route('admin.employees.index')}}">
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
									
									
									<li class="nav-item {{ isset($MutasiActive) ? $MutasiActive : ''}}">
                                        <a class="nav-link"
                                           href="{{route('admin.datamutasi.terima')}}">
                                            <i class="fa fa-arrow-right"></i>
                                            <span class="title">Mutasi Masuk 
@if($mutasimasuk == 0) @else
<span style="
    background: #136c08;
    padding: 0px 5px;
    border-radius: 3px !important;
">{{ $mutasimasuk }}</span></span>

@endif
                                            <span class="selected"></span>

                                        </a>
                                    </li>	
									
									
													<li class="nav-item {{ isset($MutasiKeluarActive) ? $MutasiKeluarActive : ''}}">
                                        <a class="nav-link"
                                           href="{{route('admin.mutasikeluar.index')}}">
                                            <i class="fa  fa-arrow-left"></i>
                                            <span class="title">Mutasi Keluar
@if($mutasikeluar == 0) @else											
<span style="
    background: #136c08;
    padding: 0px 5px;
    border-radius: 3px !important;
">{{ $mutasikeluar }}
</span>	
@endif
											
											</span>
                                            <span class="selected"></span>

                                        </a>
                                    </li>	
									
          <li class="nav-item {{ isset($dataPemimpinActive) ? $dataPemimpinActive : ''}}">
                                        <a class="nav-link"
                                           href="{{route('admin.datapemimpins.index')}}">
                                            <i class="fa fa-sitemap"></i>
                                            <span class="title">Data Kepemimpinan</span>
                                            <span class="selected"></span>

                                        </a>
                                    </li>
									
						
                                </ul>
                            </li>        


			
			
			               @if($loggedAdmin->company->datashift==1)

			   <li class="menu-dropdown classic-menu-dropdown {{ isset($shifMenuActive) ? $shifMenuActive : '' }}">
                                <a href="javascript:;">
                                    <i class="fa fa-list-alt"></i> Data Shift
                                    <i class="fa fa-angle-down"></i>
                                </a>
                        <ul class="dropdown-menu pull-left">
                 

                                   			
									   <li class="nav-item {{ isset($datashiftOpen) ? $datashiftOpen : ''}}">
                                            <a class="nav-link"
                                               href="{{route('admin.datashifts.create')}}">
                                                <i class="fa  fa-calendar-o"></i>
                                                Jadwal Shift</a>
                                        </li>
										
                           		   <li class="nav-item {{ isset($phldatashifMenuActive) ? $phldatashifMenuActive : ''}}">
                                            <a class="nav-link"
                                               href="{{route('admin.phlharianshift.lihatdata')}}">
                                                <i class="fa  fa-calendar"></i>
                                                Laporan Harian  Shift</a>
                                        </li>
										
										
											   <li class="nav-item {{ isset($LaporanhiftOpenpeg) ? $LaporanhiftOpenpeg : ''}}">
                                            <a class="nav-link"
                                               href="{{route('admin.datashift.laporanpeg')}}">
                                                <i class="fa  fa-clipboard"></i>
                                                Laporan Pegawai Shift</a>
                                        </li>
										
													   <li class="nav-item {{ isset($LaporanbulhiftOpenpeg) ? $LaporanbulhiftOpenpeg : ''}}">
                                            <a class="nav-link"
                                               href="{{route('admin.asnharianshift.index')}}">
                                                <i class="fa  fa-server"></i>
                                                Laporan Bulanan Shift</a>
                                        </li>
										
									
                                </ul>
                            </li>
          @endif
			
			
			


                            <li class="menu-dropdown classic-menu-dropdown {{ isset($hrMenuActive) ? $hrMenuActive : '' }}">
                                <a href="javascript:;">
                                    <i class="fa fa-list-alt"></i> Data Rekap
                                    <i class="fa fa-angle-down"></i>
                                </a>
                                <ul class="dropdown-menu pull-left">
                 
        
                             
                                        {{---------------------------------------Payroll -------------------------------}}
                                        <li class="nav-item {{ isset($payrollActive) ? $payrollActive : ''}}">
                                            <a class="nav-link"
                                               href="{{route('admin.payrolls.index')}}">
                                    <i class="fa fa-edit"></i>
                                                <span class="title">Catat Kinerja</span>
                                                <span class="selected "></span>
                                            </a>

                                        </li>
                              
									@if($loggedAdmin->company->datashift==1)
	
									
										   		   <li class="nav-item {{ isset($shitkinerjaActive) ? $shitkinerjaActive : ''}}">
                                            <a class="nav-link"
                                               href="{{route('admin.shitkinerjas.index')}}">
                                                <i class="fa   fa-edit"></i>
                                                Catat Kinerja Shift</a>
                                        </li>
             
									@endif
                                
                                        {{---------------------------------------Payroll -------------------------------}}
                                        <li class="nav-item {{ isset($viewPrintRekapActive) ? $viewPrintRekapActive : ''}}">
                                            <a class="nav-link"
                                               href="{{route('admin.printrekap.index')}}">
                                    <i class="fa fa-print"></i>
                                                <span class="title">Print Rekap TPP</span>
                                                <span class="selected "></span>
                                            </a>

                                        </li>
                                
									
									
									        @if($loggedAdmin->type=='superadmin' || $loggedAdmin->company->payroll_feature==1)
                                        {{---------------------------------------Payroll -------------------------------}}
                                        <li class="nav-item {{ isset($viewPrintRekapphlActive) ? $viewPrintRekapphlActive : ''}}">
                                            <a class="nav-link"
                                               href="{{route('admin.printrekapphl.index')}}">
                                    <i class="fa fa-print"></i>
                                                <span class="title">Print Rekap Honor</span>
                                                <span class="selected "></span>
                                            </a>

                                        </li>
                                    @endif
									

                                    {{---------------------------------------/Payroll-------------------------------}}


             
                                </ul>
                            </li>














       <li class="menu-dropdown classic-menu-dropdown {{ isset($varMenuActive) ? $varMenuActive : '' }}">
                                <a href="javascript:;">
                                    <i class="fa fa-bullhorn"></i> Variabel Absensi
                                    <i class="fa fa-angle-down"></i>
                                </a>
                                <ul class="dropdown-menu pull-left">
                 

		          <li class="nav-item {{ isset($viewDataApelActive) ? $viewDataApelActive : ''}}">
                                            <a class="nav-link"
                                               href="{{route('admin.dataapel.create')}}">
                                                <i class="fa   fa-black-tie"></i>
                                                Data Apel</a>
                                        </li>
										


                                   			
							
                          
                 
                                            {{---------------------------------------Leave Applications-------------------------------}}
                                            <li class="nav-item {{ isset($leaveApplicationOpen) ? $leaveApplicationOpen : ''}}">
                                                <a class="nav-link"
                                                   href="{{route('admin.leave_applications.index')}}">
                                                    <i class="fa  fa-book"></i>
                                                    <span class="title">{{__('menu.leaveApplication')}}</span>
                                                    <span class="selected "></span>
                                                </a>

                                            </li>
                                  

                                        {{---------------------------------------/Leave Applications-------------------------------}}

             
                                </ul>
                            </li>







                            @if($loggedAdmin->type=='superadmin' || $loggedAdmin->company->attendance_feature==1)
                                {{---------------------------------------Attendance-------------------------------}}
                                <li class="menu-dropdown classic-menu-dropdown {{ isset($attendanceOpen) ? $attendanceOpen : '' }}">
                                    <a href="javascript:;" class="nav-link nav-toggle">
                                        <i class="fa  fa-database"></i>
                                        <span class="title">Laporan Absensi</span>
                                        <i class="fa fa-angle-down"></i>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li class="nav-item {{ isset($markAttendanceActive) ? $markAttendanceActive : ''}}">
                                            <a class="nav-link"
                                               href="{{route('admin.attendances.create')}}">
                                                <i class="fa  fa-calendar"></i>
                                                {{__('menu.markAttendance')}}</a>
                                        </li>
										
										@if($loggedAdmin->company->datashift==1)	
		<li class="nav-item {{ isset($viewPegawaiActive) ? $viewPegawaiActive : ''}}">
                                            <a class="nav-link"
                                               href="{{route('admin.laporannonshifpegawai.create')}}">
                                                <i class="fa  fa-clipboard"></i>
                                                Laporan Pegawai</a>
                                        </li>

@else
		<li class="nav-item {{ isset($viewPegawaiActive) ? $viewPegawaiActive : ''}}">
                                            <a class="nav-link"
                                               href="{{route('admin.laporanpegawai.create')}}">
                                                <i class="fa  fa-clipboard"></i>
                                                Laporan Pegawai</a>
                                        </li>
@endif
										
										
								
                                        <li class="nav-item {{ isset($viewAttendanceActive) ? $viewAttendanceActive : ''}}">
                                            <a class="nav-link"
                                               href="{{route('admin.attendances.index')}}">
                                                <i class="fa  fa-server"></i>
                                                {{__('menu.viewAttendance')}}</a>
                                        </li>
										
									
										
							
                                    </ul>
                                </li>
                            @endif

                            {{---------------------------------------/Attendance-------------------------------}}





                        @endif
                        {{---------------------------------------Company Settings-------------------------------}}
                        <li class="menu-dropdown classic-menu-dropdown {{ isset($csettingOpen) ? $csettingOpen : ''}}">
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <i class="icon-settings"></i>
                                <span class="title">Pengaturan</span>
                               
                                    <i class="fa fa-angle-down"></i>
                               
                            </a>
                            <ul class="dropdown-menu pull-left">

                   
                                @if($loggedAdmin->company->license_expired == 0)
                                    @if($loggedAdmin->type!='superadmin')
                                        @if($loggedAdmin->manager!=1)
                                            <li class="nav-item {{ isset($csettingActive) ? $csettingActive : ''}}">
                                                <a class="nav-link"
                                                   href="{{ route('admin.general_setting.edit')}}">
                                                    <i class="fa  fa-cog"></i>
                                                   Pengaturan Utama</a>
                                            </li>
                                        @endif
                                    @endif

                                    @if($loggedAdmin->type!='superadmin')
                                        <li class="nav-item {{ isset($profileSettingActive) ? $profileSettingActive : ''}}">
                                            <a class="nav-link"
                                               href="{{route('admin.profile_settings.edit','profile')}}')">
                                                <i class="fa fa-user"></i>
                                               Pengaturan Akun</a>
                                        </li>
                                    @endif

                      
                                @endif
                            </ul>
                        </li>

	@if($loggedAdmin->company->datashift==1)
         <li class="menu-dropdown classic-menu-dropdown {{ isset($csettingOpenss) ? $csettingOpenss : ''}}">
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <i class="fa fa-laptop"></i>
                                <span class="title">Tampilan</span>
                               
                                    <i class="fa fa-angle-down"></i>
                               
                            </a>
                            <ul class="dropdown-menu pull-left">
			<li class="nav-item ">
                                                <a class="nav-link" target="_blank"
                                                   href="http://172.107.10.22/mesintarik/public/nonshift/{{ $loggedAdmin->company->id }}/lihat">
                                                    <i class="fa fa-laptop"></i>
                                                   Non Shift</a>
                                            </li>
                       
                           			<li class="nav-item ">
                                                <a class="nav-link" target="_blank"
                                                   href="http://172.107.10.22/mesintarik/public/pagi/{{ $loggedAdmin->company->id }}/lihat">
                                                    <i class="fa fa-laptop"></i>
                                                   Shift Pagi</a>
                                            </li>
											
												<li class="nav-item ">
                                                <a class="nav-link" target="_blank"
                                                   href="http://172.107.10.22/mesintarik/public/siang/{{ $loggedAdmin->company->id }}/lihat">
                                                    <i class="fa fa-laptop"></i>
                                                   Shift Sore</a>
                                            </li>
                               
							   
							   											<li class="nav-item ">
                                                <a class="nav-link" target="_blank"
                                                   href="http://172.107.10.22/mesintarik/public/malam/{{ $loggedAdmin->company->id }}/lihat">
                                                    <i class="fa fa-laptop"></i>
                                                   Shift Malam</a>
                                            </li>

                            </ul>
                        </li>

@else
	
<li class="nav-item {{ $fingerprint_MachineActive??''}}">
    <a class="nav-link" target="_blank"
       href="http://172.107.10.22/mesintarik/public/tampilan/{{ $loggedAdmin->company->id }}/lihat">
        <i class="fa fa-laptop"></i>
       Tampilan</a>
</li>
 @endif
 
                    @endif
                    {{--SHOW IF ANY COMPANY IN DATABASE--}}
                </ul>
            </div>
            <!-- END MEGA MENU -->
        </div>
    </div>
</div>
<!-- END HEADER -->


{{--Leave Application view MODALS--}}
{!! Form::open(['url'=>'','id'=>'edit_form_leave','method'=>'PATCH']) !!}
<div id="static_leave_requests" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content" id="modal-data-leave">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <span class="caption-subject font-red-sunglo bold uppercase">Leave Application</span>
            </div>
            <div class="modal-body" id="load-data">
                {{--Ajax data call for form--}}
            </div>
        </div>

    </div>
</div>
{!!   Form::close() !!}
{{--Leave Modal Close--}}
{{--Screen Lock Modal Start--}}
<div id="static_screen_lock" class="modal fade" tabindex="-1" style="z-index: 999999;" data-backdrop="static"
     data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content" id="modal-data-leave">
            <div class="modal-header">
                <center>
                    <div class="reg-block-header">
                        <h2><img src="{{$setting->logo_image_url}}" height="50px"></h2>
                    </div>
                </center>
                <h2 class="text-center">{{ $loggedAdmin->name}}</h2>
                <h5 class="email text-center">
                    {{ $loggedAdmin->email}} </h5>
                   <h5 class="locked text-center"><strong>Admin Sudah di Kunci</strong></h5><br/>
            </div>
            <div class="modal-body" id="load-data">
                {!!  Form::open(array('url' => '','class' =>'form'))  !!}
                <div id='alert'></div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-md-8 col-md-offset-2">
                            <div class="input-group margin-bottom-20">
                                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                <input type="password" class="form-control" name="password" placeholder="Password"
                                       id="password">
                                <input type="hidden" class="form-control" name="email" value="{{ $loggedAdmin->email}}">
                                <span class="input-group-btn">
                                    <button type="submit" class="btn red" onclick="loginCheck();return false;"
                                            id="submitbutton" style="margin-left: 5px;"><i
                                                class="fa fa-arrow-circle-right"></i></button>
                                </span>
                            </div>
                            <!-- /input-group -->
                            <div class="relogin text-center">
                                <a href="{{ URL::to('admin/logout')}}">
                                    Bukan <strong>{{ $loggedAdmin->name}}</strong>? </a>
                            </div>
                        </div>
                    </div>


                </div>
                {!!  Form::close() !!}
            </div>
        </div>

    </div>
</div>
{{--Screen Lock Modal End--}}

<script>
    function show_application_notification(id) {
        $("#load-data").html('<div class="text-center">{!! HTML::image('assets/loader.gif') !!}</div>');
        $('#edit_form_leave').attr('action', "{!! URL::to('admin/leave_applications/"+id+"') !!}");
        $.ajax({
            type: "GET",
            url: "{!!  URL::to('admin/leave_applications/"+id+"')  !!}"

        }).done(function (response) {
            $('#modal-data-leave').html(response);
//
        });
    }

    function changeLanguage(lang) {
        $.ajax({
            type: 'GET',
            url: "{{route('admin.change_language')}}",
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
            url: "{{route('admin.change_company')}}",
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
