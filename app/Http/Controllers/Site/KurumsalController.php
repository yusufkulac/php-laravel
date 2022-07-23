<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Kurumsal;
use App\Models\Referans;
use App\Models\CozumOrtaklari;


class KurumsalController extends Controller
{
    
    //site hakkımızda sayfası -----------------------------------------------------------------
    public function hakkimizda(){
       
        $kurumsal = Kurumsal::where("id", 1)->first();                             

        return view("Site.kurumsal.hakkimizda", compact("kurumsal"));
    }
    // ./site hakkımızda sayfası ---------------------------------------------------------------


    //site referanslar sayfası -----------------------------------------------------------------
    public function referanslar(){
       
        $referanslar = Referans::orderBy("id")->get();                             

        return view("Site.kurumsal.referanslar", compact("referanslar"));
    }
    // ./site referanslar sayfası ---------------------------------------------------------------

    
    //site çözüm ortakları sayfası -----------------------------------------------------------------
    public function cozumOrtaklari(){
       
        $cozumOrtaklari = CozumOrtaklari::orderBy("id")->get();                             

        return view("Site.kurumsal.cozum-ortaklari", compact("cozumOrtaklari"));
    }
    // ./site çözüm ortakları sayfası ---------------------------------------------------------------

   

}// ***************************************************************************************
