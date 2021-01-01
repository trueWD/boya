<?php

namespace App\Http\Controllers\Notlar;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Not01;
use App\Models\Urun01;
use App\User;

use App\Http\Requests\Satis\YeniFiyatRequest;

class NotlarController extends Controller
{
    /*
    ____________________________________________________________________________________________________
    Not Ekleme
    ____________________________________________________________________________________________________
    */
    public function store(request $request)
    {



        if ($request->not == NULL) {

            $data = [
                'title' => 'Hata',
                'text'  => 'Lütfen not alanını doldurun.',
                'type'  => 'error',
            ];

            return response()->json($data);
            die;
        }




        $user   = User::find(auth()->id());

        $not = new Not01;

        $not->model     = $request->model;
        $not->modelid   = $request->modelid;
        $not->not       = $request->not;
        $not->userid    = $user->id;
        $not->username  = $user->name;
        $not->save();


        $notlar     = Not01::where('model', '=', $request->model)
                    ->where('modelid', '=', $request->modelid)
                    ->orderBy('id', 'desc')
                    ->get();

        $notlar  = view(
                        'notlar.notlar',
                        [
                            'notlar' => $notlar,
                        ]
                    )->render();


        $data = [
            'title' => 'Başarılı',
            'text'  => 'Not ekleme işlemi başarılı!..',
            'type'  => 'success',
            'notlar'  => $notlar,
        ];

        return response()->json($data);
    }
    /*
    ____________________________________________________________________________________________________
    Not DELETE
    ____________________________________________________________________________________________________
    */
    public function destroy(request $request)
    {
        $not       = Not01::findOrFail($request->id);
        $not->delete();
        $data = [
                'title' => 'Başarılı',
                'text'  => 'Not Silindi!..',
                'type'  => 'success',
            ];

        return response()->json($data);
    }








}
