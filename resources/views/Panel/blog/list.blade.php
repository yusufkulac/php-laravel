@extends('Panel.layouts.app')

@section('title','Blog Listesi')

@section('content')

<!-- ========== section start ========== -->
<section class="section">
	<div class="container-fluid p-3">
		<!-- ========== title-wrapper start ========== -->
		<div class="title-wrapper">
			<div class="row">
			<div class="col-md-6">
				<h4>Blog Listesi</h4>
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
								Blog Listesi
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
	@if(count($bloglar) == 0)
	<div class="alert alert-danger d-flex align-items-center" role="alert">
		<div class="me-3">
			<i class="fas fa-info-circle fa-2x"></i>
		</div>					  	
		  <div>
			  <div>Henüz blog eklenmemiş</div>
		</div>
	</div>
@else
	<div class="d-flex justify-content-end my-3">
		{{ $bloglar->links('Panel.layouts.sayfalama.sayfalama') }}
	</div>

	<div class="table-responsive">
		<table class="table table-bordered table-hover bg-white" style="min-width:700px">
			<thead style="background: #777; color:#fff">
				<tr>
					<th scope="col" style="width:70px; min-width:70px">S. No</th>
					<th scope="col">Başlık</th>
					<th scope="col" style="width:140px; min-width:140px">Tarih</th>
					<th scope="col" style="width:110px; min-width:110px">İşlem</th>
				</tr>
			</thead>
			<tbody>
				@php($i=1)
				@foreach($bloglar as $blog)

					<tr>
						<td>{{ $i }}</td>
						<td>{{ $blog->baslik }}</td>
						
						<td>{{ date("d-m-Y H:i", strtotime($blog->created_at) ) }}</td>
						<td class="text-center">
							<a href="{{ route('panel.blog.duzenle', ['slug' => $blog->slug]) }}" class="btn btn-primary" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Düzenle">
								<i class="fas fa-pen"></i>
							</a>
							<button class="btn btn-danger blog-sil" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Sil" data-id="{{ $blog->id }}">
								<i class="far fa-trash-alt"></i>
							</button>
						</td>
					</tr>

				@php($i++)
				@endforeach								
			</tbody>
		</table>
	</div>

	<div class="d-flex justify-content-end my-3">
		{{ $bloglar->links('Panel.layouts.sayfalama.sayfalama') }}
	</div>
@endif
</section> 
@endsection

@section("customJs")
<script>
	$(function(){
	
		//blog  sil ----------------------------------------------------------------
		$(".blog-sil").on("click", function(){                
	
			Swal.fire({
					type: "warning",               
					text: "Blog silinecek, devam edilsin mi?",          
					showCancelButton: true,
					confirmButtonColor: '#e44242',
					confirmButtonText: 'Sil',
					cancelButtonText: "Vazgeç",
					cancelButtonColor: '#333',              
			}).then((result) => {
				if (result.value) {
	
					var i  = $(".blog-sil").index(this);
					var id = $(".blog-sil").eq(i).data("id"); 
	
					$.ajax({
						type        : "post",
						url         : "{{ route('panel.blog.sil') }}",
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
