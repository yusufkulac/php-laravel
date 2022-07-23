@extends('Site.layouts.app')

@section('title', $hizmetKategori->kategori_adi)

@if(isset($description))
@section('description', $description)
@endif

@if(isset($keywords))
@section('keywords', $keywords)
@endif

@section('content')

<div class="container-fluid page-header hakkimizda-top position-relative">
	<div class="container position-relative h-100">
		<h2 class="header-text">Hizmetler</h2>
		<div class="d-flex page-nav">
			<a href="{{ route('site.index') }}">Anasayfa</a> <span class="mx-2">|</span>
			<a href="{{ route('site.hizmet.kategori.list') }}">Hizmetler</a> <span class="mx-2">|</span>
			<a href="{{ route('site.hizmet.list', ['id'=>$hizmetKategori->id, 'slug'=>$hizmetKategori->slug]) }}">
				{{ $hizmetKategori->kategori_adi }}
			</a>					
		</div>
	</div>
</div>

<section>
	<div class="container py-5">		
		<h4 class="col-12 text-center text-uppercase proje-page-header">
			{{ $hizmetKategori->kategori_adi }}
		</h4>
		@if(count($hizmetler) == 0)
			<div class="alert alert-primary my-4">
				<i class="fas fa-info-circle"></i>
				Bu kategoriye henüz hizmet eklenmemiş
			</div>
		@else	
		<div class="row my-4 justify-content-center">
			@foreach($hizmetler as $hizmet)
				<a href="{{ route('site.hizmet.detay', ['id'=>$hizmet->id, 'slug'=>$hizmet->slug]) }}" class="col-md-6 col-lg-4 text-center my-4 proje-list-link position-relative">
					
					<div class="proje-list-wrapper hizmet-list-wrapper position-relative">
						@if(is_file("uploads/resim/hizmet/".$hizmet->resim))
							<img src="{{asset('uploads/resim/hizmet/'.$hizmet->resim)}}" alt="{{$hizmet->resim}}">
						@else
							<img src="{{asset('assets/site/img/resim-yok.png')}}" alt="Resim Yok">
						@endif	

							<h5 class="mt-2 hizmet-list-header">
							{{ $hizmet->baslik }}
						</h5>
						<div class="hizmet-list-overlay"></div>
					</div>
				</a>
			@endforeach
		</div>
		<div class="d-flex justify-content-end my-5">				
			{{ $hizmetler->links('Site.layouts.sayfalama.sayfalama') }}
		</div>
		@endif
	</div>
</section>

@endsection

