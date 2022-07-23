<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Image;

//models
use App\Models\ProjeKategori;
use App\Models\Proje;
use App\Models\ProjeResim;
use App\Models\Diller;
use App\Models\Ayar;


class projeController extends Controller
{
   
     private $panel_limit;

    public function __constructur(){
        //panel sayfalama  limit
        $ayar = Ayar::first();
        $this->panel_limit = $ayar->panel_limit; 
    }


    //panel proje kategori listesi sayfası ----------------------------------------------------------
    public function kategoriList(){
        $kategoriler = ProjeKategori::orderBy('kategori_adi', 'asc')->paginate($this->panel_limit);

        return view("Panel.proje.kategori-list", compact("kategoriler"));
    }
    // ./panel proje kategori listesi sayfası --------------------------------------------------------

   
    //panel proje kategori ekle sayfası --------------------------------------------------------------
    public function kategoriEkle(){
        $diller = Diller::where('aktif', 1)->get();
        return view("Panel.proje.kategori-ekle", compact("diller"));
    }
    // ./panel proje kategori ekle sayfası ----------------------------------------------------------

    //proje kategori ekle ajax post ----------------------------------------------------------------
    public function kategoriEklePost(Request $request){  

        if(isset($request->anasayfa_goster) && $request->anasayfa_goster == 'on'){
            $anasayfa_goster = 1;
        }else{
            $anasayfa_goster = 0;
        }      

        try{            
           
            $kategori = new ProjeKategori;
            $kategori->dil_id       = intval($request->dil_id);
            $kategori->kategori_adi = trim($request->kategori_adi);                  
            $kategori->slug         = trim(\Str::slug($request->kategori_adi, '-')); 
            $kategori->anasayfa_goster = $anasayfa_goster;
            
            //proje kategori resim upload            
            if($request->hasFile('resim') ){
                $image       = $request->file('resim');               
                $image_name  = $image->getClientOriginalName();
                //proje dizin yoksa oluştur
                if(!is_dir('uploads/resim/proje')){                    
                    \File::makeDirectory('uploads/resim/proje', $mode = 0777, true, true);
                }
                $uploadPath  = 'uploads/resim/proje';

                $image_resize = Image::make($image->getRealPath());
              
                $image_resize->resize(null, 600, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($uploadPath.'/'.$image_name);               

                $kategori->resim  = $image_name;
            } 
            $kategori->save();  


            return response()->json(["durum" => "success", "mesaj" => "Kategori başarıyla kaydedildi"]);          
           
        }catch(\Exception $e){
            return response()->json([
                "durum"=>"error", "mesaj"=>"Kategori kaydedilemedi! ->".$e->getMessage()
            ]);                       
        } 
       
    }// ./proje kategori ekle ajax post -------------------------------------------------------------



     //panel proje katgori düzenle sayfası ----------------------------------------------------------
     public function kategoriDuzenle($slug){
        $diller   = Diller::where('aktif', 1)->get();
        $kategori = ProjeKategori::where('slug', $slug)->first();
        return view("Panel.proje.kategori-duzenle", compact("kategori", "diller"));
    }
    // ./panel proje katgori düzenle sayfası --------------------------------------------------------



    //proje kategori duzenle ajax post ----------------------------------------------------------------
    public function kategoriDuzenlePost(Request $request){
       
        try{ 

            if(isset($request->anasayfa_goster) && $request->anasayfa_goster == 'on'){
                $anasayfa_goster = 1;
            }else{
                $anasayfa_goster = 0;
            } 
            
            $kategori = ProjeKategori::where('id', intval($request->id))->first();
            $resim    = $kategori->resim; //mevcut resim adını sakla

            //yeni resim gelmişse eskisini sil, yenisini upload et -------------------            
            if($request->hasFile('resim') ){

                //eski resmi sil -----------------------------------------------------                
                if(is_file('uploads/resim/proje/'.$kategori->resim) ) {
                    \File::delete( 'uploads/resim/proje/'.$kategori->resim );                    
                }
                //--------------------------------------------------------------------

                $image       = $request->file('resim');               
                $image_name  = $image->getClientOriginalName();
                //proje dizin yoksa oluştur
                if(!is_dir('uploads/resim/proje')){                    
                    \File::makeDirectory('uploads/resim/proje', $mode = 0777, true, true);
                }
                $uploadPath  = 'uploads/resim/proje';

                $image_resize = Image::make($image->getRealPath());
               
                $image_resize->resize(null, 600, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($uploadPath.'/'.$image_name);               

                $resim  = $image_name; //yeni resim adını yaz
            } 
            //---------------------------------------------------------------------------
           
            ProjeKategori::where("id", intval($request->id))->update([
               'dil_id'          => intval($request->dil_id),
               'kategori_adi'    => trim($request->kategori_adi),                 
               'slug'            => trim(\Str::slug($request->kategori_adi, '-')),
               'resim'           => $resim,
               'anasayfa_goster' => $anasayfa_goster 
            ]);

            return response()->json(["durum" => "success", "mesaj" => "Kategori başarıyla güncellendi"]);          
           
        }catch(\Exception $e){
            return response()->json([
                "durum"=>"error", "mesaj"=>"Kategori güncellenemedi! ->".$e->getMessage()
            ]);                       
        } 
       
    }// ./proje kategori düzenle ajax post -------------------------------------------------------------



    //panel proje kategori resim sil ------------------------------------------------------------------
    public function kategoriResimSil(Request $request){ 
        $kategori =  ProjeKategori::where('id', intval($request->id))->first();

        try{
            if(is_file('uploads/resim/proje/'.$kategori->resim) ){
                \File::delete( 'uploads/resim/proje/'.$kategori->resim );                
            }

            ProjeKategori::where('id', intval($request->id))->update(["resim" => ""]);    

            return response()->json(["durum" => "success", "mesaj" => "Resim başarıyla silindi"]);
        }catch(\Exception $e){
            return response()->json(["durum" => "error", "mesaj" => "Hata oluştu<br>",$e->getMessage()]); 
        }        
    }
    //  ./ panel proje kategori resim sil -----------------------------------------------------------
  

    //panel proje kategori sil ------------------------------------------------------------------
    public function kategoriSil(Request $request){ 

        try{

            //kategoriye ait projelerin resimlerini sil
            $projeler = Proje::where('kategori_id', $request->id)->get();

            if(count($projeler) > 0){
                foreach($projeler as $proje){
                    $resimler  = ProjeResim::where('proje_id', intval($proje->id))->get();         
                    //projeye ait reim varsa
                    if (count($resimler) > 0) {
                        foreach($resimler as $projeResim){
                            //resim varsa sil -----------------------------------------------------                
                            if(is_file('uploads/resim/proje/'.$projeResim->resim) ){
                                \File::delete( 'uploads/resim/proje/'.$projeResim->resim );
                            }
                            //--------------------------------------------------------------------
                        }
                    }
                }    
            }

            $kategori =  ProjeKategori::where('id', intval($request->id))->first();
            //kategorinin ana resmini sil
            if(is_file('uploads/resim/proje/'.$kategori->resim) ){
                \File::delete( 'uploads/resim/proje/'.$kategori->resim );                
            }

            ProjeKategori::where('id', intval($request->id))->delete();    

            return response()->json(["durum" => "success", "mesaj" => "Proje kategorisi başarıyla silindi"]);
        }catch(\Exception $e){
            return response()->json(["durum" => "error", "mesaj" => "Hata oluştu<br>",$e->getMessage()]); 
        }        
    }
    //  ./ panel proje kategori sil -----------------------------------------------------------
  
//*************************************************************************************************


   
    //panel proje listesi sayfası -----------------------------------------------------------------
    public function projeList(){
        $projeler = Proje::orderBy('id', 'desc')->orderBy('aktif', 'desc')->paginate($this->panel_limit);

        return view("Panel.proje.list", compact("projeler"));
    }
    // ./panel proje listesi sayfası ---------------------------------------------------------------


    //panel proje ekle sayfası --------------------------------------------------------------------
    public function projeEkle(){
        $diller = Diller::where('aktif', 1)->get();
        $kategoriler = ProjeKategori::orderBy('kategori_adi')->get();
        return view("Panel.proje.ekle", compact("diller", "kategoriler"));
    }
    // ./panel proje ekle sayfası -----------------------------------------------------------------



    //proje ekle ajax post ------------------------------------------------------------------------
    public function projeEklePost(Request $request){

        if(isset($request->anasayfa_goster) && $request->anasayfa_goster == 'on'){
            $anasayfa_goster = 1;
        }else{
            $anasayfa_goster = 0;
        }

        try{            
           
            $proje = new Proje;
            $proje->kategori_id     = intval($request->kategori_id);
            $proje->dil_id          = intval($request->dil_id);
            $proje->proje_adi       = trim($request->proje_adi);
            $proje->ozet            = trim($request->ozet);  
            $proje->aciklama        = trim($request->aciklama);  
            $proje->anasayfa_goster = $anasayfa_goster; 
            $proje->slug            = trim(\Str::slug($request->proje_adi, '-'));
            $proje->aktif           = intval($request->aktif);
            $proje->etiket          = trim($request->etiket);
            $proje->video_link      = trim($request->video_link);
            $proje->isveren         = trim($request->isveren);
            $proje->lokasyon        = trim($request->lokasyon);
            $proje->baslama_tarihi  = trim($request->baslama_tarihi);
            $proje->bitis_tarihi    = trim($request->bitis_tarihi);
            $proje->durumu          = trim($request->durumu);
            $proje->description     = trim($request->description);
            $proje->keywords        = trim($request->keywords);
            $proje->hizmet_alani    = trim($request->hizmet_alani);

            //projee ait ana resim var mı -----------------------------------------------------            
            if($request->hasFile('ana_resim') ){
                $resim       = $request->file('ana_resim');               
                $ana_resim_name  = $resim->getClientOriginalName();
                //resim/proje dizin yoksa oluştur
                if(!is_dir('uploads/resim/proje')){                    
                    \File::makeDirectory('uploads/resim/proje', $mode = 0777, true, true);
                }

                $uploadPath  = 'uploads/resim/proje';

                $image_resize = Image::make($resim->path());
               
                $watermark = Image::make('assets/site/img/filigran2.png');
                $image_resize->resize(null, 600, function ($constraint) {
                    $constraint->aspectRatio();
                })->insert($watermark, 'center')
                ->save($uploadPath.'/'.$ana_resim_name);              

                $proje->resim  = $ana_resim_name;
            } 
            
            //projeye ait video var mı -----------------------------------------------------            
            if($request->hasFile('video') ){
                $dosya       = $request->file('video');               
                $dosya_name  = $dosya->getClientOriginalName();
                //video/proje dizin yoksa oluştur
                if(!is_dir('uploads/video/proje')){                    
                    \File::makeDirectory('uploads/video/proje', $mode = 0777, true, true);
                }

                $uploadPath  = 'uploads/video/proje';
               
                $dosya->move($uploadPath, $dosya_name);               

                $proje->video  = $dosya_name;
            } 

            $proje->save();  

            //projee ait diğer resimlerin eklenmesi -----------------------------------
            if($request->hasFile('resim') ){                

                foreach($request->file('resim') as $image){
                    $name  = $image->getClientOriginalName();
                    //proje dizin yoksa oluştur
                    if(!is_dir('uploads/resim/proje')){
                        
                        \File::makeDirectory('uploads/resim/proje', $mode = 0777, true, true);
                    }
                    $uploadPath  = 'uploads/resim/proje';
                    
                    $image_resize = Image::make($image->getRealPath());

                    $watermark = Image::make('assets/site/img/filigran2.png');
                    $image_resize->resize(null, 600, function ($constraint) {
                        $constraint->aspectRatio();
                    })->insert($watermark, 'center')
                    ->save($uploadPath.'/'.$name);   
                    
                    $projeResim = new ProjeResim;
                    $projeResim->proje_id = $proje->id;
                    $projeResim->resim = $name;
                    $projeResim->save();
                } 
            }                    

            return response()->json(["durum" => "success", "mesaj" => "Proje kaydedildi"]);          
           
        }catch(\Exception $e){
            return response()->json([
                "durum"=>"error", "mesaj"=>"Proje kaydedilemedi! ->".$e->getMessage()
            ]);                       
        } 
       
    }// ./proje ekle ajax post ---------------------------------------------------------------------



    //panel proje düzenle sayfası --------------------------------------------------------------------
    public function projeDuzenle($slug){
        $diller = Diller::where('aktif', 1)->get();
        $kategoriler = ProjeKategori::orderBy('kategori_adi')->get();
        $proje = Proje::where('slug', $slug)->first();
        return view("Panel.proje.duzenle", compact("proje", "diller" ,"kategoriler"));
    }
    // ./panel proje düzenle sayfası -----------------------------------------------------------------
    

    //proje ekle ajax post ------------------------------------------------------------------------
    public function projeDuzenlePost(Request $request){

        //dd($request->all());

        if(isset($request->anasayfa_goster) && $request->anasayfa_goster == 'on'){
            $anasayfa_goster = 1;
        }else{
            $anasayfa_goster = 0;
        }

       try{            
            
            $proje  = Proje::where('id', intval($request->id))->first();
            $video = $proje->video; //mevcut video adını sakla 
            $resim = $proje->resim; //mevcut ana resmin adını sakla 

            //projeye ait ana resim var mı -----------------------------------------------------            
            if($request->hasFile('ana_resim') ){
                $resim       = $request->file('ana_resim');               
                $ana_resim_name  = $resim->getClientOriginalName();
                //resim/proje dizin yoksa oluştur
                if(!is_dir('uploads/resim/proje')){                    
                    \File::makeDirectory('uploads/resim/proje', $mode = 0777, true, true);
                }

                $uploadPath  = 'uploads/resim/proje';
               
                $image_resize = Image::make($resim->path());
               
                $watermark = Image::make('assets/site/img/filigran2.png');
                $image_resize->resize(null, 600, function ($constraint) {
                    $constraint->aspectRatio();
                })->insert($watermark, 'center')
                ->save($uploadPath.'/'.$ana_resim_name);               

                $resim  = $ana_resim_name;
            } 

            
            //projeye ait video var mı -----------------------------------------------------            
            if( $request->hasFile('video') ){  
               
                $dosya       = $request->file('video');               
                $dosya_name  = $dosya->getClientOriginalName();
                
                //video/proje dizin yoksa oluştur
                if(!is_dir('uploads/video/proje')){                    
                    \File::makeDirectory('uploads/video/proje', $mode = 0777, true, true);
                }

                //eski videosunu sil
                \File::delete('uploads/video/proje/'.$proje->video);

                $uploadPath  = 'uploads/video/proje';
               
                $dosya->move($uploadPath, $dosya_name);               

                $video  = $dosya_name;
            }

            Proje::where('id', intval($request->id))->update([
                    'kategori_id'     => intval($request->kategori_id),
                    'dil_id'          => intval($request->dil_id),
                    'proje_adi'       => trim($request->proje_adi),
                    'ozet'            => trim($request->ozet),  
                    'aciklama'        => trim($request->aciklama),  
                    'anasayfa_goster' => $anasayfa_goster, 
                    'slug'            => trim(\Str::slug($request->proje_adi, '-')),
                    'aktif'           => intval($request->aktif),
                    'etiket'          => trim($request->etiket),
                    'video_link'      => trim($request->video_link),
                    'video'           => $video,
                    'resim'           => $resim,
                    'isveren'         => trim($request->isveren),
                    'lokasyon'        => trim($request->lokasyon),
                    'baslama_tarihi'  => trim($request->baslama_tarihi),
                    'bitis_tarihi'    => trim($request->bitis_tarihi),
                    'durumu'          => trim($request->durumu),
                    'description'     => trim($request->description),
                    'keywords'        => trim($request->keywords),
                    'hizmet_alani'    => trim($request->hizmet_alani)                                
                   
            ]);

            //projeey ait diğer resimlerin eklenmesi -
            if($request->hasFile('resim') ){                

                foreach($request->file('resim') as $image){
                    $name  = $image->getClientOriginalName();
                    //proje dizin yoksa oluştur
                    if(!is_dir('uploads/resim/proje')){
                       
                        \File::makeDirectory('uploads/resim/proje', $mode = 0777, true, true);
                    }
                    $uploadPath  = 'uploads/resim/proje';
                    
                    $image_resize = Image::make($image->getRealPath());

                    $watermark = Image::make('assets/site/img/filigran2.png');
                    $image_resize->resize(null, 600, function ($constraint) {
                        $constraint->aspectRatio();
                    })->insert($watermark, 'center')
                    ->save($uploadPath.'/'.$name);  
                    
                    $projeResim = new ProjeResim;
                    $projeResim->proje_id = $request->id;
                    $projeResim->resim = $name;
                    $projeResim->save();
                } 
            }                             

            return response()->json(["durum" => "success", "mesaj" => "Proje güncellendi"]);          
           
        }catch(\Exception $e){
            return response()->json([
                "durum"=>"error", "mesaj"=>"Proje güncellenemedi! ->".$e->getMessage()
            ]);                       
        } 
       
    }// ./proje ekle ajax post ---------------------------------------------------------------------



    //proje sil ajax post ------------------------------------------------------------------------
    public function projeSil(Request $request){
        try{            
            
            $resimler  = ProjeResim::where('proje_id', intval($request->id))->get();         

            if (count($resimler) > 0) {
                foreach($resimler as $projeResim){
                    //resim varsa sil -----------------------------------------------------                
                    if(is_file('uploads/resim/proje/'.$projeResim->resim) ){
                        \File::delete( 'uploads/resim/proje/'.$projeResim->resim );
                    }
                    //--------------------------------------------------------------------
                }
            }

            $proje = Proje::where("id",  intval($request->id))->first();

            //videosunu sil
            @\File::delete( 'uploads/video/proje/'.$proje->video );
            
            Proje::where('id', intval($request->id))->delete();

            return response()->json(["durum" => "success", "mesaj" => "Proje silindi"]);          
           
        }catch(\Exception $e){
            return response()->json([
                "durum"=>"error", "mesaj"=>"Proje silinemedi! ->".$e->getMessage()
            ]);                       
        } 
    }
    //  ./ proje sil ajax post ---------------------------------------------------------------------


    //panel proje resim sil -------------------------------------------------------------------------
    public function resimSil(Request $request){

        $id = intval($request->id);
        $resim = ProjeResim::where('id', $id)->first();

        ProjeResim::where('id', $id)->delete();

        if(is_file('uploads/resim/proje/'.$resim->resim) ){
            \File::delete( 'uploads/resim/proje/'.$resim->resim );
            return response()->json(["durum" => "success", "mesaj" => "Proje resmi silindi"]);
        }        

        return response()->json(["durum" => "error", "mesaj" => "Böyle bir resim bulunamadı"]);
    }
    //  ./ panel proje resim sil --------------------------------------------------------------------
    


    //proje resim sırala ajax ------------------------------------------------------------
    public function resimSirala(Request $request){  
        foreach ($request->sira as $sira) {           
           $sirala = ProjeResim::where("id", $sira[0])->update(["sira" => $sira[1]]);
        }
    }
    //  ./proje resim sırala ajax bitiş --------------------------------------------------



     //video sil --------------------------------------------------------------------------------
    public function videoSil(Request $request){
        $id   = $request->id;
        $row = Proje::where('id', $id)->first();       
       
        @\File::delete( 'uploads/video/proje/'.$row->video );
        Proje::where('id', $id)->update(["video"=>""]);
        return response()->json(["durum" => "success", "mesaj" => "Video silindi"]);
       
    }
    //  ./ video sil ---------------------------------------------------------------------------




}// ************************************************************************************************
