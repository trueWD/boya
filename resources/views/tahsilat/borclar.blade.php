<div class="card">
    <div class="card-header bg-transparent border-bottom pb-0 pt-sm-0 header-elements-sm-inline">
        <div class="header-elements">
            <ul class="nav nav-tabs nav-tabs-highlight card-header-tabs">
                <li class="nav-item">
                    <a href="#urun-tab1" class="nav-link active" data-toggle="tab">
                        <i class="icon-cash3 mr-2"></i>
                        MÜŞTERİ BORCU
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#urun-tab2" class="nav-link" data-toggle="tab">
                        <i class="icon-credit-card mr-2"></i>
                        ÖDEME RAPORU
                    </a>
                </li>
            </ul>
        </div>
    </div>
    
    <div class="card-body tab-content">
        <div class="tab-pane fade show active" id="urun-tab1">

    

        <table class="table table-striped table-bordered table-hover myDataTable1">
            <thead>
                <tr>
 
                    <th>#</th>
                    <th>SİPARİŞ NO</th>
                    <th>ALIŞ TARİHİ</th>
                    <th>TUTAR</th>
                    <th>VADE TARİHİ</th>
                    <th>SÖZLEŞME</th>
                    <th>YETKİLİ</th>             
                </tr>
            </thead>
            <tbody>
                @php   
                    $genelToplam = 0;    
                @endphp
                @foreach($siparis01 as $row)
                @php
                    $genelToplam          = $genelToplam + $row->toplam_tutar;
                @endphp
                <tr>

                    
                    <td>
                        <button class="btn btn-success btn-sm BorcKapatButton"><i class="icon-printer mr-1"></i> ÖDE</button>
                    </td>
                    <td> 
                        <a href="{{ url('satis/'.$row->id) }}" target="_blank" class="dropdown-item">
                            <span class="badge badge-primary">{{ $row->id }}</span>
                        </a>
                    </td>
                    <td>{{ tarihSaat($row->ucreated_at) }}</td>
                    <td class="text-right">{{ para($row->toplam_tutar) }}</td>
                    <td>{{ tarihSaat($row->tarih_vade) }}</td>
                    <td>
                        @if($row->anlasma=='GUNCEL')
                            <span class="badge badge-flat border-primary text-primary">GÜNCEL FİYAT</span>
                        @endif
                        @if($row->anlasma=='SABIT')
                            <span class="badge badge-flat border-danger text-danger">SABİT FİYAT</span>
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
                  <td class="text-right">TOPLAM BORÇ</td>
                  <td class="table-primary text-right"><b>{{ para($genelToplam) }} TL</b></td>
                </tr>
                <tr>
                  <td class="text-right">BAKİYE</td>
                  <td class="table-success text-right"><b>{{ para($cari01->bakiye) }} TL</b></td>
                </tr>
                <tr>
                  <td class="text-right">KALAN BORÇ</td>
                  <td class="table-warning text-right"><b>{{ para($genelToplam - $cari01->bakiye) }} TL</b></td>
                </tr>
              </tbody>
            </table>
          </div>
     
        </div>



        </div>

        <div class="tab-pane fade" id="urun-tab2">
            This is the second card tab content
        </div>

    </div>
</div>

