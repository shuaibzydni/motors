<?php

namespace App\Http\Controllers;

use App\Models\Buyer;
use Laravel\Cashier\Http\Controllers\WebhookController;

class BuyerWebhookController extends WebhookController
{
    protected function getUserByStripeId($stripeId)
    {
        return Buyer::where('stripe_id', $stripeId)->first();
    }
}
