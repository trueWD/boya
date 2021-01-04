<form id="FiyatGuncelleForm">
    <!-- Basic modal -->
    <div id="FiyatGuncelleModal" class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title">FİYAT GÜNCELLE : <span class="text-primary">{{ $siparis02->urunbilgisi->urunadi }}</span></h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">



                  <div class="form-group row">
										<label class="col-md-4 col-form-label">Ürün Fiyatı:</label>
										<div class="col-md-8">
											<input type="text" name="fiyat" value="{{ $siparis02->fiyat }}" class="form-control" id="fiyat" placeholder="Fiyat" autocomplete="off">
										</div>
									</div>
                  <div class="form-group row">
										<label class="col-md-4 col-form-label">İskonto:</label>
										<div class="col-md-8">
											<input type="text" name="iskonto" value="{{ $siparis02->iskonto }}" class="form-control" id="iskonto" placeholder="iskonto" autocomplete="off">
										</div>
									</div>
                  <div class="form-group row">
										<label class="col-md-4 col-form-label">KDV (% Olarak):</label>
										<div class="col-md-8">
											<input type="text" name="kdv" value="{{ $siparis02->kdv }}" class="form-control" id="kdv" placeholder="iskonto" autocomplete="off">
										</div>
									</div>


                </div>

                <div class="modal-footer">
                  <input type="hidden" name="urunid" value="{{ $siparis02->id }}">
                    <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                    <button type="button" class="btn bg-primary FiyatGuncelleSubmit">Kaydet</button>
                </div>
            </div>
        </div>
    </div>
    <!-- /basic modal -->
</form>

{!! JsValidator::formRequest('App\Http\Requests\Satis\FiyatGuncelleRequest', '#FiyatGuncelleForm'); !!}


<script type="text/javascript">
  new AutoNumeric('#FiyatGuncelleForm #fiyat', {
      decimalCharacter : ',',
      digitGroupSeparator : '.',
      modifyValueOnWheel	: false,
  });
</script>

<script type="text/javascript">
$(document).on('click', '.FiyatGuncelleSubmit', function(e){
e.preventDefault();
    if($("#FiyatGuncelleForm").valid())
      {
          var data = $("#FiyatGuncelleForm").serialize();

          $.ajaxSetup({
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
            });
          $.ajax({
                  method    : "POST",
                  url       : "{{ url('satis/FiyatUpdate') }}",
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

