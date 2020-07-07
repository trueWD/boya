<?php

Route::group(['prefix' => '/v1', 'namespace' => 'Api\V1', 'as' => 'api.'], function () {

});

Route::get('/cari/icpiyasa',function(){
    return App\Models\Cari01::where('cariadi','LIKE','%'.request('q').'%')->where('grubu','MUSTERI')->paginate(10);
});
Route::get('/tedarikciler',function(){
    return App\Models\Cari01::where('cariadi','LIKE','%'.request('q').'%')->where('grubu','TEDARIKCI')->paginate(10);
});
Route::get('/teberru',function(){
    return App\Models\Cari01::where('cariadi','LIKE','%'.request('q').'%')->where('grubu','TEBERRU')->paginate(10);
});
Route::get('/ortaklar',function(){
    return App\Models\Cari01::where('cariadi','LIKE','%'.request('q').'%')->where('grubu','ORTAK')->paginate(10);
});



Route::get('/urunGetir',function(){
    return App\Models\Urun01::where('urunadi','LIKE','%'.request('q').'%')->paginate(10);
});

Route::get('/stok/{stokid}',function(){
    return App\Models\Stok::where('id',$stokid)->first();
});

// Fatura bilgisi getirme
Route::get('/fatura/{id}',function(){
    return App\Models\Fatura::where('id',$id)->first();
});
