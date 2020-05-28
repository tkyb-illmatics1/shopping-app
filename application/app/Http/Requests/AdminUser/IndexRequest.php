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
            'name' => 'nullable|regex:/^[a-zA-Z0-9ａ-ｚA-Zぁ-んァ-ヶー一-龠]+$/',
            'email' => 'nullable|string|email',
            'iauthority' => ['numeric' , Rule::in([0, 1, 2])],
            'sortType' => [Rule::in(['id', 'name', 'email'])],
            'sortOrder' => [Rule::in(['asc', 'desc'])],
            'display' => [Rule::in(['10', '20', '50', '100'])],
        ];
    }

    public function attributes()
    {
        return [
            'name' => '名称',
            'email' => 'メールアドレス',
            'iauthority' => '権限',
            'sortType' => '並び変え',
            'sortOrder' => '並び変え方向',
            'display' => '表示件数',
        ];
    }
}
