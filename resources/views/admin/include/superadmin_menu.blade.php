<li class="nav-item start {{ isset($superadmindashboardActive) ? $superadmindashboardActive : ''}}">
    <a class="nav-link"
       href="javascript: loadView('{{URL::route('superadmin.dashboard.index')}}')">
        <i class="fa fa-home"></i>
        <span class="title">{{__('menu.dashboard')}}</span>
        <span class="selected"></span>
    </a>
</li>
{{---------------------------------------/Super AdminDashboard-------------------------------}}
{{---------------------------------------Companies-------------------------------}}
<li class="nav-item {{ isset($companyActive) ? $companyActive : ''}}">
    <a class="nav-link"
       href="javascript: loadView('{{route('admin.companies.index')}}')">
        <i class="fa fa-bank"></i>
        <span class="title">Data OPD</span>
        <span class="selected "></span>
    </a>
</li>
<li class="nav-item {{ isset($superAdminUserActive) ? $superAdminUserActive : ''}}">
    <a class="nav-link"
       href="javascript: loadView('{{route('admin.superadmin_users.index')}}')">
        <i class="fa fa-user"></i>
        Data Login</a>
</li>









<li class="menu-dropdown classic-menu-dropdown {{ isset($hrMenuActive) ? $hrMenuActive : '' }}">
    <a href="javascript:;">
        <i class="icon-user"></i> Data Absensi
        <i class="fa fa-angle-down"></i>
    </a>
    <ul class="dropdown-menu pull-left">

        <li class="nav-item {{ isset($leaveTypeActive) ? $leaveTypeActive : ''}}">
            <a class="nav-link"
               href="javascript: loadView('{{route('admin.leavetypes.index')}}')">
                <i class="fa fa-file-text"></i>
                 {{__('menu.leaveTypes')}}</a>
        </li>

        <li class="nav-item {{ isset($dataSkorActive) ? $dataSkorActive : ''}}">
            <a class="nav-link"
               href="javascript: loadView('{{route('admin.dataskors.index')}}')">
                <i class="fa fa-file-text"></i>
                List Nama Skors</a>
        </li>
				<hr style="margin: 3px 0px; border-top: 1px solid #32669d;">
		      <li class="nav-item {{ isset($NormalabsensiActive) ? $NormalabsensiActive : ''}}">
            <a class="nav-link"
               href="javascript: loadView('{{route('admin.normalabsensis.index')}}')">
                <i class="fa fa-file-text"></i>
               Jadwal OPD Normal</a>
        </li>
		 <li class="nav-item {{ isset($tanggalAbsensiActive) ? $tanggalAbsensiActive : ''}}">
            <a class="nav-link"
               href="javascript: loadView('{{route('admin.tanggal_absensis.index')}}')">
                <i class="fa fa-file-text"></i>
               Periode OPD Normal</a>
        </li>
		
		      <li class="nav-item {{ isset($holidayActive) ? $holidayActive : ''}}">
            <a class="nav-link"
               href="javascript: loadView('{{route('admin.holidays.index')}}')">
                <i class="fa fa-file-text"></i>
               Libur OPD Normal</a>
        </li>
		
		<hr style="margin: 3px 0px; border-top: 1px solid #32669d;">
		
	  <li class="nav-item {{ isset($NormalshiftabsensiActive) ? $NormalshiftabsensiActive : ''}}">
            <a class="nav-link"
               href="javascript: loadView('{{route('admin.normalshiftabsensis.index')}}')">
                <i class="fa fa-file-text"></i>
               Jadwal OPD Shift</a>
        </li>

   
		
	<li class="nav-item {{ isset($tanggalNormalshiftActive) ? $tanggalNormalshiftActive : ''}}">
            <a class="nav-link"
               href="javascript: loadView('{{route('admin.tanggal_normalshifts.index')}}')">
                <i class="fa fa-file-text"></i>
               Periode OPD Shift</a>
        </li>
	
  
		
		        <li class="nav-item {{ isset($liburshiftActive) ? $liburshiftActive : ''}}">
            <a class="nav-link"
               href="javascript: loadView('{{route('admin.liburshifts.index')}}')">
                <i class="fa fa-file-text"></i>
               Libur OPD Shift</a>
        </li>
		
		<hr style="margin: 3px 0px; border-top: 1px solid #32669d;">	
		
		
		   <li class="nav-item {{ isset($golonganPegActive) ? $golonganPegActive : ''}}">
            <a class="nav-link"
               href="javascript: loadView('{{route('admin.golonganpegs.index')}}')">
                <i class="fa fa-file-text"></i>
               Golongan Pegawai</a>
        </li>
		
				   <li class="nav-item {{ isset($presentAbsensiActive) ? $presentAbsensiActive : ''}}">
            <a class="nav-link"
               href="javascript: loadView('{{route('admin.presentabsensis.index')}}')">
                <i class="fa fa-file-text"></i>
               Presentasi Absen </a>
        </li>
		
			      <li class="nav-item {{ isset($JadwalshiftActive) ? $JadwalshiftActive : ''}}">
            <a class="nav-link"
               href="javascript: loadView('{{route('admin.jadwalshifts.index')}}')">
                <i class="fa fa-file-text"></i>
               Jadwal Shift</a>
        </li>
		
		
		                 <li class="nav-item {{ isset($noticeBoardActive) ? $noticeBoardActive : ''}}">
            <a class="nav-link"
               href="javascript: loadView('{{route('admin.noticeboards.index')}}')">
                <i class="fa fa-file-text"></i>
                 Papan Pengumuman</a>
        </li>





    </ul>
</li>

              


<li class="nav-item {{ $fingerprint_MachineActive??''}}">
    <a class="nav-link"
       href="javascript: loadView('{{route('admin.fingerprint_machines.index')}}')">
        <i class="fa fa-file-text"></i>
       Data IP</a>
</li>

           @if(admin()->unikid =='1')
 <li class="menu-dropdown classic-menu-dropdown {{ isset($absMenuActive) ? $absMenuActive : '' }}">
                                <a href="javascript:;">
                                    <i class="fa fa-list-alt"></i> Data Superadmin
                                    <i class="fa fa-angle-down"></i>
                                </a>
                                <ul class="dropdown-menu pull-left">
                 
        
         
        <li class="nav-item {{ isset($DataKetActive) ? $DataKetActive : ''}}">
                                            <a class="nav-link"
                                               href="javascript: loadView('{{route('admin.leave_applicationsadmin.index')}}')">
                                    <i class="fa fa-check"></i>
                                                <span class="title">Tambah Keterangan</span>
                                                <span class="selected "></span>
                                            </a>

                                    </li>

        <li class="nav-item {{ isset($attendancesOpen) ? $attendancesOpen : ''}}">
                                            <a class="nav-link"
                                               href="javascript: loadView('{{route('admin.kehadiranadmin.index')}}')">
                                    <i class="fa fa-check"></i>
                                                <span class="title">Tambah Hadir (ASN)</span>
                                                <span class="selected "></span>
                                            </a>

                                    </li>    

									<li class="nav-item {{ isset($attendancesOpenPHL) ? $attendancesOpenPHL : ''}}">
                                            <a class="nav-link"
                                               href="javascript: loadView('{{route('admin.kehadiranadminphl.index')}}')">
                                    <i class="fa fa-check"></i>
                                                <span class="title">Tambah Hadir (PHL)</span>
                                                <span class="selected "></span>
                                            </a>

                                    </li>

             
                                </ul>
 </li>
      @endif        




<li class="nav-item {{ $generalSettingActive??''}}">
    <a class="nav-link"
      href="javascript: loadView('{{route('admin.settings.edit','setting')}}')">
        <i class="fa  fa-cog"></i>
      Pengaturan Absensi</a>
</li>



