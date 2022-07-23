@extends('Panel.layouts.app')

@section('title','Bülten Mail List')

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
								Bülten Mail List
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
	@if (count($mailList) <= 0)
		<div class="alert alert-primary d-flex align-items-center" role="alert">
			<i class="fas fa-info-circle me-2"></i> Mail listesine kayıtlı e-posta yok
		</div> 
        @else
		<div class="table-responsive">
			<table class="table table-bordered table-hover bg-white" style="min-width:700px">
				<thead style="background: #777; color:#fff">
					<tr>                     
						<th scope="col" style="width:200px;min-width:200px;">E-Posta Adresi</th>
						<th scope="col" style="width:170px;min-width:170px;">Kayıt Tarih</th>
						<th scope="col" style="width:100px;min-width:100px;">İşlem</th>
					</tr>
				</thead>
				<tbody>
					@foreach($mailList as $value)						
						<tr>
							<td>{{ $value->mail }}</td>
							<td style="font-size: 12px;">
								<i class="far fa-calendar-alt text-muted"></i>
								{{ date("d-m-Y", strtotime($value->created_at)) }} &nbsp;
								<i class="far fa-clock text-muted"></i> 
								{{ date("H:i", strtotime($value->created_at)) }}
							</td>
							
							<td>
								<button type="button" class="btn btn-danger mail-sil" data-id={{ $value->id }}>
									<i class="far fa-trash-alt"></i>
								</button>                                 
							</td>
						</tr>						
					@endforeach                                
				</tbody>
			</table>
		</div>
		@endif

	<div class="d-flex justify-content-end my-3">
		{{ $mailList->links('Panel.layouts.sayfalama.sayfalama') }}
	</div>
</section>
 
@endsection


@section("customJs")
<script>
$(function(){

	//mail  sil ----------------------------------------------------------------
    $(".mail-sil").on("click", function(){                

		Swal.fire({
				type: "warning",               
				text: "E-Posta listeden kaldırılacak, devam edilsin mi?",          
				showCancelButton: true,
				confirmButtonColor: '#e44242',
				confirmButtonText: 'Sil',
				cancelButtonText: "Vazgeç",
				cancelButtonColor: '#333',              
		}).then((result) => {
			if (result.value) {

				var i  = $(".mail-sil").index(this);
				var id = $(".mail-sil").eq(i).data("id"); 

				$.ajax({
					type        : "post",
					url         : "{{ route('panel.mail.sil') }}",
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