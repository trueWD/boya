<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PermissionSeed::class);
        $this->call(RoleSeed::class);
        $this->call(UserSeed::class);
        $this->call(SettingsSeed::class);
        $this->call(ParamsSeed::class);
        $this->call(Cari01Seed::class);
        $this->call(Urun01Seed::class);
        $this->call(Depo01Seed::class);
        $this->call(Depo02Seed::class);
        $this->call(Fiyat01Seed::class);

        Eloquent::unguard();
        $ulkeler = 'database/seeds/sql/ulkeler.sql';
        DB::unprepared(file_get_contents($ulkeler));
        $this->command->info('Ülke Tablosu İşlendi...');

        $sehirler = 'database/seeds/sql/sehirler.sql';
        DB::unprepared(file_get_contents($sehirler));
        $this->command->info('Şehirler Tablosu İşlendi...');

        $ilceler = 'database/seeds/sql/ilceler.sql';
        DB::unprepared(file_get_contents($ilceler));
        $this->command->info('İlçeler Tablosu İşlendi...');
    }
}
