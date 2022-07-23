<div class="hizli-erisim text-end">
	<div class="hizli-erisim-header">
		HIZLI ERİŞİM
	</div>
	<ul>
		<li>
			<a href="{{ route('site.hakkimizda') }}" class="he-link @if(request()->is('hakkimizda.html')) active @endif">
				Hakkımızda
			</a>
		</li>
		<li>
			<a href="{{ route('site.hizmet.kategori.list') }}" class="he-link">
				Hizmetler
			</a>
		</li>
		<li>
			<a href="{{ route('site.projeler') }}" class="he-link  @if(request()->is('projeler.html')) active @endif">
				Projeler
			</a>
		</li>
		<!--
		<li>
			<a href="{{ route('site.resim.galeri.list') }}" class="he-link @if(request()->is('resim-galeri*')) active @endif">
				Foto Galeri
			</a>
		</li>
	-->
		<li>
			<a href="{{ route('site.referanslar') }}" class="he-link @if(request()->is('referanslar.html')) active @endif">
				Referanslar
			</a>
		</li>
		<li>
			<a href="{{ route('site.cozum.ortaklari') }}" class="he-link @if(request()->is('cozum-ortaklarimiz.html')) active @endif">
				Çözüm Ortakları
			</a>
		</li>
		<li>
			<a href="{{ route('site.video.galeri') }}" class="he-link  @if(request()->is('video-galeri*')) active @endif">
				Videolar
			</a>
		</li>
		<li>
			<a href="{{ route('site.bloglar') }}" class="he-link  @if(request()->is('blog.html')) active @endif">
				Blog
			</a>
		</li>
		<li>
			<a href="{{ route('site.insan.kaynaklari') }}" class="he-link  @if(request()->is('insan-kaynaklari.html')) active @endif">
				İnsan Kaynakları
			</a>
		</li>
		<li>
			<a href="{{ route('site.iletisim') }}" class="he-link @if(request()->is('iletisim.html')) active @endif">
				İletişim
			</a>
		</li>
	</ul>	
</div>

<div class="he-bg my-3 position-relative">
	<div class="he-bg-bottom text-center p-3">
		Bizimle iletişime geçmek ve soru sormak için <a href="">iletişime geçin</a>
	</div>
</div>

<div class="d-flex my-2 justify-content-center mb-5">
	@if(strlen($siteBilgi->facebook) > 0)
	<a href="https://www.facebook.com/{{ $siteBilgi->facebook }}" class="he-social he-facebook" target="_blank">
		<i class="fab fa-facebook-f"></i>
	</a>
	@endif

	@if(strlen($siteBilgi->twitter) > 0)
	<a href="https://www.facebook.com/{{ $siteBilgi->twitter }}" class="he-social he-twitter" target="_blank">
		<i class="fab fa-twitter"></i>
	</a>
	@endif

	@if(strlen($siteBilgi->instagram) > 0)
	<a href="https://www.instagram.com/{{ $siteBilgi->instagram }}" class="he-social he-instagram" target="_blank">
		<i class="fab fa-instagram"></i>
	</a>
	@endif

	<a href="https://api.whatsapp.com/send?phone={{ $siteBilgi->whatsapp_tel }}" class="he-social he-whatsapp" target="_blank">
		<i class="fab fa-whatsapp"></i>
	</a>

	@if(strlen($siteBilgi->pinterest) > 0)
	<a href="https://www.pinterest.com/{{ $siteBilgi->pinterest }}" class="he-social he-pinterest" target="_blank">
		<i class="fab fa-pinterest"></i>
	</a>
	@endif

	<a href="mailto:{{ $siteBilgi->mail }}" class="he-social he-mail" target="_blank">
		<i class="fas fa-envelope"></i>
	</a>
	
</div>