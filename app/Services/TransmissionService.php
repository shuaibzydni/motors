<?php

namespace App\Services;

use App\Models\Transmission;
use App\Traits\CustomModelTrait;

class TransmissionService
{
    use CustomModelTrait;

    public function listFilter()
    {
        $transmissions = new Transmission();
        
        $queries = request()->has("query")
            ? json_decode(request()->input("query"))
            : [];

        foreach ($queries as $field => $query) {
            if (is_string($query)) {
                if ($field === "search") {
                    $transmissions = $transmissions->where(
                        "name",
                        "LIKE",
                        "%{$query}%"
                    );
                } else {
                    $transmissions = $transmissions->where(
                        $field,
                        "LIKE",
                        "%{$query}%"
                    );
                }
            }
        }

        if (request()->has("orderBy")) {
            $direction = request()->ascending === "true" ? "ASC" : "DESC";
            $transmissions = $transmissions->orderBy(
                request()->orderBy,
                $direction
            );
        }

        return $this->paginateOrGet($transmissions);
    }
}
