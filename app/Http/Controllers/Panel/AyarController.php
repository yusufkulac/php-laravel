<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Image;


use App\Models\Ayar;
use App\Models\Mesaj;


class AyarController extends Controller
{
    

    //ayarlar sayfası -------------------------------------------------------------------
    public function ayarlar(){
        $ayarlar = Ayar::first();        
        return view("Panel.index.ayarlar", compact("ayarlar"));
    }
    // ./ayarlar sayfası ----------------------------------------------------------------
    


    //ayarlar güncelle post  ------------------------------------------------------------
    public function ayarlarPost(Request $request){
       
       //eski ayar bilgilerini al
        $ayar = Ayar::first();
        $header_logo = $ayar->header_logo;
        $sayfa_logo  = $ayar->sayfa_logo;
        $footer_logo = $ayar->footer_logo;
        $favicon     = $ayar->favicon; 

        try{           
          
           //yeni header logo gelmiş mi----------------------------
           if ($request->hasFile('header_logo')) {
                // eski header logoyu sil
                if ( is_file("assets/site/img/".$ayar->header_logo) ) {
                    \File::delete( public_path("assets/site/img/".$ayar->header_logo) );
                }

                //yenisini upload et
                $image       = $request->file('header_logo');               
                $image_name  = $image->getClientOriginalName();
                $uploadPath  = "assets/site/img";

                $image->move($uploadPath, $image_name);               

                $header_logo  = $image_name; //yeni resim adını yaz
            } 

            //yeni footer logo gelmiş mi----------------------------
           if ($request->hasFile('footer_logo')) {
            // eski header logoyu sil
            if ( is_file("assets/site/img/".$ayar->footer_logo) ) {
                \File::delete( public_path("assets/site/img/".$ayar->footer_logo) );
            }

            //yenisini upload et
            $image       = $request->file('footer_logo');               
            $image_name  = $image->getClientOriginalName();
            $uploadPath  = "assets/site/img";

            $image->move($uploadPath, $image_name);               

            $footer_logo  = $image_name; //yeni resim adını yaz
        } 

        //yeni sayfa logo gelmiş mi----------------------------
        if ($request->hasFile('sayfa_logo')) {
            // eski header logoyu sil
            if ( is_file("assets/site/img/".$ayar->sayfa_logo) ) {
                \File::delete( public_path("sassets/ite/img/".$ayar->sayfa_logo) );
            }

            //yenisini upload et
            $image       = $request->file('sayfa_logo');               
            $image_name  = $image->getClientOriginalName();
            $uploadPath  = "assets/site/img";

            $image->move($uploadPath, $image_name);               

            $sayfa_logo  = $image_name; //yeni resim adını yaz
        } 

        //yeni favicon gelmiş mi----------------------------
        if ($request->hasFile('favicon')) {
            // eski header logoyu sil
            if ( is_file("assets/site/img/".$ayar->favicon) ) {
                \File::delete( public_path("assets/site/img/".$ayar->favicon) );
            }

            //yenisini upload et
            $image       = $request->file('favicon');               
            $image_name  = $image->getClientOriginalName();
            $uploadPath  = "assets/site/img";

            $image->move($uploadPath, $image_name);               

            $favicon  = $image_name; //yeni resim adını yaz
        } 

            Ayar::where('id', 1)->update([
                'header_logo' => $header_logo,
                'sayfa_logo'  => $sayfa_logo,
                'footer_logo' => $footer_logo,
                'favicon'     => $favicon,
                'panel_limit'  => intval($request->panel_limit),
                'maps'        => $request->maps,
                'google_analistik' => $request->google_analistik,
                'google_dogrulama' => $request->google_dogrulama
            ]);
            return response()->json(["durum" => "success", "mesaj" => "Ayarlar başarıyla güncellendi"]);
           
        }catch(\Exception $e){
            return response()->json([
                "durum"=>"error", "mesaj"=>$e->getMessage()
            ]);                       
        } 
    }
    // ./ayarlar güncelle post ----------------------------------------------------



    //bakım modu post  --------------------------------------------------------------------
    public function bakimModuPost(Request $request){
       
       try{  
          
            if($request->bakim_checkbox == 1){
                $bakim_modu = 1;
                $msgs = "Site bakım modunda";               
            }else{
                $bakim_modu = 0;
                $msgs = "Site bakım modunda değil";               
            }

            Ayar::where('id', 1)->update(['bakim_modu' => $bakim_modu]);

            //Cache::put('bakimModu', $bakim_modu, 60*60); //1 saat

            return response()->json(["durum" => "success", "mesaj" => $msgs]);
           
        }catch(\Exception $e){
            return response()->json([
                "durum"=>"error", "mesaj"=>$e->getMessage()
            ]);                       
        } 
    }
    // ./bakım modu post ------------------------------------------------------------




}// ***************************************************************************************
