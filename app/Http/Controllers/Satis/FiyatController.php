<?php

namespace App\Http\Controllers\Satis;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Fiyat01;
use App\Models\Urun01;

use App\Http\Requests\Satis\YeniFiyatRequest;

class FiyatController extends Controller
{
    /*
    _____________________________________________________________________________________________
    index
    _____________________________________________________________________________________________
    */
    public function index()
    {

        $fiyat01     = Fiyat01::with('urun01')->get();


        return view('fiyat.index', compact('fiyat01'));
    }
    /*
    _____________________________________________________________________________________________
    Store
    _____________________________________________________________________________________________
    */
    public function store(YeniFiyatRequest $request)
    {


        $tutar      = tutarToRaw($request->oran);

        // dd($request->all());
        $data               = new Fiyat01;
        $data->adi          = $request->adi;
        $data->oran         = $request->oran;
        $data->indirim_oran = $request->indirim_oran;
        $data->aciklama     = $request->aciklama;
        $data->userid       = auth()->id();
        $data->save();


        $data = [
            'title' => 'Başarılı!',
            'text'  => 'Yeni oran eklendi.',
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

        $fiyat01 = Fiyat01::with('urun01')->findOrFail($request->id);

        if(count($fiyat01->urun01) > 0){

            $data = [
                'title' => 'HATA!',
                'text' => 'Bu guruba bağlı ürün var silinmez!',
                'type' => 'danger',
            ];
            return response()->json($data);
        }

        $fiyat01->delete();

        $data = [
            'title' => 'Başarılı!',
            'text' => 'Depo Silindi',
            'type' => 'success',
        ];

        return response()->json($data);
    }
    /*
    _____________________________________________________________________________________________
    Edit
    _____________________________________________________________________________________________
    */
    public function edit(Request $request)
    {

        $fiyat01 = Fiyat01::findOrFail($request->id);


        $data['FiyatEdit']       = view(
                'fiyat.edit',
                [
                    'fiyat01' => $fiyat01,

                ]
            )->render();
        return response()->json($data);
    }
    /*
    _____________________________________________________________________________________________
    Update
    _____________________________________________________________________________________________
    */
    public function update(YeniFiyatRequest $request)
    {


        $data = Fiyat01::findOrFail($request->id);
        $data->adi          = $request->adi;
        $data->oran         = $request->oran;
        $data->indirim_oran = $request->indirim_oran;
        $data->aciklama     = $request->aciklama;
        $data->userid       = auth()->id();
        $data->save();

        $urun01     = Urun01::where('fiyat_grubu', '=', $request->id)->get();
        
        foreach ($urun01 as $row){

            $urun = Urun01::findOrFail($row->id);
            $oran               = $urun->fiyat * ($request->oran / 100);
            $kar                = $urun->fiyat + $oran;
            $urun->satis_fiyat  = paraEn($kar);
            $urun->updated_at   = now();
            $urun->save();
            
        }

        $data = [
            'title' => 'Başarılı!',
            'text'  => 'Oran güncellendi..',
            'type'  => 'success',
        ];

        return response()->json($data);
    }


}
