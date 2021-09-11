<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Inventory;
use App\Models\OrderItem;
use App\Models\OriginalSize;
use App\Models\Product;
use App\Models\Size;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\InventoryController
 */
class InventoryControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $inventories = Inventory::factory()->count(3)->create();

        $response = $this->get(route('inventory.index'));

        $response->assertOk();
        $response->assertViewIs('inventory.index');
        $response->assertViewHas('inventories');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('inventory.create'));

        $response->assertOk();
        $response->assertViewIs('inventory.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\InventoryController::class,
            'store',
            \App\Http\Requests\InventoryStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $order_item = OrderItem::factory()->create();
        $product = Product::factory()->create();
        $original_size = OriginalSize::factory()->create();
        $size = Size::factory()->create();
        $quantity = $this->faker->numberBetween(-10000, 10000);
        $type = $this->faker->randomElement(/** enum_attributes **/);

        $response = $this->post(route('inventory.store'), [
            'order_item_id' => $order_item->id,
            'product_id' => $product->id,
            'original_size_id' => $original_size->id,
            'size_id' => $size->id,
            'quantity' => $quantity,
            'type' => $type,
        ]);

        $inventories = Inventory::query()
            ->where('order_item_id', $order_item->id)
            ->where('product_id', $product->id)
            ->where('original_size_id', $original_size->id)
            ->where('size_id', $size->id)
            ->where('quantity', $quantity)
            ->where('type', $type)
            ->get();
        $this->assertCount(1, $inventories);
        $inventory = $inventories->first();

        $response->assertRedirect(route('inventory.index'));
        $response->assertSessionHas('inventory.id', $inventory->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $inventory = Inventory::factory()->create();

        $response = $this->get(route('inventory.show', $inventory));

        $response->assertOk();
        $response->assertViewIs('inventory.show');
        $response->assertViewHas('inventory');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $inventory = Inventory::factory()->create();

        $response = $this->get(route('inventory.edit', $inventory));

        $response->assertOk();
        $response->assertViewIs('inventory.edit');
        $response->assertViewHas('inventory');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\InventoryController::class,
            'update',
            \App\Http\Requests\InventoryUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $inventory = Inventory::factory()->create();
        $order_item = OrderItem::factory()->create();
        $product = Product::factory()->create();
        $original_size = OriginalSize::factory()->create();
        $size = Size::factory()->create();
        $quantity = $this->faker->numberBetween(-10000, 10000);
        $type = $this->faker->randomElement(/** enum_attributes **/);

        $response = $this->put(route('inventory.update', $inventory), [
            'order_item_id' => $order_item->id,
            'product_id' => $product->id,
            'original_size_id' => $original_size->id,
            'size_id' => $size->id,
            'quantity' => $quantity,
            'type' => $type,
        ]);

        $inventory->refresh();

        $response->assertRedirect(route('inventory.index'));
        $response->assertSessionHas('inventory.id', $inventory->id);

        $this->assertEquals($order_item->id, $inventory->order_item_id);
        $this->assertEquals($product->id, $inventory->product_id);
        $this->assertEquals($original_size->id, $inventory->original_size_id);
        $this->assertEquals($size->id, $inventory->size_id);
        $this->assertEquals($quantity, $inventory->quantity);
        $this->assertEquals($type, $inventory->type);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $inventory = Inventory::factory()->create();

        $response = $this->delete(route('inventory.destroy', $inventory));

        $response->assertRedirect(route('inventory.index'));

        $this->assertDeleted($inventory);
    }
}
