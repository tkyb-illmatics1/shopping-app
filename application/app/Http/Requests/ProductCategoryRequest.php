<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductCategoryRequest extends FormRequest
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
        if ($this->isMethod('GET')) {
            return [
                'name' => 'nullable|string',
            ];
        } else {
            return [
                'name' => 'required|unique:App\Models\ProductCategory',
                'order_no' => 'required|numeric|unique:App\Models\ProductCategory',
            ];
        }

        return [];
    }

    public function messages(){
        return [
            'name.required' => '名称は必ず入力してください。',
            'name.unique' => '指定の名称は既に使用されています。',
            'order_no.required' => '並び順番号は必ず入力してください。',
            'order_no.numeric' => '並び順番号は半角数字を入力してください。',
            'order_no.unique' => '指定の並び順番号は既に使用されています。',
        ];
    }
}
