<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BuyerRequest;
use App\Models\Buyer;
use App\Models\Location;
use App\Models\SubscriptionPlan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class BuyerController extends Controller
{
    public function index()
    {
        $buyers = Buyer::with("location")
            ->desc()
            ->paginate(config("motorTraders.paginate.perPage"));
        return view("buyers.index", compact("buyers"));
    }

    public function create()
    {
        $states = Location::all();
        $subscriptionPlans = SubscriptionPlan::where('model', 'buyer')->get();
        return view("buyers.create", compact("states", "subscriptionPlans"));
    }

    public function store(BuyerRequest $request)
    {
        DB::beginTransaction();

        try {
            $validatedFields = $request->validated();
            unset($validatedFields["business_registration_document"]);

            $buyer = Buyer::create($validatedFields);

            if ($request->hasFile("business_registration_document")) {
                $file = $request->file("business_registration_document");
                $filePath = $file->store("{$buyer->id}/business_document", [
                    "disk" => "buyers",
                ]);
            }

            if (isset($filePath)) {
                $buyer->update([
                    "business_registration_document" => $filePath,
                ]);
            }

            if ($request->has('subscription_plan_id') && $request->subscription_plan_id) {
                $plan = SubscriptionPlan::findOrFail($request->subscription_plan_id);

                if ($plan->type === SubscriptionPlan::PLAN_TYPE['ANNUAL']) {
                    $endsAt = Carbon::now()->addYear();
                } elseif ($plan->type === SubscriptionPlan::PLAN_TYPE['MONTH']) {
                    $endsAt = Carbon::now()->addMonth();
                } elseif ($plan->type === SubscriptionPlan::PLAN_TYPE['WEEK']) {
                    $endsAt = Carbon::now()->addWeek();
                } else {
                    $endsAt = Carbon::now()->addMonth();
                }

                $buyer->subscriptions()->create([
                    'transaction_id' => 'ADMIN_CREATED_SUBSCRIPTION',
                    'stripe_status' => 'default',
                    'stripe_price' => $plan->cost,
                    'quantity' => $plan->limit,
                    'ends_at' => $endsAt,
                    'plan_data' => $plan->toArray(),
                ]);
            }

            DB::commit();

            return redirect()
                ->route("buyers.index")
                ->with("success", "Buyer created successfully.");
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()
                ->back()
                ->with(
                    "danger",
                    "Something went wrong " . $exception->getMessage()
                );
        }
    }

    public function edit(Buyer $buyer)
    {
        $states = Location::all();
        $subscriptionPlans = SubscriptionPlan::where('model', 'buyer')->get();
        $latestSubscription = $buyer->subscriptions()->first();
        return view("buyers.edit", compact("buyer", "states", "subscriptionPlans", "latestSubscription"));
    }

    public function update(Request $request, Buyer $buyer)
    {
        $request->validate([
            "first_name" => "required|string|min:4|max:50",
            "last_name" => "nullable|string|min:4|max:50",
            "email" => "required|email|unique:buyers,email," . $buyer->id,
            "password" =>
                'nullable|confirmed|min:8|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/',
            "business_name" => "required|string|min:4|max:50",
            "business_phone" => "required|string|min:4|max:50",
            "business_email" => "required|email|unique:buyers,business_email," . $buyer->id,
            "abn" => "required|alpha_num|min:4|max:50",
            "business_registration_document" =>
                "nullable|mimetypes:application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/octet-stream,application/pdf|max:5120",
            "address_line" => "required|string|max:200",
            "location_id" => "required|exists:locations,id",
            "postal_code" => "required|string|min:5|max:10",
            "subscription_plan_id" => "nullable|exists:subscription_plans,id",
        ]);

        DB::beginTransaction();

        try {
            $validatedFields = $request->all();
            unset($validatedFields["business_registration_document"]);

            $buyer->update($validatedFields);

            if ($request->hasFile("business_registration_document")) {
                $file = $request->file("business_registration_document");
                $filePath = $file->store("{$buyer->id}/business_document", [
                    "disk" => "buyers",
                ]);
            }

            if (isset($filePath)) {
                $buyer->update([
                    "business_registration_document" => $filePath,
                ]);
            }

            if ($request->has('subscription_plan_id') && $request->subscription_plan_id) {
                $plan = SubscriptionPlan::findOrFail($request->subscription_plan_id);

                if ($plan->type === SubscriptionPlan::PLAN_TYPE['ANNUAL']) {
                    $endsAt = Carbon::now()->addYear();
                } elseif ($plan->type === SubscriptionPlan::PLAN_TYPE['MONTH']) {
                    $endsAt = Carbon::now()->addMonth();
                } elseif ($plan->type === SubscriptionPlan::PLAN_TYPE['WEEK']) {
                    $endsAt = Carbon::now()->addWeek();
                } else {
                    $endsAt = Carbon::now()->addMonth();
                }

                $buyer->subscriptions()->create([
                    'transaction_id' => 'ADMIN_CREATED_SUBSCRIPTION',
                    'stripe_status' => 'default',
                    'stripe_price' => $plan->cost,
                    'quantity' => $plan->limit,
                    'ends_at' => $endsAt,
                    'plan_data' => $plan->toArray(),
                ]);
            }

            DB::commit();

            return redirect()
                ->route("buyers.index")
                ->with("success", "Buyer updated successfully.");
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()
                ->back()
                ->with(
                    "danger",
                    "Something went wrong " . $exception->getMessage()
                );
        }
    }

    public function show($buyer)
    {
        $buyer = Buyer::with(["location", "subscriptions"])->findOrFail($buyer);
        $latestSubscription = $buyer->subscriptions()->first();
        return view("buyers.show", compact("buyer", "latestSubscription"));
    }

    public function destroy(Buyer $buyer)
    {
        $buyer->delete();
        return redirect()
            ->route("buyers.index")
            ->with("success", "Buyer deleted successfully");
    }

    public function downloadDocument()
    {
        return Storage::disk("buyers")->download(request()->path);
    }
}
