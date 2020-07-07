<?php

namespace App\Http\Controllers\Depo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Gate;
use App\Models\Siparis01;
use App\Models\Siparis02;
use App\Models\Cari01;
use App\Models\Params;
use App\Models\Ulke;
use App\Models\Sehir;
use App\Models\Urun01;
use App\Models\Urun02;
use App\Models\Log01;
use App\Models\Not01;
use App\Models\Onay01;
use App\Models\Uretim01;
use App\Http\Requests\Depo\PiysaEtiketOlusturRequest;




class EtiketController extends Controller
{

    /*
    _____________________________________________________________________________________________
    Etiket
    _____________________________________________________________________________________________
    */
    public function index()
    {
        if (!Gate::allows('users_manage')) {
            return abort(401);
        }

        $siparisler     = Siparis02::where('durumu','=','SIPARIS')->where('uretim_yeri','!=','CagCelik')->where('uretim_teslim_tarihi','!=',NULL)->orderBy('tarih_termin', 'ASC')->get();

        $uretim     = Uretim01::where('durumu','=','AKTIF')->orderBy('tarih_uretim', 'ASC')->get();

        $piyasa_siparisler    = $uretim->filter(function ($row) {
            return $row->bolge == 'PIYASA';
        });
        $ihracat_siparisler    = $uretim->filter(function ($row) {
            return $row->bolge == 'IHRACAT';
        });


        $params         = Params::all();
        $uretim_yeri    = $params->filter(function ($row) {
            return $row->database == 'siparis02' AND $row->alan == 'uretim_yeri';
        });


       // $siparisler = $siparisler->groupBy('tarih_termin');

        return view('depo.etiket.index', compact(
            'siparisler',
            'uretim_yeri',
            'piyasa_siparisler',
            'ihracat_siparisler',
        ));
    }


    /*
    _____________________________________________________________________________________________
    İç Piyasa Etiket Oluştur Form 
    _____________________________________________________________________________________________
    */
    public function PiyasaEtiket(request $request)
    {
        if (!Gate::allows('users_manage')) {
            return abort(401);
        }

        $siparis02  = Siparis02::findOrFail($request->id);
        $siparis01  = Siparis01::findOrFail($siparis02->siparisid);
        $urun02     = Urun02::where('siparis02','=',$siparis02->id)->get();

        
        $data['PiyasaEtiket']       = view('depo.etiket.piyasa',
        [
            'siparis01' => $siparis01,
            'siparis02' => $siparis02,
            'urun02' => $urun02,

            ])->render();
        return response()->json($data);

    }
    /*
    _____________________________________________________________________________________________
    İç Piyasa Etiket Oluştur 
    _____________________________________________________________________________________________
    */
    public function PiyasaEtiketOlustur(request $request)
    {
        if (!Gate::allows('users_manage')) {
            return abort(401);
        }

        $siparis02  = Siparis02::findOrFail($request->id);
        $siparis01  = Siparis01::findOrFail($siparis02->siparisid);




        $urun02     = Urun02::where('siparis02','=',$siparis02->id)->get();  
        $etiket_listesi = view('depo.etiket.piyasa_liste',
        [
            'urun02' => $urun02,
        ])->render();
        
        $data =[
            'title' => 'Başarılı',
            'text'  => 'Liste Güncellendi...',
            'type'  => 'primary',
            'etiket_listesi'  => $etiket_listesi,
        ];

        return response()->json($data);   

    }


















}
