<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProductBrand extends Model
{
    use HasFactory;

    protected $fillable = ["name"];

    public function makes(): HasMany
    {
        return $this->hasMany(ProductMake::class);
    }
}
