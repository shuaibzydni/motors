<?php

namespace Database\Seeders;

use App\Models\DriveType;
use Illuminate\Database\Seeder;

class DriveTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $driveTypes = [
            "Front Wheel Drive - FWD",
            "Rear Wheel Drive - RWD",
            "Four Wheel Drive - 4WD",
        ];

        foreach ($driveTypes as $driveType) {
            DriveType::create([
                "title" => $driveType,
            ]);
        }
    }
}
