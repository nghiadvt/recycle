<?php

namespace App\Http\Requests\Admin\ServiceGarbageRequest;

use Illuminate\Foundation\Http\FormRequest;

class ServiceGarbageRequest extends FormRequest
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
            'name' => ['required', 'max:100', "unique:service_garbages,name,{$this->service_garbage}"],
            'description' => ['max:200'],
            'content' => ['max:200'],
            'active' => ['required', 'integer', 'between:0,1'],
            'parent_id' => ['nullable','integer', 'exists:service_garbages,id'],
            'service_garbage_type' => ['array', 'exists:service_garbage_types,id'],
            'service_garbage_type.*' => ['distinct'],
            'service_garbage_content' => ['array'],
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
            'required' =>  __('validation.serviceGarbage.required'),
            'max' => __('validation.serviceGarbage.max'),
            'integer' => __('validation.serviceGarbage.integer'),
            'between' => __('validation.serviceGarbage.between'),
            'numeric' => __('validation.serviceGarbage.numeric'),
            'not_in' => __('validation.serviceGarbage.not_in'),
            'exists' => __('validation.serviceGarbage.exists'),
            'distinct' => __('validation.serviceGarbage.distinct'),
            'unique' => __('validation.serviceGarbage.unique'),
        ];
    }
}
