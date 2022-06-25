<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UserRequest extends FormRequest
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
        $rules = [
            'image' => request()->method() == 'POST' ? 'required|image|mimes:png,jpg,jpeg|max:5000' : 'sometimes|nullable|image|mimes:png,jpg,jpeg|max:5000',
            'name' => 'required|max:255',
            'phone' => 'required|numeric|digits_between:9,12',
            'email' => 'required|email|unique:users,email,'.$this->user->id,
            'password' => request()->method() == 'POST' ? 'required|confirmed|min:6' : 'sometimes|nullable|confirmed|min:6',
        ];

        return $rules;
    }

    public function messages(){
        return [
            'name.required'   => 'User name field is required',
            'phone.required'   => 'User phone field is required',
            'image.required'   => 'User image field is required',
            'email.required'   => 'User Email field is required',
            'password.required'   => 'User password field is required',
        ];
    }

    public function failedValidation(Validator $validator){
        throw new HttpResponseException(redirect()->back()->withErrors($validator)->withInput()
        );
    }

}
