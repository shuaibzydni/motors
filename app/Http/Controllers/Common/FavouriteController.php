<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use App\Models\Buyer;
use App\Traits\HasApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavouriteController extends Controller
{
    use HasApiResponse;

    public function addFavourite($productId)
    {
        $buyerId = Auth::guard('buyers_web')->user()->id;
        $buyer = Buyer::findOrFail($buyerId);
        if (request()->type === 'add') {
            $buyer->favourites()->attach([$productId]);
        } else {
            $buyer->favourites()->detach([$productId]);
        }

        return $this->apiCreated(true);
    }

    public function apiFavourites()
    {
        $buyerId = request()->user()->id;
        $buyer = Buyer::findOrFail($buyerId);
        $favourites = $buyer->favourites()->paginate();

        return $this->apiSuccess($favourites);
    }

    public function apiUpdateFavourite($productId)
    {
        $buyerId = request()->user()->id;
        $buyer = Buyer::findOrFail($buyerId);
        if (request()->type === 'add') {
            $buyer->favourites()->attach([$productId]);
        } else {
            $buyer->favourites()->detach([$productId]);
        }

        return $this->apiCreated(true);
    }
}
