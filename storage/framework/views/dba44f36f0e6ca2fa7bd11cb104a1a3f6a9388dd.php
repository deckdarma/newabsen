<?php $__env->startSection('head'); ?>

    <!-- BEGIN PAGE LEVEL STYLES -->
    <?php echo HTML::style("assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css"); ?>

    <?php echo HTML::style("assets/global/plugins/datatables/plugins/responsive/responsive.bootstrap.css"); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('mainarea'); ?>


    <!-- BEGIN PAGE HEADER-->
    <div class="page-head">
        <div class="page-title"><h1>
   Data Kepemimpinan
            </h1></div>
    </div>
    <div class="page-bar">
        <ul class="page-breadcrumb breadcrumb">
            <li>
                <a onclick="loadView('<?php echo e(route('admin.dashboard.index')); ?>')"><?php echo app('translator')->get('core.dashboard'); ?></a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span class="active">Data Kepemimpinan</span>

            </li>

        </ul>

    </div>
    <!-- END PAGE HEADER-->

    <div id="load">
        

        
    </div>
    <!-- BEGIN PAGE CONTENT-->

    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet light bordered">

                <div class="portlet-body">
       	<?php
	$dataidcom =$loggedAdmin->company->id;
	       $caridatatotal = count(DB::select(DB::raw("SELECT * FROM datapemimpins WHERE company_id='".$dataidcom."' ")));
    
	?>
	<?php if($caridatatotal !=4): ?>
        <div class="table-toolbar">
		 <div class="row">
       
							
												<?php $Kepala = count(DB::select(DB::raw("SELECT * FROM datapemimpins WHERE company_id='".$dataidcom."' AND namajabatan='Kepala OPD' ")));?>
				<?php $Sekretaris = count(DB::select(DB::raw("SELECT * FROM datapemimpins WHERE company_id='".$dataidcom."' AND namajabatan='Sekretaris' ")));?>
				<?php $Kepegawaian = count(DB::select(DB::raw("SELECT * FROM datapemimpins WHERE company_id='".$dataidcom."' AND namajabatan='Kepegawaian' ")));?>
				<?php $Bendahara = count(DB::select(DB::raw("SELECT * FROM datapemimpins WHERE company_id='".$dataidcom."' AND namajabatan='Bendahara' ")));?>

				<?php if($Kepala == 0): ?>
	<div style="font-size: 18px;text-align: center;">
Anda harus menambahkan Nama Kepala OPD<BR>
                     <a class="btn green" onclick="showAdd()">
                           Tambahkan Kepala OPD
                   <i class="fa fa-plus"></i> </a>
					   
		</div>
	<?php else: ?>

<?php if($Sekretaris == 0): ?>
		<div style="font-size: 18px;text-align: center;">
Anda harus menambahkan Nama Sekretaris OPD<BR>
                     <a class="btn green" onclick="showAdd()">
                           Tambahkan Sekretaris OPD
                   <i class="fa fa-plus"></i> </a>
					   
		</div>
	

					
<?php else: ?>
	
<?php if($Kepegawaian == 0): ?>
	
		<div style="font-size: 18px;text-align: center;">
Anda harus menambahkan Nama Kepegawaian<BR>
                     <a class="btn green" onclick="showAdd()">
                           Tambahkan Kepegawaian
                   <i class="fa fa-plus"></i> </a>
					   
		</div>
	

<?php else: ?>
	
		<div style="font-size: 18px;text-align: center;">
Anda harus menambahkan Nama Bendahara<BR>
                     <a class="btn green" onclick="showAdd()">
                           Tambahkan Bendahara
                   <i class="fa fa-plus"></i> </a>
					   
		</div>

<?php endif; ?>




<?php endif; ?>	
<?php endif; ?>				
		
                        
                        </div>
                    </div>
		<?php endif; ?>			
						<?php if($caridatatotal ==0): ?>
							<div class="note note-warning margin-top-15" style="font-size: 15px; ">
						Anda  Belum Menambahkan Data Kepemimpinan, silahkan klik menu di atas untuk menambahkan. 
                          </div>
							<?php else: ?>
                    <table class="table table-striped table-bordered custom-table datatable dataTable no-footerr">

					  <thead>
                        <tr>
                            <th> Nama Pegawai </th>
              
                            <th> Jabatan Dari Data Kepemimpinan</th>
                            <th> Jabatan Asli</th>
                      
                  
                            <th> <?php echo app('translator')->get('core.action'); ?>  </th>
                        </tr>
                        </thead>
                        <tbody>
<?php $__currentLoopData = $pegawai; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<?php $carinojab = count(DB::select(DB::raw("SELECT * FROM datapemimpins WHERE id='".$row->idpem."' AND idpemimpin='0' "))); ?>

<tr role="row" class="odd" id="rowundefined">
<?php if($carinojab ==1): ?>
	<td colspan="3"><span class="label label-success"><?php echo e($row->namajabatan); ?></span> Tidak ada Pegawai yang di pilih</td>	
<td><a class="btn purple btn-sm margin-bottom-10" onclick="showEdit(<?php echo e($row->idpem); ?>)"><i class="fa fa-edit"></i> <span class="hidden-sm hidden-xs">View/Edit</span></a>
<a href="javascript:;" onclick="del(<?php echo e($row->idpem); ?>)" class="btn red btn-sm margin-bottom-10">
<i class="fa fa-trash"></i> <span class="hidden-sm hidden-xs">Hapus</span></a> </td>
<?php else: ?>
<td><?php echo e($row->full_name); ?></td>
<td> <span class="label label-success"><?php echo e($row->namajabatan); ?></span></td>
<td class="sorting_1"><?php echo e($row->jabatan); ?></td>
<td><a class="btn purple btn-sm margin-bottom-10" onclick="showEdit(<?php echo e($row->idpem); ?>)"><i class="fa fa-edit"></i> <span class="hidden-sm hidden-xs">View/Edit</span></a>
<a href="javascript:;" onclick="del(<?php echo e($row->idpem); ?>)" class="btn red btn-sm margin-bottom-10">
<i class="fa fa-trash"></i> <span class="hidden-sm hidden-xs">Hapus</span></a> </td>


<?php endif; ?>

</tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
                        </tbody>
                    </table>
						<?php endif; ?>
                </div>
            </div>
            <!-- END EXAMPLE TABLE PORTLET-->

        </div>
    </div>
    <!-- END PAGE CONTENT-->

    
    <?php echo $__env->make('admin.common.delete', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('admin.common.show-modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    

<?php $__env->stopSection(); ?>


<?php $__env->startSection('footerjs'); ?>

    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <?php echo HTML::script("assets/global/plugins/datatables/datatables.min.js"); ?>

    <?php echo HTML::script("assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js"); ?>

    <?php echo HTML::script("assets/global/plugins/datatables/plugins/responsive/dataTables.responsive.js"); ?>

    <?php echo HTML::script("assets/global/plugins/datatables/plugins/responsive/responsive.bootstrap.js"); ?>


    <!-- END PAGE LEVEL PLUGINS -->

    <script>

        var table = $('#dataPemimpin').dataTable({
            "cache": true,
            "bProcessing": true,
            "bServerSide": true,
            "bDestroy": true,
            "order": [[1, "asc"]],
            "ajax": "<?php echo e(URL::route("admin.datapemimpins.ajax_list")); ?>",
            "aoColumns": [
             
          {data: 'idpemimpin', name: 'idpemimpin'},
                {data: 'namajabatan', name: 'namajabatan'},
        

                {data: 'edit', name: 'edit'},
            ],
            "lengthMenu": [
                [15, 30, 50, -1],
                [15, 30, 50, "All"] // change per page values here
            ],
            "language": {
                "emptyTable": "No data available",
                "search": '',
                "searchPlaceholder": "Search..."
            },
            "sPaginationType": "full_numbers",
            "fnRowCallback": function (nRow, aData, iDisplayIndex) {
                var row = $(nRow);
                row.attr("id", 'row' + aData['0']);
            }

        });

        // Show Delete Modal
        function del(id) {

            $('#deleteModal').modal('show');

            $("#deleteModal").find('#info').html('Apakah yakin ingin di hapus <strong>' + name + '</strong> ?');

            $('#deleteModal').find("#delete").off().click(function () {

                var url = "<?php echo e(route('admin.datapemimpins.destroy',':id')); ?>";
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
                            table.fnDraw();
                        }
							location.reload(true);
                    }
                });

            });
        }

        function showEdit(id, dataPemimpin, num, pot) {
            var url = "<?php echo e(route('admin.datapemimpins.edit',':id')); ?>";
            url = url.replace(':id', id);
            $.ajaxModal('#showModal', url);

            $("#edit_dataPemimpin").val(dataPemimpin);
            $("#edit_num_of_leave").val(num);
            $("#edit_potongan").val(pot);
        }

        function showAdd() {
            var url = "<?php echo e(route('admin.datapemimpins.create')); ?>";
            $.ajaxModal('#showModal', url);

        }

        function addUpdateDataPemimpin(id) {

            if (typeof id != 'undefined') {
                var url = "<?php echo e(route('admin.datapemimpins.update',':id')); ?>";
                url = url.replace(':id', id);
            } else {
                url = "<?php echo e(route('admin.datapemimpins.store')); ?>";
            }
            $.easyAjax({
                type: 'POST',
                url: url,
                container: '#leave_type_update_form',
                data: $('#leave_type_update_form').serialize(),
                success: function (response) {
                    if (response.status == "success") {
                        $('#showModal').modal('hide');
						location.reload(true);
                        table.fnDraw();
				
                    }

                }
            });
        }
    </script>
	
	


<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.adminlayouts.adminlayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\newabsen\resources\views/admin/datapemimpins/index.blade.php ENDPATH**/ ?>