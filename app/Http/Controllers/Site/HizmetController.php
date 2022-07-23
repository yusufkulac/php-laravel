<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\HizmetKategori;
use App\Models\Hizmet;


class HizmetController extends Controller
{
    
    //site hizmet kategori list sayfası ----------------------------------------------------------
    public function hizmetList(){ 
        $hizmetKategori = HizmetKategori::orderBy("sira")->get();    
        return view("Site.hizmet.kategori-list", compact("hizmetKategori"));
    }
    // ./site hizmet kategori list sayfası -------------------------------------------------------


    //site hizmet kategori list sayfası ----------------------------------------------------------
    public function hizmetList($id, $slug){
       
        $hizmetler = Hizmet::with("resimler")->where("kategori_id", intval($id))
                            ->where("aktif", 1)->orderBy("sira")->paginate(9); 
        //hizmet kategori
        $hizmetKategori = HizmetKategori::where("id", $id)->first();       

        return view("Site.hizmet.hizmet-list", compact("hizmetler", "hizmetKategori"));
    }
    // ./site hizmet kategori list sayfası --------------------------------------------------------

    
   

    //site hizmet detay sayfası -----------------------------------------------------------------
    public function hizmetDetay($id, $slug){       
        $hizmet = Hizmet::with("resimler")->where("id", intval($id))->first();        
        $hizmetKategori = HizmetKategori::orderBy("sira")->get();

        return view("Site.hizmet.detay", compact("hizmet", "hizmetKategori"));
    }
    // ./site hizmet detay sayfası ---------------------------------------------------------------

    

    


}// ***************************************************************************************
