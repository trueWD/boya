@extends('layouts.print')
@section('content')
<script src="{{ url('global_assets/js/main/jquery.min.js') }}"></script>
<script src="{{ url('vendor/jquery-qrcode/jquery.qrcode.min.js')}}" type="text/javascript" ></script>

<div class="container-fluid">
@if($siparis01->durumu =='AKTIF')

<div class="alert bg-warning alert-styled-left alert-dismissible">
    <button type="button" class="close" data-dismiss="alert"><span>×</span></button>
    <span class="font-weight-semibold">DİKKAT!</span> Durumu "AKTIF" olan bir fişi yazdırılamaz!..
</div>

@else

<style>
.logo{
  font-size: 45px;
}

.genislik{
  max-width: 382px;
  min-width: 383px;
}

.altmetin{
  font-size: 8px;
  text-align: center;
}

@media print {
  .SayfalaraBol{
      page-break-after: always;
    }
}


</style>

<div class="row">
    
    <div class="col-md-12 genislik">

         <p class="logo text-center">ABAYLI YAPI</p>
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
</div>



<div class="row">
    <div class="col-md-12 genislik">


        <table class="table table-bordered table-sm">
            <thead>
                <tr>
                    <th>ÜRÜN</th>
                    <th>ADET</th>
                    <th>FİYAT</th>
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

                    <td>{{ $row->urunbilgisi->urunadi }}</td>
                    <td class="text-right">{{ para($row->miktar) }}</td>
                    <td class="text-right">{{ para($row->fiyat) }}</td>

                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="row">
          <div class="col-md-12 col align-self-end genislik">
            <table class="table table-bordered table-sm">
              <tbody>
                <tr>
                  <td class="text-right">Toplam Tutar</td>
                  <td class="table-primary text-right"><b>{{ para($araToplam) }} TL</b></td>
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

          <div class="col-md-12">
            <p class="altmetin"><b>***BU FİŞİN MALİ DEĞERİ YOKTUR!***</b></p> 
          </div>

         
     
        </div>


    </div>
 

</div>
<div class="SayfalaraBol"></div>
</div>
@endif
@stop