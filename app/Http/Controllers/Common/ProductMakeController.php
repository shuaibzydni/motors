<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use Facades\App\Services\ProductMakeService;
use App\Traits\HasApiResponse;

class ProductMakeController extends Controller
{
    use HasApiResponse;

    public function list()
    {
        return $this->apiSuccess(ProductMakeService::listFilter());
    }
}
