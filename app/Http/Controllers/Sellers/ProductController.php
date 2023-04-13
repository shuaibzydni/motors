<?php

namespace App\Http\Controllers\Sellers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Sellers\ProductRequest;
use App\Models\Product;
use App\Models\Bidding;
use App\Models\Favourite;
use App\Models\Views\ProductView;
use Facades\App\Services\ProductService;
use App\Traits\HasApiResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
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

    public function list()
    {
        return $this->apiSuccess(ProductService::apiSellerlistFilter());
    }

    public function store(ProductRequest $request)
    {
        $user = $request->user();
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
            $validatedFields["seller_id"] = $request->user()->id;
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
                "Something went wrong: " . $exception->getMessage()
            );
        }
    }

    public function update(ProductRequest $request, $productId)
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
                "Something went wrong: " . $exception->getMessage()
            );
        }
    }

    public function show($productId)
    {
        $product = ProductView::findOrFail($productId);
        $biddings = $product->biddings()->with('buyer', function ($query) {
            $query->with('location');
        })
            ->orderby(DB::raw('case when bidding_type= "accepted" then 1 when bidding_type= "sold" then 2 when bidding_type= "declined" then 3 end'))
            ->get();

        $data = [
            'vehicleDetail' => $product,
            'biddings' => $biddings
        ];

        return $this->apiSuccess($data);
    }

    public function delete($productId)
    {
        try {
            $favourites = Favourite::where('product_id', $id)->get();
            if(count($favourites) > 0) {
                foreach ($favourites as $favourite) {
                    $favourite->delete();
                }
            }

            $product = Product::findOrFail($productId);
            $product->delete();
            Storage::disk("products")->deleteDirectory($productId);

            $biddings = Bidding::where('product_id', $product->id)->get();
            if(count($biddings) > 0) {
                foreach ($biddings as $bidding) {
                    $bidding->delete();
                }
            }

            DB::commit();
            return $this->apiDeleted();
        } catch (\Exception $exception) {
            DB::rollBack();

            return $this->apiError(
                "Something went wrong: " . $exception->getMessage()
            );
        }
    }
}
