<?php

namespace App\Http\Requests\Admin\ImageRequest;

use Illuminate\Foundation\Http\FormRequest;

class IconRequest extends FormRequest
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
            'icon' => 'image|mimes:jpeg,png,jpg|max:5120',
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
            'required' => __('validation.garbageType.required'),
            'icon.max' => __('validation.garbageType.maxIcon'),
            'mimes' => __('validation.garbageType.mimes'),
            'max' => __('validation.garbageType.max'),
        ];
    }
}
