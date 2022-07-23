<!DOCTYPE html>
<html lang="tr">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">	
	<meta name="description" content="@yield('description', $siteBilgi->description)">
    <meta name="keywords" content="@yield('keywords', $siteBilgi->keyword)">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<link rel="shortcut icon" href="{{ asset('assets/site/img/'.$siteAyar->favicon) }}">
	<link rel="author" href="yusuf kulaç">
	<title>@yield('title', 'Alya Construction')</title>
	@if(strlen(trim($siteAyar->google_analistik)) > 0)
	{!! $siteAyar->google_analistik !!}
	@endif
	@if(strlen(trim($siteAyar->google_dogrulama)) > 0)
	{!! $siteAyar->google_dogrulama !!}
	@endif	
	<link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css')}}">
	<link rel="stylesheet" href="{{ asset('assets/css/all.min.css')}}">	
	<link rel="stylesheet" href="{{ asset('assets/css/sweetalert2.min.css')}}">
	<link rel="stylesheet" href="{{ asset('assets/css/viewbox.css')}}">	
	<link rel="stylesheet" href="{{ asset('assets/css/owl.carousel.min.css')}}">
	<link rel="stylesheet" href="{{ asset('assets/css/owl.theme.default.min.css')}}">	
	<!-- -->
	<link rel="stylesheet" href="{{ asset('assets/site/css/fonts.css')}}">
	<link rel="stylesheet" href="{{ asset('assets/site/css/reset.css')}}">		
	<link rel="stylesheet" href="{{ asset('assets/site/css/style.css')}}">
	@yield("customCss") 
</head>
<body>
<div id="main-wrapper"> <!--  main wrapper -->


<!-- ============ header ==============----->
@include("Site.layouts.header")
<!-- ========== ./header ==============----->

@yield("content")

</div> <!--  main wrapper -->
<!-- ========== footer start =========== -->
<footer id="footer">
	<div class="container-fluid py-4">
		<div class="row">
			<div class="col-lg-6">
				<form id="newsletterForm">
					<label class="newsletter-label">E-NEWSLETTER</label>
					<div class="d-flex my-3">
						<input type="text" name="" class="newsletter-input">
						<button type="button" class="btn-newsletter">
							<i class="fa-solid fa-right-long"></i>
						</button>
					</div>
					<div>					
						<input type="checkbox" name="policy_ckeck_1" id="pch1">
						<label for="pch1" class="lbl-poplicy text-decoration-underline">
							I approve the Personal Data Protection Policy
						</label>
					</div>
					<div>					
						<input type="checkbox" name="policy_ckeck_2" id="pch2">
						<label for="pch2" class="lbl-poplicy">
							I want to be. I have read and accept the Privacy Policy
						</label>
					</div>
				</form>
			</div>
			<div class="col-lg-6 pt-4">
				<div class="text-end">
					<span class="snp-footer-el-yazi">Social Media</span><br>				
					<span class="spn-footer-follow">Follow us on social networks!</span>
				</div>

				<ul class="p-0 d-flex justify-content-end mt-4">
					<li>
						<a href="" class="footer-social-link ms-3" target="_blank">
							<i class="fa-brands fa-facebook-f"></i>
						</a>
					</li>
					<li>
						<a href="" class="footer-social-link ms-3" target="_blank">
							<i class="fa-brands fa-twitter"></i>
						</a>
					</li>
					<li>
						<a href="" class="footer-social-link ms-3" target="_blank">
							<i class="fa-brands fa-youtube"></i>
						</a>
					</li>
					<li>
						<a href="" class="footer-social-link ms-3" target="_blank">
							<i class="fa-brands fa-linkedin"></i>
						</a>
					</li>
				</ul>
			</div>
		</div>
		<div class="row mt-1">
			<div class="col-lg-6">
				
			</div>
			<div class="col-lg-6 author-right d-flex justify-content-lg-end py-2">
				<a href="https://websitelerim.com" target="_blank" class="author-link">websitelerim.com</a>
				<span class="author-year ms-1">2022</span>
				<span class="ms-1 footer-resv"> &copy; All rights reserved</span> 
			</div>
		</div>
	</div>
</footer>
<!-- ========== footer end ============= -->
</div>

<script type="text/javascript" src="{{asset('assets/js/jquery.3.6.0.js')}}"></script> 
<script type="text/javascript" src="{{asset('assets/js/jquery-ui.min.js')}}"></script> 
<script type="text/javascript" src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script> 
<script type="text/javascript" src="{{asset('assets/js/jquery.viewbox.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/sweetalert2.all.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/owl.carousel.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/scroll-out.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/site/js/script.js')}}"></script>
@yield("customJs")
</body>
</html>
	
