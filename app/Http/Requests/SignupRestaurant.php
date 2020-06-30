<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SignupRestaurant extends FormRequest
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

    public function messages()
    {
        return [
            'restaurant.unique' => 'Restaurant Already Exists',
            'restaurant.required' => 'Restaurant name is Required',
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
            'restaurant' => 'required|max:255|unique:restaurants,res_name',
            'password' => 'required|min:6|confirmed',
            'logoImg' => 'mimes:jpeg,bmp,png,jpg,gif',
        ];
    }
}
