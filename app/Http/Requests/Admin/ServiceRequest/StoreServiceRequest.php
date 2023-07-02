<?php

namespace App\Http\Requests\Admin\ServiceRequest;

use Illuminate\Foundation\Http\FormRequest;

class StoreServiceRequest extends FormRequest
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
            'title' => 'required|max:255',
            'slug' => 'unique:service_categories,slug' . $this->id,
            'image_url' => 'image|mimes:jpeg,jpg,png,gif|max:10000',
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

    /**
     * Get the attribute names for the validation rules.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'title' => __('validation.attributes.serviceCategory.store.title'),
            'parent_id' =>  __('validation.attributes.serviceCategory.store.parent_id'),
            'slug' =>  __('validation.attributes.serviceCategory.store.slug'),
            'description' =>  __('validation.attributes.serviceCategory.store.description'),
            'active' =>  __('validation.attributes.serviceCategory.store.active'),
        ];
    }
}
