@extends('Panel.layouts.app')

@section('title','Çözüm Ortakları')

@section('content')
<!-- ========== section start ========== -->
<section class="section">
	<div class="container-fluid p-3">
		<!-- ========== title-wrapper start ========== -->
		<div class="title-wrapper">
			<div class="row">
			<div class="col-md-6">
				<h4>Çözüm Ortakları</h4>
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
								Çözüm Ortakları
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
	<a href="{{ route('panel.cozum.ortaklari.ekle') }}" class="btn btn-secondary my-3">
		<i class="fas fa-plus"></i> Çözüm Ortağı Ekle
	</a>
	@if(count($cozumOrtaklari) == 0)
		<div class="alert alert-danger my-3">
			<i class="fas fa-info-circle"></i> Henüz çözüm ortağı eklenmemiş
		</div>
	@else
    <div class="row mx-0">
        @foreach($cozumOrtaklari as $value)
            <div class="col-sm-6 col-md-4 col-lg-3 my-3">
            	<div class="bg-white p-1" style="box-shadow: 0 0 10px #666;">            	
	                <div class="referans-content">
	                	<div class="" style="height: 100%; max-height:100%; overflow: hidden;">
		                    @if(is_file("uploads/resim/cozum_ortaklari/".$value->logo))
		                        <img src="{{ asset('uploads/resim/cozum_ortaklari/'.$value->logo) }}" class="img-fluid">
		                    @else
		                        <img src="{{ asset('assets/panel/images/no-image.png') }}">
		                    @endif
	                	</div>                	
	                </div>
	                <div class="d-flex p-2 bg-white border">
	            		<button class="btn btn-danger me-2 cozum-ortaklari-sil" data-id="{{ $value->id }}">
	            			<i class="far fa-trash-alt"></i> Sil
	            		</button>
	            		<a href="{{ route('panel.cozum.ortaklari.duzenle', ['id'=>$value->id]) }}" class="btn btn-primary">
	            			<i class="far fa-edit"></i> Düzenle
	            		</a>
	            	</div>
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

	//referans  sil ----------------------------------------------------------------
    $(".cozum-ortaklari-sil").on("click", function(){                

		Swal.fire({
				type: "warning",               
				text: "Çözüm ortağı silinecek, devam edilsin mi?",          
				showCancelButton: true,
				confirmButtonColor: '#e44242',
				confirmButtonText: 'Sil',
				cancelButtonText: "Vazgeç",
				cancelButtonColor: '#333',              
		}).then((result) => {
			if (result.value) {

				var i  = $(".cozum-ortaklari-sil").index(this);
				var id = $(".cozum-ortaklari-sil").eq(i).data("id"); 

				$.ajax({
					type        : "post",
					url         : "{{ route('panel.cozum.ortaklari.sil') }}",
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
								window.location.href = "{{ route('panel.cozum.ortaklari.liste') }}";
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
