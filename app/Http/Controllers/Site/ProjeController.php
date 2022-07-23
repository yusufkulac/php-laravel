<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Proje;


class ProjeController extends Controller
{
    
    //site projeler sayfası --------------------------------------------------------------------
    public function projeler(){     
        return view("Site.proje.list");
    }
    // ./site projeler sayfası -----------------------------------------------------------------


    //site tamamlanan projeler sayfası --------------------------------------------------------------------
    public function tamamlananProjeler(){ 
        $durumu = "Tamamlanan"; 
        $projeler = Proje::where("durumu", "tamam")->where("aktif", 1)->orderBy("id")->paginate(6);   
        return view("Site.proje.proje-list", compact("projeler", "durumu"));
    }
    // ./site tamamlanan projeler sayfası -----------------------------------------------------------------


    //site planlanan projeler sayfası --------------------------------------------------------------------
    public function planlananProjeler(){ 
        $durumu = "Planlanan"; 
        $projeler = Proje::where("durumu", "plan")->where("aktif", 1)->orderBy("id")->paginate(6);   
        return view("Site.proje.proje-list", compact("projeler", "durumu"));
    }
    // ./site devam eden projeler sayfası -----------------------------------------------------------------


    //site devam eden projeler sayfası --------------------------------------------------------------------
    public function devamEdenProjeler(){ 
        $durumu = "Devam Eden"; 
        $projeler = Proje::where("durumu", "devam")->where("aktif", 1)->orderBy("id")->paginate(6);   
        return view("Site.proje.proje-list", compact("projeler", "durumu"));
    }
    // ./site devam eden projeler sayfası -----------------------------------------------------------------





    //site proje detay sayfası -----------------------------------------------------------------
    public function projeDetay($id, $slug){
       
        $proje = Proje::with("resimler")->where("id", intval($id))->first();        

        return view("Site.proje.detay", compact("proje"));
    }
    // ./site proje detay sayfası ---------------------------------------------------------------

    

    


}// ***************************************************************************************
