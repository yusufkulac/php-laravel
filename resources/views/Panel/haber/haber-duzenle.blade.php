@extends('Panel.layouts.app')

@section('title','Haber Düzenle')

@section('content')

<!-- ========== section start ========== -->
<section class="section">
	<div class="container-fluid p-3">
		<!-- ========== title-wrapper start ========== -->
		<div class="title-wrapper">
			<div class="row">
			<div class="col-md-6">
				<h4>Haber Düzenle</h4>
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
								Haber Düzenle
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

	@if($haber == null)
		<div class="alert alert-danger d-flex align-items-center" role="alert">
			<div class="me-3">
				<i class="fas fa-info-circle"></i>
			</div>					  	
			<div>
				<div>Böyle bir haber bulunamadı</div>
			</div>
		</div>
	@else

		<h5><i class="far fa-images"></i> Haberin Resimleri</h5>            
		<hr class="mt-0">

		@if( count($haber->resimler) == 0 || $haber->resimler == null )
			<div class="alert alert-secondary d-flex align-items-center" role="alert">
				<div class="me-3">
					<i class="fas fa-info-circle"></i>
				</div>					  	
				<div>
					<div>Habere resim eklenmemiş</div>
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
				@foreach($haber->resimler as $resim)
					@if( file_exists(public_path('uploads/resim/haber/'.$resim->resim)) )

						<div class="col-6 col-md-4 col-lg-3 sortable-wrap sortable" data-index="{{ $resim->id }}" data-sira="{{ $resim->sira }}">
							<div class="eski-resim-wrapper">
								<div class="erw-inside">
									<img src="{{ asset('uploads/resim/haber/'.$resim->resim) }}">
								</div>
							</div>
							<div class="text-center my-2">
								<button class="btn btn-danger haber-resim-sil px-2 py-0" data-bs-toggle="tooltip" data-placement="bottom" title="Sil" data-id="{{ $resim->id }}">
									<i class="far fa-trash-alt"></i>
								</button>
							</div> 
						</div>
					@endif
				@endforeach
			</div>
		@endif				
				
		<form id="haberDuzenleForm" enctype="multipart/form-data">	
			<input type="hidden" name="id" value="{{ $haber->id }}">
			
			<div class="form-group my-2">
				<label for="">Dil:</label>
				<select name="dil_id" class="form-control">				
					@foreach ($diller as $dil)
						<option value="{{ $dil->id }}" @if($haber->dil_id == $dil->id) selected @endif>
							{{ $dil->dil_adi }}
						</option>
					@endforeach
				</select>
			</div>

			<div class="form-group my-3">
				<label for="">Başlık :</label>
				<input type="text" name="baslik" class="form-control" value="{{ $haber->baslik }}">
			</div>
			
			<div class="form-group my-3">
				<label>Özet:</label>
				<textarea name="ozet" class="editor-small">{{ $haber->ozet }}</textarea>
			</div>

			<div class="form-group my-3">
				<label>Haber Yazısı:</label>
				<textarea name="icerik" class="editor">{{ $haber->icerik }}</textarea>
			</div>
			
			<div class="form-group my-3">
				<label>Aktif / Pasif:</label>
				<select name="aktif" class="form-control">
					<option value="0" @if($haber->aktif == 0){{ 'selected' }} @endif>Pasif</option>
					<option value="1" @if($haber->aktif == 1){{ 'selected' }} @endif>Aktif</option>
				</select>
			</div>

			<div class="form-group mb-3 my-4">
				<input type="checkbox" name="anasayfa_goster" id="anasayfa" @if($haber->anasayfa_goster == 1){{ 'checked' }} @endif>
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
				<textarea name="etiket" class="form-control" rows="2">{{ $haber->etiket }}</textarea>
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
				<textarea name="video" class="form-control" rows="3">{{ $haber->video }}</textarea>
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

	//haber resmini sil ----------------------------------------------------------
    $(".haber-resim-sil").on("click", function(){                

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
				
				var i  = $(".haber-resim-sil").index(this);
				var id = $(".haber-resim-sil").eq(i).data("id");                

				$.ajax({
					type        : "post",
					url         : "{{ route('haber.resim.sil') }}",
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
$("#haberDuzenleForm").submit(function(e){
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
			url         :"{{ route('haber.duzenle.post') }}",
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
