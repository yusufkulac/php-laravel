<!DOCTYPE html>
<html lang="tr">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">	
	<meta name="description" content="@yield('description', $siteBilgi->description)">
    <meta name="keywords" content="@yield('keywords', $siteBilgi->keyword)">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<link rel="shortcut icon" href="{{ asset('assets/site/img/favicon.png')}}">
	<link rel="author" href="yusuf kulaç">
	<title>@yield('title', 'Giriş')</title>
	
	<link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css')}}">
	<link rel="stylesheet" href="{{ asset('assets/css/all.min.css')}}">	
	<link rel="stylesheet" href="{{ asset('assets/css/sweetalert2.min.css')}}">	
	<!-- -->
	<link rel="stylesheet" href="{{ asset('assets/site/css/fonts.css')}}">
	<link rel="stylesheet" href="{{ asset('assets/site/css/reset.css')}}">		
	<link rel="stylesheet" href="{{ asset('assets/site/css/login.css')}}">	
</head>
<body>
	<div class="loading-wrapper">
		<i class="fas fa-spinner fa-spin fa-4x"></i>
	</div>

	<div class="col-11 mx-auto col-md-6 col-lg-4  k">
		<div class="login-wrapper">
			<div class="login-header p-4">
				<h4><i class="fas fa-sign-in-alt"></i> Giriş</h4>
			</div>
			<div class="login-body p-4">
				<form id="girisForm">
					@csrf			
					<div class="form-group my-3">
						<div class="input-wrapper d-flex">
							<div class="lw-left pt-1">
								<i class="far fa-user"></i>
							</div>
							<input type="text" name="kullanici_adi" class="form-control" placeholder="Kullanıcı Adı">
						</div>
					</div>

					<div class="form-group my-3">
						<div class="input-wrapper d-flex">
							<div class="lw-left pt-1">
								<i class="fas fa-unlock-alt"></i>
							</div>
							<input type="password" name="password" class="form-control" placeholder="Parola">
							<div class="eye-wrap">
								<i class="far fa-eye-slash"></i>
							</div>
						</div>
					</div>

					<div class="form-group my-3">
						<input type="checkbox" name="hatirla" id="hatirla">
						<label for="hatirla">Beni hatırla</label>
					</div>

					<div type="submit" class="form-group my-3">
						<button class="btn btn-dark">GİRİŞ YAP</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	

<script src="{{asset('assets/js/jquery.3.6.0.js')}}"></script>
<script src="{{asset('assets/js/sweetalert2.all.min.js')}}"></script>
<script>
$(function(){

	$(".eye-wrap").on("click", function(){
		if( $(".eye-wrap i").hasClass("far fa-eye-slash") ){
			$(".eye-wrap i").removeClass("far fa-eye-slash");
			$(".eye-wrap i").addClass("far fa-eye");
			$("[name=password]").attr("type", "text");
			
		}else{
			$(".eye-wrap i").removeClass("far fa-eye");
			$(".eye-wrap i").addClass("far fa-eye-slash");
			$("[name=password]").attr("type", "password");
		}
	});

	$("input").keypress(function(){
		var i = $("input").index(this);
		$(".input-wrapper").eq(i).removeClass("border-red");
	});

	$("input").change(function(){
		var i = $("input").index(this);
		$(".input-wrapper").eq(i).removeClass("border-red");
	});

	//---------------------------------------------------------------------------
	$("#girisForm").submit(function(e){
		
		e.preventDefault();

		var kullanici_adi = $.trim( $("[name=kullanici_adi]").val()  );
		var password = $.trim( $("[name=password]").val()  );

		if(kullanici_adi.length < 1){
			Swal.fire({
                type: 'error', 
                text: "Kullanıcı adını yazın",
                confirmButtonText: 'Tamam',
                confirmButtonColor: '#333'
            }).then(function(){
                $(".input-wrapper").eq(0).addClass("border-red");
                return false;
            });         
            return false;
		}else if(password.length < 1){
			Swal.fire({
                type: 'error', 
                text: "Şifrenizi yazın",
                confirmButtonText: 'Tamam',
                confirmButtonColor: '#333'
            }).then(function(){
                $(".input-wrapper").eq(0).addClass("border-red");
                return false;
            });         
            return false;
		}else{

			var form_data = new FormData(this);

			 $.ajax({
                type        : "post",
                url         : "{{ route('site.giris.kontrol') }}",
                data        : form_data,
                contentType : false,            
                processData : false,            
                dataType    :'json',
                beforeSend: function() {
                    $(".loading-wrapper").css("display","block");
                },          
                success : function(result){

                    if( result.durum == "success"){
	                    window.location.href = "{{ route("panel.index") }}";                
	                    return false;
	                }else if( result.durum == "error"){

	                   Swal.fire({
			                type: 'error', 
			                text: result.mesaj,
			                confirmButtonText: 'Tamam',
			                confirmButtonColor: '#333'
			            });	    

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
</script>

</body>
</html>
	
