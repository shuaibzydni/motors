<?php

namespace App\Services;

use App\Models\Buyer;
use App\Models\SiteSetting;
use Illuminate\Support\Facades\Cache;

class BuyerService
{
    public function cacheBuyerCount()
    {
        Cache::forget("buyer_count");
        Cache::rememberForever("buyer_count", function () {
            return Buyer::count();
        });
    }

    public function cacheBuyerSettings()
    {
        Cache::forget("buyerSettings");
        Cache::rememberForever("buyerSettings", function () {
            $siteSettings = SiteSetting::where('type', 'buyer')->get();
            return $siteSettings->mapWithKeys(function ($setting) {
                return [
                    $setting->slug => $setting->data
                ];
            });
        });
    }
}
