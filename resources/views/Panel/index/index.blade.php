@extends('Panel.layouts.app')

@section('title','Yönetim Paneli')

@section('content')

<!-- ========== section start ========== -->
<section class="section">
	<div class="container-fluid p-3">
		<!-- ========== title-wrapper start ========== -->
		<div class="title-wrapper">
			<div class="row">
			<div class="col-md-6">
				<h4>Anasayfa</h4>
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

<section class="sayfa-icerik-kapsayici">

	<div class="px-4 mb-4" style="font-weight:600">
		
		<input type="checkbox" name="bakim_modu" id="bakimMod" @if($ayar->bakim_modu == 1) checked @endif>
		@if($ayar->bakim_modu == 1)
			<label for="bakimMod">Siteyi bakım modundan çıkar</label>
		@else
			<label for="bakimMod">Siteyi bakım moduna al</label>
		@endif
		<button type="button" class="btn btn-primary ms-2 btn-bakim-modu">Uygula</button>
		
		<hr>
	</div>

	<div class="row px-4 justify-content-center justify-content-lg-start">
		<a href="{{ route('panel.mesajlar') }}" class="col-6 col-md-4 col-lg-3 col-xl-2 my-2">
			<div class="d-flex bildirim-wrapper">
				<div class="bildirim-icon-wrap">
					<i class="far fa-envelope"></i>
				</div>
				<div class="w-100">
					<div class="bildirim-header">Yeni Mesaj</div>
					<div class="text-center bild-text">{{$yeniMesaj }}</div>
				</div>
			</div>
		</a>

		<a href="{{ route('panel.teklif.formu') }}" class="col-6 col-md-4 col-lg-3 col-xl-2 my-2">
			<div class="d-flex bildirim-wrapper">
				<div class="bildirim-icon-wrap">
					<i class="far fa-handshake"></i>
				</div>
				<div class="w-100">
					<div class="bildirim-header">Yeni Teklif Formu</div>
					<div class="text-center bild-text">{{$yeniTeklifFormu }}</div>
				</div>
			</div>
		</a>


		<a href="{{ route('panel.basvuru.list') }}" class="col-6 col-md-4 col-lg-3 col-xl-2 my-2">
			<div class="d-flex bildirim-wrapper">
				<div class="bildirim-icon-wrap">
					 <i class="far fa-file-alt"></i>
				</div>
				<div class="w-100">
					<div class="bildirim-header">Yeni İş Başvuru</div>
					<div class="text-center bild-text">{{$yeniIsBasvuru }}</div>
				</div>
			</div>
		</a>		
	</div>

	<div class="row px-3 justify-content-center justify-content-lg-start mt-4">
		<h5 class="col-12 my-3" style="color:#666">
			<i class="fas fa-chalkboard-teacher me-2"></i>
			Ziyaretçi Bilgileri
		</h5>
		<hr class="my-0">

		<div class="col-6 col-md-4 col-lg-3 col-xl-2 my-2">
			<div class="d-flex bildirim-wrapper">
				<div class="bildirim-icon-wrap">
					<i class="far fa-calendar-alt"></i>
				</div>
				<div class="w-100">
					<div class="bildirim-header">Bugün</div>
					<div class="text-center bild-text">{{$ziyaret['bugun'] }}</div>
				</div>
			</div>
		</div>
		<div class="col-6 col-md-4 col-lg-3 col-xl-2 my-2">
			<div class="d-flex bildirim-wrapper">
				<div class="bildirim-icon-wrap">
					<i class="far fa-calendar-alt"></i>
				</div>
				<div class="w-100">
					<div class="bildirim-header">Bu Ay</div>
					<div class="text-center bild-text">{{$ziyaret['buay'] }}</div>
				</div>
			</div>
		</div>
		<div class="col-6 col-md-4 col-lg-3 col-xl-2 my-2">
			<div class="d-flex bildirim-wrapper">
				<div class="bildirim-icon-wrap">
					<i class="far fa-calendar-alt"></i>
				</div>
				<div class="w-100">
					<div class="bildirim-header">BuYıl</div>
					<div class="text-center bild-text">{{$ziyaret['buyil'] }}</div>
				</div>
			</div>
		</div>

	</div>

</section>
 
@endsection

@section("customJs")
<script>
$(function(){ 

    //bakım modu güncelle --------------------------------------------------------------
    $(".btn-bakim-modu").on("click", function(){
    	if( $("[name=bakim_modu]").is(':checked') ){
    		var bakim_checkbox = 1;
    	}else{
    		var bakim_checkbox = 0;
    	}

    	$.ajax({
            type        : "post",
            url         : "{{ route('panel.bakim.modu.post') }}",
            data        : {bakim_checkbox:bakim_checkbox},
            //contentType : false,            
            //processData : false,            
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
	
})
</script>
@endsection
