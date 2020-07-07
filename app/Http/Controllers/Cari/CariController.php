<?php

namespace App\Http\Controllers\Cari;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Models\Cari01;
use App\User;
use App\Models\Params;
use App\Http\Requests\Cari\StoreCariRequest;

class CariController extends Controller
{
    /*
    _____________________________________________________________________________________________
    index
    _____________________________________________________________________________________________
    */
    public function index()
    {
  
        $cariler    = Cari01::all();
        $users      = User::all();
        $params     = Params::where('database','=','cari01')->get();

        $carigrubu = $params->filter(function ($row) {
            return $row->database == 'cari01' AND $row->alan == 'grubu';
        });


        return view('cari.index', compact('cariler','carigrubu','users'));
    }
    /*
    _____________________________________________________________________________________________
    Store
    _____________________________________________________________________________________________
    */
    public function store(StoreCariRequest $request)
    {
        if (! Gate::allows('users_manage')) {
            return abort(401);
        }

        $cari       = Cari01::create($request->all());

        $data =[
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
        $cari = Cari01::findOrFail($request->id);
        $cari->delete();

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

        $cari       = Cari01::findOrFail($request->id);
        $users      = User::all();
        $params     = Params::where('database','=','cari01')->get();
        $carigrubu  = $params->filter(function ($row) {
            return $row->database == 'cari01' AND $row->alan == 'grubu';
        });


        
        $data['cariedit']       = view('cari.edit',
        [
            'cari' => $cari,
            'carigrubu' => $carigrubu,
            'users' => $users,
            ])->render();
        return response()->json($data);

    }

    /*
    _____________________________________________________________________________________________
    Update
    _____________________________________________________________________________________________
    */
    public function update(StoreCariRequest $request)
    {
        if (! Gate::allows('users_manage')) {
            return abort(401);
        }

        $cari   = Cari01::findOrFail($request->id);
        $cari->update($request->all());

        $data =[
            'title' => 'Başarılı!',
            'text'  => 'Kayıt başarılı',
            'type'  => 'success',
          ];

        return response()->json($data);
    }

    /*
    _____________________________________________________________________________________________
    index
    _____________________________________________________________________________________________
    */
    public function show($id)
    {
        if (!Gate::allows('users_manage')) {
            return abort(401);
        }

        $cari       = Cari01::findOrFail($id);

        return view('cari.show', compact('cari'));
    }
}
