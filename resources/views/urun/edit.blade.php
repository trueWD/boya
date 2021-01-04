<form id="UrunEditForm">
    <!-- Basic modal -->
    <div id="UrunEditModal" class="modal fade" tabindex="-1">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title">ÜRÜN DÜZENLEME : <span class="text-danger">{{ $urun->urunadi }}</span></h5>
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
                              <input type="text" name="urunadi" value="{{ $urun->urunadi }}" class="form-control" id="urunadi" placeholder="Ürün Adı" autocomplete="off">
                            </div>
                          </div>
                            
                        </div>

                        <div class="row">


                          <div class="col-md-6">
                            <div class="form-group">
                              <label>Ürün Kodu:</label>
                              <input type="text" name="urunkodu" value="{{ $urun->urunkodu }}" class="form-control" id="urunkodu" placeholder="urunkodu" autocomplete="off">
                            </div>
                          </div>
                            

                          <div class="col-md-6">
                            <div class="form-group">
                              <label>Birim:</label>
                                <select class="form-control" name="birim">
                                  <option value="{{ $urun->birim }}">{{ $urun->birim }}</option>
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
                                <option value="{{ $urun->marka }}">{{ $urun->marka }}</option>
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
                                <option value="{{ $urun->grubu }}">{{ $urun->grubu }}</option>
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
                              <input type="text" name="barkod" value="{{ $urun->barkod }}" class="form-control" id="barkod" disabled>
                            </div>
                          </div>

                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Alış Fiyatı:</label>
                            <input type="text" name="fiyat" value="{{ $urun->fiyat }}" class="form-control" id="fiyat" placeholder="Fiyat" autocomplete="off">
                          </div>
                        </div>
                        
                      </div>

                      
                      
                      <div class="row">


                          


                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Fiyat Kar Gurubu:</label>
                            <select class="form-control" name="fiyat_grubu">
                              <option value="{{ $urun->fiyat01->id }}">{{ $urun->fiyat01->adi }}</option>
                              @foreach ($fiyat01 as $row)
                                <option value="{{ $row->id }}">{{ $row->adi }}</option>
                              @endforeach
                            </select>
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="form-group">
                            <label>KDV Oranı:</label>
                            <input type="text" name="kdv" class="form-control" id="kdv"  value="{{ $urun->kdv }}" placeholder="KDV Oranı" autocomplete="off">
                          </div>
                        </div>


                        
                      </div>
                      <div class="row">

                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Maximum Stok:</label>
                            <input type="text" name="max_stok" value="{{ $urun->max_stok }}" class="form-control" id="max_stok" placeholder="Max Stok" autocomplete="off">
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Minimum Stok:</label>
                            <input type="text" name="min_stok" value="{{ $urun->min_stok }}" class="form-control" id="min_stok" placeholder="Min Stok" autocomplete="off">
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
                    <button type="button" class="btn bg-primary UrunEditSubmit">Kaydet</button>
                </div>
            </div>
        </div>
    </div>
    <!-- /basic modal -->
</form>

{!! JsValidator::formRequest('App\Http\Requests\Urun\StoreUrunRequest', '#UrunEditForm'); !!}

<script type="text/javascript">
$(document).on('click', '.UrunEditSubmit', function(e){
e.preventDefault();
    if($("#UrunEditForm").valid())
      {
          var data = $("#UrunEditForm").serialize();

          $.ajaxSetup({
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
            });
          $.ajax({
                  method    : "POST",
                  url       : "{{ url('urun/update') }}",
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

