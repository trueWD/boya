   @if(count($urunler) !=0)
        <button type="button" class="btn btn-primary FaturaKapat" id="{{ $fatura->id }}"><i class="icon-plus3"></i> Faturayı Kapat</button>
    @endif
    <hr>

<table class="table table-striped table-bordered table-hover table-sm">
    <thead>
        <tr>
            <th>#</th>
            <th>Ürün Adı</th>   
            <th>Miktar</th>   
            <th>Fiyat</th>
            <th>Ara Toplam</th>
            <th>KDV</th>
            <th>KDV Tutar</th>
            <th>Toplam</th>
        </tr>
    </thead>
    <tbody>
        @php
            $kdv_genel_toplam = 0;
            $kdv_dahil_genel_toplam  = 0;
            $tutar_toplam  = 0;
        @endphp
        @foreach($urunler as $row)
        <tr>
            <td>


                <div class="dropdown">
                    <a href="#" class="badge dropdown-toggle badge-primary badge-icon " data-toggle="dropdown"><i class="icon-menu7"></i></a>

                    <div class="dropdown-menu dropdown-menu-left">

                    <a href="#" class="dropdown-item UrunEdit" id="{{ $row->id }}">
                        <span class="badge badge-mark mr-2 border-primary"></span>
                    Ürünü Düzenle
                    </a>
                    <a href="#" class="dropdown-item UrunDelete" id="{{ $row->id }}">
                        <span class="badge badge-mark mr-2 border-primary"></span>
                    Ürünü Sil
                    </a>

                    </div>
                </div>



            </td>
            <td>{{ $row->urun->urunadi }}</td>
            <td>{{ para($row->miktar) }}</td>
            <td>{{ para($row->fiyat) }} TL</td>
            <td>{{ para($row->tutar) }}</td>
            <td>{{ para($row->kdv) }}</td>
            <td>{{ para($row->kdv_tutar) }}</td>
            <td>{{ para($row->kdv_dahil) }}</td>
        </tr>

        @php
            $kdv_genel_toplam = $kdv_genel_toplam + $row->kdv_tutar;
            $kdv_dahil_genel_toplam = $kdv_dahil_genel_toplam + $row->kdv_dahil;
            $tutar_toplam = $tutar_toplam + $row->tutar;
        @endphp
        @endforeach
    </tbody>
</table>

<hr>

    <div class="row">
    <div class="col-md-6 col align-self-end">
    <table class="table table-bordered table-hover">
        <tbody>
        <tr>
            <td class="text-right">TOPLAM</td>
            <td class="table-success text-right"><b>{{ para($tutar_toplam) }}</b> TL</td>
        </tr>
        <tr>
            <td class="text-right">KDV</td>
            <td class="table-success text-right"><b>{{ para($kdv_genel_toplam) }}</b> TL</td>
        </tr>
        <tr>
            <td class="text-right">GENEL TOPLAM</td>
            <td class="table-danger text-right"><b>{{ para($kdv_dahil_genel_toplam) }}</b> TL</td>
        </tr>
        </tbody>
    </table>
    </div>
</div>