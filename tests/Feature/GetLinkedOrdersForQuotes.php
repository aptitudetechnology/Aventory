<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GetLinkedOrdersForQuotes extends TestCase
{
    use RefreshDatabase;
    /**
     * Get linked orders for a given quote.
     *
     * @return void
     */
    public function test_get_orders_for_a_quote()
    {
        $this->actingAs($user = User::factory()->withPersonalTeam()->create());

        $quote = $user->team->quotes()->create();

        $order = $user->team->orders()->create();

        $order->from_quote_id = $quote->id;

        $order->save();

        $response = $this->get(route('api.quotes.orders.index', $quote->id));


        $response->assertStatus(200);

        $response->assertJson('data');

        $response->assertJsonCount(1);
    }
}
