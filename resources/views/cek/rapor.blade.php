@if(count($odeme01)> 0)

<table class="table table-striped table-bordered table-hover table-sm">
    <thead>
        <tr>

            <th>#</th>
            <th>CARİ</th>
            <th>VARDE TARİHİ</th>
            <th>ÖDEME TARİHİ</th>
            <th>AÇIKLAMA</th>
            <th>ÖDEME TİPİ</th>
            <th>TUTAR</th>
            <th>DURUMU</th>
            <th>YETKİLİ</th>
        </tr>
    </thead>
    <tbody>
        @php   
            $toplamCek = 0;    
            $toplamSenet = 0;    
        @endphp
        @foreach($odeme01 as $row)
        @php
            if($row->odemetipi=='CEK'){
                $toplamCek      = $toplamCek + $row->tutar;
            }
            if($row->odemetipi=='SENET'){
                $toplamSenet    = $toplamSenet + $row->tutar;
            }
        @endphp
        <tr class="
          @if ($row->tarih_vade <= date('Y-m-d')  AND ($row->tarih_odeme == NULL)) table-danger
          @elseif ($row->tarih_odeme != NULL) table-success
          @else

          @endif">

            
            <td>
                <div class="btn-group btn-group-sm">
                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                        <i class="icon-menu7"></i>
                    </button>
                    
                    <div class="dropdown-menu">
                        
                        @if($row->tarih_odeme == NULL)
                        <button type="button" class="dropdown-item CekOdemButton" id="{{ $row->id }}"><i class="icon-checkmark4"></i> Çek-Senet Öde</button>
                        @endif
                        @if($row->tarih_odeme == NULL) 
                        <button type="button" class="dropdown-item text-danger OdemeSilButton" id="{{ $row->id }}"><i class="icon-trash"></i> Sil</button>
                        @endif
                    </div>
                </div>
            </td>
            <td> 
                {{ $row->cari->cariadi }}
            </td>
            <td>{{ tarihSaat($row->tarih_vade) }}</td>
            <td>@if($row->tarih_odeme != NULL){{ tarihSaat($row->tarih_odeme) }} @endif</td>
            <td>{{ $row->aciklama }}</td>
            <td>
                @if($row->odemetipi=='NAKIT')
                <span class="badge badge-flat border-success text-success">{{ $row->odemetipi }}</span>
                @endif
                @if($row->odemetipi=='KART')
                <span class="badge badge-flat border-primary text-primary">{{ $row->odemetipi }}</span>
                @endif
                @if($row->odemetipi=='SENET' OR $row->odemetipi=='CEK')
                <span class="badge badge-flat border-danger text-danger">{{ $row->odemetipi }}</span>
                @endif
            </td>
            <td class="text-right"><b>{{ para($row->tutar) }} TL</b></td>
            <td class="text-center">
                @if ($row->tarih_vade <= date('Y-m-d')  AND ($row->tarih_odeme == NULL))
                    <span class="badge badge-danger">GECİKMİŞ</span>
                @elseif ($row->tarih_odeme != NULL)
                    <span class="badge badge-success">ÖDENDİ</span>
                @else
                    <span class="badge badge-primary">BEKLEMEDE</span>
                @endif
            </td>
            <td>{{ $row->user->name }}</td>

        </tr>
        @endforeach
    </tbody>
</table>

<hr>
<div class="row">
    <div class="col-md-6 col align-self-end">
    <table class="table table-bordered table-hover">
        <tbody>
        <tr>
            <td class="text-right">ÇEK TOPLAMI</td>
            <td class="table-primary text-right"><b>{{ para($toplamCek) }} TL</b></td>
        </tr>
        <tr>
            <td class="text-right">SENET TOPLAMI</td>
            <td class="table-success text-right"><b>{{ para($toplamSenet) }} TL</b></td>
        </tr>
        <tr>
            <td class="text-right">TOPLAM</td>
            <td class="table-warning text-right"><b>{{ para($toplamCek + $toplamSenet) }} TL</b></td>
        </tr>
        </tbody>
    </table>
    </div>
</div>


@else

    <div class="alert alert-warning alert-styled-left alert-dismissible">
        <button type="button" class="close" data-dismiss="alert"><span>×</span></button>
        <span class="font-weight-semibold">BİLGİ!</span> Bu tarite hiç ödeme yok!..
    </div>

@endif