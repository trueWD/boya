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

   //x Route::resource('admin/users', 'Admin\UsersController');

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

   // Onay
   Route::get('settings/onay', ['uses' => 'Settings\OnayController@index','as' => 'settings.onay.index']);
   Route::post('settings/onay', ['uses' => 'Settings\OnayController@store','as' => 'settings.onay.store']);
   Route::post('settings/onay/destroy', ['uses' => 'Settings\OnayController@destroy','as' => 'settings.onay.destroy']);
   Route::post('settings/onay/copy', ['uses' => 'Settings\OnayController@copy','as' => 'settings.onay.copy']);
   Route::post('settings/onay/edit', ['uses' => 'Settings\OnayController@edit','as' => 'settings.onay.edit']);
   Route::post('settings/onay/update', ['uses' => 'Settings\OnayController@update','as' => 'settings.onay.update']);
   
   Route::get('settings/depo', ['uses' => 'Settings\DepoController@index','as' => 'settings.depo.index']);
   Route::post('settings/depo', ['uses' => 'Settings\DepoController@store','as' => 'settings.depo.store']);
   Route::post('settings/depo/delete', ['uses' => 'Settings\DepoController@destroy','as' => 'settings.depo.delete']);
   Route::post('settings/depo/IstifKaydet', ['uses' => 'Settings\DepoController@IstifKaydet','as' => 'settings.depo.IstifKaydet']);
   Route::post('settings/depo/IstifDelete', ['uses' => 'Settings\DepoController@IstifDelete','as' => 'settings.depo.IstifDelete']);
   Route::post('settings/depo/DepoIstifleri', ['uses' => 'Settings\DepoController@DepoIstifleri','as' => 'settings.depo.DepoIstifleri']); //Depoya ait istifler

   // Cari
   Route::get('cari', ['uses' => 'Cari\CariController@index','as' => 'cari.index']);
   Route::post('cari', ['uses' => 'Cari\CariController@store','as' => 'cari.store']);
   Route::post('cari/destroy', ['uses' => 'Cari\CariController@destroy','as' => 'cari.destroy']);
   Route::post('cari/edit', ['uses' => 'Cari\CariController@edit','as' => 'cari.edit']);
   Route::post('cari/update', ['uses' => 'Cari\CariController@update','as' => 'cari.update']);
   Route::get('cari/{id}', ['uses' => 'Cari\CariController@show','as' => 'cari.show']);

   // Sipariş - İç Piyasa
   Route::get('siparis/icpiyasa', ['uses' => 'Siparis\IcpiyasaSiparisController@index','as' => 'siparis.icpiyasa.index']);
   Route::post('siparis/icpiyasa', ['uses' => 'Siparis\IcpiyasaSiparisController@store','as' => 'siparis.icpiyasa.store']);
   Route::post('siparis/icpiyasa/edit', ['uses' => 'Siparis\IcpiyasaSiparisController@edit','as' => 'siparis.icpiyasa.edit']);
   Route::post('siparis/icpiyasa/update', ['uses' => 'Siparis\IcpiyasaSiparisController@update','as' => 'siparis.icpiyasa.update']);
   Route::get('siparis/icpiyasa/{id}', ['uses' => 'Siparis\IcpiyasaSiparisController@show','as' => 'siparis.icpiyasa.show']);
   Route::post('siparis/icpiyasa/urunDurumu', ['uses' => 'Siparis\IcpiyasaSiparisController@urunDurumu','as' => 'siparis.icpiyasa.urunDurumu']);
   Route::post('siparis/icpiyasa/urunEkle', ['uses' => 'Siparis\IcpiyasaSiparisController@urunEkle','as' => 'siparis.icpiyasa.urunEkle']);
   Route::post('siparis/icpiyasa/UrunEdit', ['uses' => 'Siparis\IcpiyasaSiparisController@UrunEdit','as' => 'siparis.icpiyasa.UrunEdit']);
   Route::post('siparis/icpiyasa/UrunUpdate', ['uses' => 'Siparis\IcpiyasaSiparisController@UrunUpdate','as' => 'siparis.icpiyasa.UrunUpdate']);
   Route::post('siparis/icpiyasa/NotEkle', ['uses' => 'Siparis\IcpiyasaSiparisController@NotEkle','as' => 'siparis.icpiyasa.NotEkle']);
   Route::post('siparis/icpiyasa/DeleteNot', ['uses' => 'Siparis\IcpiyasaSiparisController@DeleteNot','as' => 'siparis.icpiyasa.DeleteNot']);
   Route::get('siparis/icpiyasa/TeklifYazdir/{id}', ['uses' => 'Siparis\IcpiyasaSiparisController@TeklifYazdir','as' => 'siparis.icpiyasa.TeklifYazdir']);
   
   // Sipariş Onay - İç Piyasa
   Route::post('siparis/icpiyasa/OnayaGonder', ['uses' => 'Siparis\SiparisOnayController@OnayaGonder','as' => 'siparis.icpiyasa.OnayaGonder']);
   Route::post('siparis/icpiyasa/OnaydanGeriAl', ['uses' => 'Siparis\SiparisOnayController@OnaydanGeriAl','as' => 'siparis.icpiyasa.OnaydanGeriAl']);
   Route::post('siparis/icpiyasa/SiparisOnayla', ['uses' => 'Siparis\SiparisOnayController@SiparisOnayla','as' => 'siparis.icpiyasa.SiparisOnayla']);

   //Tedarik
   Route::get('tedarik', ['uses' => 'Tedarik\TedarikController@index','as' => 'tedarik.index']);
   Route::post('tedarik/create', ['uses' => 'Tedarik\TedarikController@create','as' => 'tedarik.create']);
   Route::post('tedarik/SiparisIptal', ['uses' => 'Tedarik\TedarikController@SiparisIptal','as' => 'tedarik.SiparisIptal']);
  
   //Depo
   Route::get('depo/urunKabul', ['uses' => 'Depo\UrunKabulController@urunKabul','as' => 'depo.urunKabul']);
   Route::get('depo/etiket', ['uses' => 'Depo\EtiketController@index','as' => 'depo.index']);
   Route::post('depo/etiket/PiyasaEtiket', ['uses' => 'Depo\EtiketController@PiyasaEtiket','as' => 'depo.etiket.PiyasaEtiket']);
   Route::post('depo/etiket/PiyasaEtiketOlustur', ['uses' => 'Depo\EtiketController@PiyasaEtiketOlustur','as' => 'depo.etiket.PiyasaEtiketOlustur']);
    
   //Uretim
   Route::get('uretim', ['uses' => 'Uretim\UretimController@index','as' => 'uretim.index']);
   Route::post('uretim/SiparisListesi', ['uses' => 'Uretim\UretimController@SiparisListesi','as' => 'uretim.SiparisListesi']);
   Route::post('uretim/UretimeEkle', ['uses' => 'Uretim\UretimController@UretimeEkle','as' => 'uretim.UretimeEkle']);
   Route::post('uretim/UretimSil', ['uses' => 'Uretim\UretimController@UretimSil','as' => 'uretim.UretimSil']);
   Route::post('uretim/SiralamaDegis', ['uses' => 'Uretim\UretimController@SiralamaDegis','as' => 'uretim.SiralamaDegis']);


  
  
  
});

