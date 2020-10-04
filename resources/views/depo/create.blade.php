  <form role="form" id="YeniDepoForm">
    <!-- Basic modal -->
    <div id="YeniDepoModal" class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">YENİ DEPO-ŞUBE EKLEME EKRANı</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">



                    <div class="form-group row">
                      <label for="depoadi" class="col-sm-4 col-form-label">Depo-Şube Adı</label>
                      <div class="col-sm-8">
                          <input type="text" class="form-control" id="depoadi" name="depoadi" placeholder="Depo-Şube Adı" autocomplete="off">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="tipi" class="col-sm-4 col-form-label">Tipi</label>
                      <div class="col-sm-8">
                          <input type="text" class="form-control" id="tipi" name="tipi" placeholder="Tipi" autocomplete="off">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="sira" class="col-sm-4 col-form-label">Sıra</label>
                      <div class="col-sm-8">
                          <input type="text" class="form-control" id="sira" name="sira" placeholder="Sıra" autocomplete="off">
                      </div>
                    </div>


                    <div class="form-group row">
                      <label for="aciklama" class="col-sm-4 col-form-label">Açıklama</label>
                      <div class="col-sm-8">
                          <textarea type="text" class="form-control" name="aciklama" placeholder="Açıklama" autocomplete="off"></textarea>
                      </div>
                    </div>



                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                    <button type="button" class="btn bg-primary YeniDepoSubmit">Kaydet</button>
                </div>
            </div>
        </div>
    </div>
    <!-- /basic modal -->
</form>

{!! JsValidator::formRequest('App\Http\Requests\Depo\YeniDepoRequest', '#YeniDepoForm'); !!}



<script type="text/javascript">
$(document).on('click', '.YeniDepoSubmit', function(e){
e.preventDefault();
    if($("#YeniDepoForm").valid())
      {
          var data = $("#YeniDepoForm").serialize();

          $.ajaxSetup({
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
            });
          $.ajax({
                  method    : "POST",
                  url       : "{{ url('depo') }}",
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
