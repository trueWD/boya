@extends('layouts.app')
@section('breadcrumb')
	<div class="breadcrumb">
        <a href="{{ url('home') }}" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Ana Sayfa</a>
        <span class="breadcrumb-item active">Cari Listesi</span>
    </div>
@endsection
@section('content')

<!-- BEGIN FORM -->
@include('banka.create')
<div id="CariEditResponse"></div>

    <!-- Column selectors -->
    <div class="card">
        <div class="card-header header-elements-inline">
            <h5 class="card-title">BANKA LİSTESİ</h5>
            <div class="header-elements">
                <div class="list-icons">
                    <a class="list-icons-item" data-action="collapse"></a>
                </div>
            </div>
        </div>

        <div class="card-body">

            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#YeniHesapModal"><i class="icon-plus3"></i> Banka Ekle</button>

            <table class="table table-striped table-bordered table-hover table-sm myDataTable1">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>ID</th>
                        <th>BANKA ADI</th>
                        <th>ŞUBE</th>
                        <th>ŞUBE KODU</th>
                        <th>IBAN</th>
                        <th>HESAP NO</th>
                        <th>BAKİYE</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($banka01 as $row)
                    <tr>
                        <td>
                            <button type="button" class="btn btn-danger btn-sm BankaDelete" id="{{ $row->id }}"><i class="icon-trash"></i> Sil</button>
                        </td>
                        <td>{{ $row->id }}</td>
                        <td>{{ $row->adi }}</td>
                        <td>{{ $row->sube }}</td>
                        <td>{{ $row->subekodu }}</td>
                        <td>{{ $row->iban }}</td>
                        <td>{{ $row->hesap }}</td>
                        <td>{{ para($row->bakiye) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            
        </div>
    </div>
    <!-- /column selectors -->

<script type="text/javascript">
$(document).on('click', '.BankaDelete', function(e){
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
            url       : "{{ url('banka/destroy') }}",
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