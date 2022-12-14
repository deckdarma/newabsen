<?php  $settingp = \App\Models\Setting::query() ->first(); ?>                                 

  <div  style="  
    padding: 15px;
    font-size: 13px;
    background: #062b58;
    color: #fff;"> <?php echo e($settingp->pengelola); ?> <div style="float: right;margin-right:35px;">Programmer Oleh : Fadli Dg Malewa</div>
	</div>



<?php echo Form::open(['url'=>'','id'=>'show_approve','method'=>'PATCH']); ?>

<div id="static_approve" class="modal fade" tabindex="-1" data-backdrop="static_approve" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Penyetujuan</h4>
            </div>
            <div class="modal-body">
                <input type="hidden" name="application_status" value="<?php echo app('translator')->get('core.btnApprove'); ?>">
                <p>
                    <?php echo app('translator')->get('messages.approveLeave'); ?>
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal"
                        class="btn dark btn-outline">Tutup</button>
                <button type="submit" data-loading-text="<?php echo app('translator')->get("core.updating"); ?>..."
                        class="btn green">Lanjutkan Setujui</button>
            </div>
        </div>
    </div>
</div>
<?php echo Form::close(); ?>





<?php echo Form::open(['url'=>'','id'=>'show_approve_tampilan','method'=>'PATCH']); ?>

<div id="static_approve_tampilan" class="modal fade" tabindex="-1" data-backdrop="static_approve_tampilan" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Penyetujuan</h4>
            </div>
            <div class="modal-body">
                <input type="hidden" name="application_status" value="<?php echo app('translator')->get('core.btnApprove'); ?>">
                <p>
Apakah anda yakin ingin menambahkan Periode Absen ini? Klik di bawah untuk melanjutkan, jika anda melanjutkan maka data yang sudah di setujui tidak dapat lagi di edit..!
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal"
                        class="btn dark btn-outline">Tutup</button>
                <button type="submit" data-loading-text="<?php echo app('translator')->get("core.updating"); ?>..."
                        class="btn green">Lanjutkan Setujui</button>
						
						
            </div>
        </div>
    </div>
</div>
<?php echo Form::close(); ?>










<?php echo Form::open(['url'=>'','id'=>'show_approve_tampilan_shift','method'=>'PATCH']); ?>

<div id="static_approve_tampilan_shift" class="modal fade" tabindex="-1" data-backdrop="static_approve_tampilan_shift" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Penyetujuan</h4>
            </div>
            <div class="modal-body">
                <input type="hidden" name="application_status" value="<?php echo app('translator')->get('core.btnApprove'); ?>">
                <p>
Apakah anda yakin ingin menambahkan Periode Absen ini? Klik di bawah untuk melanjutkan, jika anda melanjutkan maka data yang sudah di setujui tidak dapat lagi di edit..!
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal"
                        class="btn dark btn-outline">Tutup</button>
                <button type="submit" data-loading-text="<?php echo app('translator')->get("core.updating"); ?>..."
                        class="btn green">Lanjutkan Setujui</button>
						
						
            </div>
        </div>
    </div>
</div>
<?php echo Form::close(); ?>












<?php echo Form::open(['url'=>'','id'=>'show_reject_tampilan_shift','method'=>'PATCH']); ?>

<div id="static_reject_tampilan_shift" class="modal fade" tabindex="-1" data-backdrop="static_reject_tampilan_shift" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Penolakan</h4>
            </div>
            <div class="modal-body">
                <input type="hidden" name="application_status" value="<?php echo app('translator')->get('core.btnReject'); ?>">
                <p>
                    <?php echo app('translator')->get('messages.rejectLeave'); ?>
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal"
                        class="btn dark btn-outline">Tutup</button>
                <button type="submit" data-loading-text="<?php echo app('translator')->get("core.updating"); ?>..."
                        class="btn red">Lanjutkan Penolakan</button>
            </div>
        </div>
    </div>
</div>
<?php echo Form::close(); ?>








<?php echo Form::open(['url'=>'','id'=>'show_reject','method'=>'PATCH']); ?>

<div id="static_reject" class="modal fade" tabindex="-1" data-backdrop="static_reject" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Penolakan</h4>
            </div>
            <div class="modal-body">
                <input type="hidden" name="application_status" value="<?php echo app('translator')->get('core.btnReject'); ?>">
                <p>
                    <?php echo app('translator')->get('messages.rejectLeave'); ?>
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal"
                        class="btn dark btn-outline">Tutup</button>
                <button type="submit" data-loading-text="<?php echo app('translator')->get("core.updating"); ?>..."
                        class="btn red">Lanjutkan Penolakan</button>
            </div>
        </div>
    </div>
</div>
<?php echo Form::close(); ?>



    

    <div class="modal fade apply_modal in" id="Kunjungimesin" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-xm">
            <div class="modal-content">


            </div>
        </div>
    </div>
    
	
	



<?php echo Form::open(['url'=>'','id'=>'show_reject_tampilan','method'=>'PATCH']); ?>

<div id="static_reject_tampilan" class="modal fade" tabindex="-1" data-backdrop="static_reject_tampilan" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Penolakan</h4>
            </div>
            <div class="modal-body">
                <input type="hidden" name="application_status" value="<?php echo app('translator')->get('core.btnReject'); ?>">
                <p>
                    <?php echo app('translator')->get('messages.rejectLeave'); ?>
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal"
                        class="btn dark btn-outline">Tutup</button>
                <button type="submit" data-loading-text="<?php echo app('translator')->get("core.updating"); ?>..."
                        class="btn red">Lanjutkan Penolakan</button>
            </div>
        </div>
    </div>
</div>
<?php echo Form::close(); ?>

<!--[if lt IE 9]>
<?php echo HTML::script("assets/global/plugins/respond.min.js", array("rel" => "core")); ?>

<?php echo HTML::script("assets/global/plugins/excanvas.min.js", array("rel" => "core")); ?>

<![endif]-->

<?php echo HTML::script("assets/global/plugins/jquery.min.js", array("rel" => "core")); ?>

<?php echo HTML::script("assets/global/plugins/jquery-ui/jquery-ui.min.js", array("rel" => "core")); ?>

<?php echo HTML::script("assets/global/plugins/bootstrap/js/bootstrap.min.js", array("rel"  => "core")); ?>

<?php echo HTML::script("assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js", array("rel"  => "core")); ?>

<?php echo HTML::script("assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js", array("rel"  => "core")); ?>

<?php echo HTML::script("https://cdnjs.cloudflare.com/ajax/libs/js-cookie/2.1.0/js.cookie.min.js", array("rel"  => "core")); ?>

<?php echo HTML::script("assets/global/plugins/bootstrap-sessiontimeout/bootstrap-session-timeout.js", array("rel" => "core")); ?>

<?php echo HTML::script("assets/global/plugins/select2/js/select2.js", array("rel"  => "core")); ?>

<?php echo HTML::script('assets/global/plugins/uniform/jquery.uniform.min.js'); ?>

<?php echo HTML::script('assets/global/plugins/froiden-helper/helper.js?v=1', array("rel"  => "core")); ?>

<?php echo HTML::script("assets/admin/layout/scripts/app.js", array("rel"  => "core")); ?>

<?php echo HTML::script("assets/admin/layout/scripts/layout.js?v=1", array("rel"  => "core")); ?>

<?php echo HTML::script('assets/js/commonjs.js?v=3', array("rel"  => "core")); ?>

<?php echo HTML::script("assets/global/plugins/lodash.core.min.js", array("rel" => "core")); ?>


  <?php if($loggedAdmin->type =='admin'): ?>
	  



<?php if($loggedAdmin->company->status =='inactive'): ?>
	<script type="text/javascript">

    window.location.replace("<?php echo e(URL::route('admin.logout')); ?>");
</script>
<?php endif; ?>
   <?php else: ?>
	<STYLE>
.table-scrollable {
    width: 100%;
    overflow-x: auto;
    overflow-y: hidden;
    border: 1px solid #c2cad8;
    margin: 10px 0 !important;
}
</STYLE>


  <?php endif; ?>


<!-- END PAGE LEVEL SCRIPTS -->
<script rel="common" type="text/javascript">



    var assetsPath = "<?php echo e(asset("assets")); ?>";
    jQuery(document).ready(function () {

        App.setAssetsPath("<?php echo e(URL::asset("assets")); ?>/");
        $('.demo-loading-btn')
            .click(function () {
                var btn = $(this)
                btn.button('loading')
                setTimeout(function () {
                    btn.button('reset')
                }, 8000)
            });
        $('.demo-loading-btn-ajax')
            .click(function () {
                var btn = $(this)
                btn.button('loading')
                setTimeout(function () {
                    btn.button('reset')
                }, 500)
            });


    });
</script>
<script class="text/javascript">
    <?php if(Session::get('success')): ?>
    showToastrMessage('<?php echo addslashes(Session::get('success')); ?>', '<?php echo addslashes(__('messages.success')); ?>', 'success');
    <?php \Session::remove("success"); ?>
    <?php endif; ?>
    <?php if(count( $errors ) > 0): ?>
    showToastrMessage('<?php echo addslashes(__('messages.errorTitle')); ?>', '<?php echo addslashes(__('messages.error')); ?>', 'error');
    <?php endif; ?>
</script>


<script rel="core" type="text/javascript">
    var SessionTimeout = function () {
        var e = function () {
            $.sessionTimeout({
                title: "Sesi Login Sudah Timeoit",
                message: "Jika Anda Tidak Melakukan Aktivitas Maka Halaman Anda di kunci secara otomatis",
                keepAlive: false,
                redirUrl: false,
                logoutUrl: "<?php echo e(URL::route('admin.logout')); ?>",
                warnAfter: 900000,
                redirAfter: 1080000,
                logoutButton: "<?php echo app('translator')->get('core.logout'); ?>",
                countdownMessage: "Your screen will lock in {timer} seconds.",
                countdownBar: !0,
                anyActionHidesModal: false,
                countdownSmart: true,
                onRedir: function () {
                    $('#session-timeout-dialog').modal('hide');
                    lockScreenModal();
                }
            })
        };
        return {
            init: function () {
                e()
            }
        }
    }();
    SessionTimeout.init();

    var startToggle;
    var title = document.title;

    $('#session-timeout-dialog').on('shown.bs.modal', function () {

        function titleToggle() {
            if (document.title == "Attention!") {
                document.title = title;
            } else {
                document.title = "Attention!";
            }
        }

        startToggle = setInterval(titleToggle, 2000);
    });

    $('#session-timeout-dialog').on('hidden.bs.modal', function () {
        clearInterval(startToggle);
        document.title = title;
    });

    var lodash = _.noConflict();

    var popped = false;

    window.onpopstate = function (event) {
        if (event.state != null) {
            popped = true;
            loadView(event.state.path);
        }
    };


    function loginCheck() {
        $.easyAjax({
            type: "POST",
            url: "<?php echo e(URL::to('/admin/login')); ?>",
            data: $('#static_screen_lock').find("form").serialize(),
            container: "#static_screen_lock",
            messagePosition: "inline",
            redirect: false,
            success: function (response) {
                if (response.status == "success") {
                    $('#static_screen_lock').modal("hide").find("#password").val("");
                }
            }
        });
    }

    function ToggleEmailNotification(type) {
        if ($('[name=' + type + ']').is(':checked')) {
            var value = 1;
        } else {
            var value = 0;
        }

        $('#load_notification').html('<?php echo HTML::image('assets/loader.gif'); ?>');


        $.ajax({
            type: 'POST',
            url: "<?php echo e(route('admin.ajax_update_notification')); ?>",
            dataType: "JSON",
            data: {
                'value': value, 'id': '<?php echo e($loggedAdmin->company->id??''); ?>', 'type': type
            },
            success: function (response) {
                if (response.success == 'success') {
                    $('#load_notification').html('<span style="color:dodgerblue" class="fa fa-check"></span>');
                }
            },
            error: function (xhr, textStatus, thrownError) {
                alert('Data Fetching error');
            }
        });

    }


    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


    function onlyNum(cl) {
        $("." + cl).keydown(function (e) {
            // Allow: backspace, delete, tab, escape, enter and .
            if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
                // Allow: Ctrl+A, Command+A
                (e.keyCode == 65 && (e.ctrlKey === true || e.metaKey === true)) ||
                // Allow: home, end, left, right, down, up
                (e.keyCode >= 35 && e.keyCode <= 40)) {
                // let it happen, don't do anything
                return;
            }
            // Ensure that it is a number and stop the keypress
            if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                e.preventDefault();
            }
        });

    }

    var resp;
    var rawResponse;
    var ajaxScripts = 0;
    var evalScripts = [];
    var fileScripts = [];
    var Init = function () {
        return {
            init: function () {
            }
        };
    }();


    function executeScripts() {

        for (i = 0; i < fileScripts.length; i++) {
            try {
                $.globalEval(fileScripts[i]);
            } catch (e) {
                console.log("error");
                console.log(e);
            }
        }

        App.init();
//    App.unblockUI({target: ".page-content"});

        try {
            var completeScript = "";

            for (i = 0; i < evalScripts.length; i++) {
                try {
                    completeScript += $(evalScripts[i]).html();
                } catch (e) {
                    console.log("error");
                    console.log(e);
                }
            }

            $.globalEval(completeScript);
        } catch (e) {
            console.log("error");
            console.log(e);
        }

        try {
            $.globalEval($("script[rel='common']").html());
        } catch (e) {
            console.log(e);
        }

        $(document).trigger("ready");
        $(document).trigger("ajaxPageLoad");

        $(".popover").remove();
        jQuery('body').animate({scrollTop: 0}, 200);
    }

    function loadView(url) {

        $.ajax({
            url: url,
            dataType: "html",
            success: function (response) {
                // Check if we have been logged out

                var matches = response.match(/\<\!\-\-\ Login\ Page\ \-\-\>/g);
                var matches2 = response.match(/\<\!\-\-\ Screenlock\ \-\-\>/g);
                if ((matches != null && matches.length > 0) || (matches2 != null && matches2.length > 0)) {
                    window.location.href = "<?php echo e(route("admin.getlogin")); ?>";
                    return;
                }

                // Reset eval scripts array
                // We need to preserve the order of execution of scripts, so we do not execute them directly.
                // We save them in arrays first, then execute them in order
                evalScripts = [];
                fileScripts = [];

                rawResponse = response;
                resp = $(response);
                var html = resp.find(".page-content").html();
                var menu = resp.find(".hor-menu").html();
                var pageActions = resp.find(".page-actions").html();


                document.title = resp.filter("title").html();

                // Manage browse history
                if (!popped) {
                    history.pushState({path: url}, document.title, url);
                }
                popped = false;


                resp.filter("link").each(function () {
                    var that = $(this);

                    if (that.attr("rel") == "stylesheet") {
                        // Stylesheets with name=core are loaded on initial page load
                        // and always loaded. So, we need to ignore them.
                        if (that.attr("name") != "core") {
                            // This check is to prevent duplicate stylesheets from loading
                            if ($("link[href='" + (that.attr("href")) + "']").length == 0) {
                                $("#css_before_this").before(this);
                            }
                        }
                    }
                });

                // This is used to run evaluateScripts if no extra script was found on the page
                var scriptsFound = 0;

                resp.filter("script").each(function () {
                    var that = $(this);

                    if (that.attr("rel") != "core") {
                        // Prevent appending of same scripts again
                        if ($("script[href='" + (that.attr("src")) + "']").length == 0 && that.attr("src") != undefined) {
                            ajaxScripts++;
                            scriptsFound++;

                            fileScripts.push(that.attr("src"));
                            $.ajax({
                                url: that.attr("src"),
                                dataType: 'text',
                                success: function (response) {
                                    for (i = 0; i < fileScripts.length; i++) {
                                        if (fileScripts[i] == that.attr("src")) {
                                            fileScripts[i] = response;
                                        }
                                    }

                                    ajaxScripts--;


                                    if (ajaxScripts == 0) {
                                        // All pending ajax requests have completed. So, execute scripts now
                                        executeScripts();
                                    }
                                },
                                error: function (xhr, textStatus, thrownError) {
                                    ajaxScripts--;
                                }
                            });

                            // This is just to prevent duplicate script loading. Does nothing, as attribute is
                            // href not src
                            $("<script/>", {
                                type: "text/javascript",
                                href: that.attr("src")
                            }).append("body");
                        }

                        if (that.attr("src") == "" || that.attr("src") == undefined) {
                            evalScripts.push(this);
                        }
                    }
                });

                $(".page-content").html(html);
                $(".hor-menu").html(menu);
                $(".page-actions").html(pageActions);

                Layout.initMainMenu();


                if (scriptsFound == 0) {
                    console.log("executing scripts");
                    executeScripts();
                }

            },
            error: function (xhr, textStatus, thrownError) {
                window.location.href = url;
            }
        });
    }

    function lockScreenModal() {
        $.ajax({
            type: "POST",
            url: "<?php echo route('admin.screenlock.modal'); ?>"
        }).done(function (response) {
            $('#static_screen_lock').modal({
                backdrop: 'static',
                keyboard: false
            }).show();
        });
    }

    function show_approve(id) {
        $('#showModal').modal('hide');
        $('#show_approve').attr('action', "<?php echo e(URL::to('admin/leave_applications/')); ?>/" + id);
    }

    function show_approve_tampilan(id) {
        $('#showModal').modal('hide');
        $('#show_approve_tampilan').attr('action', "<?php echo e(route('admin.tanggal_absensis.show','')); ?>/" + id);
    }

    function show_approve_tampilan_shift(id) {
        $('#showModal').modal('hide');
        $('#show_approve_tampilan_shift').attr('action', "<?php echo e(route('admin.tanggal_normalshifts.show','')); ?>/" + id);
    }



   function LihatTampilanAPP() {
        $.ajaxModal('#Kunjungimesin', '<?php echo e(route('admin.settings.tampilan')); ?>');
    }


    function show_reject(id) {
        $('#showModal').modal('hide');
        $('#show_reject').attr('action', "<?php echo e(URL::to('admin/leave_applications/')); ?>/" + id);
    }  

	function show_reject_tampilan(id) {
        $('#showModal').modal('hide');
        $('#show_reject_tampilan').attr('action', "<?php echo e(route('admin.tanggal_absensis.show','')); ?>/" + id);
    }
	
		function show_reject_tampilan_shift(id) {
        $('#showModal').modal('hide');
        $('#show_reject_tampilan_shift').attr('action', "<?php echo e(route('admin.tanggal_normalshifts.show','')); ?>/" + id);
    }

</script>

<?php echo $__env->yieldContent('footerjs'); ?>
<?php /**PATH C:\xampp\htdocs\newabsen\resources\views/admin/include/footerjs.blade.php ENDPATH**/ ?>