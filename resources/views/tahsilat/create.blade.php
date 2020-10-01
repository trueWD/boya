<form id="YeniTahsilatForm">
    <!-- Basic modal -->
    <div id="YeniTahsilatModal" class="modal fade" tabindex="-1">
        <div class="modal-dialog modal-sx">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Yeni Tahsilat Girişi</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">

                    <div class="form-group row">
                      <label class="col-lg-3 col-form-label">Ödenen Tutar:</label>
                      <div class="col-lg-9">
                      <input type="text" name="tutar" class="form-control" id="tutar" placeholder="0,00" autocomplete="off">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-lg-3 col-form-label">Ödeme Tipi:</label>
                      <div class="col-lg-9">
                        <select name="odemetipi" class="form-control">
                          <option value="NAKIT">NAKIT</option>
                          <option value="KART">KART</option>
                        </select>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-lg-3 col-form-label">Açıklama:</label>
                      <div class="col-lg-9">
                      <textarea class="form-control" name="aciklama" placeholder="Açıklama"></textarea>
                      </div>
                    </div>
                  
                  </div>
                <div class="modal-footer">
                    <input type="hidden" name="cariid" value="{{ $cari01->id }}">
                    <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                    <button type="button" class="btn bg-primary YeniTahsilatSubmit">Kaydet</button>
                </div>
            </div>
        </div>
    </div>
    <!-- /basic modal -->
</form>

{!! JsValidator::formRequest('App\Http\Requests\Tahsilat\YeniTahsilatRequest', '#YeniTahsilatForm'); !!}
<script type="text/javascript">
  new AutoNumeric('#YeniTahsilatForm #tutar', {
      decimalCharacter : ',',
      digitGroupSeparator : '.',
      modifyValueOnWheel	: false,
  });
</script>
<script type="text/javascript">
$(document).on('click', '.YeniTahsilatSubmit', function(e){
e.preventDefault();
    if($("#YeniTahsilatForm").valid())
      {
          var data = $("#YeniTahsilatForm").serialize();

          $.ajaxSetup({
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
            });
          $.ajax({
                  method    : "POST",
                  url       : "{{ url('tahsilat') }}",
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

