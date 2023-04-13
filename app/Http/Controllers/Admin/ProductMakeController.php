<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProductMakeRequest;
use App\Models\ProductBrand;
use App\Models\ProductMake;
use Illuminate\Support\Facades\DB;

class ProductMakeController extends Controller
{
    public function index()
    {
        $productMakes = ProductMake::with('brand');

        if (request()->has('search') && request()->search) {
            $productMakes = $productMakes->where(DB::raw('lower(name)'), 'LIKE', '%' . strtolower(request()->search) . '%');
        }

        if (request()->has('brand_id') && request()->brand_id) {
            $productMakes = $productMakes->where('product_brand_id', request()->brand_id);
        }

        $productMakes = $productMakes->latest()->paginate(
            config("motorTraders.paginate.perPage")
        );

        $brands = ProductBrand::get();

        return view("product_makes.index", compact("productMakes", "brands"));
    }

    public function create()
    {
        $brands = ProductBrand::orderBy('name', 'asc')->get();
        return view("product_makes.create", compact("brands"));
    }

    public function store(ProductMakeRequest $request)
    {
        ProductMake::create($request->validated());

        return redirect()
            ->route("productMakes.index")
            ->with("success", "Model created successfully.");
    }

    public function edit(ProductMake $productMake)
    {
        $brands = ProductBrand::orderBy('name', 'asc')->get();
        return view("product_makes.edit", compact("productMake", "brands"));
    }

    public function update(ProductMakeRequest $request, ProductMake $productMake)
    {
        $productMake->update($request->validated());

        return redirect()
            ->route("productMakes.index")
            ->with("success", "Model updated successfully");
    }

    public function destroy(ProductMake $productMake)
    {
        // if ($productMake->name === "Others") {
        //     return redirect()
        //         ->back()
        //         ->with("danger", "Others cannot be deleted");
        // }
        $productMake->delete();
        return redirect()
            ->route("productMakes.index")
            ->with("success", "Model deleted successfully");
    }
}
