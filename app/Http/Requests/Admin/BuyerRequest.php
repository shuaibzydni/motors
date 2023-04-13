<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class BuyerRequest extends FormRequest
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
        $validation = [
            "first_name" => "required|string|min:4|max:50",
            "last_name" => "nullable|string|min:4|max:50",
            "email" => "required|email|unique:buyers,email",
            "password" =>
                'required|confirmed|min:8|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/',
            "business_name" => "nullable|string|min:4|max:50",
            "business_phone" => "required|string|min:4|max:50",
            "business_email" => "nullable|email|unique:buyers,business_email",
            "abn" => "nullable|alpha_num|min:4|max:50",
            "business_registration_document" =>
                "nullable|mimetypes:application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/octet-stream,application/pdf|max:5120",
            "address_line" => "required|string|max:200",
            "location_id" => "required|exists:locations,id",
            "postal_code" => "required|string|min:5|max:10",
            "subscription_plan_id" => "nullable|exists:subscription_plans,id",
        ];

        if ($this->isMethod("put")) {
            $validation["email"] =
                "required|string|max:50|unique:buyers,email," .
                Auth::user()->id;
            $validation["password"] =
                'nullable|confirmed|min:8|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/';
            $validation["business_email"] =
                "nullable|email|unique:buyers,business_email," .
                Auth::user()->id;
        }

        return $validation;
    }

    public function messages()
    {
        return [
            "password.regex" =>
                "Password must be minimum 8 character and should contain atleast one number and a special character",
            "business_registration_document.mimetypes" =>
                "The document must be of type doc, docx or pdf",
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge(['password_confirmation' => $this->password ]) ;
    }
}
