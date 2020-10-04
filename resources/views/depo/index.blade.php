@extends('layouts.app')
@section('breadcrumb')
	<div class="breadcrumb">
       <a href="{{ url('home') }}" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> ANA SAYFA</a>
        <span class="breadcrumb-item active"><i class="icon-basket mr-2"></i> ÖDEMELER</span>
    </div>
@endsection
@section('content')

@include('depo.create')


<div class="card">
  <div class="card-header">
    <h6 class="card-title">DEPO - ŞUBE YÖNETİMİ</h6>
  </div>
  
  <div class="card-body">
    


        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#YeniDepoModal"><i class="icon-plus3"></i> Depo Ekle</button>
       <hr>
        @if(count($depo01)> 0)

           <table class="table table-striped table-bordered table-hover table-sm">
            <thead>
                <tr>
 
                    <th>#</th>
                    <th>DEPO ADI</th>
                    <th>AÇIKLAMA</th>
                    <th>TARİH</th>
                </tr>
            </thead>
            <tbody>
  
                @foreach($depo01 as $row)
                <tr>      
                    <td>
                      <div class="btn-group btn-group-sm">
                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                            <i class="icon-menu7"></i>
                        </button>
                        
                        <div class="dropdown-menu">
                            <button type="button" class="dropdown-item CekOdemButton" id="{{ $row->id }}"><i class="icon-pencil7"></i> Düzenle</button>
                            @if( $row->tari_odeme == NULL) 
                            <button type="button" class="dropdown-item text-danger DepoSilButton" id="{{ $row->id }}"><i class="icon-trash"></i> Sil</button>
                            @endif
                        </div>
                    </div>
                    </td>
                    <td>{{ $row->depoadi }}</td>
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
<script>
    $(document).on('click', '.DepoSilButton', function(e){
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
            url       : "{{ url('depo/destroy') }}",
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