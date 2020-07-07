<?php

namespace App\Http\Requests\Settings;

use Illuminate\Foundation\Http\FormRequest;

class DepoEkleRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'depoadi' => 'required',
            'sira' => 'required',
            'tipi' => 'required',
        ];
    }
}
