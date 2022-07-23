@extends('Panel.layouts.app')

@section('title','Resim Galeri Kategori listesi')

@section('content')
<!-- ========== section start ========== -->
<section class="section">
	<div class="container-fluid p-3">
		<!-- ========== title-wrapper start ========== -->
		<div class="title-wrapper">
			<div class="row">
			<div class="col-md-6">
				<h4>Resim Galeri Kategori Listesi</h4>
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
								Resim Galeri Kategori Listesi
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
	<a href="{{ route("panel.rg.kategori.ekle") }}" class="btn btn-secondary my-3">
		<i class="fas fa-plus"></i> Kategori Ekle
	</a>
	@if(count($kategoriler) == 0)
		<div class="alert alert-danger my-3">
			<i class="fas fa-info-circle"></i> Henüz kategori eklenmemiş
		</div>
	@else

		<div class="table-responsive">
			<table class="table table-bordered table-hover bg-white" style="min-width:700px">
				<thead style="background: #777; color:#fff">
					<tr>
						<th scope="col" style="width:70px;min-width:70px;">S. No</th>                       
						<th scope="col" style="width:80px;min-width:80px;">Resim</th>
						<th scope="col">Kategori Adı</th> 
						<th scope="col" style="width:120px;min-width:120px;">Resim Sayısı</th>
						<th scope="col" style="width:140px;min-width:140px;">Resimler</th>
						<th scope="col" style="width:100px;min-width:100px;">Resim Ekle</th>
						<th scope="col" style="width:10px;min-width:100px;">İşlem</th>
					</tr>
				</thead>
				<tbody>
					@php($i=1)
					@foreach($kategoriler as $kategori)						
						<tr>
							<td>{{ $i }}</td>
							<td>
								@if(is_file('uploads/resim/galeri/'.$kategori->resim))
									<img src="{{ asset('uploads/resim/galeri/'.$kategori->resim) }}" class="kat-list-img">
								@else
									<img src="{{ asset('assets/panel/images/no-image.png') }}" class="kat-list-img">
								@endif
							</td>                               
							<td>{{ $kategori->galeri_adi }}</td>
							<td class="text-center">
								@if(isset($kategori->resimler))
									{{ count($kategori->resimler) }}
								@else
								<span>0</span>
								@endif
							</td>

							<td class="text-center">
								<a href="{{ route('panel.rg.resimlist', ['id'=>$kategori->id]) }}" class="btn btn-warning">
									<i class="fas fa-images"></i> Resimler
								</a>
							</td>

							<td class="text-center">
								<a href="{{ route('panel.rg.resim.ekle', ['id'=>$kategori->id]) }}" class="btn btn-dark">
									<i class="fas fa-plus"></i> Ekle
								</a>
							</td>
							<td>
								<a href="{{ route("panel.rg.kategori.duzenle", ["id" => $kategori->id]) }}" class="btn btn-primary" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Düzenle">
									<i class="fas fa-pencil-alt"></i>
								</a>  
								<button class="btn btn-danger kategori-sil" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Sil" data-id="{{ $kategori->id }}">
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
			{{ $kategoriler->links('Panel.layouts.sayfalama.sayfalama') }}
		</div>

    @endif
</section>
@endsection

@section("customJs")
<script>
$(function(){

	//galeri kategori  sil ----------------------------------------------------------------
    $(".kategori-sil").on("click", function(){                

		Swal.fire({
				type: "warning",               
				text: "Galeri ve bütün resimeri silinecek, devam edilsin mi?",          
				showCancelButton: true,
				confirmButtonColor: '#e44242',
				confirmButtonText: 'Sil',
				cancelButtonText: "Vazgeç",
				cancelButtonColor: '#333',              
		}).then((result) => {
			if (result.value) {

				var i  = $(".kategori-sil").index(this);
				var id = $(".kategori-sil").eq(i).data("id"); 

				$.ajax({
					type        : "post",
					url         : "{{ route('panel.rg.kategori.sil') }}",
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
								window.location.href = "{{ route('panel.rg.kategori.list') }}";
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
 
		
})
</script>
@endsection
