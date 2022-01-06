<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Purchase;
use App\Models\Team;
use App\Models\User;
use App\Models\Vendor;

class PurchaseFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Purchase::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'date' => $this->faker->date(),
            'vendor_id' => Vendor::factory(),
            'user_id' => User::factory(),
            'team_id' => Team::factory(),
            'order_number' => $this->faker->word,
        ];
    }
}
