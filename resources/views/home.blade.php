@extends('layouts.app')

@section('content')


<style>

#GunlukIslemlerResponse, .yazirengi,td,h5,th{
    color: #555;
    font-size: 14px;
    font-weight: bold;
}
#GunlukIslemlerResponse, a {
    color: #555;
    text-decoration: none;
    background-color: transparent;
    -webkit-text-decoration-skip: objects;
}

.arkaplan{
  background-color: #f9f8f5;
  color: gainsboro
}


element.style {
}
.card-body {
    -ms-flex: 1 1 auto;
    flex: 1 1 auto;
    padding: 0.55rem;
}

</style>

<div class="card">
  <div class="card-body">
    <div class="row">

      <div class="col-md-12">

        

        <div class="row">



          <div class="col-sm-4 col-xl-3">
            <div class="card card-body bg-warning-400 has-bg-image">
              <div class="media">
                <div class="media-body text-left">
                  <h3 class="mb-0">{{ para($tedarikci->sum('bakiye')) }}</h3>
                  <span class="text-uppercase font-size-xs">TOPLAM BORÇ</span>
                </div>
                <div class="mr-3 align-self-center">
                  <i class="icon-vcard icon-3x opacity-75"></i>
                </div>
              </div>
            </div>
          </div>

          
          <div class="col-sm-4 col-xl-3">
            <div class="card card-body bg-success-400 has-bg-image">
              <div class="media">
                <div class="media-body text-left">
                  <h3 class="mb-0">{{ para($tedarikci->sum('bakiye')) }}</h3>
                  <span class="text-uppercase font-size-xs">TOPLAM ALACAK</span>
                </div>
                <div class="mr-3 align-self-center">
                  <i class="icon-wallet icon-3x opacity-75"></i>
                </div>
              </div>
            </div>
          </div>

          <div class="col-sm-4 col-xl-3">
            <div class="card card-body bg-blue-400 has-bg-image">
              <div class="media">
                <div class="media-body">
                  <h3 class="mb-0">{{ para($tedarikci->sum('bakiye')) }}</h3>
                <span class="text-uppercase font-size-xs"><b>{{ para($tedarikci->sum('bakiye')) }}</b> ÇEK/SENET T.</span>
                </div>

                <div class="ml-3 align-self-center">
                  <i class="icon-file-check icon-3x opacity-75"></i>
                </div>
              </div>
            </div>
          </div>






          <div class="col-sm-4 col-xl-3">
            <div class="card card-body bg-violet-400 has-bg-image">
              <div class="media">
                <div class="media-body text-left">
                  <h3 class="mb-0">{{ para($tedarikci->sum('bakiye')) }}</h3>
                  <span class="text-uppercase font-size-xs"><b>{{ count($tedarikci) }}</b>Müşteri Borcu</span>
                </div>
                <div class="mr-3 align-self-center">
                  <i class="icon-vcard icon-3x opacity-75"></i>
                </div>
              </div>
            </div>
          </div>





        </div>







      </div>
    </div>
  </div>
  


</div>



@endsection
@section('scripts')
@parent

@endsection