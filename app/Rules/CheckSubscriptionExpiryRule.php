<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class CheckSubscriptionExpiryRule implements Rule
{
    protected $guard;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($guard = null)
    {
        $this->guard = $guard;
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
        if ($this->guard) {
            $user = Auth::guard($this->guard)->user();
        } else {
            $user = request()->user();
        }

        return $user->subscription_status['status'] === 'active';
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        if ($this->guard) {
            return 'Your subscription plan is ended or expired. Please goto pricing plan page for more information';
        } else {
            return 'Your subscription plan is ended or expired';
        }
    }
}
