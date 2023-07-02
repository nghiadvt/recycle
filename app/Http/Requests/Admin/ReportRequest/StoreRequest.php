<?php

namespace App\Http\Requests\Admin\ReportRequest;

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
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'email_address' => 'required|email',
            'phone_number' => 'required|max:255',
            'account' => 'max:255',
            'area_id' => 'required|exists:areas,id'
        ];
    }

    public function messages()
    {
        return [
            'required' => __("validation.missendReport.store.required"),
            'max' => __("validation.missendReport.store.max"),
            'exists' => __("validation.missendReport.store.exists"),
        ];
    }
}
