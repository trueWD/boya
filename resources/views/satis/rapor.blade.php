
<table class="table table-striped table-bordered table-hover table-sm SatisRaporuTable">
    <thead>
        <tr>
            <th>#</th>
            <th>Fiş No</th>
            <th>Durumu</th>
            <th>Müşteri</th>
            <th>İskonto Tutarı</th>
            <th>KDV Tutarı</th>
            <th>Toplam Tutar</th>
            <th>Ödeme Şekli</th>
            <th>Tarih</th>
            <th>Satış yapan</th>
        </tr>
    </thead>
    <tbody>
        @foreach($siparis01 as $row)
        <tr>
            <td>
                
                <div class="btn-group btn-group-sm">
                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                        <i class="icon-menu7"></i>
                    </button>

                    <div class="dropdown-menu">
                        <a href="{{ url('satis/'.$row->id) }}" class="dropdown-item"><i class="icon-file-eye"></i> Göster</a>
                        
                        @if($row->durumu=='TAMAM')
                        <a href="{{ url('satis/FisYazdir/'.$row->id) }}" target="_blank" class="dropdown-item"><i class="icon-printer"></i> Yazdır</a>
                        @endif
                        @if($row->durumu=='AKTIF')
                        <div class="dropdown-divider"></div>
                        <button type="button" class="dropdown-item text-danger FisIptalButton" id="{{ $row->id }}"><i class="icon-trash"></i> Sil</button>
                        @endif
                        
                        
                    </div>
                </div>
            </td>
            <td><a href="{{ url('satis/'.$row->id) }}">{{ $row->id }}</a></td>
            <td>
                <a href="{{ url('satis/'.$row->id) }}">
                @if( $row->durumu == "AKTIF") 
                    <span class="badge badge-primary">{{ $row->durumu }}</span>
                @elseif($row->durumu == "IPTAL")
                    <span class="badge badge-warning">{{ $row->durumu }}</span>
                @else
                    <span class="badge badge-success">{{ $row->durumu }}</span>
                @endif
                </a>
            </td>
            
            <td> @if(isset($row->cari)) {{ $row->cari->cariadi }}  @else PERKENDE SATIŞ @endif</td>
            <td class="text-right">{{ para($row->toplam_iskonto) }} TL</td>
            <td class="text-right">{{ para($row->toplam_kdv) }} TL</td>
            <td class="text-right">{{ para($row->toplam_tutar) }} TL</td>
            <td>{{ $row->odemetipi }}</td>
            <td>{{ tarihSaat($row->created_at) }}</td>
            <td>{{ $row->user->name }}</td>
    
        </tr>
        @endforeach
    </tbody>
</table>

