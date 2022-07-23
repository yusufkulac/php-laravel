@extends('Panel.layouts.app')

@section('title','Galeri Resim Listesi')

@section('content')

<!-- ========== section start ========== -->
<section class="section">
	<div class="container-fluid p-3">
		<!-- ========== title-wrapper start ========== -->
		<div class="title-wrapper">
			<div class="row">
			<div class="col-md-6">
				<h4>Galeri Resim Listesi</h4>
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
								Galeri Resim Listesi
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
	<div class="my-3 fw-bold">
		Kategori : {{ $kategori->galeri_adi }}
	</div>

	@if(count($resimler) == 0)
		<div class="alert alert-danger my-4">
			<i class="fas fa-info-circle"></i>
			Bu kategoriye henüz resim eklenmemiş
		</div>
	@else
		<div class="row justify-content-center">
			@foreach($resimler as $value)
				<div class="col-6 col-md-4 col-lg-3 my-3 text-center">
					@if(is_file('uploads/resim/galeri/'.$value->resim))
					<div class="galeri-wrapper">
						<div class="galeri-content">						
							<a href="{{ asset('uploads/resim/galeri/'.$value->resim) }}" class="image-link" data-id="{{ $value->id }}">
								<img src="{{ asset('uploads/resim/galeri/'.$value->resim) }}">						
							</a>
						</div>	
					</div>
					@endif

					<button class="btn btn-danger btn-resim-sil mt-1" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Sil" data-id="{{ $value->id }}">
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

	//resm sil ----------------------------------------------------------
    $(".btn-resim-sil").on("click", function(){                

		Swal.fire({
				type: "warning",               
				text: "Resim silinecek, devam edilsin mi?",          
				showCancelButton: true,
				confirmButtonColor: '#e44242',
				confirmButtonText: 'Sil',
				cancelButtonText: "Vazgeç",
				cancelButtonColor: '#333',              
		}).then((result) => {
			if (result.value) {
				
				var i  = $(".btn-resim-sil").index(this);
				var id = $(".btn-resim-sil").eq(i).data("id"); 

				$.ajax({
					type        : "post",
					url         : "{{ route('panel.rg.resim.sil') }}",
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
