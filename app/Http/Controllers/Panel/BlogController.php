<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Image;

//models
use App\Models\Blog;
use App\Models\BlogResim;
use App\Models\Diller;
use App\Models\Ayar;


class BlogController extends Controller
{
    
    private $panel_limit;

    public function __constructur(){
        //panel sayfalama  limit
        $ayar = Ayar::first();
        $this->panel_limit = $ayar->panel_limit; 
    }

    //panel blog listesi sayfası -----------------------------------------------------------------
    public function blogList(){
        $bloglar = Blog::orderBy('id', 'desc')->orderBy('aktif', 'desc')->paginate($this->panel_limit);

        return view("Panel.blog.list", compact("bloglar"));
    }
    // ./panel blog listesi sayfası ---------------------------------------------------------------


    //panel blog ekle sayfası --------------------------------------------------------------------
    public function blogEkle(){
        $diller = Diller::where('aktif', 1)->get();
        return view("Panel.blog.ekle", compact("diller"));
    }
    // ./panel blog ekle sayfası -----------------------------------------------------------------



    //blog ekle ajax post ------------------------------------------------------------------------
    public function blogEklePost(Request $request){

        if(isset($request->anasayfa_goster) && $request->anasayfa_goster == 'on'){
            $anasayfa_goster = 1;
        }else{
            $anasayfa_goster = 0;
        }

        try{            
           
            $blog = new Blog; 
            $blog->dil_id          = intval($request->dil_id);          
            $blog->baslik          = trim($request->baslik);
            $blog->ozet            = trim($request->ozet);  
            $blog->icerik          = trim($request->icerik);  
            $blog->anasayfa_goster = $anasayfa_goster; 
            $blog->slug            = trim(\Str::slug($request->baslik, '-'));
            $blog->aktif           = intval($request->aktif);
            $blog->etiket          = trim($request->etiket);
            $blog->video_link      = trim($request->video_link); 
            $blog->description     = trim($request->description); 
            $blog->keywords        = trim($request->keywords);           

            //blog ana resim upload            
            if($request->hasFile('ana_resim') ){
                $image       = $request->file('ana_resim');               
                $image_name  = $image->getClientOriginalName();
                //blog dizin yoksa oluştur
                if(!is_dir('uploads/resim/blog')){                    
                    \File::makeDirectory('uploads/resim/blog', $mode = 0777, true, true);
                }
                $uploadPath  = 'uploads/resim/blog';

                $image_resize = Image::make($image->getRealPath());
                $watermark = Image::make('assets/site/img/filigran2.png');
                $image_resize->resize(null, 600, function ($constraint) {
                    $constraint->aspectRatio();
                })->insert($watermark, 'center')->save($uploadPath.'/'.$image_name);               

                $blog->resim  = $image_name;
            }   

            //bloga ait video var mı -----------------------------------------------------            
            if($request->hasFile('video') ){
                $dosya       = $request->file('video');               
                $dosya_name  = $dosya->getClientOriginalName();
                //video/proje dizin yoksa oluştur
                if(!is_dir('uploads/video/blog')){                    
                    \File::makeDirectory('uploads/video/blog', $mode = 0777, true, true);
                }

                $uploadPath  = 'uploads/video/blog';
               
                $dosya->move($uploadPath, $dosya_name);               

                $blog->video  = $dosya_name;
            } 

            $blog->save(); 

            //bloga ait diğer resimlerin eklenmesi -
            if($request->hasFile('resim') ){                

                foreach($request->file('resim') as $image){
                    $name  = $image->getClientOriginalName();
                    //blog dizin yoksa oluştur
                    if(!is_dir('uploads/resim/blog')){                       
                        \File::makeDirectory('uploads/resim/blog', $mode = 0777, true, true);
                    }
                    $uploadPath  = 'uploads/resim/blog';
                    
                    $image_resize = Image::make($image->getRealPath());

                    $watermark = Image::make('assets/site/img/filigran2.png');
                    $image_resize->resize(null, 600, function ($constraint) {
                        $constraint->aspectRatio();
                    })->insert($watermark, 'center')->save($uploadPath.'/'.$image_name);   
                    
                    $blogResim = new BlogResim;
                    $blogResim->blog_id = $blog->id;
                    $blogResim->resim = $name;
                    $blogResim->save();
                } 
            }                       

            return response()->json(["durum" => "success", "mesaj" => "Blog kaydedildi"]);          
           
        }catch(\Exception $e){
            return response()->json([
                "durum"=>"error", "mesaj"=>"Blog kaydedilemedi! ->".$e->getMessage()
            ]);                       
        } 
       
    }// ./blog ekle ajax post ---------------------------------------------------------------------



    //panel blog düzenle sayfası --------------------------------------------------------------------
    public function blogDuzenle($slug){
        $diller = Diller::where('aktif', 1)->get();
        $blog = Blog::where('slug', $slug)->first();        
        return view("Panel.blog.duzenle", compact("blog", "diller"));
    }
    // ./panel blog düzenle sayfası -----------------------------------------------------------------


    //panel blog resim sil -------------------------------------------------------------------------
    public function blogResimSil(Request $request){
        $id   = $request->id;
        $blogresim = BlogResim::where('id', $id)->first();
       
        //if(is_file('uploads/resim/blog/'.$blogresim->resim) ){
            @\File::delete( 'uploads/resim/blog/'.$blogresim->resim );
            BlogResim::where('id', $id)->delete();
            return response()->json(["durum" => "success", "mesaj" => "Blog resmi silindi"]);
        //}

        //return response()->json(["durum" => "error", "mesaj" => "Böyle bir resim bulunamadı"]);
    }
    //  ./ panel blog resim sil --------------------------------------------------------------------
    


    //blog ekle ajax post ------------------------------------------------------------------------
    public function blogDuzenlePost(Request $request){

       if(isset($request->anasayfa_goster) && $request->anasayfa_goster == 'on'){
            $anasayfa_goster = 1;
        }else{
            $anasayfa_goster = 0;
        }

        try{
            $blog      = Blog::where('id', intval($request->id))->first();
            $video     = $blog->video; //mevcut video adını sakla 
            $ana_resim = $blog->resim; //mevcut resim adını sakla

            //yeni ana resim gelmişse eskisini sil, yenisini upload et --------------            
            if($request->hasFile('ana_resim') ){

                //eski resmi sil -----------------------------------------------------                
                if(is_file('uploads/resim/blog/'.$blog->resim) )
                {
                    \File::delete( 'uploads/resim/blog/'.$blog->resim );                    
                }
                //--------------------------------------------------------------------

                $image       = $request->file('ana_resim');               
                $image_name  = $image->getClientOriginalName();
                //blog dizin yoksa oluştur
                if(!is_dir('uploads/resim/blog')){                    
                    \File::makeDirectory('uploads/resim/blog', $mode = 0777, true, true);
                }
                $uploadPath  = 'uploads/resim/blog';

                $image_resize = Image::make($image->getRealPath());

                $watermark = Image::make('assets/site/img/filigran2.png');
                $image_resize->resize(null, 600, function ($constraint) {
                    $constraint->aspectRatio();
                })->insert($watermark, 'center')
                ->save($uploadPath.'/'.$image_name);               

                $ana_resim  = $image_name; //yeni resim adını yaz
            } 
            //---------------------------------------------------------------------------  

            //bloga ait video var mı -----------------------------------------------------            
            if( $request->hasFile('video') ){  
               
                $dosya       = $request->file('video');               
                $dosya_name  = $dosya->getClientOriginalName();
                
                //video/blog dizin yoksa oluştur
                if(!is_dir('uploads/video/blog')){                    
                    \File::makeDirectory('uploads/video/blog', $mode = 0777, true, true);
                }

                //eski videosunu sil
                \File::delete('uploads/video/blog/'.$blog->video);

                $uploadPath  = 'uploads/video/blog';
               
                $dosya->move($uploadPath, $dosya_name);               

                $video  = $dosya_name;
            }

            Blog::where('id', intval($request->id))->update([
                    'dil_id'          => intval($request->dil_id), 
                    'baslik'          => trim($request->baslik),
                    'ozet'            => trim($request->ozet),  
                    'icerik'          => trim($request->icerik),  
                    'anasayfa_goster' => $anasayfa_goster, 
                    'slug'            => trim(\Str::slug($request->baslik, '-')),
                    'aktif'           => intval($request->aktif),
                    'etiket'          => trim($request->etiket),
                    'video_link'      => trim($request->video_link),
                    'description'     => trim($request->description),
                    'keywords'        => trim($request->keywords),
                    'resim'           => $ana_resim, 
                    'video'           => $video 
            ]);  

            //bloga ait diğer resimlerin eklenmesi -
            if($request->hasFile('resim') ){                

                foreach($request->file('resim') as $image){
                    $image_name  = $image->getClientOriginalName();
                    //blog dizin yoksa oluştur
                    if(!is_dir('uploads/resim/blog')){
                        \File::makeDirectory('uploads/resim/blog', $mode = 0777, true, true);
                    }
                    $uploadPath  = 'uploads/resim/blog';
                    
                    $image_resize = Image::make($image->getRealPath());

                    $watermark = Image::make('assets/site/img/filigran2.png');
                    $image_resize->resize(null, 600, function ($constraint) {
                        $constraint->aspectRatio();
                    })->insert($watermark, 'center')
                    ->save($uploadPath.'/'.$image_name);    
                    
                    $blogResim = new BlogResim;
                    $blogResim->blog_id = $request->id;
                    $blogResim->resim = $image_name;
                    $blogResim->save();
                } 
            }                       

            return response()->json(["durum" => "success", "mesaj" => "Blog güncellendi"]);          
           
        }catch(\Exception $e){
            return response()->json([
                "durum"=>"error", "mesaj"=>"Blog güncellenemedi! ->".$e->getMessage()
            ]);                       
        } 
       
    }// ./blog ekle ajax post ---------------------------------------------------------------------



    //blog sil ajax post ------------------------------------------------------------------------
    public function blogSil(Request $request){
        try{            
            
            $resimler  = BlogResim::where('blog_id', intval($request->id))->get();         

            if (count($resimler) > 0) {
                foreach($resimler as $blogResim){
                    //resim varsa sil -----------------------------------------------------                
                    if(is_file('uploads/resim/blog/'.$blogResim->resim) ){
                        \File::delete( 'uploads/resim/blog/'.$blogResim->resim );
                    }
                    //--------------------------------------------------------------------
                }
            }

            $blog = Blog::where("id",  intval($request->id))->first();

            //videosunu sil
            @\File::delete( 'uploads/video/blog/'.$blog->video);
            
            Blog::where('id', intval($request->id))->delete();

            return response()->json(["durum" => "success", "mesaj" => "Blog silindi"]);          
           
        }catch(\Exception $e){
            return response()->json([
                "durum"=>"error", "mesaj"=>"Blog silinemedi! ->".$e->getMessage()
            ]);                       
        } 
    }
    //  ./ blog sil ajax post ---------------------------------------------------------------------


    //video sil --------------------------------------------------------------------------------
    public function videoSil(Request $request){
        $id   = $request->id;
        $blogvideo = Blog::where('id', $id)->first();       
        
        @\File::delete( 'uploads/video/blog/'.$blogvideo->video );
        Blog::where('id', $id)->update(["video"=>""]);
        return response()->json(["durum" => "success", "mesaj" => "Video silindi"]);
        
    }
    //  ./ video sil ---------------------------------------------------------------------------
   



}// ************************************************************************************************
