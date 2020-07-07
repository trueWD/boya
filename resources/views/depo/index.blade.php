@extends('layouts.app')
@section('breadcrumb')
	<div class="breadcrumb">
        <a href="{{ url('home') }}" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> ANA SAYFA</a>
        <span class="breadcrumb-item active">FASONDA ÜRETİLECEK SİPARİŞLER</span>
    </div>
@endsection
@section('content')
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

 <form id="SiparisGecForm">





<div class="card">
  <div class="card-header header-elements-inline">
    <h5 class="card-title">FASON DETARİK FORMU</h5>
    <div class="header-elements">
      <div class="list-icons">
        <a class="list-icons-item" data-action="collapse"></a>
        <a class="list-icons-item" data-action="reload"></a>
        <a class="list-icons-item" data-action="remove"></a>
      </div>
    </div>
  </div>

  <div class="card-body">
   
      <div class="row">
        <div class="col-md-4">
          <div class="form-group">
            <label>Tedarikçi Firma:</label>
            <select class="form-control" id="uretim_yeri" name="uretim_yeri">
                @foreach ($uretim_yeri as $row)
                    <option value="{{ $row->deger }}">{{ $row->aciklama }}</option>
                @endforeach
            </select>
          </div>
        </div>

        <div class="col-md-4">
          
          <label>Teslimat Tarihi:</label>
          <div class="input-group">
            <span class="input-group-prepend">
              <span class="input-group-text"><i class="icon-calendar"></i></span>
            </span>
             <input type="text" data-value="<?php echo date("Y-m-d",time()); ?>" name="uretim_teslim_tarihi" class="form-control uretim_teslim_tarihi">
          </div>
   
        </div>
        <div class="col-md-4">

          <label>Sipariş Ver:</label>
          <div class="input-group">
            <span class="input-group-prepend">
            </span>
           <div class="text-right">
        <button type="button" class="btn btn-primary SiparisGecSubmit"><i class="icon-cart-add2"></i> Tedarikçiye sipariş ver</button>
      </div>
          </div>

        </div>
      </div>



      

  </div>
</div>







    <!-- Task manager table -->
    <div class="card">
        <div class="card-header bg-transparent header-elements-inline">
            <h6 class="card-title">FASON TEDARİK LİSTESİ</h6>
            <div class="header-elements">
   
            </div>
        </div>

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
                      @if($urun->uretim_teslim_tarihi != '') 
                      <button type="button" class="btn btn-success TedarikSiparisIptal" id="{{ $urun->id }}"><i class="icon-enter3 mr-1"></i>Ürün Giriş</button>
                      @else
                        <input class="form-control btn-sm" type="checkbox" name="urunid[]" value="{{ $urun->id }}">
                      @endif
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
    <!-- /task manager table -->

    </form>

<script>
  $('#SiparisGecForm .uretim_teslim_tarihi').pickadate();
</script>
<script type="text/javascript">
    $(document).on('click', '.SiparisGecSubmit', function (e) {
        e.preventDefault();
        //var id = $(this).data('id');

            var data = $("#SiparisGecForm").serialize();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                });

            $.ajax({
                    method    : "POST",
                    url       : "{{ url('tedarik/create') }}",
                    data      : data,
                    dataType  : "JSON",
                })
            .done(function(response) {


                Swal.fire({
                  confirmButton: 'btn btn-success',
                    title: response.title,
                    text: response.text,
                    icon: response.type,
                    confirmButtonText: 'Tamam'
                  });

                    setTimeout(function(){// wait for 5 secs(2)
                           location.reload(); // then reload the page.(3)
                      }, 2000);
                

                })
            .fail(function(response) {

                console.log("Hata: ", response);

                });
            //return false;

    });
</script>

<script type="text/javascript">
$(document).on('click', '.TedarikSiparisIptal', function(e){
e.preventDefault();

  const swalWithBootstrapButtons = Swal.mixin({
      customClass: {
        confirmButton: 'btn btn-success',
        cancelButton: 'btn btn-danger',
      },
      buttonsStyling: false,
    })

    swalWithBootstrapButtons.fire({
      title: 'Dikkat!',
      text: "Bu ürünle ilgili siparişi iptal et",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Evet İptal Et!',
      cancelButtonText: 'Hayır!',
      reverseButtons: true
    }).then((result) => {
      if (result.value) {

    var id = $(this).attr("id");

    console.log(id);

    $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

    $.ajax({
            method    : "POST",
            url       : "{{ url('tedarik/SiparisIptal') }}",
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
                 if(response.type == 'success'){ // if true (1)
                      setTimeout(function(){// wait for 5 secs(2)
                           location.reload(); // then reload the page.(3)
                      }, 2000);
                   }
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
                    
                  title: 'HATA!',
                  text: 'Sistemsel bir hata oluştur lütfen logları inceleyin',
                  icon: 'error',
                  confirmButtonText: 'Tamam',
                  confirmButton: 'btn btn-success',
                });
          });

      }
    });
});
</script>

@endsection