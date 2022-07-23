@extends('Panel.layouts.app')

@section('title','Resim Ekle')

@section('content')

<!-- ========== section start ========== -->
<section class="section">
	<div class="container-fluid p-3">
		<!-- ========== title-wrapper start ========== -->
		<div class="title-wrapper">
			<div class="row">
			<div class="col-md-6">
				<h4>Resim Ekle</h4>
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
								Resim Ekle
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
	<form id="galeriResimEkleForm" enctype="multipart/form-data">
		<input type="hidden" name="galeri_id" value="{{ $kategori->id }}">
		<div class="alert alert-primary d-flex align-items-center mt-4">
			<i class="fas fa-info-circle me-2"></i>
			Önerilen resim boyutu 800px / 600px
		</div>

		<div class="row mx-0">
			<div class="col-sm-6 col-md-4 col-xl-3 my-3 rprv-wrap"> 
				<input type="file" name="resim[]" id="resim" class="add-image" accept="image/*">  
				<div class="p-1 bg-white position-relative mt-1 resim-prev-wrap w-100">
					<div class="resim-prev"></div>
				</div>
				<button type="button" class="btn resim-kaldir text-danger" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Kaldır"><i class="fas fa-times-circle"></i></button>
			</div>

			<div class="col-sm-6 col-md-4 col-xl-3 my-3 rprv-wrap"> 
				<input type="file" name="resim[]" class="add-image" accept="image/*">  
				<div class="p-1 bg-white position-relative mt-1 resim-prev-wrap w-100">
					<div class="resim-prev"></div>
				</div>
				<button type="button" class="btn resim-kaldir text-danger" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Kaldır"><i class="fas fa-times-circle"></i></button>
			</div>

			<div class="col-sm-6 col-md-4 col-xl-3 my-3 rprv-wrap"> 
				<input type="file" name="resim[]" class="add-image" accept="image/*">  
				<div class="p-1 bg-white position-relative mt-1 resim-prev-wrap w-100">
					<div class="resim-prev"></div>
				</div>
				<button type="button" class="btn resim-kaldir text-danger" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Kaldır"><i class="fas fa-times-circle"></i></button>
			</div> 

			<div class="col-sm-6 col-md-4 col-xl-3 my-3 rprv-wrap"> 
				<input type="file" name="resim[]" class="add-image" accept="image/*">  
				<div class="p-1 bg-white position-relative mt-1 resim-prev-wrap w-100">
					<div class="resim-prev"></div>
				</div>
				<button type="button" class="btn resim-kaldir text-danger" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Kaldır"><i class="fas fa-times-circle"></i></button>
			</div>                       

			<div class="col-12 text-right oncesine-ekle ps-lg-0 mt-3">
				<button type="button" class="alan-ekle btn btn-secondary" data-toggle="tooltip" data-bs-placement="right" title="Yeni resim ekleme alanı ekle">
					<i class="fas fa-plus"></i> 
					Resim Alanı Ekle
				</button>
			</div>
		</div>		 				
		<hr>
		<button type="submit" class="btn btn-dark py-2 px-4 my-4 font-weight-bold">
			<span class="text-dark-50">
			  <i class="far fa-save"></i>
			</span>
			<span class="text">KAYDET</span>
		</button>
	</form>
</section> 
@endsection

@section("customJs")
<script>
$(function(){

	//slider Ekle --------------------------------------------------------------
    $("#galeriResimEkleForm").submit(function(e){
        e.preventDefault();

        if( $("#resim").get(0).files.length === 0 ) {
        	Swal.fire({
                type: 'error', 
                text: 'En bir tane resim ekleyin',
                confirmButtonText: 'Tamam',
                confirmButtonColor: '#333'
            }).then(function(){
                $("html, body").animate({ scrollTop: 0 }, "50");
                 return false;
            });         
            return false;
        }else{              
           
            var form_data = new FormData(this);

            $.ajax({
                type        : "post",
                url         :"{{ route('panel.rg.resim.ekle.post') }}",
                data        : form_data,
                contentType : false,            
                processData : false,            
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
	                    }, 2000); 
	                    
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
    //--------------------------------------------------------------------------	
	
});
</script>
@endsection
