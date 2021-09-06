<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
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
            'unit_price' => $this->faker->randomFloat(0, 0, 9999999999.),
            'quantity_ordered' => $this->faker->numberBetween(-10000, 10000),
            'quantity_confirmed' => $this->faker->numberBetween(-10000, 10000),
            'received' => $this->faker->boolean,
            'printed' => $this->faker->boolean,
        ];
    }
}
