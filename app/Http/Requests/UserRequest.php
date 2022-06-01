<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
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
        $ruleArr = [
            'email' => [
                'required',
                'email',
                Rule::unique('user')->ignore($this->id)
            ],
            'password' => 'required|min:6',
            'password_confirm' => 'same:password',
            'auth' => 'required'
        ];

        return $ruleArr;
    }
    public function messages()
    {
        return [
            'name.required' => 'ユーザー名を入力してください。',
            'email.required' => 'メールアドレスを入力してください。',
            'email.email' => 'メールアドレス形式で指定してください。',
            'email.unique' => 'このメールは登録されています',
            'password.required' => 'パスワードを入力してください。',
            'password.min' => '6文字以上入力してください。',
            'password_confirm.same' => 'パスワードと一致しません',
            'auth.required' => '権限を選択してください'
        ];
    }
}
