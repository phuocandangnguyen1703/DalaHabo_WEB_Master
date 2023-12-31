<?php

namespace App\Http\Requests\Slider;

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
            'name' => 'required',
            'image' => 'required',
        ];
    }

    public function messages() : array {
        return [
            'name.required' => 'Vui lòng nhập tên slider',
            'image.required' => 'Vui lòng thêm hình ảnh slider'
        ];
    }
}
