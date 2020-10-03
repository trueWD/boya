  <form role="form" id="YeniOdemeForm">
    <!-- Basic modal -->
    <div id="YeniOdemeModal" class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">BORÇ ÖDEME EKRANI</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">


                    <div class="form-group row">
                      <label for="hesapkodu" class="col-sm-4 col-form-label">Tedarikçi Adı</label>
                      <div class="col-sm-8">
                          <select class="js-example-basic-single js-states form-control select cariid" name="cariid"></select>
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="odemetipi" class="col-sm-4 col-form-label">Ödeme Tipi</label>
                      <div class="col-sm-8">
                        <select name="odemetipi" class="form-control">
                          <option value="NAKIT">NAKİT</option>
                          <option value="KART">KART</option>
                          <option value="CEK">ÇEK</option>
                          <option value="SENET">SENET</option>
                        </select>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="dekontno" class="col-sm-4 col-form-label">Dekont No</label>
                      <div class="col-sm-8">
                          <input type="text" class="form-control" id="dekontno" name="dekontno" placeholder="Dekont No" autocomplete="off">
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="tutar" class="col-sm-4 col-form-label">Tutar</label>
                      <div class="col-sm-8">
                          <input type="text" class="form-control" id="tutar" name="tutar" placeholder="Tutar" autocomplete="off">
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
                    <button type="button" class="btn bg-primary YeniOdemeSubmit">Kaydet</button>
                </div>
            </div>
        </div>
    </div>
    <!-- /basic modal -->
</form>

{!! JsValidator::formRequest('App\Http\Requests\Odeme\YeniOdemeRequest', '#YeniOdemeForm'); !!}

<script type="text/javascript">
  new AutoNumeric('#YeniOdemeForm #tutar', {
      decimalCharacter : ',',
      digitGroupSeparator : '.',
      modifyValueOnWheel	: false,
  });
</script>


<script type="text/javascript">
$(document).on('click', '.YeniOdemeSubmit', function(e){
e.preventDefault();
    if($("#YeniOdemeForm").valid())
      {
          var data = $("#YeniOdemeForm").serialize();

          $.ajaxSetup({
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
            });
          $.ajax({
                  method    : "POST",
                  url       : "{{ url('odeme') }}",
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


 <script>
  $.fn.modal.Constructor.prototype._enforceFocus = function() {};
  $(document).ready(function(){

      $('#YeniOdemeForm .cariid').select2({
          ajax : {
              url : '/api/tedarikciler',
              dataType : 'json',
              delay : 200,
              data : function(params){
                  return {
                      q : params.term,
                      page : params.page
                  };
              },
              processResults : function(data, params){
                  params.page = params.page || 2;
                  return {
                      results : data.data,
                      pagination: {
                          more : (params.page  * 10) < data.total
                      }
                  };
              }
          },
          minimumInputLength : 2,
          templateResult : function (repo){
              if(repo.loading) return repo.cariadi;
              var markup = repo.cariadi;
              return markup;
          },
          templateSelection : function(repo)
          {
              return repo.cariadi;
          },
          escapeMarkup : function(markup){ return markup; }
      });
  });
</script>
