<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use Facades\App\Services\ProductCategoryService;
use App\Traits\HasApiResponse;

class ProductCategoryController extends Controller
{
    use HasApiResponse;

    public function list()
    {
        return $this->apiSuccess(ProductCategoryService::listFilter());
    }
}
