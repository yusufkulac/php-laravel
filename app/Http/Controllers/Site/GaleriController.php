<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\GaleriResimKategori;
use App\Models\GaleriResim;
use App\Models\GaleriVideo;


class GaleriController extends Controller
{
    
    //site resim galeri list sayfası -----------------------------------------------------------------
    public function resimKategoriList(){
       
        $resimKategoriler = GaleriResimKategori::all();                             

        return view("Site.galeri.resim-kategori-list", compact("resimKategoriler"));
    }
    // ./site resim galeri list sayfası ---------------------------------------------------------------

    
    //site resim list sayfası ------------------------------------------------------------------------
    public function resimList($id, $slug){
       
        $resimler = GaleriResim::where("galeri_id", intval($id))->get();
        $resimKategori =  GaleriResimKategori::where("id", intval($id))->first();
        $resimKategoriler =  GaleriResimKategori::all();                            

        return view("Site.galeri.resim-list", compact("resimler", "resimKategori", "resimKategoriler"));
    }
    // ./site resim list sayfası ----------------------------------------------------------------------


    //site video list sayfası -----------------------------------------------------------------
    public function videoGaleri(){
       
        $videolar = GaleriVideo::all();                             

        return view("Site.galeri.video-list", compact("videolar"));
    }
    // ./site video list sayfası ---------------------------------------------------------------



}// ***************************************************************************************
