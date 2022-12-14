<?php $__env->startSection('head'); ?>
    <!-- BEGIN PAGE LEVEL STYLES -->
    <?php echo HTML::style('assets/global/plugins/uniform/css/uniform.default.min.css'); ?>

    <?php echo HTML::style("assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css"); ?>

    <?php echo HTML::style("assets/global/plugins/bootstrap-datepickerabsen/css/bootstrap-datepickerabsen.css"); ?>

    <?php echo HTML::style("assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css"); ?>

    <?php echo HTML::style("assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css"); ?>

    <?php echo HTML::style("assets/global/plugins/bootstrap-form-editable/bootstrap3-editable/css/bootstrap-editable.css"); ?>

    <!-- BEGIN THEME STYLES -->
<?php $__env->stopSection(); ?>


<?php $__env->startSection('mainarea'); ?>


    <!-- BEGIN PAGE HEADER-->
    <div class="page-head">
        <div class="page-title"><h1>
          Data Apel Pegawai (ASN/PHL)
            </h1></div>
    </div>
    <div class="page-bar">
        <ul class="page-breadcrumb breadcrumb">
            <li>
                <a onclick="loadView('<?php echo e(route('admin.dashboard.index')); ?>')"><?php echo e(trans('core.dashboard')); ?></a>
                <i class="fa fa-circle"></i>
            </li>
        
            <li>
                <span class="active">Data Apel Pegawai</span>
            </li>
        </ul>

    </div>
    <!-- END PAGE HEADER-->
    <!-- BEGIN PAGE CONTENT-->
    <div class="row">
        <div class="col-md-12">
            <div class="portlet light bordered">
                <div class="portlet-body form">
                    <?php if(count($leaveTypes) == 0): ?>
                        <div class="note note-warning">
                            <h4 class="block"><?php echo e(trans("core.leaveTypesMissing")); ?></h4>
                            <p>
                                <?php echo trans("messages.addLeaveTypes"); ?>

                            </p>
                        </div>
                    <?php elseif($loggedAdmin->company->attendance_setting_set == 0): ?>
                        <div class="note note-warning">
                            <h4 class="block"><?php echo e(trans("core.setAttendanceSettings")); ?></h4>
                            <p>
                                <?php echo trans("messages.attendanceSettings"); ?>

                            </p>
                        </div>
                    <?php else: ?>
                        <div class="table-toolbar margin-top-15">
                            <div class="row">
                                <div class="col-md-4">
                                    <?php echo Form::open(['route'=>["admin.dataapel.create"], 'method' => 'GET', 'class' => "form-inline", 'id' => "new_date"]); ?>

                                    <div class="btn-group">
                                        <div class="input-group input-medium date date-picker "
                                             data-date-viewmode="years" id="date_change">
                                            <input type="text" class="form-control " name="date"
                                                   placeholder="<?php echo app('translator')->get("core.selectDate"); ?>"
                                                   readonly id="attendence_date" value="<?php echo e($date->format('d-m-Y')); ?>">
                                            <span class="input-group-btn">
															   <button class="btn default" type="button"><i
                                                                           class="fa fa-calendar"></i></button>
															   </span>
                                        </div>
                                    </div>
                                    
                                    <?php echo Form::close(); ?>

                                </div>
                       
                            </div>
                        </div>
              
						
						<?php if($loggedAdmin->company->datashift==1): ?>	
          <?php if(isset($todays_holidays_shift->date)): ?>
                            <div class="note note-warning">
                                <h3><?php if($date->format("l") == "Sunday"): ?> Minggu, <?php endif; ?>
								<?php if($date->format("l") == "Saturday"): ?> Sabtu, <?php endif; ?>
								<?php echo \Carbon\Carbon::parse($todays_holidays->date)->timezone($timeZoneLocal)->format("d M Y"); ?></h3>
                                <h4><?php echo trans("messages.todayIsHoliday", ["date" => $todays_holidays->occassion]); ?></h4>
                            </div>
                        <?php endif; ?>

		<?php else: ?>
          <?php if(isset($todays_holidays->date)): ?>
                            <div class="note note-warning">
                                <h3><?php if($date->format("l") == "Sunday"): ?> Minggu, <?php endif; ?>
								<?php if($date->format("l") == "Saturday"): ?> Sabtu, <?php endif; ?>
								<?php echo \Carbon\Carbon::parse($todays_holidays->date)->timezone($timeZoneLocal)->format("d M Y"); ?></h3>
                                <h4><?php echo trans("messages.todayIsHoliday", ["date" => $todays_holidays->occassion]); ?></h4>
                            </div>
                        <?php endif; ?>
			<?php endif; ?>
						

                        <?php if(count($attendance)==0): ?>
                            <div class="note note-warning">
                                <h4 class="block"><?php echo e(trans("core.employeesMissing")); ?></h4>
                                <p><?php echo e(trans("core.addSomeEmployees")); ?></p>
                            </div>
                        <?php else: ?>
                           <div id="alert_box"></div>
			
						
						
						
						
				<?php if($loggedAdmin->company->datashift==1): ?>	
		   	      <?php if(isset($todays_holidays_shift->date)): ?> 	
						
								  <?php else: ?>
							  									  <?php
$date_jumat12 = $date->format("Y-m-d");
$timestamp12 = strtotime($date_jumat12);
$tampilkanharidata2212= date("l", $timestamp12 );
$tampilkanharidata22 = strtolower($tampilkanharidata2212);

if ($tampilkanharidata22 == "sunday") $carinamahari = "Minggu";
elseif ($tampilkanharidata22 == "monday") $carinamahari = "Senin";
elseif ($tampilkanharidata22 == "tuesday") $carinamahari = "Selasa";
elseif ($tampilkanharidata22 == "wednesday") $carinamahari = "Rabu";
elseif ($tampilkanharidata22 == "thursday") $carinamahari = "Kamis";
elseif ($tampilkanharidata22 == "friday") $carinamahari = "Jumat";
elseif ($tampilkanharidata22 == "saturday") $carinamahari = "Sabtu";
?>
							  	          <?php if(isset($periode_tangal->date)): ?>
                            <div class="note note-success" style="font-size: 18px;">
                                <div ></div>
                                Jenis Absen di alihkan sebagai : <?php echo e($periode_tangal->nama_event); ?> / <span class="label label-info">Pada Hari <?php echo e($carinamahari); ?></span>
                            </div>
							 <?php else: ?>
							<div class="note note-success" style="font-size: 18px; background-color: #c8f3c0;border-color: #8bcc5f;">
                            Jenis Absen yang di gunakan : Normal / <span class="label label-success">Pada Hari <?php echo e($carinamahari); ?></span>
                            </div>
							<?php endif; ?>
                	     <div class="text-left">
                      <h4 >Tanggal Tampilan: <span
                                        id="date_heading"><?php echo e($date->format("d-M-Y")); ?> <?php if($date->isToday()): ?>
                                        (Hari Ini)<?php endif; ?></span></h4>
                            </div>

                            <table class="table table-striped table-bordered table-hover responsive dataTable no-footer dtr-inline collapsed"
                                   id="attendanceTableapel">
                                <thead>
                                <tr>
                       		
                                    <th>Nama Lengkap</th>
                                    <th>Pengaturan</th>
                                   
                  
                                
                                </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            
                            </table>
                      
                        <?php endif; ?>

<?php else: ?>
		   	      <?php if(isset($todays_holidays->date)): ?> 	
						
								  <?php else: ?>
							  									  <?php
$date_jumat12 = $date->format("Y-m-d");
$timestamp12 = strtotime($date_jumat12);
$tampilkanharidata2212= date("l", $timestamp12 );
$tampilkanharidata22 = strtolower($tampilkanharidata2212);

if ($tampilkanharidata22 == "sunday") $carinamahari = "Minggu";
elseif ($tampilkanharidata22 == "monday") $carinamahari = "Senin";
elseif ($tampilkanharidata22 == "tuesday") $carinamahari = "Selasa";
elseif ($tampilkanharidata22 == "wednesday") $carinamahari = "Rabu";
elseif ($tampilkanharidata22 == "thursday") $carinamahari = "Kamis";
elseif ($tampilkanharidata22 == "friday") $carinamahari = "Jumat";
elseif ($tampilkanharidata22 == "saturday") $carinamahari = "Sabtu";
?>
							  	          <?php if(isset($periode_tangal->date)): ?>
                            <div class="note note-success" style="font-size: 18px;">
                                <div ></div>
                                Jenis Absen di alihkan sebagai : <?php echo e($periode_tangal->nama_event); ?> / <span class="label label-info">Pada Hari <?php echo e($carinamahari); ?></span>
                            </div>
							 <?php else: ?>
							<div class="note note-success" style="font-size: 18px; background-color: #c8f3c0;border-color: #8bcc5f;">
                            Jenis Absen yang di gunakan : Normal / <span class="label label-success">Pada Hari <?php echo e($carinamahari); ?></span>
                            </div>
							<?php endif; ?>
                	     <div class="text-left">
                      <h4 >Tanggal Tampilan: <span
                                        id="date_heading"><?php echo e($date->format("d-M-Y")); ?> <?php if($date->isToday()): ?>
                                        (Hari Ini)<?php endif; ?></span></h4>
                            </div>

                            <table class="table table-striped table-bordered table-hover responsive dataTable no-footer dtr-inline collapsed"
                                   id="attendanceTableapel">
                                <thead>
                                <tr>
                       		
                                    <th>Nama Lengkap</th>
                                    <th>Pengaturan</th>
                                   
                  
                                
                                </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            
                            </table>
                      
                        <?php endif; ?>
<?php endif; ?>		
						
						
						
						
						
						
						
						

                        <?php endif; ?>
                    <?php endif; ?>
                </div>
                <!-- END EXAMPLE TABLE PORTLET-->
            </div>
        </div>
        <!-- END PAGE CONTENT-->
    </div>
<style>
.dataTables_scrollBody {
    border-bottom: 0px solid #c2cad8 !important;
}


.dataTables_scrollBody {
overflow: hidden !important;
}


.bootstrap-switch.bootstrap-switch-animate .bootstrap-switch-container {
    -webkit-transition: margin-left .5s;
    height: 29px;
    transition: margin-left .5s;
}
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footerjs'); ?>

    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <?php echo HTML::script("assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js"); ?>

    <?php echo HTML::script('assets/global/plugins/uniform/jquery.uniform.min.js'); ?>

    <?php echo HTML::script("assets/global/plugins/moment.min.js"); ?>

    <?php echo HTML::script("assets/global/plugins/bootstrap-datepickerabsen/js/bootstrap-datepickerabsen.js"); ?>

    <?php echo HTML::script("assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js"); ?>

    <?php echo HTML::script("assets/global/plugins/datatables/datatables.min.js"); ?>

    <?php echo HTML::script("assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js"); ?>

    <?php echo HTML::script("assets/global/plugins/datatables/plugins/responsive/dataTables.responsive.min.js"); ?>

    <?php echo HTML::script("assets/admin/pages/scripts/components-pickersabsen.js"); ?>

    <?php echo HTML::script('assets/js/ajaxform/jquery.form.min.js'); ?>

    <?php echo HTML::script('assets/js/commonjs.js'); ?>

    <?php echo HTML::script('assets/global/plugins/bootstrap-form-editable/bootstrap3-editable/js/bootstrap-editable.min.js'); ?>




    <!-- END PAGE LEVEL PLUGINS -->

    <script>
        var attendanceData = {};
        var employeeIDs = [];

        jQuery(document).ready(function () {
            //ComponentsPickers.init();
            loadDataTable();
        });

    </script>

    <script>
        $('.timepicker').timepicker({
            autoclose: true,
            minuteStep: 3,
            disableMousewheel: true,
            disableFocus: true
        });

        var bindDatePicker = function (element) {
            $(element).timepicker({
                autoclose: true,
                minuteStep: 3,
                disableMousewheel: true,
                disableFocus: true
            });
        };

        var table;

        function loadDataTable() {
            table = $('#attendanceTableapel').dataTable({

                "bProcessing": false,
                "bServerSide": true,
                "ajax": {
                    "url": "<?php echo e(URL::route("admin.apelapel.ajax_attendance")); ?>",
                    "data": function (d) {
                        d.date = $('#attendence_date').val();
                    }
                },
                "aaSorting": [[0, "desc"]],
              "autoWidth": true,
                "autoHeight": true,

                columns: [
                    {data: 'eID', name: 'eID', sWidth: "20%"},
                    {data: 'status', name: 'status', sWidth: "30%"},
          
           
                ],
                "lengthMenu": [
                    [-1],
                    ["All"] // change per page values here
                ],
                iDisplayLength: -1,
                sPaginationType: "full_numbers",
                fnCreatedRow: function (nRow, aData, iDisplayIndex) {
                    var bs = $(nRow).find(".make-bs-switch");

                    if (!bs.data("bootstrap-switch")) {
                        bs.bootstrapSwitch();
                    }

                    var timepicker = $(nRow).find('.timepicker');
                    bindDatePicker(timepicker);
                    $(nRow).find('.late_checkbox').uniform('refresh');
                    $(nRow).find('.half-day-checkbox').uniform('refresh');
                    $(nRow).find('.form-edit').editable({
                        url: ''
                    });

                    $(nRow).find("input").on("change switchChange.bootstrapSwitch", function () {
                        var employeeID = $(nRow).find("input[name='employees[]']").val();
                        var obj = {
                            employeeID: employeeID,
                            status: $(nRow).find(".make-bs-switch").bootstrapSwitch('state'),
                            leaveType: $(nRow).find(".leaveType").val(),
                            ApelPagi: $(nRow).find(".ApelPagi").val(),
                            ApelSore: $(nRow).find(".ApelSore").val(),
                            halfDay: $(nRow).find(".half-day-checkbox").prop("checked"),
                            reason: $(nRow).find(".reason").val(),
                            clock_in: $(nRow).find(".clockin").val(),
                            clock_out: $(nRow).find(".clockout").val(),
                            late: $(nRow).find(".late_checkbox").prop("checked")
                        };
                        attendanceData[employeeID] = obj;
                    });

                },
                "fnInitComplete": function () {
                    $(".dataTables_info").addClass("hidden");
                    $(".dataTable").removeClass("hidden");
                },
                      scrollY: false,
             scrollCollapse: true,
			paging: false,
                deferRender: true
//		 bInfo : false

            });

        }

        function showHide(id) {
            if ($('#checkbox' + id + ':checked').val() == 'on') {
                $('#leaveForm' + id).addClass("hidden");
            } else {
                $('#leaveForm' + id).removeClass("hidden");

                var leaveType = $('#leaveType' + id).val();
                if (leaveType == 'half day') {
                    $('#halfLeaveType' + id).show();
                }
            }
        }

        function halfDayToggle(id, value) {

            if (value == 'half day') {
//			 $('#halfDayLabel').show(100);
                $('#halfLeaveType' + id).show(100);
            } else {
                $('#halfLeaveType' + id).hide(100);
            }

        }

        $('#date_change').datepickerabsen({
            format: "dd-mm-yyyy",
            todayHighlight: true,
            toggleActive: true,
            autoclose: true
        }).on('changeDate', function (e) {
            var url = "<?php echo e(route("admin.dataapel.edit", "#id")); ?>";
            var date = moment($('#attendence_date').val(), 'DD-MM-YYYY').format('YYYY-MM-DD');
            url = url.replace("#id", date);
            loadView(url);
        });

        function ajaxUpdateAttendance() {

            var data = JSON.stringify(attendanceData);

            var date = $('#attendence_date').val();
            var url = "<?php echo e(route("admin.dataapel.update", "#id")); ?>";
            url = url.replace("#id", date);

            $.ajax({
                url: url,
                dataType: 'json',
                data: {data: data, _method: "PATCH", _token: "<?php echo e(csrf_token()); ?>"},
                method: 'POST',
                beforeSend: function () {
                    $('#update_attendence').attr("disabled", true);
                },
                success: function (response) {
                    $('#update_attendence').attr("disabled", false);
                    showResponseMessage(response, 'error');
                    var route = "<?php echo e(route("admin.attendances.edit", "#id")); ?>";
                    var date = moment(response.date);

                    var url = route.replace("#id", date.format("YYYY-MM-DD"));
                    loadView(url);
                },
                error: function (xhr, textStatus, thrownError) {
                    resposeArray = {
                        "status": "fail",
                        "errorCode": "unkonwn",
                        "message": "Problem logging in, please try again!"
                    };
                    showResponseMessage(resposeArray, "error");
                }
            });
            return false;
        }

        function attendanceRow(id) {

            loadingButton("#update_row" + id);
            var status = null;
            var apel_pagi = null;
            var half_day = null;
            var apel_sore = null;
            var clock_in_ip = $('#clock_in_ip' + id).html();
            var clock_out_ip = $('#clock_out_ip' + id).html();
            var work = $('#work' + id).html();
            var notes = $('#notes' + id).html();
            var attendance_date = $('#attendence_date').val();
            var is_late = $("#late" + id).is(":checked");

            if ($('#checkbox' + id).is(":checked") == true) {
                status = "present";
            } else {
                status = "absent";
                apel_pagi = $('#ApelPagi' + id).val();
                half_day = $('#halfDay' + id).is(':checked');
                apel_sore = $('#ApelSore' + id).val();
            }

            var clock_in = $('#clock_in' + id).val();
            var clock_out = $('#clock_out' + id).val();

            $.ajax({
                type: "POST",
                url: "<?php echo route('admin.apelapel.update.row'); ?>",
                data: {
                    "id": id,
                    "status": status,
                    "apel_pagi": apel_pagi,
                    "half_day": half_day,
                    "apel_sore": apel_sore,
                    "clock_in": clock_in,
                    "clock_out": clock_out,
                    "date": attendance_date,
                    "clock_in_ip": clock_in_ip,
                    "clock_out_ip": clock_out_ip,
                    "work": work,
                    "notes": notes,
                    "is_late": is_late
                }
            }).done(function (response) {
                unloadingButton("#update_row" + id);
                showResponseMessage(response, 'error');
                var late_badge = '';
                if (response.checkbox == "1") {
                    $("#uniform-late" + id + " span").addClass("checked");
                    late_badge = '<span class="label label-danger">Late</span>';
                } else {
                    $("#uniform-late" + id + " span").removeClass("checked");
                }

                $("#updateCell" + id).parent("td").html(response.divHTML);

                $('.form-edit').editable({
                    url: ''
                });

            }).fail(function (response) {
                unloadingButton("#update_row" + id);
                showToastrMessage("<?php echo app('translator')->get("messages.generalError"); ?>", "<?php echo app('translator')->get("core.error"); ?>", "error");
            });
        }
		

    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.adminlayouts.adminlayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\newabsen\resources\views/admin/dataapel/edit.blade.php ENDPATH**/ ?>