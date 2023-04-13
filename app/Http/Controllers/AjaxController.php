<?php

namespace App\Http\Controllers;

use App\Models\ProductMake;

class AjaxController extends Controller
{
    public function getModelByBrand()
    {
        $makes = ProductMake::where('product_brand_id', request()->brand_id)->get();

        $others = ProductMake::where('name', 'Others')->where('product_brand_id', null)->get();

        $makes = $makes->merge($others);

        return response()->json($makes);
    }
}
