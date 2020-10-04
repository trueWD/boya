<?php

namespace App\Http\Requests\Depo;

use Illuminate\Foundation\Http\FormRequest;

class YeniDepoRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'depoadi' => 'required',
        ];
    }
}
