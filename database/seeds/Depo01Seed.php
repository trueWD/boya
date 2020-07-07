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
			'depoadi' => 'SICAK HADDE İŞ MERKEZİ',
			'aciklama' => 'Sıcak Hadde Holu',
            'tipi' => 'URETIM',
            'uretim_grubu' => 'SH',
            'kapasite' => '300000',
			'uzunluk' => '300',
            'genislik' => '1000',
            'yukseklik' => '15',
			'sira' => '1',
        ]);
        $depo = Depo01::create([
			'depoadi' => 'SOĞUK ÇEKME İŞ MERKEZİ',
			'aciklama' => 'Soğuk çekme Holu',
            'tipi' => 'URETIM',
            'uretim_grubu' => 'SC',
            'kapasite' => '300000',
			'uzunluk' => '300',
            'genislik' => '1000',
            'yukseklik' => '15',
			'sira' => '2',
        ]);
        $depo = Depo01::create([
			'depoadi' => 'TEL VE ÇİVİ İŞ MERKEZİ',
			'aciklama' => 'Tel ve Çivi  Holu',
            'tipi' => 'URETIM',
            'uretim_grubu' => 'CIVI',
            'kapasite' => '300000',
			'uzunluk' => '300',
            'genislik' => '1000',
            'yukseklik' => '15',
			'sira' => '3',
        ]);
        $depo = Depo01::create([
			'depoadi' => 'PROFİL HADDESİ İŞ MERKEZİ',
			'aciklama' => 'Profil Haddesi  Holu',
            'tipi' => 'URETIM',
            'uretim_grubu' => 'PROFIL',
            'kapasite' => '300000',
			'uzunluk' => '300',
            'genislik' => '1000',
            'yukseklik' => '15',
			'sira' => '4',
        ]);
        // DEPO
        $depo = Depo01::create([
			'depoadi' => 'İÇ PİYASA YÜKLEME HOLU',
            'aciklama' => 'İç Piyasa Yükleme Holu',
            'tipi' => 'DEPO',
            'kapasite' => '300000',
			'uzunluk' => '300',
            'genislik' => '1000',
            'yukseklik' => '15',
			'sira' => '1',
        ]);
        $depo = Depo01::create([
			'depoadi' => 'İHRACAT YÜKLEME HOLU',
            'aciklama' => 'İhracat Yükleme Holu',
            'tipi' => 'DEPO',
            'kapasite' => '300000',
			'uzunluk' => '300',
            'genislik' => '1000',
            'yukseklik' => '15',
			'sira' => '1',
        ]);
    }
}