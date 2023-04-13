<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use Facades\App\Services\FuelTypeService;
use App\Traits\HasApiResponse;

class FuelTypeController extends Controller
{
    use HasApiResponse;

    public function list()
    {
        return $this->apiSuccess(FuelTypeService::listFilter());
    }
}
