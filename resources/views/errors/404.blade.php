<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>404 sayfa bulunamadı</title>
	<style>
		body{
			height: 100vh;
			display: flex;
			flex-direction: column;
			justify-content: center;
			align-items: center;
			font-family: sans-serif;
			background: #eee;
		}

		.h-404{
			font-size: 140px;
			font-weight: 700;			
			color: #777;			
		}

		.text{
			font-size: 22px;
			color: #777;
		}

		button{
			display: inline-block;
			text-decoration: none;
			margin-top: 18px;
			font-weight: 600;
			color: #555;
			border: 0;	
			cursor: pointer;
			font-size: 18px;		
		}
	</style>
</head>
<body>
	<div style="text-align:center">
		<div class="h-404">404</div>
		<div class="text">Aradığınız sayfa bulunamadı</div>
		<button onclick="history.back()">&larr; Geri</button>
	</div>
</body>
</html>
