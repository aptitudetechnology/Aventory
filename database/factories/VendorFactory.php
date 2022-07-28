<?php

namespace Database\Factories;

use App\Models\Team;
use App\Models\Vendor;
use Illuminate\Database\Eloquent\Factories\Factory;

class VendorFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Vendor::class;

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
            'vendor_code' => $this->faker->regexify('[A-Za-z0-9]{50}'),
            'address' => $this->faker->word,
            'city' => $this->faker->city,
            'state' => $this->faker->regexify('[A-Za-z0-9]{50}'),
            'zip' => $this->faker->postcode,
            'mailing_same_as_primary' => $this->faker->boolean(),
            'mailing_address' => $this->faker->word,
            'mailing_city' => $this->faker->regexify('[A-Za-z0-9]{50}'),
            'mailing_state' => $this->faker->regexify('[A-Za-z0-9]{50}'),
            'mailing_zip' => $this->faker->regexify('[A-Za-z0-9]{20}'),
            'notes' => $this->faker->regexify('[A-Za-z0-9]{8000}'),
            'use_for_block_transfers' => $this->faker->boolean(),
        ];
    }
}
