@extends('Panel.layouts.app')

@section('title','Video Listesi')

@section('content')

<!-- ========== section start ========== -->
<section class="section">
	<div class="container-fluid p-3">
		<!-- ========== title-wrapper start ========== -->
		<div class="title-wrapper">
			<div class="row">
			<div class="col-md-6">
				<h4>Video Listesi</h4>
			</div>
			<!-- end col -->
			<div class="col-md-6">
				<div class="breadcrumb-wrapper">
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb">
							<li class="breadcrumb-item">
								<a href="#0">Anasayfa</a>
							</li>
							<li class="breadcrumb-item active" aria-current="page">
								Video Listesi
							</li>
						</ol>
					</nav>
				</div>
			</div>
			<!-- end col -->
			</div>
			<!-- end row -->
			<hr class="my-0"> 
		</div>
		<!-- ========== title-wrapper end ========== -->
	</div>
	<!-- end container -->
	
</section>
<!-- ========== section end ========== -->

<section class="sayfa-icerik-kapsayici px-3">

	@if(count($videolar) == 0)
		<div class="alert alert-danger my-4">
			<i class="fas fa-info-circle"></i>
			Henüz video eklenmemiş
		</div>
	@else
		<div class="row justify-content-center">
			@foreach($videolar as $value)
				<div class="col-sm-6 col-md-4 my-3 text-center">
					<h6>{{ $value->baslik }}</h6>
			   		@if(is_file("uploads/video/galeri/".$value->video))
					    
						<video controls style="width:100%; height:36vh">
							<source src="/uploads/video/galeri/{{$value->video}}" type="video/mp4">
							<source src="/uploads/video/galeri/{{$value->video}}" type="video/ogg">	
							<div class="alert alert-danger">
								Tarayıcınız video formatını desteklemiyor
							</div>
						</video> 
						
					@endif

					<button class="btn btn-danger btn-video-sil mt-1" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Sil" data-id="{{ $value->id }}">
						<i class="far fa-trash-alt"></i>
					</button>
			   </div>
		   @endforeach
		</div>

	@endif
	
</section> 
@endsection

@section("customJs")
<script>
$(function(){

	//video sil ----------------------------------------------------------
    $(".btn-video-sil").on("click", function(){                

		Swal.fire({
				type: "warning",               
				text: "Video silinecek, devam edilsin mi?",          
				showCancelButton: true,
				confirmButtonColor: '#e44242',
				confirmButtonText: 'Sil',
				cancelButtonText: "Vazgeç",
				cancelButtonColor: '#333',              
		}).then((result) => {
			if (result.value) {
				
				var i  = $(".btn-video-sil").index(this);
				var id = $(".btn-video-sil").eq(i).data("id"); 

				$.ajax({
					type        : "post",
					url         : "{{ route('panel.video.sil.post') }}",
					data        : {id:id},
							
					dataType    :'json',
					beforeSend: function() {
						$(".loading-wrapper").css("display","block");
					},          
					success : function(result){

						if( result.durum == "success"){
							$(".sortable-wrap").eq(i).remove();
							$(".spn-toast-success").html(result.mesaj);
							$(".toast-success").fadeIn();

							setTimeout(function(){ 
								$(".spn-toast-success").html("");
								$(".toast-success").fadeOut();
								window.location.reload();
							}, 1500); 
							
							return false;

						}else if( result.durum == "error"){

							$(".spn-toast-error").html(result.mesaj);
							$(".toast-error").fadeIn();

							setTimeout(function(){ 
								$(".spn-toast-error").html("");
								$(".toast-error").fadeOut();
							}, 3000); 

							return false;
						} 
					},
					complete: function() {
						$(".loading-wrapper").css("display","none");
					}                
				});
			}
		}); 
	});
	//----------------------------------------------------------------------------

	
});
</script>
@endsection
