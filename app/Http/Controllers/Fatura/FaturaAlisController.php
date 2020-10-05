<?php

namespace App\Http\Controllers\Fatura;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Models\Urun01;
use App\Models\Fiyat01;
use App\Models\Params;
use App\Models\Fatura01;
use App\Models\Fatura02;
use App\Models\Cari01;
use App\User;
use App\Http\Requests\Fatura\AlisFaturaRequest;
use App\Http\Requests\Fatura\AlisUrunEkleRequest;
use App\Http\Requests\Fatura\AlisUrunUpdateRequest;

class FaturaAlisController extends Controller
{
        /*
    _____________________________________________________________________________________________
    index
    _____________________________________________________________________________________________
    */
    public function index()
    {
        if (!Gate::allows('users_manage')) {
            return abort(401);
        }

        $fatura     = Fatura01::where('tipi','=','ALIS')->where('durumu','=','AKTIF')->limit(100)->orderBy('id','DESC')->get();

 


        return view('fatura.alis.index', compact('fatura'));
    }
    /*
    _____________________________________________________________________________________________
    Store
    _____________________________________________________________________________________________
    */
    public function store(AlisFaturaRequest $request)
    {
        if (! Gate::allows('users_manage')) {
            return abort(401);
        }

       // dd($request->all());

       // Gelen dizide çıkarılacak eleman
        $cari       = Cari01::find($request->cariid);
        $post       = $request->except(['tarih_termin','cariid','fatura_tarihi_submit']);
        $user       = User::find(auth()->id());
        $fatura01   = new Fatura01;

        // Posta eklencek yeni elemanlar
        $fatura01->create(array_merge($post,
            [
                'durumu' => 'AKTIF',
                'tipi' => 'ALIS',
                'cari01' => $cari->id,
                'cariadi' => $cari->cariadi,
                'userid' => $user->id,
                'username' => $user->name,
                'fatura_tarihi' => $request->fatura_tarihi_submit,
            ]
        ));
        
        $data =[
            'title' => 'Başarılı!',
            'text'  => 'Kayıt başarılı',
            'type'  => 'success',
          ];

        return response()->json($data);
    }
    /*
    _____________________________________________________________________________________________
    edit 
    _____________________________________________________________________________________________
    */
    public function edit(request $request)
    {
        if (!Gate::allows('users_manage')) {
            return abort(401);
        }

        $fatura01   = Fatura01::findOrFail($request->id);
        
        $data['FaturaEdit']       = view('fatura.alis.edit',
        [
            'fatura01' => $fatura01,
            ])->render();
        return response()->json($data);

    }

    /*
    _____________________________________________________________________________________________
    Update
    _____________________________________________________________________________________________
    */
    public function update(Request $request)
    {
        if (! Gate::allows('users_manage')) {
            return abort(401);
        }


        $faura = Fatura01::find($request->id);

        $faura->fatura_tarihi = $request->fatura_tarihi_submit;
        $faura->faturano = $request->faturano;

        $faura->save();

        $data =[
            'title' => 'Başarılı!',
            'text'  => 'Kayıt başarılı',
            'type'  => 'success',
          ];

        return response()->json($data);
    }

    /*
    _____________________________________________________________________________________________
    Delete
    _____________________________________________________________________________________________
    */
    public function destroy(Request $request)
    {
        if (!Gate::allows('users_manage')) {
            return abort(401);
        }
        
        $fatura = Fatura01::findOrFail($request->id);
        $fatura->delete();

        $data = [
            'title' => 'Başarılı!',
            'text' => 'Fatura Silindi',
            'type' => 'success',
        ];

        return response()->json($data);
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
        $fatura     = Fatura01::with('cari')->findOrFail($id);
        $urunler    = Fatura02::with('urun')->where('fatura01','=', $fatura->id)->get();

        return view('fatura.alis.show', compact('fatura', 'urunler'));

    }
    /*
    _____________________________________________________________________________________________
    Faturaya Ürün Ekle
    _____________________________________________________________________________________________
    */
    public function UrunEkle(AlisUrunEkleRequest $request)
    {
        if (!Gate::allows('users_manage')) {
            return abort(401);
        }
       // dd($request->all());
        $post   = $request->except(['faturaid','urunid','fiyat']);
        $fiyat  = tutarToRaw($request->fiyat);
        $user   = User::find(auth()->id());

        $tutar      = $request->miktar * $fiyat;
        $kdv_tutar  = $tutar * 18 / 100;
        $kdv_dahil  = $kdv_tutar + $tutar;


        $ekle       = new Fatura02;
        $ekle->create(array_merge(
            $post,
            [
                'fatura01' => $request->faturaid,
                'urun01' => $request->urunid,
                'miktar' => $request->miktar,
                'tutar' => paraEn($tutar),
                'fiyat' => $fiyat,
                'kdv' => $request->kdv,
                'kdv_tutar' => paraEn($kdv_tutar),
                'kdv_dahil' => paraEn($kdv_dahil),
                'userid' => $user->id,
    
            ]
        ));
        $fatura     = Fatura01::with('cari')->findOrFail($request->faturaid);
        $urunler    = Fatura02::with('urun')->where('fatura01', '=', $request->faturaid)->get();

        $urun_listesi = view(
            'fatura.alis.urun_listesi',
            [
                'urunler' => $urunler,
                'fatura' => $fatura,
            ]
        )->render();

        $data = [
            'title' => 'Başarılı!',
            'text'  => 'Kayıt başarılı',
            'type'  => 'success',
            'urun_listesi'  => $urun_listesi,
        ];

        return response()->json($data);;

    }

    /*
    _____________________________________________________________________________________________
    Ürün Delete
    _____________________________________________________________________________________________
    */
    public function UrunSil(Request $request)
    {
        if (!Gate::allows('users_manage')) {
            return abort(401);
        }

        $urun = Fatura02::findOrFail($request->id);
        $urun->delete();

        $data = [
            'title' => 'Başarılı!',
            'text' => 'Ürün Silindi',
            'type' => 'success',
        ];

        return response()->json($data);
    }

    /*
    _____________________________________________________________________________________________
    edit 
    _____________________________________________________________________________________________
    */
    public function UrunEdit(request $request)
    {
        if (!Gate::allows('users_manage')) {
            return abort(401);
        }

        $urun       = Fatura02::with('urun')->findOrFail($request->id);
 

        $data['UrunEdit']       = view(
            'fatura.alis.urun_edit',
            [
                'urun' => $urun,
            ]
        )->render();

        return response()->json($data);
    }

    /*
    _____________________________________________________________________________________________
    Update
    _____________________________________________________________________________________________
    */
    public function UrunUpdate(AlisUrunUpdateRequest $request)
    {
        if (!Gate::allows('users_manage')) {
            return abort(401);
        }
        $fiyat  = tutarToRaw($request->fiyat);

        $tutar      = $request->miktar * $fiyat;
        $kdv_tutar  = $tutar * 18 / 100;
        $kdv_dahil  = $kdv_tutar + $tutar;


        $urun   = Fatura02::findOrFail($request->id);
        $urun->fiyat        = $fiyat;
        $urun->miktar       = $request->miktar;
        $urun->kdv          = $request->kdv;
        $urun->tutar        = $tutar;
        $urun->kdv_tutar    = $kdv_tutar;
        $urun->kdv_dahil    = $kdv_dahil;
        $urun->updated_at   = now();
        $urun->save();

        $data = [
            'title' => 'Başarılı!',
            'text'  => 'Kayıt başarılı',
            'type'  => 'success',
        ];

        return response()->json($data);
    }
    /*
    _____________________________________________________________________________________________
    Fatura Kapat
    _____________________________________________________________________________________________
    */
    public function FaturaKapat(Request $request)
    {
        if (!Gate::allows('users_manage')) {
            return abort(401);
        }

        $fatura   = Fatura01::with('urunler')->findOrFail($request->id);
        $fatura->tutar      = paraEn($fatura->urunler->sum('kdv_dahil'));
        $fatura->durumu     = 'KAPALI';
        $fatura->updated_at = now();
        $fatura->save();
        
        // Ürün adetleri kadar stoğu artırma
        foreach ($fatura->urunler as $row) {
            
            $urun       = Urun01::findOrFail($row->urun01);
           
            //Fiyat Güncelle
                $fiyat01    = Fiyat01::findOrFail($urun->fiyat_grubu);
                $oran               = $row->fiyat * ($fiyat01->oran / 100);
                $satis_fiyat        = $row->fiyat + $oran;
                $urun->satis_fiyat  = $satis_fiyat;

            $urun->fiyat        = paraEn($row->fiyat);

            $urun->stok     = paraEn($urun->stok + $row->miktar);
            $urun->save();        


        }
        // cari bakiyesi artırma
        $cari   = Cari01::findOrFail($fatura->cari01);
        $cari->bakiye     = paraEn($cari->bakiye + $fatura->urunler->sum('kdv_dahil'));
        $cari->save();
        
        $data = [
            'title' => 'Başarılı!',
            'text'  => 'Kayıt başarılı',
            'type'  => 'success',
        ];

        return response()->json($data);
    }
    /*
    _____________________________________________________________________________________________
    Fatura  Geri Al
    _____________________________________________________________________________________________
    */
    public function FaturaGeriAl(Request $request)
    {
        if (!Gate::allows('users_manage')) {
            return abort(401);
        }

        $fatura   = Fatura01::with('urunler')->findOrFail($request->id);
        $fatura->tutar      = 0;
        $fatura->durumu     = 'AKTIF';
        $fatura->updated_at = now();
        $fatura->save();
        
        // Ürün adetleri kadar stoğu artırma
        foreach ($fatura->urunler as $row) {

            $urun   = Urun01::findOrFail($row->urun01);
            $urun->stok     = paraEn($urun->stok - $row->miktar);
            $urun->save();        


        }
        // cari bakiyesi artırma
        $cari   = Cari01::findOrFail($fatura->cari01);
        $cari->bakiye     = paraEn($cari->bakiye - $fatura->urunler->sum('kdv_dahil'));
        $cari->save();
        
        $data = [
            'title' => 'Başarılı!',
            'text'  => 'Kayıt başarılı',
            'type'  => 'success',
        ];

        return response()->json($data);
    }
    /*
    _____________________________________________________________________________________________
    Fatura Raporu
    _____________________________________________________________________________________________
    */
    public function FaturaRaporu(Request $request)
    {
        if (!Gate::allows('users_manage')) {
            return abort(401);
        }


        $tarih      = date('Y-m-d', strtotime($request->enddate_submit . ' + 1 days'));

        $islem_listesi   = Fatura01::where('tipi', '=', 'ALIS')
                        ->where('durumu', '!=', 'AKTIF')
                        ->when($request->cariid, function ($query) {
                            return $query->where('cari01', request('cariid'));
                        })
                        ->whereBetween('created_at', [$request->startdate_submit, $tarih])
                        ->orderBy('id', 'DESC')
                        ->get();




        $rapor  = view(
                        'fatura.alis.rapor',
                        [
                            'fatura' => $islem_listesi,
                        ]
                    )->render();




        
        $data = [
            'title' => 'Başarılı!',
            'text'  => 'Kayıt başarılı',
            'type'  => 'success',
            'rapor'  => $rapor,
        ];

        return response()->json($data);
    }


    
}
