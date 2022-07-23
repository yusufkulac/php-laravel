<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\InsanKaynaklari;



class InsanKaynaklariController extends Controller
{
    
    // insan kaynakları başvurular --------------------------------------------------------------------
    public function basvurular(){

        $basvurular  = InsanKaynaklari::orderBy("okundu", "asc")->orderBy("id", "desc")->paginate(10);

        return view("Panel.ik.list", compact("basvurular"));
    }
    // ./ insan kaynakları başvurular -------------------------------------------------------------------




    //insan kaynakları detay sayfası -------------------------------------------------------------------
    public function basvuruDetay($id){

        InsanKaynaklari::where("id", $id)->update(["okundu" => 1]);

        $basvuru = InsanKaynaklari::where("id", $id)->first();

        return view("Panel.ik.detay", compact("basvuru"));
    }
    // ./insan kaynakları detay sayfası -----------------------------------------------------------------




    //teklifformu sil post  ------------------------------------------------------------------------
    public function basvuruSil(Request $request){
       
       try{ 

           $basvuru = InsanKaynaklari::where("id",  intval($request->id))->first();

            //cv dosyasını sil
            @\File::delete( 'uploads/dosya/ik/'.$basvuru->cv_dosya );                        

            InsanKaynaklari::where("id", intval($request->id))->delete();

            return response()->json(["durum" => "success", "mesaj" => "Başvuru formu silindi"]);
           
        }catch(\Exception $e){
            return response()->json([
                "durum"=>"error", "mesaj"=>$e->getMessage()
            ]);                       
        } 
    }
    // ./teklifformu sil post ----------------------------------------------------------------------



 

}// ***************************************************************************************
