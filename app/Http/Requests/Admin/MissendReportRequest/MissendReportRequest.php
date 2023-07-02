<?php

namespace App\Http\Requests\Admin\MissendReportRequest;

use Illuminate\Foundation\Http\FormRequest;

class MissendReportRequest extends FormRequest
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
            'report_id' => 'required|exists:reports,id',
            'garbage_type' => 'required',
            'description' => 'max:255',
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
            'required' => __("validation.missendReport.store.required"),
            'max' => __("validation.missendReport.store.max"),
            'exists' => __("validation.missendReport.store.exists"),
        ];
    }
}
