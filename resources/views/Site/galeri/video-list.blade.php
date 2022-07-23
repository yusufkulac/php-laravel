@extends('Site.layouts.app')

@section('title','Video Galeri')

@if(isset($description))
@section('description', $description)
@endif

@if(isset($keywords))
@section('keywords', $keywords)
@endif

@section('content')

<div class="container-fluid page-header hakkimizda-top position-relative">
	<div class="container position-relative h-100">
		<h2 class="header-text">Video Galeri</h2>
		<div class="d-flex page-nav">
			<a href="{{ route('site.index') }}">Anasayfa</a> <span class="mx-2">|</span>			
			<a href="{{ route('site.video.galeri') }}">Video Galeri</a>			
		</div>
	</div>
</div>

<section>
	<div class="container">		
		<div class="row py-5 justify-content-center">			
			<div class="col-lg-9">
				@if(count($videolar) == 0)
					<div class="alert alert-primary">
						<i class="fas fa-info-circle"></i>
						Henüz video eklenmemiş
					</div>
				@else					
					<div class="row justify-content-center">
						@foreach($videolar as $value)							
					   		@if(is_file("uploads/video/galeri/".$value->video))
					   			<div class="col-md-6 text-center my-4">
					   				
									<video controls style="width:100%; height:36vh">
										<source src="/uploads/video/galeri/{{$value->video}}" type="video/mp4">
										<source src="/uploads/video/galeri/{{$value->video}}" type="video/ogg">	
										<div class="alert alert-danger">
											Tarayıcınız video formatını desteklemiyor
										</div>
									</video> 
									 					   				
					   				<h6>{{ $value->baslik }}</h6>
					   			</div>
							@endif
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

