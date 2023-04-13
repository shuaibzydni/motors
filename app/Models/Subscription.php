<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    protected $fillable = [
        'transaction_id',
        'stripe_status',
        'stripe_price',
        'quantity',
        'ends_at',
        'stripe_data',
        'plan_data'
    ];

    protected $casts = [
        'ends_at' => 'datetime',
        'quantity' => 'integer',
        'plan_data' => 'array',
    ];

    public function usertable()
    {
        return $this->morphTo();
    }
}
