<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Models\User;
use App\Models\Sinav;


class UserController extends Controller
{
    //giriş sayfası ----------------------------------------------------------------------------
    public function login(){
        //dd(Hash::make("654321"));
        if(session()->has("isLogged")){
            return redirect("/");
        }else{
            return view("Site.login.login");
        }
    }
    // ./giriş sayfası -------------------------------------------------------------------------


    //giriş kontrol ----------------------------------------------------------------------------
    public function loginCheck(Request $request){         

        $user = User::where("name", trim($request->kullanici_adi))->first();

        if($user){

            if(Hash::check($request->password, $user->password)){
                $request->session()->put("isLogged", true);
                $request->session()->put("userId", $user->id);
                $request->session()->put("userName", $user->name);
                $request->session()->put("userYetki", $user->yetki);

                return response()->json(["durum" => "success"]);  
            }else{
               return response()->json(["durum" => "error", "mesaj" => "Yanlış şifre"]);   
            }

        }else{
            return response()->json(["durum"=>"error", "mesaj"=>"Böyle bir kullanıcı bulunamadı"]);  
        }
    }
    // ./giriş kontrol -------------------------------------------------------------------------



    //çıkış sayfası ----------------------------------------------------------------------------
    public function logOut(){

        if( session()->has("isLogged") ){
            session()->pull("isLogged");
            session()->pull("userId");
            session()->pull("userName");
            session()->pull("userYetki");            
        }

        return redirect("/");
    }
    // ./çıkış sayfası -------------------------------------------------------------------------


    //panel kullanıcılar sayfası --------------------------------------------------------------
    public function kullaniciList(){
        $users = User::all();
        return view("Panel.user.list", compact("users"));
    }
    //end panel kullanıcılar sayfası -----------------------------------------------------------


    //panel kullanıcı detay sayfası --------------------------------------------------------------
    public function kullaniciDuzenle($id){
        $user = User::where("id", intval($id))->first();
        return view("Panel.user.detay", compact("user"));
    }
    //end panel kullanıcı detay sayfası -----------------------------------------------------------
  

    //panel kullanıcı düzenle post ---------------------------------------------------------------
    public function kullaniciDuzenlePost(Request $request){

        $parola  = trim($request->password);
        $parola2 = trim($request->password2);

        if(strlen($parola) == 0 && strlen($parola2) == 0){
             return response()->json(["durum" => "error", "mesaj" => "Parolalar boş"]);
        }

        if( strlen($parola) > 0 && strlen($parola) < 6  ){
             return response()->json(["durum" => "error", "mesaj" => "Parola en az 6 karakter olmalıdır"]);
        }

        if( strlen($parola) > 0 && ($parola != $parola2) ){
             return response()->json(["durum" => "error", "mesaj" => "Parolalar eşit değil"]);
        }        
        
        try{
            User::where("id", intval($request->id))->update([
                'password' => Hash::make(trim($request->password))
            ]);

            return response()->json(["durum" => "success", "mesaj" => "Parola güncellendi"]); 
        }catch(\Exception $e){
            return response()->json(["durum" => "error", "mesaj" => "Hata oluştu ->".$e->getMessage()]); 
        }
    }
    //end panel kullanıcı düzenle post ------------------------------------------------------------
  
    

    //panel kullanıcı sil post ---------------------------------------------------------------
    public function kullaniciSil(Request $request){
        $user = User::where("id", intval($request->id))->first();
        if($user->yetki == 'admin'){
            return response()->json(["durum" => "error", "mesaj" => "Admin yetkisindeki kullanıcı silinemez"]);
        }

        if(session()->get("userYetki") != 'admin'){
            return response()->json(["durum" => "error", "mesaj" => "Sadece admin yetkisi silme işlemi yapabilir"]);
        }
            
        $user = User::where("id", intval($request->id))->delete();
        return response()->json(["durum" => "success", "mesaj" => "Kullanıcı silindi", "log"]);
        
    }

}//********* end class ****************************************************************************
