@extends('layouts.app')
@section('breadcrumb')
	<div class="breadcrumb">
       <a href="{{ url('home') }}" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> ANA SAYFA</a>
        <span class="breadcrumb-item active"><i class="icon-basket mr-2"></i> ÖDEMELER</span>
    </div>
@endsection
@section('content')

@include('fiyat.create')

<div id="FiyatEditResponse"></div>


<div class="card">
  <div class="card-header">
    <h6 class="card-title">FİYAT GRUPU YÖNETİMİ</h6>
  </div>
  
  <div class="card-body">
    


        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#YeniFiyatModal"><i class="icon-plus3"></i> Grup Ekle</button>
       <hr>
        @if(count($fiyat01)> 0)

           <table class="table table-striped table-bordered table-hover table-sm">
            <thead>
                <tr>
 
                    <th>#</th>
                    <th>GRUP ADI</th>
                    <th>KAR ORANI</th>
                    <th>İNDİRİM ORANI</th>
                    <th>ÜRÜN SAYISI</th>
                    <th>AÇIKLAMA</th>
                    <th>TARİH</th>
                </tr>
            </thead>
            <tbody>
  
                @foreach($fiyat01 as $row)
                <tr>      
                    <td>
                      <div class="btn-group btn-group-sm">
                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                            <i class="icon-menu7"></i>
                        </button>
                        
                        <div class="dropdown-menu">
                            <button type="button" class="dropdown-item FiyatEditButton" id="{{ $row->id }}"><i class="icon-pencil7"></i> Düzenle</button>
                            @if( $row->tari_odeme == NULL) 
                            <button type="button" class="dropdown-item text-danger FiyatSilButton" id="{{ $row->id }}"><i class="icon-trash"></i> Sil</button>
                            @endif
                        </div>
                    </div>
                    </td>
                    <td>{{ $row->adi }}</td>
                    <td>{{ $row->oran }}</td>
                    <td>{{ $row->indirim_oran }}</td>
                    <td>{{ $row->urun01->count('id') }}</td>
                    <td>{{ $row->aciklama }}</td>
                    <td>{{ tarihSaat($row->created_at) }}</td>
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
</div>

<!-- 
___________________________________________________________________________________________________
ÖDEME SİLME
___________________________________________________________________________________________________
-->
<script type="text/javascript">
    $(document).on('click', '.FiyatEditButton', function (e) {
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
                    url       : "{{ url('fiyat/edit') }}",
                    data      : {"id":id},
                    dataType  : "JSON",
                })
            .done(function(response) {
                
                $("#FiyatEditResponse").html(response.FiyatEdit);
                $('#FiyatEditModal').modal('show');

                })
            .fail(function(response) {

                console.log("Hata: ", response);

                });
            //return false;

    });
</script>
<!-- 
___________________________________________________________________________________________________
ÖDEME SİLME
___________________________________________________________________________________________________
-->
<script>
    $(document).on('click', '.FiyatSilButton', function(e){
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
      text: "Ödeme silinsin mi?",
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
            url       : "{{ url('fiyat/destroy') }}",
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