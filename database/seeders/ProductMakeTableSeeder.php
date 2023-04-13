<?php

namespace Database\Seeders;

use App\Models\ProductMake;
use Illuminate\Database\Seeder;

class ProductMakeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProductMake::create([
            "name" => "Others"
        ]);
    }
}
