<ul class="nav nav-sidebar" data-nav-type="accordion">





<!-- Main -->
<li class="nav-item">
	<a href="{{ route("home") }}" class="nav-link {{ request()->is('home') ? 'active' : '' }}">
		<i class="icon-home4"></i>
		<span> Dashboard</span>
	</a>
</li>
<!-- Main -->
<li class="nav-item">
	<a href="{{ url('satis') }}" class="nav-link {{ request()->is('satis','satis/*') ? 'active' : '' }}">
		<i class="icon-basket"></i>
		<span> SICAK SATIŞ</span>
	</a>
</li>

<!-- Piyasa -->
<li class="nav-item nav-item-submenu {{ request()->is('tahsilat','tahsilat/*') ? 'nav-item-expanded nav-item-open' : '' }}">
	<a href="#" class="nav-link"><i class="icon-folder-download"></i> <span>SATIŞ YÖNETİMi</span></a>

	<ul class="nav nav-group-sub" data-submenu-title="İÇ PİYASA">
		<li class="nav-item"><a href="{{ url('tahsilat') }}" class="nav-link {{ request()->is('stahsilat','tahsilat/*') ? 'active' : '' }}">Tahsilat İşlemleri</a></li>
	</ul>		
</li>


<!-- TEDARİK -->
<li class="nav-item nav-item-submenu {{ request()->is('fatura/alis','fatura/alis/*') ? 'nav-item-expanded nav-item-open' : '' }}">
	<a href="#" class="nav-link"><i class="icon-git-compare"></i> <span>ALIŞ YÖNETİMİ</span></a>

	<ul class="nav nav-group-sub" data-submenu-title="TEDARİK YÖNETİMİ">
		<li class="nav-item"><a href="{{ url('fatura/alis') }}" class="nav-link {{ request()->is('fatura/alis') ? 'active' : '' }}">Alış Faturası</a></li>
	</ul>		
</li>


<!-- Ürün -->
<li class="nav-item nav-item-submenu {{ request()->is('urun','urun/*') ? 'nav-item-expanded nav-item-open' : '' }}">
	<a href="#" class="nav-link"><i class="icon-price-tags2"></i> <span>ÜRÜN YÖNETİMi</span></a>

	<ul class="nav nav-group-sub" data-submenu-title="ÜRÜN YÖNETİMi">
		<li class="nav-item"><a href="{{ url('urun') }}" class="nav-link {{ request()->is('urun') ? 'active' : '' }}">Ürün Kartları</a></li>
	</ul>		
</li>


<!-- User -->
<li class="nav-item nav-item-submenu {{ request()->is('cari','cari/*') ? 'nav-item-expanded nav-item-open' : '' }}">
	<a href="#" class="nav-link"><i class="icon-vcard"></i> <span>CARİ YÖNETİMİ</span></a>

	<ul class="nav nav-group-sub" data-submenu-title="CARİ YÖNETİMİ">
		<li class="nav-item"><a href="{{ url('cari') }}" class="nav-link {{ request()->is('cari') ? 'active' : '' }}">Cari Listesi</a></li>
	</ul>		
</li>






<!-- Depo -->
<li class="nav-item nav-item-submenu {{ request()->is('depo','depo/*') ? 'nav-item-expanded nav-item-open' : '' }}">
	<a href="#" class="nav-link"><i class="icon-home7"></i><span>DEPO YÖNETİMİ</span></a>

	<ul class="nav nav-group-sub" data-submenu-title="DEPO YÖNETİMi">
		<li class="nav-item"><a href="{{ url('depo/urunKabul') }}" class="nav-link {{ request()->is('depo/urunKabul') ? 'active' : '' }}">Fason Ürün Kabul</a></li>
		<li class="nav-item"><a href="{{ url('depo/etiket') }}" class="nav-link {{ request()->is('depo/etiket') ? 'active' : '' }}">Etiket İşlemleri</a></li>
		<li class="nav-item"><a href="{{ url('depo') }}" class="nav-link {{ request()->is('depo') ? 'active' : '' }}">Sayım İşlemleri</a></li>
	</ul>		
</li>




<!-- Users And ALC -->
<li class="nav-item nav-item-submenu {{ request()->is('admin/users','admin/permissions','admin/roles','admin/users/*','admin/permissions/*','admin/roles/*') ? 'nav-item-expanded nav-item-open' : '' }}">
	<a href="#" class="nav-link"><i class="icon-users"></i> <span>KULLANICI YÖNETİMi</span></a>

	<ul class="nav nav-group-sub" data-submenu-title="KULLANICI YÖNETİMi">
		<li class="nav-item"><a href="{{ url('admin/permissions') }}" class="nav-link {{ request()->is('admin/permissions','admin/permissions/*') ? 'active' : '' }}">İzinler</a></li>
		<li class="nav-item"><a href="{{ url('admin/roles') }}" class="nav-link {{ request()->is('admin/roles') ? 'active' : '' }}">Roller</a></li>
		<li class="nav-item"><a href="{{ url('admin/users') }}" class="nav-link {{ request()->is('admin/users') ? 'active' : '' }}">Kullanıcılar</a></li>
	</ul>		
</li>

<!-- Users And ALC -->
<li class="nav-item nav-item-submenu {{ request()->is('settings','settings/*','params','params/*','banka','banka/*') ? 'nav-item-expanded nav-item-open' : '' }}">
	<a href="#" class="nav-link"><i class="icon-cog2"></i> <span>SİSTEM AYARLARI</span></a>
	<ul class="nav nav-group-sub" data-submenu-title="SİSTEM AYARLARI">
		<li class="nav-item"><a href="{{ url('settings') }}" class="nav-link {{ request()->is('settings') ? 'active' : '' }}">Genel Ayarlar</a></li>
		<li class="nav-item"><a href="{{ url('params') }}" class="nav-link {{ request()->is('params') ? 'active' : '' }}">Parametre Ayarları</a></li>
		<li class="nav-item"><a href="{{ url('banka') }}" class="nav-link {{ request()->is('banka') ? 'active' : '' }}">Banka Hesapları</a></li>
		<li class="nav-item"><a href="{{ url('settings/depo') }}" class="nav-link {{ request()->is('settings/depo') ? 'active' : '' }}">Depo Yönetimi</a></li>
	</ul>		
</li>

@can('user_show')
<!-- User -->
<li class="nav-item nav-item-submenu {{ request()->is('admin/user/usersettings') ? 'nav-item-expanded nav-item-open' : '' }}">
	<a href="#" class="nav-link"><i class="icon-user"></i> <span>HESAP AYARLARI</span></a>

	<ul class="nav nav-group-sub" data-submenu-title="Kullanıcı Yönetimi">
		<li class="nav-item"><a href="{{ url('admin/user/usersettings') }}" class="nav-link {{ request()->is('admin/user','admin/user/*') ? 'active' : '' }}">HESAP AYARLARI</a></li>
	</ul>		
</li>
@endcan







</ul>