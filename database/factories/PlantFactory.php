<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Plant;
use App\Models\Product;
use App\Models\Team;

class PlantFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Plant::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'team_id' => Team::factory(),
            'product_id' => Product::factory(),
            'scientific_name' => $this->faker->word,
            'common_name' => $this->faker->word,
            'zone' => $this->faker->word,
            'height' => $this->faker->numberBetween(-10000, 10000),
            'spread' => $this->faker->numberBetween(-10000, 10000),
            'bloom_color' => $this->faker->regexify('[A-Za-z0-9]{50}'),
            'fall_color' => $this->faker->regexify('[A-Za-z0-9]{50}'),
            'growth_rate' => $this->faker->regexify('[A-Za-z0-9]{50}'),
        ];
    }
}
