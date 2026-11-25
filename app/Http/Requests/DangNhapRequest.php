<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DangNhapRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'username' => ['required', 'string', 'max:100'],
            'password' => ['required', 'string'],
            'remember' => ['nullable'],
        ];
    }

    public function messages(): array
    {
        return [
            'username.required' => 'Vui lòng nhập tài khoản đăng nhập.',
            'username.string'   => 'Tài khoản đăng nhập không hợp lệ.',
            'username.max'      => 'Tài khoản đăng nhập không được vượt quá 100 ký tự.',
            'password.required' => 'Vui lòng nhập mật khẩu.',
            'password.string'   => 'Mật khẩu không hợp lệ.',
        ];
    }
}
