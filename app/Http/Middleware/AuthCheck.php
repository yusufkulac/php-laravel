<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AuthCheck
{
    
    public function handle(Request $request, Closure $next){
        
        if(!session()->has("isLogged")){
            //return redirect("giris")->with("fail", "Lütfen giriş yapın");
            return redirect()->route("site.giris");
        }
        return $next($request);

    }
    
}//********* end class ****************************************************************************
