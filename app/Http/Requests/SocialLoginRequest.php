<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SocialLoginRequest extends FormRequest
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
            'first_name'=> 'required|string|min:4|max:50',
            'email'     => 'required|email',
            'google_id' => 'required_if:fb_id,""',
            'fb_id'     => 'required_if:google_id,""',
        ];
    }
}
