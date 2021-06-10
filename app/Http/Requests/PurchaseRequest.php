<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PurchaseRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'categories_id' => 'required',
            'title' => 'required|string|min:3',
            'company_name' => 'required|string|min:3',
            'description' => 'required|string|min:10',
            'purchasing_status' => 'string',
            'payment_slip' => 'image|max:10240',
        ];
    }
}
