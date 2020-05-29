<?php

namespace App\Http\Requests\ProductCategory;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class IndexRequest extends FormRequest
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
            'name' => 'nullable|string',
            'sortType' => [
                Rule::in([
                    'id', 
                    'name', 
                    'order_no'
                ])
            ],
            'sortOrder' => [
                Rule::in([
                    'asc', 
                    'desc'
                ])
            ],
            'display' => [
                Rule::in([
                    '10', 
                    '20', 
                    '50', 
                    '100'
                    ])
                ],
        ];
    }

    public function attributes() {
        return [
            'name' => '名称',
            'sortType' => '並び替え',
            'sortOrder' => '並び替え方向',
            'display' => '件数',
        ];
    }

}
