@extends('layouts.app')
@section('breadcrumb')
	<div class="breadcrumb">
        <a href="{{ url('home') }}" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Ana Sayfa</a>
        <span class="breadcrumb-item active">Onay Yönetimi</span>
    </div>
@endsection
@section('content')

<!-- BEGIN FORM -->
@include('settings.depo.create')
@include('settings.depo.istif_ekle')
     <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#DepoEkleModal"><i class="icon-home7 "></i> Depo & İş Merkezi Tanımlama</button>
        <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#IstifEkleModal"><i class="icon-box-add"></i> İstif & İstasyon Tanımlama</button>
    <!-- Column selectors -->
   
    <div class="card">
    <div class="card-header header-elements-inline">
        <h5 class="card-title">DEPO VE İSTASYON TANIMLARI</h5>
        <div class="header-elements">
        <div class="list-icons">
            <a class="list-icons-item" data-action="collapse"></a>
        </div>
        </div>
    </div>
    <div class="card-body">


   

            <table class="table table-bordered table-hover myDataTable1">
            <thead>
            <tr>
                <th>#</th>
                <th>Depo Adı</th>
                <th>Kullanım Tipi</th>
                <th>Açıklama</th>
                <th>Kapasite</th>
                <th>Uzunluk</th>
                <th>Genişlik</th>
                <th>Yükseklik</th>
                <th>Sıra</th>

            </tr>
            </thead>
            <tbody>
                @foreach($depo01 as $row)
            <tr>
                <td>
                    <div class="btn-group btn-group-sm">
                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                            <i class="icon-menu7"></i>
                        </button>

                        <div class="dropdown-menu">
                            <button type="button" class="dropdown-item OnayEdit" id="{{ $row->id }}"><i class="icon-equalizer3"></i> Düzenle</button>
                            <div class="dropdown-divider"></div>
                            <button type="button" class="dropdown-item text-danger DepoDelete" id="{{ $row->id }}"><i class="icon-trash"></i> Sil</button>
                        </div>
                    </div>
                </td>
                <td>{{ $row->depoadi }}</td>
                <td>{{ $row->tipi }}</td>
                <td>{{ $row->aciklama }}</td>
                <td>{{ $row->kapasite }}</td>
                <td>{{ $row->uzunluk }}</td>
                <td>{{ $row->genislik }}</td>
                <td>{{ $row->yukseklik }}</td>
                <td>{{ $row->sira }}</td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    </div>
    <!-- /column selectors -->


<!--
_____________________________________________________________________________________________
Edit
_____________________________________________________________________________________________
-->
<script type="text/javascript">
    $(document).on('click', '.OnayEdit', function (e) {
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
                url       : "{{ url('settings/onay/edit') }}",
                data      : {"id":id},
                dataType  : "JSON",
            })
        .done(function(response) {
            
            $("#EditOnayResponse").html(response.EditOnay);
            $('#EditOnayModal').modal('show');

            })
        .fail(function(response) {

            console.log("Hata: ", response);

        });
        //return false;

    });
</script>
<!--
_____________________________________________________________________________________________
copy
_____________________________________________________________________________________________
-->
<script type="text/javascript">
    $(document).on('click', '.ParamCopy', function (e) {
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
                    url       : "{{ url('params/copy') }}",
                    data      : {"id":id},
                    dataType  : "JSON",
                })
            .done(function(response) {
                
                $("#copyParamResponse").html(response.copyparam);
                $('#CopyParamModal').modal('show');

                })
            .fail(function(response) {

                console.log("Hata: ", response);

                });
            //return false;

    });
</script>


<!--
_____________________________________________________________________________________________
Delete
_____________________________________________________________________________________________
-->
<script type="text/javascript">
$(document).on('click', '.DepoDelete', function(e){
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
            url       : "{{ url('settings/depo/delete') }}",
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
    })
});
</script>

@endsection