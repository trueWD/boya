@extends('layouts.app')
@section('breadcrumb')
	<div class="breadcrumb">
        <a href="{{ url('home') }}" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> ANA SAYFA</a>
        <span class="breadcrumb-item active">FASONDA ÜRETİLECEK SİPARİŞLER</span>
    </div>
@endsection
@section('content')

<div id="PiyasaEtiketResponse"></div>



<div class="card">
  <div class="card-header header-elements-inline">
    <h6 class="card-title">ETİKET İŞLEMLERİ</h6>
    <div class="header-elements">
      <div class="list-icons">
        <a class="list-icons-item" data-action="collapse"></a>
        <a class="list-icons-item" data-action="reload"></a>
        <a class="list-icons-item" data-action="remove"></a>
      </div>
    </div>
  </div>

  <div class="card-body">
    <ul class="nav nav-tabs nav-tabs-highlight">
      <li class="nav-item"><a href="#left-icon-tab1" class="nav-link active" data-toggle="tab"><i class="icon-folder-download mr-2"></i> İÇ PİYASA ETİKETLERi</a></li>
      <li class="nav-item"><a href="#left-icon-tab2" class="nav-link" data-toggle="tab"><i class="icon-folder-upload mr-2"></i> İHRACAT ETİKETLERİ</a></li>
      <li class="nav-item"><a href="#left-icon-tab3" class="nav-link" data-toggle="tab"><i class="icon-split mr-2"></i> FASON ETİKET</a></li>
      <li class="nav-item"><a href="#left-icon-tab4" class="nav-link" data-toggle="tab"><i class="icon-magic-wand2 mr-2"></i> ÖZEL ETİKET</a></li>
    </ul>

    <div class="tab-content">
      <!--
      _______________________________________________________________________________________________
      TAB 1
      _______________________________________________________________________________________________
      -->
      <div class="tab-pane fade show active" id="left-icon-tab1">
        
        <table class="table table-striped table-bordered table-hover table-sm myDataTable1">
          <thead>
              <tr>
                  <th>#</th>
                  <th>Dosya No</th>
                  <th>Termin</th>
                  <th>Etiket</th>
                  <th>Miktar</th>
                  <th>M.Üretilen</th>  
                  <th>Kalan</th>  
                  <th>Boy</th>
                  <th>Kalite</th>
                  <th>Tolreansi</th>
                  <th>Paket Tipi</th>  
                  <th>U. Tipi</th>
                  <th>TT</th>
              </tr>
          </thead>
          <tbody>

              @foreach($piyasa_siparisler as $urun)
              <tr @if($urun->uretim_teslim_tarihi != '') class="table-primary" @endif >
                  <td>
                    <button type="button" class="btn btn-success btn-sm  PiyasaEtiket" id="{{ $urun->id }}"><i class="icon-qrcode mr-1"></i>Etiket</button>
                  </td>
                  <td>{{ $urun->siparis01 }}</td>
                  <td>{{ tarih($urun->tarih_uretim) }}</td>
                  <td>{{ $urun->etiket }}</td>
                  <td class="table-primary">{{ number_format($urun->miktar) }}</td>
                  <td class="table-success">{{ number_format($urun->miktar_uretilen) }}</td>
                  <td class="table-danger">{{ number_format($urun->miktar - $urun->miktar_uretilen) }}</td>
                  <td>{{ $urun->boy }}</td>
                  <td>{{ $urun->kalite }}</td>
                  <td>{{ $urun->tolerans }}</td>
                  <td>{{ $urun->paket_tipi }}</td>
                  <td>{{ $urun->uretim_tipi }}</td>
                  <td>@if($urun->uretim_teslim_tarihi !=NULL){{ tarih($urun->uretim_teslim_tarihi) }}@endif</td>
              </tr>
              @endforeach

          </tbody>
        </table>


      </div>

      <!--
      _______________________________________________________________________________________________
      TAB 2
      _______________________________________________________________________________________________
      -->
      <div class="tab-pane fade" id="left-icon-tab2">
        İhracat
      </div>

      <!--
      _______________________________________________________________________________________________
      TAB 3
      _______________________________________________________________________________________________
      -->

      <div class="tab-pane fade" id="left-icon-tab3">
        

        <table class="table table-striped table-bordered table-hover table-sm tasks-list">
          <thead>
              <tr>
                  <th>#</th>
                  <th>Termin</th>
                  <th>Dosya No</th>
                  <th>Ürün Adı</th>
                  <th>Sipariş</th>  
                  <th>Teslim</th>  
                  <th>Paket Tipi</th>  
                  <th>Boy</th>
                  <th>Kalite</th>
                  <th>Tolreansi</th>
                  <th>U. Tipi</th>
                  <th>U. Yeri</th>
                  <th>TT</th>
              </tr>
          </thead>
          <tbody>

              @foreach($siparisler as $urun)
              <tr @if($urun->uretim_teslim_tarihi != '') class="table-primary" @endif >
                  <td>
                    <button type="button" class="btn btn-success TedarikSiparisIptal" id="{{ $urun->id }}"><i class="icon-qrcode mr-1"></i>Yazdır</button>
                  </td>
                  <td>{{ $urun->tarih_termin }}</td>
                  <td>{{ $urun->siparisid }}</td>
                  <td>{{ $urun->urunadi }}</td>
                  <td class="table-danger">{{ number_format($urun->miktar_siparis) }}</td>
                  <td class="table-success">{{ number_format($urun->miktar_siparis) }}</td>
                  <td>{{ $urun->paket_tipi }}</td>
                  <td>{{ $urun->boy }}</td>
                  <td>{{ $urun->kalite }}</td>
                  <td>{{ $urun->tolerans }}</td>
                  <td>{{ $urun->uretim_tipi }}</td>
                  <td>{{ $urun->uretim_yeri }}</td>
                  <td>@if($urun->uretim_teslim_tarihi !=NULL){{ tarih($urun->uretim_teslim_tarihi) }}@endif</td>
              </tr>
              @endforeach

          </tbody>
        </table>



      </div>


      <script>
        $(document).ready(function(){
        // Initialize data table
              $('.tasks-list').DataTable({
                  order: [[ 1, 'asc' ]],
                  dom: '<"datatable-header"fl><"datatable-scroll-lg"t><"datatable-footer"ip>',
                  language: {
                      search: '<span>Filter:</span> _INPUT_',
                      searchPlaceholder: 'Type to filter...',
                      lengthMenu: '<span>Show:</span> _MENU_',
                      paginate: { 'first': 'First', 'last': 'Last', 'next': $('html').attr('dir') == 'rtl' ? '&larr;' : '&rarr;', 'previous': $('html').attr('dir') == 'rtl' ? '&rarr;' : '&larr;' }
                  },
                  lengthMenu: [ 15, 25, 50, 75, 100 ],
                  displayLength: 100,
                  drawCallback: function (settings) {
                      var api = this.api();
                      var rows = api.rows({page:'current'}).nodes();
                      var last=null;
          
                      // Grouod rows
                      api.column(1, {page:'current'}).data().each(function (group, i) {
                          if (last !== group) {
                              $(rows).eq(i).before(
                                  '<tr class="table-active table-border-double"><td colspan="13" class="font-weight-semibold">'+group+'</td></tr>'
                              );
          
                              last = group;
                          }
                      });

                  }
              });
        });    
      </script>






      <div class="tab-pane fade" id="left-icon-tab4">
        Aliquip jean shorts ullamco ad vinyl cillum PBR. Homo nostrud organic, assumenda labore aesthet.
      </div>
    </div>
  </div>
</div>

<!--
_______________________________________________________________________________________________
Global - Etiket Oluştur
_______________________________________________________________________________________________
-->

<script type="text/javascript">
    $(document).on('click', '.PiyasaEtiket', function (e) {
        e.preventDefault();
        //var id = $(this).data('id');

            var id = $(this).attr("id");

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                });

            $.ajax({
                    method    : "POST",
                    url       : "{{ url('depo/etiket/PiyasaEtiket') }}",
                    data      : {"id":id},
                    dataType  : "JSON",
                })
            .done(function(response) {
                
                $("#PiyasaEtiketResponse").html(response.PiyasaEtiket);
                $('#PiyasaEtiketModal').modal('show');

                })
            .fail(function(response) {

                console.log("Hata: ", response);

                });
            //return false;

    });
</script>



@endsection