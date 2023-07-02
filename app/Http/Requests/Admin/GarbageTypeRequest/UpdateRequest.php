<?php

namespace App\Http\Requests\Admin\GarbageTypeRequest;

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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'max:50', "unique:garbage_types,name,{$this->garbage_type}"],
            'description' => ['max:65535'],
            'active' => ['required', 'integer', 'between:0,1'],
            'icon' => ['image', 'mimes:jpeg,png,jpg', 'max:5120'],
            'price' => ['required', 'numeric', 'regex:#^[0-9]+#'],
            'unit' => ['required'],
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
            'max' => __('validation.garbageType.max'),
            'unique' => __('validation.garbageType.unique'),
            'integer' => __('validation.garbageType.integer'),
            'between' => __('validation.garbageType.between'),
            'image' => __('validation.garbageType.image'),
            'mimes' => __('validation.garbageType.mimes'),
            'icon.max' => __('validation.garbageType.maxIcon'),
        ];
    }
}
