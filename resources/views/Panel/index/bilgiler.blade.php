@extends('Panel.layouts.app')

@section('title','Site Bilgileri')

@section('content')


<!-- ========== section start ========== -->
<section class="section">
	<div class="container-fluid p-3">
		<!-- ========== title-wrapper start ========== -->
		<div class="title-wrapper">
			<div class="row">
			<div class="col-md-6">
				<h4>Site Bilgileri</h4>
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
								Site Bilgileri
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
    
    <form id="siteBilgiForm">     

    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
        <li class="nav-item" role="presentation">
          <button class="nav-link tab-header active" id="bilgiler" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Genel</button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link tab-header" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">İletişim</button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link tab-header" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Sosyal Medya</button>
        </li>
      </ul>

      <div class="tab-content p-2 border" id="pills-tabContent">
        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="bilgiler">
            <div class="form-group my-2">
                <label for="title">Site Başlığı :</label>
                <input type="text" name="title" class="form-control" value="{{ $bilgiler->title }}">
            </div>

            <div class="form-group my-2">
                <label for="title">Description (Açıklama) :</label>
                <textarea name="description" class="form-control" rows="4">{{ $bilgiler->description }}</textarea>
            </div>

            <div class="form-group my-2">
                <label for="title">Keyword : </label>
                <textarea name="keyword" class="form-control" rows="6">{{ $bilgiler->keyword }}</textarea>
            </div>

            <div class="form-group my-2">
                <label for="title">Kurum / Firma Adı :</label>
                <input type="text" name="kurum_adi" class="form-control" value="{{ $bilgiler->kurum_adi }}">
            </div>
        </div>

        <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
            <div class="form-group my-2">
                <label for="title">Telefon :</label>
                <input type="text" name="telefon" class="form-control" value="{{ $bilgiler->telefon }}">
            </div>

            <div class="form-group my-2">
                <label for="title">Faks :</label>
                <input type="faks" name="faks" class="form-control" value="{{ $bilgiler->faks }}">
            </div>
            
            <div class="form-group my-2">
                <label for="title">Gsm No :</label>
                <input type="text" name="gsm1" class="form-control" value="{{ $bilgiler->gsm1 }}">
            </div>

            <div class="form-group my-2">
                <label for="title">Whatsapp Hattı :</label>
                <input type="text" name="whatsapp_tel" class="form-control" value="{{ $bilgiler->whatsapp_tel }}">
            </div>
           
            <div class="form-group my-2">
                <label for="title">Adres :</label>
                <textarea name="adres" class="form-control" rows="2">{{ $bilgiler->adres }}</textarea>
            </div>
           
           <div class="form-group my-2">                 
                <label for="title">E-Posta Adresi :</label>
                <input type="text" name="mail" class="form-control" value="{{ $bilgiler->mail }}">
            </div>
           <div class="form-group my-2">                 
                <label for="title">Web Adresi :</label>
                <input type="text" name="web" class="form-control" value="{{ $bilgiler->web }}">
            </div>
        </div>

        <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
           <div class="form-group my-2">                 
                <label for="title">Facebook :</label>
                <input type="text" name="facebook" class="form-control" value="{{ $bilgiler->facebook }}">
            </div>
           <div class="form-group my-2">                 
                <label for="title">Twitter :</label>
                <input type="text" name="twitter" class="form-control" value="{{ $bilgiler->twitter }}">
            </div>
           <div class="form-group my-2">                 
                <label for="title">Instagram :</label>
                <input type="text" name="instagram" class="form-control" value="{{ $bilgiler->instagram }}">
            </div>
            <div class="form-group my-2">                 
                <label for="title">Youtube :</label>
                <input type="text" name="youtube" class="form-control" value="{{ $bilgiler->youtube }}">
            </div>
           <div class="form-group my-2">                 
                <label for="title">Linkedin</label>
                <input type="text" name="linkedin" class="form-control" value="{{ $bilgiler->linkedin }}">
            </div>
           <div class="form-group my-2">                 
                <label for="title">Google :</label>
                <input type="text" name="google" class="form-control" value="{{ $bilgiler->google }}">
            </div>
            <div class="form-group my-2">                 
                <label for="title">Pinterest :</label>
                <input type="text" name="pinterest" class="form-control" value="{{ $bilgiler->pinterest }}">
            </div>
        </div>
      </div>        
    
        <div class="row mx-0 mt-1 pb-4">                 
            <div class="col-lg-8 ps-lg-0 mt-3">
                <button type="submit" class="btn btn-dark py-2" id="btnBilgiKaydet">
                    <span class="text-dark-50">
                        <i class="far fa-save"></i>
                    </span>
                    <span class="text">GÜNCELLE</span>
                </button>
            </div>
        </div>
    
    </form>
</section>

@endsection

@section("customJs")
<script>
$(function(){

    //bilgileri güncelle --------------------------------------------------------------
    $("#siteBilgiForm").submit(function(e){
       e.preventDefault();

        var form_data = new FormData(this);

        $.ajax({
            type        : "post",
            url         : "{{ route('panel.site.bilgileri.post') }}",
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
               
    });  
    //--------------------------------------------------------------------------


		
})
</script>
@endsection
