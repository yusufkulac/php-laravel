<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

use App\Models\HizmetKategori;

class Menu
{
  
    public function handle(Request $request, Closure $next)
    {
       
        $menuTop = HizmetKategori::with("hizmetMenu")->where("menude_goster", 1)
                                    ->orderBy("sira")->take(7)->get(); 
                                    
        $footerMenu = HizmetKategori::where("menude_goster", 1)->orderBy("sira")->get();       
        
        view()->share(['menuTop'=> $menuTop, 'footerMenu' => $footerMenu]);

        return $next($request);
    }
}
