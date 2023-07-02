<?php

namespace App\Http\Requests\Admin\ImageRequest;

use Illuminate\Foundation\Http\FormRequest;

class ImageRequest extends FormRequest
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
            'image_url' => 'mimes:jpeg,jpg,png,gif|max:10000',
        ];
    }

    /**
     * Define the validation error messages.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'required' => __('validation.service.store.required'),
            'mimes' => __('validation.service.store.mimes'),
            'max' => __('validation.service.store.max'),
        ];
    }
}
