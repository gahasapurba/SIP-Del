<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PesanRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'receiver_users_id' => 'required',
            'content' => 'required|string|min:10',
            'file' => 'file|max:102400',
        ];
    }
}
