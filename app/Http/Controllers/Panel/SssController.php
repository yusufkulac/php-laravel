<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use App\Models\Sss;
use App\Models\Diller;

class SssController extends Controller
{
    
    //panel sss listesi sayfası -----------------------------------------------------------------
    public function sssList(){
        $sorular = Sss::orderBy("sira")->get();        
        return view("Panel.sss.sss-list", compact("sorular"));
    }
    // ./panel sss listesi sayfası ---------------------------------------------------------------
   
   
    //panel sss ekle sayfası --------------------------------------------------------------------
    public function sssEkle(){
        $diller = Diller::where('aktif', 1)->get();
        return view("Panel.sss.sss-ekle", compact("diller"));
    }
    // ./panel sss ekle sayfası -----------------------------------------------------------------



    //sss ekle ajax post ------------------------------------------------------------------------
    public function sssEklePost(Request $request){

        try{            
           
            $sss = new Sss; 
            $sss->dil_id = intval($request->dil_id); 
            $sss->sira  = intval($request->sira);          
            $sss->soru  = trim($request->soru);
            $sss->cevap = trim($request->cevap);
            $sss->aktif = intval($request->aktif);
            $sss->save();                      

            return response()->json(["durum" => "success", "mesaj" => "Sıkça Sorulan Soru başarıyla kaydedildi"]);          
           
        }catch(\Exception $e){
            return response()->json([
                "durum"=>"error", "mesaj"=>"Sıkça Sorulan Soru kaydedilemedi! ->".$e->getMessage()
            ]);                       
        } 
       
    }// ./sss ekle ajax post ---------------------------------------------------------------------



    //panel sss düzenle sayfası --------------------------------------------------------------------
    public function sssDuzenle($id){
        $diller = Diller::where('aktif', 1)->get();        
        $sss = Sss::where('id', $id)->first();        
        return view("Panel.sss.sss-duzenle", compact("sss", "diller"));
    }
    // ./panel sss düzenle sayfası -----------------------------------------------------------------


    
    //sss ekle ajax post ------------------------------------------------------------------------
    public function sssDuzenlePost(Request $request){       

        try{
            
            Sss::where('id', intval($request->id))->update([
                    'dil_id' => intval($request->dil_id),
                    'sira'   => intval($request->sira),          
                    'soru'   => trim($request->soru),
                    'cevap'  => trim($request->cevap),
                    'aktif'  => intval($request->aktif)
            ]);                      

            return response()->json(["durum" => "success", "mesaj" => "Sıkça sorulan soru başarıyla güncellendi"]);          
           
        }catch(\Exception $e){
            return response()->json([
                "durum"=>"error", "mesaj"=>"Sıkça sorulan soru güncellenemedi! ->".$e->getMessage()
            ]);                       
        } 
       
    }// ./sss ekle ajax post ---------------------------------------------------------------------



    //sss sil ajax post ------------------------------------------------------------------------
    public function sssSil(Request $request){
        try{
            
            Sss::where('id', intval($request->id))->delete();

            return response()->json(["durum" => "success", "mesaj" => "Sıkça sorulan soru başarıyla silindi"]);          
           
        }catch(\Exception $e){
            return response()->json([
                "durum"=>"error", "mesaj"=>"Sıkça sorulan soru silinemedi! ->".$e->getMessage()
            ]);                       
        } 
    }
    //  ./ sss sil ajax post ---------------------------------------------------------------------

}//*************************************************************************************************************
