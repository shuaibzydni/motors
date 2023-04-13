<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    use HasFactory;

    const VEHICLE_STATUS = [
        "AVAILABLE" => "available",
        "UNAVAILABLE" => "unavailable",
        "SOLD" => "sold",
    ];

    protected $hidden = ["seller_id"];

    protected $fillable = [
        "seller_id",
        "advertisement_id",
        "product_brand_id",
        "product_make_id",
        "body_type_id",
        "drive_type_id",
        "fuel_type_id",
        "transmission_id",
        "name",
        "model_year",
        "model_description",
        "odometer_mileage",
        "vehicle_registration_number",
        "vehicle_vin",
        "vehicle_price",
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
        "vehicle_status",
    ];

    protected $appends = ['published_at'];

    public function seller()
    {
        return $this->belongsTo(Seller::class);
    }

    public function brand()
    {
        return $this->belongsTo(ProductBrand::class);
    }

    public function model()
    {
        return $this->belongsTo(ProductMake::class);
    }

    public function bodyType()
    {
        return $this->belongsTo(BodyType::class);
    }

    public function driveType()
    {
        return $this->belongsTo(DriveType::class);
    }

    public function fuelType()
    {
        return $this->belongsTo(FuelType::class);
    }

    public function transmission()
    {
        return $this->belongsTo(Transmission::class);
    }

    public function getPublishedAtAttribute()
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $this->created_at)->format('d-m-Y');
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

    public function biddings()
    {
        return $this->hasMany(Bidding::class);
    }
}
