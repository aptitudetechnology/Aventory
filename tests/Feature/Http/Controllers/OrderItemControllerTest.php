<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Purchase;
use App\Models\PurchaseItem;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\PurchaseItemController
 */
class PurchaseItemControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $purchaseItems = PurchaseItem::factory()->count(3)->create();

        $response = $this->get(route('purchase-item.index'));

        $response->assertOk();
        $response->assertViewIs('purchaseItem.index');
        $response->assertViewHas('purchaseItems');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('purchase-item.create'));

        $response->assertOk();
        $response->assertViewIs('purchaseItem.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\PurchaseItemController::class,
            'store',
            \App\Http\Requests\PurchaseItemStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $purchase = Purchase::factory()->create();
        $product = Product::factory()->create();
        $unit_price = $this->faker->randomFloat(
            /** double_attributes **/
        );
        $quantity_purchaseed = $this->faker->numberBetween(-10000, 10000);
        $quantity_confirmed = $this->faker->numberBetween(-10000, 10000);
        $received = $this->faker->boolean;
        $printed = $this->faker->boolean;

        $response = $this->post(route('purchase-item.store'), [
            'order_id' => $purchase->id,
            'product_id' => $product->id,
            'unit_price' => $unit_price,
            'quantity_ordered' => $quantity_ordered,
            'quantity_confirmed' => $quantity_confirmed,
            'received' => $received,
            'printed' => $printed,
        ]);

        $purchaseItems = PurchaseItem::query()
            ->where('purchase_id', $purchase->id)
            ->where('product_id', $product->id)
            ->where('unit_price', $unit_price)
            ->where('quantity_ordered', $quantity_ordered)
            ->where('quantity_confirmed', $quantity_confirmed)
            ->where('received', $received)
            ->where('printed', $printed)
            ->get();
        $this->assertCount(1, $purchaseItems);
        $purchaseItem = $purchaseItems->first();

        $response->assertRedirect(route('purchaseItem.index'));
        $response->assertSessionHas('purchaseItem.id', $purchaseItem->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $purchaseItem = PurchaseItem::factory()->create();

        $response = $this->get(route('purchase-item.show', $purchaseItem));

        $response->assertOk();
        $response->assertViewIs('purchaseItem.show');
        $response->assertViewHas('purchaseItem');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $purchaseItem = PurchaseItem::factory()->create();

        $response = $this->get(route('purchase-item.edit', $purchaseItem));

        $response->assertOk();
        $response->assertViewIs('purchaseItem.edit');
        $response->assertViewHas('purchaseItem');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\PurchaseItemController::class,
            'update',
            \App\Http\Requests\PurchaseItemUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $purchaseItem = PurchaseItem::factory()->create();
        $purchase = Purchase::factory()->create();
        $product = Product::factory()->create();
        $unit_price = $this->faker->randomFloat(
            /** double_attributes **/
        );
        $quantity_ordered = $this->faker->numberBetween(-10000, 10000);
        $quantity_confirmed = $this->faker->numberBetween(-10000, 10000);
        $received = $this->faker->boolean;
        $printed = $this->faker->boolean;

        $response = $this->put(route('purchase-item.update', $purchaseItem), [
            'purchase_id' => $purchase->id,
            'product_id' => $product->id,
            'unit_price' => $unit_price,
            'quantity_ordered' => $quantity_ordered,
            'quantity_confirmed' => $quantity_confirmed,
            'received' => $received,
            'printed' => $printed,
        ]);

        $purchaseItem->refresh();

        $response->assertRedirect(route('purchaseItem.index'));
        $response->assertSessionHas('purchaseItem.id', $purchaseItem->id);

        $this->assertEquals($purchase->id, $purchaseItem->purchase_id);
        $this->assertEquals($product->id, $purchaseItem->product_id);
        $this->assertEquals($unit_price, $purchaseItem->unit_price);
        $this->assertEquals($quantity_ordered, $purchaseItem->quantity_ordered);
        $this->assertEquals($quantity_confirmed, $purchaseItem->quantity_confirmed);
        $this->assertEquals($received, $purchaseItem->received);
        $this->assertEquals($printed, $purchaseItem->printed);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $purchaseItem = PurchaseItem::factory()->create();

        $response = $this->delete(route('purchase-item.destroy', $purchaseItem));

        $response->assertRedirect(route('purchaseItem.index'));

        $this->assertDeleted($purchaseItem);
    }
}
