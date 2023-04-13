<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use Facades\App\Services\TransmissionService;
use App\Traits\HasApiResponse;

class TransmissionController extends Controller
{
    use HasApiResponse;

    public function list()
    {
        return $this->apiSuccess(TransmissionService::listFilter());
    }
}
