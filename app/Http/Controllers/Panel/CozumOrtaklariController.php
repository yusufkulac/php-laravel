<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Image;

//models
use App\Models\CozumOrtaklari;


class CozumOrtaklariController extends Controller
{
    //panel cozumOrtaklari listesi sayfası -----------------------------------------------------------------
    public function cozumOrtaklariList(){
        $cozumOrtaklari = CozumOrtaklari::all();

        return view("Panel.cozum_ortaklari.list", compact("cozumOrtaklari"));
    }
    // ./panel cozumOrtaklari listesi sayfası ---------------------------------------------------------------


    //panel cozumOrtaklari ekle sayfası --------------------------------------------------------------------
    public function cozumOrtaklariEkle(){
        //$diller = Diller::where('aktif', 1)->get();
        return view("Panel.cozum_ortaklari.ekle");
    }
    // ./panel cozumOrtaklari ekle sayfası -----------------------------------------------------------------



    //cozumOrtaklari ekle ajax post ------------------------------------------------------------------------
    public function cozumOrtaklariEklePost(Request $request){

        try{            
           
            $cozumOrtaklari = new CozumOrtaklari;  
            $cozumOrtaklari->ortak_adi   = trim($request->ortak_adi);   

            //cozumOrtaklari logo upload            
            if($request->hasFile('logo') ){
                $image       = $request->file('logo');               
                $image_name  = uniqid(15).'.'.$image->getClientOriginalExtension();
                //cozumOrtaklari dizin yoksa oluştur
                if(!is_dir('uploads/resim/cozum_ortaklari')){                    
                    \File::makeDirectory('uploads/resim/cozum_ortaklari', $mode = 0777, true, true);
                }
                $uploadPath  = 'uploads/resim/cozum_ortaklari';

                $image_resize = Image::make($image->path());

                $image_resize->resize(null, 130, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($uploadPath.'/'.$image_name);               

                $cozumOrtaklari->logo  = $image_name;
            }   

            $cozumOrtaklari->save();                      

            return response()->json(["durum" => "success", "mesaj" => "Çözüm ortağı kaydedildi"]);          
           
        }catch(\Exception $e){
            return response()->json([
                "durum"=>"error", "mesaj"=>"Çözüm ortağı kaydedilemedi! ->".$e->getMessage()
            ]);                       
        } 
       
    }// ./cozumOrtaklari ekle ajax post ---------------------------------------------------------------------



    //panel cozumOrtaklari düzenle sayfası --------------------------------------------------------------------
    public function cozumOrtaklariDuzenle($id){
        //$diller = Diller::where('aktif', 1)->get();
        $cozumOrtagi = CozumOrtaklari::where('id', $id)->first();        
        return view("Panel.cozum_ortaklari.duzenle", compact("cozumOrtagi"));
    }
    // ./panel cozumOrtaklari düzenle sayfası -----------------------------------------------------------------


    //cozumOrtaklari düzenle ajax post ------------------------------------------------------------------------
    public function cozumOrtaklariDuzenlePost(Request $request){
       
        try{
            $cozumOrtaklari = CozumOrtaklari::where('id', intval($request->id))->first();
            $logo     = $cozumOrtaklari->logo; //mevcut logo adını sakla           

            //yeni logo gelmişse eskisini sil, yenisini upload et -------------------            
            if($request->hasFile('logo') ){

                //eski logoyu sil -----------------------------------------------------                
                if(is_file('uploads/resim/cozum_ortaklari/'.$cozumOrtaklari->logo) )
                {
                    \File::delete( 'uploads/resim/cozum_ortaklari/'.$cozumOrtaklari->logo );                    
                }
                //--------------------------------------------------------------------

                $image       = $request->file('logo');               
                $image_name  = uniqid(15).'.'.$image->getClientOriginalExtension();
                //cozumOrtaklari dizin yoksa oluştur
                if(!is_dir('uploads/resim/cozum_ortaklari')){                    
                    \File::makeDirectory('uploads/resim/cozum_ortaklari', $mode = 0777, true, true);
                }
                $uploadPath  = 'uploads/resim/cozum_ortaklari';

                $image_resize = Image::make($image->path());

                $image_resize->resize(null, 130, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($uploadPath.'/'.$image_name);               

                $logo  = $image_name; //yeni resim adını yaz
            } 
            //---------------------------------------------------------------------------  

            CozumOrtaklari::where('id', intval($request->id))->update([
                    'ortak_adi' => trim($request->ortak_adi),
                    'logo'      => $logo
            ]);                      

            return response()->json(["durum" => "success", "mesaj" => "Çözüm Ortağı güncellendi"]);          
           
        }catch(\Exception $e){
            return response()->json([
                "durum"=>"error", "mesaj"=>"Çözüm Ortağı güncellenemedi! ->".$e->getMessage()
            ]);                       
        } 
       
    }// ./cozumOrtaklari ekle ajax post ---------------------------------------------------------------------



    //cozumOrtaklari sil ajax post ------------------------------------------------------------------------
    public function cozumOrtaklariSil(Request $request){
        try{            
            
            $cozumOrtaklari  = CozumOrtaklari::where('id', intval($request->id))->first();
            //logo varsa sil -----------------------------------------------------                
            if(is_file('uploads/resim/cozum_ortaklari/'.$cozumOrtaklari->logo) )
            {
                \File::delete( 'uploads/resim/cozum_ortaklari/'.$cozumOrtaklari->logo );                    
            }
            //--------------------------------------------------------------------

            CozumOrtaklari::where('id', intval($request->id))->delete();

            return response()->json(["durum" => "success", "mesaj" => "Çözüm Ortağı silindi"]);          
           
        }catch(\Exception $e){
            return response()->json([
                "durum"=>"error", "mesaj"=>"Çözüm Ortağı silinemedi! ->".$e->getMessage()
            ]);                       
        } 
    }
    //  ./ cozumOrtaklari sil ajax post ---------------------------------------------------------------------



}// ************************************************************************************************
