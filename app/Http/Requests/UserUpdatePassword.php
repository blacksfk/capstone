<?php

namespace App\Http\Requests;

use Auth;
use Illuminate\Foundation\Http\FormRequest;

class UserUpdatePassword extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return (Auth::user()->is_admin ? true : false);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "password" => "required",
            "password_confirm" => "required"
        ];
    }

    /**
     * This functoin checks if the passwords match
     * 
     * @param  \Illuminate\Validation\Validator $validator
     * @return void
     */
    public function withValidator($validator)
    {
        $validator->after(function($validator) {
            if ($this->input("password") !== $this->input("password_confirm"))
            {
                $validator->errors()->add("password", "Passwords do not match!");
            }
        });
    }
}
