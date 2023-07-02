<?php

namespace App\Http\Requests\Admin\DamagedMissingRequest;

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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'container_garbage_type_id' => 'required|exists:container_garbage_types,id',
            'type' => 'required',
            'report_id' => 'required|exists:reports,id',

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
            'required' => __("validation.damagedMissingReport.store.required"),
            'exists' => __("validation.damagedMissingReport.store.exists"),
        ];
    }
}
