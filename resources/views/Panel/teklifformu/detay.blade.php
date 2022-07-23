@extends('Panel.layouts.app')

@section('title','Teklif Formu Detay')

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

<section class="sayfa-icerik-kapsayici px-3">
	@if($teklifFormu == null)
		<div class="alert alert-danger">
			<i class="lni lni-warning me-2 fw-bold" style="font-size: 20px"></i>
			Teklif Formu bulunamadı
		</div>
	@else
	<div class="card">
		<div class="card-body">
			<div class="row my-2">
				<div class="col-md-2">Adı Soyadı</div>
				<div class="col-md-10">: {{ $teklifFormu->adsoyad }}</div>
			</div>
			<div class="row my-2">
				<div class="col-md-2">Telefon</div>
				<div class="col-md-10">: {{ $teklifFormu->telefon }}</div>
			</div>
			<div class="row my-2">
				<div class="col-md-2">E-Posta</div>
				<div class="col-md-10">: {{ $teklifFormu->mail }}</div>
			</div>
			<div class="row my-2">
				<div class="col-md-2">Tarih</div>
				<div class="col-md-10">: 
					{{ date("d-m-Y", strtotime($teklifFormu->tarih)) }} 
					<i class="lni lni-alarm-clock ms-2"></i>  
					{{ date("H:i", strtotime($teklifFormu->tarih)) }}
				</div>
			</div>
			<div class="row my-2">
				<div class="col-md-2">İp No</div>
				<div class="col-md-10">: {{ $teklifFormu->ipno }}</div>
			</div>		
			<div class="row my-2 me-2">
				<div class="col-md-12">Açıklama :</div>
				<div class="col-md-12 bg-muted border-muted p-3 mt-2 ms-2">{{ $teklifFormu->aciklama }}</div>
			</div>

			<button class="btn btn-danger my-4 teklif-formu-sil me-2" data-id="{{ $teklifFormu->id }}">
				<i class="far fa-trash-alt"></i> Sil
			</button>			
		</div>
	</div>
	@endif
		
</section>
 
@endsection

@section("customJs")
<script>
	$(function(){
	
		//teklif formu  sil ----------------------------------------------------------------
		$(".teklif-formu-sil").on("click", function(){ 
			Swal.fire({
					type: "warning",               
					text: "Teklif Formu silinecek, devam edilsin mi?",          
					showCancelButton: true,
					confirmButtonColor: '#e44242',
					confirmButtonText: 'Sil',
					cancelButtonText: "Vazgeç",
					cancelButtonColor: '#333',              
			}).then((result) => {
				if (result.value) {
				   
					var id = $(this).data("id"); 
	
					$.ajax({
						type        : "post",
						url         : "{{ route('panel.teklif.formu.sil') }}",
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
								   window.location.href = "{{ route('panel.teklif.formu') }}"
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
	
	
		//mesaj  yayınla ----------------------------------------------------------------
		$(".mesaj-yayinla").on("click", function(){                
	
			Swal.fire({
					type: "warning",               
					text: "Mesaj sizden gelenler bölümünde yayınlanacak, devam edilsin mi?",          
					showCancelButton: true,
					confirmButtonColor: '#17a2b8',
					confirmButtonText: 'Yayınla',
					cancelButtonText: "Vazgeç",
					cancelButtonColor: '#333',              
			}).then((result) => {
				if (result.value) {
				
					var id = $(this).data("id");                
	
					$.ajax({
						type        : "post",
						url         : "{{ route('panel.mesaj.yayinla.post') }}",
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
	
	
		//mesaj  yayın kaldır ----------------------------------------------------------------
		$(".mesaj-yayin-kaldir").on("click", function(){                
	
			Swal.fire({
					type: "warning",               
					text: "Mesaj sizden gelenler bölümünden kaldırılacak, devam edilsin mi?",          
					showCancelButton: true,
					confirmButtonColor: '#17a2b8',
					confirmButtonText: 'Kaldır',
					cancelButtonText: "Vazgeç",
					cancelButtonColor: '#333',              
			}).then((result) => {
				if (result.value) {
				
					var id = $(this).data("id");                
	
					$.ajax({
						type        : "post",
						url         : "{{ route('panel.mesaj.yayin.kaldir.post') }}",
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
