@extends('Panel.layouts.app')

@section('title','Hakkımızda')

@section('content')
<section class="section">
	<div class="container-fluid p-3">
		<!-- ========== title-wrapper start ========== -->
		<div class="title-wrapper">
			<div class="row">
			<div class="col-md-6">
				<h4>Hakkımızda</h4>
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
								Hakkımızda
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
	<form id="hakkimizdaForm">					

		<div class="form-group">			
			<textarea name="hakkimizda" class="editor">{{ $kurumsal->hakkimizda }}</textarea>
		</div>	
		<div class="my-3">
			<div style="width:200px; height:175px; padding: 5px; background: #fff; box-shadow:0 0 10px #666">
				@if(is_file("uploads/resim/hakkimizda/".$kurumsal->hakkimizda_resim))
					<img src="{{ asset('uploads/resim/hakkimizda/'.$kurumsal->hakkimizda_resim) }}" class="img-fluid" >
				@else
					<img src="{{ asset('assets/panel/images/no-image.png') }}" class="img-fluid" >
				@endif
			</div>
		</div>

		<div class="my-3"> 
			<label for="">Resmi Değiştir :</label>
			<input type="file" name="resim" id="resim" class="form-control add-image" accept="image/*">  
			<div class="p-1 bg-white position-relative mt-2 resim-prev-wrap">
				<div class="resim-prev" style="height:250px; width:300px"></div>
			</div>
		</div> 			        		

		<div class="row mx-0 mt-1 pb-4">                 
			<div class="col-lg-8  ps-lg-0 mt-3">
				<button type="submit" class="btn btn-dark py-2 px-4 font-weight-bold">
					<span class="text-dark-50">
						<i class="far fa-save"></i>
					</span>
					<span class="text">KAYDET</span>
				</button>
			</div>
		</div>
	</form>
				
</section>
@endsection

@section("customJs")
<script>
$(function(){ 

    //hakkımızda güncelle --------------------------------------------------------------
    $("#hakkimizdaForm").submit(function(e){
        e.preventDefault();
                   
            tinyMCE.triggerSave();
            var form_data = new FormData(this);

            $.ajax({
                type        : "post",
                url         : "{{ route('panel.hakkimizda.post') }}",
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
	
})
</script>
@endsection
