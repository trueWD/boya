@extends('layouts.print')
@section('content')

<div class="container-fluid">

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
         <div class=" text-center">
        <h3>TAHSİLAT FİŞİ</h3>
        </div>
        <table class="table table-bordered table-sm">
          <tbody>
            <tr>
              <th scope="row">CARİ</th>
              <td>{{ $tahsilat->cari->cariadi }}</td>
            </tr>
            <tr>
              <th scope="row">TARİH</th>
              <td>{{ tarihSaat($tahsilat->created_at) }}</td>
            </tr>
            <tr>
              <th scope="row">TAHSİLAT NO</th>
              <td>{{ $tahsilat->id }}</td>
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
                    <th>ÖDEME TİPİ</th>
                    <th>TUTAR</th>
                </tr>
            </thead>
            <tbody>
                <tr>

                    <td>{{ $tahsilat->odemetipi }}</td>
                    <td class="text-right"><b>{{ para($tahsilat->tutar) }}</b></td>
                </tr>

            </tbody>
        </table>



          <div class="col-md-12">
            <p class="altmetin"><b>***BU FİŞİN MALİ DEĞERİ YOKTUR!***</b></p> 
          </div>
          <hr>
          @if($tahsilat->aciklama != NULL)
          <div class="col-md-12">
              <span><b>NOT:</b> {{ $tahsilat->aciklama }} </span>  
          </div>
          @endif

         
     
        </div>


    </div>
 

</div>
<div class="SayfalaraBol"></div>
</div>
@stop