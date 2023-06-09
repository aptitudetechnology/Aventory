<?php

namespace Tests\Feature;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Quote;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ConvertSalesTest extends TestCase
{
    use RefreshDatabase;
    // /**
    //  * Quotes should be convertable to orders.
    //  *
    //  * @return void
    //  */
    // public function test_convert_quote_to_order()
    // {
    //     $this->actingAs($user = User::factory()->withPersonalTeam()->create());

    //     $otherQuote = $user->currentTeam->quotes()->save(Quote::factory()->make());
    //     $id = $otherQuote->id;
    //     $response = $this->post(\route('sales.convert', $id));
    //     $response->assertStatus(302);
    // }

    // /**
    //  * Orders should be convertable to quotes.
    //  *
    //  * @return void
    //  */
    // public function test_convert_order_to_quote()
    // {
    //     $this->actingAs($user = User::factory()->withPersonalTeam()->create());

    //     $order = $user->currentTeam->orders()->save(Order::factory()->make());
    //     $id = $order->id;
    //     $response = $this->post(\route('sales.convert', $id));

    //     $this->assertDatabaseHas('orders', [
    //         'id' => $id,
    //         'is_quote' => true,
    //     ]);

    //     $response->assertRedirect(\route('quotes.show', $id));
    // }

    // /**
    //  * Only team members can convert sales in their team.
    //  *
    //  * @return void
    //  */
    // public function test_only_team_members_can_convert_sales()
    // {
    //     $this->actingAs($user = User::factory()->withPersonalTeam()->create());

    //     $teamQuote = $user->currentTeam->quotes()->save(Quote::factory()->make());
    //     $teamQuoteId = $teamQuote->id;

    //     $response = $this->post(\route('sales.convert', $teamQuote->id));
    //     $this->assertDatabaseHas('orders', [
    //         'id' => $teamQuoteId,
    //         'is_quote' => false,
    //     ]);

    //     $response->assertRedirect(\route('orders.show', $teamQuoteId));

    //     $otherQuote = Quote::factory()->create();
    //     $id = $otherQuote->id;
    //     $response = $this->post(\route('sales.convert', $id));

    //     $this->assertDatabaseMissing('orders', [
    //         'id' => $id,
    //         'is_quote' => false,
    //     ]);

    //     $response->assertForbidden();
    // }

    // /**
    //  * Quotes should be partially convertable to orders.
    //  *
    //  * @return void
    //  */
    // public function test_convert_quote_to_order_partially()
    // {
    //     $this->actingAs($user = User::factory()->withPersonalTeam()->create());

    //     $otherQuote = $user->currentTeam->quotes()->save(Quote::factory()
    //         ->has(
    //             OrderItem::factory()
    //                 ->count(3)
    //                 ->state(function (array $attributes, Quote $quote) {
    //                     return ['order_id' => $quote->id];
    //                 }),
    //             'items'
    //         )
    //         ->create());

    //     $id = $otherQuote->id;

    //     // Convert only the first item.
    //     $response = $this->post(\route('sales.convert', $id), [
    //         'items' => [
    //             $otherQuote->items->first()->id => [
    //                 'quantity' => 1,
    //             ],
    //         ],
    //     ]);

    //     $response->assertSuccessful();

    //     $this->assertDatabaseHas('orders', [
    //         'id' => $id,
    //         'is_quote' => true,
    //     ]);
    // }
}
