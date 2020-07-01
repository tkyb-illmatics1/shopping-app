<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
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
            'product_category_id' => 'required|integer',
            'name' => 'required|string',
            'price' => 'required|integer|min:0',
            'description' => 'nullable|string',
            'image_path' => 'nullable|file|image',
            'deleteFlg' => [
                'nullable',
                'integer',
                Rule::in([
                    '1',
                ])
            ],
        ];
    }

    /**
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'product_category_id' => '商品カテゴリー',
            'name' => '名称',
            'price' => '価格',
            'description' => '説明',
            'image_path' => 'イメージ',
            'deleteFlg' => '削除チェックボタン',
        ];
    }

    /**
     *
     * @return integer
     */
    public function deleteFlg()
    {
        return $this->input('deleteFlg');
    }

    /**
     *
     * @return integer
     */
    public function image_path()
    {
        return $this->input('image_path');
    }

}
