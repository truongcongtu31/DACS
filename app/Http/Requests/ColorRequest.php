<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ColorRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|min:2',
            'color_code' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Tên màu không được để trống',
            'name.min' => ' Tên màu phải có từ 2 kí tự',
            'color_code.required' => 'Mã màu không được để trống',

        ];
    }
}
