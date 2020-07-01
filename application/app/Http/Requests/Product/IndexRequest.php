<?php

namespace App\Http\Requests\Product;

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
            'prductCategory' => 'nullable|integer',
            'name' => 'nullable|string',
            'price' => 'nullable|integer',
            'priceOperator' => [
                `nullable|string`,
                Rule::in([
                    '>=',
                    '<=',
                ])
            ],
            'sortType' => [
                Rule::in([
                    'id',
                    'product_category_id',
                    'name',
                    'price',
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

    /**
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'prductCategory' => '商品カテゴリー',
            'name' => '名称',
            'price' => '価格',
            'operator' => '以上以下',
            'sortType' => '並び替え',
            'sortOrder' => '並び替え方向',
            'display' => '件数',
        ];
    }

    /**
     *
     * @return integer
     */
    public function prductCategory()
    {
        return $this->input('prductCategory');
    }

    /**
     *
     * @return string
     */
    public function name()
    {
        return $this->input('name');
    }

    /**
     *
     * @return integer
     */
    public function price()
    {
        return $this->input('price');
    }

    /**
     *
     * @return string
     */
    public function priceOperator()
    {
        return $this->input('priceOperator', '>=');
    }

    /**
     *
     * @return string
     */
    public function sortType()
    {
        return $this->input('sortType', 'id');
    }

    /**
     *
     * @return string
     */
    public function sortDirection()
    {
        return $this->input('sortDirection', 'asc');
    }

    /**
     *
     * @return integer
     */
    public function pageUnit()
    {
        return $this->input('pageUnit', 10);
    }

}
