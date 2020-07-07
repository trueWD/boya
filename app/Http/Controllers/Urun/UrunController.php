<?php

namespace App\Http\Controllers\Urun;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Urun\UrunController;
use App\Models\Urun01;
use App\Models\Params;
use App\Http\Requests\Urun\StoreUrunRequest;
use App\Http\Requests\Urun\UpdateUrunRequest;



class UrunController extends Controller
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

        $urunler    = Urun01::all();
        $params     = Params::all();

        $marka = $params->filter(function ($row) {
            return $row->database == 'urun01' AND $row->alan == 'marka';
        });

        $grubu = $params->filter(function ($row) {
            return $row->database == 'urun01' AND $row->alan == 'grubu';
        });
        $birim = $params->filter(function ($row) {
            return $row->database == 'urun01' AND $row->alan == 'birim';
        });
 


        return view('urun.index', compact('urunler','marka','grubu','birim'));
    }
    /*
    _____________________________________________________________________________________________
    Store
    _____________________________________________________________________________________________
    */
    public function store(StoreUrunRequest $request)
    {
        if (! Gate::allows('users_manage')) {
            return abort(401);
        }

        $kontrol     = Urun01::where('barkod','=',$request->barkod)->get();

        if($kontrol != NULL){

            $data =[
                'title' => 'HATA!',
                'text'  => 'Böyle bir barkod zaten var!',
                'type'  => 'error',
            ];

            return response()->json($data);

        }



        $urun       = Urun01::create($request->all());

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
        $urun01 = Urun01::findOrFail($request->id);
        $urun01->delete();

        $data = [
            'title' => 'Başarılı!',
            'text' => 'Kullanıcı Silindi',
            'type' => 'success',
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

        $urun       = Urun01::findOrFail($request->id);
        $params     = Params::all();

        $marka = $params->filter(function ($row) {
            return $row->database == 'urun01' AND $row->alan == 'marka';
        });

        $grubu = $params->filter(function ($row) {
            return $row->database == 'urun01' AND $row->alan == 'grubu';
        });
        $birim = $params->filter(function ($row) {
            return $row->database == 'urun01' AND $row->alan == 'birim';
        });
 
        
        $data['urunedit']       = view('urun.edit',
        [
            'urun' => $urun,
            'marka' => $marka,
            'grubu' => $grubu,
            'birim' => $birim,
            ])->render();
        return response()->json($data);

    }

    /*
    _____________________________________________________________________________________________
    Update
    _____________________________________________________________________________________________
    */
    public function update(UpdateUrunRequest $request)
    {
        if (! Gate::allows('users_manage')) {
            return abort(401);
        }

        $urun   = Urun01::findOrFail($request->id);
        $urun->update($request->all());

        $data =[
            'title' => 'Başarılı!',
            'text'  => 'Kayıt başarılı',
            'type'  => 'success',
          ];

        return response()->json($data);
    }

    /*
    _____________________________________________________________________________________________
    Copy 
    _____________________________________________________________________________________________
    */
    public function copy(request $request)
    {
        if (!Gate::allows('users_manage')) {
            return abort(401);
        }

        $urun       = Urun01::findOrFail($request->id);
        $params     = Params::all();

        $kaliteler = $params->filter(function ($row) {
            return $row->database == 'urun01' AND $row->alan == 'kalite';
        });
        $toleranslar = $params->filter(function ($row) {
            return $row->database == 'urun01' AND $row->alan == 'tolerans';
        });
        $urungrubu = $params->filter(function ($row) {
            return $row->database == 'urun01' AND $row->alan == 'grubu';
        });
        $tonajlar = $params->filter(function ($row) {
            return $row->database == 'urun01' AND $row->alan == 'tonaj';
        });
        
        $data['UrunCopy']       = view('urun.copy',
        [
            'urun' => $urun,
            'kaliteler' => $kaliteler,
            'toleranslar' => $toleranslar,
            'urungrubu' => $urungrubu,
            'tonajlar' => $tonajlar,
            ])->render();
        return response()->json($data);

    }
}
