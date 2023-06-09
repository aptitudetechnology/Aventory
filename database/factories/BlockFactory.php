<?php

namespace Database\Factories;

use App\Models\Block;
use App\Models\NurseryLocation;
use Illuminate\Database\Eloquent\Factories\Factory;

class BlockFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Block::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'nursery_location_id' => NurseryLocation::factory(),
            'has_places' => $this->faker->boolean(),
        ];
    }
}
