<!DOCTYPE html>
<html lang="tr">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<link rel="shortcut icon" href="{{ asset('assets/panel/images/favicon.svg')}}">
	
	<title>@yield('title', 'Yönetim Paneli')</title>

	<!-- bootstrap 5 -->
	<link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css')}}">
	<!-- fontawesome 5 -->
	<link rel="stylesheet" href="{{ asset('assets/css/all.min.css')}}">	
	<link rel="stylesheet" href="{{ asset('assets/css/sweetalert2.min.css')}}">
	<link rel="stylesheet" href="{{ asset('assets/css/viewbox.css')}}">
	
	<link rel="stylesheet" href="{{ asset('assets/panel/css/main.css')}}">
	<link rel="stylesheet" href="{{ asset('assets/panel/css/style.css')}}">	
	
	@yield("customCss")  
</head>
<body>

	<div class="loading-wrapper">
		<div class="loading"></div>
	</div>

	<div class="toastt toast-success">
		<i class="fas fa-times toast-close" style="font-size:14px"></i>
		<div class="d-flex">
			<div class="toast-icon">
				<i class="fas fa-check text-success"></i>
			</div>
			<div class="w-100">
				<h6 class="text-success"><strong>İşlem Başarılı</strong></h6>
				<div class="spn-toast-success pe-3"></div>
			</div>			
		</div>
	</div>
	<div class="toastt toast-error">
		<i class="fas fa-times toast-close" style="font-size:14px"></i>
		<div class="d-flex">
			<div class="toast-icon">				
				<i class="fas fa-exclamation-triangle text-danger"></i>
			</div>
			<div class="w-100">
				<h6 class="text-danger"><strong>Hata Oluştu !</strong></h6>
				<div class="spn-toast-error pe-3"></div>
			</div>
			
		</div>
	</div>

<!-- sidebar --------------------------------->
@include('Panel.layouts.sidebar')
<!-- end sidebar ----------------------------->

 <!-- ======== main-wrapper start =========== -->
 <main class="main-wrapper">
	<!-- ========== header start ========== -->
	<header class="header">
	  <div class="container-fluid">
		<div class="row">
		  <div class="col-lg-5 col-md-5 col-6">
			<div class="header-left d-flex align-items-center">
			  <div class="menu-toggle-btn mr-20">
				<button id="menu-toggle" class="main-btn">
				  <i class="fas fa-bars me-2" style="font-size:24px; color:#888"></i>
				</button>
			  </div>
			</div>
		  </div>
		  <div class="col-lg-7 col-md-7 col-6">
			<div class="header-right">
			  <!-- notification start -->
			  <div class="header-message-box">
				<a href="{{ route('panel.basvuru.list') }}" class="header-a" data-bs-toggle="tooltip" data-bs-placement="bottom" title="İş Başvuruları">
				  <i class="far fa-bell"></i>
				  <span>{{ $yeniIsBasvuru }}</span>
				</a>				
			  </div>
			  <!-- notification end -->
			  <!-- message start -->
			  <div class="header-message-box ml-15">
				<a href="{{ route('panel.mesajlar') }}" class="header-a" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Mesajlar">
				  <i class="far fa-envelope"></i>
				  <span>{{$yeniMesaj}}</span>
				</a>				
			  </div>
			  <div class="header-message-box ml-15">
				<a href="" class="header-a" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Teklif Formu">
				  <i class="far fa-handshake"></i>
				  <span>{{$yeniTeklifFormu}}</span>
				</a>				
			  </div>
			  <!-- message end -->
			  <div class="header-message-box ml-15">
				<a href="{{ route('site.logout') }}" class="header-a" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Çıkış">
					<i class="fas fa-sign-out-alt text-danger"></i>				  
				</a>				
			  </div>			  
			</div>
		  </div>
		</div>
	  </div>
	</header>
	<!-- ========== header end ========== -->

@yield("content")

<!-- ========== footer start =========== -->
<footer class="footer">
	<div class="container-fluid">
	  <div class="row">
		<div class="col-md-6 order-last order-md-first">
		  <div class="copyright text-center text-md-start">
			<p class="text-sm">
			  Yönetim Paneli
			</p>
		  </div>
		</div>
		<!-- end col-->
		<div class="col-md-6">
		  <div class="terms d-flex justify-content-center justify-content-md-end">
			<a href="#0" class="text-sm"></a>
			<a href="#0" class="text-sm ml-15"></a>
		  </div>
		</div>
	  </div>
	  <!-- end row -->
	</div>
	<!-- end container -->
  </footer>
  <!-- ========== footer end =========== -->
</main>
<!-- ======== main-wrapper end =========== -->

<script src="{{asset('assets/js/jquery.3.6.0.js')}}"></script> 
<script src="{{asset('assets/js/jquery-ui.min.js')}}"></script> 
<script src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>  
<script src="{{asset('assets/js/sweetalert2.all.min.js')}}"></script> 
<script src="{{asset('assets/js/tinymce/tinymce.min.js')}}"></script>
<script src="{{asset('assets/js/jquery.viewbox.min.js')}}"></script>
<script src="{{asset('assets/panel/js/main.js')}}"></script>
<script src="{{asset('assets/panel/js/custom.js')}}"></script>
@yield("customJs")

</body>
</html>
	
