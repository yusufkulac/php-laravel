<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

use App\Models\Diller;

class Dil
{
  
    public function handle(Request $request, Closure $next)
    {
        
        if(session()->has("dil")){
            app()->setLocale(session()->get("dil"));
        }else{
            //yeni mesajları panelde üstte bildirimde göstermek için middleware
            $row = Diller::where("varsayilan", 1)->first(); 
            app()->setLocale($row->dil);
            session()->put('dil', $row->dil);
        } 

        //view()->share('dil', $row->dil);

        return $next($request);
    }
}
