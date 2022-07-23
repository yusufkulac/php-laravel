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
			<a href="{{ route('site.resim.galeri.list') }}">Resim Galeri</a> <span class="mx-2">|</span>
			<a href="{{ route('site.resim.list', ['id'=>$resimKategori->id, 'slug'=>$resimKategori->slug]) }}">{{ $resimKategori->galeri_adi }}</a>
			
		</div>
	</div>
</div>

<section>
	<div class="container">		
		<div class="row py-5 justify-content-center">
			<h5 class="col-12 text-ana-renk mb-2 blog-d-baslik text-uppercase">
				{{ $resimKategori->galeri_adi }}
			</h5>
			<div class="col-lg-9 pt-4">
				@if(count($resimler) == 0)
					<div class="alert alert-primary">
						<i class="fas fa-info-circle"></i>
						Bu galeriye henüz resim eklenmemiş
					</div>
				@else					
					<div class="row justify-content-center">
						@foreach($resimler as $value)			
							<div class="col-md-6 text-center my-2 proje-list-link position-relative">
								<div class="proje-list-wrapper position-relative">
									<a href="{{ asset('uploads/resim/galeri/'.$value->resim) }}" class="image-ek-link">
										<img src="{{ asset('uploads/resim/galeri/'.$value->resim) }}">	
									</a>					
								</div>
							</div>
						@endforeach
					</div>
				@endif
			</div>

			<div class="col-lg-3 pe-0 pt-4 d-none d-lg-block">
				<div class="hizli-erisim">
					<div class="hizli-erisim-search d-flex justify-content-start">
						<input type="text" name="search" placeholder="Kelime yaz">
						<button class="btn-blg-search">
							<i class="fas fa-search"></i>
						</button>
					</div>
					<ul>
						@foreach($resimKategoriler as $resimKat)
							<li class="hd-sag-li text-center my-3 position-relative">
								<a href="{{ route('site.resim.list', ['id'=>$resimKat->id, 'slug'=>$resimKat->slug]) }}">
									@if(is_file("uploads/resim/galeri/".$resimKat->resim))
										<img src="{{asset('uploads/resim/galeri/'.$resimKat->resim)}}" alt="{{$resimKat->resim}}">
									@else
										<img src="{{asset('assets/site/img/resim-yok.png')}}" alt="Resim Yok">
									@endif	

									<h6 class="text-uppercase hizmet-right-header">
										{{ $resimKat->galeri_adi }}
									</h6>
									<div class="hizmet-list-overlay"></div>
								</a>							
							</li>
						@endforeach
					</ul>	
				</div>	

				<div class="he-bg my-3 position-relative">
					<div class="he-bg-bottom text-center p-3">
						Bizimle iletişime geçmek ve soru sormak için 
						<a href="{{ route('site.iletisim') }}">iletişime geçin</a>
					</div>
				</div>

				<div class="d-flex my-2 justify-content-end mb-5">
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
			
		</div>
		
	</div>
</section>

@endsection

