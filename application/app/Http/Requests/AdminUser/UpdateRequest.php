<?php

namespace App\Http\Requests\AdminUser;

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
            'email' =>  [
                'required',
                'string',
                'email:filter',
                'max:255',
                Rule::unique('admin_users')->ignore($this->input('email'))->whereNot('email', $this->input('email')),
            ],
            'password' => 'nullable|regex:/^[a-zA-Z0-9-_]+$/|confirmed|min:4',
            'is_owner' => 'nullable|integer',
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
            'is_owner' => '権限',
        ];
    }
}
