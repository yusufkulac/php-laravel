@extends('Panel.layouts.app')

@section('title','Başvuru Detay')

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
								<a href="#0">İnsan Kaynakları</a>
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
	@if($basvuru == null)
		<div class="alert alert-danger">
			<i class="fas fa-info-circle fa-2x me-2"></i>
			Başvuru bulunamadı
		</div>
	@else
	<div class="card">
		<div class="card-body">
			<div class="row my-2">
				<div class="col-md-2">Adı Soyadı</div>
				<div class="col-md-10">: {{ $basvuru->adi." ".$basvuru->soyadi}}</div>
			</div>
			<div class="row my-2">
				<div class="col-md-2">Telefon</div>
				<div class="col-md-10">: {{ $basvuru->telefon }}</div>
			</div>
			<div class="row my-2">
				<div class="col-md-2">E-Posta</div>
				<div class="col-md-10">: {{ $basvuru->mail }}</div>
			</div>
			<div class="row my-2">
				<div class="col-md-2">İkamet İli</div>
				<div class="col-md-10">: {{ $basvuru->ikamet_il }}</div>
			</div>
			<div class="row my-2">
				<div class="col-md-2">Başvuru Bölümü</div>
				<div class="col-md-10">: {{ $basvuru->basvuru_Bolum }}</div>
			</div>
			<div class="row my-2">
				<div class="col-md-2">Tarih</div>
				<div class="col-md-10">: 
					{{ date("d-m-Y", strtotime($basvuru->tarih)) }} 
					<i class="lni lni-alarm-clock ms-2"></i>  
					{{ date("H:i", strtotime($basvuru->tarih)) }}
				</div>
			</div>
			<div class="row my-2">
				<div class="col-md-2">İp No</div>
				<div class="col-md-10">: {{ $basvuru->ipno }}</div>
			</div>
			<div class="row my-2">
				<div class="col-md-2">Cv</div>
				<div class="col-md-10">: 
					@if(is_file("uploads/dosya/ik/".$basvuru->cv_dosya))
						<a href="{{ asset("uploads/dosya/ik/".$basvuru->cv_dosya) }}" target="_blank">
							<span style="font-weight: bold; color:#000">{{ $basvuru->cv_dosya }}</span>
						</a>
					@else
						<span>Cv eklenmemiş</span>
					@endif
				</div>
			</div>
			<div class="row my-2 me-2">
				<div class="col-md-12">Mesaj :</div>
				<div class="col-md-12 bg-muted border-muted p-3 mt-2 ms-2">{{ $basvuru->mesaj }}</div>
			</div>

			<button class="btn btn-danger my-4 basvuru-sil me-2" data-id="{{ $basvuru->id }}">
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
	
		//başvuru  sil ----------------------------------------------------------------
		$(".basvuru-sil").on("click", function(){ 
			Swal.fire({
					type: "warning",               
					text: "Başvuru silinecek, devam edilsin mi?",          
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
						url         : "{{ route('panel.basvuru.sil') }}",
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
								   window.location.href = "{{ route('panel.basvuru.list') }}"
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
