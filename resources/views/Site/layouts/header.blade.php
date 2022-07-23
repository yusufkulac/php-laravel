<header id="main-header" class="main-header">
	<div class="container-fluid px-0">
		<div class="header-social d-flex justify-content-end pt-4">
			<a href="" target="_blank">
				<i class="fa-brands fa-facebook-f"></i>
			</a>
			<a href="" target="_blank">
				<i class="fa-brands fa-twitter"></i>
			</a>
			<a href="" target="_blank">
				<i class="fa-brands fa-youtube"></i>
			</a>
		</div>
	</div>	

	<div class="container-fluid px-0 pos">
		<div class="d-flex">
			<div class="logo-wrap">
				<a href="">
					<img src="assets/site/img/logo.png" class="img-fluid" alt="Logo">
				</a>
			</div>
			<div class="main-menu w-100">
				<ul class="d-flex flex-column flex-lg-row justify-content-lg-end w-100 pt-lg-5 mt-2">
					<li class="d-lg-none">
						<a href="">
							<img src="assets/site/img/logo-white.png" class="mobil-logo" alt="Logo">
						</a>
					</li>
					<li>
						<a href="{{route('site.index')}}" class="menu-link active">Home</a>
					</li>
					<li>
						<a href="{{route('site.hakkimizda')}}" class="menu-link">About us</a>
					</li>
					<li>
						<a href="{{route('site.projeler')}}" class="menu-link">Projects</a>
					</li>
					<li>
						<a href="{{route('site.video.galeri')}}" class="menu-link">Videos</a>
					</li>
					<li>
						<a href="{{route('site.hizmetler')}}" class="menu-link">Services</a>
					</li>
					<li>
						<a href="{{route('site.iletisim')}}" class="menu-link">Contact us</a>
					</li>
					<li>
						<button class="menu-button d-none d-lg-block">
							<i class="fa-solid fa-list btn-list"></i>							
						</button>
					</li>						
				</ul>
			</div>
			<button class="mobil-button d-lg-none">				
				<span class="mb-spn-1"></span>
				<span class="mb-spn-2"></span>
				<span class="mb-spn-3"></span>
			</button>
		</div>
	</div>					
</header>