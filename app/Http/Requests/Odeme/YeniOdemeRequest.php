<?php

namespace App\Http\Requests\Odeme;

use Illuminate\Foundation\Http\FormRequest;

class YeniOdemeRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'tutar' => 'required',
            'cariid' => 'required',
        ];
    }
}
