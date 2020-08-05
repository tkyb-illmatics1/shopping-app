<?php

namespace App\Http\Requests\AdminUser;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'email' => 'required|string|email:filter|max:255|unique:admin_users,email',
            'password' => 'required|regex:/^[a-zA-Z0-9-_]+$/|confirmed|min:4',
            'is_owner' => 'required|integer',
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
