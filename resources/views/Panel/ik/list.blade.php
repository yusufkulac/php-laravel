@extends('Panel.layouts.app')

@section('title','İnsan Kaynakları')

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
								İnsan Kaynakları
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
	@if (count($basvurular) <= 0)
		<div class="alert alert-primary d-flex align-items-center" role="alert">
			<i class="fas fa-info-circle me-2"></i> Yeni basvuru yok
		</div> 
        @else
		<div class="table-responsive">
			<table class="table table-bordered table-hover bg-white" style="min-width:700px">
				<thead style="background: #777; color:#fff">
					<tr>
						<th scope="col" style="width:70px;min-width:70px;">S. No</th>                       
						<th scope="col">Ad Soyad</th>
						<th scope="col" style="width:250px;min-width:250px;">Başvurduğu Bölüm</th> 
						<th scope="col" style="width:100px;min-width:100px;">Görüldü</th>
						<th scope="col" style="width:170px;min-width:170px;">Tarih</th>
						<th scope="col" style="width:10px;min-width:100px;">İşlem</th>
					</tr>
				</thead>
				<tbody>
					@php($i=1)
					@foreach($basvurular as $basvuru)						
						<tr>
							<td>{{ $i }}</td>
							<td>{{ $basvuru->adi." ".$basvuru->soyadi }}</td>                               
							<td>{{ $basvuru->basvuru_bolum }}</td>
							<td class="text-center">
								@if($basvuru->okundu == 1)
									<i class="far fa-check text-success fw-bold"></i>
								@else
								<i class="far fa-times text-danger fw-bold"></i>
								@endif
							</td>

							<td style="font-size: 12px;">
								<i class="far fa-calendar-alt text-muted"></i>
								{{ date("d-m-Y", strtotime($basvuru->created_at)) }} &nbsp;
								<i class="far fa-clock text-muted"></i> 
								{{ date("H:i", strtotime($basvuru->created_at)) }}
							</td>						
							
							<td>
								<a href="{{ route("panel.basvuru.detay", ["id" => $basvuru->id]) }}" class="btn btn-primary">
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
		{{ $basvurular->links('Panel.layouts.sayfalama.sayfalama') }}
	</div>
</section>
 
@endsection

