@extends('layouts.app')
@section('breadcrumb')
	<div class="breadcrumb">
       <a href="{{ url('home') }}" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> ANA SAYFA</a>
        <span class="breadcrumb-item active"><i class="icon-basket mr-2"></i> SATIŞ</span>
    </div>
@endsection
@section('content')

@if(auth()->user()->depo01== NULL)

<div class="alert alert-warning alert-styled-left alert-dismissible">
    <button type="button" class="close" data-dismiss="alert"><span>×</span></button>
    <span class="font-weight-semibold">DİKKAT!</span><b> {{ auth()->user()->name }}</b> kullanıcısına yetkili olduğu <b>DEPO</b> veya <b>ŞUBE</b>'yi tanımlayınız. Lütfen <a href="{{ url('admin/users') }}" class="btn-link">Burdan</a> kullanıcıyı düzenle deyip yetkili olduğu şubeyi seçiniz....
</div>
@else


<div class="card">
    <div class="card-header bg-transparent border-bottom pb-0 pt-sm-0 header-elements-sm-inline">
        <div class="header-elements">
            <ul class="nav nav-tabs nav-tabs-highlight card-header-tabs">
                <li class="nav-item">
                    <a href="#urun-tab1" class="nav-link active" data-toggle="tab">
                        <i class="icon-cash3 mr-2"></i>
                        GÜNLÜK SATIŞ
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#urun-tab2" class="nav-link" data-toggle="tab">
                        <i class="icon-stats-growth mr-2"></i>
                        SATIŞ RAPORU
                    </a>
                </li>
            </ul>
        </div>
    </div>
    
    <div class="card-body tab-content">
        <div class="tab-pane fade show active" id="urun-tab1">

        <a href="{{ url('satis/store') }}" type="button" class="btn btn-primary"><i class="icon-basket  mr-1php artisan ma"></i> Yeni Satış</a>

            <table class="table table-striped table-bordered table-hover table-sm myDataTable1">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Fiş No</th>
                        <th>Durumu</th>
                        <th>Ödeme Şekli</th>
                        <th>Müşteri</th>
                        <th>İskonto Tutarı</th>
                        <th>KDV Tutarı</th>
                        <th>Toplam Tutar</th>
                        <th>Tarih</th>
                        <th>Satış yapan</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $toplam_nakit       = 0;
                        $toplam_kart        = 0;
                        $toplam_veresiye    = 0;
                        $toplam_iade        = 0;
                    @endphp
                    @foreach($siparisler as $row)

                    @php
                        if($row->odemetipi == 'NAKIT'){
                            $toplam_nakit       =  $toplam_nakit + $row->toplam_tutar;  
                        }
                        if($row->odemetipi == 'KART'){
                           $toplam_kart        =  $toplam_kart + $row->toplam_tutar; 
                        }
                       
                        if($row->odemetipi == 'VERESIYE'){
                           $toplam_veresiye    =  $toplam_veresiye + $row->toplam_tutar;
                        }
                        if($row->durumu == 'IADE'){
                           $toplam_iade    =  $toplam_iade + $row->toplam_tutar;
                        }
                       
                        
                        
                    @endphp
                    <tr  @if($row->durumu=='IADE') class="table-warning" @endif>
                        <td>
                            
                            <div class="btn-group btn-group-sm">
                                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                                    <i class="icon-menu7"></i>
                                </button>

                                <div class="dropdown-menu">
                                    <a href="{{ url('satis/'.$row->id) }}" class="dropdown-item"><i class="icon-file-eye"></i> Göster</a>
                                    
                                    @if($row->durumu=='TAMAM')
                                    <a href="{{ url('satis/FisYazdir/'.$row->id) }}" target="_blank" class="dropdown-item"><i class="icon-printer"></i> Yazdır</a>
                                    @endif
                                    @if($row->durumu=='AKTIF')
                                    <div class="dropdown-divider"></div>
                                    <button type="button" class="dropdown-item text-danger FisIptalButton" id="{{ $row->id }}"><i class="icon-trash"></i> Sil</button>
                                    @endif
                                    
                                  
                                </div>
                            </div>
                        </td>
                        <td><a href="{{ url('satis/'.$row->id) }}">{{ $row->id }}</a></td>
                        <td>
                            <a href="{{ url('satis/'.$row->id) }}">
                            @if( $row->durumu == "AKTIF") 
                                <span class="badge badge-primary">{{ $row->durumu }}</span>
                            @elseif($row->durumu == "IPTAL")
                                <span class="badge badge-warning">{{ $row->durumu }}</span>
                            @else
                                <span class="badge badge-success">{{ $row->durumu }}</span>
                            @endif
                            </a>
                        </td>

                        <td>
                            @if ($row->odemetipi == 'PROFORMA')
                                <span class="badge badge-flat border-primary text-primary">{{ $row->odemetipi }}</span>
                            @endif
                            @if ($row->odemetipi == 'NAKIT')
                                <span class="badge badge-flat border-success text-success">{{ $row->odemetipi }}</span>
                            @endif
                            @if ($row->odemetipi == 'KART')
                                <span class="badge badge-flat border-info text-info">{{ $row->odemetipi }}</span>
                            @endif
                            @if ($row->odemetipi == 'VERESIYE')
                                <span class="badge badge-flat border-warning text-warning">{{ $row->odemetipi }}</span>
                            @endif
                            @if($row->durumu=='IADE')
                                @if ($row->odemetipi == 'NAKIT')
                                    <span class="badge badge-flat border-pri text-warning">NAKIT ÖDENDİ</span>
                                @endif
                                @if ($row->odemetipi == 'HESAP')
                                    <span class="badge badge-flat border-warning text-warning">CARİ HESABA EKLENDİ</span>
                                @endif
                            @endif
                            
                            
                        </td>
                        
                        <td> @if(isset($row->cari)) {{ $row->cari->cariadi }}  @else PERKENDE SATIŞ @endif</td>
                        <td class="text-right">{{ para($row->toplam_iskonto) }} TL</td>
                        <td class="text-right">{{ para($row->toplam_kdv) }} TL</td>
                        <td class="text-right">{{ para($row->toplam_tutar) }} TL</td>
                        <td>{{ tarihSaat($row->created_at) }}</td>
                        <td>{{ $row->user->name }}</td>
               
                    </tr>
                    @endforeach
                </tbody>
            </table>


<div class="row">
<div class="col-md-6 col align-self-end">
    <table class="table table-bordered table-hover">
    <tbody>
        <tr>
            <td class="text-right">Toplam Nakit Satış</td>
            <td class="table-success text-right"><b>{{ para($toplam_nakit) }}</b></td>
        </tr>
        <tr>
            <td class="text-right">Toplam Kart Satış</td>
            <td class="table-info text-right"><b>{{ para($toplam_kart) }}</b></td>
        </tr>
        <tr>
            <td class="text-right">Toplam Veresiye</td>
            <td class="table-danger text-right"><b>{{ para($toplam_veresiye) }}</b></td>
        </tr>
        <tr>
            <td class="text-right">Toplam</td>
            <td class="table-danger text-right"><b>{{ para($toplam_nakit + $toplam_kart + $toplam_veresiye, 2)  }}</b></td>
        </tr>
        <tr>
            <td class="text-right">İade Toplamı</td>
            <td class="table-warning text-right"><b>{{ para($toplam_iade ,2)  }}</b></td>
        </tr>

    </tbody>
    </table>
</div>
</div>










        </div>

        <div class="tab-pane fade" id="urun-tab2">
            <form id="SatisRaporuForm">

                <div class="row">

                    <div class="col-md-3">
                    
                    <label>Başlangıç tarihi:</label>
                    <div class="input-group">
                        <span class="input-group-prepend">
                        <span class="input-group-text"><i class="icon-calendar"></i></span>
                        </span>
                        <input type="text" data-value="<?php echo date("Y-m-d",time()); ?>" name="startdate" class="form-control startdate">
                    </div>
            
                    </div>
                    <div class="col-md-3">

                    <label>Bitiş tarihi:</label>
                    <div class="input-group">
                        <span class="input-group-prepend">
                        <span class="input-group-text"><i class="icon-calendar"></i></span>
                        </span>
                        <input type="text" data-value="<?php echo date("Y-m-d",time()); ?>" name="enddate" class="form-control enddate">
                    </div>

                    </div>
                    <div class="col-md-6">

                        <div class="form-group">
                        <label>Cari Adı:</label>
                        <select class="js-example-basic-single js-states form-control select cariid" name="cariid" id="cariid"></select>
                    </div>

                    </div>
                    
                </div>

                <div class="text-right">
                    <button type="button" class="btn btn-primary SatisRaporuSubmit">Rapor Oluştur <i class="icon-filter4 ml-2"></i></button>
                </div>
            </form>


            <div id="SatisRaporuResponse"></div>


        </div>

    </div>
</div>

@endif

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
SATIŞ RAPORU
___________________________________________________________________________________________________
-->
<script>
$.fn.modal.Constructor.prototype._enforceFocus = function() {};
$(document).ready(function(){

    $('#SatisRaporuForm #cariid').select2({
        ajax : {
            url : '/api/musteri',
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




<script>
  $('#SatisRaporuForm .startdate').pickadate();
  $('#SatisRaporuForm .enddate').pickadate();
</script>

<script type="text/javascript">
$( ".SatisRaporuSubmit" ).click(function() {

  var data = $("#SatisRaporuForm").serialize();

  $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
      });
  $.ajax({
          method    : "POST",
          url       : "{{ url('satis/SatisRaporu') }}",
          data      : data,
          dataType  : "JSON",
      })
  .done(function(response) {
      
      $("#SatisRaporuResponse").html(response.rapor);

      $('.SatisRaporuTable').DataTable({
          "lengthMenu": [[50, 100, 500, -1], [50, 100, 500, "All"]],
            "order": [[ 0, "desc" ]],
          buttons: {
                buttons: [
                    {
                        extend: 'copyHtml5',
                        className: 'btn btn-light',
                        exportOptions: {
                            columns: [ 0, ':visible' ]
                        }
                    },
                   {
                        extend: 'excelHtml5',
                        title: '<?php echo date('d-m-Y'); ?> Kasa Raporu',
                        className: 'btn btn-light',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        title: '<?php echo date('d-m-Y'); ?> Kasa Raporu',
                        orientation: 'landscape',
                        pageSize: 'LEGAL',
                        className: 'btn btn-light',
                        exportOptions: {
                            columns: [0,1,2,3,4,5,6]
                        }
                    },
                    {
                        extend: 'colvis',
                        text: '<i class="icon-three-bars"></i>',
                        className: 'btn bg-blue btn-icon dropdown-toggle'
                    }
                ]
            }
          });

      new PNotify({
          title: response.title,
          text: response.text,
          addclass: 'alert bg-success border-success alert-styled-left'
      });

      })
  .fail(function(response){

      console.log("Hata: ", response);

    });

});

</script>

@endsection