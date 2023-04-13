<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use App\Models\SubscriptionPlan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use PHPUnit\Exception;

class SubscriptionController extends Controller
{
    protected $modelName;
//    protected $stripe;

    public function __construct()
    {
        $model = Route::current()->parameter('model');
        $this->modelName = $this->camelize($model);

//        $this->stripe = new \Stripe\StripeClient(config('cashier.secret'));
    }

    public function index($model)
    {
        $modelName = $this->modelName;
        $subscriptions = SubscriptionPlan::where('model', $model)->paginate();
        return view('subscription_plans.index', compact('model', 'modelName', 'subscriptions'));
    }

    public function create($model)
    {
        $modelName = $this->modelName;

        return view('subscription_plans.create', compact('model', 'modelName'));
    }

    public function store(Request $request, $model)
    {
        $request->validate([
            'name' => 'required|string|max:50',
            'cost' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'limit' => 'nullable|integer|gt:0',
            'description' => 'nullable|string|max:1000',
            'features' => 'nullable|array',
            'features.*' => 'nullable|string|max:250',
        ]);

        $data = $request->except(['_token', 'unlimited', 'features']);

        if ($request->unlimited) {
            $data['limit'] = 100000;
        }

        /*
        $price = $data['cost'] * 100;

        //create stripe product
        $stripeProduct = $this->stripe->products->create([
            'name' => $data['name'],
        ]);

        //Stripe Plan Creation
        $stripePlanCreation = $this->stripe->plans->create([
            'amount' => $price,
            'currency' => 'usd',
            'interval' => 'month', //  it can be day,week,month or year
            'product' => $stripeProduct->id,
        ]);

        $data['stripe_plan'] = $stripePlanCreation->id;
        */

        $data['stripe_plan'] = 'default';

        $data['model'] = $model;

        DB::beginTransaction();
        try {
            $subscriptionPlan = SubscriptionPlan::create($data);

            if ($request->has('features')) {
                foreach (request()->features as $feature) {
                    if ($feature) {
                        $subscriptionPlan->features()->create([
                            'features' => $feature
                        ]);
                    }
                }
            }

            DB::commit();

            return redirect()
                ->route("subscription.index", ['model' => $model])
                ->with("success", "Subscription created successfully.");
        } catch (\Exception $exception) {
            DB::rollBack();

            return redirect()
                ->back()
                ->with("danger", "Something went wrong! " . $exception->getMessage());
        }
    }

    public function edit($model, $id)
    {
        $modelName = $this->modelName;

        $subscriptionPlan = SubscriptionPlan::with('features')->where('model', $model)->findOrFail($id);

        return view('subscription_plans.edit', compact('model', 'modelName', 'subscriptionPlan'));
    }

    public function update(Request $request, $model, $id)
    {
        $request->validate([
            'name' => 'required|string|max:50',
            'cost' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'limit' => 'nullable|integer|gt:0',
            'description' => 'nullable|string|max:1000',
            'features' => 'nullable|array',
            'features.*' => 'nullable|string|max:250',
        ]);

        $data = $request->except(['_token', 'unlimited', 'features']);

        if ($request->unlimited) {
            $data['limit'] = 100000;
        }

        $data['stripe_plan'] = 'default';

        $data['model'] = $model;

        DB::beginTransaction();

        try {
            $subscriptionPlan = SubscriptionPlan::findOrFail($id);
            $subscriptionPlan->update($data);

            if ($request->has('features')) {
                $subscriptionPlan->features()->delete();
                foreach (request()->features as $feature) {
                    if ($feature) {
                        $subscriptionPlan->features()->create([
                            'features' => $feature
                        ]);
                    }
                }
            }

            DB::commit();

            return redirect()
                ->route("subscription.index", ['model' => $model])
                ->with("success", "Subscription updated successfully.");
        } catch (Exception $exception) {
            DB::rollBack();

            return redirect()
                ->back()
                ->with("danger", "Something went wrong! " . $exception->getMessage());
        }
    }

    public function destroy($model, $id)
    {
        $subscriptionPlan = SubscriptionPlan::where('model', $model)->findOrFail($id);

        /*
        $plan = $this->stripe->plans->retrieve(
            $subscriptionPlan->stripe_plan,
            []
        );
        $this->stripe->plans->delete(
            $subscriptionPlan->stripe_plan,
            []
        );
        $this->stripe->products->delete(
            $plan->product,
            []
        );
        */

        $subscriptionPlan->features()->delete();

        $subscriptionPlan->delete();
        return redirect()
            ->route("subscription.index", ['model' => $model])
            ->with("success", "Subscription deleted successfully");
    }

    private function camelize($input, $separator = '-')
    {
        return str_replace($separator, '', ucwords($input, $separator));
    }
}
