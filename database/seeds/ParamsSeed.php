<?php

use Illuminate\Database\Seeder;

use App\Models\Params;

class ParamsSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


	/*
	_____________________________________________________________________________________________
	urun01
	_____________________________________________________________________________________________
	*/
		// urun01 - tolerans
        $param = Params::create([
		    "database" => "urun01",
		    "alan" => "birim",
		    "deger" => "KG",
		    "sira" => "01",
		    "aciklama" => "Kilo Gram",
        ]);
        $param = Params::create([
		    "database" => "urun01",
		    "alan" => "birim",
		    "deger" => "ADET",
		    "sira" => "02",
		    "aciklama" => "Adet",
        ]);
        $param = Params::create([
		    "database" => "urun01",
		    "alan" => "birim",
		    "deger" => "METRE",
		    "sira" => "03",
		    "aciklama" => "Metre",
        ]);

        $param = Params::create([
		    "database" => "urun01",
		    "alan" => "grubu",
		    "deger" => "BOYA",
		    "sira" => "01",
		    "aciklama" => "Boya Ürünleri",
        ]);
        $param = Params::create([
		    "database" => "urun01",
		    "alan" => "grubu",
		    "deger" => "HIRDAVAT",
		    "sira" => "02",
		    "aciklama" => "Hırdavat Ürünleri",
        ]);
        $param = Params::create([
		    "database" => "urun01",
		    "alan" => "grubu",
		    "deger" => "GENEL",
		    "sira" => "03",
		    "aciklama" => "Sarf Malzeme",
		]);
		


        $param = Params::create([
		    "database" => "urun01",
		    "alan" => "marka",
		    "deger" => "FİLLİ BOYA",
		    "sira" => "01",
		    "aciklama" => "Filli Boya Ürünleri",
        ]);
        $param = Params::create([
		    "database" => "urun01",
		    "alan" => "marka",
		    "deger" => "DİYOSAN",
		    "sira" => "02",
		    "aciklama" => "Diyosan Ürünleri",
        ]);
        $param = Params::create([
		    "database" => "urun01",
		    "alan" => "marka",
		    "deger" => "MARŞAL",
		    "sira" => "03",
		    "aciklama" => "Marşal boya ürünleri",
        ]);
        $param = Params::create([
		    "database" => "urun01",
		    "alan" => "marka",
		    "deger" => "GENEL",
		    "sira" => "04",
		    "aciklama" => "Genel Boya Ürünleri",
		]);
		


        $param = Params::create([
		    "database" => "cari01",
		    "alan" => "grubu",
		    "deger" => "MUSTERI",
		    "sira" => "01",
		    "aciklama" => "Müşteri cari grubu",
        ]);
        $param = Params::create([
		    "database" => "cari01",
		    "alan" => "grubu",
		    "deger" => "TEDARIKCI",
		    "sira" => "02",
		    "aciklama" => "Tedarikci müşteri grubu",
        ]);
        $param = Params::create([
		    "database" => "cari01",
		    "alan" => "grubu",
		    "deger" => "HIZMET",
		    "sira" => "03",
		    "aciklama" => "İşçilik ve diğer hizmet grubu",
        ]);







    }
}
