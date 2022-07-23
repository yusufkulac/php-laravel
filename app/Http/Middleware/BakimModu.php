<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

use App\Models\Ayar;

class BakimModu
{
  
    public function handle(Request $request, Closure $next)
    {        
        $ayar = Ayar::first();     

        if($ayar->bakim_modu == 0){
            return $next($request);
        }  

        return redirect()->route("site.bakim");   
        
    }
}
