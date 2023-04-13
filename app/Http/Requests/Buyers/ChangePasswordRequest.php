<?php

namespace App\Http\Requests\Buyers;

use App\Rules\BuyerOldPasswordCheckRule;
use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
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
            "old_password" => ['required', new BuyerOldPasswordCheckRule()],
            "password" =>
                'required|confirmed|min:8|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/',
        ];
    }

    protected function getRedirectUrl()
    {
        return parent::getRedirectUrl() . '?tab=cp'; // TODO: Change the autogenerated stub
    }
}
