<?php

namespace Database\Seeders;

use App\Services\BuyerService;
use App\Services\SellerService;
use App\Services\FaqService;
use App\Services\SocialLinkService;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    protected $faqService, $socialLinkService;

    public function __construct()
    {
        $this->buyerService = new BuyerService;
        $this->sellerService = new SellerService();
        $this->faqService = new FaqService();
        $this->socialLinkService = new SocialLinkService();
    }

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CountriesTableSeeder::class);
        $this->call(StatesTableSeeder::class);
        $this->call(CitiesTableSeeder::class);
        $this->call(UsersTableSeeder::class);

        $this->call(ProductCategoriesTableSeeder::class);
        $this->call(ProductBrandsTableSeeder::class);
        $this->call(BodyTypesTableSeeder::class);
        $this->call(DriveTypesTableSeeder::class);
        $this->call(FuelTypesTableSeeder::class);
        $this->call(TransmissionsTableSeeder::class);

        $this->call(SiteSettingsTableSeeder::class);
        $this->call(FaqsTableSeeder::class);
        $this->call(SocialLinksTableSeeder::class);

        $this->faqService->cacheBuyerFaq();
        $this->faqService->cacheSellerFaq();
        $this->socialLinkService->cacheSocialLinks();
    }
}
