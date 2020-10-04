<?php

namespace App\Http\Controllers\Depo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Depo01;
use App\Models\Odeme01;

use App\Http\Requests\Depo\YeniDepoRequest;


class DepoController extends Controller
{
    /*
    _____________________________________________________________________________________________
    index
    _____________________________________________________________________________________________
    */
    public function index()
    {

        $depo01     = Depo01::all();


        return view('depo.index', compact('depo01'));
    }
    /*
    _____________________________________________________________________________________________
    Store
    _____________________________________________________________________________________________
    */
    public function store(YeniDepoRequest $request)
    {


        $tutar      = tutarToRaw($request->tutar);

        // dd($request->all());
        $data               = new Depo01;
        $data->depoadi      = $request->depoadi;
        $data->tipi         = $request->depoadi;
        $data->aciklama     = $request->aciklama;
        $data->sira         = $request->sira;
        $data->userid       = auth()->id();
        $data->save();


        $data = [
            'title' => 'Başarılı!',
            'text'  => 'Depo kayıt edildi.',
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
    
        $depo01 = Depo01::findOrFail($request->id);
        $depo01->delete();

        $data = [
            'title' => 'Başarılı!',
            'text' => 'Depo Silindi',
            'type' => 'success',
        ];

        return response()->json($data);
    }



}
