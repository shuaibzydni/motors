<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use Facades\App\Services\DriveTypeService;
use App\Traits\HasApiResponse;

class DriveTypeController extends Controller
{
    use HasApiResponse;

    public function list()
    {
        return $this->apiSuccess(DriveTypeService::listFilter());
    }
}
