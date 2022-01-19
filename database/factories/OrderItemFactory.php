<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Size;


class OrderItemFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = OrderItem::class;


    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'order_id' => Order::factory(),
            'product_id' => Product::factory(),
            'size_id' => Size::factory(),
            'quantity' => $this->faker->randomDigit,
            'unit_price' => $this->faker->randomFloat(2, 0, 100),
            'no_discount' => $this->faker->boolean,
        ];
    }
}
