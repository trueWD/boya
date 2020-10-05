<?php

namespace App\Http\Requests\Satis;

use Illuminate\Foundation\Http\FormRequest;

class YeniFiyatRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'adi' => 'required',
            'oran' => 'required',

        ];
    }
}
