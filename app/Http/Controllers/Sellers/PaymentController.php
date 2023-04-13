<?php

namespace App\Http\Controllers\Sellers;

use App\Http\Controllers\Controller;
use App\Models\SubscriptionPlan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Stripe\Charge;
use Stripe\Stripe;

class PaymentController extends Controller
{
    public function __construct()
    {
        config(['cashier.model' => 'App\Models\Seller']);
    }

    public function subscriptionCreate(Request $request, $plan)
    {
        $plan = SubscriptionPlan::findOrFail($plan);
        if ($plan->model === 'seller') {
            $user = $request->user('sellers_web');
        } else {
            $user = $request->user('buyers_web');
        }

        Stripe::setApiKey(config('cashier.secret'));

        $charge = Charge::create ([
            "amount" => $plan->cost * 100,
            "currency" => "inr",
            "source" => $request->stripeToken,
            "description" => "Payment for motor traders",
        ]);

        if ($plan->type === SubscriptionPlan::PLAN_TYPE['ANNUAL']) {
            $endsAt = Carbon::now()->addYear();
        } elseif ($plan->type === SubscriptionPlan::PLAN_TYPE['MONTH']) {
            $endsAt = Carbon::now()->addMonth();
        } elseif ($plan->type === SubscriptionPlan::PLAN_TYPE['WEEK']) {
            $endsAt = Carbon::now()->addWeek();
        } else {
            $endsAt = Carbon::now()->addMonth();
        }

        $user->subscriptions()->create([
            'transaction_id' => $charge->id,
            'stripe_status' => $charge->status,
            'stripe_price' => $plan->cost,
            'quantity' => $plan->limit,
            'ends_at' => $endsAt,
            'stripe_data' => $charge->toJSON(),
            'plan_data' => $plan->toArray(),
        ]);

        Session::flash('success', 'Payment successful!');

        return back();
    }
}
