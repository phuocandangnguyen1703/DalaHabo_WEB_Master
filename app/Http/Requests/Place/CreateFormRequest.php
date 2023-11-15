<?php

namespace App\Http\Requests\Place;

use Illuminate\Foundation\Http\FormRequest;

class CreateFormRequest extends FormRequest
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
            'name' => 'required',
            'address' => 'required',
        ];
    }

    public function messages() : array {
        return [
            'name.required' => 'Vui lòng nhập tên địa điểm',
            'address.required' => 'Vui lòng nhập địa chỉ',
        ];
    }
}
