<?php

namespace App\Http\Controllers\Buyers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Sellers\ProductRequest;
use App\Models\Bidding;
use App\Models\BodyType;
use App\Models\DriveType;
use App\Models\Favourite;
use App\Models\FuelType;
use App\Models\Product;
use App\Models\ProductBrand;
use App\Models\ProductMake;
use App\Models\Seller;
use App\Models\Transmission;
use App\Models\Views\ProductView;
use Facades\App\Services\ProductService;
use App\Traits\HasApiResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CarController extends Controller
{
    use HasApiResponse;

    protected $fileTypes = [
        "service_log_book",
        "front_image",
        "rear_image",
        "left_side_image",
        "interior_image",
        "cargo_area_image",
        "engine_bay_image",
        "roof_image",
        "wheels_image",
        "keys_image",
        "owners_manual",
    ];

    public function carResources()
    {
        $makes = ProductBrand::all();
        $modelYears = [];
        $driveTypes = DriveType::all();
        $fuelTypes = FuelType::all();
        $bodyTypes = BodyType::all();
        $transmissions = Transmission::all();

        for ($startYear = 1901; $startYear <= date("Y"); $startYear++) {
            $modelYears[] = $startYear;
        }

        $modelYears = array_reverse($modelYears);

        return $this->apiSuccess([
            'makes'         => $makes,
            'modelYears'    => $modelYears,
            'driveTypes'    => $driveTypes,
            'fuelTypes'     => $fuelTypes,
            'bodyTypes'     => $bodyTypes,
            'transmissions' => $transmissions,
        ]);
    }

    public function carModels()
    {
        $makes = ProductMake::where('product_brand_id', request()->brand_id)->get();

        $others = ProductMake::where('name', 'Others')->where('product_brand_id', null)->get();

        $makes = $makes->merge($others);

        return $this->apiSuccess($makes);
    }

    public function carStore(ProductRequest $request)
    {
        $user = Auth::guard('sellers_web')->user();

        if ($user->subscription_status['status'] === 'expired') {
            return response()->json(
                [
                    'message' => 'You don\'t have any active subscriptions or limit exceeded.' ,
                ],
                422
            );
        }

        DB::beginTransaction();

        try {
            $validatedFields = $request->validated();
            $validatedFields["seller_id"] = Auth::guard('sellers_web')->user()->id;
            $validatedFields["advertisement_id"] = time() . mt_rand();

            foreach ($this->fileTypes as $fileType) {
                unset($validatedFields[$fileType]);
            }

            $product = Product::create($validatedFields);

            foreach ($this->fileTypes as $fileType) {
                if ($request->hasFile($fileType)) {
                    $file = $request->file($fileType);
                    $filePath = $file->store("{$product->id}/{$fileType}", [
                        "disk" => "products",
                    ]);
                }

                if (isset($filePath)) {
                    $product->update([
                        $fileType => $filePath,
                    ]);
                }

                $filePath = null;
            }

            DB::commit();

            return $this->apiCreated($product);
        } catch (\Exception $exception) {
            DB::rollBack();
            return $this->apiError(
                "Something went wrong: " . $exception
            );
        }
    }

    public function carUpdate(ProductRequest $request, $productId)
    {
        DB::beginTransaction();

        try {
            $validatedFields = $request->validated();

            foreach ($this->fileTypes as $fileType) {
                unset($validatedFields[$fileType]);
            }

            $product = Product::findOrFail($productId);
            $product->update($validatedFields);

            foreach ($this->fileTypes as $fileType) {
                if ($request->hasFile($fileType)) {
                    Storage::disk("products")->delete($product->{$fileType});
                    $file = $request->file($fileType);
                    $filePath = $file->store("{$product->id}/{$fileType}", [
                        "disk" => "products",
                    ]);
                }

                if (isset($filePath)) {
                    $product->update([
                        $fileType => $filePath,
                    ]);
                }
                $filePath = null;
            }

            DB::commit();

            return $this->apiCreated($product);
        } catch (\Exception $exception) {
            DB::rollBack();
            return $this->apiError(
                "Something went wrong: " . $exception
            );
        }
    }

    public function carList()
    {
        return $this->apiSuccess(ProductService::listFilter());
    }

    public function vehicleDetail($id)
    {
        $product = ProductView::findOrFail($id);
        return $this->apiSuccess($product);
    }

    public function carDelete($id)
    {
        $favourites = Favourite::where('product_id', $id)->get();
        if(count($favourites) > 0) {
            foreach ($favourites as $favourite) {
                $favourite->delete();
            }
        }
        
        $product = Product::findOrFail($id);
        if ($product->vehicle_status === 'sold') {
            return $this->apiError('Sold Vehicle cannot be deleted');
        }
        foreach ($this->fileTypes as $fileType) {
            if ($product->{$fileType}) {
                Storage::disk("products")->delete($product->{$fileType});
            }
        }
        $biddings = Bidding::where('product_id', $product->id)->get();
        if(count($biddings) > 0) {
            foreach ($biddings as $bidding) {
                $bidding->delete();
            }
        }
        $product->delete();
        return $this->apiDeleted();
    }

    public function apiCarList()
    {
        return $this->apiSuccess(ProductService::apiBuyerlistFilter());
    }

    public function apiCarShow($id)
    {
        $product = ProductView::findOrFail($id);
        $biddingCount = $product->biddings()->count();
        $biddingDetail = null;
        if (Auth::guard('buyers_web')->user()) {
            $biddingDetail = $product->biddings()->where('buyer_id', Auth::guard('buyers_web')->user()->id)->first();
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
            'name' => $seller->first_name,
            'email' => $seller->email,
            'avatar' => $seller->avatar,
            'business_name' => $seller->business_name,
            'business_email' => $seller->business_email,
            'business_phone' => $seller->business_phone,
            'address_line' => $seller->address_line,
            'text' => 'Your Bid Price'
        ];

        if ($biddingDetail && $acceptedBid && $product['vehicle_status'] !== 'available') {
            if ($biddingDetail['buyer_id'] == $acceptedBid['buyer_id']) {
                $hiddenSeller = [
                    'name' => $seller->first_name,
                    'email' => $seller->email,
                    'avatar' => $seller->avatar,
                    'business_name' => $seller->business_name,
                    'business_email' => $seller->business_email,
                    'business_phone' => $seller->business_phone,
                    'address_line' => $seller->address_line,
                    'text' => 'Your Bid Accepted'
                ];
            }
        }

        $data = [
            'vehicleDetail' => $product,
            'biddingCount' => $biddingCount,
            'biddingDetail' => $biddingDetail,
            'acceptedBid' => $acceptedBid,
            'hiddenSeller' => $hiddenSeller,
        ];

        return $this->apiSuccess($data);
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
