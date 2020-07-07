<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Models\Ulke;
use App\Models\Sehir;
use App\Models\Ilce;

class UlkeSehirIlceCotroller extends Controller
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
    Ülkeye Ait Şehir
    _____________________________________________________________________________________________
    */
    public function ulkeyeyeAitSehirler(Request $request)
    {
        if (! Gate::allows('users_manage')) {
            return abort(401);
        }
        $sehirler   = Sehir::where('country_id','=',$request->id)->get();

        $output = '<option value="">Select Seçiniz</option>';
        foreach($sehirler as $sehir)
        {
         $output .= '<option value="'.$sehir->id.'">'.$sehir->name.'</option>';
        }
        $data=  $output;

        return response()->json($data);

    }
}
