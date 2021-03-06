  <form role="form" id="YeniFiyatForm">
    <!-- Basic modal -->
    <div id="YeniFiyatModal" class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">YENİ FİYAT GRUBU OLUŞTURMA EKRANI</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">



                    <div class="form-group row">
                      <label for="adi" class="col-sm-4 col-form-label">Grup Adı</label>
                      <div class="col-sm-8">
                          <input type="text" class="form-control" id="adi" name="adi" placeholder="Grup Adı" autocomplete="off">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="oran" class="col-sm-4 col-form-label">Kar Oranı</label>
                      <div class="col-sm-8">
                          <input type="text" class="form-control" id="oran" name="oran" placeholder="Kar Oranı" autocomplete="off">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="indirim_oran" class="col-sm-4 col-form-label">Maximum İndirim</label>
                      <div class="col-sm-8">
                          <input type="text" class="form-control" id="indirim_oran" name="indirim_oran" placeholder="Maximum İndirim" autocomplete="off">
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
                    <button type="button" class="btn bg-primary YeniFiyatSubmit">Kaydet</button>
                </div>
            </div>
        </div>
    </div>
    <!-- /basic modal -->
</form>

{!! JsValidator::formRequest('App\Http\Requests\Satis\YeniFiyatRequest', '#YeniFiyatForm'); !!}



<script type="text/javascript">
$(document).on('click', '.YeniFiyatSubmit', function(e){
e.preventDefault();
    if($("#YeniFiyatForm").valid())
      {
          var data = $("#YeniFiyatForm").serialize();

          $.ajaxSetup({
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
            });
          $.ajax({
                  method    : "POST",
                  url       : "{{ url('fiyat') }}",
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
