@extends('Site.layouts.app')

@section('title','Hizmetler')

@section('content')

<div class="container-fluid page-header hakkimizda-top position-relative">
	<div class="container position-relative h-100">
		<h2 class="header-text">Hizmetler</h2>
		<div class="d-flex page-nav">
			<a href="{{ route('site.index') }}">Anasayfa</a> <span class="mx-2">|</span>			
			<a href="{{ route('site.hizmet.kategori.list') }}">Hizmetler</a>
		</div>
	</div>
</div>

<section>
	<div class="container">	
		@if(count($hizmetKategori) == 0)
			<div class="alert alert-primary my-4">
				<i class="fas fa-info-circle"></i>
				Henüz hizmet eklenmemiş
			</div>
		@else	
		<div class="row my-4 justify-content-center">
			@foreach($hizmetKategori as $hizmetk)
				<a href="{{ route('site.hizmet.list', ['id'=>$hizmetk->id, 'slug'=>$hizmetk->slug]) }}" class="col-md-6 col-lg-4 text-center my-4 proje-list-link position-relative">
					
					<div class="proje-list-wrapper hizmet-list-wrapper position-relative">
						@if(is_file("uploads/resim/hizmet/".$hizmetk->resim))
							<img src="{{asset('uploads/resim/hizmet/'.$hizmetk->resim)}}" alt="{{$hizmetk->resim}}">
						@else
							<img src="{{asset('assets/site/img/resim-yok.png')}}" alt="Resim Yok">
						@endif	

						<h5 class="mt-2 text-uppercase hizmet-list-header">
							{{ $hizmetk->kategori_adi }}
						</h5>
						 <div class="hizmet-list-overlay"></div>
					</div>
				</a>
			@endforeach
		</div>
		@endif
	</div>
</section>

@endsection

