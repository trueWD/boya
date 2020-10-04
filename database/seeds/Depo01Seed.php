<?php

use Illuminate\Database\Seeder;
use App\Models\Depo01;

class Depo01Seed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // ÜRETİM
        $depo = Depo01::create([
			'depoadi' => 'ABAYLI YAPI ÇAKMAK',
			'aciklama' => 'Çakmak şubesi ',
            'tipi' => 'MERKEZ',
			'sira' => '1',
        ]);
        $depo = Depo01::create([
			'depoadi' => 'ABAYLI YAPI İÇERENKÖY',
			'aciklama' => 'Çakmak şubesi ',
            'tipi' => 'ŞUBE 2',
			'sira' => '2',
        ]);

    }
}