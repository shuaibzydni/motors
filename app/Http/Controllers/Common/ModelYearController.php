<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use App\Traits\HasApiResponse;
use Illuminate\Http\Request;

class ModelYearController extends Controller
{
    use HasApiResponse;

    public function list()
    {
        $years = [];

        for ($startYear = 1901; $startYear <= date("Y"); $startYear++) {
            $years[] = $startYear;
        }

        $years = array_reverse($years);

        return $this->apiSuccess($years);
    }
}
