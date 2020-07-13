<?php

namespace App\Http\Controllers\Fatura;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Models\Urun01;
use App\Models\Params;
use App\Models\Fatura01;
use App\Models\Cari01;
use App\User;
use App\Http\Requests\Fatura\AlisFaturaRequest;
use App\Http\Requests\Urun\UpdateUrunRequest;

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

        $fatura     = Fatura01::where('tipi','=','ALIS')->limit(100)->get();

 


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
                'durumu' => 'ACIK',
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
            'text' => 'Kullanıcı Silindi',
            'type' => 'success',
        ];

        return response()->json($data);
    }


    
}
