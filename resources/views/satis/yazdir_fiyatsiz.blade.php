@extends('layouts.print')
@section('content')

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


body {color:black;}

table, th, td{
  font-family: Tahoma,Verdana,Segoe,sans-serif;
  color: black;
}

</style>

<div class="row">
    
    <div class="col-md-12 genislik">
          <p><img src="{{ asset('logo.png') }}" class="img-thumbnail"></p>
         <hr>
        <table class="table table-bordered table-sm">
          <tbody>
            <tr>
              <th scope="row">CARİ</th>
              <td>{{ $siparis01->cari->cariadi }}</td>
            </tr>
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
                    <td class="text-right"><b>{{ para($row->miktar) }}</b></td>

                </tr>
                @endforeach
            </tbody>
        </table>



          <div class="col-md-12">
            <p class="altmetin"><b>***BU FİŞİN MALİ DEĞERİ YOKTUR!***</b></p> 
          </div>
          <hr>
          <div class="col-md-12">
            @foreach ($siparis01->notlar as $item)
              <span><b>NOT:</b> {{ $item->not }} </span>  
              <hr>
            @endforeach
          </div>

         
     
        </div>


    </div>
 

</div>
<div class="SayfalaraBol"></div>
</div>
@endif
@stop