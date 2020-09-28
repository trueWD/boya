<?php

namespace App\Http\Controllers\Banka;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Models\Banka01;
use App\Http\Requests\Banka\YeniHesapRequest;
class BankaController extends Controller
{
    /*
    _____________________________________________________________________________________________
    index
    _____________________________________________________________________________________________
    */
    public function index()
    {

        $banka01    = Banka01::all();

        return view('banka.index', compact('banka01'));
    }
    /*
    _____________________________________________________________________________________________
    Store
    _____________________________________________________________________________________________
    */
    public function store(YeniHesapRequest $request)
    {
        if (!Gate::allows('users_manage')) {
            return abort(401);
        }

        $banka       = Banka01::create($request->all());

        $data = [
            'title' => 'Başarılı',
            'text'  => 'Kayıt işlemi Yapıldı',
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
        $banka = Banka01::findOrFail($request->id);
        if($banka->bakiye > 0){
            $data = [
                'title' => 'Hata!',
                'text' => 'Bakiyesi olan hesap silinemez!..',
                'type' => 'error',
            ];
            return response()->json($data);
        }
        $banka->delete();

        $data = [
            'title' => 'Başarılı!',
            'text' => 'Hesap Silindi',
            'type' => 'success',
        ];

        return response()->json($data);
    }





}
