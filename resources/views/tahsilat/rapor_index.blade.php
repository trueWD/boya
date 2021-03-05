@extends('layouts.app')
@section('breadcrumb')
	<div class="breadcrumb">
       <a href="{{ url('home') }}" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> ANA SAYFA</a>
        <span class="breadcrumb-item active"><i class="icon-basket mr-2"></i> SATIŞ</span>
    </div>
@endsection
@section('content')



<div class="card">
    <div class="card-header bg-transparent border-bottom pb-0 pt-sm-0 header-elements-sm-inline">
        <div class="header-elements">
            <ul class="nav nav-tabs nav-tabs-highlight card-header-tabs">
                <li class="nav-item">
                    <a href="#urun-tab1" class="nav-link active" data-toggle="tab">
                        <i class="icon-cash3 mr-2"></i>
                        GÜNLÜK TAHSİLAT
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#urun-tab2" class="nav-link" data-toggle="tab">
                        <i class="icon-stats-growth mr-2"></i>
                        TAHSİLAT RAPORU
                    </a>
                </li>
            </ul>
        </div>
    </div>
    
    <div class="card-body tab-content">
        <div class="tab-pane fade show active" id="urun-tab1">

      @if(count($tahsilat01)> 0)   

           <table class="table table-striped table-bordered table-hover  table-sm">
            <thead>
                <tr>
 
                    <th>#</th>
                    <th>CARİ</th>
                    <th>TARİH</th>
                    <th>AÇIKLAMA</th>
                    <th>ÖDEME TİPİ</th>
                    <th>TUTAR</th>
                    <th>YETKİLİ</th>
                </tr>
            </thead>
            <tbody>
                @php   
                    $genelToplam = 0;    
                @endphp
                @foreach($tahsilat01 as $row)
                @php
                    $genelToplam    = $genelToplam + $row->tutar;
                @endphp
                <tr>

                    
                    <td>
                        <div class="btn-group btn-group-sm">
                            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                                <i class="icon-menu7"></i>
                            </button>
                            <div class="dropdown-menu">
                                <a href="{{ url('tahsilat/TahsilatYazdir/'.$row->id) }}" target="_blank" class="dropdown-item"><i class="icon-printer"></i> Yazdır</a>
                                <div class="dropdown-divider"></div>
                                <button type="button" class="dropdown-item text-danger TahsilatSilButton" id="{{ $row->id }}"><i class="icon-bin"></i> Sil</button>
                            </div>
                        </div>
                    </td>
                    <td> 
                        {{ $row->cari->cariadi }}
                    </td>
                    <td>{{ tarihSaat($row->created_at) }}</td>
                    <td>{{ $row->aciklama }}</td>
                    <td>
                        @if($row->odemetipi=='NAKIT')
                        <span class="badge badge-flat border-success text-success">{{ $row->odemetipi }}</span>
                        @endif
                        @if($row->odemetipi=='KART')
                        <span class="badge badge-flat border-primary text-primary">{{ $row->odemetipi }}</span>
                        @endif
                    </td>
                    <td class="text-right"><b>{{ para($row->tutar) }} TL</b></td>
                    <td>{{ $row->user->name }}</td>
        
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        
            <div class="alert alert-warning alert-styled-left alert-dismissible">
                <button type="button" class="close" data-dismiss="alert"><span>×</span></button>
                <span class="font-weight-semibold">BİLGİ!</span> Bu tarite hiç ödeme yok!..
            </div>

        @endif



        </div>

        <div class="tab-pane fade" id="urun-tab2">
            <form id="TahsilatRaporuForm">

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
                    <button type="button" class="btn btn-primary TahsilatRaporuSubmit">Rapor Oluştur <i class="icon-filter4 ml-2"></i></button>
                </div>
            </form>
 <hr>

            <div id="TahsilatRaporuResponse"></div>


        </div>

    </div>
</div>

<!-- 
___________________________________________________________________________________________________
TAHSİLAT RAPORU
___________________________________________________________________________________________________
-->
<script>
$.fn.modal.Constructor.prototype._enforceFocus = function() {};
$(document).ready(function(){

    $('#TahsilatRaporuForm #cariid').select2({
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
  $('#TahsilatRaporuForm .startdate').pickadate();
  $('#TahsilatRaporuForm .enddate').pickadate();
</script>

<script type="text/javascript">
$( ".TahsilatRaporuSubmit" ).click(function() {

  var data = $("#TahsilatRaporuForm").serialize();

  $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
      });
  $.ajax({
          method    : "POST",
          url       : "{{ url('tahsilat/RaporSorgu') }}",
          data      : data,
          dataType  : "JSON",
      })
  .done(function(response) {
      
      $("#TahsilatRaporuResponse").html(response.rapor);

      $('.TahsilatRaporuTable').DataTable({
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

<!-- 
___________________________________________________________________________________________________
Ürün SİLME
___________________________________________________________________________________________________
-->
<script>
    $(document).on('click', '.TahsilatSilButton', function(e){
    e.preventDefault();
      const swalWithBootstrapButtons = Swal.mixin({
      customClass: {
        confirmButton: 'btn btn-success',
        cancelButton: 'btn btn-danger'
      },
      buttonsStyling: false,
    })

    swalWithBootstrapButtons.fire({
      title: 'Dikkat!',
      text: "Tahsilat silinsin mi?",
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
            url       : "{{ url('tahsilat/TahsilatSil') }}",
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


@endsection