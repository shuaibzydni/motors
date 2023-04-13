<?php

namespace App\Services;

use App\Models\SubscriptionPlan;

class SubscriptionPlanService
{
    public function listFilter($model)
    {
        return SubscriptionPlan::where('model', $model)->get();
    }
}
