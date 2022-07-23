@extends('Panel.layouts.app')

@section('title','Resim Galeri Kategori Düzenle')

@section('content')

<!-- ========== section start ========== -->
<section class="section">
	<div class="container-fluid p-3">
		<!-- ========== title-wrapper start ========== -->
		<div class="title-wrapper">
			<div class="row">
			<div class="col-md-6">
				<h4>Resim Galeri Kategori Düzenle</h4>
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
								Resim Galeri Kategori Düzenle
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
	@if($kategori == null)
		<div class="alert alert-danger my-4">
			<i class="fas fa-info-circle"></i>
			Kategori bulunamadı
		</div>
	@else
	<form id="kategoriDuzenleForm" enctype="multipart/form-data">	
		<input type="hidden" name="id" value="{{ $kategori->id }}">
		<div class="form-group my-2">
			<label for="">Dil:</label>
			<select name="dil_id" class="form-control">				
				@foreach ($diller as $dil)
					<option value="{{ $dil->id }}" @if($dil->varsayilan == $kategori->dil_id) selected @endif>
						{{ $dil->dil_adi }}
					</option>
				@endforeach
			</select>
		</div>	

		<div class="form-group my-2">
			<label for="">Resim Galeri Kategori Adı :</label>
			<input type="text" name="galeri_adi" class="form-control" value="{{ $kategori->galeri_adi }}">
		</div>	

		<div class="row">
			<div class="col-lg-6 pt-5">
				<label for="">Kategori Resmi:</label>
				<div class="" style="width:260px; height:200px;overflow: hidden;">
					@if(is_file('uploads/resim/galeri/'.$kategori->resim))
						<img src="{{ asset('uploads/resim/galeri/'.$kategori->resim) }}" class="img-fluid">
					@else
						<img src="{{ asset('assets/panel/images/no-image.png') }}" class="img-fluid">
					@endif
				</div>
			</div>
			<div class="col-lg-6">
				<label for="">Resmi Değiştir:</label>
				<div class="alert alert-primary d-flex align-items-center">
					<i class="fas fa-info-circle me-2"></i>
					Önerilen resim boyutu 800px / 600px
				</div>

				<div class="my-2"> 
					<input type="file" name="resim" id="resim" class="add-image" accept="image/*">  
					<div class="p-1 bg-white position-relative mt-1 resim-prev-wrap" style="width:200px">
						<div class="resim-prev" style="height:150px; text-align: left;"></div>
					</div>
				</div> 
			</div>
		</div>				
		<hr>
		 <button type="submit" class="btn btn-dark py-2 px-4 my-3 font-weight-bold">
			<span class="text-dark-50">
			  <i class="far fa-save"></i>
			</span>
			<span class="text">KAYDET</span>
		</button>
	</form>
	@endif
</section> 
@endsection

@section("customJs")
<script>
$(function(){

	//kategori Ekle --------------------------------------------------------------
    $("#kategoriDuzenleForm").submit(function(e){
        e.preventDefault();

        var galeri_adi = $.trim( $("[name=galeri_adi]").val() );
        
        if(galeri_adi.length <= 0){
            Swal.fire({
                type: 'error', 
                text: 'Kategori adını yazın',
                confirmButtonText: 'Tamam',
                confirmButtonColor: '#333'
            }).then(function(){
                $("[name=galeri_adi]").addClass("border-red");
                //$("html, body").animate({ scrollTop: 0 }, "50");
                return false;
            });         
            return false;
        }else{              
           
            var form_data = new FormData(this);

            $.ajax({
                type        : "post",
                url         :"{{ route('panel.rg.kategori.duzenle.post') }}",
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
