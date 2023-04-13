<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    use HasFactory;

    const IMAGE_TYPE = [
        "INTERIOR" => "interior",
        "EXTERIOR" => "exterior",
        "LISTING" => "listing",
    ];

    protected $fillable = ["product_id", "image_path", "image_type"];
}
