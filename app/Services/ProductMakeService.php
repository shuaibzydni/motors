<?php

namespace App\Services;

use App\Models\ProductMake;
use App\Traits\CustomModelTrait;

class ProductMakeService
{
    use CustomModelTrait;

    public function listFilter()
    {
        $productMakes = ProductMake::where('product_brand_id', request()->product_brand_id);

        if (request()->has("orderBy")) {
            $direction = request()->ascending === "true" ? "ASC" : "DESC";
            $productMakes = $productMakes->orderBy(
                request()->orderBy,
                $direction
            );
        }

        if (!request()->has("page")) {
            $others = ProductMake::where('name', 'Others')->where('product_brand_id', null)->get();

            $productMakes = $productMakes->get();
            $productMakes = $productMakes->merge($others);

            return $productMakes;
        }

        return $this->paginateOrGet($productMakes);
    }
}
