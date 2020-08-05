<?php

namespace App\Http\Requests\AdminUser;

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
            'email' => 'nullable|email',
            'iauthority' => 'nullable|integer',
            'sortType' => [
                Rule::in([
                    'id', 
                    'name', 
                    'email'
                ])
            ],
            'sortDirection' => [
                Rule::in([
                    'asc', 
                    'desc'
                ])
            ],
            'pageUnit' => [
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
            'name' => '名称',
            'email' => 'メールアドレス',
            'iauthority' => '権限',
            'sortType' => '並び替え',
            'sortOrder' => '並び替え方向',
            'display' => '件数',
        ];
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
     * @return string
     */
    public function email()
    {
        return $this->input('email');
    }

    /**
     *
     * @return integer
     */
    public function iauthority()
    {
        return $this->input('iauthority', 0);
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
