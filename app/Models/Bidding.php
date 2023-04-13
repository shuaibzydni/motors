<?php

namespace App\Models;

use App\Models\Views\ProductView;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bidding extends Model
{
    const BIDDING_TYPE = [
        "LIVE" => "live",
        "ACCEPTED" => "accepted",
        "SOLD" => "sold",
    ];

    const BID_STATUS = [
        "REQUESTED" => "requested",
        "ACCEPTED" => "accepted",
        "SOLD" => "sold",
        "DECLINED" => "declined",
    ];

    protected $fillable = [
        'product_id',
        'buyer_id',
        'seller_id',
        'description',
        'bidding_type',
        'bid_price'
    ];

    protected $appends = ['published_at'];

    public function getPublishedAtAttribute()
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $this->created_at)->format('d-m-Y');
    }

    public function scopeDesc($query)
    {
        return $query->orderBy('id', 'DESC');
    }

    public function product()
    {
        return $this->belongsTo(ProductView::class);
    }

    public function seller()
    {
        return $this->belongsTo(Seller::class);
    }

    public function buyer()
    {
        return $this->belongsTo(Buyer::class);
    }
}
