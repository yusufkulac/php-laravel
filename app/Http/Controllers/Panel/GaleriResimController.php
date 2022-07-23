<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Image;

//models
use App\Models\GaleriResimKategori;
use App\Models\GaleriResim;
use App\Models\Diller;


class GaleriResimController extends Controller
{
    //panel galeri kategori listesi sayfası --------------------------------------------------------
    public function galeriKategoriList(){
        $kategoriler = GaleriResimKategori::orderBy('id', 'desc')->paginate(10);

        return view("Panel.galeriresim.kategori-list", compact("kategoriler"));
    }
    // ./panel galeri kategori listesi sayfası ------------------------------------------------------


    //panel galeri kategori ekle sayfası -----------------------------------------------------------
    public function galeriKategoriEkle(){
        $diller = Diller::where('aktif', 1)->get();
        return view("Panel.galeriresim.kategori-ekle", compact("diller"));
    }
    // ./panel galeri kategori ekle sayfası --------------------------------------------------------



    //galeri ekle ajax post ------------------------------------------------------------------------
    public function galeriKategoriEklePost(Request $request){

        try{            
           
            $galeriKat = new GaleriResimKategori; 
            $galeriKat->dil_id     = intval($request->dil_id);          
            $galeriKat->galeri_adi = trim($request->galeri_adi);           
            $galeriKat->slug       = trim(\Str::slug($request->galeri_adi, '-'));

            //galeri ana resim upload            
            if($request->hasFile('resim') ){
                $image       = $request->file('resim');               
                $image_name  = $image->getClientOriginalName();
                //galeri dizin yoksa oluştur
                if(!is_dir('uploads/resim/galeri')){                    
                    \File::makeDirectory('uploads/resim/galeri', $mode = 0777, true, true);
                }
                $uploadPath  = 'uploads/resim/galeri';

                $image_resize = Image::make($image->getRealPath());

                $image_resize->resize(null, 600, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($uploadPath.'/'.$image_name);               

                $galeriKat->resim  = $image_name;
            } 

            $galeriKat->save(); 

            return response()->json(["durum" => "success", "mesaj" => "Resim Kategorisi eklendi"]);          
           
        }catch(\Exception $e){
            return response()->json([
                "durum"=>"error", "mesaj"=>"Kayıt hatası ->".$e->getMessage()
            ]);                       
        } 
       
    }// ./galeri ekle ajax post ---------------------------------------------------------------------



    //panel galeri düzenle sayfası --------------------------------------------------------------------
    public function galeriKategoriDuzenle($id){
        $diller = Diller::where('aktif', 1)->get();
        $kategori = GaleriResimKategori::where('id', intval($id))->first();        
        return view("Panel.galeriresim.kategori-duzenle", compact("kategori", "diller"));
    }
    // ./panel galeri düzenle sayfası -----------------------------------------------------------------


    //galeri ekle ajax post ------------------------------------------------------------------------
    public function galeriKategoriDuzenlePost(Request $request){
 

        try{
            $galeri     = GaleriResimKategori::where('id', intval($request->id))->first();          
            $ana_resim = $galeri->resim; //mevcut resim adını sakla

            //yeni ana resim gelmişse eskisini sil, yenisini upload et --------------            
            if($request->hasFile('resim') ){

                //eski resmi sil -----------------------------------------------------                
                if(is_file('uploads/resim/galeri/'.$galeri->resim) )
                {
                    \File::delete( 'uploads/resim/galeri/'.$galeri->resim );                    
                }
                //--------------------------------------------------------------------

                $image       = $request->file('resim');               
                $image_name  = $image->getClientOriginalName();
                //galeri dizin yoksa oluştur
                if(!is_dir('uploads/resim/galeri')){                    
                    \File::makeDirectory('uploads/resim/galeri', $mode = 0777, true, true);
                }
                $uploadPath  = 'uploads/resim/galeri';

                $image_resize = Image::make($image->getRealPath());

                $image_resize->resize(null, 600, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($uploadPath.'/'.$image_name);               

                $ana_resim  = $image_name; //yeni resim adını yaz
            } 
            //---------------------------------------------------------------------------  

            
            GaleriResimKategori::where('id', intval($request->id))->update([
                    'dil_id'     => intval($request->dil_id), 
                    'galeri_adi' => trim($request->galeri_adi),
                    'slug'       => trim(\Str::slug($request->galeri_adi, '-')),
                    'resim'      => $ana_resim
            ]);                               

            return response()->json(["durum" => "success", "mesaj" => "Kategori güncellendi"]);          
           
        }catch(\Exception $e){
            return response()->json([
                "durum"=>"error", "mesaj"=>"Kategori güncellenemedi! ->".$e->getMessage()
            ]);                       
        } 
       
    }// ./galeri ekle ajax post ---------------------------------------------------------------------
    

    //galeri sil ajax post ------------------------------------------------------------------------
    public function galeriKategoriSil(Request $request){
        try{            
            
            //galeriye bağlı resimleri sil 
            $resimler  = GaleriResim::where('galeri_id', intval($request->id))->get();         

            if (count($resimler) > 0) {
                foreach($resimler as $galeriResim){
                    //resim varsa sil -----------------------------------------------------                
                    if(is_file('uploads/resim/galeri/'.$galeriResim->resim) ){
                        \File::delete( 'uploads/resim/galeri/'.$galeriResim->resim );
                    }
                    //--------------------------------------------------------------------
                }
            }

            //galerinin kendi resmini sil
            $kategori = GaleriResimKategori::where('id', intval($request->id))->first();
            @\File::delete( 'uploads/resim/galeri/'.$kategori->resim );

            GaleriResimKategori::where('id', intval($request->id))->delete();

            return response()->json(["durum" => "success", "mesaj" => "Galeri silindi"]);          
           
        }catch(\Exception $e){
            return response()->json([
                "durum"=>"error", "mesaj"=>"Galeri silinemedi! ->".$e->getMessage()
            ]);                       
        } 
    }
    //  ./ galeri sil ajax post ---------------------------------------------------------------------


// *-*-*-*-*-*-*-*--*-*-*-*-*-*-*-*-*-*-*-*-*-*----------------------------***************************

    //panel galeri resim sayfası -----------------------------------------------------------
    public function galeriResimEkle($id){
        $kategori = GaleriResimKategori::where("id", intval($id))->first();
        return view("Panel.galeriresim.resim-ekle", compact("kategori"));
    }
    // ./panel galeri kategori ekle sayfası --------------------------------------------------------



    //galeri resim ekle ajax post -------------------------------------------------------------------
    public function galeriResimEklePost(Request $request){        

        try{ 

            foreach($request->file('resim') as $image){

                $name  = $image->getClientOriginalName();
                //galeri dizin yoksa oluştur
                if(!is_dir('uploads/resim/galeri')){                    
                    \File::makeDirectory('uploads/resim/galeri', $mode = 0777, true, true);
                }
                $uploadPath  = 'uploads/resim/galeri';
                
                $image_resize = Image::make($image->getRealPath());

                $image_resize->resize(null, 600, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($uploadPath.'/'.$name);   
                
                $galeriResim = new GaleriResim;
                $galeriResim->galeri_id = intval($request->galeri_id);
                $galeriResim->resim = $name;
                $galeriResim->save();
            }                             

            return response()->json(["durum" => "success", "mesaj" => "Resim / Resimler eklendi"]);          
           
        }catch(\Exception $e){
            return response()->json([
                "durum"=>"error", "mesaj"=>"Resim kaydedilemedi! ->".$e->getMessage()
            ]);                       
        } 
       
    }// ./proje ekle ajax post ----------------------------------------------------------------------



    //panel galeri resim sayfası --------------------------------------------------------------------
    public function galeriResimList($id){
        $kategori = GaleriResimKategori::where("id", intval($id))->first();
        $resimler = GaleriResim::where("galeri_id", intval($id))->get();
        return view("Panel.galeriresim.resim-list", compact("resimler", "kategori"));
    }
    // ./panel galeri kategori sayfası --------------------------------------------------------------


    //panel galeri resim sil ------------------------------------------------------------------------
    public function galeriResimSil(Request $request){

        $resimGal = GaleriResim::where('id', intval($request->id))->first();       

        if(is_file('uploads/resim/galeri/'.$resimGal->resim) ){
             GaleriResim::where('id', intval($request->id))->delete();
            \File::delete( 'uploads/resim/galeri/'.$resimGal->resim );
            return response()->json(["durum" => "success", "mesaj" => "Resim silindi"]);
        }        

        return response()->json(["durum" => "error", "mesaj" => "Böyle bir resim bulunamadı"]);
    }
    // ./panel galeri resim sil ------------------------------------------------------------------



}// ************************************************************************************************
