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
                        <i class="icon-stats-growth mr-2"></i>
                        CARİ TAHSİLAT RAPORU
                    </a>
                </li>
            </ul>
        </div>
    </div>
    
    <div class="card-body tab-content">
        <div class="tab-pane fade show active" id="urun-tab1">

        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#YeniTahsilatModal"><i class="icon-plus3"></i> Tahsilat Ekle</button>
        <button type="button" class="btn btn-primary FiyatGuncelleButton" id="{{ $cari01->id }}"><i class="icon-loop"></i> Güncel Fiyatları Uygula</button>
        <hr>

        <table class="table table-striped table-bordered table-hover  table-sm">
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
                        <button class="btn btn-success btn-sm BorcKapatButton" id='{{ $row->id }}'><i class="icon-file-check mr-1"></i> Kapat</button>
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
                  <td class="table-warning text-right"><b>@if(para($genelToplam - $cari01->bakiye) > 0){{ para($genelToplam - $cari01->bakiye) }}@else 0 @endif TL</b></td>
                </tr>
              </tbody>
            </table>
          </div>
     
        </div>



        </div>

        <div class="tab-pane fade" id="urun-tab2">

            <table class="table table-striped table-bordered table-hover  table-sm">
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
                        <button class="btn btn-danger btn-sm TahsilatSilButton" id='{{ $row->id }}'><i class="icon-trash mr-1"></i> Sil</button>
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


        </div>

    </div>
</div>


<!-- 
___________________________________________________________________________________________________
Ürün SİLME
___________________________________________________________________________________________________
-->
<script>
    $(document).on('click', '.TahsilatSilButton', function(){

      const swalWithBootstrapButtons = Swal.mixin({
      customClass: {
        confirmButton: 'btn btn-success',
        cancelButton: 'btn btn-danger'
      },
      buttonsStyling: false,
    })

    swalWithBootstrapButtons.fire({
      title: 'Dikkat!',
      text: "Tahsilat silinsin mi?",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Evet, Sil',
      cancelButtonText: 'Hayır!',
      reverseButtons: true
    }).then((result) => {
      if (result.value) {

    var id = $(this).attr("id");

    $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

    $.ajax({
            method    : "POST",
            url       : "{{ url('tahsilat/TahsilatSil') }}",
            data      : {"id":id},
            dataType  : "JSON",
            })
        .done(function(response) {
            console.log("Dönen Sonuç: ", response.responseJSON);
            if(response.type == 'success'){

                Swal.fire({
                    confirmButton: 'btn btn-success',
                    title: response.title,
                    text: response.text,
                    icon: response.type,
                    confirmButtonText: 'Tamam'
                });
                 $("#BorcListesiResponse").html(response.BorcListesi);

              }else{

                Swal.fire({
                    confirmButton: 'btn btn-success',
                    title: response.title,
                    text: response.text,
                    icon: response.type,
                    confirmButtonText: 'Tamam'
                  });
              }
            }).fail(function(response){
              Swal.fire({
                  confirmButton: 'btn btn-success',
                  cancelButton: 'btn btn-danger',
                  title: 'HATA!',
                  text: 'Sistemsel bir hata oluştur lütfen logları inceleyin',
                  icon: 'error',
                  confirmButtonText: 'Tamam'
                });
          });

      }
    });
    return false;

    });
</script>
