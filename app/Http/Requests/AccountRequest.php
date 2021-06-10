<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AccountRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'phone_number' => 'nullable|string|max:255|starts_with:+62',
            'avatar' => 'image|max:10240',
        ];
    }
}
