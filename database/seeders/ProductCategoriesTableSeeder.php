<?php

namespace Database\Seeders;

use App\Models\ProductCategory;
use Illuminate\Database\Seeder;

class ProductCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = ["Car", "Bike", "Truck"];

        foreach ($categories as $category) {
            ProductCategory::create([
                "name" => $category,
            ]);
        }
    }
}
