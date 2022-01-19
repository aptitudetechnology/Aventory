<?php

namespace Tests\Feature;

use App\Models\Customer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GetSalesTest extends TestCase
{
    /**
     * Ensure that the sales endpoint returns a list of sales for a given customer.
     *
     * @return void
     */
    public function test_get_sales_by_customer()
    {
        $response = $this->get(route("api.sales.index", ["customer" => Customer::factory()->create()->id]));

        $response->assertStatus(200);
    }
}
