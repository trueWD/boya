@extends('layouts.app')
@section('breadcrumb')
	<div class="breadcrumb">
        <a href="{{ url('home') }}" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Ana Sayfa</a>
        <span class="breadcrumb-item active">Kullanıcı Hesap Ayarları</span>
    </div>
@endsection
@section('content')


<!-- Inner container -->
<div class="d-md-flex align-items-md-start">

    <!-- Left sidebar component -->
    <div class="sidebar sidebar-light bg-transparent sidebar-component sidebar-component-left wmin-300 border-0 shadow-0 sidebar-expand-md">

        <!-- Sidebar content -->
        <div class="sidebar-content">

            <!-- Navigation -->
            <div class="card">
                <div class="card-body bg-indigo-400 text-center card-img-top" style="background-image: url(../../../../global_assets/images/backgrounds/panel_bg.png); background-size: contain;">
                    <div class="card-img-actions d-inline-block mb-3">
                        <img class="img-fluid rounded-circle" src="../../../../global_assets/images/placeholders/placeholder.jpg" width="170" height="170" alt="">
                        <div class="card-img-actions-overlay rounded-circle">
                            <a href="#" class="btn btn-outline bg-white text-white border-white border-2 btn-icon rounded-round">
                                <i class="icon-plus3"></i>
                            </a>
                            <a href="user_pages_profile.html" class="btn btn-outline bg-white text-white border-white border-2 btn-icon rounded-round ml-2">
                                <i class="icon-link"></i>
                            </a>
                        </div>
                    </div>

                    <h6 class="font-weight-semibold mb-0">{{ Auth::user()->name }}</h6>
                    <span class="d-block opacity-75">Roles</span>

                    <div class="list-icons list-icons-extended mt-3">
                        <a href="#" class="list-icons-item text-white" data-popup="tooltip" title="" data-container="body" data-original-title="Google Drive"><i class="icon-google-drive"></i></a>
                        <a href="#" class="list-icons-item text-white" data-popup="tooltip" title="" data-container="body" data-original-title="Twitter"><i class="icon-twitter"></i></a>
                        <a href="#" class="list-icons-item text-white" data-popup="tooltip" title="" data-container="body" data-original-title="Github"><i class="icon-github"></i></a>
                    </div>
                </div>

                <div class="card-body p-0">
                    <ul class="nav nav-sidebar mb-2">
                        <li class="nav-item">
                            <a href="#profileTab" class="nav-link active" data-toggle="tab">
                                <i class="icon-user"></i>Kullanıcı Bilgilerim
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#usersettingsTab" class="nav-link" data-toggle="tab">
                                <i class="icon-cog2"></i>Kişisel Ayarlarım
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#passwordTab" class="nav-link" data-toggle="tab">
                                <i class="icon-user-lock"></i>Şifre Değiştir
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#statsTab" class="nav-link" data-toggle="tab">
                                <i class="icon-stats-growth"></i>İstastiklerim
                                <span class="badge bg-success badge-pill ml-auto">16</span>
                            </a>
                        </li>
                        <li class="nav-item-divider"></li>
                        <li class="nav-item">
                            <a href="login_advanced.html" class="nav-link" data-toggle="tab">
                                <i class="icon-switch2"></i>Logout
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- /navigation -->

        </div>
        <!-- /sidebar content -->

    </div>
    <!-- /left sidebar component -->


    <!-- Right content -->
    <div class="tab-content w-100">
<!--
__________________________________________________________________________________________________________
profileTab 
__________________________________________________________________________________________________________
-->

        <div class="tab-pane fade active show" id="profileTab">
            <!-- Sales stats -->
            <div class="card">
                <div class="card-header header-elements-sm-inline">
                    <h6 class="card-title">KULLANICI BİLGİLERİM </h6>
                    <div class="header-elements">
                    </div>
                </div>

                <div class="card-body">
                    <form id="updateUserForm">


                        <div class="form-group row">
                            <label for="email" class="col-sm-4 col-form-label">Email</label>
                            <div class="col-sm-8">
                            <input type="text" name="email" value="{{ Auth::user()->email }}" class="form-control" id="email" placeholder="Email" autocomplete="off">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-sm-4 col-form-label">Adınız</label>
                            <div class="col-sm-8">
                            <input type="text" name="name" value="{{ Auth::user()->name }}" class="form-control" id="name" placeholder="Adınız" autocomplete="off">
                            </div>
                        </div>

                         <div class="text-right">
                            <input type="hidden" name="id" value="{{ Auth::user()->id }}">
                            <button type="button" class="btn btn-primary updateUserSubmit"><i class="icon-loop"></i> Bilgilerimi Güncelle</button>
                        </div>


                    </form>
                </div>
            </div>
            <!-- /sales stats -->
        </div>


{!! JsValidator::formRequest('App\Http\Requests\Admin\UpdateUsersRequest', '#updateUserForm'); !!}

<script type="text/javascript">
$(document).on('click', '.updateUserSubmit', function(e){
e.preventDefault();

    if($("#updateUserForm").valid())
    {
        var data = $("#updateUserForm").serialize();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            });
        $.ajax({
                method    : "POST",
                url       : "{{ url('admin/users/update') }}",
                data      : data,
                dataType  : "JSON",
                })
        .done(function(response){  
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
__________________________________________________________________________________________________________
notificationTab 
__________________________________________________________________________________________________________
-->
        <div class="tab-pane fade" id="usersettingsTab">
            

            <form id="userSettingsUpdateForm">
            <!-- Task manager table -->
				<div class="card">
					<div class="card-header bg-transparent header-elements-inline">
						<h6 class="card-title">KİŞİSEL AYARLARIM</h6>
						<div class="header-elements">
							<div class="list-icons">
                                    <button type="button" class="btn btn-primary userSettingsUpdateSubmit"><i class="icon-loop"></i> Ayarlarımı Güncelle </button>
                                    <input type="hidden" name="id" value="{{ Auth::user()->id }}">
                                
		                	</div>
	                	</div>
					</div>

					<table class="table tasks-list table-lg">
						<thead>
							<tr>
								<th>Ayar Adı</th>
				                <th>Durumu</th>
				                <th>İşlem</th>
				            </tr>
						</thead>
						<tbody>

							<tr>
                                <td>
                                    <div class="font-weight-semibold"><a href="#">Görünüm Sitili</a></div>
				                	<div class="text-muted">Kendinizde özel bir temlate seebiliriniz!..</div>
				                </td>
                                <td><span class="badge badge-primary">{{ Auth::user()->theme }}</span></td>
				                <td>
				                	<select name="theme" class="form-control">
				                		<option value="default">Varsayılan (Beyaz)</option>
				                		<option value="dark">Dark Theme (Koyu)</option>
				                		<option value="material">Material (Yenilikçi)</option>
				                	</select>
				                </td>
                            </tr>
                            
							<tr>
                                <td>
                                    <div class="font-weight-semibold"><a href="#">Menü Görünümü</a></div>
				                	<div class="text-muted">Sol ana menüyü dar veya geniş olarak seçebilirsiniz!..</div>
				                </td>
                                <td><span class="badge badge-primary">@if(Auth::user()->menutipi =='D') Dar Menü @else Geniş Menü @endif</span></td>
				                <td>
				                	<select name="menutipi" class="form-control">
				                		<option value="D">Dar Menü</option>
				                		<option value="G">Geniş Menü</option>
				                	</select>
				                </td>
                            </tr>
                            

						</tbody>
                    </table>
                </div>
            
                </form>
				<!-- /task manager table -->
        </div>

        <script type="text/javascript">
        $(document).on('click', '.userSettingsUpdateSubmit', function(e){
        e.preventDefault();
 

                var data = $("#userSettingsUpdateForm").serialize();

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                    });
                $.ajax({
                        method    : "POST",
                        url       : "{{ url('admin/user/userSettingsUpdate') }}",
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


<!--
__________________________________________________________________________________________________________
passwordTab 
__________________________________________________________________________________________________________
-->
        <div class="tab-pane fade" id="passwordTab">

            <!-- Change Pass -->
            <div class="card">
                <div class="card-header header-elements-inline">
                    <h6 class="card-title">GÜVENLİK AYARLARIM</h6>
                    <div class="header-elements">
                    </div>
                </div>

                <div class="card-body">
                    <form id="changePasswordForm">


                        <div class="form-group row">
                            <label for="current_password" class="col-sm-4 col-form-label">Mevcut Şifreniz</label>
                            <div class="col-sm-8">
                            <input type="password" name="current_password" class="form-control" id="current_password" placeholder="Mevcut şifreniz" autocomplete="off">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="new_password" class="col-sm-4 col-form-label">Yeni Şifre</label>
                            <div class="col-sm-8">
                            <input type="password" name="new_password" class="form-control" id="new_password" placeholder="Yeni Şifre" autocomplete="off">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="new_password_confirmation" class="col-sm-4 col-form-label">Yeni Şifre Tekrar</label>
                            <div class="col-sm-8">
                            <input type="password" name="new_password_confirmation" class="form-control" id="new_password_confirmation" placeholder="Yeni Şifre Tekrar" autocomplete="off">
                            </div>
                        </div>

                        <div class="text-right">
                            <button type="button" class="btn btn-primary changePasswordSubmit"><i class="icon-loop"></i> Şifremi Güncelle </button>
                        
                        </div>




                    </form>
                </div>
            </div>
            <!-- /Change Pass -->
        </div>


        {!! JsValidator::formRequest('App\Http\Requests\Admin\UpdatePasswordRequest', '#changePasswordForm'); !!}

        <script type="text/javascript">
        $(document).on('click', '.changePasswordSubmit', function(e){
        e.preventDefault();
 
            if($("#changePasswordForm").valid())
            {
                var data = $("#changePasswordForm").serialize();

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                    });
                $.ajax({
                        method    : "POST",
                        url       : "{{ url('admin/user/changePassword') }}",
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
__________________________________________________________________________________________________________
statsTab 
__________________________________________________________________________________________________________
-->
        <div class="tab-pane fade" id="statsTab">
            <!-- Available hours -->
            <div class="card">
                <div class="card-header header-elements-inline">
                    <h6 class="card-title">İSTASTİKLERİM</h6>
                    <div class="header-elements">
                    </div>
                </div>

                <div class="card-body">

                    <div class="alert bg-info text-white alert-styled-left alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert"><span>×</span></button>
                        <span class="font-weight-semibold">Uyarı!</span> Bu bölüm henüz tasarlanmadı.</a>.
                    </div>

                </div>
            </div>
            <!-- /available hours -->
        </div>


    </div>
    <!-- /right content -->

</div>
<!-- /inner container -->


@endsection