<?php

namespace App\Http\Controllers\Odeme;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Cari01;
use App\Models\Odeme01;

use App\Http\Requests\Odeme\YeniCekRequest;


class CekController extends Controller
{
    /*
    _____________________________________________________________________________________________
    index
    _____________________________________________________________________________________________
    */
    public function index()
    {

        $odeme01     = Odeme01::with('user', 'cari')
            ->where(function ($query) {
                $query->where('odemetipi', '=', 'CEK')
                    ->orWhere('odemetipi', '=', 'SENET');
            })
            ->whereNull('tarih_odeme')
            ->orderBy('tarih_vade', 'ASC')->get();


        return view('cek.index', compact('odeme01'));
    }
    /*
    _____________________________________________________________________________________________
    Store
    _____________________________________________________________________________________________
    */
    public function store(YeniCekRequest $request)
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
        $data->tarih_vade   = $request->tarih_vade_submit;
        $data->userid       = auth()->id();
        $data->save();

        $cari01->bakiye     = paraEn($cari01->bakiye - $tutar);
        $cari01->save();

        $data = [
            'title' => 'Başarılı!',
            'text'  => 'Çek - Senet kayıt edildi',
            'type'  => 'success',
        ];

        return response()->json($data);
    }
    /*
    _____________________________________________________________________________________________
    Çek Raporu Sorgula
    _____________________________________________________________________________________________
    */
    public function CekRaporu(request $request)
    {

        $tarih      = date(
            'Y-m-d',
            strtotime($request->enddate_submit . ' + 1 days')
        );

        $odeme01   = Odeme01::with('user', 'cari')
            ->when($request->cariid, function ($query) {
                return $query->where('cari01', request('cariid'));
            })
            ->where(function ($query) {
                $query->where('odemetipi', '=', 'CEK')
                    ->orWhere('odemetipi', '=', 'SENET');
            })
            ->whereBetween('created_at', [$request->startdate_submit, $tarih])
            ->orderBy('tarih_vade', 'ASC')
            ->get();

        $rapor  = view(
            'cek.rapor',
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
