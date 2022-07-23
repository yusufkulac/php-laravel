<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

use App\Models\SiteBilgileri;
use App\Models\Ayar;

class SiteBilgiler
{
  
    public function handle(Request $request, Closure $next)
    {
       
        $siteBilgi = SiteBilgileri::where('id', 1)->first();  

        $siteAyar = Ayar::where('id', 1)->first();        
        
        view()->share(['siteBilgi' => $siteBilgi, 'siteAyar' => $siteAyar]);

        return $next($request);
    }
}
