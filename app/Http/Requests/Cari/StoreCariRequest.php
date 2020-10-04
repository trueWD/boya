<?php

namespace App\Http\Requests\Cari;

use Illuminate\Foundation\Http\FormRequest;

class StoreCariRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'cariadi' => 'required',
            'vergino' => 'required',
            'vergidairesi' => 'required',
        ];
    }
}
