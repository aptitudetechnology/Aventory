<?php

namespace Tests\Feature;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GetSalesTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Ensure that the sales endpoint returns a list of sales for a given customer.
     *
     * @return void
     */
    public function test_get_sales_by_customer()
    {
        $this->actingAs($user = User::factory()->withPersonalTeam()->create());
        $response = $this->get(route('api.sales.index', ['customer' => Customer::factory()->create(['team_id' => $user->currentTeam->id])->id]));

        $response->assertStatus(200);
        $response->assertSee('orders');
        $response->assertSee('quotes');
    }

    /**
     * Ensure that the sales endpoint returns a list of sales for a given team.
     *
     * @return void
     */
    public function test_get_all_sales()
    {
        $this->actingAs($user = User::factory()->withPersonalTeam()->create());
        $response = $this->get(route('api.sales.index'));

        $response->assertStatus(200);
        $response->assertSee('orders');
        $response->assertSee('quotes');
    }

    /**
     * Ensure that unauthenticated users cannot access the sales endpoint.
     *
     * @return void
     */
    public function test_get_sales_unauthenticated()
    {
        $response = $this->get(route('api.sales.index'));

        $response->assertStatus(302);
    }
}
