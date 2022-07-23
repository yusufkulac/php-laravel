@extends('Panel.layouts.app')

@section('title','Sıkça Sorulan Soru Düzenle')

@section('content')

<!-- ========== section start ========== -->
<section class="section">
	<div class="container-fluid p-3">
		<!-- ========== title-wrapper start ========== -->
		<div class="title-wrapper">
			<div class="row">
			<div class="col-md-6">
				<h4>Sıkça Sorulan Soru Düzenle</h4>
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
								Sıkça Sorulan Soru Düzenle
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

	@if($sss == null)
	<div class="alert alert-danger">
		<i class="fas fa-info-circle me-2"></i>
		Sıkça sorulan soru bulunamadı
	</div>
	@else
	<form id="sssDuzenleForm">                                      
		<input type="hidden" name="id" value="{{ $sss->id }}">

		<div class="form-group my-3">
			<label for="">Dil:</label>
			<select name="dil_id" class="form-control">				
				@foreach ($diller as $dil)
					<option value="{{ $dil->id }}" @if($dil->id == $sss->dil_id) selected @endif>
						{{ $dil->dil_adi }}
					</option>
				@endforeach
			</select>
		</div>

		<div class="form-group my-3">
			<label for="">Sıra No :</label>
			<input type="text" name="sira" class="form-control" value="{{ $sss->sira }}">
		</div>

		<div class="form-group my-3">
			<label for="">Soru :</label>
			<input type="text" name="soru" class="form-control" value="{{ $sss->soru }}">
		</div>

		<div class="form-group my-3">
			<label for="">Cevap :</label>
			<textarea name="cevap" class="editor-small">{{ $sss->cevap }}</textarea>
		</div>	
		
		<div class="form-group my-3">
			<label for="">Aktif :</label>
			<select name="aktif" class="form-control">
				<option value="1" @if($sss->aktif == 1) selected @endif>Aktif</option>
				<option value="0" @if($sss->aktif == 0) selected @endif>Pasif</option>
			</select>
		</div>

		<div class="row mx-0 mt-1 pb-4">                 
			<div class="col-lg-8  ps-lg-0 mt-3">
				<button type="submit" class="btn btn-dark py-2 px-4 font-weight-bold">
					<span class="text-dark-50">
					<i class="fa fa-save"></i>
					</span>
					<span class="text">GÜNCELLE</span>
				</button>
			</div>
		</div>
	</form>
	@endif

</section> 
@endsection

@section("customJs")
<script>
$(function(){

	 //s.s.s düzenle --------------------------------------------------------------
	 $("#sssDuzenleForm").submit(function(e){
        e.preventDefault();

        var sira = $.trim( $("[name=sira]").val() );
		var soru = $.trim( $("[name=soru]").val() );  
		var cevap = $.trim( $("[name=cevap]").val() );        

        if(sira.length == 0 ){
            Swal.fire({
                type: 'error', 
                text: 'Lütfen soru numarasını yazın',
                confirmButtonText: 'Tamam',
                confirmButtonColor: '#333'
            }).then(function(){
                $("[name=sira]").addClass("border-red");
                //$("html, body").animate({ scrollTop: 100 }, "500");
                 return false;
            });         
            return false;
        }else if(soru.length == 0 ){
            Swal.fire({
                type: 'error', 
                text: 'Lütfen soruyu yazın',
                confirmButtonText: 'Tamam',
                confirmButtonColor: '#333'
            }).then(function(){
                $("[name=soru]").addClass("border-red");
                //$("html, body").animate({ scrollTop: 100 }, "500");
                 return false;
            });         
            return false;
        }else if(cevap.length == 0 ){
            Swal.fire({
                type: 'error', 
                text: 'Lütfen sorunun cevabını yazın',
                confirmButtonText: 'Tamam',
                confirmButtonColor: '#333'
            }).then(function(){
                $("[name=cevap]").addClass("border-red");
                //$("html, body").animate({ scrollTop: 100 }, "500");
                 return false;
            });         
            return false;
        }else{              
            tinyMCE.triggerSave();
            var form_data = new FormData(this);

            $.ajax({
                type        : "post",
                url         :"{{ route('panel.sss.duzenle.post') }}",
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
        }        
    });  
    //--------------------------------------------------------------------------

	
});
</script>
@endsection
