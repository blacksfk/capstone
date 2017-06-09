<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArrayPost extends FormRequest
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
        $rules = [
            'items' => 'array|min:1',
        ];
        foreach($this->request->get('items') as $key => $val){
            $rules['items.'.$key.'.asset_id'] = 'required|max:255';
            $rules['items.'.$key.'.caption'] = 'required|max:255';
        }
        return $rules;
    }
}
