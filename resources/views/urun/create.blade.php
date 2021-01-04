  <form role="form" id="YeniUrunForm">
    <!-- Basic modal -->
    <div id="YeniUrunModal" class="modal fade" tabindex="-1">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Yeni Ürün Kartı Ekleme</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">

                  <div class="row">
                    <div class="col-md-6">
                      <fieldset>
                        <legend class="font-weight-semibold"><i class="icon-qrcode mr-2"></i> Ürün Özellikleri</legend>


                        <div class="row">

                          <div class="col-md-12">
                            <div class="form-group">
                              <label>Ürün Adı:</label>
                              <input type="text" name="urunadi" class="form-control" id="urunadi" placeholder="Ürün Adı" autocomplete="off">
                            </div>
                          </div>
                            
                        </div>

                        <div class="row">


                          <div class="col-md-6">
                            <div class="form-group">
                              <label>Ürün Kodu:</label>
                              <input type="text" name="urunkodu" class="form-control" id="urunkodu" placeholder="urunkodu" autocomplete="off">
                            </div>
                          </div>
                            

                          <div class="col-md-6">
                            <div class="form-group">
                              <label>Birim:</label>
                                <select class="form-control" name="birim">
                                @foreach ($birim as $row)
                                  <option value="{{ $row->deger }}">{{ $row->deger }}</option>
                                @endforeach
                              </select>
                            </div>
                          </div>
    
                          
                        </div>

                        <div class="row">



                          <div class="col-md-6">
                            <div class="form-group">
                              <label>Ürün Markası:</label>
                              <select class="form-control" name="marka">
                                @foreach ($marka ?? '' as $row)
                                  <option value="{{ $row->deger }}">{{ $row->deger }}</option>
                                @endforeach
                              </select>
                            </div>
                          </div>

      
                          <div class="col-md-6">
                            <div class="form-group">
                              <label>Ürün Gurubu:</label>
                              <select class="form-control" name="grubu">
                                @foreach ($grubu as $row)
                                  <option value="{{ $row->deger }}">{{ $row->deger }}</option>
                                @endforeach
                              </select>
                            </div>
                          </div>
                          
                        </div>

                            
                      </fieldset>
                    </div>

                    <div class="col-md-6">
                      <fieldset>
                        <legend class="font-weight-semibold"><i class="icon-truck mr-2"></i> Stok Ayarları</legend>
                      
                      

                      <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                              <label>Barkod:</label>
                              <input type="text" name="barkod" class="form-control" id="barkod" placeholder="Barkod" autocomplete="off">
                            </div>
                          </div>

                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Alış Fiyatı:</label>
                            <input type="text" name="fiyat" class="form-control" id="fiyat" placeholder="Fiyat" autocomplete="off">
                          </div>
                        </div>
                        
                      </div>

                      
                      
                      <div class="row">


                          

            
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Fiyat Kar Gurubu:</label>
                            <select class="form-control" name="fiyat_grubu">
                              <option value="">Lütfen Seçiniz</option>
                              @foreach ($fiyat01 as $row)
                                <option value="{{ $row->id }}">{{ $row->adi }}</option>
                              @endforeach
                            </select>
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="form-group">
                            <label>KDV Oranı:</label>
                            <input type="text" name="kdv" class="form-control" id="kdv"  value="18" placeholder="KDV Oranı" autocomplete="off">
                          </div>
                        </div>

                        
                      </div>
                      <div class="row">

                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Maximum Stok:</label>
                            <input type="text" name="max_stok" class="form-control" id="max_stok" placeholder="Max Stok" autocomplete="off">
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Minimum Stok:</label>
                            <input type="text" name="min_stok" class="form-control" id="min_stok" placeholder="Min Stok" autocomplete="off">
                          </div>
                        </div>

                        
                      </div>



                      </fieldset>
                    </div>
                  </div>





                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                    <button type="button" class="btn bg-primary YeniUrunSubmit">Kaydet</button>
                </div>
            </div>
        </div>
    </div>
    <!-- /basic modal -->
</form>

{!! JsValidator::formRequest('App\Http\Requests\Urun\StoreUrunRequest', '#YeniUrunForm'); !!}

<script type="text/javascript">
  new AutoNumeric('#YeniUrunForm #fiyat', {
      decimalCharacter : ',',
      digitGroupSeparator : '.',
      modifyValueOnWheel	: false,
  });
</script>


<script type="text/javascript">
$(document).on('click', '.YeniUrunSubmit', function(e){
e.preventDefault();
    if($("#YeniUrunForm").valid())
      {
          var data = $("#YeniUrunForm").serialize();

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

