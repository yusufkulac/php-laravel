@extends('Panel.layouts.app')

@section('title','Teklif Formu')

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
								Teklif Formu
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
	@if (count($teklifFormu) <= 0)
		<div class="alert alert-primary d-flex align-items-center" role="alert">
			<i class="fas fa-info-circle me-2"></i> Yeni teklif formu yok
		</div> 
       @else
		<div class="table-responsive">
			<table class="table table-bordered table-hover bg-white" style="min-width:700px">
				<thead style="background: #777; color:#fff">
					<tr>          
						<th scope="col">Ad Soyad</th>
						<th scope="col" style="width:180px; min-width:180px">Telefon</th> 
						<th scope="col" style="width:180px; min-width:180px">E-posta</th>
						<th scope="col" style="width:180px; min-width:180px">Tarih</th>
						<th scope="col" style="width:100px; min-width:100px">İşlem</th>
					</tr>
				</thead>
				<tbody>
					
					@foreach($teklifFormu as $mesaj)						
						<tr>
							<td>{{ $mesaj->adsoyad }}</td>                               
							<td>{{ $mesaj->telefon }}</td>
							<td>{{ $mesaj->mail }}</td>	
							<td style="font-size: 12px;">
								<i class="far fa-calendar-alt text-muted"></i>
								{{ date("d-m-Y", strtotime($mesaj->created_at)) }} &nbsp;
								<i class="far fa-clock text-muted"></i> 
								{{ date("H:i", strtotime($mesaj->created_at)) }}
							</td>
							
							<td class="text-center">
								<a href="{{ route("panel.teklif.formu.detay", ["id" => $mesaj->id]) }}" class="btn btn-primary">
									<i class="far fa-folder-open"></i>
									Aç
								</a>                                    
							</td>
						</tr>
						
					@endforeach                                
				</tbody>
			</table>
		</div>
		<div class="d-flex justify-content-end my-3">
			{{ $teklifFormu->links('Panel.layouts.sayfalama.sayfalama') }}
		</div>
	@endif
</section>
 
@endsection

@section("customJs")
@endsection
