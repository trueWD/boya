<?php

namespace App\Http\Requests\Satis;

use Illuminate\Foundation\Http\FormRequest;

class FiyatGuncelleRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'fiyat' => 'required',
            'kdv' => 'required|numeric',

        ];
    }
}
