<?php

namespace App\Http\Controllers\Sellers;

use App\Http\Controllers\Controller;
use App\Models\SubscriptionPlan;
use Carbon\Carbon;
use Facades\App\Services\SubscriptionPlanService;
use App\Traits\HasApiResponse;
use Illuminate\Http\Request;
use Stripe\Charge;
use Stripe\Stripe;

class SubscriptionPlanController extends Controller
{
    use HasApiResponse;

    public function list()
    {
        return $this->apiSuccess(SubscriptionPlanService::listFilter('seller'));
    }

    public function subscriptionCreate(Request $request, $plan)
    {
        $plan = SubscriptionPlan::findOrFail($plan);

        $request->validate([
            'token' => 'required',
        ]);

        $user = $request->user();

        Stripe::setApiKey(config('cashier.secret'));

        $charge = Charge::create ([
            "amount" => $plan->cost * 100,
            "currency" => "inr",
            "source" => $request->token,
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

        return $this->apiUpdated(true);
    }
}
