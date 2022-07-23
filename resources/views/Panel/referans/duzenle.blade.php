@extends('Panel.layouts.app')

@section('title','Referans Düzenle')

@section('content')

<!-- ========== section start ========== -->
<section class="section">
	<div class="container-fluid p-3">
		<!-- ========== title-wrapper start ========== -->
		<div class="title-wrapper">
			<div class="row">
			<div class="col-md-6">
				<h4>Referans Düzenle</h4>
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
								Referans Düzenle
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

	@if($referans == null)
		<div class="alert alert-danger my-2">
			<i class="fas fa-info-circle"></i> referans bulunamadı
		</div>
	@else
		<form id="referansGuncelleForm">		
			<input type="hidden" name="id" value="{{ $referans->id }}">
			<div class="my-3 p-2" style="height:130px; width:270px; box-shadow: 0 0 10px #777; overflow:hidden;">
				@if(is_file("uploads/resim/referans/".$referans->logo))
                    <img src="{{ asset('uploads/resim/referans/'.$referans->logo) }}" class="img-fluid">
                @else
                    <img src="{{ asset('assets/panel/images/no-image.png') }}" class="img-fluid">
                @endif
			</div>

			<div class="alert alert-primary d-flex align-items-center">
				<i class="fas fa-info-circle fa-2x me-2"></i>
				Önerilen logo boyutu 290px / 130px. 
				Yeni logo eklerseniz eskisi silinir!
			</div>
			<div class="my-2"> 
				<input type="file" name="logo" id="logo" class="add-image" accept="image/*">  
				<div class="p-1 bg-white position-relative mt-1 resim-prev-wrap">
					<div class="resim-prev" style="height:130px; text-align: left;"></div>
				</div>
			</div> 				

			<div class="form-group my-2">
				<label for="">Referans Adı : (Opsiyonel)</label>
				<input type="text" name="referans_adi" class="form-control" value="{{ $referans->referans_adi }}">
			</div>			 		

			<div class="my-3"> 
				<button type="submit" class="btn btn-dark py-2 px-4 font-weight-bold">
					<span class="text-dark-50">
					  <i class="far fa-save"></i>
					</span>
					<span class="text">GÜNCELLE</span>
				</button>			
			</div>
		</form>
	@endif
</section> 
@endsection

@section("customJs")
<script>
$(function(){

	//referans güncelle --------------------------------------------------------------
    $("#referansGuncelleForm").submit(function(e){
        e.preventDefault();                
            
        var form_data = new FormData(this);

        $.ajax({
            type        : "post",
            url         :"{{ route('panel.referans.duzenle.post') }}",
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
                
    });  
    //--------------------------------------------------------------------------	
	
});
</script>
@endsection
