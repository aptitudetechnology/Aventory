<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\Quote;
use App\Models\Team;
use Illuminate\Database\Eloquent\Factories\Factory;

class QuoteFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Quote::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'team_id' => Team::factory(),
            'customer_id' => Customer::factory(),
            'date' => $this->faker->date(),
            'quote_expires' => $this->faker->date(),
            'hold_inventory'    => $this->faker->boolean,
        ];
    }
}
