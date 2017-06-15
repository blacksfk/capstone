<?php

namespace App\Http\Requests;

use Auth;
use Illuminate\Foundation\Http\FormRequest;

class UserElevatePrivileges extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::user()->is_admin;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "is_admin" => "required"
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function($validator) {
            if ($this->user_id === Auth::user()->id && $this->is_admin == 0)
            {
                $validator->errors()->add("is_admin", "You cannot unset yourself from being an administrator");
            }
            elseif ($this->user_id == 1 && $this->is_admin == 0)
            {
                $validator->errors()->add("is_admin", "The default user must be an administrator");
            }
        });
    }
}
