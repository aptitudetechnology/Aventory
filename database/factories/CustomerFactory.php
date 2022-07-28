<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\Team;
use Illuminate\Database\Eloquent\Factories\Factory;

class CustomerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Customer::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'team_id' => Team::factory(),
            'name' => $this->faker->name(),
            'address' => $this->faker->address(),
            'city' => $this->faker->city(),
            'state' => $this->faker->word(),
            'zip' => $this->faker->postcode(),
            'mailing_same_as_primary' => $this->faker->boolean(),
            'is_taxable' => $this->faker->boolean(),
            'tax_percentage' => $this->faker->randomFloat(2, 0, 100),
            'reseller_permit_on_file' => $this->faker->boolean(),
            'reseller_permit_expiration' => $this->faker->date(),
            'discount_percentage' => $this->faker->randomNumber(2),
        ];
    }
}
