<?php

namespace App\Http\Requests\Admin\CategoryRequest;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'name' => ['required', 'max:255'],
            'icon' => ['image', 'mimes:jpeg,png,jpg', 'max:5120'],
            'parent_id' => ['exists:categories,id'],
            'is_active' => ['required', 'integer', 'between:0,1']
        ];
    }
}
