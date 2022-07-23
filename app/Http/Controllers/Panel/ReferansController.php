<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Image;

//models
use App\Models\Referans;


class ReferansController extends Controller
{
    //panel referans listesi sayfası -----------------------------------------------------------------
    public function referansList(){
        $referanslar = Referans::all();

        return view("Panel.referans.list", compact("referanslar"));
    }
    // ./panel referans listesi sayfası ---------------------------------------------------------------


    //panel referans ekle sayfası --------------------------------------------------------------------
    public function referansEkle(){
        //$diller = Diller::where('aktif', 1)->get();
        return view("Panel.referans.ekle");
    }
    // ./panel referans ekle sayfası -----------------------------------------------------------------



    //referans ekle ajax post ------------------------------------------------------------------------
    public function referansEklePost(Request $request){

        try{            
           
            $referans = new Referans;  
            $referans->referans_adi   = trim($request->referans_adi);   

            //referans logo upload            
            if($request->hasFile('logo') ){
                $image       = $request->file('logo');               
                $image_name  = uniqid(15).'.'.$image->getClientOriginalExtension();
                //referans dizin yoksa oluştur
                if(!is_dir('uploads/resim/referans')){                    
                    \File::makeDirectory('uploads/resim/referans', $mode = 0777, true, true);
                }
                $uploadPath  = 'uploads/resim/referans';

                $image_resize = Image::make($image->path());

                $image_resize->resize(null, 130, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($uploadPath.'/'.$image_name);               

                $referans->logo  = $image_name;
            }   

            $referans->save();                      

            return response()->json(["durum" => "success", "mesaj" => "Referans kaydedildi"]);          
           
        }catch(\Exception $e){
            return response()->json([
                "durum"=>"error", "mesaj"=>"Referans kaydedilemedi! ->".$e->getMessage()
            ]);                       
        } 
       
    }// ./referans ekle ajax post ---------------------------------------------------------------------



    //panel referans düzenle sayfası --------------------------------------------------------------------
    public function referansDuzenle($id){
        //$diller = Diller::where('aktif', 1)->get();
        $referans = Referans::where('id', $id)->first();        
        return view("Panel.referans.duzenle", compact("referans"));
    }
    // ./panel referans düzenle sayfası -----------------------------------------------------------------


    //referans düzenle ajax post ------------------------------------------------------------------------
    public function referansDuzenlePost(Request $request){
       
        try{
            $referans = Referans::where('id', intval($request->id))->first();
            $logo     = $referans->logo; //mevcut logo adını sakla           

            //yeni logo gelmişse eskisini sil, yenisini upload et -------------------            
            if($request->hasFile('logo') ){

                //eski logoyu sil -----------------------------------------------------                
                if(is_file('uploads/resim/referans/'.$referans->logo) )
                {
                    \File::delete( 'uploads/resim/referans/'.$referans->logo );                    
                }
                //--------------------------------------------------------------------

                $image       = $request->file('logo');               
                $image_name  = uniqid(15).'.'.$image->getClientOriginalExtension();
                //referans dizin yoksa oluştur
                if(!is_dir('uploads/resim/referans')){                    
                    \File::makeDirectory('uploads/resim/referans', $mode = 0777, true, true);
                }
                $uploadPath  = 'uploads/resim/referans';

                $image_resize = Image::make($image->path());

                $image_resize->resize(null, 130, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($uploadPath.'/'.$image_name);               

                $logo  = $image_name; //yeni resim adını yaz
            } 
            //---------------------------------------------------------------------------  

            Referans::where('id', intval($request->id))->update([
                    'referans_adi' => trim($request->referans_adi),
                    'logo'         => $logo
            ]);                      

            return response()->json(["durum" => "success", "mesaj" => "Referans güncellendi"]);          
           
        }catch(\Exception $e){
            return response()->json([
                "durum"=>"error", "mesaj"=>"Referans güncellenemedi! ->".$e->getMessage()
            ]);                       
        } 
       
    }// ./referans ekle ajax post ---------------------------------------------------------------------



    //referans sil ajax post ------------------------------------------------------------------------
    public function referansSil(Request $request){
        try{            
            
            $referans  = Referans::where('id', intval($request->id))->first();
            //logo varsa sil -----------------------------------------------------                
            if(is_file('uploads/resim/referans/'.$referans->logo) )
            {
                \File::delete( 'uploads/resim/referans/'.$referans->logo );                    
            }
            //--------------------------------------------------------------------

            Referans::where('id', intval($request->id))->delete();

            return response()->json(["durum" => "success", "mesaj" => "Referans silindi"]);          
           
        }catch(\Exception $e){
            return response()->json([
                "durum"=>"error", "mesaj"=>"Referans silinemedi! ->".$e->getMessage()
            ]);                       
        } 
    }
    //  ./ referans sil ajax post ---------------------------------------------------------------------



}// ************************************************************************************************
