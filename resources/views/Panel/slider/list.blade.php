@extends('Panel.layouts.app')

@section('title','Slider listesi')

@section('content')
<!-- ========== section start ========== -->
<section class="section">
	<div class="container-fluid p-3">
		<!-- ========== title-wrapper start ========== -->
		<div class="title-wrapper">
			<div class="row">
			<div class="col-md-6">
				<h4>Slider Listesi</h4>
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
								Slider Listesi
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
	<a href="{{ route('panel.slider.ekle') }}" class="btn btn-secondary my-3">
		<i class="fas fa-plus"></i> Slider Ekle
	</a>
	@if(count($sliders) == 0)
		<div class="alert alert-danger my-3">
			<i class="fas fa-info-circle"></i> Henüz slider eklenmemiş
		</div>
	@else
    <div class="row">
        @foreach($sliders as $slider)
            <div class="col-lg-6 col-xl-4 my-3">
                <div class="slider-content">
                	<div class="" style="height: 100%; max-height:100%; overflow: hidden;">
                    @if(is_file("uploads/resim/slider/".$slider->resim))
                        <img src="{{ asset('uploads/resim/slider/'.$slider->resim) }}" style="height:100%; min-width:100%; width:auto">
                    @else
                        <img src="{{ asset('assets/panel/images/no-image.png') }}">
                    @endif
                	</div>                	
                </div>
                <div class="d-flex p-2 bg-white border">
                	<div class="d-flex justify-content-center align-items-center slider-sira-wrap">
                		{{ $slider->sira }}
                	</div>
            		<button class="btn btn-danger me-2 slider-sil" data-id="{{ $slider->id }}">
            			<i class="far fa-trash-alt"></i> Sil
            		</button>
            		<a href="{{ route('panel.slider.duzenle', ['id'=>$slider->id]) }}" class="btn btn-primary">
            			<i class="far fa-edit"></i> Düzenle
            		</a>
            	</div>
            </div>
        @endforeach
    </div>
    @endif
</section>
@endsection

@section("customJs")
<script>
$(function(){

	//slider  sil ----------------------------------------------------------------
    $(".slider-sil").on("click", function(){                

		Swal.fire({
				type: "warning",               
				text: "Slider silinecek, devam edilsin mi?",          
				showCancelButton: true,
				confirmButtonColor: '#e44242',
				confirmButtonText: 'Sil',
				cancelButtonText: "Vazgeç",
				cancelButtonColor: '#333',              
		}).then((result) => {
			if (result.value) {

				var i  = $(".slider-sil").index(this);
				var id = $(".slider-sil").eq(i).data("id"); 

				$.ajax({
					type        : "post",
					url         : "{{ route('panel.slider.sil') }}",
					data        : {id:id},
							
					dataType    :'json',
					beforeSend: function() {
						$(".loading-wrapper").css("display","block");
					},          
					success : function(result){

						if( result.durum == "success"){

							$(".spn-toast-success").html(result.mesaj);
							$(".toast-success").fadeIn();

							setTimeout(function(){ 
								$(".spn-toast-success").html("");
								$(".toast-success").fadeOut();
								window.location.href = "{{ route('panel.slider.liste') }}";
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
	//---------------------------------------------------------------------------
 
		
})
</script>
@endsection
