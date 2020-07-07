<form id="CopyParamForm">
    <!-- Basic modal -->
    <div id="CopyParamModal" class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Parametre Kopyala</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">


                  <div class="form-group row">
                      <label for="database" class="col-sm-4 col-form-label">Tablo Adı</label>
                      <div class="col-sm-8">
                      <input type="text" name="database" value="{{ $param->database }}" class="form-control" id="database" readonly>
                      </div>
                  </div>

                  <div class="form-group row">
                      <label for="alan" class="col-sm-4 col-form-label">Sütün</label>
                      <div class="col-sm-8">
                      <input type="text" name="alan" value="{{ $param->alan }}" class="form-control" id="alan" readonly>
                      </div>
                  </div>

                  <div class="form-group row">
                      <label for="deger" class="col-sm-4 col-form-label">Değer</label>
                      <div class="col-sm-8">
                      <input type="text" name="deger" value="{{ $param->deger }}" class="form-control" id="deger" placeholder="Değer" autocomplete="off">
                      </div>
                  </div>

                  <div class="form-group row">
                      <label for="sira" class="col-sm-4 col-form-label">Sıra</label>
                      <div class="col-sm-8">
                      <input type="text" name="sira" value="{{ $param->sira }}" class="form-control" id="sira" placeholder="Sıra" autocomplete="off">
                      </div>
                  </div>

                  <div class="form-group row">
                      <label for="sira" class="col-sm-4 col-form-label">Açıklama</label>
                      <div class="col-sm-8">
                      <textarea class="form-control" name="aciklama">{{ $param->aciklama }}</textarea>
                      </div>
                  </div>





                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                    <button type="button" class="btn bg-primary CopyParamSubmit">Kaydet</button>
                </div>
            </div>
        </div>
    </div>
    <!-- /basic modal -->
</form>

{!! JsValidator::formRequest('App\Http\Requests\Params\StoreParamRequest', '#CopyParamForm'); !!}

<script type="text/javascript">
$(document).on('click', '.CopyParamSubmit', function(e){
e.preventDefault();
    if($("#CopyParamForm").valid())
      {
          var data = $("#CopyParamForm").serialize();

          $.ajaxSetup({
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
            });
          $.ajax({
                  method    : "POST",
                  url       : "{{ url('params') }}",
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

