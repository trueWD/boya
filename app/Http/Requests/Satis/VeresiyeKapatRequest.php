<?php

namespace App\Http\Requests\Satis;

use Illuminate\Foundation\Http\FormRequest;

class VeresiyeKapatRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'cariid' => 'required',

        ];
    }
}
