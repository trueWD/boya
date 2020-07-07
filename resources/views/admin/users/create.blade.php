<form id="YeniKullaniciForm">
    <!-- Basic modal -->
    <div id="YeniKullaniciModal" class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Yeni Kullanıcı Ekleme</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">


                    <div class="form-group row">
                        <label for="email" class="col-sm-4 col-form-label">Email</label>
                        <div class="col-sm-8">
                        <input type="text" name="email" class="form-control" id="email" placeholder="Email" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="name" class="col-sm-4 col-form-label">name</label>
                        <div class="col-sm-8">
                        <input type="text" name="name" class="form-control" id="name" placeholder="name" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="password" class="col-sm-4 col-form-label">password</label>
                        <div class="col-sm-8">
                        <input type="password" name="password" class="form-control" id="password" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="roles" class="col-sm-4 col-form-label">Kullanıcı Rolü</label>
                        <div class="col-sm-8">
                           <select multiple class="form-control" name="roles[]" id="roles">
                              @foreach($roles as $id => $roles)
                               <option value="{{ $id }}" {{ (in_array($id, old('roles', [])) || isset($user) && $user->roles->contains($id)) ? 'selected' : '' }}>{{ $roles }}</option>
                               @endforeach 
                          </select>
                        </div>
                    </div>


                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                    <button type="button" class="btn bg-primary YeniKullaniciSubmit">Kaydet</button>
                </div>
            </div>
        </div>
    </div>
    <!-- /basic modal -->
</form>

{!! JsValidator::formRequest('App\Http\Requests\Admin\StoreUsersRequest', '#YeniKullaniciForm'); !!}

<script type="text/javascript">
$(document).on('click', '.YeniKullaniciSubmit', function(e){
e.preventDefault();

    if($("#YeniKullaniciForm").valid())
      {
          var data = $("#YeniKullaniciForm").serialize();

          $.ajaxSetup({
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
            });
          $.ajax({
                  method    : "POST",
                  url       : "{{ url('admin/users') }}",
                  data      : data,
                  dataType  : "JSON",
                  })
              .done(function(response) {  
                  console.log("Dönen Sonuç: ", response.responseJSON);
                  if(response.type == 'success'){
                    Swal.fire({
                          title: response.title,
                          text: response.text,
                          type: response.type,
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
                          type: response.type,
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

