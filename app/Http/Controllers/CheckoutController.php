<?php

namespace App\Http\Controllers;

use App\Traits\HasApiResponse;
use Illuminate\Http\Request;
use Stripe\PaymentIntent;
use Stripe\Stripe;

class CheckoutController extends Controller
{
    use HasApiResponse;

    public function checkout(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric'
        ]);

        Stripe::setApiKey(config('cashier.secret'));

        try {
            // Create a PaymentIntent with amount and currency
            $paymentIntent = PaymentIntent::create([
                'amount' => $this->calculateOrderAmount($request->amount),
                'currency' => $request->currency ?? 'usd',
                'automatic_payment_methods' => [
                    'enabled' => true,
                ],
            ]);

            $output = [
                'clientSecret' => $paymentIntent->client_secret,
            ];

            return $this->apiSuccess($output);
        } catch (\Exception $e) {
            return $this->apiError($e->getMessage());
        }
    }

    protected function calculateOrderAmount($amount): float
    {
        return $amount * 100;
    }
}
