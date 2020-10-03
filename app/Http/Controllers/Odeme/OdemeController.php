<?php

namespace App\Http\Controllers\Odeme;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Gate;
use App\Models\Cari01;
use App\Models\Odeme01;
use App\Models\Banka01;
use App\User;
use App\Models\Params;
use App\Http\Requests\Odeme\YeniOdemeRequest;

class OdemeController extends Controller
{
    /*
    _____________________________________________________________________________________________
    index
    _____________________________________________________________________________________________
    */
    public function index()
    {

        $odeme01     = Odeme01::with('user', 'cari')->whereDate('created_at', '=', date('Y-m-d'))->orderBy('id', 'DESC')->get();


        return view('odeme.index', compact('odeme01'));
    }
    /*
    _____________________________________________________________________________________________
    Store
    _____________________________________________________________________________________________
    */
    public function store(YeniOdemeRequest $request)
    {

        $cari01     = Cari01::findOrFail($request->cariid);

        $tutar      = tutarToRaw($request->tutar);

        // dd($request->all());
        $data               = new Odeme01;
        $data->cari01       = $request->cariid;
        $data->tutar        = paraEn($tutar);
        $data->odemetipi    = $request->odemetipi;
        $data->dekontno     = $request->dekontno;
        $data->banka        = $request->banka;
        $data->aciklama     = $request->aciklama;
        $data->userid       = auth()->id();
        $data->save();

        $cari01->bakiye     = paraEn($request->bakiye - $tutar);
        $cari01->save();

        $data = [
                'title' => 'Başarılı!',
                'text'  => 'Ödeme kayıt edildi.',
                'type'  => 'success',
            ];

        return response()->json($data);
    }
    /*
    _____________________________________________________________________________________________
    Odeme Sil
    _____________________________________________________________________________________________
    */
    public function OdemeSil(Request $request)
    {

        //dd($request->id);
        $odeme01        = Odeme01::findOrFail($request->id);
        $cari01         = Cari01::findOrFail($odeme01->cari01);
        $cari01->bakiye = paraEn($cari01->bakiye + $odeme01->tutar);
        $cari01->save();
        $odeme01->delete();


        $data = [
            'title' => 'BAŞARILI',
            'text' => 'Ödeme Silindi...',
            'type' => 'success',
        ];
        return response()->json($data);
    }
    /*
    _____________________________________________________________________________________________
    Odeme Raporu Sorgula
    _____________________________________________________________________________________________
    */
    public function OdemeRaporu(request $request)
    {

        $tarih      = date('Y-m-d',
            strtotime($request->enddate_submit . ' + 1 days')
        );

        $odeme01   = Odeme01::with('user', 'cari')
        ->when($request->cariid, function ($query) {
            return $query->where('cari01', request('cariid'));
        })
        ->whereBetween('created_at', [$request->startdate_submit, $tarih])
            ->orderBy('id', 'DESC')
            ->get();

        $rapor  = view(
            'odeme.rapor',
            [
                'odeme01' => $odeme01,
            ]
        )->render();

        $data = [
            'title' => 'Başarılı!',
            'text'  => 'Rapor Çekildi',
            'type'  => 'success',
            'rapor'  => $rapor,
        ];

        return response()->json($data);
    }


}
