<?php

namespace App\Http\Requests\User;

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
            'name' => 'required|string|max:255',
            'email' => ['required','string','email:filter','max:255',Rule::unique('users', 'email')->whereNot('email', $this->input('email'))],
            'password' => 'required|regex:/^[a-zA-Z0-9-_]+$/|confirmed|min:4',
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
            'name' => '名称',
            'email' => 'メールアドレス',
            'password' => 'パスワード',
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
