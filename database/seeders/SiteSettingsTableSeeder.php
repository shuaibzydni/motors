<?php

namespace Database\Seeders;

use App\Services\BuyerService;
use App\Services\SellerService;
use App\Models\SiteSetting;
use Illuminate\Database\Seeder;

class SiteSettingsTableSeeder extends Seeder
{

    protected $buyerService, $sellerService;

    public function __construct()
    {
        $this->buyerService = new BuyerService;
        $this->sellerService = new SellerService();
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $buyerSiteSettings = [
            'siteName' => 'Motor Traders Buyer',
            'siteDescription' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Vitae soluta, dignissimos aut, assumenda dolore totam natus qui cum vel omnis voluptates.',
            'siteEmail' => 'buyer@motortraders.com',
            'sitePhone' => '+1 9056 70 6665',
            'appGooglePlay' => 'https://play.google.com/',
            'appAppStore' => 'https://www.apple.com/in/app-store/',
            'aboutUs' => 'About Us',
            'contactUs' => 'Contact Us',
            'terms' => 'Terms and Conditions',

            'homePageTitle' => 'BUY WITH CONFIDENT',
            'homePageSubTitle' => 'Procure repossessed, exchange, premium and salvage vehicles by participating in Online and Offline Auctions',

            'topRecommendationHeader' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
            'howItWorkHeader' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',

            'hitw_first_q' => 'Choose Location',
            'hitw_second_q' => 'Find Your Perfect Car',
            'hitw_third_q' => 'Bid Your Request',

            'hitw_first_a' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Vitae soluta, dignissimos aut, assumenda dolore totam natus qui cum.',
            'hitw_second_a' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Vitae soluta, dignissimos aut, assumenda dolore totam natus qui cum.',
            'hitw_third_a' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Vitae soluta, dignissimos aut, assumenda dolore totam natus qui cum.',
        ];

        $sellerSiteSettings = [
            'siteName' => 'Motor Traders Seller',
            'siteDescription' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Vitae soluta, dignissimos aut, assumenda dolore totam natus qui cum vel omnis voluptates.',
            'siteEmail' => 'seller@motortraders.com',
            'sitePhone' => '+1 9056 70 6666',
            'appGooglePlay' => 'https://play.google.com/',
            'appAppStore' => 'https://www.apple.com/in/app-store/',
            'aboutUs' => 'About Us',
            'contactUs' => 'Contact Us',
            'terms' => 'Terms and Conditions',

            'homePageTitle' => 'Sell your car to the Best Quality Buyers With us',
            'homePageSubTitle' => 'Procure repossessed, exchange, premium and salvage vehicles by participating in Online and Offline Auctions',

            'topRecommendationHeader' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
            'howItWorkHeader' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',

            'hitw_first_q' => 'Post your Vehicle with Full Details',
            'hitw_second_q' => 'Speedy and easy car selling process',
            'hitw_third_q' => 'Get Buyers Detail via SMS, Email and Notifications',

            'hitw_first_a' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Vitae soluta, dignissimos aut, assumenda dolore totam natus qui cum.',
            'hitw_second_a' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Vitae soluta, dignissimos aut, assumenda dolore totam natus qui cum.',
            'hitw_third_a' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Vitae soluta, dignissimos aut, assumenda dolore totam natus qui cum.',
        ];

        foreach ($buyerSiteSettings as $key => $setting) {
            SiteSetting::create([
                'type' => 'buyer',
                'slug' => $key,
                'data' => $setting
            ]);
        }

        foreach ($sellerSiteSettings as $key => $setting) {
            SiteSetting::create([
                'type' => 'seller',
                'slug' => $key,
                'data' => $setting
            ]);
        }

        $this->buyerService->cacheBuyerCount();
        $this->buyerService->cacheBuyerSettings();
        $this->sellerService->cacheSellerCount();
        $this->sellerService->cacheSellerSettings();
    }
}
