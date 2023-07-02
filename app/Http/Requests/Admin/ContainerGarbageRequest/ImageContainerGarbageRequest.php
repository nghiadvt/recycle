<?php

namespace App\Http\Requests\Admin\ContainerGarbagerequest;

use Illuminate\Foundation\Http\FormRequest;

class ImageContainerGarbageRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'image' => 'required|mimes:jpeg,jpg,png,gif|max:5120',
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
            'required' => __('validation.containerGarbage.store.required'),
            'mimes' => __('validation.containerGarbage.store.mimes'),
            'max' => __('validation.containerGarbage.store.max'),
        ];
    }
}
