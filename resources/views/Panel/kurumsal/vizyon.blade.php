@extends('Panel.layouts.app')

@section('title','Vizyon & Misyon')

@section('content')
<section class="section">
	<div class="container-fluid p-3">
		<!-- ========== title-wrapper start ========== -->
		<div class="title-wrapper">
			<div class="row">
			<div class="col-md-6">
				<h4>Vizyon & Misyon</h4>
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
								Vizyon & Misyon
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
	<form id="vizyonForm">	
		<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
			<li class="nav-item" role="presentation">
			  <button class="nav-link tab-header active" id="bilgiler" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Vizyon</button>
			</li>
			<li class="nav-item" role="presentation">
			  <button class="nav-link tab-header" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Misyon</button>
			</li>			
		</ul>	

		<div class="tab-content" id="pills-tabContent">
			<div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="bilgiler">
		        <textarea name="vizyon" class="editor">{{ $kurumsal->vizyon }}</textarea>
			</div>
	
			<div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
		        <textarea name="misyon" class="editor">{{ $kurumsal->misyon }}</textarea>
			</div>			
		</div>   		

		<div class="row mx-0 mt-1 pb-4">                 
            <div class="col-lg-8 ps-lg-0 mt-3">
                <button type="submit" class="btn btn-dark py-2" id="btnBilgiKaydet">
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

    //vizyon misyon güncelle --------------------------------------------------------------
    $("#vizyonForm").submit(function(e){
        e.preventDefault();
                   
            tinyMCE.triggerSave();
            var form_data = new FormData(this);

            $.ajax({
                type        : "post",
                url         : "{{ route('panel.vizyon.post') }}",
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
