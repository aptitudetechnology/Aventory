<?php

namespace Tests\Feature;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Quote;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;


class ConvertSalesTest extends TestCase
{
    use RefreshDatabase;
    /**
     * Quotes should be convertable to orders.
     *
     * @return void
     */
    public function test_convert_quote_to_order()
    {
        $this->actingAs($user = User::factory()->withPersonalTeam()->create());

        $otherQuote = $user->currentTeam->quotes()->save(Quote::factory()->make());
        $id = $otherQuote->id;
        $response = $this->post(\route('sales.convert', $id));

        $this->assertDatabaseHas('orders', [
            'id' => $id,
            'is_quote' => false,
        ]);

        $response->assertRedirect(\route('orders.show', $id));
    }

    /**
     * Orders should be convertable to quotes.
     * 
     * @return void
     */
    public function test_convert_order_to_quote()
    {
        $this->actingAs($user = User::factory()->withPersonalTeam()->create());

        $order = $user->currentTeam->orders()->save(Order::factory()->make());
        $id = $order->id;
        $response = $this->post(\route('sales.convert', $id));

        $this->assertDatabaseHas('orders', [
            'id' => $id,
            'is_quote' => true,
        ]);

        $response->assertRedirect(\route('quotes.show', $id));
    }

    /**
     * Only team members can convert sales in their team.
     * 
     * @return void
     */
    public function test_only_team_members_can_convert_sales()
    {
        $this->actingAs($user = User::factory()->withPersonalTeam()->create());

        $teamQuote = $user->currentTeam->quotes()->save(Quote::factory()->make());
        $teamQuoteId = $teamQuote->id;

        $response = $this->post(\route('sales.convert', $teamQuote->id));
        $this->assertDatabaseHas('orders', [
            'id' => $teamQuoteId,
            'is_quote' => false,
        ]);

        $response->assertRedirect(\route('orders.show', $teamQuoteId));


        $otherQuote = Quote::factory()->create();
        $id = $otherQuote->id;
        $response = $this->post(\route('sales.convert', $id));

        $this->assertDatabaseMissing('orders', [
            'id' => $id,
            'is_quote' => false,
        ]);

        $response->assertForbidden();
    }

    /**
     * Orders that have inventory matched should not be convertable to quotes.
     * 
     * @return void
     */
    public function test_order_with_matched_inventory_cannot_be_converted_to_quote()
    {
        $this->actingAs($user = User::factory()->withPersonalTeam()->create());

        $order = $user->currentTeam->orders()->save(Order::factory()->withInventory()->make());

        $id = $order->id;
        $response = $this->post(\route('sales.convert', $id));

        $this->assertDatabaseHas('orders', [
            'id' => $id,
            'is_quote' => false,
        ]);

        $response->assertRedirect(\route('orders.show', $id));
    }
}
