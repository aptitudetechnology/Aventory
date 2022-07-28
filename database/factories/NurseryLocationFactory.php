<?php

namespace Database\Factories;

use App\Models\NurseryLocation;
use Illuminate\Database\Eloquent\Factories\Factory;

class NurseryLocationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = NurseryLocation::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'address' => $this->faker->word,
            'city' => $this->faker->city,
            'state' => $this->faker->word,
        ];
    }
}
