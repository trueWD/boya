<?php
namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUsersRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required',
            'email' => 'required|email',
           // 'email' => 'required|email|unique:users,email,'.auth()->user()->id,
            //'roles' => 'required',
        ];
    }
}
