<form id="EditOnayForm">
    <!-- Basic modal -->
    <div id="EditOnayModal" class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Düzenle: <span class="text-danger">{{ $onay->onayadi }}</span></h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">


                  <div class="form-group row">
                      <label for="model" class="col-sm-4 col-form-label">Tablo Adı</label>
                      <div class="col-sm-8">
                      <input type="text" name="model" value="{{ $onay->model }}" class="form-control" id="model" readonly>
                      </div>
                  </div>

                  <div class="form-group row">
                      <label for="anahtar" class="col-sm-4 col-form-label">Anahtar</label>
                      <div class="col-sm-8">
                      <input type="text" name="anahtar" value="{{ $onay->anahtar }}" class="form-control" id="anahtar" readonly>
                      </div>
                  </div>

                  <div class="form-group row">
                      <label for="onayadi" class="col-sm-4 col-form-label">Açıklama</label>
                      <div class="col-sm-8">
                        <textarea class="form-control" name="onayadi">{{ $onay->onayadi }}</textarea>
                      </div>
                  </div>

                  <div class="form-group row">
                      <label for="roleid" class="col-sm-4 col-form-label">Rol Yetkisi</label>
                      <div class="col-sm-8">
                        <select class="form-control" name="roleid">
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
        
                      </div>
                  </div>

                  <div class="form-group row">
                      <label for="sira" class="col-sm-4 col-form-label">Sıra</label>
                      <div class="col-sm-8">
                      <input type="text" name="sira" value="{{ $onay->sira }}" class="form-control" id="sira" placeholder="Sıra" autocomplete="off">
                      </div>
                  </div>



                </div>

                <div class="modal-footer">
                    <input type="hidden" name="id" value="{{ $onay->id }}">
                    <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                    <button type="button" class="btn bg-primary EditOnaySubmit">Kaydet</button>
                </div>
            </div>
        </div>
    </div>
    <!-- /basic modal -->
</form>

{!! JsValidator::formRequest('App\Http\Requests\Settings\EditOnayRequest', '#EditOnayForm'); !!}

<script type="text/javascript">
$(document).on('click', '.EditOnaySubmit', function(e){
e.preventDefault();

    if($("#EditOnayForm").valid())
      {
          var data = $("#EditOnayForm").serialize();

          $.ajaxSetup({
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
            });
          $.ajax({
                  method    : "POST",
                  url       : "{{ url('settings/onay/update') }}",
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

