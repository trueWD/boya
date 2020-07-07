@extends('layouts.app')
@section('breadcrumb')
	<div class="breadcrumb">
        <a href="{{ url('home') }}" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Ana Sayfa</a>
        <span class="breadcrumb-item active">Parametre Listesi</span>
    </div>
@endsection
@section('content')

<!-- BEGIN FORM -->
<div id="copyParamResponse"></div>
<div id="editParamResponse"></div>

    <!-- Column selectors -->
   
    @foreach($params as $key => $value)
    <div class="card">
    <div class="card-header header-elements-inline">
        <h5 class="card-title"><span class="text-primary">{{ $key }}</span> Parametre Anahtarı</h5>
        <div class="header-elements">
        <div class="list-icons">
            <a class="list-icons-item" data-action="collapse"></a>
        </div>
        </div>
    </div>
    <div class="card-body">


        <div class="card">
        <table class="table table-bordered table-hover table-sm">
            <thead>
            <tr>
                <th>#</th>
                <th>DB Table</th>
                <th>Kolon</th>
                <th>Değer</th>
                <th>Açıklama</th>
                <th>Sıra</th>
            </tr>
            </thead>
            <tbody>
                @foreach($value as $param)
            <tr>
                <td>
                    <div class="btn-group btn-group-sm">
                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                            <i class="icon-menu7"></i>
                        </button>

                        <div class="dropdown-menu">
                            <button type="button" class="dropdown-item ParamCopy" id="{{ $param->id }}"><i class="icon-copy4"></i> Kopyala</button>
                            <button type="button" class="dropdown-item ParamEdit" id="{{ $param->id }}"><i class="icon-equalizer3"></i> Düzenle</button>
                            <div class="dropdown-divider"></div>
                            <button type="button" class="dropdown-item text-danger ParamsDelete" id="{{ $param->id }}"><i class="icon-trash"></i> Sil</button>
                        </div>
                    </div>
                </td>
                <td>{{ $param->database }}</td>
                <td>{{ $param->alan }}</td>
                <td>{{ $param->deger }}</td>
                <td>{{ $param->aciklama }}</td>
                <td>{{ $param->sira }}</td>
            </tr>
            @endforeach
            </tbody>
        </table>
        </div>
    </div>
    </div>
    @endforeach
    <!-- /column selectors -->



<script type="text/javascript">
    $(document).on('click', '.ParamEdit', function (e) {
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
                    url       : "{{ url('params/edit') }}",
                    data      : {"id":id},
                    dataType  : "JSON",
                })
            .done(function(response) {
                
                $("#editParamResponse").html(response.editparams);
                $('#EditParamModal').modal('show');

                })
            .fail(function(response) {

                console.log("Hata: ", response);

                });
            //return false;

    });
</script>
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



<script type="text/javascript">
$(document).on('click', '.ParamsDelete', function(e){
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
            url       : "{{ url('params/destroy') }}",
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
    return false;
});
</script>

@endsection