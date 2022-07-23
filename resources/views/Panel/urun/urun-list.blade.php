@extends('Panel.layouts.app')

@section('title','Ürün Listesi')

@section('content')

<!-- ========== section start ========== -->
<section class="section">
	<div class="container-fluid p-3">
		<!-- ========== title-wrapper start ========== -->
		<div class="title-wrapper">
			<div class="row">
			<div class="col-md-6">
				<h4>Ürün Listesi</h4>
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
								Ürün Listesi
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
	@if(count($urunler) == 0)
	<div class="alert alert-danger d-flex align-items-center" role="alert">
		<div class="me-3">
			<i class="fas fa-info-circle"></i>
		</div>					  	
		  <div>
			  <div>Henüz ürün eklenmemiş</div>
		</div>
	</div>
	@else
		<div class="d-flex justify-content-end my-3">
			{{ $urunler->links('Panel.layouts.sayfalama.sayfalama') }}
		</div>

		<div class="table-responsive">
			<table class="table table-bordered table-hover bg-white">
				<thead style="background: #777; color:#fff">
					<tr>
						<th scope="col" width="70">S. No</th>
						<th scope="col">Ürün Adı</th>
						<th scope="col" width="250">Kategorisi</th>
						<th scope="col" width="130">İşlem</th>
					</tr>
				</thead>
				<tbody>
					@php($i=1)
					@foreach($urunler as $urun)

						<tr>
							<td>{{ $i }}</td>
							<td>{{ $urun->urun_adi }}</td>
							
							<td>
								@isset($urun->kategori->kategori_adi)
									{{$urun->kategori->kategori_adi}}
								@else
									Kategori Yok
								@endif
							</td>
							<td>
								<a href="{{ route('panel.urun.duzenle', ['slug' => $urun->slug]) }}" class="btn btn-primary" data-toggle="tooltip" data-bs-placement="bottom" title="Düzenle">
									<i class="fas fa-pencil-alt"></i>
								</a>
								<button class="btn btn-danger urun-sil" data-toggle="tooltip" data-bs-placement="bottom" title="Sil" data-id="{{ $urun->id }}">
									<i class="fas fa-trash-alt"></i>
								</button>
							</td>
						</tr>

					@php($i++)
					@endforeach								
				</tbody>
			</table>
		</div>

		<div class="d-flex justify-content-end my-3">
			{{ $urunler->links('Panel.layouts.sayfalama.sayfalama') }}
		</div>
	@endif
</section> 
@endsection

@section("customJs")
<script>
$(function(){

	//haber  sil ----------------------------------------------------------------
    $(".urun-sil").on("click", function(){                

		Swal.fire({
				type: "warning",               
				text: "Ürün silinecek, devam edilsin mi?",          
				showCancelButton: true,
				confirmButtonColor: '#e44242',
				confirmButtonText: 'Sil',
				cancelButtonText: "Vazgeç",
				cancelButtonColor: '#333',              
		}).then((result) => {
			if (result.value) {

				var i  = $(".urun-sil").index(this);
				var id = $(".urun-sil").eq(i).data("id"); 

				$.ajax({
					type        : "post",
					url         : "{{ route('panel.urun.sil') }}",
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
