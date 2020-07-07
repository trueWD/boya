<?php

namespace App\Http\Requests\Depo;

use Illuminate\Foundation\Http\FormRequest;

class PiysaEtiketOlusturRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'paket_sayisi' => 'required',
        ];
    }
}
