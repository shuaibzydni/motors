<?php

namespace App\Services;

use App\Models\SocialLink;
use Illuminate\Support\Facades\Cache;

class SocialLinkService
{
    public function cacheSocialLinks()
    {
        Cache::forget("social_links");
        Cache::rememberForever("social_links", function () {
            return SocialLink::get();
        });
    }
}
