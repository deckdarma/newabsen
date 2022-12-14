<?php $__env->startSection('head'); ?>
    <!-- BEGIN PAGE LEVEL STYLES -->
    <?php echo HTML::style("assets/global/plugins/select2/css/select2.css"); ?>

    <?php echo HTML::style("assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css"); ?>

    <?php echo HTML::style("assets/global/plugins/datatables/plugins/responsive/responsive.bootstrap.css"); ?>

    <!-- END PAGE LEVEL STYLES -->

<?php $__env->stopSection(); ?>


<?php $__env->startSection('mainarea'); ?>


    <!-- BEGIN PAGE HEADER-->
    <div class="page-head">
        <div class="page-title"><h1>
       Data Mutasi Masuk
            </h1></div>
    </div>
    <div class="page-bar">
        <ul class="page-breadcrumb breadcrumb">
            <li>
                <a onclick="loadView('<?php echo e(route('admin.dashboard.index')); ?>')"><?php echo e(trans('core.dashboard')); ?></a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span class="active">Data Mutasi Masuk</span>
            </li>

        </ul>

    </div>   
<div class="row">
        <div class="col-md-12">

            <!-- BEGIN EXAMPLE TABLE PORTLET-->

            <div class="portlet light bordered">

                <div class="portlet-body">
                  <div class="table-toolbar">
                        <div class="row">
           
          
                        </div>
                    </div>
<div class="note note-warning margin-top-15" style="font-size: 15px; ">
					Anda Dapat Menerima Mutasi Masuk dari OPD Yang bersangkutan
                          </div>
                         <table  class="table table-bordered">
                  <thead>
                    <tr>
              
                      <th>Nama</th>
                      <th>ASN/PHL</th>
                      <th>Mutasi Dari</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
				  			<?php $countdatapeg=0; ?>
                    <?php $__currentLoopData = $tasks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<?php $countdatapeg++; ?>
                    <tr>
			
					 <?php if($task->designation == NULL): ?>
                      <td ><?php echo e($task->full_name); ?></td>
				   	<?php else: ?>
						 <td style="background: #ecffed;"><?php echo e($task->full_name); ?></td>
						<?php endif; ?>
					
                      <td>
					  <?php if($task->statusmupeg == "ASN"): ?>
						<span id="status2" class="label label-success" style="background-color: #e38213;">ASN</span>
						<?php else: ?> 
						<span id="status2" class="label label-success" style="background-color: #5a5a5a;">PHL</span>
							
						<?php endif; ?>
						  
					  </td>
					  <td>
					  	   <?php echo e($task->company_name); ?>

					  </td>
                      <td>
					
						<a class="btn blue btn-sm margin-bottom-5" href="../mutasimasuk/<?php echo e($task->id); ?>/edit" ><i class="fa fa-exchange"></i><span class="hidden-sm hidden-xs"> Terima Mutasi </span></a>
				
					  </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

					<?php if($countdatapeg == 0): ?>
					 <tr>
					    <td colspan="4" style="    text-align: center;
    font-size: 16px;
    background: #f8f9e6;">Maaf Anda Tidak Memiliki Mutasi Masuk   </td>
		<?php endif; ?>
					</tr>
                  </tbody>                  
                </table>
                </div>
            </div>
            <!-- END EXAMPLE TABLE PORTLET-->

        </div>
    </div>

	<!-- END PAGE CONTENT-->

    
    <?php echo $__env->make('admin.common.delete', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    
<?php $__env->stopSection(); ?>



<?php $__env->startSection('footerjs'); ?>


    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <?php echo HTML::script("assets/global/plugins/select2/js/select2.min.js"); ?>

    <?php echo HTML::script("assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js"); ?>

    <?php echo HTML::script("assets/global/plugins/datatables/datatables.min.js"); ?>

    <?php echo HTML::script("assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js"); ?>

    <?php echo HTML::script("assets/global/plugins/datatables/plugins/responsive/dataTables.responsive.js"); ?>

    <?php echo HTML::script("assets/global/plugins/datatables/plugins/responsive/responsive.bootstrap.js"); ?>


 


    <!-- END PAGE LEVEL PLUGINS -->

  <script type="text/javascript">
  
       
  
  $(function () {
    $("#tableasds").DataTable();

    $( "#tablecontents" ).sortable({
      items: "tr",
      cursor: 'move',
      opacity: 0.6,
      update: function() {
          sendOrderToServer();
      }

    });

    function sendOrderToServer() {

      var order = [];
      $('tr.row1').each(function(index,element) {
        order.push({
          id: $(this).attr('data-id'),
          position: index+1
        });
      });

      $.ajax({
        type: "POST", 
        dataType: "json", 
   url: "<?php echo e(route('admin.datamutasi.index')); ?>",
 data: {
          order:order,
          _token: '<?php echo e(csrf_token()); ?>'
        },
        success: function(response) {
            if (response.status == "success") {
              console.log(response);
            } else {
              console.log(response);
            }
        }
      });

    }
  });

</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.adminlayouts.adminlayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\newabsen\resources\views/admin/datamutasi/terima.blade.php ENDPATH**/ ?>