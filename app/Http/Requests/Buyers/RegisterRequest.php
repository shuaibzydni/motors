<?php

namespace App\Http\Requests\Buyers;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            "last_name" => "nullable|string|min:4|max:50",
            "email" => "required|email|unique:buyers,email",
            "password" =>
                'required|min:8|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/',
            "business_name" => "nullable|string|min:4|max:50",
            "business_phone" => "nullable|string|min:4|max:50",
            "business_email" => "nullable|email|unique:buyers,business_email",
            "abn" => "nullable|alpha_num|min:4|max:50",
            "buyer_license_no" => "nullable|string|min:4|max:50",
            "business_registration_document" =>
                "nullable|mimetypes:application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/octet-stream,application/pdf|max:5120",
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
                "Password must be minimum 8 character and should contain atleast one number and a special character",
            "business_registration_document.mimetypes" =>
                "The document must be of type doc, docx or pdf",
        ];
    }
}
