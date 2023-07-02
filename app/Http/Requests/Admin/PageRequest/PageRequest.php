<?php

namespace App\Http\Requests\Admin\PageRequest;

use Illuminate\Foundation\Http\FormRequest;

class PageRequest extends FormRequest
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
            'title' => ['required', 'max:50', 'min:5'],
            'content' => ['min:5', 'max:65553'],
            'type' => ['required', 'integer', 'between:1,3'],
            'description' => ['max:255'],
            'active' => ['required', 'integer', 'between:0,1'],
        ];
    }

    public function messages()
    {
        return [
            'required' => __('validation.page.required'),
            'max' => __('validation.page.max'),
            'min' => __('validation.page.min'),
            'integer' => __('validation.page.integer'),
            'between' => __('validation.page.between'),
        ];
    }
}
