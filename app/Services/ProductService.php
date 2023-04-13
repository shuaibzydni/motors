<?php

namespace App\Services;

use App\Models\Bidding;
use App\Models\Product;
use App\Models\Views\ProductView;
use App\Traits\CustomModelTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class ProductService
{
    use CustomModelTrait;

    public function listFilter()
    {
        if(request()->type !== 'web') {
            $productView = ProductView::where("seller_id", request()->user()->id);
        } else {
            $productView = ProductView::where("seller_id", Auth::guard('sellers_web')->user()->id);
        }

        if (request()->bidding === Bidding::BIDDING_TYPE["LIVE"]) {
            $productView->where(
                "vehicle_status",
                Product::VEHICLE_STATUS["AVAILABLE"]
            );
        }

        if (request()->bidding === Bidding::BIDDING_TYPE["ACCEPTED"]) {
            $productView->where(
                "vehicle_status",
                Product::VEHICLE_STATUS["UNAVAILABLE"]
            );
        }

        if (request()->bidding === Bidding::BIDDING_TYPE["SOLD"]) {
            $productView->where(
                "vehicle_status",
                Product::VEHICLE_STATUS["SOLD"]
            );
        }

        $queries = request()->has("query")
            ? json_decode(request()->input("query"))
            : [];

        foreach ($queries as $field => $query) {
            if (is_string($query)) {
                if ($field === "search") {
                    $productView = $productView->where(
                        "name",
                        "LIKE",
                        "%{$query}%"
                    );
                } else {
                    $productView = $productView->where(
                        $field,
                        "LIKE",
                        "%{$query}%"
                    );
                }
            }
        }

        if (request()->has("orderBy")) {
            $direction = request()->ascending === "true" ? "ASC" : "DESC";
            $productView = $productView->orderBy(
                request()->orderBy,
                $direction
            );
        }

        return $this->paginateOrGet($productView);
    }

    public function apiSellerlistFilter()
    {
        if(request()->type !== 'web') {
            $productView = ProductView::where("seller_id", request()->user()->id);
        } else {
            $productView = ProductView::where("seller_id", Auth::guard('sellers_web')->user()->id);
        }

        if (request()->bidding === Bidding::BIDDING_TYPE["LIVE"]) {
            $productView->where(
                "vehicle_status",
                Product::VEHICLE_STATUS["AVAILABLE"]
            );
        }

        if (request()->bidding === Bidding::BIDDING_TYPE["ACCEPTED"]) {
            $productView->where(
                "vehicle_status",
                Product::VEHICLE_STATUS["UNAVAILABLE"]
            );
        }

        if (request()->bidding === Bidding::BIDDING_TYPE["SOLD"]) {
            $productView->where(
                "vehicle_status",
                Product::VEHICLE_STATUS["SOLD"]
            );
        }

        if (request()->search) {
            $query = request()->search;
            $productView = $productView->where(
                "name",
                "LIKE",
                "%{$query}%"
            );
        }
        if (request()->make) {
            $productView = $productView->whereIn('product_brand_id', request()->make);
        }
        if (request()->model) {
            $productView = $productView->whereIn('product_make_id', request()->model);
        }
        if (request()->fuel_type) {
            $productView = $productView->whereIn('fuel_type_id', request()->fuel_type);
        }
        if (request()->drive_type) {
            $productView = $productView->whereIn('drive_type_id', request()->drive_type);
        }
        if (request()->transmission) {
            $productView = $productView->whereIn('transmission_id', request()->transmission);
        }
        if (request()->model_year) {
            $productView = $productView->where('model_year', request()->model_year);
        }

        if (request()->has("orderBy")) {
            $direction = request()->ascending === "true" ? "ASC" : "DESC";
            $productView = $productView->orderBy(
                request()->orderBy,
                $direction
            );
        }

        return $this->paginateOrGet($productView);
    }

    public function apiBuyerlistFilter()
    {
        $productView = ProductView::with('seller')->where(
            "vehicle_status",
            Product::VEHICLE_STATUS["AVAILABLE"]
        );

        if (request()->search) {
            $query = request()->search;
            $productView = $productView->where(
                "name",
                "LIKE",
                "%{$query}%"
            );
        }
        if (request()->make) {
            $productView = $productView->whereIn('product_brand_id', request()->make);
        }
        if (request()->model) {
            $productView = $productView->whereIn('product_make_id', request()->model);
        }
        if (request()->fuel_type) {
            $productView = $productView->whereIn('fuel_type_id', request()->fuel_type);
        }
        if (request()->drive_type) {
            $productView = $productView->whereIn('drive_type_id', request()->drive_type);
        }
        if (request()->transmission) {
            $productView = $productView->whereIn('transmission_id', request()->transmission);
        }
        if (request()->model_year) {
            $productView = $productView->where('model_year', request()->model_year);
        }

        if (request()->has("orderBy")) {
            $direction = request()->ascending === "true" ? "ASC" : "DESC";
            $productView = $productView->orderBy(
                request()->orderBy,
                $direction
            );
        }

        return $this->paginateOrGet($productView);
    }
}
