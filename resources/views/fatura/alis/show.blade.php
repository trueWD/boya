@extends('layouts.app')
@section('breadcrumb')
	<div class="breadcrumb">
        <a href="{{ url('home') }}" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Ana Sayfa</a>
        <a href="{{ url('fatura/alis') }}" class="breadcrumb-item">Alış Faturaları</a>
        <span class="breadcrumb-item active">{{ $fatura->cari->cariadi }} | {{ $fatura->faturano }} </span>
    </div>
@endsection
@section('content')
<div id="UrunEditResponse"></div>
<!-- BEGIN FORM -->


    <!-- Column selectors -->
    <div class="card">
        <div class="card-header header-elements-inline">
            <h5 class="card-title">ALIŞ FATURASI : <span class="text-danger">{{ $fatura->faturano }}</span></h5>
            <div class="header-elements">
                <div class="list-icons">
                    <a class="list-icons-item" data-action="collapse"></a>
                </div>
            </div>
        </div>

        <div class="card-body">


        
            @if($fatura->durumu =='AKTIF')

            <form id="UrunEkleForm">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <select class="js-example-basic-single js-states form-control select urunid text-primary" name="urunid" id="urunid"></select>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <input type="text" name="miktar" id="miktar" class="form-control" placeholder="Miktar">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <input type="text" name="fiyat" id="fiyat" class="form-control" placeholder="Alış Fiyaı">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <input type="text" name="kdv" id="kdv" class="form-control" placeholder="KDV">
                    </div>
                </div>
                <div class="col-md-2">
                    <button type="button" class="btn btn-success UrunEkleSubmit"><i class="icon-plus3"></i> Ekle</button>
                    <input type="hidden" name="faturaid" value="{{ $fatura->id }}">
                </div>

            </div>               
        </form>
        @endif

        <div id="UrunListesiResponse">   

            @if ($fatura->durumu !='AKTIF')

                <button type="button" class="btn btn-primary FaturaGeriAl" id="{{ $fatura->id }}"><i class="icon-rotate-ccw3"></i> Faturayı Geri Al</button>
                
            @else

                @if(count($urunler) !=0)
                    <button type="button" class="btn btn-primary FaturaKapat" id="{{ $fatura->id }}"><i class="icon-plus3"></i> Faturayı Kapat</button>
                @endif
                
            @endif

    
        
        <hr>

            <table class="table table-striped table-bordered table-hover table-sm">
                <thead>
                    <tr>
                        @if($fatura->durumu =='AKTIF')
                        <th>#</th>
                        @endif
                        <th>Ürün Adı</th>   
                        <th>Miktar</th>   
                        <th>Fiyat</th>
                        <th>Ara Toplam</th>
                        <th>KDV</th>
                        <th>KDV Tutar</th>
                        <th>Toplam</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                       $kdv_genel_toplam = 0;
                       $kdv_dahil_genel_toplam  = 0;
                       $tutar_toplam  = 0;
                    @endphp
                    @foreach($urunler as $row)
                    <tr>
                         @if($fatura->durumu =='AKTIF')
                        <td>
                            <div class="dropdown">
                                <a href="#" class="badge dropdown-toggle badge-primary badge-icon " data-toggle="dropdown"><i class="icon-menu7"></i></a>

                                <div class="dropdown-menu dropdown-menu-left">

                                <a href="#" class="dropdown-item UrunEdit" id="{{ $row->id }}">
                                    <span class="badge badge-mark mr-2 border-primary"></span>
                                Ürünü Düzenle
                                </a>
                                <a href="#" class="dropdown-item UrunDelete" id="{{ $row->id }}">
                                    <span class="badge badge-mark mr-2 border-primary"></span>
                                Ürünü Sil
                                </a>

                                </div>
                            </div>
                        </td>
                        @endif


                        <td>{{ $row->urun->urunadi }}</td>
                        <td>{{ para($row->miktar) }}</td>
                        <td>{{ para($row->fiyat) }} TL</td>
                        <td>{{ para($row->tutar) }}</td>
                        <td>{{ para($row->kdv) }}</td>
                        <td>{{ para($row->kdv_tutar) }}</td>
                        <td>{{ para($row->kdv_dahil) }}</td>
                    </tr>

                    @php
                       $kdv_genel_toplam = $kdv_genel_toplam + $row->kdv_tutar;
                       $kdv_dahil_genel_toplam = $kdv_dahil_genel_toplam + $row->kdv_dahil;
                       $tutar_toplam = $tutar_toplam + $row->tutar;
                    @endphp
                    @endforeach
                </tbody>
            </table>

            <hr>

              <div class="row">
                <div class="col-md-6 col align-self-end">
                <table class="table table-bordered table-hover">
                    <tbody>
                    <tr>
                        <td class="text-right">TOPLAM</td>
                        <td class="table-success text-right"><b>{{ para($tutar_toplam) }}</b> TL</td>
                    </tr>
                    <tr>
                        <td class="text-right">KDV</td>
                        <td class="table-success text-right"><b>{{ para($kdv_genel_toplam) }}</b> TL</td>
                    </tr>
                    <tr>
                        <td class="text-right">GENEL TOPLAM</td>
                        <td class="table-danger text-right"><b>{{ para($kdv_dahil_genel_toplam) }}</b> TL</td>
                    </tr>
                    </tbody>
                </table>
                </div>
            </div>



            </div> 


        </div>
    </div>
    <!-- /column selectors -->


<!-- 
____________________________________________________________________________________________
Ürün Kaydet
____________________________________________________________________________________________
-->
{!! JsValidator::formRequest('App\Http\Requests\Fatura\AlisUrunEkleRequest', '#UrunEkleForm'); !!}

<script type="text/javascript">
  new AutoNumeric('#UrunEkleForm #fiyat', {
      decimalCharacter : ',',
      digitGroupSeparator : '.',
      modifyValueOnWheel	: false,
  });
</script>

<script type="text/javascript">
$(document).on('click', '.UrunEkleSubmit', function(e){
e.preventDefault();
    if($("#UrunEkleForm").valid())
      {
          var data = $("#UrunEkleForm").serialize();

          $.ajaxSetup({
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
            });
          $.ajax({
                  method    : "POST",
                  url       : "{{ url('fatura/alis/UrunEkle') }}",
                  data      : data,
                  dataType  : "JSON",
                  })
              .done(function(response) {  
                  if(response.type == 'success'){


                      
                      $("#UrunListesiResponse").html(response.urun_listesi);

                    new PNotify({
                        title: response.title,
                        text: response.text,
                        addclass: 'alert bg-'+response.type+' border-'+response.type+' alert-styled-left'
                    });
                    }else{

                    new PNotify({
                        title: response.title,
                        text: response.text,
                        addclass: 'alert bg-'+response.type+' border-'+response.type+' alert-styled-left'
                    });
                    }
                  }).fail(function(response){

                  new PNotify({
                      title: 'Hata!',
                      text: 'Ters giden birşeyler var :(' ,
                      addclass: 'alert bg-danger border-danger alert-styled-left'
                  });
   
                });
      }
});
</script>
<!-- 
____________________________________________________________________________________________
Ürün Arama
____________________________________________________________________________________________
-->
<script>
$.fn.modal.Constructor.prototype._enforceFocus = function() {};
$(document).ready(function(){
    $('#urunid').select2({
        ajax : {
            url : "{{ url('api/urunGetir') }}",
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
            if(repo.loading) return repo.urunadi;
            var markup = repo.urunadi;
            return markup;
        },
        templateSelection : function(repo)
        {
            return repo.urunadi;
        },
        escapeMarkup : function(markup){ return markup; }
    });
});

</script>
<!-- 
____________________________________________________________________________________________
Fatura Kapat
____________________________________________________________________________________________
-->
<script type="text/javascript">
$(document).on('click', '.FaturaKapat', function(e){
e.preventDefault();

  const swalWithBootstrapButtons = Swal.mixin({
      customClass: {
        confirmButton: 'btn btn-success',
        cancelButton: 'btn btn-danger',
      },
      buttonsStyling: false,
    })

    swalWithBootstrapButtons.fire({
      title: 'Dikkat!',
      text: "Fatura Kapatılmısnmı?",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Evet Kapat!',
      cancelButtonText: 'Hayır!',
      reverseButtons: true
    }).then((result) => {
      if (result.value) {

    var id = $(this).attr("id");
    $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

    $.ajax({
            method    : "POST",
            url       : "{{ url('fatura/alis/FaturaKapat') }}",
            data      : {"id":id},
            dataType  : "JSON",
            })
        .done(function(response) {
            console.log("Dönen Sonuç: ", response.responseJSON);
            if(response.type == 'success'){

              Swal.fire({
                  confirmButton: 'btn btn-success',
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
                    confirmButton: 'btn btn-success',
                    title: response.title,
                    text: response.text,
                    icon: response.type,
                    confirmButtonText: 'Tamam'
                  });
              }
            }).fail(function(response){
              Swal.fire({
                    
                  title: 'HATA!',
                  text: 'Sistemsel bir hata oluştur lütfen logları inceleyin',
                  icon: 'error',
                  confirmButtonText: 'Tamam',
                  confirmButton: 'btn btn-success',
                });
          });

      }
    });
});
</script>
<!-- 
____________________________________________________________________________________________
Fatura Geri AL
____________________________________________________________________________________________
-->
<script type="text/javascript">
$(document).on('click', '.FaturaGeriAl', function(e){
e.preventDefault();

  const swalWithBootstrapButtons = Swal.mixin({
      customClass: {
        confirmButton: 'btn btn-success',
        cancelButton: 'btn btn-danger',
      },
      buttonsStyling: false,
    })

    swalWithBootstrapButtons.fire({
      title: 'Dikkat!',
      text: "Fatura Geri Alınsınmı?",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Evet Geri Al!',
      cancelButtonText: 'Hayır!',
      reverseButtons: true
    }).then((result) => {
      if (result.value) {

    var id = $(this).attr("id");
    $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

    $.ajax({
            method    : "POST",
            url       : "{{ url('fatura/alis/FaturaGeriAl') }}",
            data      : {"id":id},
            dataType  : "JSON",
            })
        .done(function(response) {
            console.log("Dönen Sonuç: ", response.responseJSON);
            if(response.type == 'success'){

              Swal.fire({
                  confirmButton: 'btn btn-success',
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
                    confirmButton: 'btn btn-success',
                    title: response.title,
                    text: response.text,
                    icon: response.type,
                    confirmButtonText: 'Tamam'
                  });
              }
            }).fail(function(response){
              Swal.fire({
                    
                  title: 'HATA!',
                  text: 'Sistemsel bir hata oluştur lütfen logları inceleyin',
                  icon: 'error',
                  confirmButtonText: 'Tamam',
                  confirmButton: 'btn btn-success',
                });
          });

      }
    });
});
</script>
<!-- 
____________________________________________________________________________________________
Ürün Sil
____________________________________________________________________________________________
-->
<script type="text/javascript">
$(document).on('click', '.UrunDelete', function(e){
e.preventDefault();

  const swalWithBootstrapButtons = Swal.mixin({
      customClass: {
        confirmButton: 'btn btn-success',
        cancelButton: 'btn btn-danger',
      },
      buttonsStyling: false,
    })

    swalWithBootstrapButtons.fire({
      title: 'Dikkat!',
      text: "Bu kaydı silmek istediğinizden eminmisiniz?",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Evet Sil!',
      cancelButtonText: 'Hayır!',
      reverseButtons: true
    }).then((result) => {
      if (result.value) {

    var id = $(this).attr("id");
    $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

    $.ajax({
            method    : "POST",
            url       : "{{ url('fatura/alis/UrunSil') }}",
            data      : {"id":id},
            dataType  : "JSON",
            })
        .done(function(response) {
            console.log("Dönen Sonuç: ", response.responseJSON);
            if(response.type == 'success'){

              Swal.fire({
                  confirmButton: 'btn btn-success',
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
                    confirmButton: 'btn btn-success',
                    title: response.title,
                    text: response.text,
                    icon: response.type,
                    confirmButtonText: 'Tamam'
                  });
              }
            }).fail(function(response){
              Swal.fire({
                    
                  title: 'HATA!',
                  text: 'Sistemsel bir hata oluştur lütfen logları inceleyin',
                  icon: 'error',
                  confirmButtonText: 'Tamam',
                  confirmButton: 'btn btn-success',
                });
          });

      }
    });
});
</script>
<!-- 
____________________________________________________________________________________________
Ürün Edit
____________________________________________________________________________________________
-->
<script type="text/javascript">
    $(document).on('click', '.UrunEdit', function (e) {
        e.preventDefault();
        //var id = $(this).data('id');

            var id = $(this).attr("id");

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                });

            $.ajax({
                    method    : "POST",
                    url       : "{{ url('fatura/alis/UrunEdit') }}",
                    data      : {"id":id},
                    dataType  : "JSON",
                })
            .done(function(response) {
                
                $("#UrunEditResponse").html(response.UrunEdit);
                $('#UrunEditModal').modal('show');

                })
            .fail(function(response) {

                console.log("Hata: ", response);

                });
            //return false;

    });
</script>
























































@endsection