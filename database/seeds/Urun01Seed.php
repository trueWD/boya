<?php

use Illuminate\Database\Seeder;
use App\Models\Urun01;

class Urun01Seed extends Seeder
{
    public function run()
    {
    /*
	_____________________________________________________________________________________________
	urun01
	_____________________________________________________________________________________________
	*/
		// urun01 - Ürün Listesi
        $urun = Urun01::create([
            'barkod' =>  '1111',
            'marka' =>  'FİLLİ BOYA ',
            'urunadi' =>  'FİLLİ BOYA 18LT SİYAH',
            'urunkodu' =>  'FL1818',
            'birim' =>  'KG',
            'miktar' =>  '18',
            'kdv' =>  '18',
            'grubu' =>  'BOYA',
            'fiyat_grubu' =>  '1',
            'fiyat' =>  '1000',
            'stok' =>  '10',
            'satis_fiyat' =>  '350',
            'max_stok' =>  '500',
            'min_stok' =>  '10',
        ]);
        $urun = Urun01::create([
            'barkod' =>  '2222',
            'marka' =>  'FİLLİ BOYA ',
            'urunadi' =>  'FİLLİ BOYA 10LT SİYAH',
            'urunkodu' =>  'FL1818',
            'birim' =>  'KG',
            'miktar' =>  '10',
            'grubu' =>  'BOYA',
            'fiyat_grubu' =>  '1',
            'fiyat' =>  '1000',
            'stok' =>  '10',
            'satis_fiyat' =>  '350',
            'max_stok' =>  '500',
            'min_stok' =>  '10',
            'kdv' =>  '18',
        ]);
        $urun = Urun01::create([
            'barkod' =>  '4444',
            'marka' =>  'FİLLİ BOYA ',
            'urunadi' =>  'FİLLİ BOYA 2LT SİYAH',
            'urunkodu' =>  'FL22',
            'birim' =>  'KG',
            'miktar' =>  '2',
            'grubu' =>  'BOYA',
            'fiyat_grubu' =>  '2',
            'fiyat' =>  '1000',
            'satis_fiyat' =>  '350',
            'stok' =>  '10',
            'max_stok' =>  '500',
            'min_stok' =>  '10',
        ]);
        $urun = Urun01::create([
            'barkod' =>  '3333',
            'marka' =>  'MARŞAL BOYA ',
            'urunadi' =>  'MARŞAL BOYA 18LT SİYAH',
            'urunkodu' =>  'FL1818',
            'birim' =>  'KG',
            'miktar' =>  '18',
            'kdv' =>  '18',
            'grubu' =>  'BOYA',
            'fiyat_grubu' =>  '2',
            'fiyat' =>  '1000',
            'satis_fiyat' =>  '350',
            'stok' =>  '10',
            'max_stok' =>  '500',
            'min_stok' =>  '10',
            
        ]);
        $urun = Urun01::create([
            'barkod' =>  '5555',
            'marka' =>  'MARŞAL BOYA ',
            'urunadi' =>  'MARŞAL BOYA 10LT SİYAH',
            'urunkodu' =>  'FL1818',
            'birim' =>  'KG',
            'miktar' =>  '10',
            'kdv' =>  '18',
            'grubu' =>  'BOYA',
            'fiyat_grubu' =>  '1',
            'fiyat' =>  '1000',
            'satis_fiyat' =>  '350',
            'stok' =>  '10',
            'max_stok' =>  '500',
            'min_stok' =>  '10',
        ]);
        $urun = Urun01::create([
            'barkod' =>  '8888',
            'marka' =>  'MARŞAL BOYA ',
            'urunadi' =>  'MARŞAL BOYA 2LT SİYAH',
            'urunkodu' =>  'FL22',
            'birim' =>  'KG',
            'kdv' =>  '18',
            'miktar' =>  '2',
            'grubu' =>  'BOYA',
            'fiyat_grubu' =>  '2',
            'fiyat' =>  '1000',
            'satis_fiyat' =>  '350',
            'stok' =>  '10',
            'max_stok' =>  '500',
            'min_stok' =>  '10',
        ]);
        
  


    }
}


