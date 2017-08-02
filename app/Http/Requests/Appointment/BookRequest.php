<?php

namespace App\Http\Requests\Appointment;

use App\Http\Requests\Request;

class BookRequest extends Request
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
     * @return array
     */
    public function rules()
    {
        return [
            'id' => 'required|exists:availabilities',
            'level' => 'required',
            'reason' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'level.rquired' => 'Please select the level of important',
            'reason.rquired' => 'Please select a reason for this appointment'
        ];
    }
}
