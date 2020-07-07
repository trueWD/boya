<form id="YeniCariForm">
    <!-- Basic modal -->
    <div id="YeniCariModal" class="modal fade" tabindex="-1">
        <div class="modal-dialog modal-full">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Yeni Cari Ekleme</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">

                  <div class="row">
                    <div class="col-md-6">
                      <fieldset>
                      <legend class="font-weight-semibold"><i class="icon-user-tie mr-2"></i> Cari Genel Bilgisi</legend>


                      <div class="row">

                        <div class="col-md-12">
                          <div class="form-group">
                            <label>Cari Adı:</label>
                            <input type="text" name="cariadi" class="form-control" id="cariadi" placeholder="Cari Adı" autocomplete="off">
                          </div>
                        </div>
                          
                      </div>
                      <div class="row">

                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Vergi No:</label>
                            <input type="text" name="vergino" class="form-control" id="vergino" placeholder="Vergi No" autocomplete="off">
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Vergi Dairesi:</label>
                            <input type="text" name="vergidairesi" class="form-control" id="vergidairesi" placeholder="Vergi Dairesi" autocomplete="off">
                          </div>
                        </div>

                      </div>

                      <div class="row">

                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Cari Türü:</label>
                              <select class="form-control" name="grubu">
                                @foreach ($carigrubu as $grup)
                                  <option value="{{ $grup->deger }}">{{ $grup->aciklama }}</option>
                                @endforeach
                              </select>
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Muhasebe Entegrasyon ID:</label>
                            <input type="text" name="muhasebeapi" class="form-control" id="muhasebeapi" placeholder="Entegrasyon ID" autocomplete="off">
                          </div>
                        </div>
                        
                      </div>

                      <div class="row">

                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Şirket Yetkilisi:</label>
                            <input type="text" name="yetkili" class="form-control" id="yetkili" placeholder="Şirket Yetkilisi" autocomplete="off">
                          </div>
                        </div>

      
                      </div>



    
                      </fieldset>
                    </div>

                    <div class="col-md-6">
                      <fieldset>
                      <legend class="font-weight-semibold"><i class="icon-address-book mr-2"></i> Cari İletişim Bilgileri</legend>


                      <div class="row">

                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Telefon:</label>
                            <input type="text" name="telefon" class="form-control" id="telefon" placeholder="Telefon" autocomplete="off">
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Telefon 2:</label>
                            <input type="text" name="telefon2" class="form-control" id="telefon2" placeholder="Telefon 2" autocomplete="off">
                          </div>
                        </div>
                        
                      </div>


                      <div class="row">

                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Faks:</label>
                            <input type="text" name="faks" class="form-control" id="faks" placeholder="Faks" autocomplete="off">
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="form-group">
                            <label>E-mail:</label>
                            <input type="text" name="email" class="form-control" id="email" placeholder="E-mail" autocomplete="off">
                          </div>
                        </div>
                        
                      </div>

                      <div class="row">

                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Ülke:</label>
                            <input type="text" name="ulke" value="Türkiye" class="form-control" id="ulke" placeholder="ulke" autocomplete="off">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Şehir:</label>
                            <input type="text" name="sehir" class="form-control" id="sehir" placeholder="Şehir" autocomplete="off">
                          </div>
                        </div>
                        
                      </div>


                      <div class="row">

                        <div class="col-md-12">
                          <div class="form-group">
                            <label>Adres :</label>
                            <textarea class="form-control" name="adres" autocomplete="off"></textarea>
                          </div>
                        </div>

                      </div>

                      </fieldset>
                    </div>
                  </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                    <button type="button" class="btn bg-primary YeniCariSubmit">Kaydet</button>
                </div>
            </div>
        </div>
    </div>
    <!-- /basic modal -->
</form>

{!! JsValidator::formRequest('App\Http\Requests\Cari\StoreCariRequest', '#YeniCariForm'); !!}

<script type="text/javascript">
$(document).on('click', '.YeniCariSubmit', function(e){
e.preventDefault();
    if($("#YeniCariForm").valid())
      {
          var data = $("#YeniCariForm").serialize();

          $.ajaxSetup({
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
            });
          $.ajax({
                  method    : "POST",
                  url       : "{{ url('cari') }}",
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

