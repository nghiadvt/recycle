<?php

namespace App\Http\Requests\SearchRequest;

use Illuminate\Foundation\Http\FormRequest;

class SearchRequest extends FormRequest
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
            'q' => 'nullable',
            'type' => 'required'
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
            'required' =>  __('validation.search.required'),
        ];
    }
}
