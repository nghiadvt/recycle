<?php

namespace App\Http\Requests\Admin\ScheduleRequest;

use Illuminate\Foundation\Http\FormRequest;

class ScheduleRequest extends FormRequest
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
            'date_start_at' => ['required', 'date'],
            'date_end_at' => ['required', 'date', 'after:date_start_at'],
            'time_start_at' => ['required', 'date_format:H:i:s',],
            'time_end_at' => ['required', 'date_format:H:i:s', 'after:time_start_at'],
            'active' => ['required', 'integer', 'between:0,1'],
            'area_id' => ['required', 'exists:areas,id'],
            'garbage_type' => ['required', 'array', 'exists:garbage_types,id'],
            'garbage_type.*' => ['distinct'],
            'is_repeat' => ['required', 'integer', 'between:0,1'],
            'day_of_week' => ['required', 'integer', 'between:1,7'],
        ];
    }

    public function messages()
    {
        return [
            'required' => __('validation.schedule.required'),
            'date' => __('validation.schedule.date'),
            'date_format' => __('validation.schedule.date_format'),
            'integer' => __('validation.schedule.integer'),
            'between' => __('validation.schedule.between'),
            'day_of_week.between' => __('validation.schedule.day_of_week_between'),
            'is_repeat.between' => __('validation.schedule.is_repeat_between'),
            'exists' => __('validation.schedule.exists'),
            'distinct' => __('validation.schedule.distinct'),
            'after' => __('validation.schedule.after'),
            'time_end_at.after' => __('validation.schedule.after_time'),
        ];
    }
}
