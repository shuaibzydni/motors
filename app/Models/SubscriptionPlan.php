<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class SubscriptionPlan extends Model
{
    use HasSlug;

    const PLAN_TYPE = [
        'WEEK' => 'week',
        'MONTH' => 'month',
        'ANNUAL' => 'annual',
    ];

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    protected $fillable = [
        'name',
        'slug',
        'stripe_plan',
        'cost',
        'description',
        'model',
        'limit',
        'type',
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function features()
    {
        return $this->hasMany(SubscriptionPlanFeatures::class);
    }
}
