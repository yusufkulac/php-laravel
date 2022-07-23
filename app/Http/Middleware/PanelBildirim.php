<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

use App\Models\Mesaj;
use App\Models\TeklifFormu;
use App\Models\InsanKaynaklari;
use App\Models\Ayar;

class PanelBildirim
{
  
    public function handle(Request $request, Closure $next)
    {
        //yeni mesajları panelde üstte bildirimde göstermek için middleware
        $yeniMesaj = Mesaj::where("okundu", 0)->count(); 
        
        //yeni teklif formu
        $yeniTeklifFormu = TeklifFormu::where("okundu", 0)->count(); 
        
        //yeni iş basvurusu
        $yeniIsBasvuru = InsanKaynaklari::where("okundu", 0)->count();           

        view()->share(['yeniMesaj' => $yeniMesaj, 'yeniTeklifFormu' => $yeniTeklifFormu, 'yeniIsBasvuru' => $yeniIsBasvuru]);

        return $next($request);
    }
}
