@extends('Site.layouts.app')

@section('title', isset($blog->baslik) ? 'Blog - '.$blog->baslik : 'Blog ')

@if( isset($blog->description) && (strlen(trim($blog->description)) > 0 )  )
@section('description', $blog->description)
@endif

@if( isset($blog->keywords) && (strlen(trim($blog->keywords)) > 0 )  )
@section('keywords', $blog->keywords)
@endif

@section('content')

@if($blog == null)
	@php
		header('Location: ' . $_SERVER['HTTP_REFERER']);
		exit;
	@endphp
@endif

<div class="container-fluid page-header hakkimizda-top position-relative">
	<div class="container position-relative h-100">
		<h2 class="header-text">Blog</h2>
		<div class="d-flex page-nav">
			<a href="{{ route('site.index') }}">Anasayfa</a> <span class="mx-2">|</span>			
			<a href="{{ route('site.bloglar') }}">Blog</a>
			@if(isset($blog->baslik))
			<span class="mx-2">|</span>
			<a href="{{ route('site.blog.detay', ['id'=>$blog->id, 'slug'=>$blog->slug]) }}">{{ $blog->baslik }}</a>
			@endif			
		</div>
	</div>
</div>

<section>
	<div class="container">
		<div class="row pt-5 mt-3">
			<div class="col-lg-9">
				@if($blog == null)
					<div class="col-12 alert alert-danger my-4">
						<i class="fas fa-info-circle me-2"></i>
						Blog bulunamadı
					</div>
				@else
					<h5 class="text-ana-renk mb-2 blog-d-baslik text-uppercase">
						{{ $blog->baslik }}
					</h5>
					<div class="blog-detay-img-wrapper">						
						<div class="owl-carousel owl-theme owl-page-header position-relative">

							@if(count($blog->resimler) == 0)
								<div class="item">				
									@if(is_file('uploads/resim/blog/'.$blog->resim))
										<img src="{{ asset('uploads/resim/blog/'.$blog->resim) }}" alt="{{ $blog->resim }}">
									@else
										<img src="{{ asset('assets/site/img/resim-yok.png') }}" alt="Resim yok" class="img-fluid">
									@endif
								</div>

							@else
								@foreach($blog->resimler as $blogresim)
									<div class="item">	

										@if(is_file('uploads/resim/blog/'.$blogresim->resim))
											<img src="{{ asset('uploads/resim/blog/'.$blogresim->resim) }}" alt="{{ $blogresim->resim }}" class="img-fluid">
										@else
											<img src="{{ asset('assets/site/img/resim-yok.png') }}" alt="Resim yok" class="img-fluid">
										@endif

									</div>
								@endforeach	
							@endif		
						</div>	
					</div>

					<div class="d-flex my-2 justify-content-between">
						<div class="w-50 d-flex pt-1 date-dty-text">
							<i class="far fa-calendar-alt me-2 text-ana-renk mt-1"></i>
							{{ $blog->created_at->translatedFormat('d F Y') }}
							<i class="far fa-clock ms-3 me-1 text-ana-renk mt-1"></i>
							{{ $blog->created_at->translatedFormat('H:i') }}
						</div>
						<div class="w-50 d-flex justify-content-end">

							<div class="d-flex blog-link-wrapper">
								<a href="{{ route('site.blog.detay', ['id'=>($blog->id-1), 'slug'=>$blog->slug]) }}">
									&lsaquo; önceki
								</a>
								<span class="mx-2">|</span>
								<a href="{{ route('site.blog.detay', ['id'=>($blog->id+1), 'slug'=>$blog->slug]) }}">
									sonraki &rsaquo;
								</a>
							</div>

						</div>
					</div>

					<div class="my-4 pb-4">
						{!! $blog->icerik !!}
					</div>

					<div class="blog-video-wrapper my-4 text-center">
						@if(is_file('uploads/video/blog/'.$blog->video))
							<video controls>
							  	<source src="{{ asset('uploads/video/blog/'.$blog->video) }}" type="video/mp4">
							  	<source src="{{ asset('uploads/video/blog/'.$blog->video) }}" type="video/ogg">
								Tarayıcınız video tagını desteklemiyor
							</video>
						@endif
					</div>

					<!-- yotube link varsa videoyu ekle -->
					@if(strlen(trim($blog->video_link)) > 0)
						<div class="my-3 text-center">
							{!! $blog->video_link !!}
						</div>
					@endif

					@if(strlen(trim($blog->etiket)) > 0)
						<div class="etiket-wrapper d-flex mb-5">
							@php($etiketler = explode(",", $blog->etiket))

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
						@foreach($bloglar as $value)
						<li class="my-3">
							<a href="{{ route('site.blog.detay', ['id'=>$value->id, 'slug'=>$value->slug]) }}" class="d-flex">
								<div class="blog-right-img-wrap">
									<div class="blog-right-img-content">								
										@if(is_file('uploads/resim/blog/'.$value->resim))
											<img src="{{ asset('uploads/resim/blog/'.$value->resim) }}" alt="{{ $value->resim }}">
										@else
											<img src="{{ asset('assets/site/img/resim-yok.png') }}" alt="Resim yok" class="img-fluid">
										@endif
									</div>
								</div>
								<div class="w-100 ps-2 blog-right-text-content">
									<h6 class="text-ana-renk blg-right-head">{{ $value->baslik }}</h6>
									<div class="blg-r-ozet">
										{!! \Str::substr($value->ozet, "0","52").' ...' !!}
									</div>
								</div>
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
					<a href="http://www.facebook.com/share.php?u={{ route('site.blog.detay',['id'=>$blog->id, 'slug'=>$blog->slug]) }}" class="he-social he-facebook" target="_blank">
						<i class="fab fa-facebook-f"></i>
					</a>
					<a href="https://twitter.com/share" target="_blank" data-url="{{ route('site.blog.detay',['id'=>$blog->id, 'slug'=>$blog->slug]) }}" class="he-social he-twitter" target="_blank">
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

