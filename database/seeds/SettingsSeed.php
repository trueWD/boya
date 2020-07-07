<?php

use Illuminate\Database\Seeder;
use App\Models\Settings;

class SettingsSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $setting = Settings::create([
            'maintenance' => 'Active',
            'version' => '1.13',
            'siparis_onay' => 'Active'
        ]);
    }
}
