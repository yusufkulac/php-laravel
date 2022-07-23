@extends('Panel.layouts.app')

@section('title','Video Ekle')

@section('content')

<!-- ========== section start ========== -->
<section class="section">
	<div class="container-fluid p-3">
		<!-- ========== title-wrapper start ========== -->
		<div class="title-wrapper">
			<div class="row">
			<div class="col-md-6">
				<h4>Video Ekle</h4>
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
								Video Ekle
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
	<form id="videoEkleForm" enctype="multipart/form-data">
		<div class="form-grup my-3">
			<label for="">Video Başlık: <small>(Opsiyonel)</small></label>
			<input type="text" name="baslik" class="form-control">
		</div>
		<div class="form-grup my-3">
			<label for="">Video :</label>
			<input type="file" name="video" id="video" class="form-control" accept="video/*">
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

	//video Ekle --------------------------------------------------------------
    $("#videoEkleForm").submit(function(e){
        e.preventDefault();

        if( $("#video").get(0).files.length === 0 ) {
        	Swal.fire({
                type: 'error', 
                text: 'Video ekleyin',
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
                url         :"{{ route('panel.video.ekle.post') }}",
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
