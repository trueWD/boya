<?php

namespace App\Http\Requests\Settings;

use Illuminate\Foundation\Http\FormRequest;

class EditOnayRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'roleid' => 'required',
            'model' => 'required',
            'anahtar' => 'required',
            'onayadi' => 'required',
            'sira' => 'required',
        ];
    }
}
