<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SellerRequest;
use App\Models\Location;
use App\Models\Seller;
use App\Models\SubscriptionPlan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class SellerController extends Controller
{
    public function index()
    {
        $sellers = Seller::with(["location"])
            ->desc()
            ->paginate(config("motorTraders.paginate.perPage"));
        return view("sellers.index", compact("sellers"));
    }

    public function create()
    {
        $states = Location::all();
        $subscriptionPlans = SubscriptionPlan::where('model', 'seller')->get();
        return view("sellers.create", compact("states", "subscriptionPlans"));
    }

    public function store(SellerRequest $request)
    {
        DB::beginTransaction();

        try {
            $validatedFields = $request->validated();
            unset($validatedFields["business_registration_document"]);

            $seller = Seller::create($validatedFields);

            if ($request->hasFile("business_registration_document")) {
                $file = $request->file("business_registration_document");
                $filePath = $file->store("{$seller->id}/business_document", [
                    "disk" => "sellers",
                ]);
            }

            if (isset($filePath)) {
                $seller->update([
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

                $seller->subscriptions()->create([
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
                ->route("sellers.index")
                ->with("success", "Seller created successfully.");
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()
                ->back()
                ->with(
                    "danger",
                    "Something went wrong" . $exception->getMessage()
                );
        }
    }

    public function edit(Seller $seller)
    {
        $states = Location::all();
        $subscriptionPlans = SubscriptionPlan::where('model', 'seller')->get();
        $latestSubscription = $seller->subscriptions()->first();
        return view(
            "sellers.edit",
            compact("seller", "states", "subscriptionPlans", "latestSubscription")
        );
    }

    public function update(Request $request, Seller $seller)
    {
        $request->validate([
            "first_name" => "required|string|min:4|max:50",
            "last_name" => "nullable|string|min:4|max:50",
            "email" => 'required|email|unique:sellers,email,' . $seller->id,
            "password" =>
                'nullable|confirmed|min:8|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/',
            "business_name" => "required|string|min:4|max:50",
            "business_phone" => "required|string|min:4|max:50",
            "business_email" => 'required|email|unique:sellers,business_email,' . $seller->id,
            "abn" => "required|alpha_num|min:4|max:50",
            "business_registration_document" =>
                "nullable|mimetypes:application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/octet-stream,application/pdf|max:5120",
            "address_line" => "nullable|string|max:200",
            "location_id" => "required|exists:locations,id",
            "postal_code" => "required|string|min:5|max:10",
            "subscription_plan_id" => "nullable|exists:subscription_plans,id",
        ]);

        DB::beginTransaction();

        try {
            $validatedFields = $request->all();
            unset($validatedFields["business_registration_document"]);

            $seller->update($validatedFields);

            if ($request->hasFile("business_registration_document")) {
                $file = $request->file("business_registration_document");
                $filePath = $file->store("{$seller->id}/business_document", [
                    "disk" => "sellers",
                ]);
            }

            if (isset($filePath)) {
                $seller->update([
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

                $seller->subscriptions()->create([
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
                ->route("sellers.index")
                ->with("success", "Seller updated successfully.");
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

    public function show($seller)
    {
        $seller = Seller::with(["location", "subscriptions"])->findOrFail(
            $seller
        );
        $latestSubscription = $seller->subscriptions()->first();
        return view("sellers.show", compact("seller", "latestSubscription"));
    }

    public function destroy(Seller $seller)
    {
        $seller->delete();
        return redirect()
            ->route("sellers.index")
            ->with("success", "Seller deleted successfully");
    }

    public function downloadDocument()
    {
        return Storage::disk("sellers")->download(request()->path);
    }
}
