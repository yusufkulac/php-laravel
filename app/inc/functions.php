<?php  
	
	function tarihAyTr($date){
		$ay = date("m", strtotime($date));

		switch($ay){
			case 1:
				$ayText = "Ocak";
				break;

			case 2:
				$ayText = "Şubat";
				break;

			case 3:
				$ayText = "Mart";
				break;

			case 4:
				$ayText = "Nisan";
				break;

			case 5:
				$ayText = "Mayıs";
				break;

			case 6:
				$ayText = "Haziran";
				break;

			case 7:
				$ayText = "Temmuz";
				break;

			case 8:
				$ayText = "Ağustos";
				break;
	
			case 9:
				$ayText = "Eylül";
				break;

			case 10:
				$ayText = "Ekim";
				break;

			case 11:
				$ayText = "Kasım";
				break;

			case 12:
				$ayText = "Aralık";
				break;

			default:
				$ayText = "Tanımsız";
				break;
		}

		return date("d", strtotime($date))." ".$ayText." ".date("Y", strtotime($date));
	}


	// tüm boşlukları silme
	function bosluk_sil($veri){
		$veri = str_replace("/s+/","",$veri);
		$veri = str_replace(" ","",$veri);
		$veri = str_replace(" ","",$veri);
		$veri = str_replace(" ","",$veri);
		$veri = str_replace("/s/g","",$veri);
		$veri = str_replace("/s+/g","",$veri);		
		$veri = trim($veri);
		return $veri; 
	}


	function substr_bosluk($degisken,$adet){
		$degisken = addslashes($degisken);
		$sonrasi = substr($degisken,$adet,strlen($degisken));
		$ilk_yeri = strpos($sonrasi, " ", 0);
		$kesilen = substr($degisken,0,($adet + $ilk_yeri));
		if(strlen($degisken) >=$adet){
			$kesilen .= "";
		}
		$kesilen = stripslashes($kesilen);
		return $kesilen;
	}


	

