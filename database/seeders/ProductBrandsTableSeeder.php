<?php

namespace Database\Seeders;

use App\Models\ProductBrand;
use Illuminate\Database\Seeder;

class ProductBrandsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $brands = [
            "Acuro",
            "Alfa Romeo",
            "Aston Martin",
            "Audi",
            "Bently",
            "BMW",
            "Bugatti",
            "Buick",
            "Cadillac",
            "Chevrolet",
            "Chrysler",
            "Citroen",
            "Datsun",
            "Dodge",
            "Ferrari",
            "Fiat",
            "Ford",
            "Force Motors",
            "Geely",
            "Genesis",
            "GMC",
            "Honda",
            "Hyundai",
            "Infinity",
            "Isuzu",
            "Jaguar",
            "Jeep",
            "Kia",
            "Koenigsegg",
            "Lamborghini",
            "Lancia",
            "Land Rover",
            "Lexus",
            "Lincoln",
            "Lotus",
            "Mahindra",
            "Maserati",
            "Maybach",
            "Mazda",
            "McLaren",
            "Mercedes",
            "MG",
            "Mini",
            "Mitsubishi",
            "Nissan",
            "Opel",
            "Pagani",
            "Peugeot",
            "Pontiac",
            "Porsche",
            "Ram",
            "Renault",
            "Rolls-Royce",
            "Skoda",
            "Smart",
            "Subaru",
            "Suzuki",
            "Tata",
            "Tesla",
            "Toyota",
            "Volkswagen",
            "Volvo",
            "Others"
        ];

        foreach ($brands as $brand) {
            ProductBrand::create([
                "name" => $brand,
            ]);
        }
    }
}
