@extends('Site.layouts.app')

@section('title','İnsan Kaynakları')

@if(isset($description))
@section('description', $description)
@endif

@if(isset($keywords))
@section('keywords', $keywords)
@endif

@section('content')

<div class="container-fluid page-header hakkimizda-top position-relative">
	<div class="container position-relative h-100">
		<h2 class="header-text">İnsan Kaynakları</h2>
		<div class="d-flex page-nav">
			<a href="{{ route('site.index') }}">Anasayfa</a> <span class="mx-2">|</span>			
			<a href="{{ route('site.insan.kaynaklari') }}">İnsan Kaynakları</a>
		</div>
	</div>
</div>

<section>
	<div class="container">
		<div class="row pt-5">
			<div class="col-lg-9 pt-4">
				
				<h5 class="ilt-header">BAŞVURU FORMU</h5>
				<p>
					Aşağıdaki formu kullanarak bize iş başvurunda bulunabilirsiniz
				</p>
				<form id="insanKaynaklariForm" enctype="multipart/form-data">
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

						<div class="col-lg-6">
							<div class="form-group my-3">
								<div class="ilt-input-content">
									<select name="ikamet_il" class="ilt-input select-ilt-input" id="country">
										<option value="" selected disabled hidden>İkametgah İli Seçiniz *</option>
										<option value="Adana">Adana</option>
										<option value="Adıyaman">Adıyaman</option>
										<option value="Afyonkarahisar">Afyonkarahisar</option>
										<option value="Ağrı">Ağrı</option>
										<option value="Amasya">Amasya</option>
										<option value="Ankara">Ankara</option>
										<option value="Antalya">Antalya</option>
										<option value="Artvin">Artvin</option>
										<option value="Aydın">Aydın</option>
										<option value="Balıkesir">Balıkesir</option>
										<option value="Bilecik">Bilecik</option>
										<option value="Bingöl">Bingöl</option>
										<option value="Bitlis">Bitlis</option>
										<option value="Bolu">Bolu</option>
										<option value="Burdur">Burdur</option>
										<option value="Bursa">Bursa</option>
										<option value="Çanakkale">Çanakkale</option>
										<option value="Çankırı">Çankırı</option>
										<option value="Çorum">Çorum</option>
										<option value="Denizli">Denizli</option>
										<option value="Diyarbakır">Diyarbakır</option>
										<option value="Edirne">Edirne</option>
										<option value="Elazığ">Elazığ</option>
										<option value="Erzincan">Erzincan</option>
										<option value="Erzurum">Erzurum</option>
										<option value="Eskişehir">Eskişehir</option>
										<option value="Gaziantep">Gaziantep</option>
										<option value="Giresun">Giresun</option>
										<option value="Gümüşhane">Gümüşhane</option>
										<option value="Hakkâri">Hakkâri</option>
										<option value="Hatay">Hatay</option>
										<option value="Isparta">Isparta</option>
										<option value="Mersin">Mersin</option>
										<option value="İstanbul">İstanbul</option>
										<option value="İzmir">İzmir</option>
										<option value="Kars">Kars</option>
										<option value="Kastamonu">Kastamonu</option>
										<option value="Kayseri">Kayseri</option>
										<option value="Kırklareli">Kırklareli</option>
										<option value="Kırşehir">Kırşehir</option>
										<option value="Kocaeli">Kocaeli</option>
										<option value="Konya">Konya</option>
										<option value="Kütahya">Kütahya</option>
										<option value="Malatya">Malatya</option>
										<option value="Manisa">Manisa</option>
										<option value="Kahramanmaraş">Kahramanmaraş</option>
										<option value="Mardin">Mardin</option>
										<option value="Muğla">Muğla</option>
										<option value="Muş">Muş</option>
										<option value="Nevşehir">Nevşehir</option>
										<option value="Niğde">Niğde</option>
										<option value="Ordu">Ordu</option>
										<option value="Rize">Rize</option>
										<option value="Sakarya">Sakarya</option>
										<option value="Samsun">Samsun</option>
										<option value="Siirt">Siirt</option>
										<option value="Sinop">Sinop</option>
										<option value="Sivas">Sivas</option>
										<option value="Tekirdağ">Tekirdağ</option>
										<option value="Tokat">Tokat</option>
										<option value="Trabzon">Trabzon</option>
										<option value="Tunceli">Tunceli</option>
										<option value="Şanlıurfa">Şanlıurfa</option>
										<option value="Uşak">Uşak</option>
										<option value="Van">Van</option>
										<option value="Yozgat">Yozgat</option>
										<option value="Zonguldak">Zonguldak</option>
										<option value="Aksaray">Aksaray</option>
										<option value="Bayburt">Bayburt</option>
										<option value="Karaman">Karaman</option>
										<option value="Kırıkkale">Kırıkkale</option>
										<option value="Batman">Batman</option>
										<option value="Şırnak">Şırnak</option>
										<option value="Bartın">Bartın</option>
										<option value="Ardahan">Ardahan</option>
										<option value="Iğdır">Iğdır</option>
										<option value="Yalova">Yalova</option>
										<option value="Karabük">Karabük</option>
										<option value="Kilis">Kilis</option>
										<option value="Osmaniye">Osmaniye</option>
										<option value="Düzce">Düzce</option>
									</select>									
								</div>								
							</div>
						</div>

						<div class="col-lg-6">
							<div class="form-group my-3">
								<div class="ilt-input-content">
									<input type="text" name="basvuru_bolum" class="ilt-input" placeholder="Çalışmak İstediğiniz Bölüm *">
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

						<div class="col-12">
							<label for="">CV Ekle:</label>
							<input type="file" name="cv_dosya" class="form-control" accept=".doc, .docx, .pdf">
						</div>
						
						<div class="col-12 my-4">
							<button type="submit" class="btn btn-form-gonder">
								GÖNDER
							</button>
						</div>
					</div>
				</form>
			
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
    $("#insanKaynaklariForm").submit(function(e){
        e.preventDefault();

        var ad      = $.trim( $("[name=ad]").val() );
        var soyad   = $.trim( $("[name=soyad]").val() );
        var telefon = $.trim( $("[name=telefon]").val() );
        var mail    = $.trim( $("[name=mail]").val() );
        var mesaj   = $.trim( $("[name=mesaj]").val() );
        var ikamet_il     = $.trim( $("[name=ikamet_il]").val() );
        var basvuru_bolum = $.trim( $("[name=basvuru_bolum]").val() );

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
        }else if(ikamet_il.length <= 0){
            Swal.fire({
                type: 'error', 
                text: 'Lütfen ikamet ettğiniz ili seçin',
                confirmButtonText: 'Tamam',
                confirmButtonColor: '#333'
            });         
            return false;
        }else if(basvuru_bolum.length <= 0){
            Swal.fire({
                type: 'error', 
                text: 'Lütfen başvurmak istediğiniz bölümü yazın',
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
                url         : "{{ route('site.insan.kaynaklari.post') }}",
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
    //----------------------------------------------------------------------------


	/*function for placeholder select*/
	function selectPlaceholder(selectID){
		var selected = $(selectID + ' option:selected');
		var val = selected.val();
		$(selectID + ' option' ).css('color', '#333');
		selected.css('color', '#999');
		if (val == "") {
			$(selectID).css('color', '#999');
		};
		$(selectID).change(function(){
			var val = $(selectID + ' option:selected' ).val();
			if (val == "") {
				$(selectID).css('color', '#999');
			}else{
				$(selectID).css('color', '#333');
			};
		});
	};

	selectPlaceholder('#country');
	
		
	
});
</script>

@endsection
