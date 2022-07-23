@extends('Panel.layouts.app')

@section('title','Ürün Kategori Düzenle')

@section('content')

<!-- ========== section start ========== -->
<section class="section">
	<div class="container-fluid p-3">
		<!-- ========== title-wrapper start ========== -->
		<div class="title-wrapper">
			<div class="row">
			<div class="col-md-6">
				<h4>Ürün Kategori Düzenle</h4>
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
								Ürün Kategori Düzenle
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
		<div class="alert alert-danger d-flex align-items-center" role="alert">
			<div class="me-3">
				<i class="fas fa-info-circle"></i>
			</div>					  	
			<div>
				<div>Böyle bir ürün kategorisi kategori bulunamadı</div>
			</div>
		</div>
	@else

		@if(is_file(public_path('uploads/resim/urun/'.$kategori->resim)))	
			<div class="row">
				<div class="col-md-3">
					<div class="eski-resim-wrapper">
						<div class="erw-inside">
							<img src="{{ asset('uploads/resim/urun/'.$kategori->resim) }}">
						</div>
					</div>
					<div class="text-center my-2">
						<button class="btn btn-danger kategori-resim-sil px-2 py-0" data-bs-toggle="tooltip" data-placement="bottom" title="Sil" data-id="{{ $kategori->id }}">
							<i class="far fa-trash-alt"></i>
						</button>
					</div> 
				</div>
			</div>
		@endif			
				
		<form id="kategoriDuzenleForm" enctype="multipart/form-data">	
			<input type="hidden" name="id" value="{{ $kategori->id }}">
			
			<div class="form-group my-2">
				<label for="">Dil:</label>
				<select name="dil_id" class="form-control">				
					@foreach ($diller as $dil)
						<option value="{{ $dil->id }}" @if($kategori->dil_id == $dil->id) selected @endif>
							{{ $dil->dil_adi }}
						</option>
					@endforeach
				</select>
			</div>

			<div class="form-group my-3">
				<label for="">Kategori Adı :</label>
				<input type="text" name="kategori_adi" class="form-control" value="{{ $kategori->kategori_adi }}">
			</div>

			<div class="resim-ekle-wrap my-3 font-weight-bold" style="font-size: 16px">
				<i class="fas fa-images"></i>&nbsp;RESİM EKLE
			</div> 

			<div class="resim-content">
				<div class="alert alert-secondary d-flex align-items-center" role="alert">
					<div class="me-2">
						<i class="fas fa-info-circle"></i>
					</div>
					<div>
						Yeni resim eklerseniz, eskisi ile değiştirilir. Önerilen resim boyutu 800px / 600px
					</div>
				</div>
				
				<div class="row mx-0 my-3 my-3">
					<div class="col-sm-6 col-md-4 my-2 rprv-wrap ps-lg-0"> 
						<input type="file" name="resim" class="add-image" accept="image/*">  
						<div class="p-1 bg-white position-relative mt-1 resim-prev-wrap w-100">
							<div class="resim-prev"></div>
						</div>
					</div> 						
				</div>				
			</div> 			     		

			<div class="row mx-0 mt-1 pb-4">                 
				<div class="col-lg-8 ps-lg-0 mt-3">
					<button type="submit" class="btn btn-dark py-2 px-4 font-weight-bold">
						<span class="text-dark-50">
							<i class="fa fa-save"></i>
						</span>
						<span class="text"> GÜNCELLE</span>
					</button>
				</div>
			</div>
		</form>
	@endif
</section> 
@endsection

@section("customJs")
<script>
$(function(){	

	//kategori resmini sil ----------------------------------------------------------
    $(".kategori-resim-sil").on("click", function(){                

		Swal.fire({
				type: "warning",               
				text: "Resim silinecek, devam edilsin mi?",          
				showCancelButton: true,
				confirmButtonColor: '#e44242',
				confirmButtonText: 'Sil',
				cancelButtonText: "Vazgeç",
				cancelButtonColor: '#333',              
		}).then((result) => {
			if (result.value) {
				
				var id = $(".kategori-resim-sil").data("id");                

				$.ajax({
					type        : "post",
					url         : "{{ route('panel.urun.kategori.resim.sil') }}",
					data        : {id:id},
							
					dataType    :'json',
					beforeSend: function() {
						$(".loading-wrapper").css("display","block");
					},          
					success : function(result){

						if( result.durum == "success"){
							$(".sortable-wrap").eq(i).remove();
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
	});
//----------------------------------------------------------------------------



//haber düzenle --------------------------------------------------------------
$("#kategoriDuzenleForm").submit(function(e){
	e.preventDefault();

	var kategori_adi = $.trim( $("[name=kategori_adi]").val() );

	if(kategori_adi <= 0){
		Swal.fire({
			type: 'error', 
			text: 'Lütfen haber başlığını yazınız',
			confirmButtonText: 'Tamam',
			confirmButtonColor: '#333'
		}).then(function(){
			$("[name=kategori_adi]").addClass("border-red");
			$("html, body").animate({ scrollTop: 0 }, "50");
			return false;
		});         
		return false;
	}else{              
		tinyMCE.triggerSave();
		var form_data = new FormData(this);

		$.ajax({
			type        : "post",
			url         :"{{ route('panel.urun.kategori.duzenle.post') }}",
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


$( "#sortable" ).disableSelection();
     //haber resim sırala ajax ----------------------------------------------------
    $( "#sortable" ).sortable({

        update : function(event, ui){
            $(this).children().each(function(index){
                if( $(this).attr('data-sira') != (index+1) ) {
                    $(this).attr('data-sira', (index+1));
                }
            });

            sira = [];
            $(".sortable-wrap").each(function(){
                sira.push([$(this).attr('data-index'), $(this).attr('data-sira')]);
            });

            $.ajax({
                type     : 'post',
                dataType : 'json',
                data     : {update :1, sira : sira},
                url      : "{{ route('haber.resim.sirala') }}",
                success  : function(msg){
                    if (msg.durum == 'success') {
                        window.location.reload();
                    }
                }
            });
        }
    });
    //   ./haber resim sırala ajax bitiş ------------------------------------------



});
</script>
@endsection
