<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreUserRequest extends FormRequest
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
            "email" => ['required', 'email', Rule::unique('users', 'email')],
            "name" => ['required'],
            "user_catalouge_id" => ['required'],
            "password" => ['required', 'min:6', 'same:password'],
            "password_confirmation" => ['required', 'same:password'],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */


    public function messages(): array
    {
        return [
            'email.required' => 'Vui lòng nhập email',
            'email.email' => 'Email không đúng định dạng',
            'email.unique' => 'Email đã được sử dụng',
            'name.required' => 'Vui lòng nhập họ và tên',
            'user_catalouge_id.required' => 'Vui lòng chọn nhóm thành viên',
            'password.required' => 'Vui lòng nhập mật khẩu',
            'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự',
            'password.same' => 'Mật khẩu không trùng khớp',
            'password_confirmation.required' => 'Vui lòng nhập lại mật khẩu',
            'password_confirmation.same' => 'Mật khẩu không trùng khớp',
        ];
    }
}
