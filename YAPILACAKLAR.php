<?php




Schema::create('siparis02', function (Blueprint $table) {
    $table->bigIncrements('id');
    $table->string('HareketTipi')->nullable(); 		// Stok / Hizmet / Stok kartı çıkışı yapılabildiği gibi nakliye bedeli veya kumlama hizmeti gibi işçilikler de yazılabilir.
    $table->string('UrunID')->nullable();
    $table->string('UrunAdi')->nullable();
    $table->string('Kalitesi')->nullable();
    $table->string('Toleransi')->nullable();
    $table->string('ToleransTipi')->nullable(); 	// Gercek/Teorik 
    $table->string('Boyu')->nullable();
    $table->string('DepoKodu')->nullable();		// Girilen stok bilgisine göre hangi depoda ne kadar mamul olduğuna dair bir popup açılabilir ve hangi depodaki mamul satılmak isteniyorsa seçim yapılabilir. 
    $table->string('SiparisMiktarı')->nullable(); 
    $table->string('ReserveMiktari')->nullable(); 	// Stokdan reserve edilen miktar
    $table->string('TeslimMiktari')->nullable();	// Sevkiyatı yapılmış olan miktar
    $table->string('Birimi')->nullable();		// KG/ MT /AD/

    ???

    $table->string('SistemMiktari')->nullable(); 	// Gizli alan. Kullanıcı görmeyebilir. Ancak MT veya Adet satışı yapılsa bile sistem raporlamalar için KG bazında takip yapabilsin. 

    $table->string('HarBirimFiyati')->nullable();	// Dolar veya Euro satışlarında önemli
    $table->string('ParaBirimi')->nullable();		// TL/Dolar/Euro
    $table->string('Kur')->nullable(); 
    $table->string('YPBirimFiyatı')->nullable();	// Girilenkur * HareketBirimFiyati

    $table->string('ListeFiyati')->nullable();		// Yapılan iskontoyu takip etmek için gerekli 
    $table->string('HareketTutari')->nullable();	// kalemin dövizli fiyati
    $table->string('YPTutari')->nullable();		    // kalemin Yerel para birimi tutarı
    $table->string('IskontoTutari')->nullable();	// Kaleme uygulanan iskonto tutarı
    $table->string('IskontoOrani')->nullable();		// Onaylama aşamasında hangi kaleme ne kadar iskonto oranı uygulanmış görmek açısından iyi oluyor
    $table->string('TerminTarihi')->nullable();		// Müşteriye verilen termin tarihi 
    $table->string('SevkTarihi')->nullable();		// Sevk edilen Tarih / Her sevkiyatta güncellenir ve termin ile sevkiyat tarihleri arasındaki fark takip edilir.
    $table->string('TeslimTarihi')->nullable();		// İhracat için gerekli sevkiyat limana farklı tarihte yapılmalı ancak müşteriye teslim farklı tarihtedir. İç Piyasada gerek olmuyor. Sevkiyattan 24 saat içinde teslim oluyor. 
    $table->string('OnayDurumu')->nullable();		//Kalem Bazında Onay durumu / Teklif / Sipariş / Teslim / Iptal
    $table->string('KDVOrani')->nullable();
    $table->string('KDVTutari')->nullable();
    $table->string('OTVOrani')->nullable();
    $table->string('OTVTutari')->nullable();
    $table->string('TevkifatOrani')->nullable();	//KDV bölüştürmesi 
    $table->string('TevkifatTutari')->nullable();	//KDV bölüştürmesi 
    $table->string('DigerVergiTutari')->nullable();	// Vergiler
    $table->string('MuhEntKodu')->nullable(); 		//Muhasebe Entegrasyon Kodu 
    $table->string('Aciklama')->nullable();
    $table->string('CariID')->nullable();		//Al-Sat yapmak için alınan mamul ise satıcının carisi seçilir
    $table->string('SaticiAdi')->nullable();
    $table->string('Mensei')->nullable();		//Mamulun üretim Yeri 	/Cagcelik/Saka/Kardemir
    $table->string('Grubu')->nullable();    		//Mamulun Grubu  /Hammadde/Kare/Lama/Kosebent/Hurda      
    $table->string('MamulTipi')->nullable();		//MaliyetMuhasebesi için /Uretim/TicariMamul  / Uretilen mamullerde şirket içi uretim maliyetleri hammadde maliyetine eklenir. Ticari mamullerde bu maliyet yoktur
    $table->string('UretimYeri')->nullable();		//Sıcak Hadde/ SogukCekme / Profil / Fason
    $table->softDeletes();
    $table->timestamps();
});
/*
---------------- Dip toplamda Döviz fiyatı ve Yerel ParaBirimi yan yana alanlarda görülmeli 

Mal Tutarı 
Iskonto Tutarı 
Teklif Altı iskonto tutarı 
OTV Tutari 
KDV Tutarı 
Yuvarlama 
Diğer Vergiler 
Genel Toplam 
Açıklama Alanı
Onay Durumu 





-----------Lotlara göre çıkış. ihracatta alınan tek bir sipariş 4-5 parçaya bölünerek lot lot farklı limanlara gönderilebiliyor. Veya farklı tarihlerde gönderilebiliyor.

*/

Schema::create('siparis03', function (Blueprint $table) {
    $table->bigIncrements('LOTID');
    $table->string('LotAdi')->nullable(); 
    $table->string('GemiAdi')->nullable();
    $table->string('LimanAdi')->nullable();
    $table->string('LotRengi')->nullable();
    $table->string('Aciklama')->nullable();
    $table->string('UrunID')->nullable();
    $table->string('UrunAdi')->nullable();
    $table->string('Kalitesi')->nullable();
    $table->string('Toleransi')->nullable();
    $table->string('ToleransTipi')->nullable(); 	// Gercek/Teorik 
    $table->string('Boyu')->nullable();
    $table->string('DepoKodu')->nullable();		// Girilen stok bilgisine göre hangi depoda ne kadar mamul olduğuna dair bir popup açılabilir ve hangi depodaki mamul satılmak isteniyorsa seçim yapılabilir. 
    $table->string('SiparisMiktarı')->nullable(); 
    $table->string('ReserveMiktari')->nullable(); 	// Stokdan reserve edilen miktar
    $table->string('TeslimMiktari')->nullable();	// Sevkiyatı yapılmış olan miktar
    $table->string('Birimi')->nullable();		// KG/ MT /AD/
    $table->string('SistemMiktari')->nullable(); 	// Gizli alan. Kullanıcı görmeyebilir. Ancak MT veya Adet satışı yapılsa bile sistem raporlamalar için KG bazında takip yapabilsin. 
    $table->string('HarBirimFiyati')->nullable();	// Dolar veya Euro satışlarında önemli
    $table->string('ParaBirimi')->nullable();		// TL/Dolar/Euro
    $table->string('Kur')->nullable(); 
    $table->string('YPBirimFiyatı')->nullable();	// Girilenkur * HareketBirimFiyati
    $table->softDeletes();
    $table->timestamps();
});



/*

StokID
StokKodu
StokAdi
StokAdi2
Kalitesi
Boyu
Toleransi
StokBirimi
UreticiKodu
MarkaKodu
GTIPNo
Grubu
Uretici
EmniyetStokMiktari
MinStokMiktari
MaxStokMiktari
OlcumFormulu
HacimOlcumFormulu
AgirlikOlcumFormulu
ABCKodu
En
Boy
Yukseklik
Cap
Agirlik
Dara
SatisFiyatGrubu
SatisIskontoGrubu
SatisBirimi 
ToleransOrani
SatisFazlaSevkOrani
SatisEksikSevkOrani
MinSiparisMiktari
MaxSiparisMiktari

SatinAlmafiyatGrubu
SatinalmaBirimi
SatinalmaFazlaSevkOrani
SatinalmaEksikSevkOrani
MinSatinalmaMiktari
MaxSatinalmaMiktari
SiparisPeriyodu
TeminSuresi
EmniyetTeminSuresi

UretimBirimi
UretimPeriyodu
EkonomikUretimMiktari
Verimlilik
uretimSuresi
UretimEmniyetSuresi





































public function up()
{
Schema::create('urun01', function (Blueprint $table) {
    $table->bigIncrements('id');
    $table->string('urunadi')->nullable();
    $table->string('urunadi_en')->nullable();
    $table->string('urunkodu')->nullable();
    $table->string('apikodu')->nullable();

    $table->string('grubu')->nullable();
    $table->string('kalite')->nullable();
    $table->string('tolerans')->nullable();
    $table->string('boy')->nullable();
    $table->string('tonaj')->nullable();

    $table->string('tonaj_siparis')->nullable();
    $table->string('tonaj_stok')->nullable();
    $table->string('tonaj_bloke')->nullable();
    $table->string('tonaj_uretim')->nullable();

    $table->string('terminsuresi')->nullable();
    $table->string('emniyetstok')->nullable();
    $table->string('maxsatis')->nullable();
    $table->string('minsatis')->nullable();
    $table->string('fiyat_grubu')->nullable();



    $table->string('ebata')->nullable();
    $table->string('ebatb')->nullable();
    $table->string('ebatc')->nullable();
    $table->string('ebatkg')->nullable();
    $table->string('hacim')->nullable();
    $table->string('cubuksayisi')->nullable();
    $table->softDeletes();
    $table->timestamps();

 

});
}




Ülkeler ve şehirler 


Tablo Yapısı

bkaymakci@soybas.com
7.03.2020 Cmt 23:23
Yunus selam ekte tablo hakkında çalışmalar var. Saygılarımla, Sami Soybaş Demir San. ve Tic. A. Ş. Bilal KAYMAKÇI Bilgi İşlem Uzmanı Sultan Orhan Mah. 1174/1 Sok. No:6 41400 Gebze / KOCAELİ 0262. 644 9666 0262. 644 9544 0530 916 4121 bkaymakci@soybas.com www.soybas.com

Gönderen, Güvenilir Gönderenler listenizde bulunmadığından bu iletideki içeriğin bir bölümü engellendi. bkaymakci@soybas.com adlı gönderenden gelen içeriğe güveniyorum. | Engellenmiş içeriği göster
bkaymakci@soybas.com
11.03.2020 Çar 12:53
Saygılarımla,



soybas35cm-01

          Sami Soybaş Demir San. ve Tic. A. Ş.





Bilal KAYMAKÇI

Bilgi İşlem Uzmanı







Sultan Orhan Mah. 1174/1 Sok. No:6

41400 Gebze / KOCAELİ



0262. 644 9666

İlgili resim

0262. 644 9544



0530  916 4121



bkaymakci@soybas.com



www.soybas.com

