@extends('Panel.layouts.app')

@section('title','Ayarlar')

@section('content')
<!-- ========== section start ========== -->
<section class="section">
	<div class="container-fluid p-3">
		<!-- ========== title-wrapper start ========== -->
		<div class="title-wrapper">
			<div class="row">
			<div class="col-md-6">
				<h4>Ayarlar</h4>
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
								Ayarlar
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
    <form id="ayarlarForm" enctype="multipart/form-data"> 
       
        <span><b>Logolar</b></span>
        <hr class="mt-0 pt-0">

        <div class="row">
            <div class="col-sm-6 col-md-4 col-lg-3">
                <label class="mb-0">Header(Başlık) Logosu :</label>
                <input type="file" name="header_logo" class="form-control">
                <div class="logo-wrapper header-logo-prew p-2 border border-muted bg-white my-2">

                    @if(is_file("assets/site/img/".$ayarlar->header_logo))
                        <img src="{{ asset('assets/site/img/'.$ayarlar->header_logo)}}" class="img-fluid">
                    @endif

                </div>
            </div>
            <div class="col-sm-6 col-md-4 col-lg-3">
                <label class="mb-0">Sayfa Logosu :</label>
                <input type="file" name="sayfa_logo" class="form-control">
                <div class="logo-wrapper sayfa-logo-prew p-2 border border-muted bg-white my-2">
                    @if(is_file("assets/site/img/".$ayarlar->sayfa_logo))
                        <img src="{{ asset('assets/site/img/'.$ayarlar->sayfa_logo)}}" class="img-fluid">
                    @endif
                </div>
            </div>
            <div class="col-sm-6 col-md-4 col-lg-3">
                <label class="mb-0">Footer (Alt) Logosu :</label>
                <input type="file" name="footer_logo" class="form-control">
                <div class="logo-wrapper footer-logo-prew p-2 border border-muted bg-white my-2">
                    @if(is_file("assets/site/img/".$ayarlar->footer_logo))
                        <img src="{{ asset('assets/site/img/'.$ayarlar->footer_logo)}}" class="img-fluid">
                    @endif
                </div>
            </div>

            <div class="col-sm-6 col-md-4 col-lg-3">
                <label class="mb-0">Favicon :</label>
                <input type="file" name="favicon" class="form-control">
                <div class="logo-wrapper favicon-prew p-2 border border-muted bg-white my-2">
                    @if(is_file("assets/site/img/".$ayarlar->favicon))
                        <img src="{{ asset('assets/site/img/'.$ayarlar->favicon)}}" class="img-fluid">
                    @endif
                </div>
            </div>
        </div> 

        <div class="row mt-5 mb-3">
            <div class="col-lg-3">
                <label>Panelde Gösterilecek Kayıt Sayısı</label>
                <input type="text" name="panel_limit" class="form-control" value="{{$ayarlar->panel_limit}}">
            </div>
        </div>

        <div class="row mt-3 mb-3">
            <div class="col-12">
                <label>Google Harita Kodu</label>
                <textarea name="maps" rows="5" class="form-control">{{$ayarlar->maps}}</textarea>
            </div>
        </div>

        <div class="row mt-3 mb-3">
            <div class="col-lg-6 my-3">
                <label>Google Analytics Kodu</label>
                <textarea name="google_analistik" rows="6" class="form-control">{{$ayarlar->google_analistik}}</textarea>
            </div>
             <div class="col-lg-6 my-3">
                <label>Google Doğrulama Kodu</label>
                <textarea name="google_dogrulama" rows="6" class="form-control">{{$ayarlar->google_dogrulama}}</textarea>
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
    $("#ayarlarForm").submit(function(e){
       e.preventDefault();

        var form_data = new FormData(this);

        $.ajax({
            type        : "post",
            url         : "{{ route('panel.site.ayarlar.post') }}",
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
               
    });  
    //--------------------------------------------------------------------------


    //header logo önizleme -----------------------------------------------
    var preview = $(".header-logo-prew");    
    $("[name=header_logo]").change(function(event){
        var input = $(event.currentTarget);
        var file = input[0].files[0];
        var reader = new FileReader();

        reader.onload = function(e){
            image_base64 = e.target.result;
            preview.empty().append("<img src='"+image_base64+"' class='img-fluid'>");
        };
        reader.readAsDataURL(file);
    });
    //---------------------------------------------------------------

    //sayfa logo önizleme -----------------------------------------------
    var preview2 = $(".sayfa-logo-prew");    
    $("[name=sayfa_logo]").change(function(event){
        var input = $(event.currentTarget);
        var file = input[0].files[0];
        var reader = new FileReader();

        reader.onload = function(e){
            image_base64 = e.target.result;
            preview2.empty().append("<img src='"+image_base64+"' class='img-fluid'>");
        };
        reader.readAsDataURL(file);
    });
    //---------------------------------------------------------------

    //footer logo önizleme -----------------------------------------------
    var preview3 = $(".footer-logo-prew");    
    $("[name=footer_logo]").change(function(event){
        var input = $(event.currentTarget);
        var file = input[0].files[0];
        var reader = new FileReader();

        reader.onload = function(e){
            image_base64 = e.target.result;
            preview3.empty().append("<img src='"+image_base64+"' class='img-fluid'>");
        };
        reader.readAsDataURL(file);
    });
    //---------------------------------------------------------------

    //favicon önizleme -----------------------------------------------
    var preview4 = $(".favicon-prew");    
    $("[name=favicon]").change(function(event){
        var input = $(event.currentTarget);
        var file = input[0].files[0];
        var reader = new FileReader();

        reader.onload = function(e){
            image_base64 = e.target.result;
            preview4.empty().append("<img src='"+image_base64+"' class='img-fluid'>");
        };
        reader.readAsDataURL(file);
    });
    //---------------------------------------------------------------
		
})
</script>
@endsection
