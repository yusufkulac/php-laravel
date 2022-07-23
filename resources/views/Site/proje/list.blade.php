@extends('Site.layouts.app')

@section('title','Projeler')

@if(isset($description))
@section('description', $description)
@endif

@if(isset($keywords))
@section('keywords', $keywords)
@endif

@section('content')

<div class="container-fluid page-header hakkimizda-top position-relative">
	<div class="container position-relative h-100">
		<h2 class="header-text">Projeler</h2>
		<div class="d-flex page-nav">
			<a href="{{ route('site.index') }}">Anasayfa</a> <span class="mx-2">|</span>			
			<a href="{{ route('site.projeler') }}">Projeler</a>
		</div>
	</div>
</div>

<section>
	<div class="container">		
		<div class="row py-5 justify-content-center">
			<a href="{{ route('site.tamamlanan.projeler') }}" class="col-md-6 col-lg-4 text-center my-4 proje-list-link position-relative">
				<div class="proje-list-wrapper position-relative">
					<img src="{{ asset('assets/site/img/proje-img-1.jpg') }}" alt="Proje Resim 1 ">
				</div>
				<h5 class="mt-2">Tamamlanan Projeler</h5>
			</a>
			<a href="{{ route('site.planlanan.projeler') }}" class="col-md-6 col-lg-4 text-center my-4 proje-list-link position-relative">
				<div class="proje-list-wrapper position-relative">
					<img src="{{ asset('assets/site/img/proje-img-2.jpg') }}" alt="Proje Resim 2 ">
				</div>
				<h5 class="mt-2">Planlanan Projeler</h5>
			</a>
			<a href="{{ route('site.devam.projeler') }}" class="col-md-6 col-lg-4 text-center my-4 proje-list-link position-relative">
				<div class="proje-list-wrapper position-relative">
					<img src="{{ asset('assets/site/img/proje-img-3.jpg') }}" alt="Proje Resim 3 ">
				</div>
				<h5 class="mt-2">Devam Eden Projeler</h5>
			</a>
		</div>
		<div class="d-flex my-2 justify-content-center mb-5">
			<a href="" class="he-social he-facebook" target="_blank">
				<i class="fab fa-facebook-f"></i>
			</a>
			<a href="" class="he-social he-twitter" target="_blank">
				<i class="fab fa-twitter"></i>
			</a>
			<a href="" class="he-social he-whatsapp" target="_blank">
				<i class="fab fa-whatsapp"></i>
			</a>
			<a href="" class="he-social he-fbmessage" target="_blank">
				<i class="fab fa-facebook-messenger"></i>
			</a>
			<a href="" class="he-social he-pinterest" target="_blank">
				<i class="fab fa-pinterest"></i>
			</a>
			<a href="" class="he-social he-mail" target="_blank">
				<i class="fas fa-envelope"></i>
			</a>
			<a href="" class="he-social he-share" target="_blank">
				<i class="fas fa-share-alt"></i>
			</a>
		</div>
	</div>
</section>

@endsection

