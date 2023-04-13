<?php

namespace Database\Seeders;

use App\Models\Transmission;
use Illuminate\Database\Seeder;

class TransmissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $transmissions = ["Manual", "Automatic", "AMT"];

        foreach ($transmissions as $transmission) {
            Transmission::create([
                "title" => $transmission,
            ]);
        }
    }
}
