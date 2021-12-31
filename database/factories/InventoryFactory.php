<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Block;
use App\Models\Inventory;
use App\Models\PurchaseItem;
use App\Models\Place;
use App\Models\Product;
use App\Models\Size;

class InventoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Inventory::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'purchase_item_id' => PurchaseItem::factory(),
            'product_id' => Product::factory(),
            'original_size_id' => Size::factory(),
            'size_id' => Size::factory(),
            'quantity' => $this->faker->numberBetween(-10000, 10000),
            'type' => $this->faker->randomElement(["group", "individual"]),
            'block_id' => Block::factory(),
            'place_id' => Place::factory(),
        ];
    }
}
