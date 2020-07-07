<form id="UrunCopyForm">
    <!-- Basic modal -->
    <div id="UrunCopyModal" class="modal fade" tabindex="-1">
        <div class="modal-dialog modal-full">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title">ÜRÜN KOPYALA : <span class="text-primary">{{ $urun->urunadi }}</span></h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">

                  <div class="row">
                    <div class="col-md-6">
                      <fieldset>
                        <legend class="font-weight-semibold"><i class="icon-reading mr-2"></i> Personal details</legend>


                        <div class="row">

                          <div class="col-md-12">
                            <div class="form-group">
                              <label>Ürün Adı:</label>
                              <input type="text" name="urunadi" value="{{ $urun->urunadi }}" class="form-control" id="urunadi" placeholder="Ürün Adı" autocomplete="off">
                            </div>
                          </div>
                            
                        </div>
                        <div class="row">

                          <div class="col-md-12">
                            <div class="form-group">
                              <label>Ürün Adı İngilizce:</label>
                              <input type="text" name="urunadi_en" value="{{ $urun->urunadi_en }}" class="form-control" id="urunadi_en" placeholder="Ürün Adı İngilizce" autocomplete="off">
                            </div>
                          </div>

                        </div>

                        <div class="row">

                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Boy:</label>
                        <input type="text" name="boy"  value="{{ $urun->boy }}" class="form-control" id="boy" placeholder="Boy" autocomplete="off">
                      </div>
                    </div>



                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Ürün Gurupu:</label>
                        <select class="form-control" name="grubu">
                            <option value="{{ $urun->grubu }}">{{ $urun->grubu }}</option>
                          @foreach ($urungrubu as $grubu)
                            <option value="{{ $grubu->deger }}">{{ $grubu->deger }}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                    
                  </div>


                      <div class="row">

                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Kalitesi:</label>
                            <select class="form-control" name="kalite">
                              <option value="{{ $urun->kalite }}">{{ $urun->kalite }}</option>
                              @foreach ($kaliteler as $kalite)
                                <option value="{{ $kalite->deger }}">{{ $kalite->deger }}</option>
                              @endforeach
                            </select>
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Toleransı:</label>
                              <select class="form-control" name="tolerans">
                                <option value="{{ $urun->tolerans }}">{{ $urun->tolerans }}</option>
                              @foreach ($toleranslar as $tolerans)
                                <option value="{{ $tolerans->deger }}">{{ $tolerans->deger }}</option>
                              @endforeach
                            </select>
                          </div>
                        </div>
                        
                      </div>

                      <div class="row">

                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Paket Tonajı:</label>
                              <select class="form-control" name="tonaj">
                                <option value="{{ $urun->tonaj }}">{{ $urun->tonaj }}</option>
                              @foreach ($tonajlar as $tonaj)
                                <option value="{{ $tonaj->deger }}">{{ $tonaj->aciklama }}</option>
                              @endforeach
                            </select>
                          </div>
                        </div>

                      </div>


                  <div class="row">

                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Ebat A:</label>
                        <input type="text" name="ebata" value="{{ $urun->ebata }}" class="form-control" id="ebata" placeholder="Ebat A" autocomplete="off">
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Ebat B:</label>
                          <input type="text" name="ebatb" value="{{ $urun->ebatb }}" class="form-control" id="ebatb" placeholder="Ebat B" autocomplete="off">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Ebat C:</label>
                          <input type="text" name="ebatc" value="{{ $urun->ebatc }}" class="form-control" id="ebatc" placeholder="Ebat C" autocomplete="off">
                      </div>
                    </div>
                    
                  </div>
                            
                      </fieldset>
                    </div>

                    <div class="col-md-6">
                      <fieldset>
                        <legend class="font-weight-semibold"><i class="icon-truck mr-2"></i> Shipping details</legend>
                        <div class="row">

                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Fiyat Gurupu:</label>
                        <input type="text" name="fiyat_grubu" value="{{ $urun->fiyat_grubu }}" class="form-control" id="fiyat_grubu" placeholder="Fiyat Gurupu" autocomplete="off">
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Muhasebe Kodu:</label>
                        <input type="text" name="apikodu" value="{{ $urun->apikodu }}" class="form-control" id="apikodu" placeholder="Muhasebe Kodu" autocomplete="off">
                      </div>
                    </div>

                    
                  </div>

                  
                  <div class="row">


                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Ürün Kodu:</label>
                        <input type="text" name="urunkodu" value="{{ $urun->urunkodu }}" class="form-control" id="urunkodu" placeholder="Ürün Kodu" autocomplete="off">
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Çubuk Sayısı:</label>
                          <input type="text" name="cubuksayisi" value="{{ $urun->cubuksayisi }}" class="form-control" id="cubuksayisi" placeholder="Çubuk Sayısı" autocomplete="off">
                      </div>
                    </div>
                    
                  </div>

                  <div class="row">

                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Termin Süresi (Gün):</label>
                        <input type="text" name="terminsuresi" value="{{ $urun->terminsuresi }}" class="form-control" id="terminsuresi" placeholder="Gün" autocomplete="off">
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Emniyet Stoğu (Kg):</label>
                          <input type="text" name="emniyetstok" value="{{ $urun->emniyetstok }}" class="form-control" id="emniyetstok" placeholder="Ton" autocomplete="off">
                      </div>
                    </div>
                    
                  </div>

                  <div class="row">

                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Maximum Satış:</label>
                        <input type="text" name="maxsatis" value="{{ $urun->maxsatis }}" class="form-control" id="maxsatis" placeholder="Maximum Satış" autocomplete="off">
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Minimum Satış:</label>
                          <input type="text" name="minsatis" value="{{ $urun->minsatis }}" class="form-control" id="minsatis" placeholder="Minimum Satış" autocomplete="off">
                      </div>
                    </div>
                    
                  </div>




                      </fieldset>
                    </div>
                  </div>





                </div>

                <div class="modal-footer">
                    <input type="hidden" name="id" value="{{ $urun->id }}">
                    <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                    <button type="button" class="btn bg-primary UrunCopySubmit">Kaydet</button>
                </div>
            </div>
        </div>
    </div>
    <!-- /basic modal -->
</form>

{!! JsValidator::formRequest('App\Http\Requests\Urun\StoreUrunRequest', '#UrunCopyForm'); !!}

<script type="text/javascript">
$(document).on('click', '.UrunCopySubmit', function(e){
e.preventDefault();
    if($("#UrunCopyForm").valid())
      {
          var data = $("#UrunCopyForm").serialize();

          $.ajaxSetup({
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
            });
          $.ajax({
                  method    : "POST",
                  url       : "{{ url('urun') }}",
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

