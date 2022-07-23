@extends('Panel.layouts.app')

@section('title','Resim Galeri Kategori Ekle')

@section('content')

<!-- ========== section start ========== -->
<section class="section">
	<div class="container-fluid p-3">
		<!-- ========== title-wrapper start ========== -->
		<div class="title-wrapper">
			<div class="row">
			<div class="col-md-6">
				<h4>Resim Galeri Kategori Ekle</h4>
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
								Resim Galeri Kategori Ekle
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
	<form id="galeriKategoriEkleForm" enctype="multipart/form-data">	
		<div class="form-group my-2">
			<label for="">Dil:</label>
			<select name="dil_id" class="form-control">				
				@foreach ($diller as $dil)
					<option value="{{ $dil->id }}" @if($dil->varsayilan == 1) selected @endif>
						{{ $dil->dil_adi }}
					</option>
				@endforeach
			</select>
		</div>	

		<div class="form-group my-2">
			<label for="">Resim Galeri Kategori Adı :</label>
			<input type="text" name="galeri_adi" class="form-control">
		</div>	

		<div class="alert alert-primary d-flex align-items-center mt-4">
			<i class="fas fa-info-circle me-2"></i>
			Önerilen resim boyutu 800px / 600px
		</div>

		<div class="my-2"> 
			<input type="file" name="resim" id="resim" class="add-image" accept="image/*">  
			<div class="p-1 bg-white position-relative mt-1 resim-prev-wrap" style="width:300px">
				<div class="resim-prev" style="height:200px; text-align: left;"></div>
			</div>
		</div> 				

		 <button type="submit" class="btn btn-dark py-2 px-4 my-3 font-weight-bold">
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
    $("#galeriKategoriEkleForm").submit(function(e){
        e.preventDefault();

        var galeri_adi = $.trim( $("[name=galeri_adi]").val() );
        
        if(galeri_adi.length <= 0){
            Swal.fire({
                type: 'error', 
                text: 'Kategorinin adını yazın',
                confirmButtonText: 'Tamam',
                confirmButtonColor: '#333'
            }).then(function(){
                $("[name=galeri_adi]").addClass("border-red");
                //$("html, body").animate({ scrollTop: 0 }, "50");
                return false;
            });         
            return false;
        }else if( $("#resim").get(0).files.length === 0 ) {
        	Swal.fire({
                type: 'error', 
                text: 'Kategorinin resmini ekleyin',
                confirmButtonText: 'Tamam',
                confirmButtonColor: '#333'
            }).then(function(){
                $("html, body").animate({ scrollTop: 0 }, "50");
                 return false;
            });         
            return false;
        }else{              
            tinyMCE.triggerSave();
            var form_data = new FormData(this);

            $.ajax({
                type        : "post",
                url         :"{{ route('panel.rg.kategori.ekle.post') }}",
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
