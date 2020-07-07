<form id="NewPermissionForm">
    <!-- Basic modal -->
    <div id="NewPermissionsModal" class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Yeni İzin Ekleme</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">


               
                    <div class="form-group row">
                        <label for="name" class="col-sm-4 col-form-label">İzin Adı</label>
                        <div class="col-sm-8">
                        <input type="text" name="name" class="form-control" id="name" placeholder="İzin Adı" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="password" class="col-sm-4 col-form-label">Açıklama</label>
                        <div class="col-sm-8">
                          <textarea class="form-control" name="description"></textarea>
                        </div>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                    <button type="button" class="btn bg-primary NewPermissionSubmit">Kaydet</button>
                </div>
            </div>
        </div>
    </div>
    <!-- /basic modal -->
</form>

{!! JsValidator::formRequest('App\Http\Requests\Admin\StoreRolesRequest', '#NewPermissionForm'); !!}

<script type="text/javascript">
$(document).on('click', '.NewPermissionSubmit', function(e){
e.preventDefault();
    if($("#NewPermissionForm").valid())
      {
          var data = $("#NewPermissionForm").serialize();

          $.ajaxSetup({
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
            });
          $.ajax({
                  method    : "POST",
                  url       : "{{ url('admin/permissions') }}",
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

