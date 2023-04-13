<?php

namespace App\Models\Views;

use App\Models\Bidding;
use App\Models\Buyer;
use App\Models\Seller;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class ProductView extends Model
{
    protected $appends = ['published_at', 'bid_count', 'buyer'];

    protected $casts = [
        "seller_id" => "integer",
        "product_brand_id" => "integer",
        "product_make_id" => "integer",
        "body_type_id" => "integer",
        "drive_type_id" => "integer",
        "fuel_type_id" => "integer",
        "transmission_id" => "integer",
    ];

    public function getPublishedAtAttribute()
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $this->created_at)->format('d-m-Y');
    }

    public function getBidCountAttribute()
    {
        return $this->biddings()->count();
    }

    public function getServiceLogBookAttribute($value)
    {
        if ($value) {
            return Storage::disk("products")->url($value);
        }

        return null;
    }

    public function getFrontImageAttribute($value)
    {
        if ($value) {
            return Storage::disk("products")->url($value);
        }

        return null;
    }

    public function getRearImageAttribute($value)
    {
        if ($value) {
            return Storage::disk("products")->url($value);
        }

        return null;
    }

    public function getLeftSideImageAttribute($value)
    {
        if ($value) {
            return Storage::disk("products")->url($value);
        }

        return null;
    }

    public function getInteriorImageAttribute($value)
    {
        if ($value) {
            return Storage::disk("products")->url($value);
        }

        return null;
    }

    public function getCargoAreaImageAttribute($value)
    {
        if ($value) {
            return Storage::disk("products")->url($value);
        }

        return null;
    }

    public function getEngineBayImageAttribute($value)
    {
        if ($value) {
            return Storage::disk("products")->url($value);
        }

        return null;
    }

    public function getRoofImageAttribute($value)
    {
        if ($value) {
            return Storage::disk("products")->url($value);
        }

        return null;
    }

    public function getWheelsImageAttribute($value)
    {
        if ($value) {
            return Storage::disk("products")->url($value);
        }

        return null;
    }

    public function getKeysImageAttribute($value)
    {
        if ($value) {
            return Storage::disk("products")->url($value);
        }

        return null;
    }

    public function getOwnersManualAttribute($value)
    {
        if ($value) {
            return Storage::disk("products")->url($value);
        }

        return null;
    }

    public function seller()
    {
        return $this->belongsTo(Seller::class);
    }

    public function biddings()
    {
        return $this->hasMany(Bidding::class, 'product_id');
    }

    public function getBuyerAttribute()
    {
        $bidding = Bidding::where('product_id', $this->id)->where(function ($query) {
            $query->where('bidding_type', Bidding::BIDDING_TYPE['ACCEPTED'])
                ->orWhere('bidding_type', Bidding::BIDDING_TYPE['SOLD']);
        })->first();
        if ($bidding) {
            return Buyer::find($bidding->buyer_id);
        } else {
            return null;
        }
    }
}
