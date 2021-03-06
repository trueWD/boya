<?php

namespace App\Http\Requests\Urun;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUrunRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'urunadi' => 'required',
            'fiyat' => 'required',
            'fiyat_grubu' => 'required',
            'kdv' => 'required',
        ];
    }
}
