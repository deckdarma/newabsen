<?php

return [
    /*
   |--------------------------------------------------------------------------
   | Messages Language Lines
   |--------------------------------------------------------------------------
   |
   | The following language lines are used by the message shown on webiste.
   | You are free to change them to anything
   | you want to customize your views to better match your application.
   |
   */
    // Dashboard
    'verifyEmail' => 'Please verify your email address. <a href=":link">Click here</a> to resend verification email',
    'noBirthdays' => 'Tidak Ada Yang berulang tahun bulan ini',
    'noAwards' => 'No awards have been given',

    // Employees
    "employeeDelete" => "Pegawai <strong>:name</strong> Berhasil di Hapus",
    "deleteConfirm" => "Apakah anda yakin ingin menghapus  pegawai dengan Nama: <strong>:name</strong>? Silahkan Klik Hapus Untuk Melanjutkan penghapusan secara permanen.<div style=\"margin-top: 10px;padding: 10px;color: #fff;background: #e99210;\">Catatan: Jika anda menghapus Pegawai ini maka data di Absensi, Rekapitulasi dan Keterangan Akan ikut terhapus, Anda bisa menonaktifkan pegawai ini di edit pegawai atau dapat di mutasi ke OPD lain di menu Mutasi Pegawai</div>",
    "deleteSalaryConfirm" => "Apakah anda yakin ingin menghapus: <strong>:type</strong>?",
    'noDepartment' => '<strong>Catatan:</strong> Silahkan Buat Nama Bidang Terlebih dahulu <strong><a href="' . route("admin.departments.index") . '">Klik Disini</a></strong> Sebelum Buat Data Pegawai.',
    'imageSizeLimit' => "<span class=\"label label-danger\">Catatan!</span> Image must be of size :size",
    'basicSalaryInfo' => 'This salary will be used for calculation in payroll',
    'hourlyRateMessage' => 'Hourly Rate (:symbol per hour)',
    'statusRemoveWarning' => '<strong>Note:</strong> Setting status to Active will remove the Exit Date',
    'bankUpdateSuccess' => 'Bank details updated successfully',
    'companyUpdateSuccess' => 'Data OPD Berhasil di update',
    'personalUpdateSuccess' => 'Data Personal Berhasil di update',
    'documentsUpdateSuccess' => 'Documents Berhasil di update',
    'employeeIDUsed' => 'NIP Sudah di gunakan',
    "deleteConfirmCompany" => "Apakah Anda yakin ingin mengahpus OPD ini, Jika OPD di hapus Maka Pegawai Di Alihkan ke Data Base, Apakah anda ingin melanjutkan..",
    "matchColumnMessage" => "Please sort the data you have uploaded by matching the columns in the CSV to the fields in the associated employee fields.",
    "columnMatchSuccess" => "<strong>Well done!</strong> You have successfully matched all the columns. Please click on submit to save.",
    "unmatchedColumns" => "<span id=\"unmatchedCount\">:unmatchCount</span> unmatched columns.",
    "pleaseSelectAColumn" => "Please select a column or click on skip",
    "columnRequired" => "This column is required and must be matched: <strong>:column</strong>",
    "requiredColumnsUnmatched" => "Following fields are required and must be matched: <strong>:columns</strong>",
    "importFail" => "<div class=\"alert alert-danger\"><strong>Oh snap!</strong> Error occurred while importing. Please go back to <a href=\"" . URL::route("admin.employees.import") . "\">Import Employee</a> page and try again. If problem persists, please contact support.",
    "uploadMessage" => 'Upload a CSV containing employee data. If you have excel file, please export it as a CSV first. If you want to add employees manually, you can do so by <a href="javascript:;" onclick="loadView(\'' . route("admin.employees.create") . '\')">clicking here</a>.',

    // Employees
    'employeeDeleteMessage' => "Pegawai  Berhasil di hapus",
    'employeeAddMessage' => "Pegawai Berhasil di tambah",
    'employeeUpdateMessage' => "Pegawai Berhasil di update",
    'employeeImportNote' => "<strong>Note:</strong> You do not need to worry about column order, we will help you match them in next step.",
    'employeeImportError' => "There was an error uploading selected file. Please check your internet connection and try again.",
    'failedRecordsMessage' => "We could not import following employee records. Fail reason is indicated against each.",

    // Departments
    'departmentDeleteMessage' => "Bidang <strong>:department</strong> berhasil di hapus",
    'departmentAddMessage' => "Bidang <strong>:department</strong> berhasil di Tambah",
    'departmentUpdateMessage' => "Bidang <strong>:department</strong> Berhasil di update",

    // Awards
    'awardDeleteMessage' => "Award deleted successfully",
    'awardAddMessage' => "Award <strong>:award</strong> added successfully",
    'awardUpdateMessage' => "Award <strong>:award</strong> updated successfully",
    'awardDeleteConfirm' => "Are you sure you want to delete following award: <strong>:award</strong>?",

    // Expenses
    'expenseDeleteMessage' => "Expense deleted successfully",
    'expenseAddMessage' => "Expense added successfully",
    'expenseUpdateMessage' => "Expense updated successfully",
    'expenseDeleteConfirm' => "Are you sure you want to delete following ?",
    'expenseStatusChangeMessage' => "Status changed successfully",



	
	
	// Holidays
    'holidayDeleteMessage' => "Hari Libur <strong>:holiday</strong> Berhasil di hapus",
    'holidayAddMessage' => "Hari Libur Berhasil di tambahkan",
    'holidayDayMessage' => "Semua :Hari telah di tandai",
    'holidayUpdateMessage' => "Hari libur <strong>:holiday</strong> berhasil di update",
    'holidayDeleteConfirm' => "Apakah yakin ingin menghapus: <strong>:holiday</strong>?",
    'holidayStatusChangeMessage' => "Status Hari libur <strong>:holiday</strong> berhasil di ganti",
    'noHolidays' => 'Tidak ada hari libur',
	
		// Holidays
    'liburshiftDeleteMessage' => "Hari Libur <strong>:liburshift</strong> Berhasil di hapus",
    'liburshiftAddMessage' => "Hari Libur Berhasil di tambahkan",
    'liburshiftDayMessage' => "Semua :Hari telah di tandai",
    'liburshiftUpdateMessage' => "Hari libur <strong>:liburshift</strong> berhasil di update",
    'liburshiftDeleteConfirm' => "Apakah yakin ingin menghapus: <strong>:liburshift</strong>?",
    'liburshiftStatusChangeMessage' => "Status Hari libur <strong>:liburshift</strong> berhasil di ganti",
    'noLiburshifts' => 'Tidak ada hari libur',

    // Attendance
    'attendanceAlreadyMarked' => "<strong>Attendance already marked</strong>",
    'attendanceDeleteMessage' => "Attendance for day <strong>:attendance</strong> removed successfully",
    'attendanceAddMessage' => "Attendance for day <strong>:attendance</strong> added successfully",
    'attendanceUpdateMessage' => "Attendance for day <strong>:attendance</strong> updated successfully",
    'attendanceDeleteConfirm' => "Are you sure you want to remove attendance for following day: <strong>:attendance</strong>?",
    'todayIsHoliday' => 'Hari ini adalah hari libur pada kesempatan: <strong>:date</strong>',
    'attendanceSettings' => '<strong> Terlebih dahulu anda wajib melakukan pengaturan pada Absensi Klik. <a href="' . route("admin.attendance_settings.edit") . '">Disini</a></strong> Untuk Mengunjungi halaman Pengaturan',


    'dataSkorsDeleteConfirm' => 'Apakah anda yakin ingin menghapus: <strong>:leaveType</strong>?',
    'dataSkorsAddMessage' => "Data Skors <strong>:leaveType</strong> Berhasil di tambahkan",
    'dataSkorsUpdateMessage' => "Data Skors <strong>:leaveType</strong> Berhasil di update",
    'dataSkorsDeleteMessage' => "Data Skors  berhasil di hapus",
    "addDataskors" => 'You have to configure leave type before marking attendance. <a href="' . route("admin.dataskors.index") . '">Click Here</a> to configure leave types',
	
	
	'NormalabsensisDeleteConfirm' => 'Are you sure you want to delete this Skor Apel: <strong>:leaveType</strong>?',
    'NormalabsensisAddMessage' => "Absensi Normal <strong>:leaveType</strong> added successfully",
    'NormalabsensisUpdateMessage' => "Absensi Normal Berhasil di edit",
    'NormalabsensisDeleteMessage' => "Absensi Normal  deleted successfully",
    "addNormalabsensis" => 'You have to configure leave type before marking attendance. <a href="' . route("admin.normalabsensis.index") . '">Click Here</a> to configure leave types',
	
	'presentAbsensisDeleteConfirm' => 'Are you sure you want to delete this Skor Apel: <strong>:leaveType</strong>?',
    'presentAbsensisAddMessage' => "Skor Apel <strong>:leaveType</strong> Berhasil di Update",
    'presentAbsensisUpdateMessage' => "Presentase Absensi <strong>:leaveType</strong> updated successfully",
    'presentAbsensisDeleteMessage' => "Skor Apel  deleted successfully",
    "addPresentabsensi" => 'You have to configure leave type before marking attendance. <a href="' . route("admin.presentabsensis.index") . '">Click Here</a> to configure leave types',


	    'golonganPegsDeleteConfirm' => 'Are you sure you want to delete this Skor Apel: <strong>:leaveType</strong>?',
    'golonganPegsAddMessage' => "Skor Apel <strong>:leaveType</strong> Berhasil di Update",
    'golonganPegsUpdateMessage' => "Golongan Pegawai <strong>:leaveType</strong> updated successfully",
    'golonganPegsDeleteMessage' => "Skor Apel  deleted successfully",
    "addGolonganPeg" => 'You have to configure leave type before marking attendance. <a href="' . route("admin.presentabsensis.index") . '">Click Here</a> to configure leave types',


    'leaveTypeDeleteConfirm' => 'Are you sure you want to delete this leave type: <strong>:leaveType</strong>?',
    'leaveTypeAddMessage' => "Leave Type <strong>:leaveType</strong> added successfully",
    'leaveTypeUpdateMessage' => "Leave Type <strong>:leaveType</strong> updated successfully",
    'leaveTypeDeleteMessage' => "Leave Type  deleted successfully",
    "addLeaveTypes" => 'You have to configure leave type before marking attendance. <a href="' . route("admin.leavetypes.index") . '">Click Here</a> to configure leave types',

    'leaveApplicationDeleteConfirm' => 'Apakah anda yakin ingin menghapus  keterangan ini ini??',
    'leaveApplicationAddMessage' => "Keterangan berhasil di tambahkan",
    'leaveApplicationUpdateMessage' => "Keterangan Berhasil di Update",
    'leaveApplicationDeleteMessage' => "Keterangan Berhasil Dihapus",


    'tanggalAbsensiDeleteConfirm' => 'Apakah anda yakin ingin menghapus  Periode Absen ini??',
    'tanggalAbsensiAddMessage' => "Periode Absen berhasil di tambahkan",
    'tanggalAbsensiUpdateMessage' => "Periode Absen Berhasil di Update",
    'tanggalAbsensiDeleteMessage' => "Periode Absen Berhasil di hapus",
	
	
   'tanggalNormalshiftDeleteConfirm' => 'Apakah anda yakin ingin menghapus  Periode Absen Shift Normal ini??',
    'tanggalNormalshiftAddMessage' => "Periode Absen berhasil di tambahkan",
    'tanggalNormalshiftUpdateMessage' => "Periode Absen Berhasil di Ditolak",
    'tanggalNormalshiftDeleteMessage' => "Periode Absen Berhasil di hapus",

    'payrollDeleteConfirm' => 'Apakah yakin anda ingin menghapus Form ini?',
    'payrollAddMessage' => "Berhasil di tambahkan",
    'payrollUpdateMessage' => "Berhasil di Edit",
    'payrollDeleteMessage' => "Berhasil di Hapus",
    'salarySlipExistsMessage' => 'Form Input Kinerja dan Kehadiran pada Bulan dan Tahun yang anda pilih sudah ada, silahkan klik edit form di bawah.!',

    'noticeDeleteConfirm' => 'Are you sure you want to delete this notice?',
    'noticeAddMessage' => "Notice added successfully",
    'noticeUpdateMessage' => "Notice status changed successfully",
    'noticeDeleteMessage' => "Notice deleted successfully",

    'jobDeleteConfirm' => 'Are you sure you want to delete this job opening?',
    'jobAddMessage' => "Job opening added successfully",
    'jobUpdateMessage' => "Job opening status changed successfully",
    'jobDeleteMessage' => "Job opening deleted successfully",

    'jobApplicationsDeleteConfirm' => 'Are you sure you want to delete this job application?',
    'jobApplicationsAddMessage' => "Job application added successfully",
    'jobApplicationsUpdateMessage' => "Job application status changed successfully",
    'jobApplicationsDeleteMessage' => "Job application deleted successfully",

    'adminDeleteConfirm' => "Are you sure you want to delete this Admin?",
    'adminDeleteMessage' => "Admin was deleted successfully",
    'adminAddMessage' => "Admin created successfully",
    'adminUpdateMessage' => "Admin updated successfully",

    "updateCreateMessage" => "Update created successfully",
    "updateUpdateMessage" => "Update changed successfully",
    "updateDeleteConfirm" => "Are you sure you want to delete this update?",
    "updateDeleteMessage" => "Update removed successfully",

    // Billing
    "invoiceAddSuccess" => "Invoice was added successfully",
    "invoiceUpdateSuccess" => "Invoice was updated successfully",
    "invoicePaymentSuccess" => "Invoice was paid successfully",
    "invoicePaymentFail" => "Payment failed. Please try again or contact support!",
    "invoicePaymentCancel" => "Payment was cancelled. Please try again!",

    'loginPageMessage' => 'Login to your account',
    'submitting' => 'Submitting',
    'loginSuccess' => 'Anda Berhasil Login.',
    'loginBlocked' => '<strong>Access Denied!</strong> Akun anda sudah di blokir',
    'loginInvalid' => 'Harap Periksa Email dan Password Anda ',
    'wrongPassword' => 'Kata Sandi Salah',

    'noteLeaveTypes' => '<strong>Half Day</strong> leaves are not added to total leaves on <strong>Employee Dashboard Page</strong>',
    'deleteNoteDepartment' => '<strong>Catatan:</strong> Semua <strong>pegawai</strong> yang terhubung dengan Bidang ini tidak akan memeliki bidang lagi, namun anda dapat mengedit dan memilih bidang baru pada tarik pegawai atau dapatkan informasi pada halaman Pegawai / ASN',
    'deleteNoteDesignation' => 'Deleting/Emptying a designation will delete all the <strong>employees</strong> associated with it',
    'noDept' => '<strong>Note:</strong> There is no <strong>department</strong> in the database. Please create a department first',
    'noDeptTable' => 'Tidak ada Nama Bidang yang di tampilkan',
    'noLeaveType' => 'LeaveType table is Empty',

    'notAuthorised' => 'Sorry! You are not authorised to do this action',
    'companyDisabled' => 'OPD Anda telah di Nonaktifkan Harap Hubungi Super Admin',
    'correctEmail' => 'Enter correct email address',
    'passwordReset' => 'Email sent! Please check your inbox for instructions to reset your password',
    'emailNotFound' => 'Email address not found in our database',
    'bothFieldsRequired' => 'Both fields are required',
    'passwordRequired' => 'Password is required',
    'passwordResetSuccess' => 'Password successfully reset.',
    'passwordChangeSuccess' => '<strong>Success!</strong> Password changed successfully',
    'createdSuccess' => '<strong>Success! </strong>Created successfully',
    'companyRegisterSuccess' => 'Thank you for registering. You will be notified once your company is approved by the administrator',

    'adminCreated' => 'New admin created successfully',
    'updateSuccess' => "Update Berhasil",
    'companyChange' => "Company changed to ",
    'statusChange' => "Status Di Ganti jadi ",
    'statusPerjalanan' => "Status Perjalanan dinas ",
    'objectAddSuccess' => "<strong>:object</strong> Berhasil di Tambahkan",
    'objectUpdateSuccess' => "<strong>:object</strong> Update Berhasil",
    'objectDeleteSuccess' => "<strong>:object</strong> Delete Berhasil",
    'designation0required' => "Nama Jabatan tidak boleh kosong",
    'nameRequired' => "Nama Bidang tidak boleh kosong",


    'leaveRequest' => '<strong>Success! </strong>Your leave request has been sent to the HR Team. You will be notified when it\'s status changes',
    'errorLeaveRequest' => '<strong>Error! </strong> You have already applied for a leave on this date', 'employeeSpecific' => 'Employee Specific',
    'halfDaySpecific' => 'Other leave Specific',
    'departmentDeleteConfirm' => 'Apakah anda yakin ingin menghapus  bidang: ',

    'successApplyJob' => 'Thank you for the submission. The applicant will be notified soon',
    'noJob' => 'No job openings',
    'dateRangeNote' => 'You can either apply for a single leave or multiple leaves at a time',
    'note' => 'Note',
    'noDataTable' => 'No data available in the table',

    // Toastr Messages
    'success' => 'Success',
    'successDelete' => 'Successfully deleted',
    'successUpdate' => "Updated successfully",
    'error' => 'Error',
    'errorTitle' => 'Please fix the error(s) below',
    'successAdd' => 'Added successfully',
    'statusChanged' => 'Status changed',
    'successExpenseAdd' => 'Expense successfully added',
    'designationEmptyNote' => ' (empty if you want to delete the designation)',
    'generalError' => "A server side error occurred. Please try again after sometime!",


    'approveLeave' => 'Apakah Anda yakin ingin menyetujui? Anda tidak akan dapat menolak dan mengedit setelah tindakan ini.',
    'rejectLeave' => 'Apakah Anda yakin ingin menolak? Anda tidak akan dapat menyetujui dan mengedit setelah tindakan ini.',

    //Referral Member
    'referralDeleteMessage' => "Referral Code <strong>:code</strong> deleted successfully",
    'referralDeleteConfirm' => "Are you sure you want to delete following Referral code: <strong>:code</strong>?",
    'backupDeleted' => 'BackUp Deleted',
    'atLeastOneDept' => 'Select at least one department',
    'warningInvoice' => 'You are required to pay the pending invoice to continue using HRM',
    'addNewEmployeeWarning' => 'Adding new employee will convert your license from Free license to Paid version. Are you sure you want to continue?',

    'upgradeYourPlan' => 'To perform this action please upgrade your plan',

    'categoryRequired' => 'Category is required',
    'faqCategoryDeleteConfirm' => 'Are you sure you want to this FAQ category: ',
    'deleteNotefaqCategory' => "<strong>Note:</strong> All the <strong>FAQ\'s</strong> associated with this category will also be deleted",
    'faqCategoryDeleteMessage' => "FAQ Category <strong>:category</strong> deleted successfully",
    'faqDeleteConfirm' => 'Are you sure you want to this FAQ.',
    'faqDeleteMessage' => "FAQ <strong>:faq</strong> deleted successfully",

    'addSuccess' => 'Successfully created',
    'deleteSuccess' => 'Successfully deleted',
    'updateAlert' => 'Do not click update now button if the application is customised. Your changes will be lost.',
    'updateBackupNotice' => 'Take backup of files and database before updating.',
    'smtpError' => 'Your SMTP details are not correct. Please update to correct one',
    'smtpSuccess' => 'Your SMTP details are correct',
    'smtpSecureEnabled' => 'Please check if you have enabled less secure app on your account from here ',
    'smtpNotSet' => 'You have not configured SMTP settings. You might get an error when adding info ',
    'loginAgain' => 'You will have to login again to see the changes.',
    'moduleFile' => 'Module zip file',
    'fileDeleted' => 'File deleted successfully.',
    'noModules' => 'No modules has been installed.',
    'langSuccess' => 'New Language Added successfully'

];
