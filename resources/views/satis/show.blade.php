@extends('layouts.app')
@section('breadcrumb')
	<div class="breadcrumb">
        <a href="{{ url('home') }}" class="breadcrumb-item"><i class="icon-home2 mr-2"></i>ANA SAYFA</a>
        <a href="{{ url('satis') }}" class="breadcrumb-item"><i class="icon-basket mr-2"></i>SICAK SATIŞ</a>
        <span class="breadcrumb-item active">FİŞ : {{ $siparis01->id }}</span>
    </div>
@endsection
@section('content')

<div class="row">

    @if($siparis01->durumu =='AKTIF')
    <div class="col-md-7">
        <div class="card">
            <div class="card-header">
                <h6 class="card-title">SATIŞ NO: <span class="text-danger">{{ $siparis01->id }}</span></h6>
            </div>
            
            <div class="card-body">

                <form id="BarkodOkuForm">

                    
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label">ÜRÜN BARKODU:</label>
                        <div class="col-lg-6">
                            <input type="text" class="form-control" name="barkod" id="barkod" placeholder="Barkod" autocomplete="off" autofocus>
                        </div>
                        <div class="col-lg-3">
                            <input type="hidden" name="id" value="{{ $siparis01->id }}">
                            <button type="button" class="btn btn-primary BarkodOkuSubmit"><i class="icon-checkmark mr-1 icon-1x"></i> EKLE</button>
                        </div>
                    </div>

                </form>
                <form id="UrunGirisForm">
 
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label">ÜRÜN ARAMA:</label>
                        <div class="col-lg-6">
                            <select class="js-example-basic-single js-states form-control select urunid text-primary" name="urunid" id="urunid"></select>
                        </div>
                        <div class="col-lg-3">
                            <input type="hidden" name="id" value="{{ $siparis01->id }}">
                            <button type="button" class="btn btn-warning UrunGirisSubmit"><i class="icon-checkmark mr-1 icon-1x"></i> EKLE</button>
                        </div>
                    </div>

                </form>

            </div>
        </div>
    </div>



    <div class="col-md-5">
     

        <div class="card">
            <div class="card-header bg-transparent border-bottom pb-0 pt-sm-0 header-elements-sm-inline">
                <div class="header-elements">
                    <ul class="nav nav-tabs nav-tabs-highlight card-header-tabs">
                        <li class="nav-item">
                            <a href="#card-tab1" class="nav-link active" data-toggle="tab">
                                <i class="icon-cash3 mr-2"></i>
                                NAKİT
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#card-tab2" class="nav-link" data-toggle="tab">
                                <i class="icon-credit-card mr-2"></i>
                                KART
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#card-tab3" class="nav-link" data-toggle="tab">
                                <i class="icon-notebook mr-2"></i>
                                VERESİYE
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            
            <div class="card-body tab-content">
                <div class="tab-pane fade show active" id="card-tab1">
                    
            @php
                $genel_toplam =0;
                @endphp
               @foreach($siparis02 as $row)
                @php 
                   $toplam             = $row->fiyat * $row->miktar;
                    $iskontoTutar       = $toplam * ($row->iskonto / 100);
                    $iskontoluToplam    = $toplam - $iskontoTutar;
                    $kdvMiktar          = $iskontoluToplam * ($row->kdv / 100);
                    $kdvDahil           = $iskontoluToplam + $kdvMiktar;

                    $genel_toplam = $genel_toplam + $kdvDahil;
                @endphp
               
               
                @endforeach
                    <form id="NakitKapatForm">

                   
                    <button type="button" class="btn btn-success NakitKapatSubmit"><i class="icon-cash3 mr-1"></i> NAKİT ÖDEME</button>
                    <button type="button" class="btn btn-danger FisIptalButton" id="{{ $siparis01->id }}"><i class="icon-trash mr-1"></i> FİŞ İPTAL</button>
                    <input type="hidden" name="id" value="{{ $siparis01->id }}">
                    <hr>
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td>
                                        <h3 class="">TOPLAM</h3>
                                    </td>

                                    <td>
                                        <h3 class="text-right text-primary"><b>{{ para($genel_toplam) }} TL</b></h3>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h3 class="">ÖDENEN</h3>
                                    </td>

                                    <td class="text-right">

                                        <input type="text" class="form-control  text-success text-right" style="font-size: 24px;" id="odenen" name="odenen" autocomplete="off">
                                        
                                        
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h3 class="">PARA ÜSTÜ</h3>
                                    </td>

                                    <td>
                                        <h3 class="text-right"><b><div id="sonuc"><span class="text-danger">{{ para($genel_toplam) }} TL</span></div></b></h3>
                                    </td>
                                </tr>

 
                            </tbody>
                        </table>

                         
                    </div>

                </form>

                </div>

                <div class="tab-pane fade" id="card-tab2">
                    


                    <form id="KartKapatForm">

                    
                        <button type="button" class="btn btn-success KartKapatSubmit"><i class="icon-credit-card mr-1"></i> KART ÖDEME</button>
                        <button type="button" class="btn btn-danger FisIptalButton" id="{{ $siparis01->id }}"><i class="icon-trash mr-1"></i> FİŞ İPTAL</button>
                        <input type="hidden" name="id" value="{{ $siparis01->id }}">
                        <hr>
                        <div class="table-responsive">

                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td>
                                            BANKA
                                        </td>
                                        <td>
                                            <select class="form-control" name="banka01">
                                                @foreach ($banka01 as $row)
                                                   <option value="{{ $row->id }}">{{ $row->adi }} - {{ $row->sube }}</option>  
                                                @endforeach
                                               
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h3 class="">TOPLAM</h3>
                                        </td>

                                        <td>
                                            <h3 class="text-right text-primary"><b>{{ para($genel_toplam) }} TL</b></h3>
                                        </td>
                                    </tr>
    
                                </tbody>
                            </table>

                            
                        </div>

                    </form>







                </div>

                <div class="tab-pane fade" id="card-tab3">

                    <form id="VeresiyeKapatForm">

                    
                        <button type="button" class="btn btn-success VeresiyeKapatSubmit"><i class="icon-notebook mr-1"></i> VERESİYE YAZ</button>
                        <button type="button" class="btn btn-danger FisIptalButton" id="{{ $siparis01->id }}"><i class="icon-trash mr-1"></i> FİŞ İPTAL</button>
                        <input type="hidden" name="id" value="{{ $siparis01->id }}">
                        <hr>
                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td>
                                            MÜŞTERİ
                                        </td>
                                        <td class="col-md-8">
                                            <select class="js-example-basic-single js-states form-control select cariid text-primary" name="cariid" id="cariid"></select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            ANLAŞMA
                                        </td>
                                        <td class="col-md-8">
                                            <select class="form-control" name="anlasma">
                                                <option value="GUNCEL">GÜNCEL FİYAT</option>  
                                                <option value="SABIT">SABİT FİYAT</option>  
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            ÖDEME TARİHİ
                                        </td>
                                        <td class="col-md-8">
                                          
                                            <div class="input-group">
                                            <span class="input-group-prepend">
                                                <span class="input-group-text"><i class="icon-calendar"></i></span>
                                            </span>
                                            <input type="text" data-value="<?php echo date("Y-m-d",time()); ?>" name="tarih_vade" class="form-control tarih_vade">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h3 class="">TOPLAM</h3>
                                        </td>

                                        <td>
                                            <h3 class="text-right text-primary"><b>{{ para($genel_toplam) }} TL</b></h3>
                                        </td>
                                    </tr>
    
                                </tbody>
                            </table>

                            
                        </div>

                    </form>

                </div>

            </div>

    
            
        </div>


    </div>
    @else


        <div class="col-md-12">
            <div class="alert alert-info alert-styled-left alert-dismissible">
                <button type="button" class="close" data-dismiss="alert"><span>×</span></button>
                <span class="font-weight-semibold">BİLGİ!</span> Bu sipariş <b>{{ $siparis01->odemetipi }}</b> olarak kapatılmış...
            </div>  
        </div>
 

    @endif
    

</div>





<div class="card">
    <div class="card-header bg-transparent border-bottom pb-0 pt-sm-0 header-elements-sm-inline">
        <div class="header-elements">
            <ul class="nav nav-tabs nav-tabs-highlight card-header-tabs">
                <li class="nav-item">
                    <a href="#urun-tab1" class="nav-link active" data-toggle="tab">
                        <i class="icon-cash3 mr-2"></i>
                        MÜŞTERİ
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#urun-tab2" class="nav-link" data-toggle="tab">
                        <i class="icon-credit-card mr-2"></i>
                        PATRON
                    </a>
                </li>
            </ul>
        </div>
    </div>
    
    <div class="card-body tab-content">
        <div class="tab-pane fade show active" id="urun-tab1">

        @if($siparis01->durumu=='TAMAM')
        <a href="{{ url('satis/FisYazdir/'.$siparis01->id) }}" target="_blank" class="btn bg-purple-400"><i class="icon-printer mr-1"></i> YAZDIR</a>
        <a href="{{ url('satis/store') }}" type="button" class="btn btn-primary"><i class="icon-basket  mr-1php artisan ma"></i> Yeni Satış</a>
        @endif

        <table class="table table-striped table-bordered table-hover myDataTable1">
            <thead>
                <tr>
                    
                    @if($siparis01->durumu=='AKTIF')
                        <th>#</th>
                    @endif
                    <th>BARKOD</th>
                    <th>ÜRÜN</th>
                    <th>M. ADET</th>
                    <th>FİYAT</th>
                    <th>TOPLAM</th>
                    <th>İSKONTO</th>
                    <th>KDV</th>
                    <th>G TOPLAM</th>
                    @if($siparis01->durumu=='AKTIF')
                        <th>SİL</th>
                    @endif
                    
                </tr>
            </thead>
            <tbody>
                @php
                    $kdvDahilToplam = 0;
                    $kdvMiktarToplam = 0;
                    $iskontoTutarToplam = 0;    
                    $araToplam = 0;    
                @endphp
                @foreach($siparis02 as $row)
                @php 
                    $toplam             = $row->fiyat * $row->miktar;
                    $iskontoTutar       = $toplam * ($row->iskonto / 100);
                    $iskontoluToplam    = $toplam - $iskontoTutar;
                    $kdvMiktar          = $iskontoluToplam * ($row->kdv / 100);
                    $kdvDahil           = $iskontoluToplam + $kdvMiktar;

                    $kdvDahilToplam     = $kdvDahilToplam + $kdvDahil;
                    $kdvMiktarToplam    = $kdvMiktarToplam + $kdvMiktar;
                    $iskontoTutarToplam = $iskontoTutarToplam + $iskontoTutar;
                    $araToplam          = $araToplam + $toplam;
                @endphp
                <tr>

                    @if($siparis01->durumu=='AKTIF')
                    <td>
                        <button type="button" class="btn btn-success btn-sm UrunArtirButton" id="{{ $row->id }}"><i class="icon-plus2"></i></button>
                        <button type="button" class="btn btn-warning btn-sm UrunAzaltButton" id="{{ $row->id }}"><i class="icon-minus2"></i></button>
                    </td>
                    @endif
                    
                    <td>{{ $row->urunbilgisi->barkod }}</td>
                    <td>{{ $row->urunbilgisi->urunadi }}</td>
                    <td class="text-right">{{ para($row->miktar) }}</td>
                    <td class="text-right">{{ para($row->fiyat) }}</td>
                    <td class="text-right">{{ para($toplam) }}</td>
                    <td class="text-right">{{ para($iskontoluToplam) }} (%{{ $row->iskonto }})</td>
                    <td class="text-right">{{ para($kdvMiktar) }} (%{{ $row->kdv }})</td>
                    <td class="text-right">{{ para($kdvDahil) }}</td>

                    @if($siparis01->durumu=='AKTIF')
                    <td>
                        <button type="button" class="btn btn-danger btn-sm UrunSilButton" id="{{ $row->id }}"><i class="icon-trash"></i></button>
                    </td>
                    @endif
                    

                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="row">
          <div class="col-md-6 col align-self-end">
            <table class="table table-bordered table-hover">
              <tbody>
                <tr>
                  <td class="text-right">Toplam Tutar</td>
                  <td class="table-primary text-right"><b>{{ para($araToplam) }} TL</b></td>
                </tr>
                <tr>
                  <td class="text-right">Toplam İskhtonto</td>
                  <td class="table-success text-right"><b>{{ para($iskontoTutarToplam) }} TL</b></td>
                </tr>
                <tr>
                  <td class="text-right">Toplam KDV</td>
                  <td class="table-warning text-right"><b>{{ para($kdvMiktarToplam) }} TL</b></td>
                </tr>
                <tr>
                  <td class="text-right">Genel Toplam</td>
                  <td class="table-danger text-right"><b>{{ para($kdvDahilToplam) }} TL</b></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>



        </div>

        <div class="tab-pane fade" id="urun-tab2">
            This is the second card tab content
        </div>

    </div>
</div>








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

</script>
<!-- 
____________________________________________________________________________________________
Barkod Okuma
____________________________________________________________________________________________
-->
<script type="text/javascript">
$(document).on('click', '.BarkodOkuSubmit', function(e){
e.preventDefault();
 
var data = $("#BarkodOkuForm").serialize();

$.ajaxSetup({
    headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$.ajax({
        method    : "POST",
        url       : "{{ url('satis/BarkodOku') }}",
        data      : data,
        dataType  : "JSON",
        })
    .done(function(response) {  
        if(response.type == 'success'){

            new PNotify({
                title: response.title,
                text: response.text,
                addclass: 'alert bg-'+response.type+' border-'+response.type+' alert-styled-left'
            });



            setTimeout(function(){
                location.reload(); 
            }, 1000); 



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
});
</script>
<!-- 
____________________________________________________________________________________________
Ürün Adı Okuma
____________________________________________________________________________________________
-->
<script type="text/javascript">
$(document).on('click', '.UrunGirisSubmit', function(e){
e.preventDefault();
 
var data = $("#UrunGirisForm").serialize();

$.ajaxSetup({
    headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$.ajax({
        method    : "POST",
        url       : "{{ url('satis/UrunGiris') }}",
        data      : data,
        dataType  : "JSON",
        })
    .done(function(response) {  
        if(response.type == 'success'){

            new PNotify({
                title: response.title,
                text: response.text,
                addclass: 'alert bg-'+response.type+' border-'+response.type+' alert-styled-left'
            });

            setTimeout(function(){
                location.reload(); 
            }, 1000); 



        }else{

            new PNotify({
                title: response.title,
                text: response.text,
                addclass: 'alert bg-'+response.type+' border-'+response.type+' alert-styled-left'
            });

            setTimeout(function(){
                location.reload(); 
            }, 1000); 

        }
        }).fail(function(response){

        new PNotify({
            title: 'Hata!',
            text: 'Ters giden birşeyler var :(' ,
            addclass: 'alert bg-danger border-danger alert-styled-left'
        });

    });
});
</script>


@if($siparis01->durumu =='AKTIF')
<!-- 
____________________________________________________________________________________________
Nakit Ödeme
____________________________________________________________________________________________
-->
<script type="text/javascript">
$( "#odenen" ).keyup(function() {

    var odenen = Number($( "#odenen" ).val());
    var tutar = Number('{{ $genel_toplam }}');
    var paraustu = odenen -  tutar;

    if(paraustu > 0){
        var sonuc = '<span class="text-success">'+  new Intl.NumberFormat('tr-TR').format(paraustu) +' TL</span>';
    }else{
        var sonuc = '<span class="text-danger">'+  new Intl.NumberFormat('tr-TR').format(paraustu) +' TL</span>';
    }
    $("#sonuc").html(sonuc);
 
});
</script>

<script type="text/javascript">
$(document).on('click', '.NakitKapatSubmit', function(e){
e.preventDefault();
    if($("#NakitKapatForm").valid())
      {
          var data = $("#NakitKapatForm").serialize();

          $.ajaxSetup({
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
            });
          $.ajax({
                method    : "POST",
                url       : "{{ url('satis/NakitKapat') }}",
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
<!-- 
____________________________________________________________________________________________
Kart Ödeme
____________________________________________________________________________________________
-->

<script type="text/javascript">
$(document).on('click', '.KartKapatSubmit', function(e){
e.preventDefault();
    if($("#KartKapatForm").valid())
      {
          var data = $("#KartKapatForm").serialize();

          $.ajaxSetup({
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
            });
          $.ajax({
                method    : "POST",
                url       : "{{ url('satis/KartKapat') }}",
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
<!-- 
____________________________________________________________________________________________
Veresiye Ödeme
____________________________________________________________________________________________
-->
{!! JsValidator::formRequest('App\Http\Requests\Satis\VeresiyeKapatRequest', '#VeresiyeKapatForm'); !!}
<script type="text/javascript">
$('#VeresiyeKapatForm .tarih_vade').pickadate();

$(document).on('click', '.VeresiyeKapatSubmit', function(e){
e.preventDefault();
    if($("#VeresiyeKapatForm").valid())
      {
          var data = $("#VeresiyeKapatForm").serialize();

          $.ajaxSetup({
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
            });
          $.ajax({
                method    : "POST",
                url       : "{{ url('satis/VeresiyeKapat') }}",
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
<!-- 
___________________________________________________________________________________________________
Ürün Artırma
___________________________________________________________________________________________________
-->
<script type="text/javascript">

    $(document).on('click', '.UrunArtirButton', function (e) {
    e.preventDefault();

    var id = $(this).attr("id");

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
        });

    $.ajax({
        method    : "POST",
        url       : "{{ url('satis/UrunArtir') }}",
        data      : {"id":id},
        dataType  : "JSON",
    })
    .done(function(response) {

        
        new PNotify({
            title: response.title,
            text: response.text,
            addclass: 'alert bg-primary border-success alert-styled-left'
        });

        setTimeout(function(){
            location.reload(); 
        }, 1000); 
    })
  .fail(function(response) {

    console.log("Hata: ", response);

    });           
});

</script>
<!-- 
___________________________________________________________________________________________________
Fiş İptal
___________________________________________________________________________________________________
-->
<script type="text/javascript">

    $(document).on('click', '.FisIptalButton', function (e) {
    e.preventDefault();

    var id = $(this).attr("id");

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
        });

    $.ajax({
        method    : "POST",
        url       : "{{ url('satis/FisIptal') }}",
        data      : {"id":id},
        dataType  : "JSON",
    })
    .done(function(response) {

        
        new PNotify({
            title: response.title,
            text: response.text,
            addclass: 'alert bg-primary border-success alert-styled-left'
        });

        setTimeout(function(){
            window.location.replace("{{ url('satis') }}"); 
        }, 1000); 
    })
  .fail(function(response) {

    console.log("Hata: ", response);

    });           
});

</script>
<!-- 
___________________________________________________________________________________________________
Ürün Azaltma
___________________________________________________________________________________________________
-->
<script type="text/javascript">

    $(document).on('click', '.UrunAzaltButton', function (e) {
    e.preventDefault();

    var id = $(this).attr("id");

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
        });

    $.ajax({
        method    : "POST",
        url       : "{{ url('satis/UrunAzalt') }}",
        data      : {"id":id},
        dataType  : "JSON",
    })
    .done(function(response) {

        
        new PNotify({
            title: response.title,
            text: response.text,
            addclass: 'alert bg-primary border-success alert-styled-left'
        });

        setTimeout(function(){
            location.reload(); 
        }, 1000); 
    })
  .fail(function(response) {

    console.log("Hata: ", response);

    });           
});

</script>
<!-- 
___________________________________________________________________________________________________
Ürün SİLME
___________________________________________________________________________________________________
-->
<script>
    $(document).on('click', '.UrunSilButton', function(){

      const swalWithBootstrapButtons = Swal.mixin({
      customClass: {
        confirmButton: 'btn btn-success',
        cancelButton: 'btn btn-danger'
      },
      buttonsStyling: false,
    })

    swalWithBootstrapButtons.fire({
      title: 'Dikkat!',
      text: "Ürün listeden silinsin mi?",
      type: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Evet, Sil',
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
            url       : "{{ url('satis/UrunSil') }}",
            data      : {"id":id},
            dataType  : "JSON",
            })
        .done(function(response) {
            console.log("Dönen Sonuç: ", response.responseJSON);
            if(response.type == 'success'){

              Swal.fire({
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger',
                    title: response.title,
                    text: response.text,
                    type: response.type,
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
                    cancelButton: 'btn btn-danger',
                    title: response.title,
                    text: response.text,
                    type: response.type,
                    confirmButtonText: 'Tamam'
                  });
              }
            }).fail(function(response){
              Swal.fire({
                  confirmButton: 'btn btn-success',
                  cancelButton: 'btn btn-danger',
                  title: 'HATA!',
                  text: 'Sistemsel bir hata oluştur lütfen logları inceleyin',
                  type: 'error',
                  confirmButtonText: 'Tamam'
                });
          });

      }
    });
    return false;

    });
</script>
@endif






<script type="text/javascript">
    $(document).on('click', '.CariEdit', function (e) {
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
                    url       : "{{ url('cari/edit') }}",
                    data      : {"id":id},
                    dataType  : "JSON",
                })
            .done(function(response) {
                
                $("#CariEditResponse").html(response.cariedit);
                $('#CariEditModal').modal('show');

                })
            .fail(function(response) {

                console.log("Hata: ", response);

                });
            //return false;

    });
</script>

<script type="text/javascript">
$(document).on('click', '.CariDelete', function(e){
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

    console.log(id);

    $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

    $.ajax({
            method    : "POST",
            url       : "{{ url('cari/destroy') }}",
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


@endsection