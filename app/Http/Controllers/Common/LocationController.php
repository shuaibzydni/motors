<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use App\Models\Location;
use App\Models\State;
use App\Traits\HasApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class LocationController extends Controller
{
    use HasApiResponse;

    public function locations()
    {
        $locations = Location::get();

        return $this->apiSuccess($locations);
    }
}
