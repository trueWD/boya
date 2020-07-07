<form id="RoleEditForm">
    <!-- Basic modal -->
    <div id="RoleEditModal" class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Rol Düzenle <span class="text-danger"> {{ $role->name }}</span></h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">

                  
                    <div class="form-group row">
                        <label for="name" class="col-sm-4 col-form-label">Rol Adı</label>
                        <div class="col-sm-8">
                        <input type="text" name="name" value="{{ $role->name }}" class="form-control" id="name" placeholder="name" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-sm-4 col-form-label">Aıklama</label>
                        <div class="col-sm-8">
                        <textarea class="form-control" name="description">{{ $role->description }}</textarea>
                        </div>
                    </div>



                </div>

                <div class="modal-footer">
                    <input type="hidden" name="id" value="{{ $role->id }}">
                    <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                    <button type="button" class="btn bg-primary RoleEditSubmit">Kaydet</button>
                </div>
            </div>
        </div>
    </div>
    <!-- /basic modal -->
</form>

{!! JsValidator::formRequest('App\Http\Requests\Admin\UpdateUsersRequest', '#RoleEditForm'); !!}

<script type="text/javascript">
$(document).on('click', '.RoleEditSubmit', function(e){
e.preventDefault();
    if($("#RoleEditForm").valid())
      {
          var data = $("#RoleEditForm").serialize();

          $.ajaxSetup({
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
            });
          $.ajax({
                  method    : "POST",
                  url       : "{{ url('admin/roles/update') }}",
                  data      : data,
                  dataType  : "JSON",
                  })
              .done(function(response) {  
                  console.log("Dönen Sonuç: ", response.responseJSON);
                  if(response.type == 'success'){
                    Swal.fire({
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
                          title: response.title,
                          text: response.text,
                          icon: response.type,
                          confirmButtonText: 'Tamam'
                        });

                    }
                  }).fail(function(response){
                    Swal.fire({
                        title: 'HATA!',
                        text: 'Logları inceleyin',
                        icon: 'error',
                        confirmButtonText: 'Tamam'
                      });
                });
      }
});
</script>

