<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class CreateNewUserFormRequest extends FormRequest
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
            'email' => 'required|email:filter|unique:users',
            'password' => 'required|min:8',
            'confirm_password' => 'required|same:password',
            'name' => 'required',
        ];
    }

    public function messages() : array {
        return [
            'email.required' => 'Vui lòng nhập email',
            'email' => 'Email không hợp lệ',
            'email.unique' => 'Email đã tồn tại. Vui lòng thử lại với email khác.',
            'password.required' => 'Vui lòng nhập mật khẩu',
            'password.min' => 'Mật khẩu phải chứa ít nhất 8 ký tự',
            'confirm_password.required' => 'Vui lòng xác nhận mật khẩu mới.',
            'confirm_password.same' => "Mật khẩu không khớp.",
            'name.required' => 'Vui lòng nhập tên người dùng',
        ];
    }
}
