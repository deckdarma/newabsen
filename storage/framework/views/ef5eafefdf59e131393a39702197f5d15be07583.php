<?php $__env->startSection('head'); ?>


    <!-- BEGIN PAGE LEVEL STYLES -->

    <?php echo HTML::style("assets/global/plugins/bootstrap-select/css/bootstrap-select.min.css"); ?>

    <?php echo HTML::style("assets/global/plugins/bootstrap-datepickerabsen/css/bootstrap-datepickerabsen.css"); ?>

    <?php echo HTML::style("assets/global/plugins/jquery-multi-select/css/multi-select.css"); ?>

    <?php echo HTML::style("assets/global/plugins/fullcalendar/fullcalendar.min.css"); ?>


    <!-- END PAGE LEVEL STYLES -->

<?php $__env->stopSection(); ?>


<?php $__env->startSection('mainarea'); ?>

    <!-- BEGIN PAGE HEADER-->
    <div class="page-head">
        <div class="page-title"><h1>
                Hari Libur OPD Normal - <?php echo e($current_year); ?>

            </h1></div>
    </div>
    <div class="page-bar">
        <ul class="page-breadcrumb breadcrumb">
            <li>
                <a onclick="loadView('<?php echo e(route('admin.dashboard.index')); ?>')"><?php echo e(trans('core.dashboard')); ?></a>
                <i class="fa fa-circle"></i>
            </li>

            <li>
                <span class="active"> Hari Libur OPD Normal</span>
            </li>
        </ul>

    </div>
    <!-- END PAGE HEADER-->
    <!-- BEGIN PAGE CONTENT-->

    <div id="load">
        

        
    </div>

    <div class="portlet light bordered">
        <div class="portlet-body">
            <div class="row">
                <div class="col-md-3">
                    
                    
                    <div class="margin-bottom-10">
                        <a class="btn green btn-block" data-toggle="modal" href="#static">
                            <?php echo e(trans('core.btnAddHoliday')); ?>

                            <i class="fa fa-plus"></i> </a>
                    </div>
                    <hr>
                    <div class="margin-bottom-10">
                        <div class="input-group  date date-picker-year" data-date-viewmode="years">
							<span class="input-group-btn">
								<button class="btn default" type="button">
									<i class="fa fa-calendar"></i> <?php echo app('translator')->get("core.year"); ?>:
								</button>
							</span>
                            <input type="text" class="form-control" readonly="" id="year" name="year"
                                   value="<?php echo e($current_year); ?>">
                        </div>
                    </div>
                    
                    
                    <ul class="ver-inline-menu tabbable margin-bottom-10">
                        <?php $__currentLoopData = $months; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $month): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li <?php if($month == $currentMonth): ?> class="active" <?php endif; ?> >
                                <a data-toggle="tab" href="#<?php echo e($month); ?>"
                                   onclick="gotoDate('<?php echo e(\Carbon\Carbon::parse("first day of ".$month." ".$year)->format("Y-m-d")); ?>')">
                                    <i class="fa fa-calendar"></i> <?php echo e(trans('core.'.$month.'')); ?> </a>
                                <span class="after">
							</span>
                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    </ul>
                </div>
                <div class="col-md-9">
                    <div id="calendar"></div>
                </div>
            </div>
            <!-- END PAGE CONTENT-->
        </div>
    </div>
    

    <div id="static" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title"><strong><?php echo e(trans('core.addHolidays')); ?></strong></h4>
                </div>
                <?php echo Form::open(array('route'=>"admin.holidays.store",'class'=>'form-horizontal ajax_form','method'=>'POST')); ?>

                <div class="modal-body">
                    <!-- BEGIN FORM-->
                    <ul class="nav nav-tabs">
                        <li class="active">
                            <a href="#tab_1" data-toggle="tab"><?php echo app('translator')->get("core.commonHolidays"); ?></a>
                        </li>
                        <li>
                            <a href="#tab_2" data-toggle="tab"><?php echo app('translator')->get("core.customHoliday"); ?></a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade active in" id="tab_1">
                            <div class="form-body">
                                <div class="form-group last">
                                    <div class="col-md-12">
                                        <select multiple="multiple" class="multi-select" id="holidays_list"
                                                name="holidays_list[]">
                                            <optgroup label="<?php echo app('translator')->get("core.occasionsCaps"); ?>">
                                                <?php $__currentLoopData = $holidays_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $holiday_item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($holiday_item->date); ?>|<?php echo e($holiday_item->name); ?>"
                                                            <?php if($holidays->contains("date", $holiday_item->date)): ?> selected
                                                            rel="previouslySelected" <?php endif; ?>><?php echo e(\Carbon\Carbon::parse($holiday_item->date)->format("M j, Y")); ?>

                                                        - <?php echo e($holiday_item->name); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </optgroup>
                                            
                                            
                                            
                                            
                                            
                                            <optgroup label="<?php echo app('translator')->get("core.sundaysCaps"); ?>">
                                                <?php $__currentLoopData = $all_sundays; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sunday): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php if(!($holidays_list->contains("date", $sunday))): ?>
                                                        <option value="<?php echo e($sunday); ?>|<?php echo app('translator')->get("core.officeOff"); ?>"
                                                                <?php if($holidays->contains("date", $sunday)): ?> selected
                                                                rel="previouslySelected" <?php endif; ?>><?php echo e(\Carbon\Carbon::parse($sunday)->format("M j, Y")); ?></option>
                                                    <?php endif; ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </optgroup>
                                            <optgroup label="<?php echo app('translator')->get("core.saturdaysCaps"); ?>">
                                                <?php $__currentLoopData = $all_saturdays; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $saturday): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php if(!($holidays_list->contains("date", $saturday))): ?>
                                                        <option value="<?php echo e($saturday); ?>|<?php echo app('translator')->get("core.officeOff"); ?>"
                                                                <?php if($holidays->contains("date", $saturday)): ?> selected
                                                                rel="previouslySelected" <?php endif; ?>><?php echo e(\Carbon\Carbon::parse($saturday)->format("M j, Y")); ?></option>
                                                    <?php endif; ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </optgroup>
                                            <optgroup label="<?php echo app('translator')->get("core.fridaysCaps"); ?>">
                                                <?php $__currentLoopData = $all_fridays; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $friday): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php if(!($holidays_list->contains("date", $friday))): ?>
                                                        <option value="<?php echo e($friday); ?>|<?php echo app('translator')->get("core.officeOff"); ?>"
                                                                <?php if($holidays->contains("date", $friday)): ?> selected
                                                                rel="previouslySelected" <?php endif; ?>><?php echo e(\Carbon\Carbon::parse($friday)->format("M j, Y")); ?></option>
                                                    <?php endif; ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </optgroup>
                                        </select>


                                        <input type="hidden" name="removedHolidays" id="removedHolidays">
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="tab-pane fade" id="tab_2">
                            <div class="form-body">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div>
                                            <input class="form-control form-control-inline input-medium date-picker"
                                                   data-date-format="dd-mm-yyyy" name="date[0]" type="text" value=""
                                                   placeholder="<?php echo e(trans('core.date')); ?>"/>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div>
                                            <input class="form-control form-control-inline" type="text" name="occasion[0]"
                                                   placeholder="<?php echo e(trans('core.occasion')); ?>"/>
                                        </div>
                                    </div>

                                </div>
                                <div id="insertBefore"></div>
                                <input type="hidden" name="removedHolidays" id="removedHolidays">
                                <button type="button" id="plusButton" class="btn btn-sm green form-control-inline">
                                    <?php echo e(trans('core.add')); ?> <?php echo e(trans('core.more')); ?> <i class="fa fa-plus"></i>
                                </button>

                            </div>
                        </div>
                    </div>


                    <!-- END FORM-->
                </div>
                <div class="modal-footer">
                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-offset-3 col-md-9">
                                <button type="button" data-loading-text="<?php echo e(trans('core.btnSubmitting')); ?>..."
                                        class="btn green" onclick="ajaxUpdateHolidays()"
                                        id="updateHolidays"><?php echo e(trans('core.btnSubmit')); ?></button>

                            </div>
                        </div>
                    </div>
                </div>
            <?php echo Form::close(); ?>

            <!-- END EXAMPLE TABLE PORTLET-->
            </div>

        </div>
    </div>

    

    
    <?php echo $__env->make('admin.common.delete', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    

<?php $__env->stopSection(); ?>

<?php $__env->startSection('footerjs'); ?>

    
    <?php echo HTML::script("assets/global/plugins/bootstrap-select/js/bootstrap-select.min.js"); ?>

    <?php echo HTML::script("assets/global/plugins/bootstrap-datepickerabsen/js/bootstrap-datepickerabsen.js"); ?>

    <?php echo HTML::script("assets/global/plugins/jquery-multi-select/js/jquery.multi-select.js"); ?>

    <?php echo HTML::script("assets/global/plugins/jquery.quicksearch.js"); ?>

    <?php echo HTML::script('assets/js/ajaxform/jquery.form.min.js'); ?>

    <?php echo HTML::script("assets/global/plugins/moment.min.js"); ?>

    <?php echo HTML::script("assets/global/plugins/fullcalendar/fullcalendar.min.js"); ?>

    <?php echo HTML::script("assets/global/plugins/fullcalendar/lang-all.js"); ?>

    <?php echo HTML::script("assets/admin/pages/scripts/components-pickersabsen.js"); ?>

    
    <script>
        ComponentsPickers.init();

        var Calendar = function () {


            return {
                //main function to initiate the module
                init: function () {
                    Calendar.initCalendar();
                },

                initCalendar: function () {

                    if (!jQuery().fullCalendar) {
                        return;
                    }

                    var date = new Date();
                    var d = date.getDate();
                    var m = date.getMonth();
                    var y = date.getFullYear();

                    var h = {};


                    if ($('#calendar').parents(".portlet").width() <= 720) {

                        $('#calendar').addClass("mobile");
                        h = {
                            left: 'title, prev, next',
                            center: '',
                            right: 'today,month'
                        };
                    } else {
                        $('#calendar').removeClass("mobile");
                        h = {
                            left: 'title',
                            center: '',
                            right: 'prev,next,today'
                        };
                    }

                    $('#calendar').fullCalendar('destroy'); // destroy the calendar
                    $('#calendar').fullCalendar({ //re-initialize the calendar
                        lang: '<?php echo e(Lang::getLocale()); ?>',
                        header: h,
                        defaultView: 'month',
                        eventColor: "#E7505A",
                        <?php if($year != $current_year): ?>
                        defaultDate: moment("<?php echo e(\Carbon\Carbon::parse("first day of january ".$current_year)->format("Y-m-d")); ?>"),
                        <?php endif; ?>
                        eventRender: function (event, element, view) {

                            var i = document.createElement('i');
                            i.className = 'fa';
                            i.classList.add("fa-trash");
                            i.classList.add("btn");
                            i.classList.add("grey-mint");
                            i.classList.add("btn-xs");
                            i.addEventListener("click", function () {
                                del(event.id, event.start);
                            });
                            element.find('div.fc-content').prepend(i);
                        },
                        events: [
                                <?php $__currentLoopData = $holidays; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $holiday): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            {
                                "title": "<?php echo $holiday->occassion; ?>",
                                "start": "<?php echo e($holiday->date); ?>",
                                "id": <?php echo e($holiday->id); ?>},
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        ]

                    });
                }
            };
        }();

        Calendar.init();

        function gotoDate(date) {
            $("#calendar").fullCalendar("gotoDate", date);
        }

        function ajaxUpdateHolidays() {


            // Prepare list of removed holidays
            var list = "";
            $("#holidays_list").find("option[rel='previouslySelected']:not(:selected)").each(function () {
                list += $(this).val() + "~";
            });

            $("#removedHolidays").val(list);

            $.easyAjax({
                url: "<?php echo route('admin.holidays.store'); ?>",
                type: "POST",
                data: $(".ajax_form").serialize(),
                container: ".ajax_form",
            });

        }

        $('#holidays_list').multiSelect({
            selectableOptgroup: true,
            selectableHeader: "<label><strong><?php echo app('translator')->get("core.holidaysList"); ?></strong></label><input type='text' class='form-control' autocomplete='off' placeholder='<?php echo app('translator')->get("core.searchList"); ?>'>",
            selectionHeader: "<label><strong><?php echo app('translator')->get("core.selectedHolidays"); ?></strong></label><input type='text' class='form-control' autocomplete='off' placeholder='<?php echo app('translator')->get("core.searchList"); ?>'>",
            afterInit: function (ms) {
                var that = this,
                    $selectableSearch = that.$selectableUl.prev(),
                    $selectionSearch = that.$selectionUl.prev(),
                    selectableSearchString = '#' + that.$container.attr('id') + ' .ms-elem-selectable:not(.ms-selected)',
                    selectionSearchString = '#' + that.$container.attr('id') + ' .ms-elem-selection.ms-selected';

                that.qs1 = $selectableSearch.quicksearch(selectableSearchString)
                    .on('keydown', function (e) {
                        if (e.which === 40) {
                            that.$selectableUl.focus();
                            return false;
                        }
                    });

                that.qs2 = $selectionSearch.quicksearch(selectionSearchString)
                    .on('keydown', function (e) {
                        if (e.which == 40) {
                            that.$selectionUl.focus();
                            return false;
                        }
                    });
            },
            afterSelect: function () {
                this.qs1.cache();
                this.qs2.cache();
            },
            afterDeselect: function () {
                this.qs1.cache();
                this.qs2.cache();
            }
        });

        var $insertBefore = $('#insertBefore');
        var $i = 0;

        $('#plusButton').click(function () {
            $i = $i + 1;
            $(' <div class="col-md-6"> ' +
                '<div class="form-group"><div><input class="form-control form-control-inline input-medium date-picker' + $i + '" name="date[' + $i + ']" type="text" value="" placeholder="<?php echo e(trans('core.date')); ?>"/></div></div></div>' +
                '<div class="col-md-6"><div class="form-group"><div><input class="form-control form-control-inline" name="occasion[' + $i + ']" type="text" value="" placeholder="<?php echo e(trans('core.occasion')); ?>"/></div></div><div>' +
                '</div>').insertBefore($insertBefore);
            $.fn.datepickerabsen.defaults.format = "dd-mm-yyyy";
            $('.date-picker' + $i).datepickerabsen();
        });

        function del(id, date) {

            $('#deleteModal').modal("show");
            $('#deleteModal').find('#info').html(prepareMessage("<?php echo app('translator')->get("messages.holidayDeleteConfirm"); ?>", ":holiday", date.format("Do MMM, YYYY")));
            $('#deleteModal').find("#delete").off().click(function () {
                var url = "<?php echo e(route('admin.holidays.destroy',':id')); ?>";
                url = url.replace(':id', id);
                var token = "<?php echo e(csrf_token()); ?>";
                $.easyAjax({
                    type: 'DELETE',
                    url: url,
                    data: {'_token': token, "id": id},
                    container: "#deleteModal",
                    success: function (response) {
                        $('#calendar').fullCalendar("removeEvents", id);
                        $("#holidays_list").find("option[value^='" + date.format("YYYY-MM-DD") + "']").prop("selected", false).removeAttr("selected");
                        $('#holidays_list').multiSelect('refresh');
                        $('#deleteModal').modal('hide');

                        $('#row' + id).fadeOut(500);
                    }
                });


            });

        }

        $(".date-picker-year").datepickerabsen({
            format: "yyyy", // Notice the Extra space at the beginning
            viewMode: "years",
            minViewMode: "years"
        }).on('changeDate', function (e) {
            $(this).datepickerabsen('hide');
            var year = $('#year').val();
            loadView('<?php echo e(url('super-admin/holidays/index').'/'); ?>' + year.replace(/\s/g, ''));
        });


    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.adminlayouts.adminlayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\newabsen\resources\views/admin/holidays/index.blade.php ENDPATH**/ ?>