<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Bilgiler;


class BilgilerController extends Controller
{
    
    
    //panel istatistiki bilgiler sayfası --------------------------------------------------------------------
    public function bilgiler(){               
        $bilgiler = Bilgiler::orderBy("id")->first();                
        return view("Panel.index.istitistiki-bilgiler", compact("bilgiler"));
    }
    // ./panel istatistiki bilgiler sayfası -----------------------------------------------------------------


    
    //istatistik bilgileri ajax post ------------------------------------------------------------------------
    public function bilgilerPost(Request $request){

        try{
           
            Bilgiler::where('id', 1)->update([
                    'egitmen_sayisi' => intval($request->egitmen_sayisi),
                    'tecrube_yili'   => intval($request->tecrube_yili),           
                    'ehliyet_sayisi' => intval($request->ehliyet_sayisi),
                    'dokuman_sayisi' => intval($request->dokuman_sayisi),  
                    'ogrenci_sayisi' => intval($request->ogrenci_sayisi)  
                    
            ]);                      

            return response()->json(["durum" => "success", "mesaj" => "Bilgiler başarıyla güncellendi"]);          
           
        }catch(\Exception $e){
            return response()->json([
                "durum"=>"error", "mesaj"=>"Bilgiler güncellenemedi! ->".$e->getMessage()
            ]);                       
        } 
       
    }// .istatistik bilgileri ajax post ---------------------------------------------------------------------



}
