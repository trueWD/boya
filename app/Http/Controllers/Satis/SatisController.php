<?php

namespace App\Http\Controllers\Satis;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Models\Cari01;
use App\Models\Siparis01;
use App\Models\Urun01;
use App\Models\Urun02;
use App\Models\Siparis02;
use App\Models\Banka01;
use App\User;
use App\Models\Params;
use App\Http\Requests\Satis\VeresiyeKapatRequest;

class SatisController extends Controller
{
    /*
    _____________________________________________________________________________________________
    index
    _____________________________________________________________________________________________
    */
    public function index()
    {

        $siparisler     = Siparis01::with('user','cari')->whereDate('created_at', '=', date('Y-m-d'))->orWhere('durumu','=','AKTIF')->orderBy('id','DESC')->get();



        return view('satis.index', compact('siparisler'));
    }

    /*
    _____________________________________________________________________________________________
    Store
    _____________________________________________________________________________________________
    */
    public function store()
    {

        $data = new Siparis01;
        $data->userid = auth()->id();
        $data->depo01 = auth()->user()->depo01;
        $data->durumu = 'AKTIF';
        $data->save();
        
        //return Redirect()->url('satis/' . $data->id);
       // return redirect('satis/' . $data->id);
        // return redirect()->route('dashboard');
        return Redirect()->to('satis/' . $data->id);
    }

    /*
    _____________________________________________________________________________________________
    Show Fatura Ekle
    _____________________________________________________________________________________________
    */
    public function show($id)
    {

        if (!Gate::allows('users_manage')) {
            return abort(401);
        }

        $siparis01      = Siparis01::with('siparis02')->findOrFail($id);
        $siparis02      = Siparis02::with('urunbilgisi')->where('siparis01','=', $siparis01->id)->get();
        $banka01        = Banka01::all();


       // dd($siparis02);
        return view('satis.show', compact('siparis01','siparis02','banka01'));

    }
    /*
    _____________________________________________________________________________________________
    Barkod oku ürün ekle
    _____________________________________________________________________________________________
    */
    public function BarkodOku(Request $request)
    {

        $urun01     = Urun01::where('barkod', '=', $request->barkod)->first();
        $user   = User::find(auth()->id());

        //dd($urun01);

        if($urun01 == NULL){
            $data = [
                'title' => 'HATA!',
                'text' => 'Böyle bir ürün yok!',
                'type' => 'warning',
            ];
            return response()->json($data);
        }

        $siparis01     = Siparis01::with('siparis02')->where('id', '=', $request->id)->first();

        $guncelle     = Siparis02::where('urun01', '=', $urun01->id)->where('siparis01', '=', $siparis01->id)->first();


        if($guncelle == NULL){
            // Ürün yoksa

            $ekle                   = new Siparis02;
            $ekle->siparis01        = $siparis01->id;
            $ekle->urun01           = $urun01->id;
            $ekle->birim            = $urun01->birim;
            $ekle->miktar           = 1;
            $ekle->fiyat            = $urun01->satis_fiyat;
            $ekle->iskonto          = $request->iskonto;
            $ekle->kdv              = $urun01->kdv;
            $ekle->iskonto          = 0;
            $ekle->userid           = $user->id;
            $ekle->save();
            
            
        }else{
            // Bu siparişte zaten bu ürün varise


            $guncelle->miktar = $guncelle->miktar + 1;

            $guncelle->save();
            
            

        }
        $data = [
            'title' => 'BAŞARILI',
            'text' => 'Ürün Eklendi...',
            'type' => 'success',
        ];
        return response()->json($data);

    }
    /*
    _____________________________________________________________________________________________
   Ürün id oku ürün ekle
    _____________________________________________________________________________________________
    */
    public function UrunGiris(Request $request)
    {

    
        $urun01     = Urun01::where('id', '=', $request->urunid)->first();
        $user       = User::find(auth()->id());

        //dd($urun01);

        if($urun01 == NULL){
            $data = [
                'title' => 'HATA!',
                'text' => 'Böyle bir ürün yok!',
                'type' => 'warning',
            ];
            return response()->json($data);
        }

        $siparis01     = Siparis01::with('siparis02')->where('id', '=', $request->id)->first();

        $guncelle     = Siparis02::where('urun01', '=', $urun01->id)->where('siparis01', '=', $siparis01->id)->first();


        if($guncelle == NULL){
            // Ürün yoksa

            $ekle                   = new Siparis02;
            $ekle->siparis01        = $siparis01->id;
            $ekle->urun01           = $urun01->id;
            $ekle->birim            = $urun01->birim;
            $ekle->miktar           = 1;
            $ekle->fiyat            = $urun01->satis_fiyat;
            $ekle->iskonto          = $request->iskonto;
            $ekle->kdv              = $urun01->kdv;
            $ekle->iskonto          = 0;
            $ekle->userid           = $user->id;
            $ekle->save();
            
            
        }else{
            // Bu siparişte zaten bu ürün varise


            $guncelle->miktar = $guncelle->miktar + 1;

            $guncelle->save();
            
            

        }
        $data = [
            'title' => 'BAŞARILI',
            'text' => 'Ürün Eklendi...',
            'type' => 'success',
        ];
        return response()->json($data);

    }
    /*
    _____________________________________________________________________________________________
    Nakit Kapat
    _____________________________________________________________________________________________
    */
    public function NakitKapat(Request $request)
    {

        $siparis01      = Siparis01::with('siparis02')->findOrFail($request->id);

        //dd($urun01);

        if($siparis01->durumu != 'AKTIF'){
            $data = [
                'title' => 'HATA!',
                'text' => 'Bu fiş kapalı!',
                'type' => 'warning',
            ];
            return response()->json($data);
        }

        $kdvDahilToplam = 0;
        $kdvMiktarToplam = 0;
        $iskontoTutarToplam = 0;
        foreach ($siparis01->siparis02 as $row) {

            $toplam             = $row->fiyat * $row->miktar;
            $iskontoTutar       = $toplam * ($row->iskonto / 100);
            $iskontoluToplam    = $toplam - $iskontoTutar;
            $kdvMiktar          = $iskontoluToplam * ($row->kdv / 100);
            $kdvDahil           = $iskontoluToplam + $kdvMiktar;

            $kdvDahilToplam     = $kdvDahilToplam + $kdvDahil;
            $kdvMiktarToplam    = $kdvMiktarToplam + $kdvMiktar;
            $iskontoTutarToplam = $iskontoTutarToplam + $iskontoTutar;

            // Stok kartını güncelle
            $urun01             = Urun01::findOrFail($row->urun01);
            $urun01->satilan    = $urun01->satilan + $row->miktar;
            $urun01->save();



            $urun02     = Urun02::where('urun01', '=', $urun01->id)->where('depo01', '=', auth()->user()->depo01 )->first();
            if ($urun02 == NULL) {

                // Ürün yoksa
                $ekle                   = new Urun02;
                $ekle->depo01           = auth()->user()->depo01;
                $ekle->urun01           = $urun01->id;
                $ekle->miktar           = 0 - $row->miktar;
                $ekle->save();
            } else {

                // Bu siparişte zaten bu ürün varise
                $urun02->miktar = $urun02->miktar - $row->miktar;
                $urun02->save();
            }






         



        }


        // Ürün yoksa

        $siparis01->durumu          = 'TAMAM';
        $siparis01->toplam_tutar    = $kdvDahilToplam;
        $siparis01->toplam_kdv      = $kdvMiktarToplam;
        $siparis01->toplam_iskonto  = $iskontoTutarToplam;
        $siparis01->odemetipi       = "NAKIT";
        $siparis01->userid          = auth()->id();
        $siparis01->save();
            
 
        $data = [
            'title' => 'BAŞARILI',
            'text' => 'Satış kapatıldı...',
            'type' => 'success',
        ];
        return response()->json($data);

    }
    /*
    _____________________________________________________________________________________________
    KART Kapat
    _____________________________________________________________________________________________
    */
    public function KartKapat(Request $request)
    {

        $siparis01      = Siparis01::with('siparis02')->findOrFail($request->id);
        $banka01        = Banka01::findOrFail($request->banka01);

        //dd($urun01);

        if($siparis01->durumu != 'AKTIF'){
            $data = [
                'title' => 'HATA!',
                'text' => 'Bu fiş kapalı!',
                'type' => 'warning',
            ];
            return response()->json($data);
        }

        $kdvDahilToplam = 0;
        $kdvMiktarToplam = 0;
        $iskontoTutarToplam = 0;
        foreach ($siparis01->siparis02 as $row) {

            $toplam             = $row->fiyat * $row->miktar;
            $iskontoTutar       = $toplam * ($row->iskonto / 100);
            $iskontoluToplam    = $toplam - $iskontoTutar;
            $kdvMiktar          = $iskontoluToplam * ($row->kdv / 100);
            $kdvDahil           = $iskontoluToplam + $kdvMiktar;

            $kdvDahilToplam     = $kdvDahilToplam + $kdvDahil;
            $kdvMiktarToplam    = $kdvMiktarToplam + $kdvMiktar;
            $iskontoTutarToplam = $iskontoTutarToplam + $iskontoTutar;

            // Stok kartını güncelle

            $urun01             = Urun01::findOrFail($row->urun01);
            $urun01->satilan    = $urun01->satilan + $row->miktar;
            $urun01->save();

            $urun02     = Urun02::where('urun01', '=', $urun01->id)->where('depo01', '=', auth()->user()->depo01)->first();
            if ($urun02 == NULL) {

                // Ürün yoksa
                $ekle                   = new Urun02;
                $ekle->depo01           = auth()->user()->name;
                $ekle->urun01           = $urun01->id;
                $ekle->miktar           = 0 - $row->miktar;
                $ekle->save();
            } else {

                // Bu siparişte zaten bu ürün varise
                $urun02->miktar = $urun02->miktar - $row->miktar;
                $urun02->save();
            }



        }
       
        // Banka güncelle
        $banka01->bakiye    = $banka01->bakiye + $kdvDahilToplam;
        $banka01->save();
        
        $siparis01->durumu          = 'TAMAM';
        $siparis01->toplam_tutar    = $kdvDahilToplam;
        $siparis01->toplam_kdv      = $kdvMiktarToplam;
        $siparis01->toplam_iskonto  = $iskontoTutarToplam;
        $siparis01->banka01         = $banka01->id;
        $siparis01->odemetipi       = "KART";
        $siparis01->userid          = auth()->id();
        $siparis01->save();
            
 
        $data = [
            'title' => 'BAŞARILI',
            'text' => 'Satış kapatıldı...',
            'type' => 'success',
        ];
        return response()->json($data);

    }
    /*
    _____________________________________________________________________________________________
    Veresiye Kapat
    _____________________________________________________________________________________________
    */
    public function VeresiyeKapat(VeresiyeKapatRequest $request)
    {

        $siparis01      = Siparis01::with('siparis02')->findOrFail($request->id);
        $cari01         = Cari01::findOrFail($request->cariid);

        //dd($urun01);

        if($siparis01->durumu != 'AKTIF'){
            $data = [
                'title' => 'HATA!',
                'text' => 'Bu fiş kapalı!',
                'type' => 'warning',
            ];
            return response()->json($data);
        }

        $kdvDahilToplam = 0;
        $kdvMiktarToplam = 0;
        $iskontoTutarToplam = 0;
        foreach ($siparis01->siparis02 as $row) {

            $toplam             = $row->fiyat * $row->miktar;
            $iskontoTutar       = $toplam * ($row->iskonto / 100);
            $iskontoluToplam    = $toplam - $iskontoTutar;
            $kdvMiktar          = $iskontoluToplam * ($row->kdv / 100);
            $kdvDahil           = $iskontoluToplam + $kdvMiktar;

            $kdvDahilToplam     = $kdvDahilToplam + $kdvDahil;
            $kdvMiktarToplam    = $kdvMiktarToplam + $kdvMiktar;
            $iskontoTutarToplam = $iskontoTutarToplam + $iskontoTutar;

            // Stok kartını güncelle

            $urun01             = Urun01::findOrFail($row->urun01);
            $urun01->satilan    = $urun01->satilan + $row->miktar;
            $urun01->save();

            $urun02     = Urun02::where('urun01', '=', $urun01->id)->where('depo01', '=', auth()->user()->depo01)->first();
            if ($urun02 == NULL) {

                // Ürün yoksa
                $ekle                   = new Urun02;
                $ekle->depo01           = auth()->user()->name;
                $ekle->urun01           = $urun01->id;
                $ekle->miktar           = 0 - $row->miktar;
                $ekle->save();
            } else {

                // Bu siparişte zaten bu ürün varise
                $urun02->miktar = $urun02->miktar - $row->miktar;
                $urun02->save();
            }



        }
       
        // Banka güncelle
        
        $siparis01->durumu          = 'TAMAM';
        $siparis01->toplam_tutar    = $kdvDahilToplam;
        $siparis01->toplam_kdv      = $kdvMiktarToplam;
        $siparis01->toplam_iskonto  = $iskontoTutarToplam;
        $siparis01->cari01          = $cari01->id;
        $siparis01->tarih_vade      = $request->tarih_vade_submit;
        $siparis01->anlasma         = $request->anlasma;
        $siparis01->odemetipi       = "VERESIYE";
        $siparis01->userid          = auth()->id();
        $siparis01->save();
            
 
        $data = [
            'title' => 'BAŞARILI',
            'text' => 'Satış kapatıldı...',
            'type' => 'success',
        ];
        return response()->json($data);

    }
    /*
    _____________________________________________________________________________________________
    Ürün Arttır
    _____________________________________________________________________________________________
    */
    public function UrunArtir(Request $request)
    {

        $siparis02          = Siparis02::findOrFail($request->id);
        $siparis02->miktar  = $siparis02->miktar + 1;
        $siparis02->save();
        $data = [
            'title' => 'BAŞARILI',
            'text' => 'Ürün miktarı çoğaştıldı...',
            'type' => 'success',
        ];
        return response()->json($data);

    }
    /*
    _____________________________________________________________________________________________
    Ürün Azalt
    _____________________________________________________________________________________________
    */
    public function UrunAzalt(Request $request)
    {

        $siparis02              = Siparis02::findOrFail($request->id);
        if($siparis02->miktar == 1){

            $data = [
                'title' => 'UYARI',
                'text' => 'Son 1 ürün silinmez...',
                'type' => 'warning',
            ];
            return response()->json($data);

        }else{

            $siparis02->miktar      = $siparis02->miktar - 1;
            $siparis02->save();
        }

        $data = [
            'title' => 'BAŞARILI',
            'text' => 'Ürün miktarı azaltıldı...',
            'type' => 'success',
        ];
        return response()->json($data);

    }
    /*
    _____________________________________________________________________________________________
    Ürün Azalt
    _____________________________________________________________________________________________
    */
    public function UrunSil(Request $request)
    {

        Siparis02::where('id', '=', $request->id)->delete();

        $data = [
            'title' => 'BAŞARILI',
            'text' => 'Ürün silindi...',
            'type' => 'success',
        ];
        return response()->json($data);

    }
    /*
    _____________________________________________________________________________________________
    Fiş İptal
    _____________________________________________________________________________________________
    */
    public function FisIptal(Request $request)
    {

        $siparis01     = Siparis01::findOrFail($request->id);

        Siparis02::where('siparis01','=', $siparis01->id)->update(['deleted_at' => now()]);

        $siparis01->delete();


        $data = [
            'title' => 'BAŞARILI',
            'text' => 'Fiş iptal edildi...',
            'type' => 'success',
        ];
        return response()->json($data);

    }
    /*
    _____________________________________________________________________________________________
    Fiş Yazdır
    _____________________________________________________________________________________________
    */
    public function FisYazdir($id)
    {

        $siparis01     = Siparis01::with('siparis02')->findOrFail($id);
        $siparis02     = Siparis02::with('urunbilgisi')->where('siparis01', '=', $siparis01->id)->get();

        return view('satis.yazdir', compact('siparis01', 'siparis02'));

    }

    /*
    _____________________________________________________________________________________________
    Satış Raporu
    _____________________________________________________________________________________________
    */
    public function SatisRaporu(Request $request)
    {



        $tarih      = date('Y-m-d', strtotime($request->enddate_submit . ' + 1 days'));

        $siparis01   = Siparis01::with('user', 'cari')
            ->when($request->cariid, function ($query) {
                return $query->where('cari01', request('cariid'));
            })
            ->whereBetween('created_at', [$request->startdate_submit, $tarih])
            ->orderBy('id', 'DESC')
            ->get();




        $rapor  = view(
            'satis.rapor',
            [
                'siparis01' => $siparis01,
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
