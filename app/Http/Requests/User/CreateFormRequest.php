<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class CreateFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            'email' => 'required|email:filter',
            'password' => 'required'
        ];
    }

    public function messages() : array {
        return [
            'email.required' => 'Chưa nhập email',
            'email' => 'Email không hợp lệ',
            'password.required' => 'Chưa nhập mật khẩu'
        ];
    }
}
