<!DOCTYPE html>
<html lang="tr">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">	
	<meta name="description" content="bakımdayız">
    <meta name="keywords" content="bakımdayız">	
	<link rel="shortcut icon" href="{{ asset('assets/site/img/'.$ayar->favicon)}}">
	<link rel="author" href="yusuf kulaç">
	<title>Bakımdayız</title>
	
	<link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css')}}">		
	<!-- -->
	<link rel="stylesheet" href="{{ asset('assets/site/css/fonts.css')}}">
	<link rel="stylesheet" href="{{ asset('assets/site/css/reset.css')}}">		
	<link rel="stylesheet" href="{{ asset('assets/site/css/bakim.css')}}">	
</head>
<body>
	<h2 class="d-block my-3">En kısa sürede sizinleyiz</h2>
	<div class="my-4">
		<a href="{{ route('site.index') }}">		
			<img src="{{ asset('assets/site/img/'.$ayar->header_logo) }}" class="img-fluid">
		</a>
	</div>

	<div>Tel : {{ $bilgi->telefon }}</div>
	<div>Adres : {{ $bilgi->adres }}</div>
	
	<div class="my-4">
		<img src="{{ asset('assets/site/img/bakim.png') }}" class="img-fluid">
	</div>
</body>
</html>
	
