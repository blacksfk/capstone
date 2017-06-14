<?php

namespace App\Http\Requests;

use Auth;
use Illuminate\Foundation\Http\FormRequest;

class EventStoreBatch extends FormRequest
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
            "events" => "array",
            "events.*.name" => "required|max:255",
            "events.*.date" => "required|date",
            "events.*.notes" => "nullable|max:255"
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function($validator) {
            if (!count($this->events) > 0)
            {
                $validator->errors()->add("event", "There must be at least one event to insert");
            }
        });
    }

    /**
     * Override response function to redirect to custom route
     * 
     * @param  array $errors
     * @return \Illuminate\Http\Response
     */
    public function response(array $errors)
    {
        return $this->redirector->to(route("admin.events.index"))
            ->withErrors($errors, $this->errorBag);
    }
}
