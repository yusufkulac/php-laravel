@extends('Site.layouts.app')

@section('title',$durumu.' projeler')

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
			<a href="{{ route('site.projeler') }}">Proje</a> <span class="mx-2">|</span>
			@if($durumu == "Tamamlanan")			
			<a href="{{ route('site.tamamlanan.projeler') }}">{{ $durumu }}</a>
			@endif
			@if($durumu == "Planlanan")			
			<a href="{{ route('site.planlanan.projeler') }}">{{ $durumu }}</a>
			@endif
			@if($durumu == "Devam Eden")			
			<a href="{{ route('site.devam.projeler') }}">{{ $durumu }}</a>
			@endif
		</div>
	</div>
</div>

<section>
	<div class="container">		
		<div class="row py-5 justify-content-center">
			<h4 class="col-12 text-center text-uppercase proje-page-header">
				{{ $durumu }} Projeler
			</h4>

			@if(count($projeler) == 0)
				<div class="alert alert-danger my-4">
					<i class="fas fa-info-circle"></i>
					{{ $durumu }} proje yok
				</div>
			@else
				@foreach($projeler as $proje)
				<a href="{{ route('site.proje.detay', ['id'=>$proje->id, 'slug'=>$proje->slug]) }}" class="col-md-6 col-lg-4 text-center my-4 proje-list-link position-relative">
					<div class="proje-list-wrapper position-relative">
						@if(is_file("uploads/resim/proje/".$proje->resim))
							<img src="{{asset('uploads/resim/proje/'.$proje->resim)}}" alt="{{$proje->resim}}" class="img-fluid">
						@else
							<img src="{{asset('assets/site/img/resim-yok.png')}}" alt="Resim Yok" class="img-fluid">
						@endif	
					</div>
					<h5 class="mt-2 text-uppercase">{{ $proje->isveren }}</h5>
				</a>
				@endforeach
			@endif			
		</div>

		<div class="d-flex justify-content-end my-5">				
			{{ $projeler->links('Site.layouts.sayfalama.sayfalama') }}
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

