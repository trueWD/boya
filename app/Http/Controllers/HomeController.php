<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;

use App\Models\Cari01;
use App\Models\Siparis01;
use App\Models\Urun01;
use App\Models\Siparis02;
use App\Models\Banka01;

class HomeController extends Controller
{
    public function index()
    {

        $cari01     = Cari01::all();

        $tedarikci = $cari01->filter(function ($row) {
            return $row->grubu == 'TEDARIKCI';
        });


        return view('home',compact('tedarikci'));
    }
}
