<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MenuRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|min:3',
            'url' => 'required'
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Tên menu không được để trống',
            'name.min' => ' Tên menu phải có từ 3 kí tự',
            'url.required' => 'Đường dẫn menu không được để trống',
        ];
    }
}
