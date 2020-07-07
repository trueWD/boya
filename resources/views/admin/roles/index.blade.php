@extends('layouts.app')
@section('breadcrumb')
	<div class="breadcrumb">
        <a href="{{ url('home') }}" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Ana Sayfa</a>
        <span class="breadcrumb-item active">Kullanıcı Rolleri Listesi</span>
    </div>
@endsection
@section('content')

<!-- BEGIN FORM -->
@include('admin.roles.create')
<div id="RoleEditResponse"></div>
<div class="row">
    <div class="col-md-5">



            <!-- Column selectors -->
    <div class="card">
        <div class="card-header header-elements-inline">
            <h5 class="card-title">KULLANICI ROLLERİ LİSTESİ</h5>
            <div class="header-elements">
                <div class="list-icons">
                    <a class="list-icons-item" data-action="collapse"></a>
                </div>
            </div>
        </div>

        <div class="card-body">

            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#NewRoleModal"><i class="icon-plus3"></i> Yeni Rol Ekle</button>

            <table class="table table-striped table-bordered table-hover table-sm myDataTable1">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Rol Adı</th>
                        <th>Kullanıcı</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($roles as $role)
                    <tr>
                        <td>
                            <div class="btn-group btn-group-sm">
                                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                                    <i class="icon-menu7"></i>
                                </button>

                                <div class="dropdown-menu">
                                    <button type="button" class="dropdown-item RolePermissionsButton" id="{{ $role->id }}"><i class="icon-file-eye"></i> Göster</button>
                                    <button type="button" class="dropdown-item RoleEdit" id="{{ $role->id }}"><i class="icon-equalizer3"></i> Düzenle</button>
                                    <div class="dropdown-divider"></div>
                                    <button type="button" class="dropdown-item text-danger RoleDelete" id="{{ $role->id }}"><i class="icon-trash"></i> Sil</button>
                                </div>
                            </div>
                        </td>
                        <td><button type="button" class="btn btn-link RolePermissionsButton" id="{{ $role->id }}">{{ $role->name }}</button> </td>
                        <td> <span class="badge badge-primary">22 Kişi</span></td>
                       
                    </tr>
                    @endforeach
                </tbody>
            </table>
            
        </div>
    </div>
    <!-- /column selectors -->    





    </div>
    <div class="col-md-7">
        <div id="RolePermissionsResponse">
            <!-- Column selectors -->
            <div class="card">
                <div class="card-header header-elements-inline">
                    <h5 class="card-title">ROLE AİT İZİNLER</h5>
                    <div class="header-elements">
                        <div class="list-icons">
                            <a class="list-icons-item" data-action="collapse"></a>
                        </div>
                    </div>
                </div>

                <div class="card-body">

                    <div class="alert bg-info text-white alert-styled-left alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert"><span>×</span></button>
                        <span class="font-weight-semibold">Uyarı!</span> Düzenlemek için bir rol seçiniz..</a>.
                    </div>
                    
                </div>
            </div>
            <!-- /column selectors -->
        </div>

        
    </div>
</div>




<script type="text/javascript">
    $(document).on('click', '.RoleEdit', function (e) {
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
                    url       : "{{ url('admin/roles/edit') }}",
                    data      : {"id":id},
                    dataType  : "JSON",
                })
            .done(function(response) {
                
                $("#RoleEditResponse").html(response.EditRole);
                $('#RoleEditModal').modal('show');

                })
            .fail(function(response) {

                console.log("Hata: ", response);

                });
            //return false;

    });
</script>
<script type="text/javascript">
    $(document).on('click', '.RolePermissionsButton', function (e) {
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
                    url       : "{{ url('admin/roles/show') }}",
                    data      : {"id":id},
                    dataType  : "JSON",
                })
            .done(function(response) {
                
                $("#RolePermissionsResponse").html(response.RolePermissions);

                })
            .fail(function(response) {

                console.log("Hata: ", response);

                });
            //return false;

    });
</script>




<script type="text/javascript">
$(document).on('click', '.RoleDelete', function(e){
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
            url       : "{{ url('admin/roles/destroy') }}",
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