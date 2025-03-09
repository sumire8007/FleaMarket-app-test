<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExhibitionRequest extends FormRequest
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
            'item_name' => ['required'],
            'detail'=> ['required','max:255'],
            'item_img'=> [
                'required','mimes:jpeg,png',
                function ($attribute, $value, $fail) {
                    $extension = strtolower($value->getClientOriginalExtension());
                    if (!in_array($extension, ['jpeg', 'png'])) {
                        $fail('');
                    }
                }
            ],
            'condition' => ['required'],
            'categories' => ['required'],
            'price'=> ['required','integer','min:0'],
        ];
    }
}

