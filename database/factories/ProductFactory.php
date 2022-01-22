<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Category;
use App\Models\Product;
use App\Models\Team;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'team_id' => Team::factory(),
            'category_id' => Category::factory(),
            'name' => $this->faker->name(),
            'type' => $this->faker->randomElement(["plant", "inventory", "non-inventory", "service"]),
            'description' => $this->faker->text(),
        ];
    }
}
