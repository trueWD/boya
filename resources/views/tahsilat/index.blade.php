@extends('layouts.app')
@section('breadcrumb')
	<div class="breadcrumb">
       <a href="{{ url('home') }}" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> ANA SAYFA</a>
        <span class="breadcrumb-item active"><i class="icon-basket mr-2"></i> SATIŞ</span>
    </div>
@endsection
@section('content')
@include('tahsilat.create')

<div class="card">
    <div class="card-header">
        <h6 class="card-title">MÜŞTERİ ARAMA</h6>
    </div>
    
    <div class="card-body">
        <form id="BorcListesiForm">
            <div class="form-group row">
                <label class="col-lg-3 col-form-label text-right">MÜŞTERİ ADI:</label>
                <div class="col-lg-9">
                    <select class="js-example-basic-single js-states form-control select cariid text-primary" name="cariid" id="cariid"></select>
                </div>
            </div>
        </form>
    </div>
</div>

<div id="BorcListesiResponse">
    
    <div class="card">
        <div class="card-header">
            <h6 class="card-title">BORÇ LİSTESİ</h6>
        </div>
        
        <div class="card-body">
        
            <div class="alert alert-warning alert-styled-left alert-dismissible">
                <button type="button" class="close" data-dismiss="alert"><span>×</span></button>
                <span class="font-weight-semibold">NOT! </span> Lütfen önce bir cari arayın.
            </div>


        </div>
    </div>

</div>





<!-- 
____________________________________________________________________________________________
Cari Arama
____________________________________________________________________________________________
-->
<script>
$.fn.modal.Constructor.prototype._enforceFocus = function() {};
$(document).ready(function(){
    $('#cariid').select2({
        ajax : {
            url : "{{ url('api/musteri') }}",
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


$('#cariid').on('select2:select', function (e) {
    var data = e.params.data;
    $(".cariid_yakala").val(data.id);
});

</script>

<!-- 
____________________________________________________________________________________________
Cari Borcu Listele
____________________________________________________________________________________________
-->

<script type="text/javascript">
$("#BorcListesiForm .cariid" ).change(function() {
    
    var data = $("#BorcListesiForm").serialize();
    

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
        });

    $.ajax({
            method    : "POST",
            url       : "{{ url('tahsilat/BorcListesi') }}",
            data      : data,
            dataType  : "JSON",
        })
    .done(function(response) {
        
        $("#BorcListesiResponse").html(response.BorcListesi);

        new PNotify({
            title: response.title,
            text: response.text,
            addclass: 'alert bg-'+response.type+' border-'+response.type+' alert-styled-left'
        });

     })
    .fail(function(response) {

        console.log("Hata: ", response);

    });
});
</script>
<!-- 
____________________________________________________________________________________________
Borç Kapat
____________________________________________________________________________________________
-->
<script type="text/javascript">
    $(document).on('click', '.BorcKapatButton', function (e) {
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
                    url       : "{{ url('tahsilat/BorcKapat') }}",
                    data      : {"id":id},
                    dataType  : "JSON",
                })
            .done(function(response) {
                
                $("#BorcListesiResponse").html(response.BorcListesi);
                new PNotify({
                    title: response.title,
                    text: response.text,
                    addclass: 'alert bg-'+response.type+' border-'+response.type+' alert-styled-left'
                });

            })
            .fail(function(response) {

                console.log("Hata: ", response);

            });
            //return false;

    });
</script>
<!-- 
____________________________________________________________________________________________
Fiyat Güncelle
____________________________________________________________________________________________
-->
<script type="text/javascript">
    $(document).on('click', '.FiyatGuncelleButton', function (e) {
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
                    url       : "{{ url('tahsilat/FiyatGuncelle') }}",
                    data      : {"id":id},
                    dataType  : "JSON",
                })
            .done(function(response) {
                
                $("#BorcListesiResponse").html(response.BorcListesi);
                new PNotify({
                    title: response.title,
                    text: response.text,
                    addclass: 'alert bg-'+response.type+' border-'+response.type+' alert-styled-left'
                });

            })
            .fail(function(response) {

                console.log("Hata: ", response);

            });
            //return false;

    });
</script>

<!-- 
____________________________________________________________________________________________
Tahsilat Girişi
____________________________________________________________________________________________
-->


{!! JsValidator::formRequest('App\Http\Requests\Tahsilat\YeniTahsilatRequest', '#YeniTahsilatForm'); !!}

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
                       $("#BorcListesiResponse").html(response.BorcListesi);

                       $('#YeniTahsilatModal').modal('hide');

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


@endsection