<?php

namespace App\Http\Requests\Admin\UserGarbageRequest;

use Illuminate\Foundation\Http\FormRequest;

class UserGarbageRequest extends FormRequest
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
            '*.garbage_type_id' => 'required|exists:garbage_types,id',
            '*.account_id' => 'required|exists:accounts,id',
            '*.weight' => 'required',
        ];
    }
}
