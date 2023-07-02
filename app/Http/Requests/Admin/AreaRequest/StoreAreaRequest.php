<?php

namespace App\Http\Requests\Admin\AreaRequest;

use Illuminate\Foundation\Http\FormRequest;

class StoreAreaRequest extends FormRequest
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
            'zip_no' => 'required|numeric|min:1000000|max:99999999',
            'zip_no_address' => 'max:255',
            'pref_id' => 'required|integer|exists:prefectures,id',
            'city_id' => 'required|integer|exists:cities,id',
            'address_no' => 'max:255',
            'address' => 'max:255',
            'active' => 'required|boolean'
        ];
    }

    /**
     * Get the validation error messages that apply to the request
     *
     * @return array
     */
    public function messages()
    {
        return [
            'required' => __('validation.area.store.required'),
            'max' => __('validation.area.store.max'),
            'exists' => __('validation.area.store.exists'),
            'boolean' => __('validation.area.store.boolean'),
            'integer' => __('validation.area.store.integer'),
            'min' => __('validation.area.store.min'),
        ];
    }

    /**
     * Get the attribute names for the validation rules.
     *
     * @return array
     */
    public function attributes(): array
    {
        return [
            'ward_id' => __('validation.attributes.area.store.ward_id'),
            'name' => __('validation.attributes.area.store.name'),
            'address1' => __('validation.attributes.area.store.address1'),
            'zip_no' => __('validation.attributes.area.store.zip_no'),
            'status' => __('validation.attributes.area.store.status')
        ];
    }
}
