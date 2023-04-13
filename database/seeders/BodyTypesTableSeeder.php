<?php

namespace Database\Seeders;

use App\Models\BodyType;
use Illuminate\Database\Seeder;

class BodyTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $bodyTypes = [
            "SUV",
            "Hatchback",
            "Sedan",
            "CompactSedan",
            "Coupe",
            "Convertible",
            "Minivan",
            "StationWagon",
            "Truck",
        ];

        foreach ($bodyTypes as $bodyType) {
            BodyType::create([
                "title" => $bodyType,
            ]);
        }
    }
}
