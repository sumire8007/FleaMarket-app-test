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
                        $fail('jpegもしくはpngのみアップロードできます');
                    }
                }
            ],
            'condition' => ['required'],
            'categories' => ['required'],
            'price'=> ['required','integer','min:0'],
        ];
    }
    public function messages()
    {
        return [
            'item_name.required' => '商品名を入力してください',
            'detail.required' => '商品説明を入力してください',
            'detail.max' => '商品説明は255文字以内で入力してください',
            'item_img.required' => '画像は必ず選択してください',
            'condition.required' => '商品状態を選択してください',
            'categories.required' => 'カテゴリーを選択してください',
            'price.required' => '価格を入力してください',
            'price.integer'=> '価格は数字で入力してください',
            'price.min'=> '価格は0円以上で入力してください',
        ];
    }
}

