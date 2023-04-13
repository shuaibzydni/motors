<?php

namespace App\Http\Requests\Buyers;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
            "email" => "required|string|email|exists:buyers,email",
            "password" => "required|string",
        ];
    }

    public function messages()
    {
        return [
            "email.exists" => 'Email ID does not exists in our record.'
        ];
    }
}
