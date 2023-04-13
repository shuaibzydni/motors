<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use Facades\App\Services\BodyTypeService;
use App\Traits\HasApiResponse;

class BodyTypeController extends Controller
{
    use HasApiResponse;

    public function list()
    {
        return $this->apiSuccess(BodyTypeService::listFilter());
    }
}
