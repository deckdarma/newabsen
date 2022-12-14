<!DOCTYPE html>

<!--[if IE 8]>
<html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]>
<html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
    <meta charset="utf-8"/>
    <title> ABSENSI  - 404 PAGE </title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8">
    <meta content="" name="description"/>
    <meta content="" name="author"/>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <?php echo HTML::style("assets/global/plugins/font-awesome/css/font-awesome.min.css"); ?>

    <?php echo HTML::style("assets/global/plugins/simple-line-icons/simple-line-icons.min.css"); ?>

    <?php echo HTML::style("assets/global/plugins/bootstrap/css/bootstrap.min.css"); ?>

    <?php echo HTML::style("assets/global/plugins/uniform/css/uniform.default.css"); ?>

    <?php echo HTML::style("assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css"); ?>


    <?php echo HTML::style("assets/global/css/components.css"); ?>

    <?php echo HTML::style("assets/global/css/plugins.css"); ?>

    <?php echo HTML::style("assets/admin/layout/css/layout.css?v=1"); ?>

    <?php echo HTML::style("assets/admin/layout/css/themes/default.css"); ?>

    <?php echo HTML::style("assets/admin/layout/css/custom.css"); ?>

    <?php echo HTML::style("assets/admin/pages/css/error.css"); ?>



</head>
<!-- END HEAD -->

<body class="page-404-3">

<div class="container error-404">
    <h1>404</h1>
    <h2>Halaman Yang anda lihat tidak ada</h2>
    <p>
       Halaman ini mungkin tidak ada atau sudah di hapus
    </p>
    <p>
        <a href="<?php echo route('admin.dashboard.index'); ?>">
            Kembali Ke Beranda </a>
        <br>
    </p>
</div>
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>

<?php echo HTML::script("assets/global/plugins/respond.min.js"); ?>

<?php echo HTML::script("assets/global/plugins/excanvas.min.js"); ?>


<![endif]-->
<?php echo HTML::script("assets/global/plugins/jquery.min.js"); ?>

<?php echo HTML::script("assets/global/plugins/jquery-ui/jquery-ui.min.js"); ?>

<?php echo HTML::script("assets/global/plugins/bootstrap/js/bootstrap.min.js"); ?>

<?php echo HTML::script("assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js"); ?>



<?php echo HTML::script("assets/global/scripts/App.js"); ?>

<?php echo HTML::script("assets/admin/layout/scripts/layout.js?v=1"); ?>



<!-- END PAGE LEVEL SCRIPTS -->
<script>
    jQuery(document).ready(function () {
            App.init(); // init metronic core componets
            Layout.init(); // init layout

        }
    )
</script>

<?php echo $__env->yieldContent('footerjs'); ?>


<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>
<?php /**PATH C:\xampp\htdocs\newabsen\resources\views/admin/errors/404.blade.php ENDPATH**/ ?>