<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\Order;
use App\Models\Team;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Order::class;

    public function configure()
    {
        return $this->afterMaking(function (Order $order) {
            $order->items()->saveMany(OrderItemFactory::times(3)->make());
        });
    }
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
        ];
    }

    public function withInventory()
    {
        return $this->afterMaking(function (Order $order) {
            $order->items()->saveMany(OrderItemFactory::withInventory()->times(3)->make());
        });
    }
}
