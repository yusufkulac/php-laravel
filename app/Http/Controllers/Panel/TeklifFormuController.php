<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\TeklifFormu;



class TeklifFormuController extends Controller
{
    
    // teklif formları  --------------------------------------------------------------------------
    public function teklifFormu(){

        $teklifFormu  = TeklifFormu::orderBy("okundu", "asc")->orderBy("id", "desc")->paginate(10);

        return view("Panel.teklifformu.list", compact("teklifFormu"));
    }
    // ./ teklif formları  -----------------------------------------------------------------------




    //teklifFormu detay sayfası -------------------------------------------------------------------
    public function teklifFormuDetay($id){
       TeklifFormu::where("id", $id)->update(["okundu" => 1]);

        $teklifFormu = TeklifFormu::where("id", $id)->first();

        return view("Panel.teklifformu.detay", compact("teklifFormu"));
    }
    // ./teklifFormu detay sayfası -----------------------------------------------------------------




    //teklifformu sil post  ------------------------------------------------------------------------
    public function teklifFormuSil(Request $request){
       
       try{           
           TeklifFormu::where("id", intval($request->id))->delete();                          

            return response()->json(["durum" => "success", "mesaj" => "Teklif formu başarıyla silindi"]);
           
        }catch(\Exception $e){
            return response()->json([
                "durum"=>"error", "mesaj"=>$e->getMessage()
            ]);                       
        } 
    }
    // ./teklifformu sil post ----------------------------------------------------------------------



 

}// ***************************************************************************************
