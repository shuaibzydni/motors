<?php

namespace App\Rules;

use App\Models\Buyer;
use App\Models\Seller;
use Illuminate\Contracts\Validation\Rule;

class ForgotPasswordOtpRule implements Rule
{
    protected $model, $email;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($model, $email)
    {
        $this->model = $model;
        $this->email = $email;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if ($this->model === 'buyer') {
            $user = Buyer::where('email', $this->email)->first();
        } elseif ($this->model === 'seller') {
            $user = Seller::where('email', $this->email)->first();
        }

        if ($user) {
            return $value === $user->otp;
        }
        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The entered OTP is invalid or expired';
    }
}
