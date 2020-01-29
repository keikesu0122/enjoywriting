<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EnpostRequest extends FormRequest
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
            'title'=>'required|regex:/^[a-zA-Z0-9- ]+$/|min:5',
            'entext'=>'required|regex:/^[a-zA-Z0-9- ]+$/|min:10',
            'postimg'=>'file|image|mimes:jpeg,png,jpg|max:4096'
        ];
    }
}
