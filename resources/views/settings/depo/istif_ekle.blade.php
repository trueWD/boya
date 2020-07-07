<form id="IstifEkleForm">
    <!-- Basic modal -->
    <div id="IstifEkleModal" class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">İstif & İs İstasyonu Ekleme Formu</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">


                    <div class="form-group row">
                        <label for="depoadi" class="col-sm-4 col-form-label">Depo Adı</label>
                        <div class="col-sm-8">
                        <select class="form-control" name="depoid">
                            @foreach ($depo01 as $row)
                             <option value="{{ $row->id }}">{{ $row->depoadi }}</option>   
                            @endforeach
                        </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="adi" class="col-sm-4 col-form-label">İstif & İstasyon Adı</label>
                        <div class="col-sm-8">
                        <input type="text" name="adi" class="form-control" id="adi">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="tipi" class="col-sm-4 col-form-label">Kullanım Tipi</label>
                        <div class="col-sm-8">
                        <select class="form-control" name="tipi">
                             <option value="DEPO">DEPO</option>   
                             <option value="URETIM">URETIM</option>   
                        </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="sira" class="col-sm-4 col-form-label">Açıklama</label>
                        <div class="col-sm-8">
                        <textarea class="form-control" name="aciklama"></textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="sira" class="col-sm-4 col-form-label">Liste Sıralaması</label>
                        <div class="col-sm-8">
                        <input type="text" name="sira" class="form-control">
                        </div>
                    </div>

    

                    <div class="form-group row">
                        <label for="kapasite" class="col-sm-4 col-form-label">Kapasite</label>
                        <div class="col-sm-8">
                        <input type="text" name="kapasite" class="form-control">
                        </div>
                    </div>







                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                    <button type="button" class="btn bg-primary IstifEkleSubmit">Kaydet</button>
                </div>
            </div>
        </div>
    </div>
    <!-- /basic modal -->
</form>

{!! JsValidator::formRequest('App\Http\Requests\Settings\IstifKaydetRequest', '#IstifEkleForm'); !!}

<script type="text/javascript">
$(document).on('click', '.IstifEkleSubmit', function(e){
e.preventDefault();
    if($("#IstifEkleForm").valid())
      {
          var data = $("#IstifEkleForm").serialize();

          $.ajaxSetup({
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
            });
          $.ajax({
                  method    : "POST",
                  url       : "{{ url('settings/depo/IstifKaydet') }}",
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

