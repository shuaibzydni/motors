<?php

namespace App\Services;

use App\Models\BodyType;
use App\Traits\CustomModelTrait;
use Illuminate\Database\Eloquent\Model;

class BodyTypeService
{
    use CustomModelTrait;

    public function listFilter()
    {
        $bodyTypes = new BodyType();

        $queries = request()->has("query")
            ? json_decode(request()->input("query"))
            : [];

        foreach ($queries as $field => $query) {
            if (is_string($query)) {
                if ($field === "search") {
                    $bodyTypes = $bodyTypes->where(
                        "title",
                        "LIKE",
                        "%{$query}%"
                    );
                } else {
                    $bodyTypes = $bodyTypes->where(
                        $field,
                        "LIKE",
                        "%{$query}%"
                    );
                }
            }
        }

        if (request()->has("orderBy")) {
            $direction = request()->ascending === "true" ? "ASC" : "DESC";
            $bodyTypes = $bodyTypes->orderBy(request()->orderBy, $direction);
        }

        return $this->paginateOrGet($bodyTypes);
    }
}
