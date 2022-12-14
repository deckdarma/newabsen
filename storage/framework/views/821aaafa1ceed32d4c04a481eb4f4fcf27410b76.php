<?php $__env->startSection('head'); ?>

    <!-- BEGIN PAGE LEVEL STYLES -->
    <?php echo HTML::style('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css'); ?>

    <?php echo HTML::style('assets/global/plugins/bootstrap-datepickerabsen/css/bootstrap-datepickerabsen3.css'); ?>

    <?php echo HTML::style("assets/global/plugins/cropper/cropper.min.css"); ?>

    <!-- END PAGE LEVEL STYLES -->
<?php $__env->stopSection(); ?>


<?php $__env->startSection('mainarea'); ?>

    <!-- BEGIN PAGE HEADER-->
    <div class="page-head">
        <div class="page-title"><h1>
		<?php if($employee->statusmupeg == "ASN"): ?>
              Edit Data Pegawai
		  <?php else: ?>
			     Edit Data PHL
			  <?php endif; ?>
            </h1></div>
    </div>
    <div class="page-bar">
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
                <span class="active">		<?php if($employee->statusmupeg == "ASN"): ?>
              Edit Data Pegawai
		  <?php else: ?>
			     Edit Data PHL
			  <?php endif; ?></span>
            </li>
        </ul>
    </div>            <!-- END PAGE HEADER-->
    <div class="row ">
        <div class="col-md-6 col-sm-6">
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-purple-wisteria">
                        <i class="fa fa-user font-purple-wisteria"></i><?php echo e(trans('core.personalDetails')); ?>

                    </div>
                    <div class="actions">

                        <a href="javascript:;" onclick="UpdateDetails('<?php echo $employee->id; ?>','personal')"

                           class="btn btn-sm btn-success ">
                            <i class="fa fa-save"></i> Simpan Informasi Pegawai </a>
                    </div>
                </div>


                <div class="portlet-body">


                    

                    <?php echo Form::open(['method' => 'PUT','class'   =>  'form-horizontal','id'  =>  'personal_details_form','files'=>true]); ?>


                    <input type="hidden" name="updateType" class="form-control" value="personalInfo">


                    <?php if(Session::get('errorPersonal')): ?>

                        <div class="alert alert-danger alert-dismissable ">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                            <?php $__currentLoopData = Session::get('errorPersonal'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <p><strong><i class="fa fa-warning"></i></strong> <?php echo $error; ?></p>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    <?php endif; ?>


                    <div class="form-body">
                        <div class="form-group ">
                            <label class="control-label col-md-3"><?php echo e(trans('core.image')); ?>

                                <?php echo help_text("employeeImageSize"); ?>

                            </label>

                            <div class="col-md-9">

                                <!-- Modal -->
                                <div class="modal fade" id="cropModal" aria-labelledby="modalLabel" role="dialog"
                                     tabindex="-1" data-backdrop="static">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="modalLabel">Crop Image</h4>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div>
                                                            <img id="cropImage" src="" alt="" style="max-height: 500px">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" id="cropButton" class="btn btn-primary"
                                                        data-dismiss="modal">Crop Selected
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-new thumbnail" style="width: 200px; height: 200px;">
                                        <?php echo HTML::image($employee->profile_image_url,'ProfileImage',['height'=>'80px', "id" => "imagePath"]); ?>

                                        <input type="hidden" name="hiddenImage" value="<?php echo e($employee->profile_image); ?>">
                                    </div>

                                    <input type="hidden" value="" name="cropData" id="cropData"/>

                                    <div class="fileinput-preview fileinput-exists thumbnail" id="result"
                                         style="max-width: 200px; max-height: 200px;"></div>
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
                            <label class="col-md-3 control-label">Nama Lengkap<span
                                        class="required">* </span></label>

                            <div class="col-md-9">
                                <input type="text" name="full_name" placeholder="Ketik Nama Lengkap" class="form-control" value="<?php echo e($employee->full_name); ?>">
                            </div>
                        </div>
                              <input type="hidden" name="father_name" class="form-control" value="kabbangai">

                        <div class="form-group">
                            <label class="control-label col-md-3">Tanggal Lahir</label>

                            <div class="col-md-3">
                                <div class="input-group input-medium date date-picker" data-date-format="dd-mm-yyyy"
                                     data-date-viewmode="years">
                                    <input type="text" class="form-control" name="date_of_birth" readonly
                                           value="<?php if(empty($employee->date_of_birth)): ?><?php else: ?><?php echo e(date('d-m-Y',strtotime($employee->date_of_birth))); ?><?php endif; ?>">
                                    <span class="input-group-btn">
									<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
								</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Kelamin</label>

                            <div class="col-md-9">
                                <select class="form-control" name="gender">

                                    <option value="male" <?php if($employee->gender=='male'): ?> selected <?php endif; ?>>Laki-Laki</option>
                                    <option value="female" <?php if($employee->gender=='female'): ?> selected <?php endif; ?>>Wanita
                                    </option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label">No. Hanphone</label>

                            <div class="col-md-9">
                                <input type="text" name="mobile_number"    placeholder="Ketik No HP"  class="form-control"
                                       value="<?php echo e($employee->mobile_number); ?>">
									     <span class="help-block">Kosongkan Jika tidak diperlukan</span>
                            </div>
                        </div>
              
                        <div class="form-group">
                            <label class="col-md-3 control-label">Alamat </label>

                            <div class="col-md-9">
							<textarea name="permanent_address" class="form-control"
                                      rows="3"><?php echo e($employee->permanent_address); ?></textarea>
									   <span class="help-block">Kosongkan Jika tidak diperlukan</span>
                            </div>
                        </div>

     <div class="form-group">
                            <label class="col-md-3 control-label">No. Urut Pegawai
							<span
                                        class="required">* </span></label>
							</label>

                            <div class="col-md-9">
                                <input type="text" name="order"    placeholder="Ketik Angka Nomor Urut"  class="form-control dattanomors"
                                       value="<?php echo e($employee->order); ?>">
									     <span class="help-block">Urutan Pegawai</span>
                            </div>
                        </div>
                     <input type="hidden" name="email" class="form-control" value="pegawai<?php echo e($employee->id); ?>@banggaikab.go.id">
                                                      <input type="hidden" name="password" value="123456" class="form-control"> 
		
                    </div>
                    <?php echo Form::close(); ?>

                </div>
            </div>
        </div>
        <div class="col-md-6 col-sm-6">
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-red-sunglo">
                        <i class="fa fa-industry font-red-sunglo"></i><?php echo e(trans('core.companyDetails')); ?>

                    </div>
                    <div class="actions">
                        <a href="javascript:;"
                           onclick="UpdateDetails('<?php echo e($employee->id); ?>','company');return false"
                           class="btn btn-sm btn-success ">
                            <i class="fa fa-save"></i> Simpan Data Dinas/Badan </a>
                    </div>
                </div>
                <div class="portlet-body">

                    
                    <?php echo Form::open(['method' => 'PUT','class'   =>  'form-horizontal','id'  =>  'company_details_form']); ?>


                    <input type="hidden" name="updateType" class="form-control" value="company">

                    <div id="alert_company">
                        

                        
                    </div>

                    <div class="form-body">
         <?php if($employee->statusmupeg == "ASN"): ?>
						<div class="form-group">
                            <label class="col-md-3 control-label"><?php echo e(trans('core.employeeID')); ?><span
                                        class="required">* </span></label>

                            <div class="col-md-9">
							
                                        <?php if($employee->firstphl == 1 ): ?>
											<input type="text" name="employeeID" class="form-control dattanomors"
                                       placeholder="Ketik NIP Baru">
									   	      <input type="hidden" class="form-control" name="firstphl"
                                               value="0">

										 <?php else: ?>
                                <input type="text" name="employeeID" class="form-control dattanomors"
                                       value="<?php echo e($employee->employeeID); ?>">
									 
									   <?php endif; ?>
                            </div>
                        </div>
		 <?php else: ?>
		 <input type="hidden" name="employeeID" class="form-control"
                                       value="<?php echo e($employee->employeeID); ?>">
		<input type="hidden" class="form-control" name="firstphl" value="1">
		<?php endif; ?>
                        <div class="form-group">
                            <label class="col-md-3 control-label"><?php echo e(trans('core.department')); ?><span
                                        class="required">* </span></label>

                            <div class="col-md-9">
                                <?php echo Form::select('department', $department,$designation->department_id,['class' => 'form-control select2me','id'=>'department','onchange'=>'dept();return false;']); ?>

                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label"><?php echo e(trans('core.designation')); ?><span
                                        class="required">* </span></label>

                            <div class="col-md-9">

                                <select class="select2me form-control" name="designation" id="designation">

                                </select>
                            </div>
                        </div>
			
	
			   			  <div class="form-group">
                            <label class="col-md-3 control-label">Status</label>

                            <div class="col-md-9">
                                <select class="form-control" name="statusmupeg">

                                    <option value="ASN" <?php if($employee->statusmupeg=='ASN'): ?> selected <?php endif; ?>>ASN</option>
                                    <option value="PHL" <?php if($employee->statusmupeg=='PHL'): ?> selected <?php endif; ?>>PHL
                                    </option>
                                </select>
                            </div>
                        </div>
	
						
						     		<?php if($employee->statusmupeg == "ASN"): ?>
            	 <div class="form-group">
                            <label class="col-md-3 control-label">Golongan<span
                                        class="required">* </span></label>

                            <div class="col-md-9">

                                   <select class="form-control" name="golongan">
<?php $__currentLoopData = $golonganpeg; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($data->id); ?>" <?php if($employee->golongan==$data->id): ?> selected <?php endif; ?>><?php echo e($data->golonganPeg); ?></option>
                    	 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>           
                                </select>
                            </div>
                        </div>
		 <?php else: ?>
		 <input type="hidden" name="golongan" class="form-control" value="<?php echo e($employee->golongan); ?>">
		<?php endif; ?> 


		<?php if($loggedAdmin->company->datashift==1): ?>
		<?php if($employee->statusmupeg == "ASN"): ?>
<?php $datashift = "Pegawai"; ?>	
 <?php else: ?>	
	 <?php $datashift = "PHL"; ?>
<?php endif; ?> 
						<div class="form-group">
                            <label class="col-md-3 control-label"><?php echo e($datashift); ?> Shift<span
                                        class="required">* </span></label>

                            <div class="col-md-9">

                                   <select class="form-control" name="shift">

                                 <option value="1" <?php if($employee->shift=='1'): ?> selected <?php endif; ?>>YA</option>
                                    <option value="0" <?php if($employee->shift=='0'): ?> selected <?php endif; ?>>TIDAK
                                    </option>
                            
                                </select>
								<small>Jika Anda Memilih YA berarti <?php echo e($datashift); ?> masuk dalam kategori shift</small>
                            </div>
                        </div>	
						<?php else: ?>
						<input type="hidden" name="shift" class="form-control" value="0">
						<?php endif; ?>		
						
					
		<input type="hidden" name="annual_leave" class="form-control"  value="<?php echo e($employee->annual_leave); ?>">
		<input type="hidden" class="form-control" name="joining_date" readonly
                                           value="<?php if(empty($employee->joining_date)): ?>00-00-0000 <?php else: ?> <?php echo e(date('d-m-Y',strtotime($employee->joining_date))); ?> <?php endif; ?>">		
               <input type="hidden" class="form-control" name="exit_date" readonly
                                           value="<?php if(empty($employee->exit_date)): ?> <?php else: ?> <?php echo e(date('d-m-Y',strtotime($employee->exit_date))); ?> <?php endif; ?>">
                                        

   
        
                        <div class="form-group">
                            <label class="control-label col-md-3">Keaktifkan</label>

                            <div class="col-md-9">
                                <input type="checkbox" value="active" onchange="remove_exit();" class="make-switch"
                                       name="status" <?php if($employee->status=='active'): ?>checked
                                       <?php endif; ?> data-on-color="success"
                                       data-on-text="Aktif" data-off-text="NonAktif" data-off-color="danger">
                                <span class="help-block">
							Jika di Nonaktifkan Pegawai tidak akan tampil
							</span>
                            </div>
                        </div>
	<?php
	if($employee->statusmupeg =="ASN") {

	$namdataed = "TPP";	
	} else {
		$namdataed = "Honorium";

	}
	?>
                     
        		
                      <hr>
                        <h4><strong>Jumlah <?php echo e($namdataed); ?></strong></h4>
                        <div id="salaryData">
						
						
						
                            <?php $__currentLoopData = $employee->salaries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $salary): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

							   <?php if(($salary->type=='basic')): ?>

							   
                                <div id="salary<?php echo e($salary->id); ?>">
                                    <div class="form-group">
                                        <div class="col-md-5">
                                            <?php if(($salary->type=='basic' || $salary->type=='hourly_rate')): ?>
                                                <input type="hidden" class="form-control" name="type[<?php echo e($salary->id); ?>]"
                                                       value="<?php echo e($salary->type); ?>">
                                                <label class="control-label">Jumlah <?php echo e($namdataed); ?></label>
                                            <?php else: ?>
                                                <input type="text" class="form-control" name="type[<?php echo e($salary->id); ?>]"
                                                       value="<?php echo e($salary->type); ?>">
                                            <?php endif; ?>
                                        </div>

                                        <div class="col-md-5">
                                            <input type="text" class="form-control" name="salary[<?php echo e($salary->id); ?>]"
                                                   value="<?php echo e($salary->salary); ?>">
                                        </div>

                              
                                    </div>
                                </div>
								      <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						<?php $caritpp = count(DB::select(DB::raw("SELECT * FROM salary WHERE employee_id='".$employee->id."' ")));?>

						<?php if($caritpp == 0): ?>
						
              <div style="padding:10px; margin-bottom:10px;   background-color: #f5f3d0;">Maaf tidak di temukan Nilai <?php echo e($namdataed); ?> Silahkan klik tombol di bawah</div>
						<a href="javascript: ;" onclick="showSalary(<?php echo e($employee->id); ?>)" class="btn green">
                                            <span class="hidden-xs">Tambahkan <?php echo e($namdataed); ?> </span><i class="fa fa-plus"></i>
                                        </a>
						<?php endif; ?>
                        </div>
					
			
						
                    </div>
                    <?php echo Form::close(); ?>



                    

                </div>
            </div>

      
        </div>
    </div>


    <?php echo $__env->make('admin.common.show-modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->stopSection(); ?>



<?php $__env->startSection('footerjs'); ?>


    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <?php echo HTML::script('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js'); ?>

    <?php echo HTML::script("assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js"); ?>

    <?php echo HTML::script('assets/global/plugins/bootstrap-datepickerabsen/js/bootstrap-datepickerabsen.js'); ?>

    <?php echo HTML::script('assets/admin/pages/scripts/components-pickersabsen.js'); ?>

    <?php echo HTML::script("assets/global/plugins/cropper/cropper.min.js"); ?>


    <!-- END PAGE LEVEL PLUGINS -->




    <script>
        jQuery(document).ready(function () {
            ComponentsPickers.init();
            dept();
        });


        function dept() {

            $.getJSON("<?php echo e(route('admin.departments.ajax_designation')); ?>",
                {department_id: $('#department').val()},
                function (data) {
                    var model = $('#designation');
                    model.empty();
                    var selected = '';
                    var match = '<?php echo e($employee->designation); ?>';
                    $.each(data, function (index, element) {
                        if (element.id == match) selected = 'selected';
                        else selected = '';
                        model.append("<option value='" + element.id + "' " + selected + ">" + element.designation + "</option>");
                    });

                });


        }


        // Add New Salary
        function saveSalary(id) {
            var url = "<?php echo e(route('admin.salary.store')); ?>";
            url = url.replace(':id', id);
            $.easyAjax({
                type: 'POST',
                url: url,
                container: '#save_salary',
                data: $('#save_salary').serialize(),
                success: function (response) {
                    if (response.status == "success") {
                        $('#showModal').modal('hide');
                        $('#salaryData').append(response.viewData);
							    window.location.reload();
                    }
                }
            });
        }

        // Show Salary Modal
        function showSalary(id) {
            $('#showModal .modal-dialog').removeClass("modal-md").addClass("modal-xm");
            var url = "<?php echo e(route('admin.add-salary-modal',[':id'])); ?>";
            url = url.replace(':id', id);
            $.ajaxModal('#showModal', url);
            $('#showModal_div').removeClass("modal-dialog modal-lg").addClass("modal-dialog modal-md");
     

	   }

        // Show Delete Modal and delete salary
        function del(id, type) {

            $('#deleteModal').modal('show');

            $("#deleteModal").find('#info').html('Apakah anda yakin ingin menghapus <strong>' + type + '</strong> Salary?.');

            $('#deleteModal').find("#delete").off().click(function () {

                var url = "<?php echo e(route('admin.salary.destroy',':id')); ?>";
                url = url.replace(':id', id);

                var token = "<?php echo e(csrf_token()); ?>";

                $.easyAjax({
                    type: 'DELETE',
                    url: url,
                    data: {'_token': token},
                    container: "#deleteModal",
                    success: function (response) {
                        if (response.status == "success") {
                            $('#deleteModal').modal('hide');
                            $('#salary' + id).remove();
                        }
                    }
                });

            });
        }


        function remove_exit() {
            if ($("input[name=status]:checked").val() == "active") {
                $("input[name=exit_date]").val("");
            }
        }


        $("input[name=exit_date]").change(function () {
            $("input[name=status]").bootstrapSwitch('state', false);

        });
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

        // Javascript function to update the company info and Bank Info
        function UpdateDetails(id, type) {

            var form_id = '#' + type + '_details_form';
            var alert_div = '#' + type + '_alert';

            var url = "<?php echo e(route('admin.employees.update',':id')); ?>";
            url = url.replace(':id', id);
            $.easyAjax({
                type: 'POST',
                url: url,
                container: form_id,
                file: true,
                alertDiv: alert_div,
				        success: function (response) {
                    if (response.status == "success") {
              	location.reload(true);
				
                    }

                }
            });
        }

    </script>

		<script>
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
		
		
	document.oncontextmenu = function(e) {
  var el = window.event.srcElement || e.target;
  var tp = el.tagName || '';
  if ( tp.toLowerCase() == 'input' || tp.toLowerCase() == 'select' || tp.toLowerCase() == 'textarea' ){
    return false;
  }
};


 </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.adminlayouts.adminlayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\newabsen\resources\views/admin/employees/edit.blade.php ENDPATH**/ ?>