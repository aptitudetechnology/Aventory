<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Purchase;
use App\Models\Team;
use App\Models\Vendor;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\PurchaseController
 */
class PurchaseControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $purchases = Purchase::factory()->count(3)->create();

        $response = $this->get(route('purchase.index'));

        $response->assertOk();
        $response->assertViewIs('purchase.index');
        $response->assertViewHas('purchases');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('purchase.create'));

        $response->assertOk();
        $response->assertViewIs('purchase.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\PurchaseController::class,
            'store',
            \App\Http\Requests\PurchaseStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $date = $this->faker->date();
        $vendor = Vendor::factory()->create();
        $team = Team::factory()->create();

        $response = $this->post(route('purchase.store'), [
            'date' => $date,
            'vendor_id' => $vendor->id,
            'team_id' => $team->id,
        ]);

        $purchases = Purchase::query()
            ->where('date', $date)
            ->where('vendor_id', $vendor->id)
            ->where('team_id', $team->id)
            ->get();
        $this->assertCount(1, $purchases);
        $purchase = $purchases->first();

        $response->assertRedirect(route('purchase.index'));
        $response->assertSessionHas('purchase.id', $purchase->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $purchase = Purchase::factory()->create();

        $response = $this->get(route('purchase.show', $purchase));

        $response->assertOk();
        $response->assertViewIs('purchase.show');
        $response->assertViewHas('purchase');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $purchase = Purchase::factory()->create();

        $response = $this->get(route('purchase.edit', $purchase));

        $response->assertOk();
        $response->assertViewIs('purchase.edit');
        $response->assertViewHas('purchase');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\PurchaseController::class,
            'update',
            \App\Http\Requests\PurchaseUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $purchase = Purchase::factory()->create();
        $date = $this->faker->date();
        $vendor = Vendor::factory()->create();
        $team = Team::factory()->create();

        $response = $this->put(route('purchase.update', $purchase), [
            'date' => $date,
            'vendor_id' => $vendor->id,
            'team_id' => $team->id,
        ]);

        $purchase->refresh();

        $response->assertRedirect(route('purchase.index'));
        $response->assertSessionHas('purchase.id', $purchase->id);

        $this->assertEquals(Carbon::parse($date), $purchase->date);
        $this->assertEquals($vendor->id, $purchase->vendor_id);
        $this->assertEquals($team->id, $purchase->team_id);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $purchase = Purchase::factory()->create();

        $response = $this->delete(route('purchase.destroy', $purchase));

        $response->assertRedirect(route('purchase.index'));

        $this->assertDeleted($purchase);
    }
}
