<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

//models
use App\Models\GaleriVideo;



class GaleriVideoController extends Controller
{
    
    //panel galeri video list -----------------------------------------------------------
    public function videoList(){
        $videolar = GaleriVideo::all();
        return view("Panel.galerivideo.list", compact("videolar"));
    }
    // ./panel galeri kategori list --------------------------------------------------------

 
    //panel galeri video sayfası -----------------------------------------------------------
    public function videoEkle(){
        return view("Panel.galerivideo.ekle");
    }
    // ./panel galeri kategori ekle sayfası --------------------------------------------------------



    //galeri video ekle ajax post -------------------------------------------------------------------
    public function videoEklePost(Request $request){        

        try{ 

            $video = new GaleriVideo;
            $video->baslik = trim($request->baslik);

            //bloga ait video var mı -----------------------------------------------------            
            if($request->hasFile('video') ){
                $dosya       = $request->file('video');               
                $dosya_name  = uniqid(16).'.'.$dosya->getClientOriginalExtension();
                //video/proje dizin yoksa oluştur
                if(!is_dir('uploads/video/galeri')){                    
                    \File::makeDirectory('uploads/video/galeri', $mode = 0777, true, true);
                }

                $uploadPath  = 'uploads/video/galeri';
               
                $dosya->move($uploadPath, $dosya_name);               

                $video->video  = $dosya_name;
            } 

            $video->save();                           

            return response()->json(["durum" => "success", "mesaj" => "Video eklendi"]);          
           
        }catch(\Exception $e){
            return response()->json([
                "durum"=>"error", "mesaj"=>"Video eklenemedi! ->".$e->getMessage()
            ]);                       
        } 
       
    }// ./video ekle ajax post ----------------------------------------------------------------------



    //panel galeri video sil ------------------------------------------------------------------------
    public function videoSilPost(Request $request){

        $videos = GaleriVideo::where('id', intval($request->id))->first();       

        //if(is_file('uploads/video/galeri/'.$videos->video) ){
            GaleriVideo::where('id', intval($request->id))->delete();
            @\File::delete( 'uploads/video/galeri/'.$videos->video );
            return response()->json(["durum" => "success", "mesaj" => "Video silindi"]);
        //}        

        //return response()->json(["durum" => "error", "mesaj" => "Böyle bir video bulunamadı"]);
    }
    // ./panel galeri video sil ------------------------------------------------------------------



}// ************************************************************************************************
