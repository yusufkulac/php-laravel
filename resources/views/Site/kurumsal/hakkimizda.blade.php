@extends('Site.layouts.app')

@section('title','Hakkımızda')

@if(isset($description))
@section('description', $description)
@endif

@if(isset($keywords))
@section('keywords', $keywords)
@endif

@section('content')

<div class="container-fluid page-header hakkimizda-top position-relative">
	<div class="container position-relative h-100">
		<h2 class="header-text">Hakkımızda</h2>
		<div class="d-flex page-nav">
			<a href="{{ route('site.index') }}">Anasayfa</a> <span class="mx-2">|</span>
			<a href="#">Kurumsal</a> <span class="mx-2">|</span>
			<a href="{{ route('site.hakkimizda') }}">Hakkımızda</a>
		</div>
	</div>
</div>

<section>
	<div class="container">
		<div class="row pt-5">
			<div class="col-lg-9 pt-4">
				{!! $kurumsal->hakkimizda !!}

				<div class="mt-4">
					<h6 class="page-head-small">Vizyon :</h6>
					<p>
						{!! $kurumsal->vizyon !!}
					</p>
				</div>

				<div class="my-4">
					<h6 class="page-head-small">Misyon :</h6>
					<p>
						{!! $kurumsal->misyon !!}
					</p>
				</div>

				<div class="mt-4 mb-5">
					<img src="{{ asset('assets/site/img/hakkimizda-sayfa.jpg') }}"  class="img-fluid" alt="hakkimizda-sayfa.jpg">
				</div>
			</div>
			<div class="col-lg-3 pe-0 pt-4 d-none d-lg-block">
				@include("Site.layouts.hizli-erisim")
			</div>
		</div>
	</div>
</section>

@endsection

@section("customJs")

@endsection
