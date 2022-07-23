@extends('Site.layouts.app')

@section('title','Bloglar')

@if(isset($description))
@section('description', $description)
@endif

@if(isset($keywords))
@section('keywords', $keywords)
@endif

@section('content')

<div class="container-fluid page-header hakkimizda-top position-relative">
	<div class="container position-relative h-100">
		<h2 class="header-text">Blog</h2>
		<div class="d-flex page-nav">
			<a href="{{ route('site.index') }}">Anasayfa</a> <span class="mx-2">|</span>			
			<a href="{{ route('site.bloglar') }}">Bloglar</a>
		</div>
	</div>
</div>

<section>
	<div class="container">
		@if(count($bloglar) == 0)
			<div class="alert alert-primary my-4">
				<i class="fas fa-info-circle me-2"></i>
				Henüz blog eklenmemiş
			</div>

		@else
			<div class="row pt-5">
				@php( include app_path()."/inc/functions.php" )
				@foreach($bloglar as $blog)
					<div class="col-md-6 col-lg-4">					
						<div class="p-3 blog-list-wrapper">
							<a href="{{ route('site.blog.detay', ['id'=>$blog->id, 'slug'=>$blog->slug]) }}" class="owl-blog-link blg-lis-a position-relative">
								@if(is_file("uploads/resim/blog/".$blog->resim))
									<img src="{{asset('uploads/resim/blog/'.$blog->resim)}}" class="img-fluid bd-img" alt="{{$blog->resim}}">
								@else
									<img src="{{asset('assets/site/img/resim-yok.png')}}" class="img-fluid bd-img" alt="Resim Yok">
								@endif						
							</a>
							<div class="text-end">
								<span class="blog-tarih text-uppercase">
									{{ $blog->created_at->translatedFormat('d F Y') }}
								</span>
							</div>	
							<h6 class="blog-header font-semibold my-2 text-uppercase">
								{{$blog->baslik}}
							</h6>
							
							<div class="blog-ozet-wrap bow-2">
								{!! substr_bosluk($blog->ozet, 170) !!}								
							</div>
							<div class="text-end py-1">
								<a href="{{ route('site.blog.detay', ['id'=>$blog->id, 'slug'=>$blog->slug]) }}" class="blog-devami">devamı &raquo;</a>
							</div>	
						</div>	
					</div>
				@endforeach
			</div>

			<div class="d-flex justify-content-end mt-3 mb-5">				
				{{ $bloglar->links('Site.layouts.sayfalama.sayfalama') }}
			</div>
		@endif
	</div>
</section>

@endsection

