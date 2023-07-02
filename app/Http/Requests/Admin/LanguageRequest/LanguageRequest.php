<?php

namespace App\Http\Requests\Admin\LanguageRequest;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class LanguageRequest extends FormRequest
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
        $rules = [
            'name' => ['required', 'max:50', "unique:languages,name,{$this->language}"],
            'code' => ['required', 'max:10', "unique:languages,code,{$this->language}"],
        ];

        return $rules;
    }

    /**
     * Define the validation error messages.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'required' => __('validation.language.required'),
            'max' => __('validation.language.max'),
            'unique' => __('validation.language.unique'),
        ];
    }
}
