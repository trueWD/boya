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
use App\Models\Log01;
use App\Models\Not01;
use App\Models\Onay01;


class UrunKabulController extends Controller
{
    /*
    _____________________________________________________________________________________________
    index
    _____________________________________________________________________________________________
    */
    public function index()
    {
   
    }
    /*
    _____________________________________________________________________________________________
    index
    _____________________________________________________________________________________________
    */
    public function urunKabul()
    {
        if (!Gate::allows('users_manage')) {
            return abort(401);
        }

        $siparisler     = Siparis02::where('durumu','=','SIPARIS')->where('uretim_yeri','!=','CagCelik')->where('uretim_teslim_tarihi','!=',NULL)->orderBy('tarih_termin', 'ASC')->get();

        $params         = Params::all();
        $uretim_yeri    = $params->filter(function ($row) {
            return $row->database == 'siparis02' AND $row->alan == 'uretim_yeri';
        });

       // $siparisler = $siparisler->groupBy('tarih_termin');

        return view('depo.index', compact(
            'siparisler',
            'uretim_yeri',
        ));
    }

}
