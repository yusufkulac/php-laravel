@extends('Panel.layouts.app')

@section('title','Neden Biz')

@section('content')
<section class="section">
	<div class="container-fluid p-3">
		<!-- ========== title-wrapper start ========== -->
		<div class="title-wrapper">
			<div class="row">
			<div class="col-md-6">
				<h4>Neden Biz?</h4>
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
								Neden Biz?
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

<section class="sayfa-icerik-kapsayici px-3">				
	<form id="nedenbizForm">
		<div class="form-group">			
			<textarea name="nedenbiz" class="editor">{!! $kurumsal->nedenbiz !!}</textarea>
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

    //hakkımızda güncelle --------------------------------------------------------------
    $("#nedenbizForm").submit(function(e){
        e.preventDefault();
                   
            tinyMCE.triggerSave();
            var form_data = new FormData(this);

            $.ajax({
                type        : "post",
                url         : "{{ route('panel.nedenbiz.post') }}",
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
    //----------------------------------------------------------------------------------
	
})
</script>
@endsection
