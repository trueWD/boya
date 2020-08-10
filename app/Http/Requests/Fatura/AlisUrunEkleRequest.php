<?php

namespace App\Http\Requests\Fatura;

use Illuminate\Foundation\Http\FormRequest;

class AlisUrunEkleRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'urunid' => 'required|numeric',
            'miktar' => 'required|numeric',
            'fiyat' => 'required',
            'kdv' => 'required|numeric',
        ];
    }
}
