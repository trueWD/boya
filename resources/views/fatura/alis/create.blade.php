  <form role="form" id="AlisFaturaForm">
    <!-- Basic modal -->
    <div id="AlisFaturaModal" class="modal fade" tabindex="-1">
        <div class="modal-dialog modal-sx">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Yeni Alış Faturası</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">

                  <div class="row">
                    <div class="col-md-12">


                        <div class="row">

                          <div class="col-md-12">
                            <div class="form-group">
                              <label>Cari Adı:</label>
                              <select class="js-example-basic-single js-states form-control select cariid" name="cariid" id="cariid1"></select>
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
                              <input type="text" data-value="<?php echo date("Y-m-d",time()); ?>" name="fatura_tarihi" class="form-control fatura_tarihi">
                            </div>
                          </div>
                     


                          <div class="col-md-6">
                            <div class="form-group">
                              <label>Fatura Numrası:</label>
                              <input type="text" name="faturano" class="form-control" id="faturano" placeholder="Fatura No" autocomplete="off">
                            </div>
                          </div>
                          
                        </div>
               
                    </div>

                  </div>




                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                    <button type="button" class="btn bg-primary AlisFaturaSubmit">Kaydet</button>
                </div>
            </div>
        </div>
    </div>
    <!-- /basic modal -->
</form>

{!! JsValidator::formRequest('App\Http\Requests\Fatura\AlisFaturaRequest', '#AlisFaturaForm'); !!}

<script type="text/javascript">
$(document).on('click', '.AlisFaturaSubmit', function(e){
e.preventDefault();
    if($("#AlisFaturaForm").valid())
      {
          var data = $("#AlisFaturaForm").serialize();

          $.ajaxSetup({
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
            });
          $.ajax({
                  method    : "POST",
                  url       : "{{ url('fatura/alis') }}",
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
  $('#AlisFaturaForm .fatura_tarihi').pickadate();
</script>
  <script>
  $.fn.modal.Constructor.prototype._enforceFocus = function() {};
  $(document).ready(function(){

      $('#AlisFaturaForm #cariid1').select2({
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