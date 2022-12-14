<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<title>E-ABSEN LOGIN</title>
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- Favicon -->

	<!-- Bootstrap CSS -->
	 {!! HTML::style("login/css/bootstrap.min.css") !!}


	{!! HTML::style("login/css/fontawesome-all.min.css") !!}

	{!! HTML::style("login/font/flaticon.css") !!}
	<!-- Google Web Fonts -->
	{!! HTML::style("login/style.css") !!}
   {!! HTML::style("https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all", array("name" => "core"))!!}

    {!! HTML::style("assets/admin/pages/css/login-soft.css") !!}

</head>

<body class="login">
	<!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->
    <div id="preloader" class="preloader">
        <div class='inner'>
            <div class='line1'></div>
            <div class='line2'></div>
            <div class='line3'></div>
        </div>
    </div>
	<section class="fxt-template-animation fxt-template-layout4">
		<div class="container-fluid" >
			<div class="row">
			
				<div class="col-md-6 col-12 fxt-bg-wrap" style="background: #c8d8e7;" >
					<div class="fxt-bg-img">
						<div class="fxt-header">
							<div class="fxt-transformY-50 fxt-transition-delay-1">
							<img src="{{$setting->logo_image_url}}" alt="Logo">
							</div>
							<div class="fxt-transformY-50 fxt-transition-delay-2">
								<h1>Selamat Datang di E-ABSEN</h1>
							</div>
							<div class="fxt-transformY-50 fxt-transition-delay-3">
								<p>Sistem Informasi Manajemen
Kinerja Kehadiran Pegawai
 yang juga dapat dijadikan dasar pemberian insentif kepada seluruh pegawai Pemerintah Kabupaten Banggai. Ini merupakan sistem tertutup yang memerlukan login untuk masuk, melihat data, dan melakukan aktifitas.</p>
									<a href="../../ceknip" class="fxt-btn-fill" >
        LIHAT ABSENSI ANDA
        </a>
							</div>
							
						</div>
				
					</div>
				</div>
				<div class="col-md-6 col-12 fxt-bg-color">
				
					<div class="fxt-content content">

						<div class="fxt-form">
						 {!! Form::open(array('url' => '', 'class' =>'login-form')) !!}
								<div class="form-group">
									<label for="email" class="input-label">Email Address</label>
				            <input class="form-control" type="email" autocomplete="off"
                   placeholder="{{ trans('core.email')}}" name="email"/>
								</div>
								<div class="form-group">
									<label for="password" class="input-label">Password</label>
     <input class="form-control" type="password" autocomplete="off"
                   placeholder="{{ trans('core.password') }}" id="password" name="password"/>
									<i toggle="#password" class="fa fa-fw fa-eye toggle-password field-icon"></i>
								</div>
								<div class="form-group">
									<div class="fxt-checkbox-area">
										<div class="checkbox">
											<input id="checkbox1" type="checkbox" name="remember" value="1" checked>
											<label for="checkbox1">Ingatkan Saya Selalu</label>
										</div>
										
										<a class="switcher-text" href="javascript:;" id="forget-password">Lupa Kata Sandi? </a>
									</div>
								</div>
								<div class="form-group">
		<button type="submit" class="fxt-btn-fill" id="submitbutton" onclick="login(); return false;">
           Lanjutkan Login
        </button>
								</div>
							    {!! Form::close() !!}
								

    <!-- BEGIN FORGOT PASSWORD FORM -->
    {!! Form::open(['url' => '', 'method' => 'post', 'class'=>'forget-form']) !!}
    <h3>Lupa Kata Sandi?</h3>

    <p>
     Harap Hubungi Admin Dinas Komunikasi Dan Informatika Kabupaten Banggai, Anda Bisa datang langsung ke kantor pada jam kerja sesusai dengan prosedur yang berlaku..!
    </p>


    <div class="form-actions rem">
        <button type="button" id="back-btn" class="fxt-btn-fill">
           Kembali Ke Login
        </button>

    </div>
{!! Form::close() !!}

						</div>
				
					</div>
				</div>
			</div>
		</div>
	</section>

{!! HTML::script("login/js/jquery-3.5.0.min.js")!!}
{!! HTML::script("login/js/bootstrap.min.js")!!}
{!! HTML::script("login/js/imagesloaded.pkgd.min.js")!!}
{!! HTML::script("login/js/validator.min.js")!!}
{!! HTML::script("login/js/main.js")!!}

{!! HTML::script('assets/global/plugins/froiden-helper/helper.js')!!}

<style>
.fxt-template-layout4 .fxt-bg-wrap:before {

  background: url({!! URL::asset('assets/admin/pages/media/bg/1.jpg') !!}) rgb(200, 216, 231);

}
</style>

	<script>
	document.oncontextmenu = function(e) {
  var el = window.event.srcElement || e.target;
  var tp = el.tagName || '';
  if ( tp.toLowerCase() == 'input' || tp.toLowerCase() == 'select' || tp.toLowerCase() == 'textarea' ){
    return false;
  }
};



// With jQuery
$(document).on({
    "contextmenu": function(e) {
        console.log("ctx menu button:", e.which); 

        // Stop the context menu
        e.preventDefault();
    },
    "mousedown": function(e) { 
        console.log("normal mouse down:", e.which); 
    },
    "mouseup": function(e) { 
        console.log("normal mouse up:", e.which); 
    }
});
 </script>
<script>
    function login() {
        $.easyAjax({
            url: "{!! route('admin.login') !!}",
            type: "POST",
            data: $(".login-form").serialize(),
            container: ".login-form",
            messagePosition: "inline"
        });
    }




    jQuery('#forget-password').click(function () {
        jQuery('.login-form').hide();
        jQuery('.forget-form').show();
    });

    jQuery('#back-btn').click(function () {
        jQuery('.login-form').show();
        jQuery('.forget-form').hide();

    });


</script>
</body>

</html>