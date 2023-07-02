<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'email_login' => 'required|max:255|email',
            'password' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'required' => __('validation.login.required'),
            'max' => __('validation.login.required'),
            'email' => __('validation.login.required'),
        ];
    }
}
