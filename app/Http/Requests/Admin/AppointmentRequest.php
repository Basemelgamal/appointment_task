<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class AppointmentRequest extends FormRequest
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
        return [
            'appointment' => 'required|after:today',
            'user_id' => 'required',
            'reason' => 'required'
        ];
    }

    public function messages(){
        return [
            'appointment.required'   => 'Please choose appointment date',
            'user_id.required'   => 'Please choose user',
            'reason.required'   => 'Reason field is required',
        ];
    }

    public function failedValidation(Validator $validator){
        throw new HttpResponseException(redirect()->back()->withErrors($validator)->withInput()
        );
    }
}
