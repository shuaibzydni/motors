<?php

namespace App\Services;

use App\Models\ProductBrand;
use App\Traits\CustomModelTrait;

class ProductBrandService
{
    use CustomModelTrait;

    public function listFilter()
    {
        $productBrands = new ProductBrand();

        $queries = request()->has("query")
            ? json_decode(request()->input("query"))
            : [];

        foreach ($queries as $field => $query) {
            if (is_string($query)) {
                if ($field === "search") {
                    $productBrands = $productBrands->where(
                        "name",
                        "LIKE",
                        "%{$query}%"
                    );
                } else {
                    $productBrands = $productBrands->where(
                        $field,
                        "LIKE",
                        "%{$query}%"
                    );
                }
            }
        }

        if (request()->has("orderBy")) {
            $direction = request()->ascending === "true" ? "ASC" : "DESC";
            $productBrands = $productBrands->orderBy(
                request()->orderBy,
                $direction
            );
        }

        return $this->paginateOrGet($productBrands);
    }
}
