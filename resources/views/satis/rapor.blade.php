<hr>
<table class="table table-striped table-bordered table-hover table-sm SatisRaporuTable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Fiş No</th>
                        <th>Durumu</th>
                        <th>Ödeme Şekli</th>
                        <th>Müşteri</th>
                        <th>İskonto Tutarı</th>
                        <th>KDV Tutarı</th>
                        <th>Toplam Tutar</th>
                        <th>Tarih</th>
                        <th>Satış yapan</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $toplam_nakit       = 0;
                        $toplam_kart        = 0;
                        $toplam_veresiye    = 0;
                        $toplam_iade        = 0;
                    @endphp
                    @foreach($siparis01 as $row)

                    @php
                        if($row->odemetipi == 'NAKIT'){
                            $toplam_nakit       =  $toplam_nakit + $row->toplam_tutar;  
                        }
                        if($row->odemetipi == 'KART'){
                           $toplam_kart        =  $toplam_kart + $row->toplam_tutar; 
                        }
                       
                        if($row->odemetipi == 'VERESIYE'){
                           $toplam_veresiye    =  $toplam_veresiye + $row->toplam_tutar;
                        }
                        if($row->durumu == 'IADE'){
                           $toplam_iade    =  $toplam_iade + $row->toplam_tutar;
                        }
                       
                        
                        
                    @endphp
                    <tr  @if($row->durumu=='IADE') class="table-warning" @endif>
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

                        <td>
                            @if ($row->odemetipi == 'PROFORMA')
                                <span class="badge badge-flat border-primary text-primary">{{ $row->odemetipi }}</span>
                            @endif
                            @if ($row->odemetipi == 'NAKIT')
                                <span class="badge badge-flat border-success text-success">{{ $row->odemetipi }}</span>
                            @endif
                            @if ($row->odemetipi == 'KART')
                                <span class="badge badge-flat border-info text-info">{{ $row->odemetipi }}</span>
                            @endif
                            @if ($row->odemetipi == 'VERESIYE')
                                <span class="badge badge-flat border-warning text-warning">{{ $row->odemetipi }}</span>
                            @endif
                            @if($row->durumu=='IADE')
                                @if ($row->odemetipi == 'NAKIT')
                                    <span class="badge badge-flat border-pri text-warning">NAKIT ÖDENDİ</span>
                                @endif
                                @if ($row->odemetipi == 'HESAP')
                                    <span class="badge badge-flat border-warning text-warning">CARİ HESABA EKLENDİ</span>
                                @endif
                            @endif
                            
                            
                        </td>
                        
                        <td> @if(isset($row->cari)) {{ $row->cari->cariadi }}  @else PERKENDE SATIŞ @endif</td>
                        <td class="text-right">{{ para($row->toplam_iskonto) }} TL</td>
                        <td class="text-right">{{ para($row->toplam_kdv) }} TL</td>
                        <td class="text-right">{{ para($row->toplam_tutar) }} TL</td>
                        <td>{{ tarihSaat($row->created_at) }}</td>
                        <td>{{ $row->user->name }}</td>
               
                    </tr>
                    @endforeach
                </tbody>
            </table>

<div class="row">
<div class="col-md-6 col align-self-end">
    <table class="table table-bordered table-hover">
    <tbody>
        <tr>
            <td class="text-right">Toplam Nakit Satış</td>
            <td class="table-success text-right"><b>{{ para($toplam_nakit) }}</b></td>
        </tr>
        <tr>
            <td class="text-right">Toplam Kart Satış</td>
            <td class="table-info text-right"><b>{{ para($toplam_kart) }}</b></td>
        </tr>
        <tr>
            <td class="text-right">Toplam Veresiye</td>
            <td class="table-danger text-right"><b>{{ para($toplam_veresiye) }}</b></td>
        </tr>
        <tr>
            <td class="text-right">Toplam</td>
            <td class="table-danger text-right"><b>{{ para($toplam_nakit + $toplam_kart + $toplam_veresiye, 2)  }}</b></td>
        </tr>
        <tr>
            <td class="text-right">İade Toplamı</td>
            <td class="table-warning text-right"><b>{{ para($toplam_iade ,2)  }}</b></td>
        </tr>

    </tbody>
    </table>
</div>
</div>