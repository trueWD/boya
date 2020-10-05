<?php

use Illuminate\Database\Seeder;
use App\Models\Fiyat01;

class Fiyat01Seed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = Fiyat01::create([
            "adi" => "% 10 KAR ORANLI",
            "oran" => "10",
            "indirim_oran" => "10",
            "aciklama" => "% 10 KAR ORANLI",
        ]);
        $param = Fiyat01::create([
            "adi" => "% 20 KAR ORANLI",
            "oran" => "20",
            "indirim_oran" => "20",
            "aciklama" => "% 20 KAR ORANLI",
        ]);
        $param = Fiyat01::create([
            "adi" => "% 30 KAR ORANLI",
            "oran" => "30",
            "indirim_oran" => "30",
            "aciklama" => "% 30 KAR ORANLI",
        ]);
    }
}
