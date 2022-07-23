@extends('Panel.layouts.app')

@section('title','Kullanıcı Detay')

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
								<a href="#0">Kullanıcı Detay</a>
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
	@if($user == null)
		<div class="alert alert-danger">
			<i class="fas fa-info-circle fa-2x me-2"></i>
			Kullanıcı bulunamadı
		</div>
	@else
	<div class="card">
		<div class="card-body">
			<form id="userForm">
				<input type="hidden" name="id" value="{{ $user->id }}">
				<div class="form-group my-3">
					<label for="">Kullanıcı Adı:</label>
					<input type="text" name="name" class="form-control" value="{{ $user->name }}" disabled>
				</div>

				<div class="form-group my-3">
					<label for="">E-Posta:</label>
					<input type="text" name="email" class="form-control" value="{{ $user->email }}" disabled>
				</div>

				<div class="form-group my-3">
					<label for="">Parola:</label>
					<input type="password" class="form-control" name="password">
				</div>

				<div class="form-group my-3">
					<label for="">Parola Tekrar:</label>
					<input type="password"class="form-control" name="password2">
				</div>

				<div class="d-flex">
					<button type="submit" class="btn btn-dark my-4 me-5">
						<i class="far fa-save"></i> KAYDET
					</button>

					<button type="button" class="btn btn-danger my-4 kullanici-sil" data-id="{{ $user->id }}">
						<i class="far fa-trash-alt"></i> Sil
					</button>
				</div>					
			</form>		
		</div>
	</div>
	@endif
		
</section>
 
@endsection

@section("customJs")
<script>
$(function(){

	//kullanıcı  sil ----------------------------------------------------------------
	$(".kullanici-sil").on("click", function(){ 
		Swal.fire({
				type: "warning",               
				text: "Kullanıcı silinecek, devam edilsin mi?",          
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
					url         : "{{ route('panel.kullanici.sil') }}",
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
							   window.location.href = "{{ route('panel.kullanici.list') }}"
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
	//-------------------------------------------------------------------------------


	//kullanıcı güncelle --------------------------------------------------------------
    $("#userForm").submit(function(e){
        e.preventDefault();     
          
        var form_data = new FormData(this);

        $.ajax({
            type        : "post",
            url         : "{{ route('panel.kullanici.duzenle.post') }}",
            data        : form_data,
            contentType : false,            
            processData : false,            
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
               
    });  
    //--------------------------------------------------------------------------


			
});
</script>
@endsection
