       @if(count($odeme01)> 0)

           <table class="table table-striped table-bordered table-hover table-sm">
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
                @foreach($odeme01 as $row)
                @php
                    $genelToplam    = $genelToplam + $row->tutar;
                @endphp
                <tr>

                    
                    <td>
                        <button class="btn btn-danger btn-sm OdemeSilButton" id='{{ $row->id }}'><i class="icon-trash mr-1"></i> Sil</button>
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
                        @if($row->odemetipi=='SENET' OR $row->odemetipi=='CEK')
                        <span class="badge badge-flat border-danger text-danger">{{ $row->odemetipi }}</span>
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