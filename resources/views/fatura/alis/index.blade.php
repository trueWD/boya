@extends('layouts.app')
@section('breadcrumb')
	<div class="breadcrumb">
        <a href="{{ url('home') }}" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Ana Sayfa</a>
        <span class="breadcrumb-item active">Alış Fatura Listesi</span>
    </div>
@endsection
@section('content')

<!-- BEGIN FORM -->
@include('fatura.alis.create')
<div id="FaturaEditResponse"></div>
<div id="UrunCopyResponse"></div>

    <!-- Column selectors -->
    <div class="card">
        <div class="card-header header-elements-inline">
        
        </div>

        <div class="card-body">


            <ul class="nav nav-tabs nav-tabs-highlight">
                <li class="nav-item"><a href="#left-icon-tab1" class="nav-link active" data-toggle="tab"><i class="icon-file-plus mr-2"></i> AKTİF FATURALAR</a></li>
                <li class="nav-item"><a href="#left-icon-tab2" class="nav-link" data-toggle="tab"><i class="icon-file-check mr-2"></i> FATURA RAPORU</a></li>
            </ul>

            <div class="tab-content">
                <div class="tab-pane fade active show" id="left-icon-tab1">


                      <button type="button" class="btn btn-info" data-toggle="modal" data-target="#AlisFaturaModal"><i class="icon-plus3"></i> Alış Faturası Oluştur</button>
                    

                    <table class="table table-striped table-bordered table-hover table-sm myDataTable1">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Durumu</th>
                                <th>Fatura No</th>
                                <th>Cari Adı</th>
                                <th>Fatura Tarihi</th>
                                <th>Tutar</th>
                                <th>Sorumlu</th>
                                <th>Oluşturma Tarihi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($fatura as $row)
                            <tr>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                                            <i class="icon-menu7"></i>
                                        </button>
                                        
                                        <div class="dropdown-menu">
                                            <button type="button" class="dropdown-item FaturaEdit" id="{{ $row->id }}"><i class="icon-equalizer3"></i> Düzenle</button>
                                            @if( $row->durumu == "AKTIF") 
                                            <button type="button" class="dropdown-item text-danger FaturaDelete" id="{{ $row->id }}"><i class="icon-trash"></i> Sil</button>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    @if( $row->durumu == "AKTIF") 
                                        <span class="badge badge-primary">{{ $row->durumu }}</span>
                                    @elseif($row->durumu == "KAPALI")
                                        <span class="badge badge-success">{{ $row->durumu }}</span>
                                    @else
                                        <span class="badge badge-warning">{{ $row->durumu }}</span>
                                    @endif
                                </td>
                                <td><a href="{{  url('fatura/alis/'.$row->id)  }}" class="btn btn-link btn-sm">{{ $row->faturano }} </a></td>
                                <td>{{ $row->cariadi }}</td>
                                <td>{{ tarih($row->fatura_tarihi) }}</td>
                                <td>{{ para($row->tutar) }} TL</td>
                                <td>{{ $row->username }}</td>
                                <td>{{ tarih($row->created_at) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>


                </div>

                <div class="tab-pane fade" id="left-icon-tab2">
                    



                     <form id="AlisFaturaRaporuForm">

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
                            <button type="button" class="btn btn-primary AlisFaturaRaporuSubmit">Rapor Oluştur <i class="icon-filter4 ml-2"></i></button>
                        </div>
                    </form>



                    <div id="AlisFaturaRaporuResponse">

                    </div>






                </div>

            </div>






          

      
            
        </div>
    </div>
    <!-- /column selectors -->


<script>
  $('#AlisFaturaRaporuForm .startdate').pickadate();
  $('#AlisFaturaRaporuForm .enddate').pickadate();
</script>

<script type="text/javascript">
$( ".AlisFaturaRaporuSubmit" ).click(function() {

  var data = $("#AlisFaturaRaporuForm").serialize();

  $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
      });
  $.ajax({
          method    : "POST",
          url       : "{{ url('fatura/alis/FaturaRaporu') }}",
          data      : data,
          dataType  : "JSON",
      })
  .done(function(response) {
      
      $("#AlisFaturaRaporuResponse").html(response.rapor);

      $('table.display').DataTable({
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
          addclass: 'alert bg-'+response.type+' border-'+response.type+' alert-styled-left'
      });

      })
  .fail(function(response){

      console.log("Hata: ", response);

    });

});

</script>

 <script>
   $.fn.modal.Constructor.prototype._enforceFocus = function() {};
  $(document).ready(function(){

      $('#AlisFaturaRaporuForm #cariid').select2({
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



<script type="text/javascript">
    $(document).on('click', '.FaturaEdit', function (e) {
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
                    url       : "{{ url('fatura/alis/edit') }}",
                    data      : {"id":id},
                    dataType  : "JSON",
                })
            .done(function(response) {
                
                $("#FaturaEditResponse").html(response.FaturaEdit);
                $('#FaturaEditModal').modal('show');

                })
            .fail(function(response) {

                console.log("Hata: ", response);

                });
            //return false;

    });
</script>

<script type="text/javascript">
$(document).on('click', '.FaturaDelete', function(e){
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
            url       : "{{ url('fatura/alis/destroy') }}",
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