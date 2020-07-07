<?php

namespace App\Http\Controllers\Params;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Models\Params;
use App\Http\Requests\Params\StoreParamRequest;



class ParamsController extends Controller
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

        $params  = Params::orderBy('alan')->get();

        $params = $params->groupBy('alan');

        return view('params.index', compact('params'));
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

        $param              = Params::findOrFail($request->id);
        $data['copyparam']  = view('params.copy',['param' => $param])->render();
        return response()->json($data);

    }

    /*
    _____________________________________________________________________________________________
    Store
    _____________________________________________________________________________________________
    */
    public function store(StoreParamRequest $request)
    {
        if (! Gate::allows('users_manage')) {
            return abort(401);
        }

        $urun       = Params::create($request->all());

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
        $param = Params::findOrFail($request->id);
        $param->delete();

        $data = [
            'title' => 'Başarılı!',
            'text' => 'Kullanıcı Silindi',
            'type' => 'success',
        ];

        return response()->json($data);
    }
    /*
    _____________________________________________________________________________________________
    Copy 
    _____________________________________________________________________________________________
    */
    public function edit(request $request)
    {
        if (!Gate::allows('users_manage')) {
            return abort(401);
        }

        $param                  = Params::findOrFail($request->id);
        $data['editparams']     = view('params.edit',['param' => $param])->render();
        return response()->json($data);

    }
    /*
    _____________________________________________________________________________________________
    Update
    _____________________________________________________________________________________________
    */
    public function update(StoreParamRequest $request)
    {
        if (! Gate::allows('users_manage')) {
            return abort(401);
        }

        $param   = Params::findOrFail($request->id);
        $param->update($request->all());

        $data =[
            'title' => 'Başarılı!',
            'text'  => 'Kayıt başarılı',
            'type'  => 'success',
          ];

        return response()->json($data);
    }
}
