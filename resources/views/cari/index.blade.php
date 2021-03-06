@extends('layouts.app')
@section('breadcrumb')
	<div class="breadcrumb">
        <a href="{{ url('home') }}" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Ana Sayfa</a>
        <span class="breadcrumb-item active">Cari Listesi</span>
    </div>
@endsection
@section('content')

<!-- BEGIN FORM -->
@include('cari.create')
<div id="CariEditResponse"></div>

    <!-- Column selectors -->
    <div class="card">
        <div class="card-header header-elements-inline">
            <h5 class="card-title">CARİ LİSTESİ</h5>
            <div class="header-elements">
                <div class="list-icons">
                    <a class="list-icons-item" data-action="collapse"></a>
                </div>
            </div>
        </div>

        <div class="card-body">

            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#YeniCariModal"><i class="icon-plus3"></i> Cari Ekle</button>

            <table class="table table-striped table-bordered table-hover table-sm myDataTable1">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>ID</th>
                        <th>Cari Adı</th>
                        <th>Bakiye</th>
                        <th>Vegi No</th>
                        <th>Vergi Dairesi</th>
                        <th>Ülke</th>
                        <th>Şehir</th>  
                        <th>Telefon</th>
                        <th>Cari Türü</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cariler as $cari)
                    <tr>
                        <td>
                            <div class="btn-group btn-group-sm">
                                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                                    <i class="icon-menu7"></i>
                                </button>

                                <div class="dropdown-menu">
                                    <a href="{{ url('cari/'.$cari->id) }}" class="dropdown-item"><i class="icon-file-eye"></i> Göster</a>
                                    <button type="button" class="dropdown-item CariEdit" id="{{ $cari->id }}"><i class="icon-equalizer3"></i> Düzenle</button>
                                    <div class="dropdown-divider"></div>
                                    <button type="button" class="dropdown-item text-danger CariDelete" id="{{ $cari->id }}"><i class="icon-trash"></i> Sil</button>
                                </div>
                            </div>
                        </td>
                        <td>{{ $cari->id }}</td>
                        <td>{{ $cari->cariadi }}</td>
                        <td>{{ para($cari->bakiye) }}</td>
                        <td>{{ $cari->vergino }}</td>
                        <td>{{ $cari->vergidairesi }}</td>
                        <td>{{ $cari->ulke }}</td>
                        <td>{{ $cari->sehir }}</td>
                        <td>{{ $cari->telefon }}</td>
                        <td>
                            @if( $cari->grubu == "TEDARIKCI") 
                                <span class="badge badge-primary">{{ $cari->grubu }}</span>
                            @elseif($cari->grubu == "MUSTERI")
                                <span class="badge badge-warning">{{ $cari->grubu }}</span>
                            @else
                                <span class="badge badge-success">{{ $cari->grubu }}</span>
                            @endif
                            
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            
        </div>
    </div>
    <!-- /column selectors -->

<script type="text/javascript">
    $(document).on('click', '.CariEdit', function (e) {
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
                    url       : "{{ url('cari/edit') }}",
                    data      : {"id":id},
                    dataType  : "JSON",
                })
            .done(function(response) {
                
                $("#CariEditResponse").html(response.cariedit);
                $('#CariEditModal').modal('show');

                })
            .fail(function(response) {

                console.log("Hata: ", response);

                });
            //return false;

    });
</script>

<script type="text/javascript">
$(document).on('click', '.CariDelete', function(e){
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
      text: "Bu kaydı silmek istediğinizden eminmisiniz?",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Evet Sil!',
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
            url       : "{{ url('cari/destroy') }}",
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