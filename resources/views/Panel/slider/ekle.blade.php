@extends('Panel.layouts.app')

@section('title','Slider Ekle')

@section('content')

<!-- ========== section start ========== -->
<section class="section">
	<div class="container-fluid p-3">
		<!-- ========== title-wrapper start ========== -->
		<div class="title-wrapper">
			<div class="row">
			<div class="col-md-6">
				<h4>Slider Ekle</h4>
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
								Slider Ekle
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
	<form id="sliderEkleForm">		

		<div class="alert alert-primary d-flex align-items-center">
			<i class="far fa-info-circle me-2"></i>
			Önerilen resim boyutu 1920px / 850px
		</div>

		<div class="my-2"> 
			<input type="file" name="resim" id="resim" class="add-image" accept="image/*">  
			<div class="p-1 bg-white position-relative mt-1 resim-prev-wrap">
				<div class="resim-prev" style="height:40vh; text-align: left;"></div>
			</div>
		</div> 

		<div class="form-group my-2">
			<label for="">Sıralama No * :</label>
			<input type="text" name="sira" class="form-control" style="width: 100px;">
		</div>		

		<div class="form-group my-2">
			<label for="">Slogan : (Opsiyonel)</label>
			<input type="text" name="slogan" class="form-control">
		</div>

		<div class="form-group my-2">
			<label for="">Slogan Altı Yazı: (Opsiyonel)</label>
			<input type="text" name="yazi" class="form-control">
		</div>

		<div class="form-group my-2">
			<label for="">Link : (Opsiyonel)</label>
			<input type="text" name="link" class="form-control">
		</div>	 		

		<div class="mt-1 pb-4"> 
			<button type="submit" class="btn btn-dark py-2 px-4 font-weight-bold">
				<span class="text-dark-50">
				  <i class="far fa-save"></i>
				</span>
				<span class="text">KAYDET</span>
			</button>			
		</div>
	</form>
</section> 
@endsection

@section("customJs")
<script>
$(function(){

	//slider Ekle --------------------------------------------------------------
    $("#sliderEkleForm").submit(function(e){
        e.preventDefault();

        var sira = $.trim( $("[name=sira]").val() );
        
        if( $("#resim").get(0).files.length === 0 ) {
        	Swal.fire({
                type: 'error', 
                text: 'Slider resmi ekleyiniz',
                confirmButtonText: 'Tamam',
                confirmButtonColor: '#333'
            }).then(function(){
                $("html, body").animate({ scrollTop: 0 }, "50");
                 return false;
            });         
            return false;
        }else if(sira <= 0){
            Swal.fire({
                type: 'error', 
                text: 'Sıralama numarasını yazın',
                confirmButtonText: 'Tamam',
                confirmButtonColor: '#333'
            }).then(function(){
                $("[name=sira]").addClass("border-red");
                //$("html, body").animate({ scrollTop: 0 }, "50");
                return false;
            });         
            return false;
        }else{              
            tinyMCE.triggerSave();
            var form_data = new FormData(this);

            $.ajax({
                type        : "post",
                url         :"{{ route('panel.slider.ekle.post') }}",
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
	                       window.location.href = "{{ route('panel.slider.liste') }}";
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
