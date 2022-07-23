@extends('Panel.layouts.app')

@section('title','Hizmet Kategori Ekle')

@section('content')

<!-- ========== section start ========== -->
<section class="section">
	<div class="container-fluid p-3">
		<!-- ========== title-wrapper start ========== -->
		<div class="title-wrapper">
			<div class="row">
			<div class="col-md-6">
				<h4>Hizmet Kategori Ekle</h4>
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
								Hizmet Kategori Ekle
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

	<form id="hizmetKategoriEkleForm" enctype="multipart/form-data">		

		<div class="form-group my-2">
			<label for="">Kategori Adı :</label>
			<input type="text" name="kategori_adi" class="form-control">
		</div>

		<div class="form-group my-2">
			<label for="">Sıralama No :</label>
			<input type="text" name="sira" class="form-control" style="width: 100px;">
		</div>
		
		<div class="form-group my-2">
			<input type="checkbox" name="menu_goster" id="menu">
			<label for="menu">Menüde Göster</label>                
		</div>

		<div class="form-group my-2">
			<input type="checkbox" name="anasayfa_goster" id="anasayfa">
			<label for="anasayfa">Anasayfada Göster</label>                
		</div>

		<div class="alert alert-primary d-flex align-items-center mt-4 mb-0">
			<i class="fas fa-info-circle me-2"></i>
			Kelime aralarına virgül koyunuz. (Örnek: etiket1, etiket2)			
		</div>
		
		<div class="form-group mt-0">
			<label>Etiketler:</label>
			<textarea name="etiket" class="form-control" rows="2"></textarea>
		</div>

		<hr>

		<div class="resim-ekle-wrap my-3 font-weight-bold" style="font-size: 16px">
			<i class="fas fa-images"></i>&nbsp;Resim Ekle (Opsiyonel)
		</div> 

		<div class="resim-content">
			<div class="alert alert-primary d-flex align-items-center">
				<i class="fas fa-info-circle me-2"></i> Önerilen resim boyutu 800px / 600px				
			</div>

			<div class="my-2"> 
				<input type="file" name="resim" id="resim" class="add-image" accept="image/*">  
				<div class="p-1 bg-white position-relative mt-1 resim-prev-wrap">
					<div class="resim-prev" style="height:250px; text-align: left;"></div>
				</div>
			</div>			
		</div>  		

		<div class="row mx-0 mt-1 pb-4">                 
			<div class="col-lg-8 ps-lg-0 mt-3">
				<button type="submit" class="btn btn-dark py-2 px-4 font-weight-bold">
					<span class="text-dark-50">
					  <i class="fa fa-save"></i>
					</span>
					<span class="text">KAYDET</span>
				</button>
			</div>
		</div>
	</form>
</section> 
@endsection

@section("customJs")
<script>
$(function(){

	//hizmet kategori ekle --------------------------------------------------------------
    $("#hizmetKategoriEkleForm").submit(function(e){
        e.preventDefault();

        var kategori_adi = $.trim( $("[name=kategori_adi]").val() );

        if(kategori_adi <= 0){
            Swal.fire({
                type: 'error', 
                text: 'Lütfen kategori adını yazınız',
                confirmButtonText: 'Tamam',
                confirmButtonColor: '#333'
            }).then(function(){
                $("[name=kategori_adi]").addClass("border-red");
                $("html, body").animate({ scrollTop: 0 }, "50");
                return false;
            });         
            return false;
        }else{              
           
            var form_data = new FormData(this);

            $.ajax({
                type        : "post",
                url         : "{{ route('panel.hizmet.kategori.ekle.post') }}",
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
    //--------------------------------------------------------------------------
	
		
	
});
</script>
@endsection
