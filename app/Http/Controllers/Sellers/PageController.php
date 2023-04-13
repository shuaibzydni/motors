<?php

namespace App\Http\Controllers\Sellers;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use App\Models\Location;
use App\Models\SiteSetting;
use App\Models\SubscriptionPlan;
use App\Models\Views\ProductView;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class PageController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $user = Auth::guard('sellers_web')->user();
            if ($user) {
                $notifications = $user->notifications()->orderBy('id', 'desc')->take(5)->get();
                $unreadNotificationCount = $user->notifications()->unread()->count();
            } else {
                $notifications = [];
            }
            View::share('last5Notifications', $notifications);
            View::share('unreadNotificationCount', $unreadNotificationCount ?? 0);
            return $next($request);
        });
    }

    public function index()
    {
        return view('sellers.pages.home');
    }

    public function aboutUs()
    {
        return view('sellers.pages.about_us');
    }

    public function contactUs()
    {
        return view('sellers.pages.contact_us');
    }

    public function helpCenter()
    {
        $faqs = Faq::where('type', 'seller');
        if (request()->has('search')) {
            $faqs->where('question', 'LIKE', '%' . request()->search . '%')
                ->orWhere('answer', 'LIKE', '%' . request()->search . '%');
        }
        $faqs = $faqs->get();
        return view('sellers.pages.help_center', compact('faqs'));
    }

    public function myVehicles()
    {
        return view('sellers.pages.my_vehicles');
    }

    public function paymentMethods($slug)
    {
        $user = request()->user('sellers_web');

        $plan = SubscriptionPlan::with('features')->where('slug', $slug)->firstOrFail();
        return view('sellers.pages.payment_methods', compact('plan', 'user'));
    }

    public function pricingPlan()
    {
        $user = request()->user('sellers_web');

        $subscriptionPlans = SubscriptionPlan::with('features')->where('model', 'seller')->get();
        return view('sellers.pages.pricing_plan', compact('subscriptionPlans', 'user'));
    }

    public function termsAndPolicy()
    {
        return view('sellers.pages.terms_and_policy');
    }

    public function notification()
    {
        $user = Auth::guard('sellers_web')->user();
        $notifications = $user->notifications()->orderBy('id', 'desc')->paginate(20);
        return view('sellers.pages.notification', compact('notifications'));
    }

    public function vehicleDetail($id)
    {
        $product = ProductView::findOrFail($id);
        $biddings = $product->biddings()->with('buyer', function ($query) {
            $query->with('location');
        })
            ->orderby(DB::raw('case when bidding_type= "accepted" then 1 when bidding_type= "sold" then 2 when bidding_type= "declined" then 3 end'))
            ->get()->toArray();
        $product = $product->toArray();
        return view('sellers.pages.vehicle_detail', compact('product', 'biddings'));
    }

    public function accountDetail()
    {
        $states = Location::all();
        $user = Auth::guard('sellers_web')->user();
        return view('sellers.pages.account_detail', compact('user', 'states'));
    }
}
