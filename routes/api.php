<?php




    Route::get('/musteri', function () {
        return App\Models\Cari01::where('cariadi', 'LIKE', '%' . request('q') . '%')->where('grubu', 'MUSTERI')->paginate(10);
    });

    Route::get('/tedarikciler', function () {
        return App\Models\Cari01::where('cariadi', 'LIKE', '%' . request('q') . '%')->where('grubu', 'TEDARIKCI')->paginate(10);
    });

    Route::get('/urunGetir', function () {
        return App\Models\Urun01::where('urunadi', 'LIKE', '%' . request('q') . '%')->paginate(10);
    });

    // Fatura bilgisi getirme
    Route::get('/fatura/{id}', function () {
        return App\Models\Fatura::where('id', $id)->first();
    });





