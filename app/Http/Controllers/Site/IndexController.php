<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Slider;
use App\Models\Kurumsal;
use App\Models\TeklifFormu;
use App\Models\HizmetKategori;
use App\Models\ProjeKategori;
use App\Models\Proje;
use App\Models\Blog;
use App\Models\Marka;
use App\Models\Referans;
use App\Models\InsanKaynaklari;
use App\Models\MailList;
use App\Models\Ziyaret;
use App\Models\Ayar;
use App\Models\SiteBilgileri;
use App\Models\Mesaj;
use App\Models\CozumOrtaklari;


class IndexController extends Controller
{
    
    //site index sayfası -----------------------------------------------------------------
    public function index(){ 
        //slider
        $sliders = Slider::orderBy("sira")->get();
        //kurumsal
        $kurumsal = Kurumsal::first();   

        //hizmetler
        $hizmetKategori = HizmetKategori::with("hizmetler")->where("anasayfa_goster", 1)
                                     ->orderBy("sira")->get(); 
        //projeler
        $projeler = Proje::where("anasayfa_goster", 1)->orderBy("id")->limit(6)->get();

        //bloglar
        $bloglar = Blog::where("anasayfa_goster", 1)->orderBy("id")->limit(6)->get();

        //referanslar
        $referanslar = Referans::orderBy("id")->get();

        //çözüm ortakları
        $cozumOrtaklari = CozumOrtaklari::orderBy("id")->get();  

        //ziyaretçi -----------------------------------------------------------------
        $ip = \Request::ip();
        $ua = \Request::server('HTTP_USER_AGENT');
        
        //işletim sistemi
        if (preg_match('/linux/i', $ua)) {
            $os = 'Linux';
        }else if (preg_match('/macintosh|mac os x/i', $ua)) {
            $os = 'Mac';
        }else if (preg_match('/windows|win32/i', $ua)) {
            $os = 'Windows';
        }else{
            $os = "Tanımsız İşletim Sistemi";
        } 

        //browser
        if(preg_match('/MSIE/i',$ua) && !preg_match('/Opera/i',$ua)) { 
            $browser = 'Internet Explorer'; 
        }else if(preg_match('/Firefox/i',$ua)){ 
            $browser = 'Mozilla Firefox';
        }else if(preg_match('/Chrome/i',$ua)){ 
            $browser = 'Google Chrome'; 
        }else if(preg_match('/Safari/i',$ua)){ 
            $browser = 'Apple Safari'; 
        }elseif(preg_match('/Opera/i',$ua)) { 
            $browser = 'Opera';             
        }else if(preg_match('/Netscape/i',$ua)){ 
            $browser = 'Netscape';            
        }else{
            $browser = 'Tanımsız browser';  
        }  

        $ziyaret = Ziyaret::where("ip", $ip)->where("tarih", date("Y-m-d"))->first();
        if($ziyaret == null){
            $ziyaretci = new Ziyaret;
            $ziyaretci->ip = $ip;
            $ziyaretci->os = $os;
            $ziyaretci->browser = $browser;
            $ziyaretci->tarih = date("Y-m-d");
            $ziyaretci->gun = date("d");
            $ziyaretci->ay = date("m");
            $ziyaretci->yil = date("Y");
            $ziyaretci->save();
        }  
        //-------------------------------------------------------------------------------                    

        return view("Site.index.index", compact("sliders", "kurumsal", "hizmetKategori", "projeler", "bloglar", "referanslar", "cozumOrtaklari"));
    }
    // ./site index sayfası ---------------------------------------------------------------



    //teklif formu post -------------------------------------------------------------------
    public function teklifFormuPost(Request $request){
        try{
            
            $teklifFormu = new TeklifFormu; 
            $teklifFormu->adsoyad  = trim($request->adsoyad);
            $teklifFormu->telefon  = trim($request->telefon);
            $teklifFormu->mail     = trim($request->mail);
            $teklifFormu->aciklama = trim($request->aciklama);
            $teklifFormu->ipno     = $request->ip();
            $teklifFormu->save();                          
 
            return response()->json(["durum" => "success", "mesaj" => "Teklif formu bize ulaştı. En kısa zamanda sizinle iletişime geçilecektir."]);
            
         }catch(\Exception $e){
             return response()->json([
                 "durum"=>"error", "mesaj"=>$e->getMessage()
             ]);                       
         } 
    }
    //  ./ teklif formu post ---------------------------------------------------------------


    //site iletişim sayfası -----------------------------------------------------------------
    public function iletisim(){ 
        $ayar = Ayar::first(); 
        return view("Site.index.iletisim", compact("ayar"));
    }
    // ./site iletişim sayfası --------------------------------------------------------------


    //site iletişim post sayfası ------------------------------------------------------------
    public function iletisimPost(Request $request){  
        try{            
           
            $mesaj = new Mesaj; 
            $mesaj->adsoyad = trim($request->ad)." ".trim($request->soyad);
            $mesaj->telefon = trim($request->telefon);
            $mesaj->mail    = trim($request->mail);
            $mesaj->mesaj   = trim($request->mesaj);
            $mesaj->ipno    = $request->ip();

            $mesaj->save();                      

            return response()->json(["durum" => "success", "mesaj" => "Mesajınız bize ulaştı. En kısa zamanda sizinle iletişime geçilecektir"]);          
           
        }catch(\Exception $e){
            return response()->json([
                "durum"=>"error", "mesaj"=>"Mesaj gönder hatası! ->".$e->getMessage()
            ]);                       
        }
    }
    // ./site iletişim post sayfası ---------------------------------------------------------


   //site insan kaynakları sayfası -----------------------------------------------------------------
    public function insanKaynaklari(){  
        return view("Site.index.insan-kaynaklari");
    }
    // ./site insan kaynakları sayfası --------------------------------------------------------------


    //site insan kaynakları post sayfası ------------------------------------------------------------
    public function insanKaynaklariPost(Request $request){  
        try{            
           
            $insanKay = new InsanKaynaklari; 
            $insanKay->adi     = trim($request->ad);
            $insanKay->soyadi  = trim($request->soyad);
            $insanKay->telefon = trim($request->telefon);
            $insanKay->mail    = trim($request->mail);
            $insanKay->ikamet_il = trim($request->ikamet_il);
            $insanKay->basvuru_bolum = trim($request->basvuru_bolum);
            $insanKay->mesaj   = trim($request->mesaj);
            $insanKay->ipno    = $request->ip();

            //eğer cv göndermişse  -----------------------------------------------                       
            if($request->hasFile('cv_dosya') ){
                $dosya       = $request->file('cv_dosya');               
                $dosya_name  = $dosya->getClientOriginalName();
                //dosya/ik dizin yoksa oluştur
                if(!is_dir('uploads/dosya/ik')){                    
                    \File::makeDirectory('uploads/dosya/ik', $mode = 0777, true, true);
                }

                //en fazla 2 mb dosya yüklensin
                if( $request->file('cv_dosya')->getSize() > 2097152 ){
                    return response()->json([
                        "durum"=>"error", "mesaj"=>"Dosya boyutu en fazla 2 MB olabilir"]); 
                }

                $uploadPath  = 'uploads/dosya/ik';
               
                $dosya->move($uploadPath, $dosya_name);               

                $insanKay->cv_dosya  = $dosya_name;
            } 

            $insanKay->save();                      

            return response()->json(["durum" => "success", "mesaj" => "Başvurunuz bize ulaştı. En kısa zamanda sizinle iletişime geçilecektir"]);          
           
        }catch(\Exception $e){
            return response()->json([
                "durum"=>"error", "mesaj"=>"Başvuru gönderme hatası! ->".$e->getMessage()
            ]);                       
        }
    }
    // ./site insan kaynakları post sayfası ---------------------------------------------------------


     //bulten formu post -------------------------------------------------------------------
    public function bultenFormuPost(Request $request){
        try{
            
            $mailFormu = new MailList;             
            $mailFormu->mail  = trim($request->bulten_mail);           
            $mailFormu->ipno  = $request->ip();
            $mailFormu->save();                          
 
            return response()->json(["durum" => "success", "mesaj" => "E-Posta listemize kayıt olduğunuz için teşekkür ederiz. Bizden e-posta almaktan vazgeçereseniz, iletişim bölümünden bize yazın"]);
            
         }catch(\Exception $e){
             return response()->json([
                 "durum"=>"error", "mesaj"=>$e->getMessage()
             ]);                       
         } 
    }
    //  ./ bulten formu post ---------------------------------------------------------------



    //site bakım modu sayfası -----------------------------------------------------------------
    public function bakimModu(){  
        $ayar  = Ayar::first();
        $bilgi = SiteBilgileri::first();
        return view("Site.index.bakim", compact("ayar", "bilgi"));
    }
    // ./site bakım modu sayfası --------------------------------------------------------------




}// ***************************************************************************************
