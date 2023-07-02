<?php

namespace App\Http\Requests\Admin\ContainerGarbageRequest;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
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
            '*.bin_size' => 'required|integer|distinct',
            '*.container_id' => 'numeric|nullable',
            '*.image' => 'image|mimes:jpeg,jpg,png,gif|nullable|max:5120',
        ];
    }

    /**
     * Get the validation error messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'required' => __("validation.containerGarbage.store.required"),
            'max' => __("validation.containerGarbage.store.max"),
            'image' => __("validation.containerGarbage.store.image"),
            'mimes' => __("validation.containerGarbage.store.mimes"),
            'integer' => __("validation.containerGarbage.store.integer"),
        ];
    }
}
