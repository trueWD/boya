<?php

namespace App\Http\Requests\Fatura;

use Illuminate\Foundation\Http\FormRequest;

class AlisFaturaRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'faturano' => 'required',
            'cariid' => 'required',
            'depo01' => 'required',
        ];
    }
}
