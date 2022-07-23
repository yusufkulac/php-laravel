@extends('Panel.layouts.app')

@section('title','Mesajlar')

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
								Mesajlar
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
	@if (count($mesajlar) <= 0)
		<div class="alert alert-primary d-flex align-items-center" role="alert">
			<i class="fas fa-info-circle me-2"></i> Yeni mesaj yok
		</div> 
        @else
		<div class="table-responsive">
			<table class="table table-bordered table-hover bg-white" style="min-width:700px">
				<thead style="background: #777; color:#fff">
					<tr>
						<th scope="col" style="width:70px;min-width:70px;">S. No</th>                       
						<th scope="col" style="width:200px;min-width:200px;">Ad Soyad</th>
						<th scope="col">Konu</th> 
						<th scope="col" style="width:100px;min-width:100px;">Okundu</th>
						<th scope="col" style="width:170px;min-width:170px;">Tarih</th>
						<th scope="col" style="width:100px;min-width:100px;">İşlem</th>
					</tr>
				</thead>
				<tbody>
					@php($i=1)
					@foreach($mesajlar as $mesaj)						
						<tr>
							<td>{{ $i }}</td>
							<td>{{ $mesaj->adsoyad }}</td>                               
							<td>{{ $mesaj->konu }}</td>
							<td class="text-center">
								@if($mesaj->okundu == 1)
									<i class="far fa-check text-success fw-bold"></i>
								@else
								<i class="far fa-times text-danger fw-bold"></i>
								@endif
							</td>							
							<td style="font-size: 12px;">
								<i class="far fa-calendar-alt text-muted"></i>
								{{ date("d-m-Y", strtotime($mesaj->created_at)) }} &nbsp;
								<i class="far fa-clock text-muted"></i> 
								{{ date("H:i", strtotime($mesaj->created_at)) }}
							</td>
							
							<td>
								<a href="{{ route("panel.mesaj.detay", ["id" => $mesaj->id]) }}" class="btn btn-primary">
									<i class="far fa-folder-open"></i>
									Aç
								</a>                                    
							</td>
						</tr>
						@php($i++)
					@endforeach                                
				</tbody>
			</table>
		</div>
		@endif

	<div class="d-flex justify-content-end my-3">
		{{ $mesajlar->links('Panel.layouts.sayfalama.sayfalama') }}
	</div>
</section>
 
@endsection

@section("customJs")
@endsection
