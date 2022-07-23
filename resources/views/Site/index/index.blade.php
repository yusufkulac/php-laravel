@extends('Site.layouts.app')

@section('title','Alya Construction')

@if(isset($description))
@section('description', $description)
@endif

@if(isset($keywords))
@section('keywords', $keywords)
@endif

@section('content')

<div class="main-content py-3">

	<!-- slider ----->
	<section id="slider" class="position-relative">
		<div class="slider-wrapper position-relative">
			<div class="owl-carousel owl-theme owl-slider">
				
				<div class="item">
					<img src="uploads/resim/slider/slider-1.jpg" alt="$slider->resim" class="">	
					<div class="manset-text-wrap">
						<h1 class="w-100"><span>ALYA</span> MODERN EXTERIORS</h1>	
						<p class="mt-lg-5 w-100">
							Privileged Buildings,<br>
							Privileged Lives
						</p>
					</div>
								
				</div>	

			</div>
						
		</div>	

		<div class="slider-message-wrapper fade-up" data-scroll>
				<h3>Our 2-Step Quoote</h3>
				<h3><strong>FORM</strong></h3>

				<form id="">
					<div class="message-input-wrap d-flex flex-row mt-4">						
						<input type="text" name="fulname" placeholder="Fullname *">
					</div>
					<div class="message-input-wrap d-flex flex-row my-2">						
						<input type="email" name="mail" placeholder="Email *">
					</div>
					<div class="message-input-wrap d-flex flex-row my-2">						
						<input type="text" name="telefon" placeholder="Phone *">
					</div>

					<div class="message-input-wrap2 d-flex flex-row my-2 d-flex justify-content-between">
						<select name="konu">
							<option value="">Projects You Are Interested In</option>
						</select>						
					</div>

					<div class="message-input-wrap d-flex flex-row my-2">						
						<textarea name="mesaj" rows="4" placeholder="Message *"></textarea>
					</div>

					<button class="btn text-center btn-send">SEND</button>
				</form>				
			</div>
	</section>
	<!-- ./ slider -->

	<section id="section-1" data-scroll>
		<div class="container-fluid px-0">
			<div class="text-center section-header mt-5">
				<span class="sh-spn1">ALYA MODERN EXTERIOUS</span><span> | <a href="">Our Services</a></span>
			</div>

			<div class="row" data-scroll>
				<div class="col-md-6 col-xl-4 my-3" data-scroll>
					<a href="" class="d-block position-relative our-services-wrap">
						<img src="uploads/resim/proje/proje1.jpg" alt="">
						<span class="d-block our-services-header">Resedential</span>
						<div class="over"></div>
					</a>
				</div>
				<div class="col-md-6 col-xl-4 my-3">
					<a href="" class="d-block position-relative our-services-wrap">
						<img src="uploads/resim/proje/proje1.jpg" alt="">
						<span class="d-block our-services-header">Commerical</span>
						<div class="over"></div>
					</a>
				</div>
				<div class="col-md-6 col-xl-4 my-3">
					<a href="" class="d-block position-relative our-services-wrap">
						<img src="uploads/resim/proje/proje1.jpg" alt="">
						<span class="d-block our-services-header">Resurfacing</span>
						<div class="over"></div>
					</a>
				</div>
			</div>
		</div>
	</section>	

	<!-- about section -->
	<section id="section-2">
		<div class="container-fluid index-about-content" data-scroll>
			<div class="row">
				<div class="col-lg-4 my-3 text-center text-lg-start">
					<img src="assets/site/img/about.jpg" alt="about" class="img-fluid">
				</div>
				<div class="col-lg-8 my-3">

					<h3 class="col-header position-relative text-center">ABOUT</h3>

					<p class="mt-5">
						ALYA MODERN EXTERIOUS is the outcome of years of trade experience, attention to customer satisfaction, quality control and perfectionist tendencies. We prefer quality over quantity and take great pride in every one of our projects, no matter the size how big or small. We create beautiful exteriors to match the beautiful interiors of our lovely clients.
						<br><br>
						ALYA MODERN EXTERIOUS was co-founded by Michael Smith and Lars Caglan. Here’s a little about our founders: As he progressed and perfected his skills, it was then that he realized the low standards of work quality of the companies he was working with. This experience led Michael to part ways with the larger corporations and give his craft the time and respect it deserved.
					</p>
					
				</div>
			</div>
		</div>
	</section>

	<section id="section-3" class="mt-5" data-scroll>
		<div class="col-lg-7 mx-auto text-center mt-5">
			<h4 class="text-center yorum-title">What our clients say about us</h4>
			<div class="owl-carousel owl-theme owl-yorum">
				
				<div class="item mt-5">
					<p class="yorum-text">
						Lincoln Homes Canada Inc. highly recommends working with this company! They are very efficient, work hard and are easy to work with. Customer service is their number one priority and they deliver what they promise.
					</p>

					<span class="yorum-name">John Doe</span>
								
				</div>	
				<div class="item mt-5">
					<p class="yorum-text">
						Lincoln Homes Canada Inc. highly recommends working with this company! They are very efficient, work hard and are easy to work with. Customer service is their number one priority and they deliver what they promise.
					</p>

					<span class="yorum-name">John Doe 2</span>
								
				</div>	

			</div>
			
		</div>
	</section>

	<section id="section-4" data-scroll>
		<div class="container-fluid px-0">
			<div class="text-center section-header mt-5">
				<span class="sh-spn1">ALYA MODERN EXTERIOUS</span><span> | <a href="">Gallery</a></span>
			</div>

			<div class="row">
				<div class="col-md-6 col-xl-4 my-3">
					<a href="" class="d-block position-relative galeri-wrap">
						<img src="uploads/resim/galeri/img-1.jpg" alt="">						
						<div class="galeri-over"></div>
					</a>

					<h4 class="mt-3">Proje 1</h4>
					<p class="my-4">
						ALYA MODERN EXTERIOUS was co-founded by Michael Smith and Lars Caglan. Here’s a little about our founders: As he progressed and perfected his skills, it was then that he realized the
					</p>
					<a href="" class="more-link">more</a>
				</div>

				<div class="col-md-6 col-xl-4 my-3">
					<a href="" class="d-block position-relative galeri-wrap">
						<img src="uploads/resim/galeri/img-2.jpg" alt="">						
						<div class="galeri-over"></div>
					</a>

					<h4 class="mt-3">Proje 2</h4>
					<p class="my-4">
						ALYA MODERN EXTERIOUS was co-founded by Michael Smith and Lars Caglan. Here’s a little about our founders: As he progressed and perfected his skills, it was then that he realized the
					</p>
					<a href="" class="more-link">more</a>
				</div>

				<div class="col-md-6 col-xl-4 my-3">
					<a href="" class="d-block position-relative galeri-wrap">
						<img src="uploads/resim/galeri/img-3.jpg" alt="">						
						<div class="galeri-over"></div>
					</a>

					<h4 class="mt-3">Proje 3</h4>
					<p class="my-4">
						ALYA MODERN EXTERIOUS was co-founded by Michael Smith and Lars Caglan. Here’s a little about our founders: As he progressed and perfected his skills, it was then that he realized the
					</p>
					<a href="" class="more-link">more</a>
				</div>

			</div>
		</div>
	</section>

	<section id="section-5" data-scroll>
		<div class="container-fluid px-0">
			<div class="text-center section-header mt-5">
				<span class="sh-spn1">ALYA MODERN EXTERIOUS</span><span> | Useful Information</span>
			</div>

			<div class="row mt-5">
				<div class="col-lg-6 my-3">
					<a href="" class="d-block position-relative galeri-wrap">
						<img src="uploads/resim/blog/img-1.jpg" alt="">	
					</a>
					<div class="info-text-wrap mx-auto">					
						<h4 class="info-h4">WHAT IS <span>STUCCO?</span></h4>
						<p class="mt-5 mb-4">
							Stucco’N’Stone provides a variety of stucco applications from sand and cement to foam systems, mesh, and acrylic. Raise the value and beauty of your home or office space by investing in stucco today. Our professional team works hard to meet your schedule and renovating plans. If you are stuck on deciding what type stucco to choose, our experts can help find the right colour, texture, and style that best fits your space. Free estimates are available. Call to schedule for your appointment.
						</p>
						<a href="" class="more-link">more</a>
					</div>
				</div>

					<div class="col-lg-6 my-3">
					<a href="" class="d-block position-relative galeri-wrap">
						<img src="uploads/resim/blog/img-2.jpg" alt="">	
					</a>
					<div class="info-text-wrap mx-auto">					
						<h4 class="info-h4">BENEFITS OF <span>STUCCO?</span></h4>
						<p class="mt-5 mb-4">
							Stucco’N’Stone provides a variety of stucco applications from sand and cement to foam systems, mesh, and acrylic. Raise the value and beauty of your home or office space by investing in stucco today. Our professional team works hard to meet your schedule and renovating plans. If you are stuck on deciding what type stucco to choose, our experts can help find the right colour, texture, and style that best fits your space. Free estimates are available. Call to schedule for your appointment.
						</p>
						<a href="" class="more-link">more</a>
					</div>
				</div>				

			</div>
		</div>
	</section>

	<section id="section-6" class="mt-5" data-scroll>
		<div class="container-fluid px-0 my-5">
			<div class="text-center section-header mt-5">
				<span class="sh-spn1">ALYA MODERN EXTERIOUS</span><span> | <a href="">Videos</a></span>
			</div>
		</div>

		<div class="row">


			<div class="row mt-5 mb-5">
				<div class="col-md-6 my-3">
					<div class="video-page-wrapper">
						<video class="page-video" controls>
					    	<source src="uploads/video/video-1.mp4" type="video/mp4">
					    	<source src="uploads/video/video-1.mp4" type="video/ogg">
					    	Your browser does not support the video tag.
						</video>				
						<div class="video-over"></div>
						<div class="video-line"></div>
						<img src="assets/site/img/video.png" class="video-player">
					</div>
				</div>

				<div class="col-md-6 my-3">
					<div class="video-page-wrapper">
						<video class="page-video" controls>
					    	<source src="uploads/video/video-1.mp4" type="video/mp4">
					    	<source src="uploads/video/video-1.mp4" type="video/ogg">
					    	Your browser does not support the video tag.
						</video>				
						<div class="video-over"></div>
						<div class="video-line"></div>
						<img src="assets/site/img/video.png" class="video-player">
					</div>
				</div>
			</div>	
			
		</div>
	</section>

	<section id="section-7" class="mt-5 mx-lg-5 px-5 position-relative" data-scroll>
		<div class="container-fluid px-0 my-5">
			<div class="text-center section-header mt-5">
				<span class="sh-spn1">ALYA MODERN EXTERIOUS</span><span> | <a href="">Partners and Customers</a></span>
			</div>
		</div>

		<div class="owl-carousel owl-theme owl-referans mt-4 position-relative">
			
			<div class="item owl-referans-item text-center">
				<a href="{{ route('site.referanslar') }}">						
				<img src="uploads/resim/referans/img-1.jpg" class="marka-img" alt="{{ $referans->logo }}">
				</a>
			</div>

			<div class="item owl-referans-item text-center">
				<a href="{{ route('site.referanslar') }}">						
				<img src="uploads/resim/referans/img-2.jpg" class="marka-img" alt="{{ $referans->logo }}">
				</a>
			</div>

			<div class="item owl-referans-item text-center">
				<a href="{{ route('site.referanslar') }}">						
				<img src="uploads/resim/referans/img-3.jpg" class="marka-img" alt="{{ $referans->logo }}">
				</a>
			</div>

			<div class="item owl-referans-item text-center">
				<a href="{{ route('site.referanslar') }}">						
				<img src="uploads/resim/referans/img-4.jpg" class="marka-img" alt="{{ $referans->logo }}">
				</a>
			</div>

			<div class="item owl-referans-item text-center">
				<a href="{{ route('site.referanslar') }}">						
				<img src="uploads/resim/referans/img-5.jpg" class="marka-img" alt="{{ $referans->logo }}">
				</a>
			</div>									
		</div>	

		<button id="referansrPrev" class="btn btn-referans-nav prev">
			<i class="fa-solid fa-arrow-left"></i>
		</button>
		<button id="referansNext" class="btn btn-referans-nav next">
			<i class="fa-solid fa-arrow-right"></i>
		</button>		
	</section>
</div>

@endsection

@section("customJs")
<script src="{{asset('assets/site/js/index.js')}}"></script>
@endsection
