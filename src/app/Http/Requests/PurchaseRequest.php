<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PurchaseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'payment_id' => ['required','integer', 'exists:payments,id'],
            'address_id'=> ['required','integer', 'exists:addresses,id'],
        ];
    }
    public function messages()
    {
        return [
            'payment_id.required' => '支払い方法を選択してください',
            'address_id.required' => '配送先住所を登録してください',
        ];
    }
}
