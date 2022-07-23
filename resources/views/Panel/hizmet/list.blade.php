@extends('Panel.layouts.app')

@section('title','Hizmet Listesi')

@section('content')

<!-- ========== section start ========== -->
<section class="section">
	<div class="container-fluid p-3">
		<!-- ========== title-wrapper start ========== -->
		<div class="title-wrapper">
			<div class="row">
			<div class="col-md-6">
				<h4>Hizmet Listesi</h4>
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
								Hizmet Listesi
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
	<a href="{{ route('panel.hizmet.ekle') }}" class="btn btn-secondary">
		<i class="fas fa-plus"></i> Hizmet Ekle
	</a>
	@if(count($hizmetler) == 0)
	<div class="alert alert-danger d-flex align-items-center mt-4" role="alert">
		<div class="me-3">
			<i class="fas fa-info-circle fa-2x"></i>
		</div>					  	
		  <div>
			  <div>Henüz hizmet eklenmemiş</div>
		</div>
	</div>
	@else
		<div class="d-flex justify-content-end mb-3">
			{{ $hizmetler->links('Panel.layouts.sayfalama.sayfalama') }}
		</div>

		<div class="table-responsive" style="min-width:700px">
			<table class="table table-bordered table-hover bg-white">
				<thead style="background: #777; color:#fff">
					<tr>
						<th scope="col" width="70" style="min-width:70px">Sıralama</th>
						<th scope="col" style="width:500px; min-width:300px">Hizmet Adı</th>	
						<th scope="col">Kategori</th>
						<th scope="col" width="70" style="min-width:70px">Aktif</th>
						<th scope="col" width="110" style="min-width:110px">İşlem</th>
					</tr>
				</thead>
				<tbody>
					@foreach($hizmetler as $hizmet)
						<tr>
							<td class="text-center">{{ $hizmet->sira }}</td>	
							<td>{{ $hizmet->baslik }}</td>	
							<td>{{ $hizmet->kategori->kategori_adi }}</td>
							<td class="text-center">
								@if($hizmet->aktif == 1)
									<i class="fas fa-check text-success"></i>
								@else 
									<i class="fas fa-times text-danger"></i>
								@endif
							</td>
							<td>
								<a href="{{ route('panel.hizmet.duzenle', ['slug' => $hizmet->slug]) }}" class="btn btn-primary" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Düzenle">
									<i class="fas fa-pencil-alt"></i>
								</a>
								<button class="btn btn-danger hizmet-sil" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Sil" data-id="{{ $hizmet->id }}">
									<i class="fas fa-trash-alt"></i>
								</button>
							</td>
						</tr>
					@endforeach								
				</tbody>
			</table>
		</div>
		<div class="d-flex justify-content-end my-3">
			{{ $hizmetler->links('Panel.layouts.sayfalama.sayfalama') }}
		</div>
	@endif
</section> 
@endsection

@section("customJs")
<script>
$(function(){

	//haber  sil ----------------------------------------------------------------
    $(".hizmet-sil").on("click", function(){                

	Swal.fire({
			type: "warning",               
			text: "Hizmet silinecek, devam edilsin mi?",          
			showCancelButton: true,
			confirmButtonColor: '#e44242',
			confirmButtonText: 'Sil',
			cancelButtonText: "Vazgeç",
			cancelButtonColor: '#333',              
	}).then((result) => {
		if (result.value) {

			var i  = $(".hizmet-sil").index(this);
			var id = $(".hizmet-sil").eq(i).data("id"); 

			$.ajax({
				type        : "post",
				url         : "{{ route('panel.hizmet.sil') }}",
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
