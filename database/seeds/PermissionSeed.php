<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Artisan::call('cache:clear');
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
        // User Mod
        Permission::create(['name' => 'users_manage','description' => 'Geliştirici Ortamı Tüm Yetkiler','modid' => '1']);
        Permission::create(['name' => 'user_delete','description' => 'Kullanıcıları Silebilir','modid' => '1']);
        Permission::create(['name' => 'user_edit','description' => 'Kullanıcıları Düzenliyebilir','modid' => '1']);
        Permission::create(['name' => 'user_create','description' => 'Kulannıcı Ekleyebilir','modid' => '1']);
        Permission::create(['name' => 'user_show','description' => 'Kullanıcıları Görebilir','modid' => '1']);
    }
}
