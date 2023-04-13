<?php

namespace App\Services;

use App\Models\Seller;
use App\Models\SiteSetting;
use Illuminate\Support\Facades\Cache;

class SellerService
{
    public function cacheSellerCount()
    {
        Cache::forget("seller_count");
        Cache::rememberForever("seller_count", function () {
            return Seller::count();
        });
    }

    public function cacheSellerSettings()
    {
        Cache::forget("sellerSettings");
        Cache::rememberForever("sellerSettings", function () {
            $siteSettings = SiteSetting::where('type', 'seller')->get();
            return $siteSettings->mapWithKeys(function ($setting) {
                return [
                    $setting->slug => $setting->data
                ];
            });
        });
    }
}
