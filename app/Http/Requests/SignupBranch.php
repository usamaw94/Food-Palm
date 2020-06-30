<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SignupBranch extends FormRequest
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

    public function messages()
    {
        return [
            'area.required' => 'Area is Required',
            'city.required' => 'City is Required',
            'brestaurant.required' => 'Restaurant must be Selected',
            'latitude.required' => 'Specify the location on Map',
            'bpassword.required' => 'Password is Required',
            'bpassword.min' => 'Password must be atleast 6 characters.',
            'bpassword.confirmed' => 'The password confirmation does not match.',
        ];
    }

    public function rules()
    {
        return [
            //
            'area' => 'required',
            'city' => 'required',
            'brestaurant' => 'required',
            'latitude' => 'required',
            'bpassword' => 'required|min:6|confirmed',
        ];
    }
}
