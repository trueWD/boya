<?php

namespace App\Http\Requests\Tahsilat;

use Illuminate\Foundation\Http\FormRequest;

class YeniTahsilatRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'tutar' => 'required',
        ];
    }
}
