@extends('Site.layouts.app')

@section('title','İletişim')

@if(isset($description))
@section('description', $description)
@endif

@if(isset($keywords))
@section('keywords', $keywords)
@endif

@section('content')

<div class="container-fluid page-header hakkimizda-top position-relative">
	<div class="container position-relative h-100">
		<h2 class="header-text">İletişim</h2>
		<div class="d-flex page-nav">
			<a href="{{ route('site.index') }}">Anasayfa</a> <span class="mx-2">|</span>			
			<a href="{{ route('site.iletisim') }}">İletişim</a>
		</div>
	</div>
</div>

<section>
	<div class="container">
		<div class="row pt-5">
			<div class="col-lg-9 pt-4">
				<h5 class="ilt-header">İLETİŞİM BİLGİLERİ</h5>
				<p>
					Görüş, soru, öneri ve teklif talepleriniz için aşağıdaki bilgileri kullanarak bizimle iletişime geçebilirsiniz
				</p>

				<div class="mb-5">
					<div class="d-flex my-2">
						<div class="ilt-icon-wrap">
							<i class="fas fa-map-marker-alt"></i>
						</div>
						<div class="w-100">
							{{ $siteBilgi->adres }}
						</div>
					</div>
					<div class="d-flex my-2">
						<div class="ilt-icon-wrap">
							<i class="fas fa-mobile-alt"></i>
						</div>
						<div class="w-100">
							{{ $siteBilgi->telefon }} - {{ $siteBilgi->gsm1 }}
						</div>
					</div>
					<div class="d-flex my-2">
						<div class="ilt-icon-wrap">
							<i class="fas fa-envelope"></i>
						</div>
						<div class="w-100">
							<a href="mailto:{{ $siteBilgi->mail }}" class="ilt-link">
								{{ $siteBilgi->mail }}
							</a>
						</div>
					</div>
				</div>

				<h5 class="ilt-header">HIZLI ERİŞİM FORMU</h5>
				<p>
					Aşağıdaki formu kullanarak bize ulaşabilirsiniz
				</p>
				<form id="iletisimForm">
					<div class="row">
						<div class="col-lg-6">
							<div class="form-group my-3">
								<div class="ilt-input-content">
									<input type="text" name="ad" class="ilt-input" placeholder="Adınız *">
								</div>								
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group my-3">
								<div class="ilt-input-content">
									<input type="text" name="soyad" class="ilt-input" placeholder="Soyadınız *">
								</div>								
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group my-3">
								<div class="ilt-input-content">
									<input type="text" name="telefon" class="ilt-input" placeholder="Telefon *">
								</div>								
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group my-3">
								<div class="ilt-input-content">
									<input type="email" name="mail" class="ilt-input" placeholder="E-posta Adresi *">
								</div>								
							</div>
						</div>
						<div class="col-lg-12">
							<div class="form-group my-3">
								<div class="ilt-input-content">
									<textarea type="text" name="mesaj" class="ilt-input" placeholder="Mesaj *" rows="5"></textarea>
								</div>								
							</div>
						</div>

						<div class="col-md-6">
							
						</div>
						<div class="col-md-6 text-end">
							<button type="submit" class="btn btn-form-gonder">
								GÖNDER
							</button>
						</div>
					</div>
				</form>

				<div id="iletisimMap" class="my-5">
					{!!$ayar->maps!!}
				</div>
			</div>
			<div class="col-lg-3 pe-0 pt-4 d-none d-lg-block">
				@include("Site.layouts.hizli-erisim")
			</div>
		</div>
	</div>
</section>

@endsection

@section("customJs")
<script>
$(function(){

	//iletişim post --------------------------------------------------------------
    $("#iletisimForm").submit(function(e){
        e.preventDefault();

        var ad      = $.trim( $("[name=ad]").val() );
        var soyad   = $.trim( $("[name=soyad]").val() );
        var telefon = $.trim( $("[name=telefon]").val() );
        var mail    = $.trim( $("[name=mail]").val() );
        var mesaj   = $.trim( $("[name=mesaj]").val() );

        if(ad.length <= 0){
            Swal.fire({
                type: 'error', 
                text: 'Lütfen adınızı yazın',
                confirmButtonText: 'Tamam',
                confirmButtonColor: '#333'
            });         
            return false;
        }else if(soyad.length <= 0){
            Swal.fire({
                type: 'error', 
                text: 'Lütfen soyadınızı yazın',
                confirmButtonText: 'Tamam',
                confirmButtonColor: '#333'
            });         
            return false;
        }else if(telefon.length <= 0){
            Swal.fire({
                type: 'error', 
                text: 'Lütfen telefon numaranızı yazın',
                confirmButtonText: 'Tamam',
                confirmButtonColor: '#333'
            });         
            return false;
        }else if(mail.length <= 0){
            Swal.fire({
                type: 'error', 
                text: 'Lütfen e-posta adresinizi yazın',
                confirmButtonText: 'Tamam',
                confirmButtonColor: '#333'
            });         
            return false;
        }else if(mesaj.length <= 0){
            Swal.fire({
                type: 'error', 
                text: 'Lütfen mesajınızı yazın',
                confirmButtonText: 'Tamam',
                confirmButtonColor: '#333'
            });         
            return false;
        }else{              
           
            var form_data = new FormData(this);

            $.ajax({
                type        : "post",
                url         : "{{ route('site.iletisim.post') }}",
                data        : form_data,
                contentType : false,            
                processData : false,            
                dataType    :'json',
                beforeSend: function() {
                    $(".loading-wrapper").css("display","block");
                },          
                success : function(result){

                    if( result.durum == "success"){

	                    Swal.fire({
			                type: 'success', 
			                text: result.mesaj,
			                confirmButtonText: 'Tamam',
			                confirmButtonColor: '#333'
			            }).then(function(){
			            	$("[name=ad]").val("");
			            	$("[name=soyad]").val("");
			            	$("[name=telefon]").val("");
			            	$("[name=mail]").val("");
			            	$("[name=mesaj]").val("");
			            }); 	                
	                    
	                    return false;

	                }else if( result.durum == "error"){

	                   Swal.fire({
			                type: 'error', 
			                text: result.mesaj,
			                confirmButtonText: 'Tamam',
			                confirmButtonColor: '#333'
			            }); 

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
