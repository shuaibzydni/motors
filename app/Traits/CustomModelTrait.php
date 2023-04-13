<?php

namespace App\Traits;

trait CustomModelTrait
{
    public function paginateOrGet($collection)
    {
        if (request()->has("page")) {
            return $collection->paginate(request()->per_page ?? 15);
        }

        return $collection->get();
    }
}
