<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

use App\Models\Settings;

class SettingsController extends Controller
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

        $settings = Settings::findOrFail(1);

        return view('settings.index', compact('settings'));
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
        $settings   = Settings::findOrFail(1);
        $settings->update($request->all());

       

        $data =[
            'title' => 'Başarılı!',
            'text'  => 'Kayıt Güncellendi',
            'type'  => 'success',
        ];

        return response()->json($data);

    }
}
