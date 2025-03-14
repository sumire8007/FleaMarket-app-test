<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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
            'user_img' => 'mimes:jpeg,png',
            function ($attribute, $value, $fail) {
                $extension = strtolower($value->getClientOriginalExtension());
                if (!in_array($extension, ['jpeg', 'png'])) {
                    $fail('');
                }
            },
            'name' => ['required'],
            'post_code' => ['required','regex:/^\d{3}-\d{4}$/'],
            'address' => ['required'],
        ];
    }
}
