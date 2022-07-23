@extends('Panel.layouts.app')

@section('title','Blog Ekle')

@section('content')

<!-- ========== section start ========== -->
<section class="section">
	<div class="container-fluid p-3">
		<!-- ========== title-wrapper start ========== -->
		<div class="title-wrapper">
			<div class="row">
			<div class="col-md-6">
				<h4>Blog Ekle</h4>
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
								Blog Ekle
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
	<form id="blogEkleForm">

		<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
			<li class="nav-item" role="presentation">
				<button class="nav-link active" id="pills-bilgi-tab" data-bs-toggle="pill" data-bs-target="#pills-bilgi" type="button" role="tab" aria-controls="pills-bilgi" aria-selected="true">
					Bilgiler
				</button>
			</li>
			<li class="nav-item" role="presentation">
				<button class="nav-link" id="pills-resim-tab" data-bs-toggle="pill" data-bs-target="#pills-resim" type="button" role="tab" aria-controls="pills-resim" aria-selected="false">
					Resim
				</button>
			</li>
			<li class="nav-item" role="presentation">
				<button class="nav-link" id="pills-video-tab" data-bs-toggle="pill" data-bs-target="#pills-video" type="button" role="tab" aria-controls="pills-video" aria-selected="false">
					Video
				</button>
			</li>
			<li class="nav-item" role="presentation">
				<button class="nav-link" id="pills-seo-tab" data-bs-toggle="pill" data-bs-target="#pills-seo" type="button" role="tab" aria-controls="pills-seo" aria-selected="false">
					Seo
				</button>
			</li>
		</ul>

		<div class="tab-content" id="pills-tabContent">
			<!-- bilgiler content -------------------------------------------------------------------------------->
			<div class="tab-pane fade show active" id="pills-bilgi" role="tabpanel" aria-labelledby="pills-bilgi-tab">
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
					<label for="">Başlık :</label>
					<input type="text" name="baslik" class="form-control">
				</div>				
				
				<div class="form-group my-2">
					<label>Özet:</label>
					<textarea name="ozet" class="editor-small"></textarea>
				</div>

				<div class="form-group my-2">
					<label>Blog Yazısı:</label>
					<textarea name="icerik" class="editor"></textarea>
				</div>
				
				<div class="form-group my-2">
					<label>Aktif / Pasif:</label>
					<select name="aktif" class="form-control">
						<option value="0">Pasif</option>
						<option value="1" selected>Aktif</option>
					</select>
				</div>

				<div class="form-group my-4">
					<input type="checkbox" name="anasayfa_goster" id="anasayfa">
					<label for="anasayfa">Anasayfada Göster</label>                
				</div>

				<div class="alert alert-primary d-flex align-items-center mb-0">
					<i class="far fa-info-circle fw-bold me-2"></i>
					Kelime aralarına virgül koyunuz. (Örnek: etiket1, etiket2)
				</div>
				
				<div class="form-group my-2">
					<label>Etiketler:</label>
					<textarea name="etiket" class="form-control" rows="2"></textarea>
				</div>
			</div><!-- ./end bilgiler content ------------------------------------------------------------>


			<!-- resim content ---------------------------------------------------------------------------->
			<div class="tab-pane fade" id="pills-resim" role="tabpanel" aria-labelledby="pills-resim-tab">
				
				<div class="resim-ekle-wrap my-3 font-weight-bold" style="font-size: 16px">
					<i class="fas fa-images me-2"></i>Ana Resim Ekle
				</div> 

				<div class="resim-content">
					<div class="alert alert-primary d-flex align-items-center" role="alert">
						<i class="fas fa-info-circle me-2"></i>
						Önerilen resim boyutu 800px / 600px				
					</div>			

					<div class="my-2 rprv-wrap" style="width:460px; height:40vh"> 
						<input type="file" name="ana_resim" class="add-image form-control mb-2" accept="image/*">  
						<div class="p-1 bg-white position-relative mt-1 resim-prev-wrap w-100" style="height:34vh">
							<div class="resim-prev"></div>
						</div>						
					</div>				
				</div>
				<hr>

				<div class="resim-ekle-wrap my-3 font-weight-bold" style="font-size: 16px">
					<i class="fas fa-images me-2"></i>Blogun Diğer Resimleri
				</div> 
				<div class="resim-content">

					<div class="alert alert-primary d-flex align-items-center" role="alert">
						<div class="me-2">
							<i class="fas fa-info-circle"></i>
						</div>
						<div>
							Resim ekleyeceğiniz alana tıklayın. Önerilen resim boyutu 800px / 600px
						</div>
					</div>

					<div class="my-3">
						<div class="row mx-0">

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
					</div>
				</div> 
			</div><!-- ./end resim content ------------------------------------------------------------------>


			<!-- video content -------------------------------------------------------------------------------->
			<div class="tab-pane fade" id="pills-video" role="tabpanel" aria-labelledby="pills-video-tab">
				<div class="alert alert-primary d-flex align-items-center mt-5" role="alert">
					<div class="me-2">
						<i class="fas fa-info-circle"></i>
					</div>
					<div>
						Blog ile ilgili youtube'daki videonuzun linkini veya sitenize video dosyası ekleyebilirsiniz
					</div>
				</div>

				<ul class="nav nav-pills my-3" id="pills-tab" role="tablist">
					<li class="nav-item" role="presentation">
					  <button class="nav-link tab-header active" id="bilgiler" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Youtube Video Linki</button>
					</li>
					<li class="nav-item" role="presentation">
					  <button class="nav-link tab-header" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Video</button>
					</li>			
				</ul>	

				<div class="tab-content" id="pills-tabContent">
					<div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="bilgiler">
				        <textarea name="video_link" class="form-control" rows="3"></textarea>
					</div>
			
					<div class="tab-pane fade pb-5" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
				       <input type="file" name="video" class="form-control" accept="video/*">
					</div>			
				</div> 	
			</div><!-- ./end video content ------------------------------------------------------------>


			<!-- seo content ------------------------------------------------------------------------>
			<div class="tab-pane fade" id="pills-seo" role="tabpanel" aria-labelledby="pills-seo-tab">
				<div class="form-group my-2">
					<label for="">Description : <small>(Opsiyonel)</small></label>
					<textarea name="description" class="form-control" rows="2"></textarea>
				</div>

				<div class="form-group my-2">
					<label for="">Keywords : <small>(Opsiyonel)</small></label>
					<textarea name="keywords" class="form-control" rows="2"></textarea>
				</div>
			</div><!-- ./end seo content ------------------------------------------------------------>

		</div><!-- ./endtab content ***********************************************************  -->       		

		<div class="row mx-0 mt-1 pb-4">                 
			<div class="col-lg-8  pl-lg-0 mt-3">
				<button type="submit" class="btn btn-dark py-2 px-4 font-weight-bold">
					<span class="text-dark-50">
					  <i class="far fa-save"></i>
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

	//blog Ekle --------------------------------------------------------------
    $("#blogEkleForm").submit(function(e){
        e.preventDefault();

        var baslik = $.trim( $("[name=baslik]").val() );

        if(baslik <= 0){
            Swal.fire({
                type: 'error', 
                text: 'Lütfen blog başlığını yazınız',
                confirmButtonText: 'Tamam',
                confirmButtonColor: '#333'
            }).then(function(){
                $("[name=baslik]").addClass("border-red");
                $("html, body").animate({ scrollTop: 0 }, "50");
                 return false;
            });         
            return false;
        }else{              
            tinyMCE.triggerSave();
            var form_data = new FormData(this);

            $.ajax({
                type        : "post",
                url         :"{{ route('blog.ekle.post') }}",
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
