<?php

namespace App\Http\Controllers\Tahsilat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Models\Cari01;
use App\Models\Siparis01;
use App\Models\Urun01;
use App\Models\Siparis02;
use App\Models\Banka01;
use App\User;
use App\Models\Params;
use App\Http\Requests\Satis\VeresiyeKapatRequest;
class TahsilatController extends Controller
{
    /*
    _____________________________________________________________________________________________
    index
    _____________________________________________________________________________________________
    */
    public function index()
    {

        return view('tahsilat.index');
    }

    /*
    _____________________________________________________________________________________________
    Borc Listesi
    _____________________________________________________________________________________________
    */
    public function BorcListesi(Request $request)
    {
        $cari01     = Cari01::findOrFail($request->cariid);
        $siparis01  = Siparis01::with('user')->where('cari01','=',$request->cariid)->where('odemetipi','=','VERESIYE')->whereNull('tarih_odeme')->orderBy('id','ASC')->get();
      

        $BorcListesi  = view(
            'tahsilat.borclar',
            [
                'siparis01' => $siparis01,
                'cari01' => $cari01,
            ]
        )->render();


        $data = [
            'title' => 'Başarılı!',
            'text'  => 'Kayıt başarılı',
            'type'  => 'success',
            'BorcListesi'  => $BorcListesi,
        ];

        return response()->json($data);
    }








}
