<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Contact;
use App\Models\Customer;
use App\Models\Team;

class ContactFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Contact::class;

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
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'email' => $this->faker->safeEmail,
            'phone_1' => $this->faker->regexify('[A-Za-z0-9]{20}'),
            'phone_2' => $this->faker->regexify('[A-Za-z0-9]{20}'),
            'cell_phone' => $this->faker->regexify('[A-Za-z0-9]{20}'),
            'fax' => $this->faker->regexify('[A-Za-z0-9]{20}'),
            'notes' => $this->faker->regexify('[A-Za-z0-9]{8000}'),
        ];
    }
}
