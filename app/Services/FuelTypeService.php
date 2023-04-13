<?php

namespace App\Services;

use App\Models\FuelType;
use App\Traits\CustomModelTrait;

class FuelTypeService
{
    use CustomModelTrait;

    public function listFilter()
    {
        $fuelTypes = new FuelType();

        $queries = request()->has("query")
            ? json_decode(request()->input("query"))
            : [];

        foreach ($queries as $field => $query) {
            if (is_string($query)) {
                if ($field === "search") {
                    $fuelTypes = $fuelTypes->where(
                        "name",
                        "LIKE",
                        "%{$query}%"
                    );
                } else {
                    $fuelTypes = $fuelTypes->where(
                        $field,
                        "LIKE",
                        "%{$query}%"
                    );
                }
            }
        }

        if (request()->has("orderBy")) {
            $direction = request()->ascending === "true" ? "ASC" : "DESC";
            $fuelTypes = $fuelTypes->orderBy(request()->orderBy, $direction);
        }

        return $this->paginateOrGet($fuelTypes);
    }
}
