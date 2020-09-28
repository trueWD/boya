<?php

namespace App\Http\Requests\Banka;

use Illuminate\Foundation\Http\FormRequest;

class YeniHesapRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'adi' => 'required',
            'sube' => 'required',
            'iban' => 'required',
        ];
    }
}
