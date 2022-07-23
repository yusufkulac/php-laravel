@extends('Site.layouts.app')

@section('title', isset($proje->baslik) ? 'Proje - '.$proje->baslik : 'Proje ')

@if( isset($proje->description) && (strlen(trim($proje->description)) > 0 )  )
@section('description', $proje->description)
@endif

@if( isset($proje->keywords) && (strlen(trim($proje->keywords)) > 0 )  )
@section('keywords', $proje->keywords)
@endif

@section('content')

@if($proje == null)
	@php
		header('Location: ' . $_SERVER['HTTP_REFERER']);
		exit;
	@endphp
@endif

<div class="container-fluid page-header hakkimizda-top position-relative">
	<div class="container position-relative h-100">
		<h2 class="header-text">Proje</h2>
		<div class="d-flex page-nav">
			<a href="{{ route('site.index') }}">Anasayfa</a> <span class="mx-2">|</span>			
			<a href="{{ route('site.projeler') }}">Proje</a>
			@if(strlen($proje->isveren) > 0)
				<span class="mx-2">|</span>
				<a href="{{ route('site.proje.detay', ['id'=>$proje->id, 'slug'=>$proje->slug]) }}">
					{{ $proje->isveren }}
				</a>
			@endif			
		</div>
	</div>
</div>

<section>
	<div class="container">
		<div class="row pt-5 mt-3">
			<div class="col-lg-9">
				@if($proje == null)
					<div class="col-12 alert alert-danger my-4">
						<i class="fas fa-info-circle me-2"></i>
						Proje bulunamadı
					</div>
				@else
					<div class="d-flex my-2 justify-content-between">
						<div class="w-50 d-flex pt-1 d-none d-lg-block">							
						</div>
						<div class="w-50 d-flex justify-content-end">
							<div class="d-flex blog-link-wrapper">
								<a href="{{ route('site.proje.detay', ['id'=>($proje->id-1), 'slug'=>$proje->slug]) }}">
										&lsaquo; önceki
								</a>
								<span class="mx-2">|</span>
								<a href="{{ route('site.proje.detay', ['id'=>($proje->id+1), 'slug'=>$proje->slug]) }}">
									sonraki &rsaquo;
								</a>
							</div>
						</div>
					</div>

					<h5 class="text-ana-renk mb-2 blog-d-baslik text-uppercase">
						{{ $proje->isveren }}
					</h5>

					<!--
						<div class="blog-detay-img-wrapper">

							<div class="owl-carousel owl-theme owl-page-header position-relative">

								@if(count($proje->resimler) == 0)
									<div class="item">				
										@if(is_file('uploads/resim/proje/'.$proje->resim))
											<img src="{{ asset('uploads/resim/proje/'.$proje->resim) }}" alt="{{ $proje->resim }}">
										@else
											<img src="{{ asset('assets/site/img/resim-yok.png') }}" alt="Resim yok" class="img-fluid">
										@endif
									</div>

								@else
									@foreach($proje->resimler as $projeresim)
										<div class="item">				
											<img src="{{ asset('uploads/resim/proje/'.$projeresim->resim) }}" alt="{{ $projeresim->resim }}">										
										</div>
									@endforeach	
								@endif		
							</div>	
						</div>
					-->
					@if(is_file('uploads/resim/proje/'.$proje->resim))
						<div class="prj-detay-img-wrap">						
							<img src="{{ asset('uploads/resim/proje/'.$proje->resim) }}" class="img-fluid prj-detay-resim">						
						</div>
					@endif	

					<div class="row my-1 px-2">	
						@if(count($proje->resimler) > 0)
							@foreach($proje->resimler as $projeresim)
								@if(is_file('uploads/resim/proje/'.$projeresim->resim))
									<div class="col-sm-6 col-md-4 col-lg-3 position-relative my-1 px-1">
										<div class="hiz-detay-img-wrap prj-det-img-small">
											<div class="w-100 h-100 overflow-hidden">
												<a href="{{ asset('uploads/resim/proje/'.$projeresim->resim) }}" class="image-ek-link">
													<img src="{{ asset('uploads/resim/proje/'.$projeresim->resim) }}">
												</a>
											</div>									
										</div>
									</div>
								@endif
							@endforeach	
						@endif
					</div>					

					<div class="my-4 pb-4">
						{!! $proje->aciklama !!}
					</div>

					<div class="proje-hakkinda-wrapper p-3">
						<h6>PROJE HAKKINDA</h6>
						<div class="d-flex flex-wrap mt-2">
							<div class="me-4 my-2">
								<h6 class="text-ana-renk">İŞVEREN</h6>
								<div>{{ $proje->isveren }}</div>
							</div>
							<div class="me-4 my-2">
								<h6 class="text-ana-renk">LOKASYON</h6>
								<div>{{ $proje->lokasyon }}</div>
							</div>
							<div class="me-4 my-2">
								<h6 class="text-ana-renk">HİMZET ALANI m<sup>2</sup></h6>
								<div>{{ $proje->hizmet_alani }}</div>
							</div>
							<div class="me-4 my-2">
								<h6 class="text-ana-renk">BAŞLANGIÇ TARİHİ</h6>
								<div>{{ $proje->baslama_tarihi }}</div>
							</div>
							<div class="me-4 my-2">
								<h6 class="text-ana-renk">BİTİŞ TARİHİ</h6>
								<div>{{ $proje->bitis_tarihi }}</div>
							</div>
						</div>						
					</div>

					<div class="blog-video-wrapper my-4 text-center">
						@if(is_file('uploads/video/proje/'.$proje->video))
							<video controls>
							  	<source src="{{ asset('uploads/video/proje/'.$proje->video) }}" type="video/mp4">
							  	<source src="{{ asset('uploads/video/proje/'.$proje->video) }}" type="video/ogg">
								Tarayıcınız video tagını desteklemiyor
							</video>
						@endif
					</div>

					<!-- yotube link varsa videoyu ekle -->
					@if(strlen(trim($proje->video_link)) > 0)
						<div class="my-3 text-center">
							{!! $proje->video_link !!}
						</div>
					@endif

					@if(strlen(trim($proje->etiket)) > 0)
						<div class="etiket-wrapper d-flex mb-5">
							@php($etiketler = explode(",", $proje->etiket))

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
						<li class="pd-sag-li li-1 text-center my-4">
							<a href="{{ route('site.tamamlanan.projeler') }}">
								TAMAMLANAN PROJELER
							</a>							
						</li>
						<li class="pd-sag-li li-2 text-center my-4">
							<a href="{{ route('site.planlanan.projeler') }}">
								PLANLANAN PROJELER
							</a>
						</li>
						<li class="pd-sag-li li-3 text-center my-4">
							<a href="{{ route('site.devam.projeler') }}">
								DEVAM EDEN PROJELER
							</a>
						</li>						
					</ul>	
				</div>	

				<div class="he-bg my-3 position-relative">
					<div class="he-bg-bottom text-center p-3">
						Bizimle iletişime geçmek ve soru sormak için <a href="{{ route('site.iletisim') }}">iletişime geçin</a>
					</div>
				</div>

				<div class="d-flex my-2 justify-content-center mb-5">
					<a href="http://www.facebook.com/share.php?u={{ route('site.proje.detay',['id'=>$proje->id, 'slug'=>$proje->slug]) }}" class="he-social he-facebook" target="_blank">
						<i class="fab fa-facebook-f"></i>
					</a>
					<a href="https://twitter.com/share" target="_blank" data-url="{{ route('site.proje.detay',['id'=>$proje->id, 'slug'=>$proje->slug]) }}" class="he-social he-twitter" target="_blank">
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
