<?php $__env->startSection('head'); ?>
    <!-- BEGIN PAGE LEVEL STYLES -->

    <?php echo HTML::style("assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css"); ?>

    <!-- END PAGE LEVEL STYLES -->

<?php echo HTML::style('front_assets/plugins/sky-forms/version-2.0.1/css/custom-sky-forms.css'); ?>

    <?php echo HTML::style("assets/global/plugins/select2/css/select2.css"); ?>

    <?php echo HTML::style("assets/global/plugins/select2/css/select2-bootstrap.min.css"); ?>


    <!-- BEGIN THEME STYLES -->

<?php $__env->stopSection(); ?>


<?php $__env->startSection('mainarea'); ?>


    <!-- BEGIN PAGE HEADER-->
    <div class="page-head">
        <div class="page-title"><h1>
             Form Buat Keterangan Perjalanan Dinas
            </h1></div>
    </div>
    <div class="page-bar">
        <ul class="page-breadcrumb breadcrumb">
            <li>
                <a onclick="loadView('<?php echo e(route('admin.dashboard.index')); ?>')"><?php echo e(trans('core.dashboard')); ?></a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <a onclick="loadView('<?php echo e(route('admin.leave_applications.index')); ?>')">Data Keterangan</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span class="active">Form Buat Keterangan</span>
            </li>

        </ul>

    </div>
    <!-- END PAGE HEADER-->

    <!-- BEGIN PAGE CONTENT-->
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->

            

            


            <div class="portlet light bordered">
                           <div class="portlet-title">
                    <div class="caption font-blue">
                        <i class="fa fa-plus font-blue"></i>              Form Buat Keterangan Perjalanan Dinas 
                    </div>
        
                </div>
                <div class="portlet-body form">
            <?php echo Form::open(array('class'=>'form-horizontal ','method'=>'POST','id'=>'leave_type_update_form')); ?>

            <div class="modal-body">
                <div class="portlet-body form">
                    <!-- BEGIN FORM-->
                    <div class="form-body">
                        <div class="form-group">
					     <input type="hidden" name="days" id="days" value="0">
                    <input type="hidden" name="leaveformType" id="leaveformType" value="date_range">
						    <input type="hidden" name="company_id" id="company_id" value="<?php echo e($loggedAdmin->company_id); ?>">
						
                            <label class="col-md-4 control-label">Nama Pegawai<span
                                        class="required">
                                        * </span>
                            </label>

                            <div class="col-md-6">
                                   <select class="form-control select2me" id="employee_id" name="employee_id">
						   <option selected disabled>Silahkan Pilih Pegawai</option>
                <?php $__currentLoopData = $employees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $employee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($employee->id); ?>"><?php echo e($employee->full_name); ?> (<?php echo e($employee->statusmupeg); ?>)</option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
                                <span class="help-block"></span>
                            </div>
                        </div>
						
						              <div class="form-group">
                            <label class="col-md-4 control-label">Nomor/Surat
                                <span
                                        class="required">
                                         </span>
                                </span>
                            </label>

                            <div class="col-md-6">
                                             <input class="form-control" type="text" name="no_surat" id="no_surat"
                                           placeholder="Ketik Nomor Surat">
										     <small>Dapat di kosongkan</small>
                                <span class="help-block"></span>
                            </div>
                        </div>
						
						
						

                        <div class="form-group">
                            <label class="col-md-4 control-label">Tanggal Mulai
                                <span
                                        class="required">
                                        * </span>
                                </span>
                            </label>

                            <div class="col-md-6">
                                             <input class="form-control" type="text" name="start_date" id="start_date"
                                           placeholder="Tanggal Mulai" readonly>
                                <span class="help-block"></span>
                            </div>
                        </div>
						
						
						
						   <div class="form-group">
                            <label class="col-md-4 control-label">Tanggal Berakhir
                                <span
                                        class="required">
                                        * </span>
                                </span>
                            </label>

                            <div class="col-md-6">
                                   <input class="form-control" type="text" name="end_date" id="end_date"
                                           placeholder="Tanggal Berakhir" readonly>
                                <span class="help-block"></span>
                            </div>
                        </div> 
						
						
						
						<div class="form-group">
                            <label class="col-md-4 control-label" style="padding: 0px;">
                                   <span
                                        class="required">
                                        </span>
                             
                            </label>

                            <div class="col-md-6">
                   Total Hari
                       
                            <span id="daysSelected" class="badge rounded-2x badge-red">0</span>

                       
                            </div>
                        </div>
					
						            <div class="form-group">
                            <label class="col-md-4 control-label">Pilih Keterangan
                                <span
                                        class="required">
                                        * </span>
                                </span>
                            </label>

                            <div class="col-md-6">
                            <select class="form-control select2me" id="date_range_leaveType" name="leaveType">
						   <option selected disabled>Pilih Keterangan</option>
                <?php $__currentLoopData = $leavetypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $idku): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<?php if($idku->waktumundur != "1" ): ?>  <?php else: ?>
			 <option value="<?php echo e($idku->singkat); ?>"><?php echo e($idku->leaveType); ?> (<?php echo e($idku->singkat); ?>)</option>
				<?php endif; ?>
				
				
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
                                <span class="help-block"></span>
                              
                            </div>
                        </div>
						
						
						
						
						
						
						
						
						
								            <div class="form-group">
                            <label class="col-md-4 control-label">Ketik Alasan
                                
                                <span
                                        class="required">
                                        * </span>
                                </span>
                            </label>

                            <div class="col-md-6">
                                    <textarea class="form-control" name="reason"></textarea>
                                <span class="help-block"></span>
                         <small>Silahkan Ketik beberapa kata</small>
                            </div>
                        </div>
						
						
						
						
						
                    </div>
                    <!-- END FORM-->
                </div>
            </div>

            <div class="modal-footer">
                <div class="row">
                    <div style="text-align:center;">
		
                 <button type="button" onclick="addUpdateLeaveType();return false;" class="btn green btn-lg">
                            <i class="fa fa-check"></i> Lanjutkan Buat Keterangan</button>

                    </div>
                </div>
            </div>
            <?php echo Form::close(); ?>


   <!-- END FORM-->

                    </div>
                </div>
                <!-- END EXAMPLE TABLE PORTLET-->

            </div>
        </div>
    </div>
    <!-- END PAGE CONTENT-->


<?php $__env->stopSection(); ?>

<?php $__env->startSection('footerjs'); ?>


    <?php echo HTML::script("assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js"); ?>

    <?php echo HTML::script("assets/global/plugins/datatables/datatables.min.js"); ?>

    <?php echo HTML::script("assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js"); ?>

    <?php echo HTML::script("assets/admin/pages/scripts/table-managed.js"); ?>


    <?php echo HTML::script("assets/global/plugins/jquery-multi-select/js/jquery.multi-select.js"); ?>


<!-- JS Implementing Plugins -->
<?php echo HTML::script('front_assets/plugins/back-to-top.js'); ?>


<!-- Scrollbar -->

<?php echo HTML::script('front_assets/plugins/scrollbar/src/perfect-scrollbar.js'); ?>


  <?php if($loggedAdmin->company->perjalanan =='active'): ?>

  <script id="rendered-js" >
			        $.fn.select2.defaults.set("theme", "bootstrap");
        $('.select2me').select2({
            placeholder: "Select",
            width: '100%',
            allowClear: false
        });								  
											  

	         jQuery(document).ready(function ($) {
        "use strict";
        $('.contentHolder').perfectScrollbar();

        $('#start_date').datepicker({
            dateFormat: 'yy-mm-dd',
            prevText: '<i class="fa fa-angle-left"></i>',
            nextText: '<i class="fa fa-angle-right"></i>',
            minDate: -<?php echo e($loggedAdmin->company->waktumundur); ?>,

            onSelect: function (selectedDate) {

                var diff = ($("#end_date").datepicker("getDate") -
                    $("#start_date").datepicker("getDate")) /
                    1000 / 60 / 60 / 24 + 1; // days
                if ($("#end_date").datepicker("getDate") != null) {
                    $('#daysSelected').html(diff);
                    $('#days').val(diff);
                }
                $('#end_date').datepicker('option', 'minDate', selectedDate);
            }
        });
        $('#end_date').datepicker({
            dateFormat: 'yy-mm-dd',
            prevText: '<i class="fa fa-angle-left"></i>',
            nextText: '<i class="fa fa-angle-right"></i>',
            onSelect: function (selectedDate) {

                $('#start_date').datepicker('option', 'maxDate', selectedDate);

                var diff = ($("#end_date").datepicker("getDate") -
                    $("#start_date").datepicker("getDate")) /
                    1000 / 60 / 60 / 24 + 1; // days
                if ($("#start_date").datepicker("getDate") != null) {
                    $('#daysSelected').html(diff);
                    $('#days').val(diff);
                }

            }
        });

    });

	    function addUpdateLeaveType(id) {

            if (typeof id != 'undefined') {
                var url = "<?php echo e(route('admin.newleave.update',':id')); ?>";
                url = url.replace(':id', id);
            } else {
                url = "<?php echo e(route('admin.newleave.store')); ?>";
            }
            $.easyAjax({
                type: 'POST',
                url: url,
                container: '#leave_type_update_form',
                data: $('#leave_type_update_form').serialize(),
                success: function (response) {
                    if (response.status == "success") {
           window.location.replace("../leave_applications");
                    }

                }
            });
        }

	


    </script> 
	  <?php else: ?>  

	  <script id="rendered-js" >
			        $.fn.select2.defaults.set("theme", "bootstrap");
        $('.select2me').select2({
            placeholder: "Select",
            width: '100%',
            allowClear: false
        });								  
											  

	         jQuery(document).ready(function ($) {
        "use strict";
        $('.contentHolder').perfectScrollbar();

        $('#start_date').datepicker({
            dateFormat: 'yy-mm-dd',
            prevText: '<i class="fa fa-angle-left"></i>',
            nextText: '<i class="fa fa-angle-right"></i>',
            minDate: -1,

            onSelect: function (selectedDate) {

                var diff = ($("#end_date").datepicker("getDate") -
                    $("#start_date").datepicker("getDate")) /
                    1000 / 60 / 60 / 24 + 1; // days
                if ($("#end_date").datepicker("getDate") != null) {
                    $('#daysSelected').html(diff);
                    $('#days').val(diff);
                }
                $('#end_date').datepicker('option', 'minDate', selectedDate);
            }
        });
        $('#end_date').datepicker({
            dateFormat: 'yy-mm-dd',
            prevText: '<i class="fa fa-angle-left"></i>',
            nextText: '<i class="fa fa-angle-right"></i>',
            onSelect: function (selectedDate) {

                $('#start_date').datepicker('option', 'maxDate', selectedDate);

                var diff = ($("#end_date").datepicker("getDate") -
                    $("#start_date").datepicker("getDate")) /
                    1000 / 60 / 60 / 24 + 1; // days
                if ($("#start_date").datepicker("getDate") != null) {
                    $('#daysSelected').html(diff);
                    $('#days').val(diff);
                }

            }
        });

    });

	    function addUpdateLeaveType(id) {

            if (typeof id != 'undefined') {
                var url = "<?php echo e(route('admin.newleave.update',':id')); ?>";
                url = url.replace(':id', id);
            } else {
                url = "<?php echo e(route('admin.newleave.store')); ?>";
            }
            $.easyAjax({
                type: 'POST',
                url: url,
                container: '#leave_type_update_form',
                data: $('#leave_type_update_form').serialize(),
                success: function (response) {
                    if (response.status == "success") {
           window.location.replace("../leave_applications");
                    }

                }
            });
        }

	


    </script>
	  
	  <?php endif; ?>


  	      
	
<?php $__env->stopSection(); ?>


									
<?php echo $__env->make('admin.adminlayouts.adminlayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\newabsen\resources\views/admin/newleave_dl/create.blade.php ENDPATH**/ ?>