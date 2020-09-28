<form id="YeniHesapForm">
    <!-- Basic modal -->
    <div id="YeniHesapModal" class="modal fade" tabindex="-1">
        <div class="modal-dialog modal-sx">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Yeni Banka Hesabı Ekleme</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">

                  <div class="form-group row">
										<label class="col-lg-3 col-form-label">Banka Adı:</label>
										<div class="col-lg-9">
										 <input type="text" name="adi" class="form-control" id="adi" placeholder="Banka Adı" autocomplete="off">
										</div>
									</div>
                  <div class="form-group row">
										<label class="col-lg-3 col-form-label">Şube Adı:</label>
										<div class="col-lg-9">
										 <input type="text" name="sube" class="form-control" id="sube" placeholder="Şube Adı" autocomplete="off">
										</div>
									</div>
                  <div class="form-group row">
										<label class="col-lg-3 col-form-label">IBAN:</label>
										<div class="col-lg-9">
										 <input type="text" name="iban" class="form-control" id="iban" placeholder="IBAN" autocomplete="off">
										</div>
									</div>
                  <div class="form-group row">
										<label class="col-lg-3 col-form-label">Hesap No:</label>
										<div class="col-lg-9">
										 <input type="text" name="hesap" class="form-control" id="hesap" placeholder="Hesap No" autocomplete="off">
										</div>
									</div>
                  <div class="form-group row">
										<label class="col-lg-3 col-form-label">Şube Kodu:</label>
										<div class="col-lg-9">
										 <input type="text" name="subekodu" class="form-control" id="subekodu" placeholder="Şube Kodu" autocomplete="off">
										</div>
									</div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                    <button type="button" class="btn bg-primary YeniHesapSubmit">Kaydet</button>
                </div>
            </div>
        </div>
    </div>
    <!-- /basic modal -->
</form>

{!! JsValidator::formRequest('App\Http\Requests\Banka\YeniHesapRequest', '#YeniHesapForm'); !!}

<script type="text/javascript">
$(document).on('click', '.YeniHesapSubmit', function(e){
e.preventDefault();
    if($("#YeniHesapForm").valid())
      {
          var data = $("#YeniHesapForm").serialize();

          $.ajaxSetup({
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
            });
          $.ajax({
                  method    : "POST",
                  url       : "{{ url('banka') }}",
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

