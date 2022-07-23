@extends('Site.layouts.app')

@section('title','Resim Galeri')

@if(isset($description))
@section('description', $description)
@endif

@if(isset($keywords))
@section('keywords', $keywords)
@endif

@section('content')

<div class="container-fluid page-header hakkimizda-top position-relative">
	<div class="container position-relative h-100">
		<h2 class="header-text">Resim Galeri</h2>
		<div class="d-flex page-nav">
			<a href="{{ route('site.index') }}">Anasayfa</a> <span class="mx-2">|</span>			
			<a href="{{ route('site.resim.galeri.list') }}">Resim Galeri</a>
		</div>
	</div>
</div>

<section>
	<div class="container">		
		<div class="row py-5 justify-content-center">
			<div class="col-lg-9 pt-4">
				@if(count($resimKategoriler) == 0)
					<div class="alert alert-primary my-4">
						<i class="fas fa-info-circle"></i>
						Henüz resim galerisi eklenmemiş
					</div>
				@else
					<div class="row">
						@foreach($resimKategoriler as $value)			
							<a href="{{ route('site.resim.list', ['id'=>$value->id, 'slug'=>$value->slug]) }}" class="col-md-6 text-center my-2 proje-list-link position-relative">
								<div class="proje-list-wrapper position-relative">
									@if(is_file("uploads/resim/galeri/".$value->resim))
										<img src="{{ asset("uploads/resim/galeri/".$value->resim) }}" alt="{{ $value->resim }}">
									@else
										<img src="{{ asset("assets/site/img/resim-yok.png") }}" alt="Resm Yok">
									@endif						
								</div>
								<h5 class="mt-2">{{ $value->galeri_adi }}</h5>
							</a>
						@endforeach
					</div>
				@endif
			</div>

			<div class="col-lg-3 pe-0 pt-4 d-none d-lg-block">
				@include("Site.layouts.hizli-erisim")
			</div>
			
		</div>
		
	</div>
</section>

@endsection

