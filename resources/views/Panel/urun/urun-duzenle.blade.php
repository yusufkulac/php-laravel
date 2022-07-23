@extends('Panel.layouts.app')

@section('title','Ürün Düzenle')

@section('content')

<!-- ========== section start ========== -->
<section class="section">
	<div class="container-fluid p-3">
		<!-- ========== title-wrapper start ========== -->
		<div class="title-wrapper">
			<div class="row">
			<div class="col-md-6">
				<h4>Ürün Düzenle</h4>
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
								Ürün Düzenle
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

	@if($urun == null)
		<div class="alert alert-danger d-flex align-items-center" role="alert">
			<div class="me-3">
				<i class="fas fa-info-circle"></i>
			</div>					  	
			<div>
				<div>Böyle bir ürün bulunamadı</div>
			</div>
		</div>
	@else

		<h5><i class="far fa-images"></i> Ekli Resimler</h5>            
		<hr class="mt-0">

		@if( count($urun->resimler) == 0 || $urun->resimler == null )
			<div class="alert alert-secondary d-flex align-items-center" role="alert">
				<div class="me-3">
					<i class="fas fa-info-circle"></i>
				</div>					  	
				<div>
					<div>Ürüne resim eklenmemiş</div>
				</div>
			</div>

		@else
			<div class="alert alert-secondary d-flex align-items-center" role="alert">
				<div class="me-3">
					<i class="fas fa-info-circle"></i>
				</div>					  	
				<div>
					<div>Resimleri sürükleyerek sırasını değiştirebilirsiniz</div>
				</div>
			</div>

			<div class="row" id="sortable">
				@foreach($urun->resimler as $resim)
					@if( file_exists(public_path('uploads/resim/urun/'.$resim->resim)) )

						<div class="col-6 col-md-4 col-lg-3 sortable-wrap sortable" data-index="{{ $resim->id }}" data-sira="{{ $resim->sira }}">
							<div class="eski-resim-wrapper">
								<div class="erw-inside">
									<img src="{{ asset('uploads/resim/urun/'.$resim->resim) }}">
								</div>
							</div>
							<div class="text-center my-2">
								<button class="btn btn-danger urun-resim-sil px-2 py-0" data-bs-toggle="tooltip" data-placement="bottom" title="Sil" data-id="{{ $resim->id }}">
									<i class="far fa-trash-alt"></i>
								</button>
							</div> 
						</div>
					@endif
				@endforeach
			</div>
		@endif				
				
		<form id="urunDuzenleForm" enctype="multipart/form-data">	
			<input type="hidden" name="id" value="{{ $urun->id }}">
			
			<div class="form-group my-2">
				<label for="">Dil:</label>
				<select name="dil_id" class="form-control">				
					@foreach ($diller as $dil)
						<option value="{{ $dil->id }}" @if($urun->dil_id == $dil->id) selected @endif>
							{{ $dil->dil_adi }}
						</option>
					@endforeach
				</select>
			</div>

			@if(count($kategoriler) == 0)
			<div class="alert alert-secondary my-3">
				<i class="fas fa-info-circle"></i>
				Ürün kategori tanımlanmamış. Ürünleri kategorilere arıymak isterseniz önce kategori tanımlayabilirsiniz.<br>
				<div class="ps-4">
					Kategori tanımlamak için <a href="{{route('panel.urun.kategori.ekle')}}">tıklayın</a>
				</div>				
			</div>
		@else
		<div class="form-group my-3">
			<label for="">Ürün Kategorisi :</label>
			<select name="kategori_id" class="form-control kategori-var">
				<option value="0">-- Kategori Seçin --</option>
				@foreach ($kategoriler as $kategori)
				<option value="{{$kategori->id}}" @if($kategori->id == $urun->kategori_id) selected @endif>
					{{$kategori->kategori_adi}}
				</option>
				@endforeach
			</select>
		</div>			
		@endif

			<div class="form-group my-3">
				<label for="">Ürin Adı :</label>
				<input type="text" name="urun_adi" class="form-control" value="{{ $urun->urun_adi }}">
			</div>
			
			<div class="form-group my-3">
				<label>Ürün Açıklama Özeti :</label>
				<textarea name="ozet" class="editor-small">{{ $urun->ozet }}</textarea>
			</div>

			<div class="form-group my-3">
				<label>Ürün Açıklaması :</label>
				<textarea name="icerik" class="editor">{{ $urun->icerik }}</textarea>
			</div>
			
			<div class="form-group my-3">
				<label>Aktif / Pasif:</label>
				<select name="aktif" class="form-control">
					<option value="0" @if($urun->aktif == 0){{ 'selected' }} @endif>Pasif</option>
					<option value="1" @if($urun->aktif == 1){{ 'selected' }} @endif>Aktif</option>
				</select>
			</div>

			<div class="form-group mb-3 my-4">
				<input type="checkbox" name="anasayfa_goster" id="anasayfa" @if($urun->anasayfa_goster == 1){{ 'checked' }} @endif>
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
				<textarea name="etiket" class="form-control" rows="2">{{ $urun->etiket }}</textarea>
			</div>

			<hr>

			<div class="resim-ekle-wrap my-3 font-weight-bold" style="font-size: 16px">
				<i class="fas fa-images"></i>&nbsp;YENİ RESİM EKLE
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
							<div class="resim-prev"></div></div>
							<button type="button" class="btn resim-kaldir text-danger" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Kaldır"><i class="fas fa-times-circle"></i></button>
						</div> 
						
						<div class="col-sm-6 col-md-4 my-2 rprv-wrap"> 
							<input type="file" name="resim[]" class="add-image" accept="image/*">  
							<div class="p-1 bg-white position-relative mt-1 resim-prev-wrap w-100">
							<div class="resim-prev"></div></div>
							<button type="button" class="btn resim-kaldir text-danger" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Kaldır"><i class="fas fa-times-circle"></i></button>
						</div> 

						<div class="col-sm-6 col-md-4 my-2 rprv-wrap"> 
							<input type="file" name="resim[]" class="add-image" accept="image/*">  
							<div class="p-1 bg-white position-relative mt-1 resim-prev-wrap w-100">
							<div class="resim-prev"></div></div>
							<button type="button" class="btn resim-kaldir text-danger" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Kaldır"><i class="fas fa-times-circle"></i></button>
						</div> 

						<div class="col-12 oncesine-ekle">
							<div class="alan-ekle btn btn-secondary" data-toggle="tooltip" data-bs-placement="right" title="Yeni resim ekleme alanı ekle"><i class="fas fa-plus"></i> Yeni Alan Ekle</div>
						</div>
					</div>
				</div>
			</div> 

			<div class="alert alert-secondary d-flex align-items-center mt-5" role="alert">
				<div class="me-2">
					<i class="fas fa-info-circle"></i>
				</div>
				<div>
					Ürün ile ilgili youtube'daki videonuzun linkini veya sitenize video dosyası ekleyebilirsiniz
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
					<textarea name="video_link" class="form-control" rows="3">{{$urun->video_link}}</textarea>
				</div>
		
				<div class="tab-pane fade pb-5" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
				   <input type="file" name="video" class="form-control" accept="video/*">

				   <div class="my-4">
					    @php
							$video = public_path("uploads/video/urun/".$urun->video);
							$mimeType = mime_content_type($video);							
						@endphp

						@if(strstr($mimeType, "video/"))
							<video width="320" height="240" controls>
								<source src="/uploads/video/urun/{{$urun->video}}" type="video/mp4">	
								<div class="alert alert-danger">
									Tarayıcınız video formatını desteklemiyor
								</div>
							</video> 
						@endif   
					   			
				   </div>
				</div>			
			</div>           		

			<div class="row mx-0 mt-1 pb-4">                 
				<div class="col-lg-8 ps-lg-0 mt-3">
					<button type="submit" class="btn btn-dark py-2 px-4 font-weight-bold">
						<span class="text-dark-50">
							<i class="fa fa-save"></i>
						</span>
						<span class="text">GÜNCELLE</span>
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

	//urun resmini sil ----------------------------------------------------------
    $(".urun-resim-sil").on("click", function(){                

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
				
				var i  = $(".urun-resim-sil").index(this);
				var id = $(".urun-resim-sil").eq(i).data("id");                

				$.ajax({
					type        : "post",
					url         : "{{ route('panel.urun.resim.sil') }}",
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
$("#urunDuzenleForm").submit(function(e){
	e.preventDefault();

	var urun_adi = $.trim( $("[name=urun_adi]").val() );

	if(urun_adi <= 0){
		Swal.fire({
			type: 'error', 
			text: 'Lütfen haber başlığını yazınız',
			confirmButtonText: 'Tamam',
			confirmButtonColor: '#333'
		}).then(function(){
			$("[name=urun_adi]").addClass("border-red");
			$("html, body").animate({ scrollTop: 0 }, "50");
			return false;
		});         
		return false;
	}else{              
		tinyMCE.triggerSave();
		var form_data = new FormData(this);

		$.ajax({
			type        : "post",
			url         :"{{ route('panel.urun.duzenle.post') }}",
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
                url      : "{{ route('panel.urun.resim.sirala') }}",
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
