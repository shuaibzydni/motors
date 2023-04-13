<?php

namespace Database\Seeders;

use App\Models\FuelType;
use Illuminate\Database\Seeder;

class FuelTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $fuelTypes = [
            "Petrol",
            "Diesel",
            "CNG",
            "Electric",
            "Hybrid (Electric + Petrol)",
        ];

        foreach ($fuelTypes as $fuelType) {
            FuelType::create([
                "name" => $fuelType,
            ]);
        }
    }
}
