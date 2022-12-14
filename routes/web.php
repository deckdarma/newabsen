<?php
/*
 * HRM - SAAS
 * Name:Ajay Kumar choudhary
 * Email:ajay@froiden.com
 */

# Employee Login
Route::group(["namespace" => 'Front', 'prefix' => 'panel'], function () {
    Route::get('/', ['as' => 'login', 'uses' => 'LoginController@index']);
    Route::post('/login', ['as' => 'login_check', 'uses' => 'LoginController@ajaxLogin']);
    Route::get('logout', ['as' => 'front.logout', 'uses' => 'LoginController@logout']);

    Route::post('password/reset', ['as' => 'front.password.post_reset', 'uses' => 'LoginController@post_reset']);
    Route::get('password/reset/{id}', ['as' => 'front.password.get_reset', 'uses' => 'LoginController@get_reset']);
    Route::post('forget_password', ['as' => 'front.forget_password', 'uses' => 'LoginController@forget_password']);

});
Route::group(["namespace" => 'Front'], function () {

    Route::post('password/reset', ['as' => 'front.password.post_reset', 'uses' => 'LoginController@post_reset']);
    Route::get('password/reset/{id}', ['as' => 'front.password.get_reset', 'uses' => 'LoginController@get_reset']);
    Route::post('forget_password', ['as' => 'front.forget_password', 'uses' => 'LoginController@forget_password']);

});

# Employee Panel After Login
Route::group(["namespace" => 'Front', 'middleware' => 'auth.employees', 'prefix' => 'panel'], function () {
    Route::post('/change_password_modal', ['as' => 'front.change_password_modal', 'uses' => 'DashboardController@changePasswordModal']);
    Route::post('/change_password', ['as' => 'front.change_password', 'uses' => 'DashboardController@change_password']);


    Route::get('salary_slip/{id}', ['as' => 'front.salary_slip', 'uses' => 'DashboardController@salary_show']);

//    Route::get('leave', ['as' => 'front.leave', 'uses' => 'DashboardController@leave']);

    Route::get('salary', ['as' => 'front.salary', 'uses' => 'DashboardController@salary']);
    Route::get('employee/ajax_payroll', ['as' => 'front.ajax_payrolls', 'uses' => 'DashboardController@ajax_payrolls']);
    Route::get('employee/ajax_shitkinerja', ['as' => 'front.ajax_shitkinerjas', 'uses' => 'DashboardController@ajax_shitkinerjas']);

    Route::get('dashboard/notice/{id}', ['as' => 'front.notice_ajax', 'uses' => 'DashboardController@notice_ajax']);

    Route::get('ajaxApplications/{id?}', ['as' => 'front.leave_applications', 'uses' => 'LeaveController@ajaxApplications']);
    Route::resource('leaves', 'LeaveController');


    Route::resource('jobs', 'JobFrontController');
    Route::resource('dashboard', 'DashboardController');

    Route::get('ajax_expenses/', ['as' => 'front.ajax_expenses', 'uses' => 'ExpenseFrontsController@ajax_expenses']);
    Route::resource('expenses', 'ExpenseFrontsController', ['as' => 'front']);

    Route::post('attendances/employee/ajax_load_calender', ['as' => 'front.attendance.ajax_load_calender', 'uses' => 'DashboardController@ajax_load_calender']);

    Route::get('front/attendance', ['uses' => 'AttendanceFrontController@index', 'as' => 'front.attendance.index']);
    Route::post('front/clock_in', ['uses' => 'AttendanceFrontController@clockIn', 'as' => 'front.attendance.clockIn']);
    Route::post('front/clock_out', ['uses' => 'AttendanceFrontController@clockOut', 'as' => 'front.attendance.clockOut']);
    Route::post('front/work_from', ['uses' => 'AttendanceFrontController@updateWorkFrom', 'as' => 'front.attendance.work_from']);
    Route::post('front/notes', ['uses' => 'AttendanceFrontController@updateNote', 'as' => 'front.attendance.notes']);
    Route::get('front/ajax_attendance', ['uses' => 'AttendanceFrontController@ajax_attendance', 'as' => 'front.attendance.ajax_attendance']);
});


# Admin Login
Route::group(["namespace" => 'Admin', "prefix" => "admin"], function () {

    Route::get('/', ['as' => 'admin.getlogin', 'uses' => 'AdminLoginController@index']);
    Route::get('logout', ['as' => 'admin.logout', 'uses' => 'AdminLoginController@logout']);

    Route::post('password/reset', ['as' => 'admin.password.post_reset', 'uses' => 'AdminLoginController@post_reset']);
    Route::get('verify_email/{id}', ['as' => 'admin.verify_email', 'uses' => 'AdminLoginController@verify_email']);
    Route::get('password/reset/{id}', ['as' => 'admin.password.get_reset', 'uses' => 'AdminLoginController@get_reset']);
    Route::post('forget_password', ['as' => 'admin.forget_password', 'uses' => 'AdminLoginController@forget_password']);
    Route::post('login', ['as' => 'admin.login', 'uses' => 'AdminLoginController@ajaxAdminLogin']);
    Route::post('register', ['as' => 'admin.register', 'uses' => 'AdminLoginController@register']);

});


// Admin Panel After Login
Route::group(["namespace" => 'Admin', 'middleware' => ['auth.admin', 'auth.screenlock', 'plan.null'], 'prefix' => 'admin'], function () {
    //	Dashboard Routing

    Route::post('updates/image_upload', ["as" => "admin.summernote.image_upload", "uses" => "AdminCommonController@image_upload"]);

    Route::post('attendances/ajax_load_calender', ['as' => 'admin.attendance.ajax_load_calender', 'uses' => 'AdminDashboardController@ajax_load_calender']);
    Route::get('resend_verify_email', ['as' => 'admin.dashboard.resend_verify_email', 'uses' => 'AdminDashboardController@resend_verify_email']);
    Route::resource('dashboard', 'AdminDashboardController', ['as' => 'admin']);

    //    Employees Routing
    Route::get('employees/ajax_employees/', ['as' => 'admin.ajax_employees', 'uses' => 'EmployeesController@ajax_employees']);
    Route::get('employees/export', ['as' => 'admin.employees.export', 'uses' => 'EmployeesController@export']);
    Route::get('employees/import', ['as' => 'admin.employees.import', 'uses' => 'EmployeesController@import']);
    Route::post('employees/import/upload', ['as' => 'admin.employees.importUpload', 'uses' => 'EmployeesController@importUpload']);
    Route::get('employees/import/match', ['as' => 'admin.employees.match', 'uses' => 'EmployeesController@match']);
    Route::post('employees/import/process', ['as' => 'admin.employees.importProcess', 'uses' => 'EmployeesController@importProcess']);
    Route::post('employees/import/checkStatus', ['as' => 'admin.employees.checkImportProgress', 'uses' => 'EmployeesController@checkImportProgress']);
    Route::post('employees/import/cancel', ['as' => 'admin.employees.cancelImport', 'uses' => 'EmployeesController@cancelImport']);
    Route::get('employees/import/failed_records', ['as' => 'admin.employees.failed_records', 'uses' => 'EmployeesController@failedRecords']);
    Route::get('employees/import/downloadFailedRecords', ['as' => 'admin.employees.downloadFailedRecords', 'uses' => 'EmployeesController@downloadFailedRecords']);
    Route::get('employees/employeeLogin/{id}', ['as' => 'admin.employees.employeeLogin', 'uses' => 'EmployeesController@employeesLogin']);



   Route::resource('employees', 'EmployeesController', ['except' => ['show'], 'as' => 'admin']);
   
   


   

   Route::get('datamutasi/index', ['as' => 'admin.datamutasi.index', 'uses' => 'DataMutasiController@index']);
   Route::get('datamutasi/terima', ['as' => 'admin.datamutasi.terima', 'uses' => 'DataMutasiController@terima']);

   Route::resource('datamutasi', 'DataMutasiController', ['except' => ['show'], 'as' => 'admin']);
   
    Route::get('mutasikeluar/index', ['as' => 'admin.mutasikeluar.index', 'uses' => 'MutasiKeluarController@index']);
   Route::resource('mutasikeluar', 'MutasiKeluarController', ['except' => ['show'], 'as' => 'admin']);
   
     Route::get('tambahjabatan/index', ['as' => 'admin.tambahjabatan.index', 'uses' => 'TambahJabatanController@index']);
   Route::resource('tambahjabatan', 'TambahJabatanController', ['except' => ['show'], 'as' => 'admin']);
   
   
   Route::get('mutasimasuk/index', ['as' => 'admin.mutasimasuk.index', 'uses' => 'MutasiMasukController@index']);
   Route::resource('mutasimasuk', 'MutasiMasukController', ['except' => ['show'], 'as' => 'admin']);
   
   


   Route::get('pegawaibaru/index', ['as' => 'admin.pegawaibaru.index', 'uses' => 'PegawaiBaruController@index']);
	

   Route::resource('pegawaibaru', 'PegawaiBaruController', ['except' => ['show'], 'as' => 'admin']);
   
   
   
   
   
   

    //  Awards Routing
    Route::get('ajax_awards/', ['as' => 'admin.ajax_awards', 'uses' => 'AwardsController@ajax_awards']);
    Route::resource('awards', 'AwardsController', ['except' => ['show'], 'as' => 'admin']);
	

    //  Department Routing
    Route::get('departments/ajax_designation/', ['as' => 'admin.departments.ajax_designation', 'uses' => 'DepartmentsController@ajax_designation']);
    Route::resource('departments', 'DepartmentsController', ['except' => ['show'], 'as' => 'admin']);

    //    Expense Routing
    Route::get('ajax_expenses/', ['as' => 'admin.ajax_expenses', 'uses' => 'ExpensesController@ajax_expenses']);
    Route::post('expense_change_status/{id}', ['as' => 'admin.expense.change_status', 'uses' => 'ExpensesController@change_status']);

    Route::resource('expenses', 'ExpensesController', ['except' => ['show'], 'as' => 'admin']);



    //  Routing for the attendance
    Route::get('attendances/ajax_employees/', ['as' => 'admin.attendance.ajax_employees', 'uses' => 'AttendancesController@ajax_employees']);
    Route::get('attendances/ajax_attendance', ['as' => 'admin.attendance.ajax_attendance', 'uses' => 'AttendancesController@ajax_attendance']);

    Route::get('attendances/report/{attendances}', ['as' => 'admin.attendance.report', 'uses' => 'AttendancesController@report']);
    Route::post('attendance/update/row', ['as' => 'admin.attendance.update.row', 'uses' => 'AttendancesController@updateAttendanceRow']);
    Route::post('attendance/clockIn', ['as' => 'admin.attendance.clockin', 'uses' => 'AttendancesController@clockInIP']);
    Route::get('attendances/asndata', ['as' => 'admin.attendance.asndata', 'uses' => 'AttendancesController@asndata']);
    // attendance Filter route
    Route::post('attendances/filter', ['as'=>'admin.attendance.filter','uses'=>'AttendancesController@filterAttendance']);
    Route::get('attendances-employee', ['as'=>'admin.attendance.employee','uses'=>'AttendancesController@attendanceEmployee']);

   Route::resource('attendances', 'AttendancesController', ['as' => 'admin']);

    //  Routing for the datashift
    Route::get('datashifts/ajax_employees/', ['as' => 'admin.datashift.ajax_employees', 'uses' => 'DatashiftsController@ajax_employees']);
    Route::get('datashifts/ajax_datashift', ['as' => 'admin.datashift.ajax_datashift', 'uses' => 'DatashiftsController@ajax_datashift']);

    Route::get('datashifts/report/{datashifts}', ['as' => 'admin.datashift.report', 'uses' => 'DatashiftsController@report']);
    Route::post('datashift/update/row', ['as' => 'admin.datashift.update.row', 'uses' => 'DatashiftsController@updateAttendanceRow']);
    Route::post('datashift/clockIn', ['as' => 'admin.datashift.clockin', 'uses' => 'DatashiftsController@clockInIP']);
	Route::get('datashifts/shiftpagi', ['as' => 'admin.datashift.shiftpagi', 'uses' => 'DatashiftsController@shiftpagi']);
	Route::get('datashifts/laporanpeg', ['as' => 'admin.datashift.laporanpeg', 'uses' => 'DatashiftsController@laporanpeg']);
    
	// datashift Filter route
    Route::post('datashifts/filter', ['as'=>'admin.datashift.filter','uses'=>'DatashiftsController@filterAttendance']);
    Route::get('datashifts-employee', ['as'=>'admin.datashift.employee','uses'=>'DatashiftsController@datashiftEmployee']);
	Route::resource('datashifts', 'DatashiftsController', ['as' => 'admin']);

   Route::get('siangshifts/ajax_siangshift', ['as' => 'admin.siangshift.ajax_siangshift', 'uses' => 'SiangshiftsController@ajax_siangshift']);
  Route::post('siangshift/update/row', ['as' => 'admin.siangshift.update.row', 'uses' => 'SiangshiftsController@updateAttendanceRow']);
  Route::post('siangshift/clockIn', ['as' => 'admin.siangshift.clockin', 'uses' => 'SiangshiftsController@clockInIP']);
Route::get('siangshifts/shiftsiang', ['as' => 'admin.siangshift.shiftsiang', 'uses' => 'SiangshiftsController@shiftsiang']);
    	
  Route::resource('siangshifts', 'SiangshiftsController', ['as' => 'admin']);

   Route::get('malamshifts/ajax_malamshift', ['as' => 'admin.malamshift.ajax_malamshift', 'uses' => 'MalamshiftsController@ajax_malamshift']);
  Route::post('malamshift/update/row', ['as' => 'admin.malamshift.update.row', 'uses' => 'MalamshiftsController@updateAttendanceRow']);
  Route::post('malamshift/clockIn', ['as' => 'admin.malamshift.clockin', 'uses' => 'MalamshiftsController@clockInIP']);
Route::get('malamshifts/shiftmalam', ['as' => 'admin.malamshift.shiftmalam', 'uses' => 'MalamshiftsController@shiftmalam']);
    	
  Route::resource('malamshifts', 'MalamshiftsController', ['as' => 'admin']);

    Route::post('laporanpegawai/filter', ['as'=>'admin.laporpegawai.filter','uses'=>'LaporanpegawaiController@filterAttendance']);
    Route::get('laporanpegawai-employee', ['as'=>'admin.laporpegawai.employee','uses'=>'LaporanpegawaiController@attendanceEmployee']);
    Route::resource('laporanpegawai', 'LaporanpegawaiController', ['as' => 'admin']);
	
	
	Route::post('laporannonshifpegawai/filter', ['as'=>'admin.laporpegnonshift.filter','uses'=>'LaporannonshifpegawaiController@filterAttendance']);
    Route::get('laporannonshifpegawai-employee', ['as'=>'admin.laporpegnonshift.employee','uses'=>'LaporannonshifpegawaiController@attendanceEmployee']);
    Route::resource('laporannonshifpegawai', 'LaporannonshifpegawaiController', ['as' => 'admin']);
	
	
		Route::post('laporannonshifphl/filter', ['as'=>'admin.laporphlnonshift.filter','uses'=>'LaporannonshifphlController@filterAttendance']);
    Route::get('laporannonshifphl-employee', ['as'=>'admin.laporphlnonshift.employee','uses'=>'LaporannonshifphlController@attendanceEmployee']);
    Route::resource('laporannonshifphl', 'LaporannonshifphlController', ['as' => 'admin']);
	
    Route::post('laporanpegawaishift/filter', ['as'=>'admin.laporpegawaishift.filter','uses'=>'LaporanpegawaishiftController@filterAttendance']);
    Route::get('laporanpegawaishift-employee', ['as'=>'admin.laporpegawaishift.employee','uses'=>'LaporanpegawaishiftController@attendanceEmployee']);
    Route::resource('laporanpegawaishift', 'LaporanpegawaishiftController', ['as' => 'admin']);
	
  Route::post('laporanphlshift/filter', ['as'=>'admin.laporanphlshift.filter','uses'=>'LaporanphlshiftController@filterAttendance']);
    Route::get('laporanphlshift-employee', ['as'=>'admin.laporanphlshift.employee','uses'=>'LaporanphlshiftController@attendanceEmployee']);
    Route::resource('laporanphlshift', 'LaporanphlshiftController', ['as' => 'admin']);
	

    Route::get('laporanphl/ajax_employees/', ['as' => 'admin.laporphl.ajax_employees', 'uses' => 'LaporanphlController@ajax_employees']);
    Route::get('laporanphl/ajax_attendance', ['as' => 'admin.laporphl.ajax_attendance', 'uses' => 'LaporanphlController@ajax_attendance']);
    Route::get('laporanphl/report/{attendances}', ['as' => 'admin.laporphl.report', 'uses' => 'LaporanphlController@report']);
    Route::post('laporphl/update/row', ['as' => 'admin.laporphl.update.row', 'uses' => 'LaporanphlController@updateAttendanceRow']);
    Route::post('laporphl/clockIn', ['as' => 'admin.laporphl.clockin', 'uses' => 'LaporanphlController@clockInIP']);
    Route::get('laporanphl/phldata', ['as' => 'admin.laporanphl.phldata', 'uses' => 'LaporanphlController@phldata']);
	// attendance Filter route
    Route::post('laporanphl/filter', ['as'=>'admin.laporphl.filter','uses'=>'LaporanphlController@filterAttendance']);
    Route::get('laporanphl-employee', ['as'=>'admin.laporphl.employee','uses'=>'LaporanphlController@attendanceEmployee']);
    Route::resource('laporanphl', 'LaporanphlController', ['as' => 'admin']);

 Route::get('phlharianshift/ajax_attendance', ['as' => 'admin.phlharianlapor.ajax_attendance', 'uses' => 'PhlharianshiftController@ajax_attendance']);
Route::get('phlharianshift/phldata', ['as' => 'admin.phlharianshift.phldata', 'uses' => 'PhlharianshiftController@phldata']);
   Route::get('phlharianshift/lihatdata', ['as' => 'admin.phlharianshift.lihatdata', 'uses' => 'PhlharianshiftController@lihatdata']);
   Route::resource('phlharianshift', 'PhlharianshiftController', ['as' => 'admin']);


   Route::post('asnharianshift/filter', ['as'=>'admin.asnharianlapor.filter','uses'=>'AsnharianshiftController@filterAttendance']);
    
 Route::get('asnharianshift/ajax_attendance', ['as' => 'admin.asnharianlapor.ajax_attendance', 'uses' => 'AsnharianshiftController@ajax_attendance']);
Route::get('asnharianshift/asndata', ['as' => 'admin.asnharianshift.asndata', 'uses' => 'AsnharianshiftController@asndata']);
  Route::resource('asnharianshift', 'AsnharianshiftController', ['as' => 'admin']);





    Route::get('dataapel/ajax_attendance', ['as' => 'admin.apelapel.ajax_attendance', 'uses' => 'DataApelController@ajax_attendance']);
    Route::post('apelapel/update/row', ['as' => 'admin.apelapel.update.row', 'uses' => 'DataApelController@updateAttendanceRow']);
    Route::post('apelapel/clockIn', ['as' => 'admin.apelapel.clockin', 'uses' => 'DataApelController@clockInIP']);
    Route::resource('dataapel', 'DataApelController', ['as' => 'admin']);
	


    Route::post('printrekap/filter', ['as'=>'admin.rekaprekap.filter','uses'=>'PrintRekapController@filterPayroll']);
    Route::resource('printrekap', 'PrintRekapController', ['as' => 'admin']);
	
	    Route::post('printrekapphl/filter', ['as'=>'admin.rekaprekapphl.filter','uses'=>'PrintRekapphlController@filterPayroll']);
    Route::resource('printrekapphl', 'PrintRekapphlController', ['as' => 'admin']);

	Route::get('datapemimpins/ajax_list', ['as' => 'admin.datapemimpins.ajax_list', 'uses' => 'DatapemimpinsController@ajaxDataPemimpin']);
	Route::resource('datapemimpins', 'DatapemimpinsController', ['as' => 'admin']);
	

    Route::get('newleave/ajax_list', ['as' => 'admin.newleave.ajax_list', 'uses' => 'NewLeaveController@ajaxLeaveType']);
    Route::resource('newleave', 'NewLeaveController', ['except' => ['show'], 'as' => 'admin']);


    Route::get('newleave_dl/ajax_list', ['as' => 'admin.newleave_dl.ajax_list', 'uses' => 'NewLeaveDinasController@ajaxLeaveType']);
    Route::resource('newleave_dl', 'NewLeaveDinasController', ['except' => ['show'], 'as' => 'admin']);

    //    Leave Applications routing
    Route::get('leave_applications/ajaxApplications', ['as' => 'admin.leave_applications', 'uses' => 'LeaveApplicationsController@ajaxApplications']);
    Route::resource('leave_applications', 'LeaveApplicationsController', ['except' => ['create', 'store', 'edit'], 'as' => 'admin']);

    //   Routing for setting
    Route::get('change_language/', ['as' => 'admin.change_language', 'uses' => 'SettingsController@change_language']);
    Route::get('theme/', ['as' => 'admin.settings.theme', 'uses' => 'SettingsController@theme']);
    Route::resource('settings', 'SettingsController', ['only' => ['edit', 'update'], 'as' => 'admin']);

    //region stripe settings superadmin
    Route::get('stripe_settings', ['as' => 'admin.stripe_settings', 'uses' => 'SettingsController@getStripe']);
    //endregion


    //endregion

    //    Salary Routing
    Route::get('add-salary-modal/{employeeID}', ['as' => 'admin.add-salary-modal', 'uses' => 'SalaryController@addSalaryModal']);
    Route::resource('salary', 'SalaryController', ['only' => ['destroy', 'update', 'store'], 'as' => 'admin']);

    //   Profile Setting
    Route::get('profile-settings', ['as' => 'admin.profile_settings.edit', 'uses' => 'ProfileSettingsController@edit']);
    Route::post('profile-settings', ['as' => 'admin.profile_settings.update', 'uses' => 'ProfileSettingsController@update']);

    //   Notification Setting
    Route::post('ajax_update_notification', ['as' => 'admin.ajax_update_notification', 'uses' => 'CompanySettingsController@updateAjaxNotification']);
    Route::post('notification-settings', ['as' => 'admin.notification.update', 'uses' => 'CompanySettingsController@updateNotification']);

    Route::get('notification-settings', ['as' => 'admin.notification.edit', 'uses' => 'CompanySettingsController@notificationSetting']);

    Route::get('shitkinerjas/downloadpdf/{id}', ['as' => 'admin.shitkinerjas.downloadpdf', 'uses' => 'ShitkinerjasController@downloadPdf']);
    Route::post('shitkinerjas/check/', ['as' => 'admin.shitkinerjas.check', 'uses' => 'ShitkinerjasController@check']);
    Route::get('ajax_shitkinerjas/', ['as' => 'admin.ajax_shitkinerjas', 'uses' => 'ShitkinerjasController@ajax_shitkinerjas']);
    Route::post('shitkinerja_report/', ['as' => 'admin.shitkinerja_report', 'uses' => 'ShitkinerjasController@report']);
    Route::resource('shitkinerjas', 'ShitkinerjasController', ['as' => 'admin']);

    // Payroll
    Route::get('payrolls/downloadpdf/{id}', ['as' => 'admin.payrolls.downloadpdf', 'uses' => 'PayrollsController@downloadPdf']);
    Route::post('payrolls/check/', ['as' => 'admin.payrolls.check', 'uses' => 'PayrollsController@check']);
    Route::get('ajax_payrolls/', ['as' => 'admin.ajax_payrolls', 'uses' => 'PayrollsController@ajax_payrolls']);
    Route::post('payroll_report/', ['as' => 'admin.payroll_report', 'uses' => 'PayrollsController@report']);
    Route::resource('payrolls', 'PayrollsController', ['as' => 'admin']);

    //Admin Users
    Route::get('ajax_admin_users/', ['as' => 'admin.ajax_admin_users', 'uses' => 'AdminUsersController@ajax_admin_users']);
    Route::resource('admin_users', 'AdminUsersController', ['as' => 'admin']);

    //Managers
    Route::get('ajax_managers/', ['as' => 'admin.ajax_managers', 'uses' => 'AdminManagersController@ajax_managers']);
    Route::resource('managers', 'AdminManagersController', ['as' => 'admin']);

    //  Job Posted
    Route::get('ajax_jobs/', ['as' => 'admin.ajax_jobs', 'uses' => 'JobsController@ajax_jobs']);
    Route::resource('jobs', 'JobsController', ['as' => 'admin']);

    // Job Applications
    Route::get('job_application/get_download/{resume}', ['as' => 'admin.job_applications.get_download', 'uses' => 'JobApplicationsController@getDownload']);
    Route::post('job_application_change_status/', ['as' => 'admin.job_applications.change_status', 'uses' => 'JobApplicationsController@change_status']);
    Route::get('ajax_jobs_applications/', ['as' => 'admin.ajax_jobs_applications', 'uses' => 'JobApplicationsController@ajax_jobs_applications']);
    Route::resource('job_applications', 'JobApplicationsController', ['as' => 'admin']);

    //Company Setting
    Route::get('company_setting_features', ['as' => 'admin.company_setting.features', 'uses' => 'CompanySettingsController@features']);
    Route::get('company_setting_theme', ['as' => 'admin.company_setting.theme', 'uses' => 'CompanySettingsController@theme']);
    Route::post('company_setting_theme', ['as' => 'admin.company_setting.theme_update', 'uses' => 'CompanySettingsController@updateTheme']);



    Route::get('general-setting', ['as' => 'admin.general_setting.edit', 'uses' => 'CompanySettingsController@generalSetting']);
    Route::put('general-setting', ['as' => 'admin.general_setting.update', 'uses' => 'CompanySettingsController@generalSettingUpdate']);

    Route::get('change_language/', ['as' => 'admin.change_language', 'uses' => 'CompanySettingsController@change_language']);
    Route::get('theme/', ['as' => 'admin.settings.theme', 'uses' => 'CompanySettingsController@theme']);

    Route::resource('company_setting', 'CompanySettingsController', ['as' => 'admin']);

    // Admin Settings
    Route::get('attendance_settings', ['as' => 'admin.attendance_settings.edit', 'uses' => 'CompanySettingsController@attendance']);
    Route::post('attendance_settings/mark_attendance', ['as' => 'admin.attendance_settings.update', 'uses' => 'CompanySettingsController@attendanceUpdateSetting']);

});
// Admin Panel After Login
Route::group(["namespace" => 'Admin', 'middleware' => ['auth.admin', 'auth.screenlock'], 'prefix' => 'admin'], function () {
    //	Dashboard Routing
    Route::get('billing/ajax_billing', ['as' => 'admin.billing.ajax_billing', 'uses' => 'BillingController@ajax_billing']);
    Route::get('billing/ajax_company_name', ['as' => 'admin.billing.ajax_company_name', 'uses' => 'BillingController@ajax_company_name']);
    Route::get('billing/pay/{id}', ['as' => 'admin.billing.pay', 'uses' => 'BillingController@pay']);
    Route::get('billing/pay_razor/{id}', ['as' => 'admin.billing.payRazor', 'uses' => 'BillingController@payRazor']);
    Route::post('billing/pay_2checkout', ['as' => 'admin.billing.pay2checkout', 'uses' => 'BillingController@pay2checkout']);
    Route::get('billing/payment/success', ['as' => 'admin.billing.payment.success', 'uses' => 'BillingController@paymentSuccess']);
    Route::get('billing/payment/cancel', ['as' => 'admin.billing.payment.cancel', 'uses' => 'BillingController@paymentCancel']);
    Route::get('billing/change-plan', ['as' => 'admin.billing.change_plan', 'uses' => 'BillingController@changePlan']);
    Route::get('paypal-recurring', array('as' => 'admin.paypal-recurring','uses' => 'AdminPaypalController@payWithPaypalRecurrring',));
    Route::get('billing/select-package/{packageID}',  'BillingController@selectPackage')->name('admin.billing.select-package');
    Route::post('billing/stripe-payment', ['as' => 'admin.billing.stripe_payment', 'uses' => 'BillingController@stripePayment']);
    Route::post('billing/unsubscribe', ['as' => 'admin.billing.unsubscribe', 'uses' => 'BillingController@cancelSubscription']);

    Route::get('paypal/{packageId}/{type}', array('as' => 'admin.paypal','uses' => 'AdminPaypalController@paymentWithpaypal'));
    Route::resource('billing', 'BillingController', ['as' => 'admin']);


});

// Superadmin Panel Routes
Route::group(["namespace" => 'Admin', 'middleware' => ['auth.superadmin', 'auth.screenlock'], 'prefix' => 'super-admin'], function () {

    //   Profile Setting
    Route::get('profile-settings', ['as' => 'superadmin.profile_settings.edit', 'uses' => 'ProfileSettingsController@edit']);
    Route::post('profile-settings', ['as' => 'superadmin.profile_settings.update', 'uses' => 'ProfileSettingsController@update']);


    Route::get('earning/report/{year}', ['as' => 'admin.earning.report', 'uses' => 'SuperAdminDashboardController@createEarningReport']);
    Route::resource('dashboard', 'SuperAdminDashboardController', ['as' => 'superadmin']);

    //	Contact Request
    Route::post('contact_requests_change_status/', ['as' => 'admin.contact_requests.change_status', 'uses' => 'ContactRequestController@change_status']);
    Route::get('ajax_contact_requests/', ['as' => 'admin.ajax_contact_requests', 'uses' => 'ContactRequestController@ajax_contact_requests']);
    Route::resource('contact_requests', 'ContactRequestController', ['as' => 'admin']);

    //Email Templates
    Route::get('ajax_email_templates/', ['as' => 'admin.ajax_email_templates', 'uses' => 'EmailTemplatesController@ajax_email_templates']);
    Route::resource('email_templates', 'EmailTemplatesController', ['as' => 'admin']);

    //Pages
    Route::get('ajax_pages/', ['as' => 'admin.ajax_pages', 'uses' => 'PagesController@ajax_pages']);
    Route::resource('pages', 'PagesController', ['as' => 'admin']);

    //Languages
    Route::get('ajax_languages/', ['as' => 'admin.ajax_languages', 'uses' => 'SuperAdminLanguageController@ajax_languages']);
    Route::resource('language', 'SuperAdminLanguageController', ['as' => 'admin']);

    // License Types
    Route::put('license_types_country_update/{id}', ['as' => 'admin.license_types_country.update', 'uses' => 'LicenseTypesController@update_country']);
    Route::get('license_types_country_edit/{id}', ['as' => 'admin.license_types_country.edit', 'uses' => 'LicenseTypesController@edit_country']);
    Route::get('ajax_license_types_country/', ['as' => 'admin.ajax_license_types_country', 'uses' => 'LicenseTypesController@ajax_license_types_country']);
    Route::get('ajax_license_types/', ['as' => 'admin.ajax_license_types', 'uses' => 'LicenseTypesController@ajax_license_types']);
    Route::resource('license_types', 'LicenseTypesController', ['as' => 'admin']);

    Route::get('ajax_plans/', ['as' => 'admin.plans', 'uses' => 'PlansController@ajax_plans']);
    Route::resource('plans', 'PlansController', ['as' => 'admin']);

    // FAQ Category
    Route::get('ajax_faq_categories/', ['as' => 'admin.faq_categories', 'uses' => 'FaqCategoryController@ajaxFaqCategories']);
    Route::resource('faq_categories', 'FaqCategoryController', ['as' => 'admin']);

    // FAQ
    Route::get('ajax_faq/', ['as' => 'admin.faqs', 'uses' => 'FaqController@ajaxFaqs']);
    Route::resource('faq', 'FaqController', ['as' => 'admin']);

    // Features
    Route::get('ajax_features/', ['as' => 'admin.features', 'uses' => 'FeaturesController@ajaxFeatures']);
    Route::resource('features', 'FeaturesController', ['as' => 'admin']);

    //Licenses
    Route::get('ajax_licenses/', ['as' => 'admin.ajax_licenses', 'uses' => 'LicenseController@ajax_licenses']);
    Route::resource('licenses', 'LicenseController', ['as' => 'admin']);

    // Trasactions
    Route::get('ajax_transactions/', ['as' => 'admin.ajax_transactions', 'uses' => 'TransactionsController@ajax_transactions']);
    Route::resource('transactions', 'TransactionsController', ['as' => 'admin']);

    Route::get('view_file/{type}/{filename}', ['as' => 'admin.view_file', 'uses' => 'AdminCommonController@view_file']);

    Route::get("support", ["as" => "admin.support", "uses" => "AdminDashboardController@support"]);

    //Referral Members
    Route::get('referral_members/ajax_members', ['uses' => 'ReferralMemberController@ajax_members', 'as' => 'admin.referral_members.ajax_members']);
    Route::post('referral_members/change_status', ['uses' => 'ReferralMemberController@change_status', 'as' => 'admin.referral_members.change_status']);
    Route::resource('referral_members', 'ReferralMemberController', ['as' => 'admin']);

    // Trasactions
    Route::get('download_backup/{id}', ['as' => 'admin.download_backup', 'uses' => 'DatabaseBackupAdminController@download_backup']);
    Route::get('ajax_database_backups/', ['as' => 'admin.ajax_database_backups', 'uses' => 'DatabaseBackupAdminController@ajax_database_backups']);
    Route::resource('database_backups', 'DatabaseBackupAdminController', ['as' => 'admin']);

    // Updates
    Route::resource('updates', 'AdminUpdatesController', ['as' => 'admin']);


    //region stripe settings superadmin
    Route::get('stripe_settings', ['as' => 'admin.stripe_settings', 'uses' => 'SettingsController@getStripe']);
    Route::post('stripe_settings', ['as' => 'admin.stripe_settings.update', 'uses' => 'SettingsController@postStripe']);
    //endregion

    // region superadmin invoices
    Route::get('invoices/ajax_invoices', ['uses' => 'SuperAdminInvoiceController@ajax_invoices'])->name('admin.ajax_invoices');
    Route::resource('invoices', 'SuperAdminInvoiceController', ['as' => 'admin'], ['only' => ['index']]);
    //endregion

    //  Company
    Route::get('company_theme/', ['as' => 'admin.companies.theme', 'uses' => 'CompaniesController@theme']);
    Route::get('ajax_company/', ['as' => 'admin.ajax_admin_company', 'uses' => 'CompaniesController@ajax_company']);
    Route::get('change_company/', ['as' => 'admin.change_company', 'uses' => 'CompaniesController@change_company']);

    Route::post('change_status/', ['as' => 'admin.companies.change_status', 'uses' => 'CompaniesController@change_status']);
    Route::post('change_perjalanan/', ['as' => 'admin.companies.change_perjalanan', 'uses' => 'CompaniesController@change_perjalanan']);
    Route::get('companies/editPackage/{companyId}', ['uses' => 'CompaniesController@editPackage'])->name('admin.companies.edit-package.get');
    Route::put('companies/editPackage/{companyId}', ['uses' => 'CompaniesController@updatePackage'])->name('admin.companies.edit-package.post');
    Route::resource('companies', 'CompaniesController', ['as' => 'admin']);
    Route::get("companies/browse_history/{id}", ["as" => "admin.companies.browse_history", "uses" => "CompaniesController@browse_history"]);
    Route::get("companies/ajax_browse_history/{id}", ["as" => "admin.companies.ajax_browse_history", "uses" => "CompaniesController@ajax_browse_history"]);

    //region stripe settings superadmin
    Route::get('smtp_settings', ['as' => 'admin.smtp_settings', 'uses' => 'SettingsController@getSmtp']);
    Route::post('smtp_settings/sent-test-email', ['uses' => 'SettingsController@sendTestEmail'])->name('admin.smtp_settings.send-test-email');
    Route::post('email-settings/updateMailConfig', ['uses' => 'SettingsController@updateMailConfig'])->name('admin.email-settings.updateMailConfig');

    Route::put('update-gdpr', ['as' => 'admin.settings.update-gdpr', 'uses' => 'SettingsController@updateGDPR']);
    Route::get('gdpr', ['as' => 'admin.settings.gdpr', 'uses' => 'SettingsController@getGdpr']);
	 Route::get('settings/tampilan', ['as' => 'admin.settings.tampilan', 'uses' => 'SettingsController@tampilan']);
	
    //   Routing for setting
    Route::resource('settings', 'SettingsController', ['only' => ['edit', 'update'], 'as' => 'admin']);


    //Admin Users
    Route::get('ajax_superadmin_users/', ['as' => 'admin.ajax_superadmin_users', 'uses' => 'SuperAdminUsersController@ajax_superadmin_users']);
    Route::resource('superadmin_users', 'SuperAdminUsersController', ['as' => 'admin']);
	
    Route::get('leavetypes/ajax_list', ['as' => 'admin.leavetypes.ajax_list', 'uses' => 'LeavetypesController@ajaxLeaveType']);
	Route::resource('leavetypes', 'LeavetypesController', ['as' => 'admin']);
	
	    Route::get('dataskors/ajax_list', ['as' => 'admin.dataskors.ajax_list', 'uses' => 'DataskorsController@ajaxDataSkor']);
	Route::resource('dataskors', 'DataskorsController', ['as' => 'admin']);
	
	Route::get('presentabsensis/ajax_list', ['as' => 'admin.presentabsensis.ajax_list', 'uses' => 'PresentabsensisController@ajaxPresentAbsensi']);

	Route::resource('presentabsensis', 'PresentabsensisController', ['as' => 'admin']);
	
		Route::get('golonganpegs/ajax_list', ['as' => 'admin.golonganpegs.ajax_list', 'uses' => 'GolonganpegsController@ajaxGolonganPeg']);
	Route::resource('golonganpegs', 'GolonganpegsController', ['as' => 'admin']);
	
		Route::get('normalabsensis/ajax_list', ['as' => 'admin.normalabsensis.ajax_list', 'uses' => 'NormalabsensisController@ajaxNormalAbsensi']);
	Route::resource('normalabsensis', 'NormalabsensisController', ['as' => 'admin']);
	
	
			Route::get('normalshiftabsensis/ajax_list', ['as' => 'admin.normalshiftabsensis.ajax_list', 'uses' => 'NormalshiftabsensisController@ajaxNormalshiftAbsensi']);
	Route::resource('normalshiftabsensis', 'NormalshiftabsensisController', ['as' => 'admin']);
	
	
		Route::get('jadwalshifts/ajax_list', ['as' => 'admin.jadwalshifts.ajax_list', 'uses' => 'JadwalshiftsController@ajaxJadwalShift']);
	Route::resource('jadwalshifts', 'JadwalshiftsController', ['as' => 'admin']);
	


  Route::get('tanggal_normalshifts/ajaxApplications', ['as' => 'admin.tanggal_normalshifts', 'uses' => 'TanggalNormalshiftsController@ajaxApplications']);
    Route::resource('tanggal_normalshifts', 'TanggalNormalshiftsController', ['except' => ['create', 'store', 'edit'], 'as' => 'admin']);
	
	    Route::get('tampilshiftabsen/ajax_list', ['as' => 'admin.tampilshiftabsen.ajax_list', 'uses' => 'TampilShiftabsenController@ajaxLeaveType']);
    Route::resource('tampilshiftabsen', 'TampilShiftabsenController', ['except' => ['show'], 'as' => 'admin']);


	
  Route::get('tanggal_absensis/ajaxApplications', ['as' => 'admin.tanggal_absensis', 'uses' => 'TanggalAbsensisController@ajaxApplications']);
    Route::resource('tanggal_absensis', 'TanggalAbsensisController', ['except' => ['create', 'store', 'edit'], 'as' => 'admin']);
	
	    Route::get('tampilabsen/ajax_list', ['as' => 'admin.tampilabsen.ajax_list', 'uses' => 'TampilAbsenController@ajaxLeaveType']);
    Route::resource('tampilabsen', 'TampilAbsenController', ['except' => ['show'], 'as' => 'admin']);


    //    Holiday Routing
    Route::get('holidays/index/{year}', ['as' => 'admin.holidays.change_year', 'uses' => 'HolidaysController@index']);
    Route::get('holidays/mark_friday', 'HolidaysController@Friday');
    Route::get('holidays/mark_saturday', 'HolidaysController@Saturday');
    Route::get('holidays/mark_sunday', 'HolidaysController@Sunday');
    Route::get('holidays/un_mark', 'HolidaysController@removeAllWeekendHolidays');
	Route::resource('holidays', 'HolidaysController', ['as' => 'admin']);



    Route::get('liburshifts/index/{year}', ['as' => 'admin.liburshifts.change_year', 'uses' => 'LiburshiftsController@index']);
    Route::get('liburshifts/mark_friday', 'LiburshiftsController@Friday');
    Route::get('liburshifts/mark_saturday', 'LiburshiftsController@Saturday');
    Route::get('liburshifts/mark_sunday', 'LiburshiftsController@Sunday');
    Route::get('liburshifts/un_mark', 'LiburshiftsController@removeAllWeekendLiburshifts');
	Route::resource('liburshifts', 'LiburshiftsController', ['as' => 'admin']);


    //  Notice Board
    Route::get('ajax_notices/', ['as' => 'admin.ajax_notices', 'uses' => 'NoticeboardsController@ajax_notices']);
	Route::resource('noticeboards', 'NoticeboardsController', ['as' => 'admin']);
	
    //  Notice Board
    Route::get('ajax_finger/', ['as' => 'admin.ajax_finger', 'uses' => 'Fingerprint_machinesController@ajax_finger']);


	Route::resource('fingerprint_machines', 'Fingerprint_machinesController', ['as' => 'admin']);
	
    //    Leave Applications routing
    Route::get('leave_applicationsadmin/ajaxApplications', ['as' => 'admin.leave_applicationsadmin', 'uses' => 'LeaveApplicationsAdminController@ajaxApplications']);
    Route::resource('leave_applicationsadmin', 'LeaveApplicationsAdminController', ['except' => ['create', 'store', 'edit'], 'as' => 'admin']);

      Route::get('kehadiranadminphl/ajax_attendance', ['as' => 'admin.kehadiranadphl.ajax_attendance', 'uses' => 'KehadiranadminphlController@ajax_attendance']);
  Route::post('kehadiranadphl/update/row', ['as' => 'admin.kehadiranadphl.update.row', 'uses' => 'KehadiranadminphlController@updateAttendanceRow']);
    Route::post('kehadiranadphl/clockIn', ['as' => 'admin.kehadiranadphl.clockin', 'uses' => 'KehadiranadminphlController@clockInIP']);
   Route::resource('kehadiranadminphl', 'KehadiranadminphlController', ['as' => 'admin']);





   Route::get('kehadiranadmin/ajax_attendance', ['as' => 'admin.kehadiranad.ajax_attendance', 'uses' => 'KehadiranadminController@ajax_attendance']);
  Route::post('attendance/update/row', ['as' => 'admin.kehadiranad.update.row', 'uses' => 'KehadiranadminController@updateAttendanceRow']);
    Route::post('attendance/clockIn', ['as' => 'admin.kehadiranad.clockin', 'uses' => 'KehadiranadminController@clockInIP']);
   Route::resource('kehadiranadmin', 'KehadiranadminController', ['as' => 'admin']);





    Route::get('newleaveadmin/ajax_list', ['as' => 'admin.newleaveadmin.ajax_list', 'uses' => 'NewLeaveAdmin@ajaxLeaveType']);

    Route::resource('newleaveadmin', 'NewLeaveAdminController', ['except' => ['show'], 'as' => 'admin']);


    // Custom Modules
    Route::post('update-settings/deleteFile', ['uses' => 'UpdateDatabaseController@deleteFile'])->name('admin.update-settings.deleteFile');
    Route::get('update-settings/install', ['uses' => 'UpdateDatabaseController@install'])->name('admin.update-settings.install');
    Route::get('update-settings/manual-update', ['uses' => 'UpdateDatabaseController@manual'])->name('admin.update-settings.manual');
    Route::resource('update-settings', 'UpdateDatabaseController',['as' => 'admin']);

    Route::post('custom-modules/verify-purchase', ['uses' => 'CustomModuleController@verifyingModulePurchase'])->name('admin.custom-modules.verify-purchase');
    Route::resource('custom-modules', 'CustomModuleController',['as' => 'admin']);
});


Route::post('verify-ipn', array('as' => 'verify-ipn','uses' => 'PaypalIPNController@verifyIPN'));
Route::post('verify-billing-ipn', array('as' => 'verify-billing-ipn','uses' => 'PaypalIPNController@verifyBillingIPN'));

// Stripe Webhook
Route::post('verify-stripe-webhook', ['as' => 'admin.stripe.verify_webhook', 'uses' => 'StripeWebhookController@verifyStripeWebhook']);
// Save invoices locally
Route::post('/save-invoices',['as' => 'admin.stripe.save_webhook', 'uses' => 'StripeWebhookController@saveInvoices']);

// Lock Screen Routing
Route::get('screenlock', ['middleware' => 'auth.admin', 'as' => 'admin.screen.lock', 'uses' => 'Admin\AdminDashboardController@screenlock']);
Route::post('screenlock/modal', ['middleware' => 'auth.admin', 'as' => 'admin.screenlock.modal', 'uses' => 'Admin\AdminDashboardController@screenlockModal']);

// Site Route
Route::get('/', ["as" => "home", "uses" => "Site\HomeController@index"]);

