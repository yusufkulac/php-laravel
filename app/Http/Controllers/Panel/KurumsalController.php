<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Image;

use App\Models\Kurumsal;
use App\Models\Mesaj;


class KurumsalController extends Controller
{
    

    //hakkımızda sayfası -------------------------------------------------------------------
    public function hakkimizda(){
        $kurumsal = Kurumsal::first();
        return view("Panel.kurumsal.hakkimizda", compact("kurumsal"));
    }
    // ./hakkımızda sayfası ----------------------------------------------------------------
    


    //hakkımızda güncelle post  ------------------------------------------------------------
    public function hakkimizdaPost(Request $request){
       
       try{           
            $kurumsal = Kurumsal::first();
            $resim  = $kurumsal->hakkimizda_resim; //mevcut resim adını sakla           

            //yeni resim gelmişse eskisini sil, yenisini upload et -------------------            
            if($request->hasFile('resim') ){

                //eski resmi sil -----------------------------------------------------                
                if(is_file('uploads/resim/hakkimizda/'.$resim) )
                {
                    \File::delete( 'uploads/resim/hakkimizda/'.$resim );                    
                }
                //--------------------------------------------------------------------

                $image       = $request->file('resim');               
                $image_name  = uniqid(15).'.'.$image->getClientOriginalExtension();
                //slider dizin yoksa oluştur
                if(!is_dir('uploads/resim/hakkimizda')){                    
                    \File::makeDirectory('uploads/resim/hakkimizda', $mode = 0777, true, true);
                }
                $uploadPath  = 'uploads/resim/hakkimizda';

                $image_resize = Image::make($image->path());

                $image_resize->resize(null, 600, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($uploadPath.'/'.$image_name);               

                $resim  = $image_name; //yeni resim adını yaz
            } 
            //---------------------------------------------------------------------------  

            Kurumsal::where('id', 1)->update([
                'hakkimizda'       => trim($request->hakkimizda),
                'hakkimizda_resim' => $resim 
            ]);
            return response()->json(["durum" => "success", "mesaj" => "Hakkımızda yazısı başarıyla güncellendi"]);
           
        }catch(\Exception $e){
            return response()->json([
                "durum"=>"error", "mesaj"=>$e->getMessage()
            ]);                       
        } 
    }
    // ./hakkımızda güncelle post ----------------------------------------------------




    //vizyon sayfası -------------------------------------------------------------------
    public function vizyon(){
        $kurumsal = Kurumsal::first();
        return view("Panel.kurumsal.vizyon", compact("kurumsal"));
    }
    // ./vizyon sayfası ----------------------------------------------------------------
    


    //vizyon güncelle post  ------------------------------------------------------------
    public function vizyonPost(Request $request){
       
       try{           
            Kurumsal::where('id', 1)->update([
                'vizyon' => trim($request->vizyon),
                'misyon' => trim($request->misyon) 
            ]);
            return response()->json(["durum" => "success", "mesaj" => "Vizyon yazısı başarıyla güncellendi"]);
           
        }catch(\Exception $e){
            return response()->json([
                "durum"=>"error", "mesaj"=>$e->getMessage()
            ]);                       
        } 
    }
    // ./vizyon güncelle post ----------------------------------------------------



     //neden biz sayfası -------------------------------------------------------------------
    public function nedenbiz(){
        $kurumsal = Kurumsal::first();
        return view("Panel.kurumsal.neden-biz", compact("kurumsal"));
    }
    // ./neden biz sayfası ----------------------------------------------------------------
    


    //neden biz güncelle post  ------------------------------------------------------------
    public function nedenbizPost(Request $request){
       
       try{           
            Kurumsal::where('id', 1)->update(['nedenbiz' => trim($request->nedenbiz)]);

            return response()->json(["durum" => "success", "mesaj" => "Neden biz yazısı başarıyla güncellendi"]);
           
        }catch(\Exception $e){
            return response()->json([
                "durum"=>"error", "mesaj"=>$e->getMessage()
            ]);                       
        } 
    }
    // ./neden biz güncelle post ----------------------------------------------------



}// ***************************************************************************************
