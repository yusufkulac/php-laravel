@extends('Panel.layouts.app')

@section('title','Blog Düzenle')

@section('content')

<!-- ========== section start ========== -->
<section class="section">
	<div class="container-fluid p-3">
		<!-- ========== title-wrapper start ========== -->
		<div class="title-wrapper">
			<div class="row">
			<div class="col-md-6">
				<h4>Blog Düzenle</h4>
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
								Blog Düzenle
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

	@if($blog == null)
		<div class="alert alert-danger d-flex align-items-center" role="alert">
			<div class="me-3">
				<i class="fas fa-info-circle"></i>
			</div>					  	
			<div>
				<div>Böyle bir blog bulunamadı</div>
			</div>
		</div>
	@else
		
		<form id="blogDuzenleForm">	
			<input type="hidden" name="id" value="{{ $blog->id }}">	

			<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
				<li class="nav-item" role="presentation">
					<button class="nav-link active" id="pills-bilgi-tab" data-bs-toggle="pill" data-bs-target="#pills-bilgi" type="button" role="tab" aria-controls="pills-bilgi" aria-selected="true">
						Bilgiler
					</button>
				</li>
				<li class="nav-item" role="presentation">
					<button class="nav-link" id="pills-resim-tab" data-bs-toggle="pill" data-bs-target="#pills-resim" type="button" role="tab" aria-controls="pills-resim" aria-selected="false">
						Resim
					</button>
				</li>
				<li class="nav-item" role="presentation">
					<button class="nav-link" id="pills-video-tab" data-bs-toggle="pill" data-bs-target="#pills-video" type="button" role="tab" aria-controls="pills-video" aria-selected="false">
						Video
					</button>
				</li>
				<li class="nav-item" role="presentation">
					<button class="nav-link" id="pills-seo-tab" data-bs-toggle="pill" data-bs-target="#pills-seo" type="button" role="tab" aria-controls="pills-seo" aria-selected="false">
						Seo
					</button>
				</li>
			</ul>

			<div class="tab-content p-2 border" id="pills-tabContent">

				<!-- bilgiler content ---------------------------------------------------------------------->
				<div class="tab-pane fade show active" id="pills-bilgi" role="tabpanel" aria-labelledby="pills-bilgi-tab">
			
					<div class="form-group my-2">
						<label for="">Dil:</label>
						<select name="dil_id" class="form-control">				
							@foreach ($diller as $dil)
								<option value="{{ $dil->id }}" @if($dil->id == $blog->dil_id) selected @endif>
									{{ $dil->dil_adi }}
								</option>
							@endforeach
						</select>
					</div>

					<div class="form-group">
						<label for="">Başlık :</label>
						<input type="text" name="baslik" class="form-control" value="{{ $blog->baslik }}">
					</div>					
					
					<div class="form-group">
						<label>Özet:</label>
						<textarea name="ozet" class="editor-small">{{ $blog->ozet }}</textarea>
					</div>

					<div class="form-group">
						<label>Blog Yazısı:</label>
						<textarea name="icerik" class="editor">{{ $blog->icerik }}</textarea>
					</div>
					
					<div class="form-group">
						<label>Aktif / Pasif:</label>
						<select name="aktif" class="form-control">
							<option value="0" @if($blog->aktif == 0){{ 'selected' }} @endif>Pasif</option>
							<option value="1" @if($blog->aktif == 1){{ 'selected' }} @endif>Aktif</option>
						</select>
					</div>

					<div class="form-group mb-3">
						<input type="checkbox" name="anasayfa_goster" id="anasayfa" @if($blog->anasayfa_goster == 1){{ 'checked' }} @endif>
						<label for="anasayfa">Anasayfada Göster</label>                
					</div>

					<div class="alert alert-primary d-flex align-items-center mb-0" role="alert">
						<i class="fas fa-info-circle me-2"></i>
						Kelime aralarına virgül koyunuz. (Örnek: etiket1, etiket2)
					</div>
					
					<div class="form-group mt-0">
						<label>Etiketler:</label>
						<textarea name="etiket" class="form-control" rows="2">{{ $blog->etiket }}</textarea>
					</div>
				</div><!-- ./end bilgiler content -->

				<!-- resim content --------------------------------------------------------------------------->
				<div class="tab-pane fade" id="pills-resim" role="tabpanel" aria-labelledby="pills-resim-tab">

					<div class="d-flex flex-column flex-md-row">
						<div style="width:480px; height: 44vh;" class="">
							<div class="resim-ekle-wrap my-3 font-weight-bold" style="font-size: 16px; padding-top:80px">
								<i class="fas fa-images me-2"></i>Ana Resim
							</div>

							<div class="p-2 text-center bg-white" style="height:30vh; width:100%; box-shadow: 0 0 10px #777;">
								<div style="height: 100%; overflow: hidden;">
								@if(is_file("uploads/resim/blog/".$blog->resim))
					                <img src="{{ asset('uploads/resim/blog/'.$blog->resim) }}" style="height:100%; width:auto">
					            @else
					                <img src="{{ asset('assets/panel/images/no-image.png') }}" style="height:100%; width:auto">
					            @endif
					            </div>
							</div>							
						</div>

						<div style="width:480px; height: 44vh;" class="ps-md-4">
							<div class="resim-ekle-wrap my-3 font-weight-bold" style="font-size: 16px">
								<i class="fas fa-images me-2"></i>Ana Resim Değiştir (Opsiyonel)
							</div> 

							<div class="resim-content">
								<div class="alert alert-primary d-flex align-items-center" role="alert">
									<i class="fas fa-info-circle me-2"></i>
									Önerilen resim boyutu 800px / 600px					
								</div>

								<div class="my-3">
									<input type="file" name="ana_resim" class="add-image" accept="image/*">  
									<div class="p-1 bg-white position-relative mt-1 resim-prev-wrap" style="height:29.5vh">
										<div class="resim-prev" style="height:28.3vh"></div>
									</div>										
								</div>
							</div>
						</div>
					</div>

					<div class="resim-ekle-wrap my-3 font-weight-bold" style="font-size: 16px">
						<i class="fas fa-images"></i> Blog Diğer Resimleri
					</div> 		

						@if( count($blog->resimler) == 0 || $blog->resimler == null )
							<div class="alert alert-danger d-flex align-items-center">
								<i class="fas fa-info-circle me-2"></i> Bloga diğer resim eklenmemiş			
							</div>

						@else
							<div class="alert alert-primary d-flex align-items-center">
								<i class="fas fa-info-circle me-2"></i>
								Resimleri sürükleyerek sırasını değiştirebilirsiniz			
							</div>

							<div class="row" id="sortable">
								@foreach($blog->resimler as $resim)
									@if( is_file('uploads/resim/blog/'.$resim->resim) )

										<div class="col-6 col-md-4 col-lg-3 sortable-wrap sortable" data-index="{{ $resim->id }}" data-sira="{{ $resim->sira }}">
											<div class="eski-resim-wrapper">
												<div class="erw-inside">
													<img src="{{ asset('uploads/resim/blog/'.$resim->resim) }}">
												</div>
											</div>
											<div class="text-center my-2">
												<button type="button" class="btn btn-danger blog-resim-sil px-2 py-0" data-bs-toggle="tooltip" data-placement="bottom" title="Sil" data-id="{{ $resim->id }}">
													<i class="far fa-trash-alt"></i>
												</button>
											</div> 
										</div>
									@else
										<div class="col-6 col-md-4 col-lg-3 sortable-wrap sortable" data-index="{{ $resim->id }}" data-sira="{{ $resim->sira }}">
											<div class="eski-resim-wrapper">
												<div class="erw-inside text-center">
													<img src="{{ asset('assets/panel/images/no-image.png') }}" style="height:100%; width:auto">
												</div>
											</div>
											<div class="text-center my-2">
												<button type="button" class="btn btn-danger blog-resim-sil px-2 py-0" data-bs-toggle="tooltip" data-placement="bottom" title="Sil" data-id="{{ $resim->id }}">
													<i class="far fa-trash-alt"></i>
												</button>
											</div> 
										</div>									
									@endif
								@endforeach
							</div>
						@endif	

					<div class="resim-content">

						<div class="alert alert-primary d-flex align-items-center">
							<i class="fas fa-info-circle me-2"></i> Önerilen resim boyutu 800px / 600px				
						</div>

						<div class="my-3">
							<div class="row mx-0">

								<div class="col-sm-6 col-md-4 col-xl-3 my-3 rprv-wrap"> 
									<input type="file" name="resim[]" class="add-image" accept="image/*">  
									<div class="p-1 bg-white position-relative mt-1 resim-prev-wrap w-100">
									<div class="resim-prev"></div></div>
									<button type="button" class="btn resim-kaldir text-danger" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Kaldır"><i class="fas fa-times-circle"></i></button>
								</div> 
								
								<div class="col-sm-6 col-md-4 col-xl-3 my-3 rprv-wrap"> 
									<input type="file" name="resim[]" class="add-image" accept="image/*">  
									<div class="p-1 bg-white position-relative mt-1 resim-prev-wrap w-100">
									<div class="resim-prev"></div></div>
									<button type="button" class="btn resim-kaldir text-danger" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Kaldır"><i class="fas fa-times-circle"></i></button>
								</div> 

								<div class="col-sm-6 col-md-4 col-xl-3 my-3 rprv-wrap"> 
									<input type="file" name="resim[]" class="add-image" accept="image/*">  
									<div class="p-1 bg-white position-relative mt-1 resim-prev-wrap w-100">
									<div class="resim-prev"></div></div>
									<button type="button" class="btn resim-kaldir text-danger" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Kaldır"><i class="fas fa-times-circle"></i></button>
								</div> 

								<div class="col-sm-6 col-md-4 col-xl-3 my-3 rprv-wrap"> 
									<input type="file" name="resim[]" class="add-image" accept="image/*">  
									<div class="p-1 bg-white position-relative mt-1 resim-prev-wrap w-100">
									<div class="resim-prev"></div></div>
									<button type="button" class="btn resim-kaldir text-danger" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Kaldır"><i class="fas fa-times-circle"></i></button>
								</div> 

								<div class="col-12 oncesine-ekle mt-3">
									<div class="alan-ekle btn btn-secondary" data-toggle="tooltip" data-bs-placement="right" title="Yeni resim ekleme alanı ekle"><i class="fas fa-plus"></i> Yeni Alan Ekle</div>
								</div>
							</div>
						</div>
					</div> 	
				</div><!-- ./end resim content -->

				<!-- video content ---------------------------------------------------------------------->
				<div class="tab-pane fade" id="pills-video" role="tabpanel" aria-labelledby="pills-video-tab">
					<div class="alert alert-primary d-flex align-items-center mt-5">
						<i class="fas fa-info-circle me-2"></i>
						Blog ile ilgili youtube'daki videonuzun linkini veya sitenize video dosyasını bu bölümden ekleyin
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
							<textarea name="video_link" class="form-control" rows="3">{{$blog->video_link}}</textarea>
						</div>
				
						<div class="tab-pane fade pb-5" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
						   <input type="file" name="video" class="form-control" accept="video/*">

						   <div class="my-4">
						   		@if(is_file("uploads/video/blog/".$blog->video))
								    
									<video width="320" height="240" controls>
										<source src="/uploads/video/blog/{{$blog->video}}" type="video/mp4">	
										<div class="alert alert-danger">
											Tarayıcınız video formatını desteklemiyor
										</div>
									</video> 
									<br>
									<button type="button" class="btn btn-danger video-sil my-2" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Sil" data-id="{{ $blog->id }}">
										<i class="far fa-trash-alt"></i>
									</button>
									 
								@endif
						   </div>
						</div>			
					</div>
				</div><!-- ./end video content ---------------------------------------------------------->

				<!-- seo content ------------------------------------------------------------------------>
				<div class="tab-pane fade" id="pills-seo" role="tabpanel" aria-labelledby="pills-seo-tab">
					<div class="form-group my-2">
						<label for="">Description : <small>(Opsiyonel)</small></label>
						<textarea name="description" class="form-control" rows="2">{{ $blog->description }}</textarea>
					</div>

					<div class="form-group my-2">
						<label for="">Keywords : <small>(Opsiyonel)</small></label>
						<textarea name="keywords" class="form-control" rows="2">{{ $blog->keywords }}</textarea>
					</div>
				</div><!-- ./end seo content ------------------------------------------------------------->

			</div><!-- ./endtab content ****************************************************************-->

			<button type="submit" class="btn btn-dark py-2 px-4 my-4">
				<span class="text-dark-50">
					<i class="fa fa-save"></i>
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

	//blog resmini sil --------------------------------------------------------
    $(".blog-resim-sil").on("click", function(){  

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
				
				var i =  $(".blog-resim-sil").index(this);
				var id = $(".blog-resim-sil").eq(i).data("id");

				$.ajax({
					type        : "post",
					url         : "{{ route('blog.resim.sil') }}",
					data        : {id:id},
							
					dataType    :'json',
					beforeSend: function() {
						$(".loading-wrapper").css("display","block");
					},          
					success : function(result){

						if( result.durum == "success"){
							$(".img-wrapper").remove();
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
	//---------------------------------------------------------------------------



	//blog düzenle --------------------------------------------------------------
	$("#blogDuzenleForm").submit(function(e){
		e.preventDefault();

		var baslik = $.trim( $("[name=baslik]").val() );

		if(baslik <= 0){
			Swal.fire({
				type: 'error', 
				text: 'Lütfen blog başlığını yazınız',
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
				url         :"{{ route('blog.duzenle.post') }}",
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
	//---------------------------------------------------------------------------- 


	//video sil ----------------------------------------------------------------
    $(".video-sil").on("click", function(){  

		Swal.fire({
				type: "warning",               
				text: "Video silinecek, devam edilsin mi?",          
				showCancelButton: true,
				confirmButtonColor: '#e44242',
				confirmButtonText: 'Sil',
				cancelButtonText: "Vazgeç",
				cancelButtonColor: '#333',              
		}).then((result) => {
			if (result.value) {
				
				var i =  $(".video-sil").index(this);
				var id = $(".video-sil").eq(i).data("id");

				$.ajax({
					type        : "post",
					url         : "{{ route('panel.blog.video.sil') }}",
					data        : {id:id},
							
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
	});
	//---------------------------------------------------------------------------


	
});
</script>
@endsection
