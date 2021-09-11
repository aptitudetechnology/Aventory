<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\OrderItemController
 */
class OrderItemControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $orderItems = OrderItem::factory()->count(3)->create();

        $response = $this->get(route('order-item.index'));

        $response->assertOk();
        $response->assertViewIs('orderItem.index');
        $response->assertViewHas('orderItems');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('order-item.create'));

        $response->assertOk();
        $response->assertViewIs('orderItem.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\OrderItemController::class,
            'store',
            \App\Http\Requests\OrderItemStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $order = Order::factory()->create();
        $product = Product::factory()->create();
        $unit_price = $this->faker->randomFloat(/** double_attributes **/);
        $quantity_ordered = $this->faker->numberBetween(-10000, 10000);
        $quantity_confirmed = $this->faker->numberBetween(-10000, 10000);
        $received = $this->faker->boolean;
        $printed = $this->faker->boolean;

        $response = $this->post(route('order-item.store'), [
            'order_id' => $order->id,
            'product_id' => $product->id,
            'unit_price' => $unit_price,
            'quantity_ordered' => $quantity_ordered,
            'quantity_confirmed' => $quantity_confirmed,
            'received' => $received,
            'printed' => $printed,
        ]);

        $orderItems = OrderItem::query()
            ->where('order_id', $order->id)
            ->where('product_id', $product->id)
            ->where('unit_price', $unit_price)
            ->where('quantity_ordered', $quantity_ordered)
            ->where('quantity_confirmed', $quantity_confirmed)
            ->where('received', $received)
            ->where('printed', $printed)
            ->get();
        $this->assertCount(1, $orderItems);
        $orderItem = $orderItems->first();

        $response->assertRedirect(route('orderItem.index'));
        $response->assertSessionHas('orderItem.id', $orderItem->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $orderItem = OrderItem::factory()->create();

        $response = $this->get(route('order-item.show', $orderItem));

        $response->assertOk();
        $response->assertViewIs('orderItem.show');
        $response->assertViewHas('orderItem');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $orderItem = OrderItem::factory()->create();

        $response = $this->get(route('order-item.edit', $orderItem));

        $response->assertOk();
        $response->assertViewIs('orderItem.edit');
        $response->assertViewHas('orderItem');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\OrderItemController::class,
            'update',
            \App\Http\Requests\OrderItemUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $orderItem = OrderItem::factory()->create();
        $order = Order::factory()->create();
        $product = Product::factory()->create();
        $unit_price = $this->faker->randomFloat(/** double_attributes **/);
        $quantity_ordered = $this->faker->numberBetween(-10000, 10000);
        $quantity_confirmed = $this->faker->numberBetween(-10000, 10000);
        $received = $this->faker->boolean;
        $printed = $this->faker->boolean;

        $response = $this->put(route('order-item.update', $orderItem), [
            'order_id' => $order->id,
            'product_id' => $product->id,
            'unit_price' => $unit_price,
            'quantity_ordered' => $quantity_ordered,
            'quantity_confirmed' => $quantity_confirmed,
            'received' => $received,
            'printed' => $printed,
        ]);

        $orderItem->refresh();

        $response->assertRedirect(route('orderItem.index'));
        $response->assertSessionHas('orderItem.id', $orderItem->id);

        $this->assertEquals($order->id, $orderItem->order_id);
        $this->assertEquals($product->id, $orderItem->product_id);
        $this->assertEquals($unit_price, $orderItem->unit_price);
        $this->assertEquals($quantity_ordered, $orderItem->quantity_ordered);
        $this->assertEquals($quantity_confirmed, $orderItem->quantity_confirmed);
        $this->assertEquals($received, $orderItem->received);
        $this->assertEquals($printed, $orderItem->printed);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $orderItem = OrderItem::factory()->create();

        $response = $this->delete(route('order-item.destroy', $orderItem));

        $response->assertRedirect(route('orderItem.index'));

        $this->assertDeleted($orderItem);
    }
}
