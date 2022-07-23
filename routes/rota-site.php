<?php



//site rota

use App\Http\Controllers\Site\IndexController;
use App\Http\Controllers\Site\KurumsalController;
use App\Http\Controllers\Site\BlogController;
use App\Http\Controllers\Site\ProjeController;
use App\Http\Controllers\Site\HizmetController;
use App\Http\Controllers\Site\GaleriController;
use App\Http\Controllers\UserController;



Route::middleware(["menu", "sitebilgi", "bakimModu"])->group(function(){  


    Route::get('/', [IndexController::class, 'index'])->name('site.index');   
    Route::get('contact.html', [IndexController::class, 'iletisim'])->name('site.iletisim');
    Route::post('iletisim-post', [IndexController::class, 'iletisimPost'])->name('site.iletisim.post');
    
    /*
    Route::get('insan-kaynaklari.html', [IndexController::class, 'insanKaynaklari'])->name('site.insan.kaynaklari');
    Route::post('insan-kaynaklari-post', [IndexController::class, 'insanKaynaklariPost'])->name('site.insan.kaynaklari.post');
    */
    //
    Route::get('about.html', [KurumsalController::class, 'hakkimizda'])->name('site.hakkimizda');
    Route::get('references.html', [KurumsalController::class, 'referanslar'])->name('site.referanslar');
    Route::get('solution-partners.html', [KurumsalController::class, 'cozumOrtaklari'])->name('site.cozum.ortaklari');

    //blog
    Route::get('blog.html', [BlogController::class, 'bloglar'])->name('site.bloglar');
    Route::get('blog/{id}/{slug}.html', [BlogController::class, 'blogDetay'])->name('site.blog.detay');

    //proje
    Route::get('projects.html', [ProjeController::class, 'projeler'])->name('site.projeler');
    Route::get('tamamlanan-projeler.html', [ProjeController::class, 'tamamlananProjeler'])->name('site.tamamlanan.projeler');
    Route::get('devam-eden-projeler.html', [ProjeController::class, 'devamEdenProjeler'])->name('site.devam.projeler');
    Route::get('planlanan-projeler.html', [ProjeController::class, 'planlananProjeler'])->name('site.planlanan.projeler');
    Route::get('project/{id}/{slug}.html', [ProjeController::class, 'projeDetay'])->name('site.proje.detay');

    /*
    //teklif formu post
    Route::post('teklif-formu-post', [IndexController::class, 'teklifFormuPost'])->name('site.teklif.formu.post');
    */

    //hizmet
    Route::get('services.html', [HizmetController::class, 'hizmetList'])->name('site.hizmetler');
    //Route::get('services/category/{id}/{slug}.html', [HizmetController::class, 'hizmetList'])->name('site.hizmet.list');
    Route::get('services/{id}/{slug}.html', [HizmetController::class, 'hizmetDetay'])->name('site.hizmet.detay');   
    
    //galeri
    Route::get('image-gallery.html', [GaleriController::class, 'resimKategoriList'])->name('site.resim.galeri.list');
    Route::get('image-gallery/{id}/{slug}.html', [GaleriController::class, 'resimList'])->name('site.resim.list');
    Route::get('video-gallery.html', [GaleriController::class, 'videoGaleri'])->name('site.video.galeri');

     
    //bulten formu post
    Route::post('bulten-formu-post', [IndexController::class, 'bultenFormuPost'])->name('site.bulten.formu.post'); 

});

Route::middleware(["sitebilgi"])->group(function(){  

    //login
    Route::get('login', [UserController::class, 'login'])->name('site.giris'); 
    Route::post('giris-check', [UserController::class, 'loginCheck'])->name('site.giris.kontrol');
    Route::get('cikis', [UserController::class, 'logOut'])->name('site.logout');
});
    //bakım modu
    Route::get('care.html', [IndexController::class, 'bakimModu'])->name('site.bakim'); 

