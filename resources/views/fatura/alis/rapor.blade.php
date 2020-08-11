<hr>
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
                        <button type="button" class="dropdown-item FaturaGeriAl" id="{{ $row->id }}"><i class="icon-rotate-ccw3"></i> Faturayı Geri AL</button>
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