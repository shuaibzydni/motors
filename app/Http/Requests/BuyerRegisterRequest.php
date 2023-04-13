<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BuyerRegisterRequest extends FormRequest
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
            "first_name" => "required|string|min:4|max:50",
            "email" => "required|email|unique:buyers,email",
            "password" =>
                'required|min:8|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/',
            "business_phone" => "required|string|min:4|max:50",
            "address_line" => "required|string|max:200",
            "location_id" => "required|exists:locations,id",
            "postal_code" => "required|string|min:5|max:10",
        ];
    }

    public function messages()
    {
        return [
            "password.min" => "Password must be minimum 8 characters long",
            "password.regex" =>
                "Password must be minimum 8 character and should contain atleast one number, one caps and a special character",
        ];
    }
}
