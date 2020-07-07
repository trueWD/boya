@extends('layouts.app')
@section('breadcrumb')
	<div class="breadcrumb">
        <a href="{{ url('home') }}" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Ana Sayfa</a>
        <a href="{{ url('cari') }}" class="breadcrumb-item"><i class="icon-vcard mr-2"></i> Cari Listesi</a>
    <span class="breadcrumb-item active">{{ $cari->cariadi }}</span>
    </div>
@endsection
@section('content')
<!-- Column selectors -->
<div class="card">
    <div class="card-header header-elements-inline">
        <h5 class="card-title">CARİ DETAYI :<span class="text-primary">{{ $cari->cariadi }}</span></h5>
        <div class="header-elements">
            <div class="list-icons">
                <a class="list-icons-item" data-action="collapse"></a>
            </div>
        </div>
    </div>

    <div class="card-body">


        <ul class="nav nav-tabs nav-tabs-highlight">
            <li class="nav-item"><a href="#left-icon-tab1" class="nav-link active" data-toggle="tab"><i class="icon-vcard"></i> CARİ DETAYI</a></li>
            <li class="nav-item"><a href="#left-icon-tab2" class="nav-link" data-toggle="tab"><i class="icon-cart"></i> SİPARİŞLERİ</a></li>
        </ul>

        <div class="tab-content">
            <!--
            _________________________________________________________________________________________________
            TAB 1
            _________________________________________________________________________________________________
            -->
            <div class="tab-pane fade show active" id="left-icon-tab1">
               <div class="row">
                   <div class="col-md-3">

                        <!-- User details (with sample pattern) -->
						<div class="card">
							<div class="card-body bg-blue text-center card-img-top" style="background-image: url(../../../../global_assets/images/backgrounds/panel_bg.png); background-size: contain;">
								<div class="card-img-actions d-inline-block mb-3">
									<img class="img-fluid rounded-circle" src="../../../../global_assets/images/placeholders/placeholder.jpg" alt="" width="170" height="170">
									<div class="card-img-actions-overlay card-img rounded-circle">
										<a href="#" class="btn btn-outline bg-white text-white border-white border-2 btn-icon rounded-round">
											<i class="icon-plus3"></i>
										</a>
										<a href="user_pages_profile.html" class="btn btn-outline bg-white text-white border-white border-2 btn-icon rounded-round ml-2">
											<i class="icon-link"></i>
										</a>
									</div>
								</div>

								<h6 class="font-weight-semibold mb-0">{{ $cari->cariadi }}</h6>
								<span class="d-block opacity-75">{{ $cari->temsilci }}</span>

								<ul class="list-inline list-inline-condensed mt-3 mb-0">
									<li class="list-inline-item">
										<a href="#" class="btn btn-outline bg-white btn-icon text-white border-white border-2 rounded-round">
											<i class="icon-google-drive"></i>
										</a>
									</li>
									<li class="list-inline-item">
										<a href="#" class="btn btn-outline bg-white btn-icon text-white border-white border-2 rounded-round">
											<i class="icon-twitter"></i>
										</a>
									</li>
									<li class="list-inline-item">
										<a href="#" class="btn btn-outline bg-white btn-icon text-white border-white border-2 rounded-round">
											<i class="icon-github"></i>
										</a>
									</li>
								</ul>
							</div>

							<div class="card-body border-top-0">
								<div class="d-sm-flex flex-sm-wrap mb-3">
									<div class="font-weight-semibold">Tel:</div>
									<div class="ml-sm-auto mt-2 mt-sm-0">{{ $cari->telefon }}</div>
								</div>

								<div class="d-sm-flex flex-sm-wrap mb-3">
									<div class="font-weight-semibold">Telefon 2:</div>
									<div class="ml-sm-auto mt-2 mt-sm-0">{{ $cari->telefon2 }}</div>
								</div>

								<div class="d-sm-flex flex-sm-wrap mb-3">
									<div class="font-weight-semibold">Faks:</div>
									<div class="ml-sm-auto mt-2 mt-sm-0">{{ $cari->faks }}</div>
								</div>

								<div class="d-sm-flex flex-sm-wrap mb-3">
									<div class="font-weight-semibold">Email:</div>
									<div class="ml-sm-auto mt-2 mt-sm-0"><a href="#">{{ $cari->email }}</a></div>
								</div>

								<div class="d-sm-flex flex-sm-wrap">
									<div class="font-weight-semibold">Website:</div>
									<div class="ml-sm-auto mt-2 mt-sm-0"><a href="{{ $cari->website }}" target="_blank">{{ $cari->website }}</a></div>
								</div>
							</div>
						</div>
                        <!-- /user details (with sample pattern) -->
                        

                        
                        <div class="card bg-pink-400 text-white text-center p-3" style="background-image: url(../../../../global_assets/images/backgrounds/panel_bg.png); background-size: contain;">
							<div>
								<a class="btn btn-lg btn-icon mb-3 mt-1 btn-outline text-white border-white bg-white rounded-round border-2">
									<i class="icon-quotes-right"></i>
								</a>
							</div>

							<blockquote class="blockquote mb-0">
								<p>"Cari durumu çok riskli olarak seçili"</p>
							</blockquote>
						</div>                           






                   </div>

                   <div class="col-md-9">





                    <div class="row">
					<div class="col-sm-6 col-xl-4">
						<div class="card card-body bg-blue-400 has-bg-image">
							<div class="media">
								<div class="media-body">
									<h3 class="mb-0">54,390</h3>
									<span class="text-uppercase font-size-xs">TOPLAM SİPARİŞ</span>
								</div>

								<div class="ml-3 align-self-center">
									<i class="icon-cart-add2 icon-3x opacity-75"></i>
								</div>
							</div>
						</div>
					</div>

					<div class="col-sm-6 col-xl-4">
						<div class="card card-body bg-danger-400 has-bg-image">
							<div class="media">
								<div class="media-body">
									<h3 class="mb-0">389,438</h3>
									<span class="text-uppercase font-size-xs">İPTAL EDİLEN</span>
								</div>

								<div class="ml-3 align-self-center">
									<i class="icon-cart4 icon-3x opacity-75"></i>
								</div>
							</div>
						</div>
					</div>

					<div class="col-sm-6 col-xl-4">
						<div class="card card-body bg-success-400 has-bg-image">
							<div class="media">
                                <div class="media-body">
									<h3 class="mb-0">652,549</h3>
									<span class="text-uppercase font-size-xs">SONUÇLANAN</span>
                                </div>
                                
								<div class="mr-3 align-self-center">
									<i class="icon-cart-remove icon-3x opacity-75"></i>
								</div>		
							</div>
						</div>
					</div>

				</div>







                   </div>





						


					





               </div>
            </div>

            <!--
            _________________________________________________________________________________________________
            TAB 2
            _________________________________________________________________________________________________
            -->
            <div class="tab-pane fade" id="left-icon-tab2">
                Siarişler
            </div>

            <!--
            _________________________________________________________________________________________________
            TAB 3
            _________________________________________________________________________________________________
            -->

            <div class="tab-pane fade" id="left-icon-tab3">
                DIY synth PBR banksy irony. Leggings gentrify squid 8-bit cred pitchfork. Williamsburg whatever.
            </div>

            <!--
            _________________________________________________________________________________________________
            TAB 4
            _________________________________________________________________________________________________
            -->
            <div class="tab-pane fade" id="left-icon-tab4">
                Aliquip jean shorts ullamco ad vinyl cillum PBR. Homo nostrud organic, assumenda labore aesthet.
            </div>
        </div>
							

        
    </div>
</div>
<!-- /column selectors -->

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

@endsection