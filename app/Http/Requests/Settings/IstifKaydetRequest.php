<?php

namespace App\Http\Requests\Settings;

use Illuminate\Foundation\Http\FormRequest;

class IstifKaydetRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'adi' => 'required',
            'sira' => 'required',
            'tipi' => 'required',
        ];
    }
}
