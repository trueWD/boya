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
                        
                        <td> @if(isset($row->cari)) {{ $row->cari->cariadi }}  @else PERKENDE SATIŞ @endif</td>
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

        <div class="tab-pane fade" id="urun-tab2">
            This is the second card tab content
        </div>

    </div>
</div>



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

@endsection