<?php

use Illuminate\Database\Seeder;
use App\Models\Cari01;

class Cari01Seed extends Seeder
{
    public function run()
    {
		$stok = Cari01::create([
			'durumu' => 'AKTIF',
			'grubu' => 'MUSTERI',
            'cariadi' => 'DENEME 1 MUSTERI CARİ A.Ş.',
            'muhasebeapi' => '11111',
			'vergino' => '123123123123',
            'vergidairesi' => 'SARIGAZİ V.D',
			'ulke' => 'Turkey',
			'sehir' => 'İSTANBUL',
            'ilce' => 'Ümraniye',
			'adres' => 'Tepeüstü Mah. Yalınkent Sok. Yalınkent Apt No:2 A Blok',
			'telefon' => '05327233084',
			'telefon2' => '05327233084',
			'faks' => '05327233084',
			'website' => 'http://truewd.net',
            'email' => 'truewd@hotmail.com',
			'yetkili' => 'Yunus KOCABAY',
			'yetkili_gsm' => 'Yunus KOCABAY',
			'temsilci' => 'Sümeyra KOCABAY',
            'bakiye' => '0',
            'parabirimi' => 'TL',
            'riskgrubu' => 'Normal',
            'vadegun' => '120',
			'aciklama' => 'Deneme Amaçlı bu programın yazılımcısı tarafından açılmış bir caridir.',
        ]);

		$stok = Cari01::create([
			'durumu' => 'AKTIF',
			'grubu' => 'MUSTERI',
            'cariadi' => 'DENEME MUSTERI 2 CARİ A.Ş.',
            'muhasebeapi' => '11111',
			'vergino' => '123123123123',
            'vergidairesi' => 'SARIGAZİ V.D',
			'ulke' => 'Turkey',
			'sehir' => 'İSTANBUL',
            'ilce' => 'Ümraniye',
			'adres' => 'Tepeüstü Mah. Yalınkent Sok. Yalınkent Apt No:2 A Blok',
			'telefon' => '05327233084',
			'telefon2' => '05327233084',
			'faks' => '05327233084',
			'website' => 'http://truewd.net',
            'email' => 'truewd@hotmail.com',
			'yetkili' => 'Yunus KOCABAY',
			'yetkili_gsm' => 'Yunus KOCABAY',
			'temsilci' => 'Sümeyra KOCABAY',
            'bakiye' => '0',
            'parabirimi' => 'TL',
            'riskgrubu' => 'Normal',
            'vadegun' => '120',
			'aciklama' => 'Deneme Amaçlı bu programın yazılımcısı tarafından açılmış bir caridir.',
        ]);

		$stok = Cari01::create([
			'durumu' => 'AKTIF',
			'grubu' => 'TEDARIKCI',
            'cariadi' => 'DENEME 1 TEDARIKCI CARİ A.Ş.',
            'muhasebeapi' => '11111',
			'vergino' => '123123123123',
            'vergidairesi' => 'SARIGAZİ V.D',
			'ulke' => 'Turkey',
			'sehir' => 'İSTANBUL',
            'ilce' => 'Ümraniye',
			'adres' => 'Tepeüstü Mah. Yalınkent Sok. Yalınkent Apt No:2 A Blok',
			'telefon' => '05327233084',
			'telefon2' => '05327233084',
			'faks' => '05327233084',
			'website' => 'http://truewd.net',
            'email' => 'truewd@hotmail.com',
			'yetkili' => 'Yunus KOCABAY',
			'yetkili_gsm' => 'Yunus KOCABAY',
			'temsilci' => 'Sümeyra KOCABAY',
            'bakiye' => '0',
            'parabirimi' => 'TL',
            'riskgrubu' => 'Normal',
            'vadegun' => '120',
			'aciklama' => 'Deneme Amaçlı bu programın yazılımcısı tarafından açılmış bir caridir.',
        ]);

		$stok = Cari01::create([
			'durumu' => 'AKTIF',
			'grubu' => 'TEDARIKCI',
            'cariadi' => 'DENEME 2 TEDARIKCI CARİ A.Ş.',
            'muhasebeapi' => '11111',
			'vergino' => '123123123123',
            'vergidairesi' => 'SARIGAZİ V.D',
			'ulke' => 'Turkey',
			'sehir' => 'İSTANBUL',
            'ilce' => 'Ümraniye',
			'adres' => 'Tepeüstü Mah. Yalınkent Sok. Yalınkent Apt No:2 A Blok',
			'telefon' => '05327233084',
			'telefon2' => '05327233084',
			'faks' => '05327233084',
			'website' => 'http://truewd.net',
            'email' => 'truewd@hotmail.com',
			'yetkili' => 'Yunus KOCABAY',
			'yetkili_gsm' => 'Yunus KOCABAY',
			'temsilci' => 'Sümeyra KOCABAY',
            'bakiye' => '0',
            'parabirimi' => 'TL',
            'riskgrubu' => 'Normal',
            'vadegun' => '120',
			'aciklama' => 'Deneme Amaçlı bu programın yazılımcısı tarafından açılmış bir caridir.',
        ]);




    }
}
