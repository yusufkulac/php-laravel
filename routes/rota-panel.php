<?php

//panel rota
use App\Http\Controllers\Panel\IndexController;
use App\Http\Controllers\Panel\BlogController;
use App\Http\Controllers\Panel\HaberController;
use App\Http\Controllers\Panel\KurumsalController;
use App\Http\Controllers\Panel\AyarController;
use App\Http\Controllers\Panel\MesajController;
use App\Http\Controllers\Panel\HizmetController;
use App\Http\Controllers\Panel\SssController;
use App\Http\Controllers\Panel\UrunController;
use App\Http\Controllers\Panel\ProjeController;
use App\Http\Controllers\Panel\SliderController;
use App\Http\Controllers\Panel\TeklifFormuController;
use App\Http\Controllers\Panel\ReferansController;
use App\Http\Controllers\Panel\InsanKaynaklariController;
use App\Http\Controllers\Panel\GaleriResimController;
use App\Http\Controllers\Panel\GaleriVideoController;
use App\Http\Controllers\Panel\MailListController;
use App\Http\Controllers\Panel\CozumOrtaklariController;
use App\Http\Controllers\UserController;


Route::middleware("panelBildirim", "authCheck")->prefix('admin')->group(function () {
	
	Route::get('/', [IndexController::class, 'index'])->name('panel.index');
	//site bilgileri
	Route::get('/ayar/site-bilgileri', [IndexController::class, 'siteBilgileri'])->name('panel.site.bilgileri');
	Route::post('/site-bilgileri-post', [IndexController::class, 'siteBilgileriPost'])->name('panel.site.bilgileri.post');	
    //site ayarları
    Route::get('/ayar/site-ayarlari', [AyarController::class, 'ayarlar'])->name('panel.site.ayarlari');
	Route::post('/site-ayarlari-post', [AyarController::class, 'ayarlarPost'])->name('panel.site.ayarlar.post');

	
	//mesajlar ----------------------------------------------------------------------------------------
	Route::get('/mesaj/list', [MesajController::class, 'mesajlar'])->name('panel.mesajlar');
	Route::get('/mesaj-detay/{id}', [MesajController::class, 'mesajDetay'])->name('panel.mesaj.detay');
	Route::post('/mesaj-sil', [MesajController::class, 'mesajSil'])->name('panel.mesaj.sil');
	Route::post('/mesaj-yayinla-post', [MesajController::class, 'mesajYaninlaPost'])->name('panel.mesaj.yayinla.post');
	Route::post('/mesaj-yayin-kaldir-post', [MesajController::class, 'mesajYanindanKaldir'])->name('panel.mesaj.yayin.kaldir.post');

	//teklif formu ------------------------------------------------------------------------------------
	Route::get('/teklif-formu/list', [TeklifFormuController::class, 'teklifFormu'])->name('panel.teklif.formu');
	Route::get('/teklif-formu-detay/{id}', [TeklifFormuController::class, 'teklifFormuDetay'])->name('panel.teklif.formu.detay');
	Route::post('/teklif-formu-sil', [TeklifFormuController::class, 'teklifFormuSil'])->name('panel.teklif.formu.sil');


	//insan kaynakları ------------------------------------------------------------------------------------
	Route::prefix('insan-kaynaklari')->group(function(){
		Route::get('/basvuru/list', [InsanKaynaklariController::class, 'basvurular'])->name('panel.basvuru.list');
		Route::get('/basvuru-detay/{id}', [InsanKaynaklariController::class, 'basvuruDetay'])->name('panel.basvuru.detay');
		Route::post('/basvuru-sil', [InsanKaynaklariController::class, 'basvuruSil'])->name('panel.basvuru.sil');
	});

	//slider --------------------------------------------------------------------------------------------
	Route::prefix('slider')->group(function(){
		Route::get('/liste', [SliderController::class, 'sliderList'])->name('panel.slider.liste');
		Route::get('/ekle', [SliderController::class, 'sliderEkle'])->name('panel.slider.ekle');
		Route::post('/ekle-post', [SliderController::class, 'sliderEklePost'])->name('panel.slider.ekle.post');
		Route::get('/duzenle/{id}', [SliderController::class, 'sliderDuzenle'])->name('panel.slider.duzenle');
		Route::post('/duzenle-post', [SliderController::class, 'sliderDuzenlePost'])->name('panel.slider.duzenle.post');
		Route::post('/slider-sil', [SliderController::class, 'sliderSil'])->name('panel.slider.sil');
	});
	
	//blog --------------------------------------------------------------------------------------------
	Route::prefix('blog')->group(function(){
		Route::get('/liste', [BlogController::class, 'blogList'])->name('panel.blog.liste');
		Route::get('/ekle', [BlogController::class, 'blogEkle'])->name('panel.blog.ekle');
		Route::post('/ekle-post', [BlogController::class, 'blogEklePost'])->name('blog.ekle.post');
		Route::get('/duzenle/{slug}', [BlogController::class, 'blogDuzenle'])->name('panel.blog.duzenle');
		Route::post('/resim-sil', [BlogController::class, 'blogResimSil'])->name('blog.resim.sil');
		Route::post('/duzenle-post', [BlogController::class, 'blogDuzenlePost'])->name('blog.duzenle.post');
		Route::post('/blog-sil', [BlogController::class, 'blogSil'])->name('panel.blog.sil');
		Route::post('/blog-video-sil', [BlogController::class, 'videoSil'])->name('panel.blog.video.sil');
	});


	//haber ------------------------------------------------------------------------------------------
	Route::prefix('haber')->group(function(){
		Route::get('/liste', [HaberController::class, 'haberList'])->name('panel.haber.liste');
		Route::get('/ekle', [HaberController::class, 'haberEkle'])->name('panel.haber.ekle');
		Route::post('/ekle-post', [HaberController::class, 'haberEklePost'])->name('haber.ekle.post');
		Route::get('/duzenle/{slug}', [HaberController::class, 'haberDuzenle'])->name('panel.haber.duzenle');
		Route::post('/resim-sil', [HaberController::class, 'haberResimSil'])->name('haber.resim.sil');
		Route::post('/duzenle-post', [HaberController::class, 'haberDuzenlePost'])->name('haber.duzenle.post');
		Route::post('/haber-sil', [HaberController::class, 'haberSil'])->name('panel.haber.sil');
		Route::post('/haber-resim-sirala', [HaberController::class, 'haberResimSirala'])->name('haber.resim.sirala');
	});


	//kurumsal ------------------------------------------------------------------------------------------
	Route::prefix('kurumsal')->group(function(){
		Route::get('/hakkimizda', [KurumsalController::class, 'hakkimizda'])->name('panel.hakkimizda');
		Route::post('/hakkimizda-post', [KurumsalController::class, 'hakkimizdaPost'])->name('panel.hakkimizda.post');
		Route::get('/vizyon-misyon', [KurumsalController::class, 'vizyon'])->name('panel.vizyon');
		Route::post('/vizyon-post', [KurumsalController::class, 'vizyonPost'])->name('panel.vizyon.post');
		Route::get('/neden-biz', [KurumsalController::class, 'nedenBiz'])->name('panel.nedenbiz');
		Route::post('/neden-biz-post', [KurumsalController::class, 'nedenBizPost'])->name('panel.nedenbiz.post');
	});


	//hizmet ------------------------------------------------------------------------------------------
	Route::prefix('hizmet')->group(function(){
		Route::get('/kategori-liste', [HizmetController::class, 'hizmetKategoriList'])->name('panel.hizmet.kategori.liste');
		Route::get('/kategori-ekle', [HizmetController::class, 'hizmetKategoriEkle'])->name('panel.hizmet.kategori.ekle');
		Route::post('/kategori-ekle-post', [HizmetController::class, 'hizmetKategoriEklePost'])->name('panel.hizmet.kategori.ekle.post');
		Route::get('/kategori-duzenle/{id}', [HizmetController::class, 'hizmetKategoriDuzenle'])->name('panel.hizmet.kategori.duzenle');	
		Route::post('/kategori-duzenle-post', [HizmetController::class, 'hizmetKategoriDuzenlePost'])->name('panel.hizmet.kategori.duzenle.post');
		Route::post('/kategori-sil', [HizmetController::class, 'hizmetKategoriSil'])->name('panel.hizmet.kategori.sil');

		Route::get('/liste/{kategori_id?}', [HizmetController::class, 'hizmetList'])->name('panel.hizmet.liste');
		Route::get('/ekle', [HizmetController::class, 'hizmetEkle'])->name('panel.hizmet.ekle');
		Route::post('/ekle-post', [HizmetController::class, 'hizmetEklePost'])->name('panel.hizmet.ekle.post');
		Route::get('/duzenle/{slug}', [HizmetController::class, 'hizmetDuzenle'])->name('panel.hizmet.duzenle');
		Route::post('/resim-sil', [HizmetController::class, 'hizmetResimSil'])->name('hizmet.resim.sil');
		Route::post('/duzenle-post', [HizmetController::class, 'hizmetDuzenlePost'])->name('hizmet.duzenle.post');
		Route::post('/hizmet-sil', [HizmetController::class, 'hizmetSil'])->name('panel.hizmet.sil');
		Route::post('/hizmet-resim-sirala', [HizmetController::class, 'hizmetResimSirala'])->name('hizmet.resim.sirala');
		Route::post('/hizmet-video-sil', [HizmetController::class, 'videoSil'])->name('panel.hizmet.video.sil');
	});

	//sıkça sorulan sorular ---------------------------------------------------------------------
	Route::prefix('sss')->group(function(){
		Route::get('/liste', [SssController::class, 'sssList'])->name('panel.sss.liste');
		Route::get('/ekle', [SssController::class, 'sssEkle'])->name('panel.sss.ekle');
		Route::post('/ekle-post', [SssController::class, 'sssEklePost'])->name('panel.sss.ekle.post');
		Route::get('/duzenle/{slug}', [SssController::class, 'sssDuzenle'])->name('panel.sss.duzenle');
		Route::post('/duzenle-post', [SssController::class, 'sssDuzenlePost'])->name('panel.sss.duzenle.post');
		Route::post('/sss-sil', [SssController::class, 'sssSil'])->name('panel.sss.sil');
	
	});

	//ürün ---------------------------------------------------------------------------------
	Route::prefix('urun')->group(function(){
		Route::get('/kategori-liste', [UrunController::class, 'kategoriList'])->name('panel.urun.kategori.liste');
		Route::get('/kategori-ekle', [UrunController::class, 'kategoriEkle'])->name('panel.urun.kategori.ekle');
		Route::post('/kategori-ekle-post', [UrunController::class, 'kategoriEklePost'])->name('panel.urun.kategori.ekle.post');
		Route::get('/kategori-duzenle/{slug}', [UrunController::class, 'kategoriDuzenle'])->name('panel.urun.kategori.duzenle');
		Route::post('/kategori-duzenle-post', [UrunController::class, 'kategoriDuzenlePost'])->name('panel.urun.kategori.duzenle.post');
		Route::post('/kategori-sil', [UrunController::class, 'kategoriSil'])->name('panel.urun.kategori.sil');
		Route::post('/kategori-resim-sil', [UrunController::class, 'kategoriResimSil'])->name('panel.urun.kategori.resim.sil');

		Route::get('/liste', [UrunController::class, 'urunList'])->name('panel.urun.liste');
		Route::get('/ekle', [UrunController::class, 'urunEkle'])->name('panel.urun.ekle');
		Route::post('/ekle-post', [UrunController::class, 'urunEklePost'])->name('panel.urun.ekle.post');
		Route::get('/duzenle/{slug}', [UrunController::class, 'urunDuzenle'])->name('panel.urun.duzenle');
		Route::post('/duzenle-post', [UrunController::class, 'urunDuzenlePost'])->name('panel.urun.duzenle.post');
		Route::post('/urun-sil', [UrunController::class, 'urunSil'])->name('panel.urun.sil');
		Route::post('/urun-resim-sirala', [UrunController::class, 'resimSirala'])->name('panel.urun.resim.sirala');
		Route::post('/urun-resim-sil', [UrunController::class, 'resimSil'])->name('panel.urun.resim.sil');
	});		

	//eğitmen --------------------------------------------------------------------------------------------
	Route::prefix('egitmen')->group(function(){
		Route::get('/liste', [EgitmenController::class, 'egitmenList'])->name('panel.egitmen.liste');
		Route::get('/ekle', [EgitmenController::class, 'egitmenEkle'])->name('panel.egitmen.ekle');
		Route::post('/ekle-post', [EgitmenController::class, 'egitmenEklePost'])->name('panel.egitmen.ekle.post');
		Route::get('/duzenle/{id}', [EgitmenController::class, 'egitmenDuzenle'])->name('panel.egitmen.duzenle');	
		Route::post('/ekle-duzenle-post', [EgitmenController::class, 'egitmenDuzenlePost'])->name('panel.egitmen.duzenle.post');
		Route::post('/egitmen-sil', [EgitmenController::class, 'egitmenSil'])->name('panel.egitmen.sil');
	});


	//proje ---------------------------------------------------------------------------------
	Route::prefix('proje')->group(function(){
		Route::get('/kategori-liste', [ProjeController::class, 'kategoriList'])->name('panel.proje.kategori.liste');
		Route::get('/kategori-ekle', [ProjeController::class, 'kategoriEkle'])->name('panel.proje.kategori.ekle');
		Route::post('/kategori-ekle-post', [ProjeController::class, 'kategoriEklePost'])->name('panel.proje.kategori.ekle.post');
		Route::get('/kategori-duzenle/{slug}', [ProjeController::class, 'kategoriDuzenle'])->name('panel.proje.kategori.duzenle');
		Route::post('/kategori-duzenle-post', [ProjeController::class, 'kategoriDuzenlePost'])->name('panel.proje.kategori.duzenle.post');
		Route::post('/kategori-sil', [ProjeController::class, 'kategoriSil'])->name('panel.proje.kategori.sil');
		Route::post('/kategori-resim-sil', [ProjeController::class, 'kategoriResimSil'])->name('panel.proje.kategori.resim.sil');

		Route::get('/liste', [ProjeController::class, 'projeList'])->name('panel.proje.liste');
		Route::get('/ekle', [ProjeController::class, 'projeEkle'])->name('panel.proje.ekle');
		Route::post('/ekle-post', [ProjeController::class, 'projeEklePost'])->name('panel.proje.ekle.post');
		Route::get('/duzenle/{slug}', [ProjeController::class, 'projeDuzenle'])->name('panel.proje.duzenle');
		Route::post('/duzenle-post', [ProjeController::class, 'projeDuzenlePost'])->name('panel.proje.duzenle.post');
		Route::post('/proje-sil', [ProjeController::class, 'projeSil'])->name('panel.proje.sil');
		Route::post('/proje-resim-sirala', [ProjeController::class, 'resimSirala'])->name('panel.proje.resim.sirala');
		Route::post('/proje-resim-sil', [ProjeController::class, 'resimSil'])->name('panel.proje.resim.sil');
		Route::post('/proje-video-sil', [ProjeController::class, 'videoSil'])->name('panel.proje.video.sil');
	});	


	//referans --------------------------------------------------------------------------------------------
	Route::prefix('referans')->group(function(){
		Route::get('/liste', [ReferansController::class, 'referansList'])->name('panel.referans.liste');
		Route::get('/ekle', [ReferansController::class, 'referansEkle'])->name('panel.referans.ekle');
		Route::post('/ekle-post', [ReferansController::class, 'referansEklePost'])->name('panel.referans.ekle.post');
		Route::get('/duzenle/{id}', [ReferansController::class, 'referansDuzenle'])->name('panel.referans.duzenle');
		Route::post('/duzenle-post', [ReferansController::class, 'referansDuzenlePost'])->name('panel.referans.duzenle.post');
		Route::post('/referans-sil', [ReferansController::class, 'referansSil'])->name('panel.referans.sil');
	});


	//resim galeri -----------------------------------------------------------------------------------------
	Route::prefix('resim-galeri')->group(function(){
		Route::get('/kategori-liste', [GaleriResimController::class, 'galeriKategoriList'])->name('panel.rg.kategori.list');
		Route::get('/kategori-ekle', [GaleriResimController::class, 'galeriKategoriEkle'])->name('panel.rg.kategori.ekle');
		Route::post('/kategori-ekle-post', [GaleriResimController::class, 'galeriKategoriEklePost'])->name('panel.rg.kategori.ekle.post');
		Route::get('/kategori-duzenle/{id}', [GaleriResimController::class, 'galeriKategoriDuzenle'])->name('panel.rg.kategori.duzenle');
		Route::post('/kategori-duzenle-post', [GaleriResimController::class, 'galeriKategoriDuzenlePost'])->name('panel.rg.kategori.duzenle.post');
		Route::post('/kategori-sil', [GaleriResimController::class, 'galeriKategoriSil'])->name('panel.rg.kategori.sil');

		Route::get('/resim-list/{id}', [GaleriResimController::class, 'galeriResimList'])->name('panel.rg.resimlist');
		Route::get('/resim-ekle/{id}', [GaleriResimController::class, 'galeriResimEkle'])->name('panel.rg.resim.ekle');
		Route::post('/resim-ekle-post', [GaleriResimController::class, 'galeriResimEklePost'])->name('panel.rg.resim.ekle.post');
		Route::post('/resim-sil-post', [GaleriResimController::class, 'galeriResimSil'])->name('panel.rg.resim.sil');
	});

	//video galeri -----------------------------------------------------------------------------------------
	Route::prefix('video-galeri')->group(function(){
		Route::get('/liste', [GaleriVideoController::class, 'videoList'])->name('panel.video.list');
		Route::get('/ekle', [GaleriVideoController::class, 'videoEkle'])->name('panel.video.ekle');
		Route::post('/ekle-post', [GaleriVideoController::class, 'videoEklePost'])->name('panel.video.ekle.post');
		Route::post('/sil-post', [GaleriVideoController::class, 'videoSilPost'])->name('panel.video.sil.post');
	});


	//kullanıcılar -----------------------------------------------------------------------------------------
	Route::prefix('kullanici')->group(function(){
		Route::get('/liste', [UserController::class, 'kullaniciList'])->name('panel.kullanici.list');
		Route::get('/ekle', [UserController::class, 'kullaniciEkle'])->name('panel.kullanici.ekle');
		Route::post('/ekle-post', [UserController::class, 'kullaniciEklePost'])->name('panel.kullanici.ekle.post');
		Route::get('/duzenle/{id}', [UserController::class, 'kullaniciDuzenle'])->name('panel.kullanici.duzenle');
		Route::post('/duzenle-post', [UserController::class, 'kullaniciDuzenlePost'])->name('panel.kullanici.duzenle.post');
		Route::post('/sil-post', [UserController::class, 'kullaniciSil'])->name('panel.kullanici.sil');
	});


	//mail list -----------------------------------------------------------------------------------------
	Route::prefix('mail-list')->group(function(){
		Route::get('/liste', [MailListController::class, 'mailListesi'])->name('panel.mail.list');
		Route::post('/sil-post', [MailListController::class, 'mailSil'])->name('panel.mail.sil');
	});

	//bakım modu ----------------------------------------------------------------------------------------
	Route::post('/bakim-modu-post', [AyarController::class, 'bakimModuPost'])->name('panel.bakim.modu.post');


	//çözüm ortakları ------------------------------------------------------------------------------------
	Route::prefix('cozum-ortaklari')->group(function(){
		Route::get('/liste', [CozumOrtaklariController::class, 'cozumOrtaklariList'])->name('panel.cozum.ortaklari.liste');
		Route::get('/ekle', [CozumOrtaklariController::class, 'cozumOrtaklariEkle'])->name('panel.cozum.ortaklari.ekle');
		Route::post('/ekle-post', [CozumOrtaklariController::class, 'cozumOrtaklariEklePost'])->name('panel.cozum.ortaklari.ekle.post');
		Route::get('/duzenle/{id}', [CozumOrtaklariController::class, 'cozumOrtaklariDuzenle'])->name('panel.cozum.ortaklari.duzenle');
		Route::post('/duzenle-post', [CozumOrtaklariController::class, 'cozumOrtaklariDuzenlePost'])->name('panel.cozum.ortaklari.duzenle.post');
		Route::post('/sil', [CozumOrtaklariController::class, 'cozumOrtaklariSil'])->name('panel.cozum.ortaklari.sil');
	});






}); // ********************************************************************************************************
