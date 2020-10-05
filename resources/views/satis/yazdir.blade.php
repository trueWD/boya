@extends('layouts.print')
@section('content')
<script src="{{ url('global_assets/js/main/jquery.min.js') }}"></script>
<script src="{{ url('vendor/jquery-qrcode/jquery.qrcode.min.js')}}" type="text/javascript" ></script>


@if($siparis01->durumu =='AKTIF')

<div class="alert bg-warning alert-styled-left alert-dismissible">
    <button type="button" class="close" data-dismiss="alert"><span>×</span></button>
    <span class="font-weight-semibold">DİKKAT!</span> Durumu "AKTIF" olan bir fişi yazdırılamaz!..
</div>

@else

<div class="row">
    
    <div class="col-md-3">

         <img src="{{ url('print_logo.jpg') }}" style="width: 300px;" alt="Çağ Çelik Aş." class="img-thumbnail">
         <hr>
        <table class="table table-bordered table-sm">
          <tbody>
            <tr>
              <th scope="row">TARİH</th>
              <td>{{ tarihSaat($siparis01->created_at) }}</td>
            </tr>
            <tr>
              <th scope="row">FİŞ NO</th>
              <td>{{ $siparis01->id }}</td>
            </tr>
          </tbody>
        </table>

    </div>
    <div class="col-md-7">

      <h3 class="text-center">SATIŞ FORMU</h3>
      <hr>

        <table class="table table-bordered table-sm">
          <tbody>
              <tr>
              <th scope="row">MÜŞTERİ ADI</th>
              <td>PAŞA ÇELİK SAN.TİC.LTD.ŞTİ. </td>
            </tr>
            <tr>
              <th scope="row">MÜŞTERİ ADRESİ</th>
              <td></td>
            </tr>
            <tr>
              <th scope="row">TELEFON</th>
              <td></td>
            </tr>
          </tbody>
        </table>

    </div>
    <div class="col-md-2">
        <div id="qrcodeCanvas"></div>
    </div>
</div>



<div class="row">
    <div class="col-md-12">


        <table class="table table-bordered table-sm">
            <thead>
                <tr>
                    <th>BARKOD</th>
                    <th>ÜRÜN</th>
                    <th>M. ADET</th>
                    <th>FİYAT</th>
                    <th>TOPLAM</th>
                    <th>İSKONTO</th>
                    <th>KDV</th>
                    <th>G TOPLAM</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $kdvDahilToplam = 0;
                    $kdvMiktarToplam = 0;
                    $iskontoTutarToplam = 0;    
                    $araToplam = 0;    
                @endphp
                @foreach($siparis02 as $row)
                @php 
                    $toplam             = $row->fiyat * $row->miktar;
                    $iskontoTutar       = $toplam * ($row->iskonto / 100);
                    $iskontoluToplam    = $toplam - $iskontoTutar;
                    $kdvMiktar          = $iskontoluToplam * ($row->kdv / 100);
                    $kdvDahil           = $iskontoluToplam + $kdvMiktar;

                    $kdvDahilToplam     = $kdvDahilToplam + $kdvDahil;
                    $kdvMiktarToplam    = $kdvMiktarToplam + $kdvMiktar;
                    $iskontoTutarToplam = $iskontoTutarToplam + $iskontoTutar;
                    $araToplam          = $araToplam + $toplam;
                @endphp
                <tr>

                    <td>{{ $row->urunbilgisi->barkod }}</td>
                    <td>{{ $row->urunbilgisi->urunadi }}</td>
                    <td class="text-right">{{ para($row->miktar) }}</td>
                    <td class="text-right">{{ para($row->fiyat) }}</td>
                    <td class="text-right">{{ para($toplam) }}</td>
                    <td class="text-right">{{ para($iskontoluToplam) }} (%{{ $row->iskonto }})</td>
                    <td class="text-right">{{ para($kdvMiktar) }} (%{{ $row->kdv }})</td>
                    <td class="text-right">{{ para($kdvDahil) }}</td>


                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="row">
          <div class="col-md-6 col align-self-end">
            <table class="table table-bordered table-sm">
              <tbody>
                <tr>
                  <td class="text-right">Toplam Tutar</td>
                  <td class="table-primary text-right"><b>{{ para($araToplam) }} TL</b></td>
                </tr>
                <tr>
                  <td class="text-right">Toplam İskhtonto</td>
                  <td class="table-success text-right"><b>{{ para($iskontoTutarToplam) }} TL</b></td>
                </tr>
                <tr>
                  <td class="text-right">Toplam KDV</td>
                  <td class="table-warning text-right"><b>{{ para($kdvMiktarToplam) }} TL</b></td>
                </tr>
                <tr>
                  <td class="text-right">Genel Toplam</td>
                  <td class="table-danger text-right"><b>{{ para($kdvDahilToplam) }} TL</b></td>
                </tr>
              </tbody>
            </table>
          </div>
     
        </div>


    </div>
</div>

  <div class="row">
    <div class="col-4">
        <table class="table table-bordered">
            <thead>
                <tr>
                <th>TESLİM EDEN</th>
            </thead>
            <tbody>
                <tr>
                    <td>{{auth()->user()->name }}<br></td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="col-4 offset-4">
        <table class="table table-bordered">
            <thead>
                <tr>
                <th>TESLİM ALAN</th>
            </thead>
            <tbody>
            <tr>
                <td><p></p></td>
            </tr>
            </tbody>
        </table>
    </div>
  </div>







<script>	
	jQuery('#qrcodeCanvas').qrcode({
    width : 90,
    height: 90,
		text	: "{{ $siparis01->id }}"
	});	
</script>
@endif
@stop