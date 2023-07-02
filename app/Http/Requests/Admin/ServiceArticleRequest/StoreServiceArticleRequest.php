<?php

namespace App\Http\Requests\Admin\ServiceArticleRequest;

use Illuminate\Foundation\Http\FormRequest;

class StoreServiceArticleRequest extends FormRequest
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
            'services_category_id' => 'required|exists:service_categories,id',
            'services_id' => 'required|exists:services,id',
            'title' => 'required|max:255',
            'slug' => 'unique:service_articles,slug,' . $this->id,
            'content' => 'max:255',
            'description' => 'max:255',
            'active' => 'required|boolean'
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
            'required' => __("validation.serviceCategory.store.required"),
            'max' => __("validation.serviceCategory.store.max"),
            'exists' => __("validation.serviceCategory.store.exists"),
            'boolean' => __("validation.serviceCategory.store.boolean"),
            'unique' => __("validation.serviceCategory.store.unique"),
        ];
    }
}
