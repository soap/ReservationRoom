<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidateReserve extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $todayDate = date('m/d/Y');
        return [
            'name' => ['required', 'string'],
            'date' => ['date', 'after_or_equal:' . $todayDate],
            'start_time' => ['nullable', 'date_format:H:i'],
            'stop_time' => ['nullable', 'date_format:H:i', 'after:start_time']
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'type your name',
            'date.required' => 'select date',
            'start_time' => 'select start time',
            'stop_time' => 'select stop time'
        ];
    }
}