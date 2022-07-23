@extends('Panel.layouts.app')

@section('title','Haber Ekle')

@section('content')

<!-- ========== section start ========== -->
<section class="section">
	<div class="container-fluid p-3">
		<!-- ========== title-wrapper start ========== -->
		<div class="title-wrapper">
			<div class="row">
			<div class="col-md-6">
				<h4>Haber Ekle</h4>
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
								Haber Ekle
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

	<form id="haberEkleForm" enctype="multipart/form-data">
		
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
			<input type="text" name="baslik" class="form-control" value="{{ old('baslik') }}">
		</div>
		
		<div class="form-group my-2">
			<label>Özet:</label>
			<textarea name="ozet" class="editor-small">{{ old('ozet') }}</textarea>
		</div>

		<div class="form-group my-2">
			<label>Haber Yazısı:</label>
			<textarea name="icerik" class="editor">{{ old('icerik') }}</textarea>
		</div>
		
		<div class="form-group my-2">
			<label>Aktif / Pasif:</label>
			<select name="aktif" class="form-control">
				<option value="0">Pasif</option>
				<option value="1" selected>Aktif</option>
			</select>
		</div>

		<div class="form-group my-4 mb-3">
			<input type="checkbox" name="anasayfa_goster" id="anasayfa">
			<label for="anasayfa">Anasayfada Göster</label>                
		</div>

		<div class="alert alert-secondary d-flex align-items-center mb-0" role="alert">
			<div class="me-2">
				<i class="fas fa-info-circle"></i>
			</div>
			<div>
				Kelime aralarına virgül koyunuz. (Örnek: etiket1, etiket2)
			</div>
		</div>
		
		<div class="form-group mt-0">
			<label>Etiketler:</label>
			<textarea name="etiket" class="form-control" rows="2"></textarea>
		</div>

		<hr>

		<div class="resim-ekle-wrap my-3 font-weight-bold" style="font-size: 16px">
			<i class="fas fa-images"></i>&nbsp;RESİM EKLE
		</div> 

		<div class="resim-content">

			<div class="alert alert-secondary d-flex align-items-center" role="alert">
				<div class="me-2">
					<i class="fas fa-info-circle"></i>
				</div>
				<div>
					Resim ekleyeceğiniz alana tıklayın. Önerilen resim boyutu 800px / 600px
				</div>
			</div>

			<div class="my-3">
				<div class="row mx-0">

					<div class="col-sm-6 col-md-4 my-2 rprv-wrap"> 
						<input type="file" name="resim[]" class="add-image" accept="image/*">  
						<div class="p-1 bg-white position-relative mt-1 resim-prev-wrap w-100">
							<div class="resim-prev"></div>
						</div>
						<button type="button" class="btn resim-kaldir text-danger" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Kaldır"><i class="fas fa-times-circle"></i></button>
					</div>

					<div class="col-sm-6 col-md-4 my-2 rprv-wrap"> 
						<input type="file" name="resim[]" class="add-image" accept="image/*">  
						<div class="p-1 bg-white position-relative mt-1 resim-prev-wrap w-100">
							<div class="resim-prev"></div>
						</div>
						<button type="button" class="btn resim-kaldir text-danger" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Kaldır"><i class="fas fa-times-circle"></i></button>
					</div>

					<div class="col-sm-6 col-md-4 my-2 rprv-wrap"> 
						<input type="file" name="resim[]" class="add-image" accept="image/*">  
						<div class="p-1 bg-white position-relative mt-1 resim-prev-wrap w-100">
							<div class="resim-prev"></div>
						</div>
						<button type="button" class="btn resim-kaldir text-danger" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Kaldır"><i class="fas fa-times-circle"></i></button>
					</div>                       

					<div class="col-12 text-right oncesine-ekle ps-lg-0">
						<button type="button" class="alan-ekle btn btn-secondary" data-toggle="tooltip" data-bs-placement="right" title="Yeni resim ekleme alanı ekle"><i class="fas fa-plus"></i> 		Resim Alanı Ekle
						</button>
					</div>

				</div>
			</div>
		</div> 

		<div class="alert alert-secondary d-flex align-items-center mb-0" role="alert">
			<div class="me-2">
				<i class="fas fa-info-circle"></i>
			</div>
			<div>
				Youtube'daki videonuzu ekleyebilirsiniz
			</div>
		</div>
		
		<div class="form-group mt-0">
			<label>Video:</label>
			<textarea name="video" class="form-control" rows="3"></textarea>
		</div>          		

		<div class="row mx-0 mt-1 pb-4">                 
			<div class="col-lg-8 ps-lg-0 mt-3">
				<button type="submit" class="btn btn-dark py-2 px-4 font-weight-bold">
					<span class="text-dark-50">
					  <i class="fa fa-save"></i>
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

	//haber Ekle --------------------------------------------------------------
    $("#haberEkleForm").submit(function(e){
        e.preventDefault();

        var baslik = $.trim( $("[name=baslik]").val() );

        if(baslik <= 0){
            Swal.fire({
                type: 'error', 
                text: 'Lütfen haber başlığını yazınız',
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
                url         : "{{ route('haber.ekle.post') }}",
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
