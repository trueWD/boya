<?php

use Illuminate\Database\Seeder;
use App\Models\Depo02;

class Depo02Seed extends Seeder
{
    public function run()
    {
        $depo = Depo02::create([
			'depoid' => '1',
            'adi' => '1. İŞ İSTASYONU ',
            'tipi' => 'URETIM',
            'aciklama' => 'Birinci iş istasyonu',
            'kapasite' => '400',
			'sira' => '1',
        ]);
        $depo = Depo02::create([
			'depoid' => '2',
			'adi' => '1. İŞ İSTASYONU ',
			'tipi' => 'URETIM',
            'aciklama' => 'Birinci iş istasyonu',
            'kapasite' => '400',
			'sira' => '1',
        ]);
        $depo = Depo02::create([
			'depoid' => '2',
            'adi' => '2. İŞ İSTASYONU ',
            'tipi' => 'URETIM',
            'aciklama' => 'İkinci iş istasyonu',
            'kapasite' => '400',
			'sira' => '1',
        ]);
        $depo = Depo02::create([
			'depoid' => '3',
            'adi' => '3. İŞ İSTASYONU ',
            'tipi' => 'URETIM',
            'aciklama' => 'İkinci iş istasyonu',
            'kapasite' => '400',
			'sira' => '1',
        ]);
        $depo = Depo02::create([
			'depoid' => '4',
            'adi' => '4. İŞ İSTASYONU ',
            'tipi' => 'URETIM',
            'aciklama' => 'İkinci iş istasyonu',
            'kapasite' => '400',
			'sira' => '1',
        ]);
        $depo = Depo02::create([
			'depoid' => '2',
            'adi' => '3. İŞ İSTASYONU ',
            'tipi' => 'URETIM',
            'aciklama' => 'Üçüncü iş istasyonu',
            'kapasite' => '400',
			'sira' => '1',
        ]);
    }
}
