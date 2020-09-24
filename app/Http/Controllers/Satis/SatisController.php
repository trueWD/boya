<?php

namespace App\Http\Controllers\Satis;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Models\Cari01;
use App\Models\Siparis01;
use App\Models\Urun01;
use App\Models\Siparis02;
use App\User;
use App\Models\Params;
use App\Http\Requests\Cari\StoreCariRequest;

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
        $data->userid = '1';
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

        $siparis01     = Siparis01::with('siparis02')->findOrFail($id);
        $siparis02     = Siparis02::with('urunbilgisi')->where('siparis01','=', $siparis01->id)->get();

       // dd($siparis02);
        return view('satis.show', compact('siparis01','siparis02'));

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

        $guncelle     = Siparis02::where('urun01', '=', $urun01->id)->first();


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
}
