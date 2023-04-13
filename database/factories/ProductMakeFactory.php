<?php

namespace Database\Factories;

use App\Models\ProductMake;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductMakeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ProductMake::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $this->faker->addProvider(new \Faker\Provider\Fakecar($this->faker));

        return [
            "name" => $this->faker->vehicleType(),
        ];
    }
}
