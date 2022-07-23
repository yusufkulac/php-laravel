<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use App\Models\SiteBilgileri;
use App\Models\Ziyaret;
use App\Models\Ayar;

class IndexController extends Controller
{
    
    //panel index sayfası -----------------------------------------------------------------
    public function index(){  

        //ziyaretçiler
        $ziyaret = [];
        $ziyaret['bugun'] = Ziyaret::where("tarih", date("Y-m-d"))->count();

        $ziyaret['buay'] = Ziyaret::where("ay", date("m"))->where("yil", date("Y"))->count();

        $ziyaret['buyil'] = Ziyaret::where("yil", date("Y"))->count(); 

        $ayar = Ayar::first();

        return view("Panel.index.index", compact("ziyaret", "ayar"));
    }
    // ./panel index sayfası ---------------------------------------------------------------



    //site bilgileri ------------------------------------------------------------------------
    public function siteBilgileri(){
        $bilgiler = SiteBilgileri::first();

        return view("Panel.index.bilgiler", compact("bilgiler"));
    }
    // ./site bilgileri ---------------------------------------------------------------------
    


    //site bilgilerini güncelle post  -------------------------------------------------------
    public function siteBilgileriPost(Request $request){
       
       try{
           
            SiteBilgileri::where('id', 1)->update([                        
                    'title'        => trim($request->title),
                    'description'  => trim($request->description),
                    'keyword'      => trim($request->keyword),
                    'kurum_adi'    => trim($request->kurum_adi),
                    'telefon'      => trim($request->telefon),
                    'faks'         => trim($request->faks),
                    'gsm1'         => trim($request->gsm1),
                    'whatsapp_tel' => trim($request->whatsapp_tel),
                    'adres'        => trim($request->adres),
                    'mail'         => trim($request->mail),
                    'web'          => trim($request->web),
                    'facebook'     => trim($request->facebook),
                    'twitter'      => trim($request->twitter),
                    'instagram'    => trim($request->instagram),
                    'youtube'      => trim($request->youtube),
                    'google'       => trim($request->google),
                    'pinterest'    => trim($request->pinterest),
                    'linkedin'     => trim($request->linkedin)
            ]);                            

            return response()->json(["durum" => "success", "mesaj" => "Bilgiler başarıyla güncellendi"]);
           
        }catch(\Exception $e){
            return response()->json([
                "durum"=>"error", "mesaj"=>$e->getMessage()
            ]);                       
        } 
    }
    // ./site bilgilerini güncelle post ----------------------------------------------------





}// ***************************************************************************************
