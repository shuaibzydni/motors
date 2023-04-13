<?php

namespace App\Services;

use App\Models\DriveType;
use App\Traits\CustomModelTrait;

class DriveTypeService
{
    use CustomModelTrait;

    public function listFilter()
    {
        $driveTypes = new DriveType();

        $queries = request()->has("query")
            ? json_decode(request()->input("query"))
            : [];

        foreach ($queries as $field => $query) {
            if (is_string($query)) {
                if ($field === "search") {
                    $driveTypes = $driveTypes->where(
                        "title",
                        "LIKE",
                        "%{$query}%"
                    );
                } else {
                    $driveTypes = $driveTypes->where(
                        $field,
                        "LIKE",
                        "%{$query}%"
                    );
                }
            }
        }

        if (request()->has("orderBy")) {
            $direction = request()->ascending === "true" ? "ASC" : "DESC";
            $driveTypes = $driveTypes->orderBy(request()->orderBy, $direction);
        }

        return $this->paginateOrGet($driveTypes);
    }
}
