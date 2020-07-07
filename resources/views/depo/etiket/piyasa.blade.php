<form id="PiyasaEtiketOlusturForm">
    <!-- Basic modal -->
    <div id="PiyasaEtiketModal" class="modal fade" tabindex="-1">
        <div class="modal-dialog modal-full">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title">ETİKET OLUŞTURMA : <span class="text-primary">{{ $siparis01->cariadi }}</span></h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">

                  <div class="row">
                    <div class="col-md-4">
                      



			              <form id="#">


                      <table class="table table-bordered">
                        <tbody>
                          <tr>
                            <td>Müşteri Adı</td>
                            <td>{{ $siparis01->cariadi }}</td>
                          </tr>
                          <tr>
                            <td>Dosya No</td>
                            <td>{{ $siparis01->id }}</td>
                          </tr>
                          <tr>
                            <td>Ürün Adı</td>
                            <td>{{ $siparis02->urunadi }}</td>
                          </tr>
                          <tr>
                            <td>Miktar Sipariş</td>
                            <td>{{ number_format($siparis02->miktar_siparis) }}</td>
                          </tr>
                          <tr>
                            <td>Boy</td>
                            <td>{{ $siparis02->boy }}</td>
                          </tr>
                          <tr>
                            <td>Kalite</td>
                            <td>{{ $siparis02->kalite }}</td>
                          </tr>
                          <tr>
                            <td>Toleransı</td>
                            <td>{{ $siparis02->tolerans }}</td>
                          </tr>
                          <tr>
                            <td>Paket Tipi</td>
                            <td>{{ $siparis02->paket_tipi }}</td>
                          </tr>
                          <tr>
                            <td>Üretim Tipi</td>
                            <td>{{ $siparis02->uretim_tipi }}</td>
                          </tr>


                          <tr>
                            <td><input type="text" name="paket_sayisi" value="{{ $siparis02->paket_sayisi }}" class="form-control" placeholder="Paket"></td>
                            <td>
                                <button type="button" class="btn btn-primary PiyasaEtiketOlusturButon"><i class="icon-price-tags2 mr-1"></i> Ürün Oluştur</button>
                            </td>
                          </tr>
                        </tbody>


                    </table>


											
										</form>






                    </div>
                    <div class="col-md-8">


                      <div id="PiyasaEtiketOlusturResponse">

                          @if(count($urun02)==0)


                          <div class="alert alert-info border-0 alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert"><span>×</span></button>
                            <span class="font-weight-semibold">Dikkat!</span>Bu siparişe ait hiç eteiket yok!
                          </div>


                          @else

                          
                          <table class="table table-striped table-bordered table-hover table-sm myDataTable1">
                          <thead>
                              <tr>
                                  <th>#</th>
                                  <th>İslem</th>
                                  <th>Ürün Adı</th>
                                  <th>Tonaj</th>  
                                  <th>Boy</th>
                                  <th>Kalite</th>
                                  <th>Tolreansi</th>
                              </tr>
                          </thead>
                          <tbody>
                              @foreach($urun02 as $urun)
                              <tr>
                                  <td>{{ $urun->id }}</td>
                                  <td>
                                    <button type="button" class="btn btn-primary"><i class="icon-printer"></i></button>
                                  </td>
                                  <td>{{ $urun->urunadi }}</td>
                                  <td>{{ $urun->tonaj }}</td>
                                  <td>{{ $urun->boy }}</td>
                                  <td>{{ $urun->kalite }}</td>
                                  <td>{{ $urun->tolerans }}</td>
                              </tr>
                              @endforeach
                          </tbody>
                        </table>

                        @endif

                      </div>

                    </div>
                  </div>



                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                    <button type="button" class="btn bg-primary PiyasaEtiketOlusturSubmit">Kaydet</button>
                </div>
            </div>
        </div>
    </div>
    <!-- /basic modal -->
</form>

{!! JsValidator::formRequest('App\Http\Requests\Depo\PiysaEtiketOlusturRequest', '#PiyasaEtiketOlusturForm'); !!}




<script type="text/javascript">
    $(".PiyasaEtiketOlusturButon").click(function(){

        if($("#PiyasaEtiketOlusturForm").valid()){
        var data = $("#PiyasaEtiketOlusturForm").serialize();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            });
        $.ajax({
                method    : "POST",
                url       : "{{ url('depo/etiket/PiyasaEtiketOlustur') }}",
                data      : data,
                dataType  : "JSON",
            })
        .done(function(response) {
            
            $("#PiyasaEtiketOlusturResponse").html(response.urun_listesi);

                new PNotify({
                    title: response.title,
                    text: response.text,
                    addclass: 'alert bg-'+response.type+' border-'+response.type+' alert-styled-left'
                });

            })
        .fail(function(response){

            new PNotify({
                title: 'Hay Aksi!..',
                text: 'Ters giden birşeyler var :(' ,
                addclass: 'alert bg-danger border-danger alert-styled-left'
            });
            console.log("Hata: ", response);

        });
        }
    });
</script>

