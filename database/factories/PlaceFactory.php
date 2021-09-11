<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Block;
use App\Models\Place;

class PlaceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Place::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'block_id' => Block::factory(),
            'row_number' => $this->faker->numberBetween(-10000, 10000),
            'plant_number' => $this->faker->numberBetween(-10000, 10000),
        ];
    }
}
