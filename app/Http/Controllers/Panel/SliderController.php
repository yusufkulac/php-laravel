<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Image;

//models
use App\Models\Slider;


class SliderController extends Controller
{
    //panel slider listesi sayfası -----------------------------------------------------------------
    public function sliderList(){
        $sliders = Slider::orderBy('sira', 'asc')->get();

        return view("Panel.slider.list", compact("sliders"));
    }
    // ./panel slider listesi sayfası ---------------------------------------------------------------


    //panel slider ekle sayfası --------------------------------------------------------------------
    public function sliderEkle(){
        //$diller = Diller::where('aktif', 1)->get();
        return view("Panel.slider.ekle");
    }
    // ./panel slider ekle sayfası -----------------------------------------------------------------



    //slider ekle ajax post ------------------------------------------------------------------------
    public function sliderEklePost(Request $request){

        try{            
           
            $slider = new Slider;  
            $slider->sira   = intval($request->sira);                  
            $slider->slogan = trim($request->slogan);
            $slider->yazi   = trim($request->yazi);  
            $slider->link   = trim($request->link);            

            //slider resim upload            
            if($request->hasFile('resim') ){
                $image       = $request->file('resim');               
                $image_name  = $image->getClientOriginalName();
                //slider dizin yoksa oluştur
                if(!is_dir('uploads/resim/slider')){                    
                    \File::makeDirectory('uploads/resim/slider', $mode = 0777, true, true);
                }
                $uploadPath  = 'uploads/resim/slider';

                $image_resize = Image::make($image->path());

                $image_resize->resize(null, 850, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($uploadPath.'/'.$image_name);               

                $slider->resim  = $image_name;
            }   

            $slider->save();                      

            return response()->json(["durum" => "success", "mesaj" => "Slider başarıyla kaydedildi"]);          
           
        }catch(\Exception $e){
            return response()->json([
                "durum"=>"error", "mesaj"=>"Slider kaydedilemedi! ->".$e->getMessage()
            ]);                       
        } 
       
    }// ./slider ekle ajax post ---------------------------------------------------------------------



    //panel slider düzenle sayfası --------------------------------------------------------------------
    public function sliderDuzenle($id){
        //$diller = Diller::where('aktif', 1)->get();
        $slider = Slider::where('id', $id)->first();        
        return view("Panel.slider.duzenle", compact("slider"));
    }
    // ./panel slider düzenle sayfası -----------------------------------------------------------------


    //slider düzenle ajax post ------------------------------------------------------------------------
    public function sliderDuzenlePost(Request $request){
       
        try{
            $slider = Slider::where('id', intval($request->id))->first();
            $resim  = $slider->resim; //mevcut resim adını sakla           

            //yeni resim gelmişse eskisini sil, yenisini upload et -------------------            
            if($request->hasFile('resim') ){

                //eski resmi sil -----------------------------------------------------                
                if(is_file('uploads/resim/slider/'.$slider->resim) )
                {
                    \File::delete( 'uploads/resim/slider/'.$slider->resim );                    
                }
                //--------------------------------------------------------------------

                $image       = $request->file('resim');               
                $image_name  = $image->getClientOriginalName();
                //slider dizin yoksa oluştur
                if(!is_dir('uploads/resim/slider')){                    
                    \File::makeDirectory('uploads/resim/slider', $mode = 0777, true, true);
                }
                $uploadPath  = 'uploads/resim/slider';

                $image_resize = Image::make($image->path());

                $image_resize->resize(null, 850, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($uploadPath.'/'.$image_name);               

                $resim  = $image_name; //yeni resim adını yaz
            } 
            //---------------------------------------------------------------------------  

            Slider::where('id', intval($request->id))->update([
                    'sira'   => intval($request->sira), 
                    'slogan' => trim($request->slogan),
                    'yazi'   => trim($request->yazi),  
                    'link'   => trim($request->link),
                    'resim'  => $resim
            ]);                      

            return response()->json(["durum" => "success", "mesaj" => "Slider başarıyla güncellendi"]);          
           
        }catch(\Exception $e){
            return response()->json([
                "durum"=>"error", "mesaj"=>"Slider güncellenemedi! ->".$e->getMessage()
            ]);                       
        } 
       
    }// ./slider ekle ajax post ---------------------------------------------------------------------



    //slider sil ajax post ------------------------------------------------------------------------
    public function sliderSil(Request $request){
        try{            
            
            $slider  = Slider::where('id', intval($request->id))->first();
            //resim varsa sil -----------------------------------------------------                
            if(\File::exists( 'uploads/resim/slider/'.$slider->resim ) )
            {
                \File::delete( 'uploads/resim/slider/'.$slider->resim );                    
            }
            //--------------------------------------------------------------------

            Slider::where('id', intval($request->id))->delete();

            return response()->json(["durum" => "success", "mesaj" => "Slider başarıyla silindi"]);          
           
        }catch(\Exception $e){
            return response()->json([
                "durum"=>"error", "mesaj"=>"Slider silinemedi! ->".$e->getMessage()
            ]);                       
        } 
    }
    //  ./ slider sil ajax post ---------------------------------------------------------------------



}// ************************************************************************************************
