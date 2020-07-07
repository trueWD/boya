<?php

namespace App\Http\Requests\Params;

use Illuminate\Foundation\Http\FormRequest;

class StoreParamRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'deger' => 'required',
            'sira' => 'required',
        ];
    }
}
