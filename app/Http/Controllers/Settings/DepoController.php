<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\User;
use Illuminate\Support\Facades\Gate;
use App\Models\Depo01;
use App\Models\Depo02;
use App\Http\Requests\Settings\DepoEkleRequest;
use App\Http\Requests\Settings\IstifKaydetRequest;



class DepoController extends Controller
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

        $depo01 = Depo01::with('istifler')->get();

        return view('settings.depo.index', compact('depo01'));
    }

    /*
    _____________________________________________________________________________________________
    Store
    _____________________________________________________________________________________________
    */
    public function store(DepoEkleRequest $request)
    {
        if (! Gate::allows('users_manage')) {
            return abort(401);
        }

        $depo01       = Depo01::create($request->all());

        $data =[
            'title' => 'Başarılı!',
            'text'  => 'Kayıt başarılı',
            'type'  => 'success',
          ];

        return response()->json($data);
    }
    
    /*
    _____________________________________________________________________________________________
    Delete - Depo
    _____________________________________________________________________________________________
    */
    public function destroy(Request $request)
    {
        if (!Gate::allows('users_manage')) {
            return abort(401);
        }
        $depo01 = Depo01::findOrFail($request->id);
        $depo01->delete();
        
        $data = [
            'title' => 'Başarılı!',
            'text' => 'Kullanıcı Silindi',
            'type' => 'success',
        ];
        
        return response()->json($data);
    }
    /*
    _____________________________________________________________________________________________
    Delete - istif
    _____________________________________________________________________________________________
    */
    public function IstifDelete(Request $request)
    {
        if (!Gate::allows('users_manage')) {
            return abort(401);
        }
        $depo02 = Depo02::findOrFail($request->id);
        $depo02->delete();
        
        $data = [
            'title' => 'Başarılı!',
            'text' => 'Kullanıcı Silindi',
            'type' => 'success',
        ];
        
        return response()->json($data);
    }
    
    /*
    _____________________________________________________________________________________________
    İstif kaydet
    _____________________________________________________________________________________________
    */
    public function IstifKaydet(IstifKaydetRequest $request)
    {
        if (! Gate::allows('users_manage')) {
            return abort(401);
        }
    
        $depo02       = Depo02::create($request->all());
    
        $data =[
            'title' => 'Başarılı!',
            'text'  => 'Kayıt başarılı',
            'type'  => 'success',
          ];
    
        return response()->json($data);
    }


    /*
    _____________________________________________________________________________________________
    Depoya Ait İstifler
    _____________________________________________________________________________________________
    */
    public function DepoIstifleri(Request $request)
    {
        if (! Gate::allows('users_manage')) {
            return abort(401);
        }

        $depo02   = depo02::where('depoid','=',$request->id)->get();

        $output = '';

        foreach($depo02 as $item)
        {
         $output .= '<option value="'.$item->id.'">'.$item->adi.'</option>';
        }
        $data=  $output;

        return response()->json($data);

    }



}
