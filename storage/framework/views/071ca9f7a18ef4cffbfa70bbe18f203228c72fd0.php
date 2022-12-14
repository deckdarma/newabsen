<?php $__env->startSection('head'); ?>

    <!-- BEGIN PAGE LEVEL STYLES -->
    <?php echo HTML::style('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css'); ?>

    <?php echo HTML::style('assets/global/plugins/bootstrap-datepickerabsen/css/bootstrap-datepickerabsen.css'); ?>

    <?php echo HTML::style("assets/global/plugins/cropper/cropper.min.css"); ?>

    <!-- END PAGE LEVEL STYLES -->

<?php $__env->stopSection(); ?>


<?php $__env->startSection('mainarea'); ?>

    <!-- BEGIN PAGE HEADER-->
    <div class="page-head">
        <div class="page-title"><h1>
   Tambah PHL
            </h1></div>
    </div>
    <ul class="page-breadcrumb breadcrumb">
        <li>
            <a onclick="loadView('<?php echo e(route('admin.dashboard.index')); ?>')"><?php echo e(trans('core.dashboard')); ?></a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <a onclick="loadView('<?php echo e(route('admin.employees.index')); ?>')"><?php echo e(trans("pages.employees.indexTitle")); ?></a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span class="active">Tambah PHL</span>
        </li>
    </ul>            <!-- END PAGE HEADER-->

    <?php if(count($department)==0): ?>
        <div class="note note-warning">
            <?php echo trans('messages.noDepartment'); ?>

        </div>
    <?php else: ?>

        <?php if($canCreateEmployee): ?>

            <?php echo Form::open(['class'=>'form-horizontal ajax_form','method'=>'POST','files' => true, 'autocomplete' => 'off']); ?>

            <div class="row ">
                <div class="col-md-6 col-sm-6">
                    <div class="portlet light bordered">
                        <div class="portlet-title">
                            <div class="caption font-purple-wisteria">
                                <i class="fa fa-user font-purple-wisteria"></i>Informasi PHL
                            </div>

                        

                        </div>
                        <div class="portlet-body">

                            <div class="form-body">
                                <div class="form-group ">
                                    <label class="control-label col-md-3">Foto / Gambar
                                        <?php echo help_text("employeeImageSize"); ?></label>

                                    <div class="col-md-9">

                                        <!-- Modal -->
                                        <div class="modal fade" id="cropModal" aria-labelledby="modalLabel"
                                             role="dialog" tabindex="-1" data-backdrop="static">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title" id="modalLabel">Potong Gambar</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div>
                                                                    <img id="cropImage" src="" alt=""
                                                                         style="max-height: 500px">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" id="cropButton" class="btn btn-primary"
                                                                data-dismiss="modal">Lanjutkan Potong
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                            <div class="fileinput-new thumbnail" style="width: 200px; height: 200px;">
                                                     <img id="imagePath"
                                                     src="../../uploads/default.jpg"
                                                     alt=""/>

                                            </div>

                                            <input type="hidden" value="" name="cropData" id="cropData"/>

                                            <div class="fileinput-preview fileinput-exists thumbnail"
                                                 style="max-width: 200px; max-height: 200px;" id="result"></div>
                                            <div>
                                        <span class="btn default btn-file">
                                            <span class="fileinput-new">
                                                <?php echo e(trans('core.selectImage')); ?> </span>
                                            <span class="fileinput-exists">
                                                <?php echo e(trans('core.change')); ?> </span>
                                            <input type="file" id="picImage" name="profile_image">
                                        </span>
                                                <a href="#" class="btn red fileinput-exists" data-dismiss="fileinput">
                                                    <?php echo e(trans('core.remove')); ?> </a>
                                            </div>
                                        </div>
                                        <div class="clearfix margin-top-10">
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Nama Lengkap <span
                                                class="required">* </span></label>

                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="full_name"
                                               placeholder="Ketik Nama Lengkap"
                                               value="<?php echo e(old('full_name')); ?>">
                                    </div>
                                </div>

                                  <input type="hidden" class="form-control" name="father_name"
                                               value="kabbangai">
											      <input type="hidden" class="form-control" name="firstphl"
                                               value="1">
                                <div class="form-group">
                                    <label class="control-label col-md-3">Tanggal Lahir</label>

                                    <div class="col-md-3">
                                        <div class="input-group input-medium date date-picker"
                                             data-date-format="dd-mm-yyyy"
                                             data-date-viewmode="years">
                                            <input type="text" class="form-control" name="date_of_birth" readonly
                                                   value="<?php echo e(old('date_of_birth')); ?>">

                                            <span class="input-group-btn">
                                        <button class="btn default" type="button"><i class="fa fa-calendar"></i>
                                        </button>
										
                                    </span>
                                        </div>
			
                                    </div>
									
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Kelamin</label>

                                    <div class="col-md-9">
                                        <?php echo Form::select('gender', ['male' => __('Laki-Laki'), 'female' => __('Wanita')], old('gender'),['class'=>'form-control']); ?>

										  <span class="help-block">Kosongkan Jika tidak diperlukan</span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label">No. Hanphone</label>

                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="mobile_number"
                                               placeholder="Ketik No HP"
                                               value="<?php echo e(old('mobile_number')); ?>">
											     <span class="help-block">Kosongkan Jika tidak diperlukan</span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Alamat Saat Ini</label>

                                    <div class="col-md-9">
                                <textarea class="form-control" name="statusmupeg"
                                          rows="3"><?php echo e(old('statusmupeg')); ?></textarea>
										  <span class="help-block">Kosongkan Jika tidak diperlukan</span>
                                    </div>
									
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Alamat Lainnya</label>

                                    <div class="col-md-9">
                                <textarea class="form-control" name="permanent_address"
                                          rows="3"><?php echo e(old('permanent_address')); ?></textarea>
										  										 
                                    </div>
                                </div>

                      
<?php

$data = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
$random = rand(1234567890, strlen($data));

?>
  <input type="hidden" name="email" class="form-control"
                                               value="peg<?php echo e($random); ?>@banggaikab.go.id">
                    <input type="hidden" name="oldpassword">
                                        <input type="hidden" name="password" class="form-control"
                                               value="123456<?php echo e($random); ?>">

                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6">
                    <div class="portlet light bordered">
                        <div class="portlet-title">
                            <div class="caption font-red-sunglo">
                                <i class="fa fa-industry font-red-sunglo"></i> <?php echo e(trans('core.companyDetails')); ?>

                            </div>

                        </div>
                        <div class="portlet-body">

                            <div class="form-body">
                         <input type="hidden" class="form-control dattanomors" name="employeeID"
                                         
                                               value="<?php echo e($random); ?>">
											           <input type="hidden" class="form-control dattanomors" name="statusmupeg"
                    
                                               value="PHL">
                                <div class="form-group">
                                    <label class="col-md-3 control-label"><?php echo e(trans('core.department')); ?></label>

                                    <div class="col-md-9">
                                        <?php echo Form::select('department', $department,null,['class' => 'form-control select2me','id'=>'department','onchange'=>'dept();return false;']); ?>

                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label"><?php echo e(trans('core.designation')); ?></label>

                                    <div class="col-md-9">

                                        <select class="select2me form-control" name="designation" id="designation">

                                        </select>
                                    </div>
                                </div>
								
								
										<?php if($loggedAdmin->company->datashift==1): ?>
						<div class="form-group">
                            <label class="col-md-3 control-label">PHL Shift<span
                                        class="required">* </span></label>

                            <div class="col-md-9">

                                   <select class="form-control" name="shift">

                                    <option selected disabled>Pilih Jenis PHL Shift</option>
                                    <option value="1" >YA</option>
                                    <option value="0" >TIDAK</option>
                            
                                </select>
								<small>Jika Anda Memilih YA berarti PHL masuk dalam kategori shift</small>
                            </div>
                        </div>	
						<?php else: ?>
						<input type="hidden" name="shift" class="form-control" value="0">
						<?php endif; ?>
								
								
								
					<div class="form-group" style="display:none">
                            <label class="col-md-3 control-label">Golongan<span
                                        class="required">* </span></label>

                            <div class="col-md-9">

                                   <select class="form-control" name="golongan">
<?php $__currentLoopData = $golonganpeg; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($data->id); ?>" ><?php echo e($data->golonganPeg); ?></option>
                    	 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>           
                                </select>
                            </div>
                        </div>
						
              <input type="hidden" name="annual_leave" class="form-control" value="0">
              <input type="hidden" name="statusmupeg" class="form-control" value="PHL">
             <input type="hidden" class="form-control" name="joining_date" readonly
                                                   value="<?php if( null !==old('joining_date') ): ?><?php echo e(old('joining_date')); ?> <?php else: ?> <?php echo e(date('d-m-Y')); ?><?php endif; ?>">

           
                                  <div class="form-group">
                                    <label class="col-md-3 control-label">Jumlah Honorium </label>

                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="basicSalary"
                                               placeholder="Ketik Jumlah Honorium" value="0">
                                        <span class="help-block">Harap Ketik Honorium (Rp)</span>
                                    </div>
                                </div>
             <input type="hidden" class="form-control" name="hourlyRate"
                                                value="0">
                            </div>
        
		   <div class="portlet-body" style="display:none">

                            <div class="form-body">
                                <div class="form-group">
                                    <label class="col-md-3 control-label"><?php echo e(trans('core.accountHolder')); ?></label>

                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="account_name"
                                               placeholder="<?php echo e(trans('core.accountHolder')); ?>"
                                               value="<?php echo e(old('account_name')); ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label"><?php echo e(trans('core.account_number')); ?></label>

                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="account_number"
                                               placeholder="<?php echo e(trans('core.account_number')); ?>"
                                               value="<?php echo e(old('account_number')); ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label"><?php echo e(trans('core.bank')); ?></label>

                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="bank"
                                               placeholder="<?php echo e(trans('core.bank')); ?>" value="<?php echo e(old('bank')); ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label"><?php echo e(trans('core.bin')); ?> <?php echo help_text("bankIdentificationCode"); ?></label>

                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="bin"
                                               placeholder="<?php echo e(trans('core.bin')); ?>" value="<?php echo e(old('bin')); ?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label"><?php echo e(trans('core.branch')); ?></label>

                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="branch"
                                               placeholder="<?php echo e(trans('core.branch')); ?>" value="<?php echo e(old('branch')); ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label"><?php echo e(trans('core.tax_payer_id')); ?> <?php echo help_text("taxPayerID"); ?></label>

                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="tax_payer_id"
                                               placeholder="<?php echo e(trans('core.tax_payer_id')); ?>"
                                               value="<?php echo e(old('tax_payer_id')); ?>">
                                    </div>
                                </div>
                            </div>

                        </div>
		
		
		<div class="form-body" style="display:none">
                                    <div class="form-group">
                                        <label class="control-label col-md-2"><?php echo e(trans('core.resume')); ?></label>

                                        <div class="col-md-5">
                                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                                <div class="input-group input-large">
                                                    <div class="form-control uneditable-input" data-trigger="fileinput">
                                                        <i class="fa fa-file fileinput-exists"></i>&nbsp; <span
                                                                class="fileinput-filename">
                                                </span>
                                                    </div>
                                                    <span class="input-group-addon btn default btn-file">
                                                <span class="fileinput-new">
                                                    <?php echo e(trans('core.selectFile')); ?> </span>
                                                <span class="fileinput-exists">
                                                    <?php echo e(trans('core.change')); ?> </span>
                                                <input type="file" name="resume">
                                            </span>
                                                    <a href="#" class="input-group-addon btn red fileinput-exists"
                                                       data-dismiss="fileinput">
                                                        <?php echo e(trans('core.remove')); ?> </a>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-2"><?php echo e(trans("core.offerLetter")); ?></label>

                                        <div class="col-md-5">
                                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                                <div class="input-group input-large">
                                                    <div class="form-control uneditable-input" data-trigger="fileinput">
                                                        <i class="fa fa-file fileinput-exists"></i>&nbsp; <span
                                                                class="fileinput-filename">
                                                </span>
                                                    </div>
                                                    <span class="input-group-addon btn default btn-file">
                                                <span class="fileinput-new">
                                                    <?php echo e(trans('core.selectFile')); ?> </span>
                                                <span class="fileinput-exists">
                                                    <?php echo e(trans('core.change')); ?> </span>
                                                <input type="file" name="offerLetter">
                                            </span>
                                                    <a href="#" class="input-group-addon btn red fileinput-exists"
                                                       data-dismiss="fileinput">
                                                        <?php echo e(trans('core.remove')); ?> </a>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-2"><?php echo e(trans("core.joiningLetter")); ?></label>

                                        <div class="col-md-5">
                                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                                <div class="input-group input-large">
                                                    <div class="form-control uneditable-input" data-trigger="fileinput">
                                                        <i class="fa fa-file fileinput-exists"></i>&nbsp; <span
                                                                class="fileinput-filename">
                                                </span>
                                                    </div>
                                                    <span class="input-group-addon btn default btn-file">
                                                <span class="fileinput-new">
                                                    <?php echo e(trans('core.selectFile')); ?> </span>
                                                <span class="fileinput-exists">
                                                    Change </span>
                                                <input type="file" name="joiningLetter">
                                            </span>
                                                    <a href="#" class="input-group-addon btn red fileinput-exists"
                                                       data-dismiss="fileinput">
                                                        <?php echo e(trans('core.remove')); ?> </a>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-2"><?php echo e(trans("core.contractOrAgreement")); ?></label>

                                        <div class="col-md-5">
                                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                                <div class="input-group input-large">
                                                    <div class="form-control uneditable-input" data-trigger="fileinput">
                                                        <i class="fa fa-file fileinput-exists"></i>&nbsp; <span
                                                                class="fileinput-filename">
                                                </span>
                                                    </div>
                                                    <span class="input-group-addon btn default btn-file">
                                                <span class="fileinput-new">
                                                    <?php echo e(trans('core.selectFile')); ?> </span>
                                                <span class="fileinput-exists">
                                                    Change </span>
                                                <input type="file" name="contract">
                                            </span>
                                                    <a href="#" class="input-group-addon btn red fileinput-exists"
                                                       data-dismiss="fileinput">
                                                        <?php echo app('translator')->get("core.remove"); ?> </a>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-2"><?php echo e(trans("core.idProof")); ?></label>

                                        <div class="col-md-5">
                                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                                <div class="input-group input-large">
                                                    <div class="form-control uneditable-input" data-trigger="fileinput">
                                                        <i class="fa fa-file fileinput-exists"></i>&nbsp; <span
                                                                class="fileinput-filename">
                                                </span>
                                                    </div>
                                                    <span class="input-group-addon btn default btn-file">
                                                <span class="fileinput-new">
                                                    <?php echo e(trans('core.selectFile')); ?> </span>
                                                <span class="fileinput-exists">
                                                    <?php echo app('translator')->get("core.change"); ?> </span>
                                                <input type="file" name="IDProof">
                                            </span>
                                                    <a href="#" class="input-group-addon btn red fileinput-exists"
                                                       data-dismiss="fileinput">
                                                        <?php echo app('translator')->get("core.remove"); ?>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
								
								
								
								
                                        <div class="form-group">
                                    <label class="col-md-3 control-label"></label>

                                    <div class="col-md-9">
                                   <button type="button" onclick="addEmployee();return false;" class=" btn green btn-lg">
                                                       Lanjutkan Buat Data Pegawai
                                                    </button>
                                    </div>
                                </div>
                                               

                        </div>
                    </div>
                </div>
             
            </div>
        
            <?php echo Form::close(); ?>


        <?php else: ?>
            <div class="note note-warning">
                <?php echo trans('messages.upgradeYourPlan'); ?>

            </div>

        <?php endif; ?>
    <?php endif; ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('footerjs'); ?>


    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <?php echo HTML::script('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js'); ?>

    <?php echo HTML::script('assets/global/plugins/bootstrap-datepickerabsen/js/bootstrap-datepickerabsen.js'); ?>

    <?php echo HTML::script("assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js"); ?>

    <?php echo HTML::script('assets/admin/pages/scripts/components-pickersabsen.js'); ?>

    <?php echo HTML::script("assets/global/plugins/cropper/cropper.min.js"); ?>

    <!-- END PAGE LEVEL PLUGINS -->




    <script>
        jQuery(document).ready(function () {

            ComponentsPickers.init();
            dept();


        });

        function dept() {

            $.getJSON("<?php echo e(URL::to('admin/departments/ajax_designation/')); ?>",
                {
                    department_id: $('#department').val()
                },
                function (data) {
                    var model = $('#designation');
                    model.empty();
                    $.each(data, function (index, element) {
                        model.append("<option value='" + element.id + "'>" + element.designation + "</option>");
                    });

                });

        }

    </script>
    <script>
        $(function () {

            var $previews = $('.preview');

            $('#cropModal').on('shown.bs.modal', function () {
                var $image = $('#cropImage');
                var $button = $('#cropButton');
                var $result = $('#result');
                var croppable = false;

                $image.cropper({
                    aspectRatio: 1,
                    viewMode: 2,
                    guides: false,
                    zoomable: false,
                    zoomOnTouch: false,
                    zoomOnWheel: false,
                    rotatable: false,
                    build: function () {
                        croppable = true;
                    }
                });

                $button.on('click', function () {
                    var croppedCanvas;
                    var roundedCanvas;

                    if (!croppable) {
                        return;
                    }

                    // Crop
                    croppedCanvas = $image.cropper('getCroppedCanvas');

                    // Show
                    $result.html('<img src="' + croppedCanvas.toDataURL() + '">');
                });

            }).on('hidden.bs.modal', function () {
                var $image = $('#cropImage');
                cropBoxData = $image.cropper('getData');
                canvasData = $image.cropper('getCanvasData');
                $image.cropper('destroy');
                $("#cropData").val(JSON.stringify(cropBoxData));
            });
        });

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#cropModal').modal('show');
                    $('#cropImage').attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#picImage").change(function () {
            readURL(this);
        });

        function addEmployee() {
            var url = "<?php echo e(route('admin.employees.store')); ?>";
            $.easyAjax({
                type: 'POST',
                url: url,
                container: '.ajax_form',
                file: true,
            });
        }



	restrictChars('.restrict-numbers-only', '1234567890');
restrictChars('.dattanomors', '1234567890');
restrictChars('.restrict-lowercase', 'abcdefghijklmnopqrstuvwxyz');
restrictChars('.restrict-uppercase', 'ABCDEFGHIJKLMNOPQRSTUVWXYZ');
restrictChars('.restrict-uppercase-and-lowercase', 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz');
restrictChars('.restrict-numbers-uppercase-lowercase-spaces', '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz ');

function restrictChars(selector, allowedChars) {
  $(selector).on('keypress', function (event) {
    const chr = String.fromCharCode(event.which);
    if (allowedChars.indexOf(chr) < 0) {
      return false;
    }
  });

  $(selector).on('keydown keyup change', function (event) {
    let val = $(this).val();
    let pattern = '[^' + allowedChars + ']';
    let regexp = new RegExp(pattern, 'g');
    $(this).val($(this).val().replace(regexp, ''));
  });
}
    </script>
	
		
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.adminlayouts.adminlayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\newabsen\resources\views/admin/pegawaibaru/create.blade.php ENDPATH**/ ?>