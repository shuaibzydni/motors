<?php

namespace App\Http\Controllers\Buyers;

use App\Http\Controllers\Controller;
use App\Models\Bidding;
use App\Models\BodyType;
use App\Models\Buyer;
use App\Models\DriveType;
use App\Models\Faq;
use App\Models\FuelType;
use App\Models\Location;
use App\Models\ProductBrand;
use App\Models\ProductMake;
use App\Models\Seller;
use App\Models\SiteSetting;
use App\Models\SubscriptionPlan;
use App\Models\Transmission;
use App\Models\Views\ProductView;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\View;

class PageController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $user = Auth::guard('buyers_web')->user();
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
        $makes = ProductBrand::all();
        $modelYears = [];
        $fuelTypes = FuelType::all();
        $driveTypes = DriveType::all();
        $bodyTypes = BodyType::all();

        for ($startYear = 1901; $startYear <= date("Y"); $startYear++) {
            $modelYears[] = $startYear;
        }

        $modelYears = array_reverse($modelYears);

        $topRecommendations = ProductView::where('vehicle_status', 'available')->orderBy('id', 'desc')->get();
        return view('buyers.pages.home', compact('topRecommendations', 'makes', 'modelYears', 'fuelTypes', 'driveTypes', 'bodyTypes'));
    }

    public function aboutUs()
    {
        return view('buyers.pages.about_us');
    }

    public function accountSettings()
    {
        $states = Location::all();
        $user = Auth::guard('buyers_web')->user();
        return view('buyers.pages.account_settings', compact('states', 'user'));
    }

    public function changePassword()
    {
        return view('buyers.pages.change_password');
    }

    public function contactUs()
    {
        return view('buyers.pages.contact_us');
    }

    public function discoverVehicle()
    {
        $topRecommendations = ProductView::where('vehicle_status', 'available')->orderBy('id', 'desc')->take(5)->get()->toArray();

        $makes = ProductBrand::all();
        $models = ProductMake::with('brand')->whereIn('product_brand_id', request()->make ?? [])->get();
        $modelYears = [];
        $fuelTypes = FuelType::all();
        $driveTypes = DriveType::all();
        $bodyTypes = BodyType::all();
        $transmissions = Transmission::all();

        for ($startYear = 1901; $startYear <= date("Y"); $startYear++) {
            $modelYears[] = $startYear;
        }

        $modelYears = array_reverse($modelYears);

        $cars = ProductView::with('seller')->where('vehicle_status', 'available');
        if (\request()->make) {
            $makeQuery = array_filter(request()->make);
            if (!empty($makeQuery)) {
                $cars = $cars->whereIn('product_brand_id', $makeQuery);
            }
        }
        if (\request()->model) {
            $modelQuery = array_filter(request()->model);
            if (!empty($modelQuery)) {
                $cars = $cars->whereIn('product_make_id', $modelQuery);
            }
        }
        if (\request()->fuel_type) {
            $ftQuery = array_filter(request()->fuel_type);
            if (!empty($ftQuery)) {
                $cars = $cars->whereIn('fuel_type_id', $ftQuery);
            }
        }
        if (\request()->drive_type) {
            $dtQuery = array_filter(request()->drive_type);
            if (!empty($dtQuery)) {
                $cars = $cars->whereIn('drive_type_id', $dtQuery);
            }
        }
        if (\request()->body_type) {
            $btQuery = array_filter(request()->body_type);
            if (!empty($btQuery)) {
                $cars = $cars->whereIn('body_type_id', $btQuery);
            }
        }
        if (\request()->transmission) {
            $transmissionQuery = array_filter(request()->transmission);
            if (!empty($transmissionQuery)) {
                $cars = $cars->whereIn('transmission_id', $transmissionQuery);
            }
        }
        if (\request()->model_year) {
            $cars = $cars->where('model_year', request()->model_year);
        }
        if (\request()->order_by) {
            $cars = $cars->orderBy('id', request()->order_by);
        }
        $cars = $cars->paginate();
        return view('buyers.pages.discover_vehicle', compact('cars', 'makes', 'models', 'modelYears', 'fuelTypes', 'driveTypes', 'bodyTypes', 'transmissions', 'topRecommendations'));
    }

    public function favourites()
    {
        $topRecommendations = ProductView::where('vehicle_status', 'available')->orderBy('id', 'desc')->take(5)->get()->toArray();

        $buyerId = Auth::guard('buyers_web')->user()->id;
        $buyer = Buyer::with('favourites')->find($buyerId);
        $favourites = $buyer->favourites()->paginate();
        return view('buyers.pages.favourites', compact('favourites', 'topRecommendations'));
    }

    public function helpCenter()
    {
        $faqs = Faq::where('type', 'buyer');
        if (request()->has('search')) {
            $faqs->where('question', 'LIKE', '%' . request()->search . '%')
                ->orWhere('answer', 'LIKE', '%' . request()->search . '%');
        }
        $faqs = $faqs->get();
        return view('buyers.pages.help_center', compact('faqs'));
    }

    public function manageBids()
    {
        $currentBids = Bidding::with('product')->desc()->where('buyer_id', Auth::guard('buyers_web')->user()->id)
            ->where('bidding_type', Bidding::BID_STATUS['REQUESTED'])->get();
        $successfulBids = Bidding::with(['product', 'seller'])->desc()->where('buyer_id', Auth::guard('buyers_web')->user()->id)
            ->where(function($query) {
                $query->where('bidding_type', Bidding::BID_STATUS['ACCEPTED'])
                    ->orWhere('bidding_type', Bidding::BID_STATUS['SOLD']);
            })->get();
        $declinedBids = Bidding::with('product')->desc()->where('buyer_id', Auth::guard('buyers_web')->user()->id)
            ->where('bidding_type', Bidding::BID_STATUS['DECLINED'])->get();
        return view('buyers.pages.manage_bids', compact('currentBids', 'successfulBids', 'declinedBids'));
    }

    public function termsAndConditions()
    {
        return view('buyers.pages.terms_and_conditions');
    }

    public function notification()
    {
        $user = Auth::guard('buyers_web')->user();
        $notifications = $user->notifications()->orderBy('id', 'desc')->paginate(20);
        return view('buyers.pages.notification', compact('notifications'));
    }

    public function vehicleDetail($id)
    {
        $topRecommendations = ProductView::orderBy('id', 'desc')->take(5)->get()->toArray();

        $product = ProductView::findOrFail($id);
        $biddingCount = $product->biddings()->count();
        $biddingDetail = null;
        if (Auth::guard('buyers_web')->user()) {
            $biddingDetail = $product->biddings()->where('buyer_id', Auth::guard('buyers_web')->user()->id)->desc()->first();
            if ($biddingDetail) {
                $biddingDetail = $biddingDetail->toArray();
            }
        }
        $acceptedBid = Bidding::where('product_id', $product->id)
            ->where(function ($query) {
                $query->where('bidding_type', Bidding::BIDDING_TYPE['ACCEPTED'])
                    ->orWhere('bidding_type', Bidding::BIDDING_TYPE['SOLD']);
            })->first();
        if ($acceptedBid) {
            $acceptedBid = $acceptedBid->toArray();
        }
        $seller = Seller::with('location')->findOrFail($product->seller_id);
        $product = $product->toArray();

        $hiddenSeller = [
            'name' => $this->star_replace($seller->first_name),
            'email' => $this->star_replace($seller->email),
            'business_name' => $this->star_replace($seller->business_name),
            'business_email' => $this->star_replace($seller->business_email),
            'business_phone' => $this->star_replace($seller->business_phone),
            'address_line' => $seller->address_line,
            'text' => 'Your Bid Price'
        ];

        if ($biddingDetail && $acceptedBid && $product['vehicle_status'] !== 'available') {
            if ($biddingDetail['buyer_id'] == $acceptedBid['buyer_id']) {
                $hiddenSeller = [
                    'name' => $seller->first_name,
                    'email' => $seller->email,
                    'business_name' => $seller->business_name,
                    'business_email' => $seller->business_email,
                    'business_phone' => $seller->business_phone,
                    'address_line' => $seller->address_line,
                    'text' => 'Your Bid Accepted'
                ];
            }
        }
        $user = request()->user('buyers_web');
        $isUserLoggedIn = $user ? true : false;
        if ($user && $user->currentSubscriptionPlan() && $user->currentSubscriptionPlan()->ends_at) {
            $isSubscriptionEnded = (!$user->currentSubscriptionPlan()->ends_at->isFuture() || $user->subscriptionPlanLimit() < 1);
        } else {
            $isSubscriptionEnded = false;
        }

        return view('buyers.pages.vechicle_detail',
            compact('product', 'hiddenSeller', 'topRecommendations', 'biddingCount', 'biddingDetail', 'acceptedBid', 'isUserLoggedIn', 'isSubscriptionEnded')
        );
    }

    public function paymentMethods($slug)
    {
        $user = request()->user('buyers_web');

        $plan = SubscriptionPlan::with('features')->where('slug', $slug)->firstOrFail();
        return view('buyers.pages.payment_methods', compact('plan', 'user'));
    }

    public function pricingPlan()
    {
        $user = request()->user('buyers_web');

        $subscriptionPlans = SubscriptionPlan::with('features')->where('model', 'buyer')->get();
        return view('buyers.pages.pricing_plan', compact('subscriptionPlans', 'user'));
    }

    protected function star_replace($string) {
        return preg_replace_callback('/[-\w]+/i', function($match){
            $arr = str_split($match[0]);
            $len = count($arr)-1;
            for($i=1;$i<$len;$i++) $arr[$i] = $arr[$i] == '-' ? '-' : '*';
            return implode($arr);
        }, $string);
    }
}
