<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Image;

//models
use App\Models\Hizmet;
use App\Models\HizmetResim;
use App\Models\HizmetKategori;
use App\Models\ayar;

class HizmetController extends Controller
{
    
    private $panel_limit;

    public function __constructur(){
        //panel sayfalama  limit
        $ayar = Ayar::first();
        $this->panel_limit = $ayar->panel_limit; 
    }

    //panel hizmet listesi sayfası -----------------------------------------------------------------
    public function hizmetList($kategori_id = null){        

        if ($kategori_id == null) {
            $hizmetler = Hizmet::with("kategori")->orderBy('kategori_id','asc')->paginate($this->panel_limit);
        }else{
            $hizmetler = Hizmet::with("kategori")->where("kategori_id", intval($kategori_id))
                        ->orderBy('sira', 'asc')->paginate($this->panel_limit);
        }
        

        return view("Panel.hizmet.list", compact("hizmetler"));
    }
    // ./panel hizmet listesi sayfası ---------------------------------------------------------------


    //panel hizmet ekle sayfası --------------------------------------------------------------------
    public function hizmetEkle(){
        $kategoriler = HizmetKategori::orderBy('sira')->get();
        return view("Panel.hizmet.ekle", compact("kategoriler"));
    }
    // ./panel hizmet ekle sayfası -----------------------------------------------------------------



    //hizmet ekle ajax post ------------------------------------------------------------------------
    public function hizmetEklePost(Request $request){

        if(isset($request->anasayfa_goster) && $request->anasayfa_goster == 'on'){
            $anasayfa_goster = 1;
        }else{
            $anasayfa_goster = 0;
        }

        try{            
           
            $hizmet = new Hizmet;
            $hizmet->kategori_id     = intval($request->kategori_id);
            $hizmet->sira            = intval($request->sira);
            $hizmet->baslik          = trim($request->baslik);
            $hizmet->ozet            = trim($request->ozet);  
            $hizmet->icerik          = trim($request->icerik);  
            $hizmet->anasayfa_goster = $anasayfa_goster; 
            $hizmet->slug            = trim(\Str::slug($request->baslik, '-'));
            $hizmet->aktif           = intval($request->aktif);
            $hizmet->etiket          = trim($request->etiket);
            $hizmet->video_link      = trim($request->video_link); 
            $hizmet->description     = trim($request->description); 
            $hizmet->keywords        = trim($request->keywords); 

            //hizmete ait ana resim var mı -----------------------------------------------------            
            if($request->hasFile('ana_resim') ){
                $image       = $request->file('ana_resim');               
                $image_name  = $image->getClientOriginalName();
                //hizmet dizin yoksa oluştur
                if(!is_dir('uploads/resim/hizmet')){                    
                    \File::makeDirectory('uploads/resim/hizmet', $mode = 0777, true, true);
                }
                $uploadPath  = 'uploads/resim/hizmet';

                $image_resize = Image::make($image->getRealPath());

                $watermark = Image::make('assets/site/img/filigran2.png');
                
                $image_resize->resize(null, 600, function ($constraint) {
                    $constraint->aspectRatio();
                })->insert($watermark, 'center')
                ->save($uploadPath.'/'.$image_name);               

                $hizmet->resim  = $image_name;
            }   

            //hizmete ait video var mı -----------------------------------------------------            
            if($request->hasFile('video') ){
                $dosya       = $request->file('video');               
                $dosya_name  = $dosya->getClientOriginalName();
                //video/hizmet dizin yoksa oluştur
                if(!is_dir('uploads/video/hizmet')){                    
                    \File::makeDirectory('uploads/video/hizmet', $mode = 0777, true, true);
                }

                $uploadPath  = 'uploads/video/hizmet';
               
                $dosya->move($uploadPath, $dosya_name);               

                $hizmet->video  = $dosya_name;
            }         

            $hizmet->save();  

            //hizmete ait diğer resimlerin eklenmesi -
            if($request->hasFile('resim') ){                

                foreach($request->file('resim') as $image){
                    $name  = $image->getClientOriginalName();
                    //hizmet dizin yoksa oluştur
                    if(!is_dir('uploads/resim/hizmet')){
                      
                        \File::makeDirectory('uploads/resim/hizmet', $mode = 0777, true, true);
                    }
                    $uploadPath  = 'uploads/resim/hizmet';
                    
                    $image_resize = Image::make($image->getRealPath());

                    $watermark = Image::make('assets/site/img/filigran2.png');
                    
                    $image_resize->resize(null, 600, function ($constraint) {
                        $constraint->aspectRatio();
                    })->insert($watermark, 'center')->save($uploadPath.'/'.$name);   
                    
                    $hizmetResim = new HizmetResim;
                    $hizmetResim->hizmet_id = $hizmet->id;
                    $hizmetResim->resim = $name;
                    $hizmetResim->save();
                } 
            }                    

            return response()->json(["durum" => "success", "mesaj" => "Hizmet kaydedildi"]);          
           
        }catch(\Exception $e){
            return response()->json([
                "durum"=>"error", "mesaj"=>"Hizmet kaydedilemedi! ->".$e->getMessage()
            ]);                       
        } 
       
    }// ./hizmet ekle ajax post ---------------------------------------------------------------------



    //panel hizmet düzenle sayfası --------------------------------------------------------------------
    public function hizmetDuzenle($slug){
        $kategoriler = HizmetKategori::orderBy('sira')->get();
        $hizmet = Hizmet::where('slug', $slug)->first();
        return view("Panel.hizmet.duzenle", compact("hizmet", "kategoriler"));
    }
    // ./panel hizmet düzenle sayfası -----------------------------------------------------------------


   
    //hizmet düzenle ajax post ------------------------------------------------------------------------
    public function hizmetDuzenlePost(Request $request){

        if(isset($request->anasayfa_goster) && $request->anasayfa_goster == 'on'){
            $anasayfa_goster = 1;
        }else{
            $anasayfa_goster = 0;
        }

       try{            
            
            $hizmet    = Hizmet::where('id', intval($request->id))->first();
            $ana_resim = $hizmet->resim; //mevcut resim adını sakla  
            $video     = $hizmet->video; //mevcut video adını sakla 

            //hizmete ait ana resim var mı -------------------------------------------------            
            if($request->hasFile('ana_resim') ){
                $image       = $request->file('ana_resim');               
                $image_name  = $image->getClientOriginalName();
                
                //hizmet dizin yoksa oluştur
                if(!is_dir('uploads/resim/hizmet')){                    
                    \File::makeDirectory('uploads/resim/hizmet', $mode = 0777, true, true);
                }

                // hizmetin eski ana resmini sil
                if(is_file('uploads/resim/hizmet/'.$ana_resim)){
                    \File::delete( 'uploads/resim/hizmet/'.$ana_resim );
                }

                $uploadPath  = 'uploads/resim/hizmet';

                $image_resize = Image::make($image->getRealPath());

                $watermark = Image::make('assets/site/img/filigran2.png');
                $image_resize->resize(null, 600, function ($constraint) {
                    $constraint->aspectRatio();
                })->insert($watermark, 'center')
                ->save($uploadPath.'/'.$image_name);               

                $ana_resim  = $image_name;
            } 
            //------------------------------------------------------------------------------               


             //hizmete ait video var mı -----------------------------------------------------            
            if( $request->hasFile('video') ){  
               
                $dosya       = $request->file('video');               
                $dosya_name  = $dosya->getClientOriginalName();
                
                //video/hizmet dizin yoksa oluştur
                if(!is_dir('uploads/video/hizmet')){                    
                    \File::makeDirectory('uploads/video/hizmet', $mode = 0777, true, true);
                }

                //eski videosunu sil
                \File::delete('uploads/video/hizmet/'.$hizmet->video);

                $uploadPath  = 'uploads/video/hizmet';
               
                $dosya->move($uploadPath, $dosya_name);               

                $video  = $dosya_name;
            }

            Hizmet::where('id', intval($request->id))->update([
                    'kategori_id'     => intval($request->kategori_id),
                    'sira'            => intval($request->sira),
                    'baslik'          => trim($request->baslik),
                    'ozet'            => trim($request->ozet),  
                    'icerik'          => trim($request->icerik),  
                    'anasayfa_goster' => $anasayfa_goster, 
                    'slug'            => trim(\Str::slug($request->baslik, '-')),
                    'aktif'           => intval($request->aktif),
                    'etiket'          => trim($request->etiket),                    
                    'description'     => trim($request->description),
                    'keywords'        => trim($request->keywords),
                    'video_link'      => trim($request->video_link),
                    'video'           => $video,
                    'resim'           => $ana_resim
            ]);

            //hizmete ait diğer resimlerin eklenmesi -
            if($request->hasFile('resim') ){                

                foreach($request->file('resim') as $image){
                    $name  = $image->getClientOriginalName();
                    //hizmet dizin yoksa oluştur
                    if(!is_dir('uploads/resim/hizmet')){
                        
                        \File::makeDirectory('uploads/resim/hizmet', $mode = 0777, true, true);
                    }
                    $uploadPath  = 'uploads/resim/hizmet';
                    
                    $image_resize = Image::make($image->getRealPath());

                    $watermark = Image::make('assets/site/img/filigran2.png');
                    $image_resize->resize(null, 600, function ($constraint) {
                        $constraint->aspectRatio();
                    })->insert($watermark, 'center')
                    ->save($uploadPath.'/'.$name);   
                    
                    $hizmetResim = new HizmetResim;
                    $hizmetResim->hizmet_id = $request->id;
                    $hizmetResim->resim = $name;
                    $hizmetResim->save();
                } 
            }                             

            return response()->json(["durum" => "success", "mesaj" => "Hizmet güncellendi"]);          
           
        }catch(\Exception $e){
            return response()->json([
                "durum"=>"error", "mesaj"=>"Hizmet güncellenemedi! ->".$e->getMessage()
            ]);                       
        } 
       
    }// ./hizmet düzenle ajax post ---------------------------------------------------------------------



    //hizmet sil ajax post ------------------------------------------------------------------------
    public function hizmetSil(Request $request){
        try{            
            
            $resimler  = HizmetResim::where('hizmet_id', intval($request->id))->get();         

            if (count($resimler) > 0) {
                foreach($resimler as $hizmetResim){
                    //resim varsa sil -----------------------------------------------------                
                    if(is_file('uploads/resim/hizmet/'.$hizmetResim->resim)){
                        \File::delete( 'uploads/resim/hizmet/'.$hizmetResim->resim );
                    }
                    //--------------------------------------------------------------------
                }
            }

            $hizmet = Hizmet::where("id",  intval($request->id))->first();

            //videosunu sil
            @\File::delete( 'uploads/video/hizmet/'.$hizmet->video );
            
            Hizmet::where('id', intval($request->id))->delete();

            return response()->json(["durum" => "success", "mesaj" => "Hizmet silindi"]);          
           
        }catch(\Exception $e){
            return response()->json([
                "durum"=>"error", "mesaj"=>"Hizmet silinemedi! ->".$e->getMessage()
            ]);                       
        } 
    }
    //  ./ hizmet sil ajax post ---------------------------------------------------------------------


     //panel hizmet resim sil -------------------------------------------------------------------------
    public function hizmetResimSil(Request $request){

        $id = intval($request->id);
        $resim = HizmetResim::where('id', $id)->first();

        HizmetResim::where('id', $id)->delete();

        if(is_file('uploads/resim/hizmet/'.$resim->resim) ){
            \File::delete( 'uploads/resim/hizmet/'.$resim->resim );
            return response()->json(["durum" => "success", "mesaj" => "Resim silindi"]);
        }        

        return response()->json(["durum" => "error", "mesaj" => "Böyle bir resim bulunamadı"]);
    }
    //  ./ panel hizmet resim sil --------------------------------------------------------------------
   


    //hizmet resim sırala ajax ------------------------------------------------------------
    public function hizmetResimSirala(Request $request){  
        foreach ($request->sira as $sira) {           
           $sirala = HizmetResim::where("id", $sira[0])->update(["sira" => $sira[1]]);
        }
    }
    //  ./hizmet resim sırala ajax bitiş ----------------------------------------------------------


    //video sil --------------------------------------------------------------------------------
    public function videoSil(Request $request){
        $id   = $request->id;
        $row = Hizmet::where('id', $id)->first();       
       
        @\File::delete( 'uploads/video/hizmet/'.$row->video );
        Hizmet::where('id', $id)->update(["video"=>""]);
        return response()->json(["durum" => "success", "mesaj" => "Video silindi"]);
       
    }
    //  ./ video sil ---------------------------------------------------------------------------
   

// -------- KATEGORİ ************-----------*************------------------*************------------

    //panel hizmet kategori listesi sayfası --------------------------------------------------------
    public function hizmetKategoriList(){
        $kategoriler = HizmetKategori::orderBy('sira')->paginate($this->panel_limit);
        return view("Panel.hizmet.kategori-list", compact("kategoriler"));
    }
    // ./panel hizmet kategori listesi sayfası -----------------------------------------------------


    //panel hizmet kategori ekle sayfası -----------------------------------------------------------
    public function hizmetKategoriEkle(){
        return view("Panel.hizmet.kategori-ekle");
    }
    // ./panel hizmet kategori ekle sayfası ---------------------------------------------------------


     //hizmet kategori ekle ajax post ---------------------------------------------------------------
    public function hizmetKategoriEklePost(Request $request){

        if(isset($request->anasayfa_goster) && $request->anasayfa_goster == 'on'){
            $anasayfa_goster = 1;
        }else{
            $anasayfa_goster = 0;
        }

        if(isset($request->menu_goster) && $request->menu_goster == 'on'){
            $menude_goster = 1;
        }else{
            $menude_goster = 0;
        }

        try{            
           
            $hizmetKategori = new HizmetKategori;
            $hizmetKategori->sira            = intval($request->sira);
            $hizmetKategori->kategori_adi    = trim($request->kategori_adi);
            $hizmetKategori->anasayfa_goster = $anasayfa_goster; 
            $hizmetKategori->menude_goster   = $menude_goster;
            $hizmetKategori->slug            = trim(\Str::slug($request->kategori_adi, '-'));
            $hizmetKategori->etiket          = trim($request->etiket);

            //hizmet resim upload            
            if($request->hasFile('resim') ){
                $image       = $request->file('resim');               
                $image_name  = $image->getClientOriginalName();
                //hizmet dizin yoksa oluştur
                if(!is_dir('uploads/resim/hizmet')){                    
                    \File::makeDirectory('uploads/resim/hizmet', $mode = 0777, true, true);
                }
                $uploadPath  = 'uploads/resim/hizmet';

                $image_resize = Image::make($image->getRealPath());

                $image_resize->resize(null, 600, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($uploadPath.'/'.$image_name);               

                $hizmetKategori->resim  = $image_name;
            }   

            $hizmetKategori->save(); 

            return response()->json(["durum" => "success", "mesaj" => "Kategori eklendi"]);          
           
        }catch(\Exception $e){
            return response()->json([
                "durum"=>"error", "mesaj"=>"Kategori eklenemedi! ->".$e->getMessage()
            ]);                       
        }        
    }// ./hizmet ekle ajax post ---------------------------------------------------------------------


    //panel hizmet kategori düzenle sayfası ---------------------------------------------------------
    public function hizmetKategoriDuzenle($id){
        $kategori = HizmetKategori::where('id', intval($id))->first();
        return view("Panel.hizmet.kategori-duzenle", compact("kategori"));
    }
    // ./panel hizmet kategori düzenle sayfası ------------------------------------------------------


    //hizmet kategori düzenle ajax post -------------------------------------------------------------
    public function hizmetKategoriDuzenlePost(Request $request){
       
        try{
            if(isset($request->anasayfa_goster) && $request->anasayfa_goster == 'on'){
                $anasayfa_goster = 1;
            }else{
                $anasayfa_goster = 0;
            }

            if(isset($request->menu_goster) && $request->menu_goster == 'on'){
                $menude_goster = 1;
            }else{
                $menude_goster = 0;
            }

            $kategori = HizmetKategori::where('id', intval($request->id))->first();
            $resim    = $kategori->resim; //mevcut resim adını sakla           

            //yeni resim gelmişse eskisini sil, yenisini upload et -------------------            
            if($request->hasFile('resim') ){

                //eski resmi sil -----------------------------------------------------                
                if(is_file('uploads/resim/hizmet/'.$kategori->resim) )
                {
                    \File::delete( 'uploads/resim/hizmet/'.$kategori->resim );                    
                }
                //--------------------------------------------------------------------

                $image       = $request->file('resim');               
                $image_name  = $image->getClientOriginalName();
                //hizmet dizin yoksa oluştur
                if(!is_dir('uploads/resim/hizmet')){                    
                    \File::makeDirectory('uploads/resim/hizmet', $mode = 0777, true, true);
                }
                $uploadPath  = 'uploads/resim/hizmet';

                $image_resize = Image::make($image->getRealPath());

                $image_resize->resize(null, 600, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($uploadPath.'/'.$image_name);               

                $resim  = $image_name; //yeni resim adını yaz
            } 
            //---------------------------------------------------------------------------

            HizmetKategori::where('id', intval($request->id))->update([
                'sira'            => intval($request->sira),
                'kategori_adi'    => trim($request->kategori_adi),
                'anasayfa_goster' => $anasayfa_goster, 
                'menude_goster'   => $menude_goster,
                'slug'            => trim(\Str::slug($request->kategori_adi, '-')),
                'etiket'          => trim($request->etiket),
                'resim'           => $resim
            ]);                               

            return response()->json(["durum" => "success", "mesaj" => "Kategori güncellendi"]);          
           
        }catch(\Exception $e){
            return response()->json([
                "durum"=>"error", "mesaj"=>"Kategori güncellenemedi! ->".$e->getMessage()
            ]);                       
        } 
       
    }// ./hizmet kategori ekle ajax post ------------------------------------------------------------


    //panel hizmet kategori sil ------------------------------------------------------------------
    public function hizmetKategoriSil(Request $request){ 

        try{

            //kategoriye ait hizmetleri resimlerini sil
            $hizmetler = Hizmet::where('kategori_id', $request->id)->get();

            if(count($hizmetler) > 0){
                foreach($hizmetler as $hizmet){
                    $resimler  = HizmetResim::where('hizmet_id', intval($hizmet->id))->get();         
                    //hizmete ait reim varsa
                    if (count($resimler) > 0) {
                        foreach($resimler as $hizmetResim){
                            //resim varsa sil -----------------------------------------------------                
                            if(is_file('uploads/resim/hizmet/'.$hizmetResim->resim) ){
                                \File::delete( 'uploads/resim/hizmet/'.$hizmetResim->resim );
                            }
                            //--------------------------------------------------------------------
                        }
                    }
                }    
            }

            $kategori =  HizmetKategori::where('id', intval($request->id))->first();
            //kategorinin ana resmini sil
            if(is_file('uploads/resim/hizmet/'.$kategori->resim) ){
                \File::delete( 'uploads/resim/hizmet/'.$kategori->resim );                
            }

            HizmetKategori::where('id', intval($request->id))->delete();    

            return response()->json(["durum" => "success", "mesaj" => "Kategori silindi"]);
        }catch(\Exception $e){
            return response()->json(["durum" => "error", "mesaj" => "Hata oluştu<br>",$e->getMessage()]); 
        }        
    }
    //  ./ panel hizmet kategori sil -----------------------------------------------------------
  


}// ************************************************************************************************
