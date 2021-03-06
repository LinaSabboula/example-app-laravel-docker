<?php

namespace Database\Factories;

use App\Models\Address;
use Illuminate\Database\Eloquent\Factories\Factory;

class AddressFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Address::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'street' => $this->faker->streetName,
            'building' => strval($this->faker->buildingNumber),
            'floor_number' => $this->faker->randomDigit,
            'apartment_number' => $this->faker->randomDigit,
            'user_id' => $this->faker->numberBetween($min = 1, $max = 15),
            'area_id' => $this->faker->numberBetween($min = 1, $max = 20),
        ];
    }
}
