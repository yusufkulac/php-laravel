@extends('Panel.layouts.app')

@section('title','Kullanıcılar')

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
								Kullanıcılar
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
	@if (count($users) <= 0)
		<div class="alert alert-primary d-flex align-items-center" role="alert">
			<i class="fas fa-info-circle me-2"></i> Henüz kullanıcı kaydedilmemiş
		</div> 
        @else
		<div class="table-responsive">
			<table class="table table-bordered table-hover bg-white" style="min-width:700px">
				<thead style="background: #777; color:#fff">
					<tr>
						<th scope="col" style="width:70px;min-width:70px;">S. No</th>                       
						<th scope="col">Kullanıcı Adı</th>
						<th scope="col" style="width:300px;min-width:300px;">E-Posta</th> 						
						<th scope="col" style="width:100px;min-width:100px;">İşlem</th>
					</tr>
				</thead>
				<tbody>
					@php($i=1)
					@foreach($users as $user)						
						<tr>
							<td>{{ $i }}</td>
							<td>{{ $user->name }}</td>                               
							<td>{{ $user->email }}</td>	
							<td>
								<a href="{{ route('panel.kullanici.duzenle', ['id' => $user->id]) }}" class="btn btn-primary" data-toggle="tooltip" data-bs-placement="bottom" title="Düzenle">
									<i class="fas fa-pencil-alt"></i>
								</a>                                 
							</td>
						</tr>
						@php($i++)
					@endforeach                                
				</tbody>
			</table>
		</div>
		@endif
</section>
 
@endsection

