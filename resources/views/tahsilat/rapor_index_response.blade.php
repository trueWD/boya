
 @if(count($tahsilat01)> 0)  

<table class="table table-striped table-bordered table-hover table-sm TahsilatRaporuTable">
    <thead>
        <tr>

            <th>#</th>
            <th>CARİ</th>
            <th>TARİH</th>
            <th>AÇIKLAMA</th>
            <th>ÖDEME TİPİ</th>
            <th>TUTAR</th>
            <th>YETKİLİ</th>
        </tr>
    </thead>
    <tbody>
        @php   
            $genelToplam = 0;    
        @endphp
        @foreach($tahsilat01 as $row)
        @php
            $genelToplam    = $genelToplam + $row->tutar;
        @endphp
        <tr>

            
            <td>
                <div class="btn-group btn-group-sm">
                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                        <i class="icon-menu7"></i>
                    </button>
                    <div class="dropdown-menu">
                        <a href="{{ url('tahsilat/TahsilatYazdir/'.$row->id) }}" target="_blank" class="dropdown-item"><i class="icon-printer"></i> Yazdır</a>
                        <div class="dropdown-divider"></div>
                        <button type="button" class="dropdown-item text-danger TahsilatSilButton" id="{{ $row->id }}"><i class="icon-bin"></i> Sil</button>
                    </div>
                </div>
            </td>
            <td> 
                {{ $row->cari->cariadi }}
            </td>
            <td>{{ tarihSaat($row->created_at) }}</td>
            <td>{{ $row->aciklama }}</td>
            <td>
                @if($row->odemetipi=='NAKIT')
                <span class="badge badge-flat border-success text-success">{{ $row->odemetipi }}</span>
                @endif
                @if($row->odemetipi=='KART')
                <span class="badge badge-flat border-primary text-primary">{{ $row->odemetipi }}</span>
                @endif
            </td>
            <td class="text-right"><b>{{ para($row->tutar) }} TL</b></td>
            <td>{{ $row->user->name }}</td>

        </tr>
        @endforeach
    </tbody>
</table>

@else

    <div class="alert alert-warning alert-styled-left alert-dismissible">
        <button type="button" class="close" data-dismiss="alert"><span>×</span></button>
        <span class="font-weight-semibold">BİLGİ!</span> Bu tarite hiç ödeme yok!..
    </div>

@endif