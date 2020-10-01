<?php

namespace App\Http\Controllers\Tahsilat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Models\Cari01;
use App\Models\Siparis01;
use App\Models\Tahsilat01;
use App\Models\Urun01;
use App\Models\Siparis02;
use App\Models\Banka01;
use App\User;
use App\Models\Params;
use App\Http\Requests\Tahsilat\YeniTahsilatRequest;
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
    /*
    _____________________________________________________________________________________________
    Store
    _____________________________________________________________________________________________
    */
    public function store(YeniTahsilatRequest $request)
    {

        $cari01     = Cari01::findOrFail($request->cariid);

        $tutar      = tutarToRaw($request->tutar);

       // dd($request->all());
        $data               = new Tahsilat01;
        $data->tutar        = paraEn($tutar);
        $data->odemetipi    = $request->odemetipi;
        $data->aciklama     = $request->aciklama;
        $data->save();

        $cari01->bakiye     = paraEn($request->bakiye + $tutar);
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
    Borç Kapat
    _____________________________________________________________________________________________
    */
    public function BorcKapat(Request $request)
    {

        $sip    = Siparis01::findOrFail($request->id);
        $car    = Cari01::findOrFail($sip->cari01);

        if ($sip->toplam_tutar > $car->bakiye) {
            $data = [
                'title' => 'HATA!',
                'text' => 'Müşteri bakiyesi yetersiz!..',
                'type' => 'warning',
            ];
            return response()->json($data);
        }

        $sip->tarih_odeme   = now();
        $sip->save();

        $car->bakiye     = paraEn($car->bakiye - $sip->toplam_tutar);
        $car->save();



        $cari01     = Cari01::findOrFail($sip->cari01);
        $siparis01  = Siparis01::with('user')->where('cari01', '=', $sip->cari01)->where('odemetipi', '=', 'VERESIYE')->whereNull('tarih_odeme')->orderBy('id', 'ASC')->get();


        $BorcListesi  = view(
            'tahsilat.borclar',
            [
                'siparis01' => $siparis01,
                'cari01' => $cari01,
            ]
        )->render();



        $data = [
            'title' => 'Başarılı!',
            'text'  => 'Ödeme kayıt edildi.',
            'type'  => 'success',
            'BorcListesi'  => $BorcListesi,
        ];

        return response()->json($data);
    }
    /*
    _____________________________________________________________________________________________
    Fiyat Güncelle
    _____________________________________________________________________________________________
    */
    public function FiyatGuncelle(Request $request)
    {


        $car    = Cari01::findOrFail($request->id);

        $siparis01  = Siparis01::with('user','siparis02')->where('cari01', '=', $request->id)->where('odemetipi', '=', 'VERESIYE')->where('anlasma', '=', 'GUNCEL')->whereNull('tarih_odeme')->get();
        
        // Fiyatları Güncelle
        foreach ($siparis01 as $sip) {
            
            foreach ($sip->siparis02 as $row) {
                $urun01     = Urun01::find($row->urun01);
                $siparis02  = Siparis02::find($row->id);

                $siparis02->fiyat   = $urun01->satis_fiyat;
                $siparis02->kdv     = $urun01->kdv;
                $siparis02->save();
            }

        }

      //  dd("Tamam");

        // Toplamları güncelle
        foreach ($siparis01 as $sip) {

            $siparis  = Siparis01::with('siparis02')->find($sip->id);
            $kdvDahilToplam = 0;
            $kdvMiktarToplam = 0;
            $iskontoTutarToplam = 0;
            foreach ($siparis->siparis02 as $row) {

                $toplam             = $row->fiyat * $row->miktar;
                $iskontoTutar       = $toplam * ($row->iskonto / 100);
                $iskontoluToplam    = $toplam - $iskontoTutar;
                $kdvMiktar          = $iskontoluToplam * ($row->kdv / 100);
                $kdvDahil           = $iskontoluToplam + $kdvMiktar;

                $kdvDahilToplam     = $kdvDahilToplam + $kdvDahil;
                $kdvMiktarToplam    = $kdvMiktarToplam + $kdvMiktar;
                $iskontoTutarToplam = $iskontoTutarToplam + $iskontoTutar;

            }

            $siparis->toplam_tutar    = $kdvDahilToplam;
            $siparis->toplam_kdv      = $kdvMiktarToplam;
            $siparis->toplam_iskonto  = $iskontoTutarToplam;
            $siparis->userid          = auth()->id();
            $siparis->save();

        }

        // Sipariş listesi

        $siparisler  = Siparis01::with('user')->where('cari01', '=', $request->id)->where('odemetipi', '=', 'VERESIYE')->whereNull('tarih_odeme')->orderBy('id', 'ASC')->get();


        $BorcListesi  = view(
            'tahsilat.borclar',
            [
                'siparis01' => $siparisler,
                'cari01' => $car,
            ]
        )->render();


        $data = [
            'title' => 'Başarılı!',
            'text'  => 'Fiyatlar güncellendi...',
            'type'  => 'success',
            'BorcListesi'  => $BorcListesi,
        ];

        return response()->json($data);
    }








}
