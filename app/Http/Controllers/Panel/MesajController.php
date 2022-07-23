<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Mesaj;
use App\Models\OnlineKayit;


class MesajController extends Controller
{
    
    // siteye gelen mesajlar -----------------------------------------------------------------
    public function mesajlar(){

        $mesajlar  = Mesaj::orderBy("okundu", "asc")->orderBy("id", "desc")->paginate(10);

        return view("Panel.mesaj.mesajlar", compact("mesajlar"));
    }
    // ./ siteye gelen mesajlar -----------------------------------------------------------------




    // mesaj detay sayfası -----------------------------------------------------------------
    public function mesajDetay($id){
        Mesaj::where("id", $id)->update(["okundu" => 1]);

        $mesaj = Mesaj::where("id", $id)->first();

        return view("Panel.mesaj.mesaj-detay", compact("mesaj"));
    }
    // ./ mesaj detay sayfası -----------------------------------------------------------------


    //mesaj sil post  ------------------------------------------------------------------------
    public function mesajSil(Request $request){
       
       try{           
            Mesaj::where("id", intval($request->id))->delete();                          

            return response()->json(["durum" => "success", "mesaj" => "Mesaj başarıyla silindi"]);
           
        }catch(\Exception $e){
            return response()->json([
                "durum"=>"error", "mesaj"=>$e->getMessage()
            ]);                       
        } 
    }
    // ./mesaj sil post ----------------------------------------------------------------------


    //mesaj yayınla güncelle post  -------------------------------------------------------
    public function mesajYaninlaPost(Request $request){
       
        try{
            
            Mesaj::where('id', $request->id)->update([ 'yayinla'  => 1 ]);                            
 
            return response()->json(["durum" => "success", "mesaj" => "Mesaj sizden gelenler bölümünde yayınlandı"]);
            
         }catch(\Exception $e){
             return response()->json([
                 "durum"=>"error", "mesaj"=>$e->getMessage()
             ]);                       
         } 
     }
     // ./mesaj yayınla güncelle post ----------------------------------------------------

     //mesaj yayından kaldır post  -------------------------------------------------------
     public function mesajYanindanKaldir(Request $request){
       
        try{
            
            Mesaj::where('id',  $request->id)->update([ 'yayinla'  => 0 ]);                            
 
            return response()->json(["durum" => "success", "mesaj" => "Mesaj sizden gelenler bölümünden kaldırıldı"]);
            
        }catch(\Exception $e){
             return response()->json([
                 "durum"=>"error", "mesaj"=>$e->getMessage()
             ]);                       
        } 
     }
     // ./mesaj yayından kaldır post ----------------------------------------------------


    
 

}// ***************************************************************************************
