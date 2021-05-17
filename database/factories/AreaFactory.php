<?php

namespace Database\Factories;

use App\Models\Area;
use Illuminate\Database\Eloquent\Factories\Factory;

class AreaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Area::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            // no faker correspondance to 'area' use 'citySuffix' instead 
            'name' => $this->faker->citySuffix,
            'city_id' => $this->faker->numberBetween($min = 1, $max = 10),
        ];
    }
}
