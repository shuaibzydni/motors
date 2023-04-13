<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Bidding;
use App\Models\Favourite;
use App\Models\Views\ProductView;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VehicleController extends Controller
{
    protected $fileTypes = [
        "service_log_book",
        "front_image",
        "rear_image",
        "left_side_image",
        "interior_image",
        "cargo_area_image",
        "engine_bay_image",
        "roof_image",
        "wheels_image",
        "keys_image",
        "owners_manual",
    ];

    public function index()
    {
        $vehicles = ProductView::orderBy('id', 'desc')->paginate();
        return view('vehicles.index', compact('vehicles'));
    }

    public function show($id)
    {
        $vehicle = ProductView::with(['seller' => function($query) {
            $query->with('location');
        }])->findOrFail($id);
        return view('vehicles.show', compact('vehicle'));
    }

    public function delete($id)
    {
        $favourites = Favourite::where('product_id', $id)->get();
        if(count($favourites) > 0) {
            foreach ($favourites as $favourite) {
                $favourite->delete();
            }
        }

        $product = Product::findOrFail($id);
        if ($product->vehicle_status === 'sold') {
            return redirect()->back()->with("warning", "Sold Vehicle cannot be delete");
        }

        foreach ($this->fileTypes as $fileType) {
            if ($product->{$fileType}) {
                Storage::disk("products")->delete($product->{$fileType});
            }
        }
        
        $biddings = Bidding::where('product_id', $product->id)->get();
        if(count($biddings) > 0) {
            foreach ($biddings as $bidding) {
                $bidding->delete();
            }
        }

        $product->delete();
        return redirect()->route("vehicle.index")->with("success", "Vehicle deleted successfully");
    }
}
