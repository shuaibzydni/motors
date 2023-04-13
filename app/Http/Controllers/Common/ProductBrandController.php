<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use Facades\App\Services\ProductBrandService;
use App\Traits\HasApiResponse;

class ProductBrandController extends Controller
{
    use HasApiResponse;

    public function list()
    {
        return $this->apiSuccess(ProductBrandService::listFilter());
    }
}
