@extends('Site.layouts.app')

@section('title','Referanslar')

@if(isset($description))
@section('description', $description)
@endif

@if(isset($keywords))
@section('keywords', $keywords)
@endif

@section('content')

<div class="container-fluid page-header hakkimizda-top position-relative">
	<div class="container position-relative h-100">
		<h2 class="header-text">Referanslar</h2>
		<div class="d-flex page-nav">
			<a href="{{ route('site.index') }}">Anasayfa</a> <span class="mx-2">|</span>
			<a href="{{ route('site.referanslar') }}">Referanslar</a>
		</div>
	</div>
</div>

<section>
	<div class="container">
		<div class="row pt-5">
			<div class="col-lg-9 pt-4">
				<div class="row">
					@if(count($referanslar) <= 0)
						<div class="alert alert-primary my-4">
							<i class="fas fa-info-circle me-2"></i>
							Henüz referans eklenmemiş
						</div>
					@else
						@foreach($referanslar as $referans)
						<div class="col-sm-6 col-md-4 col-lg-3 text-center my-3">
							<div class="referans-img-content">
								<div class="ref-img-wrapper">
									@if(is_file('uploads/resim/referans/'.$referans->logo))
										<img src="{{ asset('uploads/resim/referans/'.$referans->logo) }}" alt="{{ $referans->logo }}" class="img-fluid">
									@else
										<img src="{{ asset('assets/site/img/resim-yok.png') }}" alt="Resim Yok">
									@endif
								</div>
							</div>
							<h6 class="text-uppercase ref-h6 my-2">{{ $referans->referans_adi }}</h6>
						</div>
						@endforeach
					@endif

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
