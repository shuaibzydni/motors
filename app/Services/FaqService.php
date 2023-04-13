<?php

namespace App\Services;

use App\Models\Faq;
use Illuminate\Support\Facades\Cache;

class FaqService
{
    public function cacheSellerFaq()
    {
        Cache::forget("seller_faq");
        Cache::rememberForever("seller_faq", function () {
            return Faq::where('type', 'seller')->get();
        });
    }

    public function cacheBuyerFaq()
    {
        Cache::forget("buyer_faq");
        Cache::rememberForever("buyer_faq", function () {
            return Faq::where('type', 'buyer')->get();
        });
    }
}
