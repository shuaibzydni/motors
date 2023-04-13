<?php

namespace App\Services;

use App\Models\ProductCategory;
use App\Traits\CustomModelTrait;

class ProductCategoryService
{
    use CustomModelTrait;

    public function listFilter()
    {
        $productCategories = new ProductCategory();

        $queries = request()->has("query")
            ? json_decode(request()->input("query"))
            : [];

        foreach ($queries as $field => $query) {
            if (is_string($query)) {
                if ($field === "search") {
                    $productCategories = $productCategories->where(
                        "name",
                        "LIKE",
                        "%{$query}%"
                    );
                } else {
                    $productCategories = $productCategories->where(
                        $field,
                        "LIKE",
                        "%{$query}%"
                    );
                }
            }
        }

        if (request()->has("orderBy")) {
            $direction = request()->ascending === "true" ? "ASC" : "DESC";
            $productCategories = $productCategories->orderBy(
                request()->orderBy,
                $direction
            );
        }

        return $this->paginateOrGet($productCategories);
    }
}
