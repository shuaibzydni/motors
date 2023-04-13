<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubscriptionPlanFeatures extends Model
{
    use HasFactory;

    protected $fillable = ["subscription_plan_id", "features"];
}
