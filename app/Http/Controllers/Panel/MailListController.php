<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\MailList;



class MailListController extends Controller
{
    
    // panel mail listesi -----------------------------------------------------------------
    public function mailListesi(){

        $mailList  = MailList::where("aktif", 1)->orderBy("id", "desc")->paginate(10);

        return view("Panel.maillist.list", compact("mailList"));
    }
    // ./ panel mail listesi -----------------------------------------------------------------



    //mail list sil post  ------------------------------------------------------------------------
    public function mailSil(Request $request){
       
       try{           
            MailList::where("id", intval($request->id))->delete();                          

            return response()->json(["durum" => "success", "mesaj" => "E-Posta mail listesinde silindi"]);
           
        }catch(\Exception $e){
            return response()->json([
                "durum"=>"error", "mesaj"=>$e->getMessage()
            ]);                       
        } 
    }
    // ./mail list sil post ----------------------------------------------------------------------

    
 

}// ***************************************************************************************
