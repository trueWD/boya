@extends('layouts.app')
@section('breadcrumb')
	<div class="breadcrumb">
       <a href="{{ url('home') }}" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> ANA SAYFA</a>
        <span class="breadcrumb-item active"><i class="icon-basket mr-2"></i> SATIŞ</span>
    </div>
@endsection
@section('content')

<!-- BEGIN FORM -->
<div id="CariEditResponse"></div>

<div class="card">

<div class="card-body">
    <ul class="nav nav-tabs nav-tabs-highlight">
        <li class="nav-item"><a href="#left-icon-tab1" class="nav-link active" data-toggle="tab"><i class="icon-basket mr-2"></i> GÜNLÜK SATIŞ</a></li>
        <li class="nav-item"><a href="#left-icon-tab2" class="nav-link" data-toggle="tab"><i class="icon-stats-bars2 mr-2"></i> SATIŞ RAPORLARI</a></li>
    </ul>

    <div class="tab-content">
        <div class="tab-pane fade show active" id="left-icon-tab1">
            



            <a href="{{ url('satis/store') }}" type="button" class="btn btn-primary"><i class="icon-basket  mr-1php artisan ma"></i> Yeni Satış Ekle</a>

            <table class="table table-striped table-bordered table-hover table-sm myDataTable1">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Fiş No</th>
                        <th>Durumu</th>
                        <th>Müşteri</th>
                        <th>İskonto Tutarı</th>
                        <th>KDV Tutarı</th>
                        <th>Toplam Tutar</th>
                        <th>Ödeme Şekli</th>
                        <th>Tarih</th>
                        <th>Satış yapan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($siparisler as $row)
                    <tr>
                        <td>
                            <div class="btn-group btn-group-sm">
                                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                                    <i class="icon-menu7"></i>
                                </button>

                                <div class="dropdown-menu">
                                    <a href="{{ url('satis/'.$row->id) }}" class="dropdown-item"><i class="icon-file-eye"></i> Göster</a>
                                    <button type="button" class="dropdown-item SiparisEdit" id="{{ $row->id }}"><i class="icon-equalizer3"></i> Düzenle</button>
                                    <div class="dropdown-divider"></div>
                                    <button type="button" class="dropdown-item text-danger rowDelete" id="{{ $row->id }}"><i class="icon-trash"></i> Sil</button>
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
                        
                        <td> @if(isset($row->cari->cariadi)) {{ $row->cari->cariadi }}  @else PERKENDE SATIŞ @endif</td>
                        <td class="text-right">{{ para($row->toplam_iskonto) }} TL</td>
                        <td class="text-right">{{ para($row->toplam_kdv) }} TL</td>
                        <td class="text-right">{{ para($row->toplam_tutar) }} TL</td>
                        <td>{{ $row->odemetipi }}</td>
                        <td>{{ tarihSaat($row->created_at) }}</td>
                        <td>{{ $row->user->name }}</td>
               
                    </tr>
                    @endforeach
                </tbody>
            </table>





        </div>

        <div class="tab-pane fade" id="left-icon-tab2">
            Tab 2
        </div>

    </div>
</div>
</div>










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