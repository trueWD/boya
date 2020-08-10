

<?php
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

