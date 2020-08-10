<?php

namespace App\Http\Requests\Fatura;

use Illuminate\Foundation\Http\FormRequest;

class AlisUrunUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'miktar' => 'required|numeric',
            'fiyat' => 'required',
            'kdv' => 'required|numeric',
        ];
    }
}
