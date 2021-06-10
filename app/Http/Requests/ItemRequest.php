<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ItemRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|min:3',
            'quantity' => 'required|integer|min:1',
            'price_per_item' => 'required|integer|min:3',
        ];
    }
}
