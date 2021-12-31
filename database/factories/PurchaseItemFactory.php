<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Purchase;
use App\Models\PurchaseItem;
use App\Models\Product;
use App\Models\Size;

class PurchaseItemFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PurchaseItem::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'purchase_id' => Purchase::factory(),
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
