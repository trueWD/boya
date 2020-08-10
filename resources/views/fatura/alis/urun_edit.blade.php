<form id="UrunEditForm">
    <!-- Basic modal -->
    <div id="UrunEditModal" class="modal fade" tabindex="-1">
        <div class="modal-dialog modal-sx">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title">ÜRÜN : <span class="text-danger">{{ $urun->urun->urunadi }}</span></h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">

                  <div class="form-group row">
										<label class="col-lg-4 col-form-label">Miktar:</label>
										<div class="col-lg-8">
											<input type="text" name="miktar" class="form-control" id="miktar" value="{{ $urun->miktar }}" placeholder="Fatura No" autocomplete="off">
										</div>
									</div>
                  <div class="form-group row">
										<label class="col-lg-4 col-form-label">Alış Fiyatı:</label>
										<div class="col-lg-8">
											<input type="text" name="fiyat" class="form-control" id="fiyat" value="{{ $urun->fiyat }}" placeholder="Fatura No" autocomplete="off">
										</div>
									</div>
                  <div class="form-group row">
										<label class="col-lg-4 col-form-label">KDV:</label>
										<div class="col-lg-8">
											<input type="text" name="kdv" class="form-control" id="kdv" value="{{ $urun->kdv }}" placeholder="Fatura No" autocomplete="off">
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

{!! JsValidator::formRequest('App\Http\Requests\Fatura\AlisUrunUpdateRequest', '#UrunEditForm'); !!}

<script type="text/javascript">
  new AutoNumeric('#UrunEditForm #fiyat', {
      decimalCharacter : ',',
      digitGroupSeparator : '.',
      modifyValueOnWheel	: false,
  });
</script>

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
                  url       : "{{ url('fatura/alis/UrunUpdate') }}",
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
<script type="text/javascript">
  $('#UrunEditForm .fatura_tarihi').pickadate();
</script>
