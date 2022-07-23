@extends('Panel.layouts.app')

@section('title','Sıkça Sorulan Sorular')

@section('content')

<!-- ========== section start ========== -->
<section class="section">
	<div class="container-fluid p-3">
		<!-- ========== title-wrapper start ========== -->
		<div class="title-wrapper">
			<div class="row">
			<div class="col-md-6">
				<h4>Sıkça Sorulan Sorular</h4>
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
								Sıkça Sorulan Sorular
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
	@if (count($sorular) <= 0)
		<div class="alert alert-danger d-flex align-items-center" role="alert">
			<i class="fas fa-info-circle me-2"></i> Henüz sıkça sorulan soru eklenmemiş
		</div>
	</div>
	@else

	<div class="accordion" id="accordionPanelsStayOpenExample">
		@php($i=1)
		@foreach ($sorular as $soru)
			<div class="card mb-4">
				<div class="card-header fw-bold">
					<span>{{$soru->sira}} - </span>{{ $soru->soru }}
				</div>
				<div class="card-body">
					{!! $soru->cevap !!}
					<div class="mt-3 pt-2" style="border-top:1px solid #eee">
						<a href="{{ route('panel.sss.duzenle', $soru->id) }}" class="btn btn-primary me-2">
							<i class="fas fa-pen"></i>
							Düzenle
						</a>
						<button class="btn btn-danger btn-sss-sil" data-id="{{$soru->id}}">
							<i class="fas fa-trash"></i>
							Sil
						</button>
					</div>
				</div>
			</div>                        
		
			@php($i++)
		@endforeach
		</div>
	@endif
</section> 
@endsection

@section("customJs")
<script>
$(function(){

	//soru  sil ----------------------------------------------------------------
    $(".btn-sss-sil").on("click", function(){                

		Swal.fire({
				type: "warning",               
				text: "Soru silinecek, devam edilsin mi?",          
				showCancelButton: true,
				confirmButtonColor: '#e44242',
				confirmButtonText: 'Sil',
				cancelButtonText: "Vazgeç",
				cancelButtonColor: '#333',              
		}).then((result) => {
			if (result.value) {

				var i  = $(".btn-sss-sil").index(this);
				var id = $(".btn-sss-sil").eq(i).data("id"); 
			
				$.ajax({
					type        : "post",
					url         : "{{ route('panel.sss.sil') }}",
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
	//---------------------------------------------------------------------------
	
});
</script>
@endsection
