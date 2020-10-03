<?php

Route::redirect('/', '/home');

Auth::routes(['register' => false]);

// Change Password Routes...
Route::get('auth/changepassword', 'Auth\ChangePasswordController@showChangePasswordForm')->name('auth.change_password');
Route::patch('auth/changepassword', 'Auth\ChangePasswordController@changePassword')->name('auth.change_password');
Route::patch('password/reset', 'Auth\ChangePasswordController@changePassword')->name('auth.change_password');

Route::group(['middleware' => ['auth']], function () {



   /*
   _____________________________________________________________________________________________
   Authentication
   _____________________________________________________________________________________________
   */
   // Home
   Route::get('/home', 'HomeController@index')->name('home');

   // Route::resource('admin/users', 'Admin\UsersController');

   // Users
   Route::get('admin/users', ['uses' => 'Admin\UsersController@index','as' => 'admin.users.index']);
   Route::post('admin/users', ['uses' => 'Admin\UsersController@store','as' => 'admin.users.store']);
   Route::post('admin/users/destroy', ['uses' => 'Admin\UsersController@destroy','as' => 'admin.users.destroy']);
   Route::post('admin/users/edit', ['uses' => 'Admin\UsersController@edit','as' => 'admin.users.edit']);
   Route::post('admin/users/update', ['uses' => 'Admin\UsersController@update','as' => 'admin.users.update']);
   // User
   Route::post('admin/user/sidebarClose', ['uses' => 'Admin\UsersController@sidebarClose','as' => 'admin.users.sidebarClose']);
   Route::get('admin/user/usersettings', ['uses' => 'Admin\UsersController@usersettings','as' => 'admin.users.usersettings']);
   Route::post('admin/user/userSettingsUpdate', ['uses' => 'Admin\UsersController@userSettingsUpdate','as' => 'admin.users.userSettingsUpdate']);
   Route::post('admin/user/changePassword', ['uses' => 'Admin\UsersController@changePassword','as' => 'admin.users.changePassword']);
   // roles 
   Route::get('admin/roles', ['uses' => 'Admin\RolesController@index','as' => 'admin.roles.index']);
   Route::post('admin/roles', ['uses' => 'Admin\RolesController@store','as' => 'admin.roles.store']);
   Route::post('admin/roles/destroy', ['uses' => 'Admin\RolesController@destroy','as' => 'admin.roles.destroy']);
   Route::post('admin/roles/edit', ['uses' => 'Admin\RolesController@edit','as' => 'admin.roles.edit']);
   Route::post('admin/roles/update', ['uses' => 'Admin\RolesController@update','as' => 'admin.roles.update']);
   Route::post('admin/roles/show', ['uses' => 'Admin\RolesController@show','as' => 'admin.roles.show']);
   Route::post('admin/roles/changePermission', ['uses' => 'Admin\RolesController@changePermission','as' => 'admin.roles.changePermission']);
   // Permissions 
   Route::get('admin/permissions', ['uses' => 'Admin\PermissionsController@index','as' => 'admin.permissions.index']);
   Route::post('admin/permissions', ['uses' => 'Admin\PermissionsController@store','as' => 'admin.permissions.store']);
   Route::post('admin/permissions/destroy', ['uses' => 'Admin\PermissionsController@destroy','as' => 'admin.permissions.destroy']);
   Route::post('admin/permissions/edit', ['uses' => 'Admin\PermissionsController@edit','as' => 'admin.permissions.edit']);
   Route::post('admin/permissions/update', ['uses' => 'Admin\PermissionsController@update','as' => 'admin.permissions.update']);
   Route::get('admin/permissions/{id}', ['uses' => 'Admin\PermissionsController@show','as' => 'admin.permissions.show']);
   // Settings 
   Route::get('settings', ['uses' => 'Settings\SettingsController@index','as' => 'settings.index']);
   Route::post('settings/update', ['uses' => 'Settings\SettingsController@update','as' => 'settings.update']);




   //Route::resource('admin/roles', 'Admin\RolesController');


   // Permissions
   //Route::resource('admin/permissions', 'Admin\PermissionsController');
   //Route::delete('permissions_mass_destroy', 'Admin\PermissionsController@massDestroy')->name('permissions.mass_destroy');

   //Route::delete('roles_mass_destroy', 'Admin\RolesController@massDestroy')->name('roles.mass_destroy');


   // Ülke İl İlçe
   Route::post('ilceler/ulkeyeyeAitSehirler', ['uses' => 'Settings\UlkeSehirIlceCotroller@ulkeyeyeAitSehirler','as' => 'ilceler.ulkeyeyeAitSehirler']);
   /*
   _____________________________________________________________________________________________
   1- MOD STOK
   _____________________________________________________________________________________________
   */
   // Ürün
   Route::get('urun', ['uses' => 'Urun\UrunController@index','as' => 'urun.index']);
   Route::post('urun', ['uses' => 'Urun\UrunController@store','as' => 'urun.store']);
   Route::post('urun/destroy', ['uses' => 'Urun\UrunController@destroy','as' => 'urun.destroy']);
   Route::post('urun/edit', ['uses' => 'Urun\UrunController@edit','as' => 'urun.edit']);
   Route::post('urun/update', ['uses' => 'Urun\UrunController@update','as' => 'urun.update']);
   Route::post('urun/copy', ['uses' => 'Urun\UrunController@copy','as' => 'urun.copy']);

   // Params
   Route::get('params', ['uses' => 'Params\ParamsController@index','as' => 'params.index']);
   Route::post('params', ['uses' => 'Params\ParamsController@store','as' => 'params.store']);
   Route::post('params/destroy', ['uses' => 'Params\ParamsController@destroy','as' => 'params.destroy']);
   Route::post('params/copy', ['uses' => 'Params\ParamsController@copy','as' => 'params.copy']);
   Route::post('params/edit', ['uses' => 'Params\ParamsController@edit','as' => 'params.edit']);
   Route::post('params/update', ['uses' => 'Params\ParamsController@update','as' => 'params.update']);


   // Cari
   Route::get('cari', ['uses' => 'Cari\CariController@index','as' => 'cari.index']);
   Route::post('cari', ['uses' => 'Cari\CariController@store','as' => 'cari.store']);
   Route::post('cari/destroy', ['uses' => 'Cari\CariController@destroy','as' => 'cari.destroy']);
   Route::post('cari/edit', ['uses' => 'Cari\CariController@edit','as' => 'cari.edit']);
   Route::post('cari/update', ['uses' => 'Cari\CariController@update','as' => 'cari.update']);
   Route::get('cari/{id}', ['uses' => 'Cari\CariController@show','as' => 'cari.show']);


   //Fatura Alış Faturası
   Route::get('fatura/alis', ['uses' => 'Fatura\FaturaAlisController@index','as' => 'fatura.alis.index']);
   Route::post('fatura/alis', ['uses' => 'Fatura\FaturaAlisController@store','as' => 'fatura.alis.store']);
   Route::post('fatura/alis/edit', ['uses' => 'Fatura\FaturaAlisController@edit','as' => 'fatura.alis.edit']);
   Route::post('fatura/alis/update', ['uses' => 'Fatura\FaturaAlisController@update','as' => 'fatura.alis.update']);
   Route::post('fatura/alis/destroy', ['uses' => 'Fatura\FaturaAlisController@destroy','as' => 'fatura.alis.destroy']);
   Route::get('fatura/alis/{id}', ['uses' => 'Fatura\FaturaAlisController@show','as' => 'fatura.alis.show']);
   Route::post('fatura/alis/UrunEkle', ['uses' => 'Fatura\FaturaAlisController@UrunEkle','as' => 'fatura.alis.UrunEkle']);
   Route::post('fatura/alis/UrunSil', ['uses' => 'Fatura\FaturaAlisController@UrunSil','as' => 'fatura.alis.UrunSil']);
   Route::post('fatura/alis/UrunEdit', ['uses' => 'Fatura\FaturaAlisController@UrunEdit','as' => 'fatura.alis.UrunEdit']);
   Route::post('fatura/alis/UrunUpdate', ['uses' => 'Fatura\FaturaAlisController@UrunUpdate','as' => 'fatura.alis.UrunUpdate']);
   Route::post('fatura/alis/FaturaKapat', ['uses' => 'Fatura\FaturaAlisController@FaturaKapat','as' => 'fatura.alis.FaturaKapat']);
   Route::post('fatura/alis/FaturaGeriAl', ['uses' => 'Fatura\FaturaAlisController@FaturaGeriAl','as' => 'fatura.alis.FaturaGeriAl']);
   Route::post('fatura/alis/FaturaRaporu', ['uses' => 'Fatura\FaturaAlisController@FaturaRaporu','as' => 'fatura.alis.FaturaRaporu']);
   
   //BANKA 
   Route::get('banka', ['uses' => 'Banka\BankaController@index', 'as' => 'banka.index']);
   Route::post('banka', ['uses' => 'Banka\BankaController@store', 'as' => 'satis.store']);
   Route::post('banka/destroy', ['uses' => 'Banka\BankaController@destroy', 'as' => 'banka.destroy']);
   
   // Satış
   Route::get('satis', ['uses' => 'Satis\SatisController@index','as' => 'satis.index']);
   Route::get('satis/store', ['uses' => 'Satis\SatisController@store','as' => 'satis.store']);
   Route::get('satis/{id}', ['uses' => 'Satis\SatisController@show', 'as' => 'satis.show']);
   Route::post('satis/BarkodOku', ['uses' => 'Satis\SatisController@BarkodOku', 'as' => 'satis.BarkodOku']);
   Route::post('satis/UrunGiris', ['uses' => 'Satis\SatisController@UrunGiris', 'as' => 'satis.UrunGiris']);
   Route::post('satis/UrunArtir', ['uses' => 'Satis\SatisController@UrunArtir', 'as' => 'satis.UrunArtir']);
   Route::post('satis/UrunAzalt', ['uses' => 'Satis\SatisController@UrunAzalt', 'as' => 'satis.UrunAzalt']);
   Route::post('satis/UrunSil', ['uses' => 'Satis\SatisController@UrunSil', 'as' => 'satis.UrunSil']);
   Route::post('satis/FisIptal', ['uses' => 'Satis\SatisController@FisIptal', 'as' => 'satis.FisIptal']);
   Route::post('satis/NakitKapat', ['uses' => 'Satis\SatisController@NakitKapat', 'as' => 'satis.NakitKapat']);
   Route::post('satis/KartKapat', ['uses' => 'Satis\SatisController@KartKapat', 'as' => 'satis.KartKapat']);
   Route::post('satis/VeresiyeKapat', ['uses' => 'Satis\SatisController@VeresiyeKapat', 'as' => 'satis.VeresiyeKapat']);
   Route::get('satis/FisYazdir/{id}', ['uses' => 'Satis\SatisController@FisYazdir', 'as' => 'satis.FisYazdir']);
   Route::post('satis/SatisRaporu', ['uses' => 'Satis\SatisController@SatisRaporu', 'as' => 'satis.SatisRaporu']);

   // TAHSİLAT
   Route::get('tahsilat', ['uses' => 'Tahsilat\TahsilatController@index', 'as' => 'tahsilat.index']);
   Route::post('tahsilat', ['uses' => 'Tahsilat\TahsilatController@store', 'as' => 'tahsilat.store']);
   Route::post('tahsilat/BorcListesi', ['uses' => 'Tahsilat\TahsilatController@BorcListesi', 'as' => 'tahsilat.BorcListesi']);
   Route::post('tahsilat/FiyatGuncelle', ['uses' => 'Tahsilat\TahsilatController@FiyatGuncelle', 'as' => 'tahsilat.FiyatGuncelle']);
   Route::post('tahsilat/BorcKapat', ['uses' => 'Tahsilat\TahsilatController@BorcKapat', 'as' => 'tahsilat.BorcKapat']);
   Route::post('tahsilat/TahsilatSil', ['uses' => 'Tahsilat\TahsilatController@TahsilatSil', 'as' => 'tahsilat.TahsilatSil']);
   Route::get('tahsilat/TahsilatRaporu', ['uses' => 'Tahsilat\TahsilatController@TahsilatRaporu', 'as' => 'tahsilat.TahsilatRaporu']);
   Route::post('tahsilat/RaporSorgu', ['uses' => 'Tahsilat\TahsilatController@RaporSorgu', 'as' => 'tahsilat.RaporSorgu']);

   // ODEMELER
   Route::get('odeme', ['uses' => 'Odeme\OdemeController@index', 'as' => 'odeme.index']);
   Route::post('odeme', ['uses' => 'Odeme\OdemeController@store', 'as' => 'odeme.store']);
   Route::post('odeme/OdemeSil', ['uses' => 'Odeme\OdemeController@OdemeSil', 'as' => 'odeme.OdemeSil']);
   Route::post('odeme/OdemeRaporu', ['uses' => 'Odeme\OdemeController@OdemeRaporu', 'as' => 'odeme.OdemeRaporu']);
   
   // CEK SENET
   Route::get('cek', ['uses' => 'Odeme\CekController@index', 'as' => 'cek.index']);
   Route::post('cek', ['uses' => 'Odeme\CekController@store', 'as' => 'cek.store']);
   Route::post('cek/CekRaporu', ['uses' => 'Odeme\CekController@CekRaporu', 'as' => 'cek.CekRaporu']);


  
});

