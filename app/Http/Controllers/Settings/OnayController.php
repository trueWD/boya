<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Gate;

use Spatie\Permission\Models\Role;
use App\Models\Onay01;
use App\Http\Requests\Settings\EditOnayRequest;

class OnayController extends Controller
{
    /*
    _____________________________________________________________________________________________
    index
    _____________________________________________________________________________________________
    */
    public function index()
    {
        if (! Gate::allows('users_manage')) {
            return abort(401);
        }

        $params  = Onay01::orderBy('model')->get();

        $params = $params->groupBy('anahtar');

        return view('settings.onay.index', compact('params'));
    }
    /*
    _____________________________________________________________________________________________
    Edit 
    _____________________________________________________________________________________________
    */
    public function edit(request $request)
    {
        if (!Gate::allows('users_manage')) {
            return abort(401);
        }
        $roles              = Role::all();
        $onay               = Onay01::findOrFail($request->id);
        $data['EditOnay']   = view('settings.onay.edit',['onay' => $onay,'roles' => $roles])->render();
        return response()->json($data);

    }
    /*
    _____________________________________________________________________________________________
    Update
    _____________________________________________________________________________________________
    */
    public function update(EditOnayRequest $request)
    {
        if (! Gate::allows('users_manage')) {
            return abort(401);
        }

        $onay   = Onay01::findOrFail($request->id);
        $onay->update($request->all());

        $data =[
            'title' => 'Başarılı!',
            'text'  => 'Kayıt başarılı',
            'type'  => 'success',
          ];

        return response()->json($data);
    }
}
