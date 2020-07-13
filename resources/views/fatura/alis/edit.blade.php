<form id="FaturaEditForm">
    <!-- Basic modal -->
    <div id="FaturaEditModal" class="modal fade" tabindex="-1">
        <div class="modal-dialog modal-sx">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title">ÜRÜN DÜZENLEME : <span class="text-danger">{{ $fatura01->cariadi }}</span></h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">





                  <div class="row">
                    <div class="col-md-12">


                        <div class="row">

                          <div class="col-md-12">
                            <div class="form-group">
                              <label>Cari Adı:</label>
                              <input class="form-control" value="{{ $fatura01->cariadi }}" disabled>
                            </div>
                          </div>
                            
                        </div>

                        <div class="row">

                          <div class="col-md-6">
                            <label>Bitiş tarihi:</label>
                            <div class="input-group">
                              <span class="input-group-prepend">
                                <span class="input-group-text"><i class="icon-calendar"></i></span>
                              </span>
                              <input type="text" data-value="{{ $fatura01->cariadi }}" name="fatura_tarihi" class="form-control fatura_tarihi">
                            </div>
                          </div>
                     


                          <div class="col-md-6">
                            <div class="form-group">
                              <label>Fatura Numrası:</label>
                              <input type="text" name="faturano" class="form-control" id="faturano" value="{{ $fatura01->faturano }}" placeholder="Fatura No" autocomplete="off">
                            </div>
                          </div>
                          
                        </div>
               
                    </div>

                  </div>




                </div>

                <div class="modal-footer">
                    <input type="hidden" name="id" value="{{ $fatura01->id }}">
                    <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                    <button type="button" class="btn bg-primary FaturaEditSubmit">Kaydet</button>
                </div>
            </div>
        </div>
    </div>
    <!-- /basic modal -->
</form>

{!! JsValidator::formRequest('App\Http\Requests\Urun\StoreUrunRequest', '#FaturaEditForm'); !!}

<script type="text/javascript">
$(document).on('click', '.FaturaEditSubmit', function(e){
e.preventDefault();
    if($("#FaturaEditForm").valid())
      {
          var data = $("#FaturaEditForm").serialize();

          $.ajaxSetup({
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
            });
          $.ajax({
                  method    : "POST",
                  url       : "{{ url('fatura/alis/update') }}",
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
  $('#FaturaEditForm .fatura_tarihi').pickadate();
</script>
