@extends('layouts.app')
@section('breadcrumb')
	<div class="breadcrumb">
        <a href="{{ url('home') }}" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Ana Sayfa</a>
        <span class="breadcrumb-item active">Tüm İzinler Listesi</span>
    </div>
@endsection
@section('content')

<!-- BEGIN FORM -->
@include('admin.permissions.create')
<div id="PermissionsEditResponse"></div>

    <!-- Column selectors -->
    <div class="card">
        <div class="card-header header-elements-inline">
            <h5 class="card-title">TÜM İZİNLER LİSTESİ</h5>
            <div class="header-elements">
                <div class="list-icons">
                    <a class="list-icons-item" data-action="collapse"></a>
                </div>
            </div>
        </div>

        <div class="card-body">

            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#NewPermissionsModal"><i class="icon-plus3"></i> Yeni İzin Ekle</button>

            <table class="table table-striped table-bordered table-hover table-sm myDataTable1">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>İzin Adı</th>
                        <th>Açıklama</th>
                        <th>Ait Olduğu Roller</th>
                        <th>Kayıt Tarihi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($permissions as $key => $permission)
                    <tr>
                        <td>
                            <div class="btn-group btn-group-sm">
                                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                                    <i class="icon-menu7"></i>
                                </button>

                                <div class="dropdown-menu">
                                    <button type="button" class="dropdown-item text-primary PermissionsEdit" id="{{ $permission->id }}"><i class="icon-equalizer3"></i> Düzenle</button>
                                    <div class="dropdown-divider"></div>
                                    <button type="button" class="dropdown-item text-danger PermissionDelete" id="{{ $permission->id }}"><i class="icon-trash"></i> Sil</button>
                                </div>
                            </div>
                        </td>
                        <td>{{ $permission->name }}</td>
                        <td>{{ $permission->description }}</td>
                        <td>
                            @foreach($permission->permissions()->pluck('name') as $permission)
                                <span class="badge badge-info">{{ $permission }}</span>
                            @endforeach
                        </td>
                        <td>{{ $permission->created_at }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            
        </div>
    </div>
    <!-- /column selectors -->



<script type="text/javascript">
    $(document).on('click', '.PermissionsEdit', function (e) {
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
                    url       : "{{ url('admin/permissions/edit') }}",
                    data      : {"id":id},
                    dataType  : "JSON",
                })
            .done(function(response) {
                
                $("#PermissionsEditResponse").html(response.EditPermissions);
                $('#PermissionsEditModal').modal('show');

                })
            .fail(function(response) {

                console.log("Hata: ", response);

                });
            //return false;

    });
</script>



<script type="text/javascript">
$(document).on('click', '.PermissionDelete', function(e){
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
            url       : "{{ url('admin/permissions/destroy') }}",
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