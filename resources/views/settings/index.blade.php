@extends('layouts.app')
@section('breadcrumb')
	<div class="breadcrumb">
        <a href="{{ url('home') }}" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Ana Sayfa</a>
        <span class="breadcrumb-item active">Sistem Ayarları</span>
    </div>
@endsection
@section('content')

<!-- Column selectors -->
<div class="card">
    <div class="card-header header-elements-inline">
        <h5 class="card-title">SİSTEM AYARLARI</h5>
        <div class="header-elements">
            <div class="list-icons">
                <a class="list-icons-item" data-action="collapse"></a>
            </div>
        </div>
    </div>

    <div class="card-body">


        <form id="SettingsForm">

            <button type="button" class="btn btn-info SettingsSubmit"><i class="icon-plus3"></i>Ayarları Kaydet</button>

        <hr>


        <table class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                <th>İzin Adı</th>
                <th>Durumu</th>
                <th>Açıklama</th>
                <th>İşlem</th>

                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Uygulama Versiyonu</td>
                    <td>
                        @if($settings->version =='Pasive')
                        <span class="badge badge-danger">{{ $settings->version }}</span>
                        @elseif($settings->version =='Active')
                        <span class="badge badge-success">{{ $settings->version }}</span>
                        @else
                        <span class="badge bg-purple">{{ $settings->version }}</span>
                        @endif
                    </td>
                    <td>Programın yeni bir versiyonu çıktığında burada güncellme yapabiliriniz.</td>
                    <td>{{ $settings->version }}</td>
                </tr>

                <tr>
                    <td>Bakım Modu</td>
                    <td>
                        @if($settings->maintenance =='Pasive')
                        <span class="badge badge-danger">{{ $settings->maintenance }}</span>
                        @elseif($settings->maintenance =='Active')
                        <span class="badge badge-success">{{ $settings->maintenance }}</span>
                        @else
                        <span class="badge bg-purple">{{ $settings->maintenance }}</span>
                        @endif
                    </td>
                    <td>Sisteme bağlı kullanıcıların işlem yamasını engeller. </td>
                    <td>
                        <select name="maintenance" class="form-control">
                            @if($settings->maintenance =='Pasive')
                            <option value="Pasive">Pasif</option>
                            <option value="Active">Aktif</option>
                            @endif

                            @if($settings->maintenance =='Active')
                            <option value="Active">Aktif</option>
                            <option value="Pasive">Pasif</option>
                            @endif
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Sipariş Onay Süreçleri</td>
                    <td>
                        @if($settings->siparis_onay =='Pasive')
                        <span class="badge badge-danger">{{ $settings->siparis_onay }}</span>
                        @elseif($settings->siparis_onay =='Active')
                        <span class="badge badge-success">{{ $settings->siparis_onay }}</span>
                        @else
                        <span class="badge bg-purple">{{ $settings->siparis_onay }}</span>
                        @endif
                    </td>
                    <td>Sipariş onay süreci Pasif edilirse satış temsilcileri üst yönetimde onay almadan direk satış yapabilirler. Bu ayar için (Aktif) seçeneği önerilir. </td>
                    <td>
                        <select name="siparis_onay" class="form-control">
                            @if($settings->siparis_onay =='Pasive')
                            <option value="Pasive">Pasif</option>
                            <option value="Active">Aktif</option>
                            @endif

                            @if($settings->siparis_onay =='Active')
                            <option value="Active">Aktif</option>
                            <option value="Pasive">Pasif</option>
                            @endif
                        </select>
                    </td>
                </tr>




            </tbody>
        </table>
        </form>        
    </div>
</div>
<!-- /column selectors -->

<script type="text/javascript">
$(document).on('click', '.SettingsSubmit', function(e){
e.preventDefault();
    var data = $("#SettingsForm").serialize();

    $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
            method    : "POST",
            url       : "{{ url('settings/update') }}",
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
    
});
</script>

@endsection