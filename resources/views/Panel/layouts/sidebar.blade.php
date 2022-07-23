
<!-- ======== sidebar-nav start =========== -->
<aside class="sidebar-nav-wrapper py-2">
    <div class="navbar-logo" style="margin-bottom: 20px">      
        <i class="fas fa-cogs me-2" style="font-size:20px;"></i>Yönetim Paneli
    </div>
    <nav class="sidebar-nav">
      <ul>
        <!-- ------------------------------------------------------------------------------------------>
        <li class="nav-item sb-main-item">
          <a href="{{route('panel.index')}}" class="@if(request()->is('admin')) ni-active @endif">
            <span class="icon">
              <i class="fas fa-tachometer-alt"></i>
            </span>
            <span class="text">Anasayfa</span>
          </a>
        </li>
        <!-- ----------------------------------------------------------------------------------------->

        <!-- MESAJLAR--------------------------------------------------------------------------------->
        <li class="nav-item sb-main-item">
          <a href="{{route('panel.mesajlar')}}" class="@if(request()->is('admin/mesaj/*')) ni-active @endif">
            <span class="icon">
              <i class="far fa-envelope"></i>
            </span>
            <span class="text">Mesajlar</span>
            <span class="badge bg-danger">{{ $yeniMesaj }}</span>
          </a>
        </li>
        <!-- ----------------------------------------------------------------------------------------->

        <!-- INSAN KAYNAKLARI-------------------------------------------------------------------------->
        <li class="nav-item sb-main-item">
          <a href="{{route('panel.basvuru.list')}}" class="@if(request()->is('admin/insan-kaynaklari/*')) ni-active @endif">
            <span class="icon">
              <i class="far fa-file-alt"></i>
            </span>
            <span class="text">İnsan Kaynakları</span>
            <span class="badge bg-danger">{{ $yeniIsBasvuru }}</span>
          </a>
        </li>
        <!-- ----------------------------------------------------------------------------------------->


        <!-- TEKLİF FORMLARI ------------------------------------------------------------------------->
        <li class="nav-item sb-main-item">
          <a href="{{route('panel.teklif.formu')}}" class="@if(request()->is('admin/teklif-formu/*')) ni-active @endif">
            <span class="icon">
              <i class="far fa-handshake"></i>
            </span>
            <span class="text">Teklif Formu</span>
            <span class="badge bg-danger">{{ $yeniTeklifFormu }}</span>
          </a>
        </li>
        <!-- ----------------------------------------------------------------------------------------->


        <!-- SLIDER YÖNETİMİ ------------------------------------------------------------------------>
        <li class="nav-item nav-item-has-children sb-main-item">
          <a href="#0" class="@if(request()->is('admin/slider/*')) ni-active @endif" data-bs-toggle="collapse" data-bs-target="#slider" aria-controls="slider"
            aria-expanded="false" aria-label="Toggle navigation">
            <span class="icon">
              <i class="fas fa-image"></i>
            </span>
            <span class="text">Slider Yönetimi</span>
          </a>          
          <ul id="slider" class="collapse @if( request()->is('admin/slider/*') ) show @endif dropdown-nav">
            <li class="ms-3">
              <a href="{{ route('panel.slider.liste') }}"> Slider Listesi </a>
            </li>
            <li class="ms-3">
              <a href="{{ route('panel.slider.ekle') }}">Slider Ekle </a>
            </li> 
          </ul>
        </li>
        <!-- ------------------------------------------------------------------------>

     
        <!-- BLOG YÖNETİMİ ---------------------------------------------------------->
        <li class="nav-item nav-item-has-children sb-main-item">
          <a href="#0" class="@if(request()->is('admin/blog/*')) ni-active @endif" data-bs-toggle="collapse" data-bs-target="#blog" aria-controls="blog"
            aria-expanded="false" aria-label="Toggle navigation">
            <span class="icon">
              <i class="fas fa-blog"></i>
            </span>
            <span class="text">Blog Yönetimi</span>
          </a>          
          <ul id="blog" class="collapse @if( request()->is('admin/blog/*') ) show @endif dropdown-nav">
            <li class="ms-3">
              <a href="{{ route('panel.blog.liste') }}"> Blog Listesi </a>
            </li>
            <li class="ms-3">
              <a href="{{ route('panel.blog.ekle') }}">Blog Ekle </a>
            </li> 
          </ul>
        </li>
        <!-- ------------------------------------------------------------------------>

        
        <!-- HABER-----------------------------------------------------------------------
        <li class="nav-item nav-item-has-children sb-main-item">
          <a href="#0" class="@if(request()->is('admin/haber/*')) ni-active @endif" data-bs-toggle="collapse" data-bs-target="#haber" aria-controls="haber"
            aria-expanded="false" aria-label="Toggle navigation">
            <span class="icon">
              <i class="far fa-newspaper" style="font-weight: 200"></i>
            </span>
            <span class="text">Haber Yönetimi</span>
          </a>
          
          <ul id="haber" class="collapse @if(request()->is('admin/haber/*')) show @endif dropdown-nav">
            <li class="ms-3">
              <a href="{{ route('panel.haber.liste') }}"> Haber Listesi </a>
            </li>
            <li class="ms-3">
              <a href="{{ route('panel.haber.ekle') }}">Haber Ekle </a>
            </li> 
          </ul>
        </li>
        ------------------------------------------------------------------------>

        <!-- HİZMET------------------------------------------------------------------------>
        <li class="nav-item nav-item-has-children sb-main-item">
          <a href="#0" class="@if(request()->is('admin/hizmet/*')) ni-active @endif" data-bs-toggle="collapse" data-bs-target="#hizmet" aria-controls="hizmet"
            aria-expanded="false" aria-label="Toggle navigation">
            <span class="icon">
              <i class="fas fa-concierge-bell"></i>             
            </span>
            <span class="text">Hizmet Yönetimi</span>
          </a>
          
          <ul id="hizmet" class="collapse dropdown-nav @if(request()->is('admin/hizmet/*')) show @endif">
            <li class="ms-3">
              <a href="{{ route('panel.hizmet.kategori.liste') }}"> Kategori Listesi </a>
            </li>
            <li class="ms-3">
              <a href="{{ route('panel.hizmet.kategori.ekle') }}"> Kategori Ekle </a>
            </li>
            <li class="ms-3">
              <a href="{{ route('panel.hizmet.liste') }}"> Hizmet Listesi </a>
            </li>
            <li class="ms-3">
              <a href="{{ route('panel.hizmet.ekle') }}">Hizmet Ekle </a>
            </li> 
          </ul>
        </li>
        <!-- ------------------------------------------------------------------------>

        <!-- SSS ---------------------------------------------------------------------
        <li class="nav-item nav-item-has-children sb-main-item">
          <a href="#0" class="@if(request()->is('admin/sss/*')) ni-active @endif" data-bs-toggle="collapse" data-bs-target="#sss" aria-controls="sss"
            aria-expanded="false" aria-label="Toggle navigation">
            <span class="icon">
              <i class="far fa-question-circle"></i>
            </span>
            <span class="text">Sıkça Sorulan Sorular</span>
          </a>          
          <ul id="sss" class="collapse dropdown-nav @if(request()->is('admin/sss/*')) show @endif">
            <li class="ms-3">
              <a href="{{ route('panel.sss.liste') }}"> S.S.S Listesi </a>
            </li>
            <li class="ms-3">
              <a href="{{ route('panel.sss.ekle') }}">S.S.S Ekle </a>
            </li> 
          </ul>
        </li>
       -------------------------------------------------------------------------------->


        <!-- PROJELER ------------------------------------------------------------------------>
        <li class="nav-item nav-item-has-children sb-main-item">
          <a href="#0" class="@if(request()->is('admin/proje/*')) ni-active @endif" data-bs-toggle="collapse" data-bs-target="#proje" aria-controls="proje"
            aria-expanded="false" aria-label="Toggle navigation">
            <span class="icon">
              <i class="fas fa-project-diagram"></i>
            </span>
            <span class="text">Proje Yönetimi</span>
          </a>          
          <ul id="proje" class="collapse dropdown-nav @if(request()->is('admin/proje/*')) show @endif">
            <!--
            <li class="ms-3">
              <a href="{{ route('panel.proje.kategori.liste') }}"> Kategori Listesi </a>
            </li>
            <li class="ms-3">
              <a href="{{ route('panel.proje.kategori.ekle') }}"> Kategori Ekle </a>
            </li> 
          -->
            <li class="ms-3">
              <a href="{{ route('panel.proje.liste') }}"> Proje Listesi </a>
            </li>
            <li class="ms-3">
              <a href="{{ route('panel.proje.ekle') }}">Proje Ekle </a>
            </li> 
          </ul>
        </li>
        <!-- ------------------------------------------------------------------------>



        <!-- ÜRÜNLER ----------------------------------------------------------------
        <li class="nav-item nav-item-has-children sb-main-item">
          <a href="#0" class="@if(request()->is('admin/urun/*')) ni-active @endif" data-bs-toggle="collapse" data-bs-target="#urun" aria-controls="urun"
            aria-expanded="false" aria-label="Toggle navigation">
            <span class="icon">
              <i class="fas fa-shopping-bag"></i>
            </span>
            <span class="text">Ürün İşlemleri</span>
          </a>          
          <ul id="urun" class="collapse dropdown-nav @if(request()->is('admin/urun/*')) show @endif">
            <li class="ms-3">
              <a href="{{ route('panel.urun.kategori.liste') }}"> Kategori Listesi </a>
            </li>
            <li class="ms-3">
              <a href="{{ route('panel.urun.kategori.ekle') }}"> Kategori Ekle </a>
            </li> 
            <li class="ms-3">
              <a href="{{ route('panel.urun.liste') }}"> Ürün Listesi </a>
            </li>
            <li class="ms-3">
              <a href="{{ route('panel.urun.ekle') }}">Ürün Ekle </a>
            </li> 
          </ul>
        </li>
        -------------------------------------------------------------------------------->

        <!-- RESIM GALERI YÖNETİMİ --------------------------------------------------------------->
        <li class="nav-item nav-item-has-children sb-main-item">
          <a href="#0" class="@if(request()->is('admin/resim-galeri/*')) ni-active @endif" data-bs-toggle="collapse" data-bs-target="#resimGaleri" aria-controls="resimGaleri"
            aria-expanded="false" aria-label="Toggle navigation">
            <span class="icon">
              <i class="fas fa-images"></i>
            </span>
            <span class="text">Resim Galeri Yönetimi</span>
          </a>          
          <ul id="resimGaleri" class="collapse @if( request()->is('admin/resim-galeri/*') ) show @endif dropdown-nav">
            <li class="ms-3">
              <a href="{{ route('panel.rg.kategori.list') }}"> Kategori Listesi </a>
            </li>
            <li class="ms-3">
              <a href="{{ route('panel.rg.kategori.ekle') }}">Kategori Ekle </a>
            </li> 
          </ul>
        </li>
        <!-- -------------------------------------------------------------------------------------->


         <!-- VIDEO GALERI YÖNETİMİ --------------------------------------------------------------->
        <li class="nav-item nav-item-has-children sb-main-item">
          <a href="#0" class="@if(request()->is('admin/video-galeri/*')) ni-active @endif" data-bs-toggle="collapse" data-bs-target="#videoGaleri" aria-controls="videoGaleri"
            aria-expanded="false" aria-label="Toggle navigation">
            <span class="icon">
             <i class="fab fa-youtube"></i>
            </span>
            <span class="text">Video Galeri Yönetimi</span>
          </a>          
          <ul id="videoGaleri" class="collapse @if( request()->is('admin/video-galeri/*') ) show @endif dropdown-nav">
            <li class="ms-3">
              <a href="{{ route('panel.video.list') }}"> Video Listesi </a>
            </li>
            <li class="ms-3">
              <a href="{{ route('panel.video.ekle') }}">Video Ekle </a>
            </li> 
          </ul>
        </li>
        <!-- -------------------------------------------------------------------------------------->

     
        
        <!-- REFERANSLAR---------------------------------------------------------------------------->
        <li class="nav-item sb-main-item">
          <a href="{{route('panel.referans.liste')}}" class="@if(request()->is('admin/referas/*')) ni-active @endif">
            <span class="icon">
              <i class="fas fa-bullseye"></i>
            </span>
            <span class="text">Referanslar</span>
          </a>
        </li>
        <!-- ----------------------------------------------------------------------------------------->


         <!-- ÇÖZÜM ORTAKLARI------------------------------------------------------------------------->
        <li class="nav-item sb-main-item">
          <a href="{{route('panel.cozum.ortaklari.liste')}}" class="@if(request()->is('admin/cozum*ortaklari/*')) ni-active @endif">
            <span class="icon">
              <i class="fas fa-hands-helping"></i>
            </span>
            <span class="text">Çözüm Ortakları</span>
          </a>
        </li>
        <!-- ---------------------------------------------------------------------------------------->


        
        <!-- KULLANICILAR---------------------------------------------------------------------------->
        <li class="nav-item sb-main-item">
          <a href="{{route('panel.kullanici.list')}}" class="@if(request()->is('admin/kullanici/*')) ni-active @endif">
            <span class="icon">
              <i class="fas fa-users"></i>
            </span>
            <span class="text">Kullanıcılar</span>
          </a>
        </li>
        <!-- -------------------------------------------------------------------------------->

        <!-- MAIL LIST---------------------------------------------------------------------------->
        <li class="nav-item sb-main-item">
          <a href="{{route('panel.mail.list')}}" class="@if(request()->is('admin/mail-list/*')) ni-active @endif">
            <span class="icon">
              <i class="fas fa-at"></i>
            </span>
            <span class="text">Bülten Mail Listesi</span>
          </a>
        </li>
        <!-- -------------------------------------------------------------------------------->


        <!-- AYARLAR ------------------------------------------------------------------------>
        <li class="nav-item nav-item-has-children sb-main-item">
          <a href="#0" class="@if(request()->is('admin/ayar/*')) ni-active @endif" data-bs-toggle="collapse" data-bs-target="#ayarlar" aria-controls="ayarlar"
            aria-expanded="false" aria-label="Toggle navigation">
            <span class="icon">
              <i class="fas fa-cog"></i>
            </span>
            <span class="text">Ayarlar</span>
          </a>          
          <ul id="ayarlar" class="collapse dropdown-nav @if(request()->is('admin/ayar/*')) show @endif">
            <li class="ms-3">
              <a href="{{ route('panel.site.bilgileri') }}"> Site Bilgileri </a>
            </li>
            <li class="ms-3">
              <a href="{{ route('panel.site.ayarlari') }}"> Site Ayarları </a>
            </li>
          </ul>
        </li>
        <!-- ------------------------------------------------------------------------>

        <!-- KURUMSAL ------------------------------------------------------------------------>
        <li class="nav-item nav-item-has-children sb-main-item">
          <a href="#0" class="@if(request()->is('admin/kurumsal/*')) ni-active @endif" data-bs-toggle="collapse" data-bs-target="#kurumsal" aria-controls="kurumsal"
            aria-expanded="false" aria-label="Toggle navigation">
            <span class="icon">
              <i class="fas fa-industry"></i>
            </span>
            <span class="text">Kurumsal</span>
          </a>          
          <ul id="kurumsal" class="collapse dropdown-nav @if(request()->is('admin/kurumsal/*')) show @endif">
            <li class="ms-3">
              <a href="{{ route('panel.hakkimizda') }}"> Hakkımızda </a>
            </li>
            <li class="ms-3">
              <a href="{{ route('panel.vizyon') }}"> Vizyon & Misyon </a>
            </li> 
            <!--          
            <li class="ms-3">
              <a href="{{ route('panel.nedenbiz') }}"> Neden Biz? </a>
            </li>
            
              <li class="ms-3">
                <a href=""> Hedeflerimiz </a>
              </li>
            -->
          </ul>
        </li>
        <!-- ------------------------------------------------------------------------>
        

        

        
       
      </ul>
    </nav>
  </aside>
  <div class="overlay"></div>
  <!-- ======== sidebar-nav end =========== -->