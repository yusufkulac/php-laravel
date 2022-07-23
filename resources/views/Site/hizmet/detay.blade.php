@extends('Site.layouts.app')

@section('title', isset($hizmet->baslik) ? $hizmet->baslik.' hizmeti' : 'Hizmet ')

@if( isset($hizmet->description) && (strlen(trim($hizmet->description)) > 0 )  )
@section('description', $hizmet->description)
@endif

@if( isset($hizmet->keywords) && (strlen(trim($hizmet->keywords)) > 0 )  )
@section('keywords', $hizmet->keywords)
@endif

@section('content')

@if($hizmet == null)
	@php
		header('Location: ' . $_SERVER['HTTP_REFERER']);
		exit;
	@endphp
@endif

<div class="container-fluid page-header hakkimizda-top position-relative">
	<div class="container position-relative h-100">
		<h2 class="header-text">Hizmetler</h2>
		<div class="d-flex page-nav">
			<a href="{{ route('site.index') }}">Anasayfa</a> <span class="mx-2">|</span>			
			<a href="{{ route('site.hizmet.kategori.list') }}">Hizmet</a> <span class="mx-2">|</span>
			<a href="{{ route('site.hizmet.detay', ['id'=>$hizmet->id, 'slug'=>$hizmet->slug]) }}">
				<span class="sayfa-nav-current">{{ $hizmet->baslik }}</span>
			</a>				
		</div>
	</div>
</div>

<section>
	<div class="container">
		<div class="row pt-5">
			<div class="col-lg-9">
				@if($hizmet == null)
					<div class="col-12 alert alert-danger my-4">
						<i class="fas fa-info-circle me-2"></i>
						Hizmet bulunamadı
					</div>
				@else
					<div class="d-flex my-2 justify-content-between">
						<div class="w-50 d-flex pt-1 pt-1 d-none d-lg-block">							
						</div>
						<div class="w-50 d-flex justify-content-end">
							<div class="d-flex blog-link-wrapper">
								<a href="{{ route('site.hizmet.detay', ['id'=>($hizmet->id-1), 'slug'=>$hizmet->slug]) }}">
									&lsaquo; önceki
								</a>
								<span class="mx-2">|</span>
								<a href="{{ route('site.hizmet.detay', ['id'=>($hizmet->id+1), 'slug'=>$hizmet->slug]) }}">
									sonraki &rsaquo;
								</a>
							</div>
						</div>
					</div>

					<h5 class="text-ana-renk mb-2 blog-d-baslik text-uppercase">
						{{ $hizmet->baslik }}
					</h5>

					<!--
					<div class="blog-detay-img-wrapper">						
						<div class="owl-carousel owl-theme owl-page-header position-relative">

							@if(count($hizmet->resimler) == 0)
								<div class="item">				
									@if(is_file('uploads/resim/hizmet/'.$hizmet->resim))
										<img src="{{ asset('uploads/resim/hizmet/'.$hizmet->resim) }}" alt="{{ $hizmet->resim }}">
									@else
										<img src="{{ asset('assets/site/img/resim-yok.png') }}" alt="Resim yok" class="img-fluid">
									@endif
								</div>

							@else
								@foreach($hizmet->resimler as $hizmetresim)
									<div class="item">				
										@if(is_file('uploads/resim/hizmet/'.$hizmetresim->resim))
											<img src="{{ asset('uploads/resim/hizmet/'.$hizmetresim->resim) }}" alt="{{ $hizmet->resim }}">
										@else
											<img src="{{ asset('assets/site/img/resim-yok.png') }}" alt="Resim yok" class="img-fluid">
										@endif										
									</div>
								@endforeach	
							@endif		
						</div>	
					</div>
					-->

					<div class="my-4">
						{!! $hizmet->icerik !!}
					</div>

					<div class="row mt-3">

						@if(is_file('uploads/resim/hizmet/'.$hizmet->resim))
							<div class="col-sm-6 col-md-4 col-lg-3 position-relative my-1 px-1">
								<div class="hiz-detay-img-wrap">
									<a href="{{ asset('uploads/resim/hizmet/'.$hizmet->resim) }}" class="image-ek-link">
										<img src="{{ asset('uploads/resim/hizmet/'.$hizmet->resim) }}">	
									</a>
								</div>
							</div>
						@endif	

						@if(count($hizmet->resimler) > 0)
							@foreach($hizmet->resimler as $hizmetresim)
								<div class="col-sm-6 col-md-4 col-lg-3 position-relative my-1 px-1">
									<div class="hiz-detay-img-wrap">				
										@if(is_file('uploads/resim/hizmet/'.$hizmetresim->resim))
											<a href="{{ asset('uploads/resim/hizmet/'.$hizmetresim->resim) }}" class="image-ek-link">
											<img src="{{ asset('uploads/resim/hizmet/'.$hizmetresim->resim) }}">
										</a>
										@endif										
									</div>
								</div>
							@endforeach	
						@endif

					</div>													

					<div class="blog-video-wrapper my-4 text-center">
						@if(is_file('uploads/video/hizmet/'.$hizmet->video))
							<video controls>
							  	<source src="{{ asset('uploads/video/hizmet/'.$hizmet->video) }}" type="video/mp4">
							  	<source src="{{ asset('uploads/video/hizmet/'.$hizmet->video) }}" type="video/ogg">
								Tarayıcınız video tagını desteklemiyor
							</video>
						@endif
					</div>

					<!-- yotube link varsa videoyu ekle -->
					@if(strlen(trim($hizmet->video_link)) > 0)
						<div class="my-3 text-center">
							{!! $hizmet->video_link !!}
						</div>
					@endif

					@if(strlen(trim($hizmet->etiket)) > 0)
						<div class="etiket-wrapper d-flex mb-5">
							@php($etiketler = explode(",", $hizmet->etiket))

							@for($i=0; $i<count($etiketler); $i++)
								<span class="etiket me-2">{{ $etiketler[$i] }}</span>								
							@endfor
						</div>						
					@endif					
				@endif				
			</div>
			
			<div class="col-lg-3">
				<div class="hizli-erisim">
					<div class="hizli-erisim-search d-flex justify-content-start">
						<input type="text" name="search" placeholder="Kelime yaz">
						<button class="btn-blg-search">
							<i class="fas fa-search"></i>
						</button>
					</div>
					<ul>
						@foreach($hizmetKategori as $hizmetKat)
							<li class="hd-sag-li text-center my-3 position-relative">
								<a href="{{ route('site.hizmet.list', ['id'=>$hizmetKat->id, 'slug'=>$hizmetKat->slug]) }}">
									@if(is_file("uploads/resim/hizmet/".$hizmetKat->resim))
										<img src="{{asset('uploads/resim/hizmet/'.$hizmetKat->resim)}}" alt="{{$hizmetKat->resim}}">
									@else
										<img src="{{asset('assets/site/img/resim-yok.png')}}" alt="Resim Yok">
									@endif	

									<h6 class="text-uppercase hizmet-right-header">
										{{ $hizmetKat->kategori_adi }}
									</h6>
									<div class="hizmet-list-overlay"></div>
								</a>							
							</li>
						@endforeach
					</ul>	
				</div>	

				<div class="he-bg my-3 position-relative">
					<div class="he-bg-bottom text-center p-3">
						Bizimle iletişime geçmek ve soru sormak için <a href="{{ route('site.iletisim') }}">iletişime geçin</a>
					</div>
				</div>

				<div class="d-flex my-2 justify-content-center mb-5">
					<a href="http://www.facebook.com/share.php?u={{ route('site.hizmet.detay',['id'=>$hizmet->id, 'slug'=>$hizmet->slug]) }}" class="he-social he-facebook" target="_blank">
						<i class="fab fa-facebook-f"></i>
					</a>
					<a href="https://twitter.com/share" target="_blank" data-url="{{ route('site.hizmet.detay',['id'=>$hizmet->id, 'slug'=>$hizmet->slug]) }}" class="he-social he-twitter" target="_blank">
						<i class="fab fa-twitter"></i>
					</a>

					@if(strlen($siteBilgi->instagram) > 0)
					<a href="https://www.instagram.com/{{ $siteBilgi->instagram }}" class="he-social he-instagram" target="_blank">
						<i class="fab fa-instagram"></i>
					</a>
					@endif
					
					<a href="https://api.whatsapp.com/send?phone={{ $siteBilgi->whatsapp_tel }}" class="he-social he-whatsapp" target="_blank">
						<i class="fab fa-whatsapp"></i>
					</a>
					
					@if(strlen($siteBilgi->pinterest) > 0)
					<a href="https://www.pinterest.com/{{ $siteBilgi->pinterest }}" class="he-social he-pinterest" target="_blank">
						<i class="fab fa-pinterest"></i>
					</a>
					@endif

					<a href="mailto:{{ $siteBilgi->mail }}" class="he-social he-mail" target="_blank">
						<i class="fas fa-envelope"></i>
					</a>					
					
				</div>
			</div>
		</div>
	</div>
</section>

@endsection

