<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Team;
use App\Models\Vendor;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\VendorController
 */
class VendorControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $vendors = Vendor::factory()->count(3)->create();

        $response = $this->get(route('vendor.index'));

        $response->assertOk();
        $response->assertViewIs('vendor.index');
        $response->assertViewHas('vendors');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('vendor.create'));

        $response->assertOk();
        $response->assertViewIs('vendor.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\VendorController::class,
            'store',
            \App\Http\Requests\VendorStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $team = Team::factory()->create();
        $name = $this->faker->name;
        $mailing_same_as_primary = $this->faker->boolean;
        $use_for_block_transfers = $this->faker->boolean;

        $response = $this->post(route('vendor.store'), [
            'team_id' => $team->id,
            'name' => $name,
            'mailing_same_as_primary' => $mailing_same_as_primary,
            'use_for_block_transfers' => $use_for_block_transfers,
        ]);

        $vendors = Vendor::query()
            ->where('team_id', $team->id)
            ->where('name', $name)
            ->where('mailing_same_as_primary', $mailing_same_as_primary)
            ->where('use_for_block_transfers', $use_for_block_transfers)
            ->get();
        $this->assertCount(1, $vendors);
        $vendor = $vendors->first();

        $response->assertRedirect(route('vendor.index'));
        $response->assertSessionHas('vendor.id', $vendor->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $vendor = Vendor::factory()->create();

        $response = $this->get(route('vendor.show', $vendor));

        $response->assertOk();
        $response->assertViewIs('vendor.show');
        $response->assertViewHas('vendor');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $vendor = Vendor::factory()->create();

        $response = $this->get(route('vendor.edit', $vendor));

        $response->assertOk();
        $response->assertViewIs('vendor.edit');
        $response->assertViewHas('vendor');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\VendorController::class,
            'update',
            \App\Http\Requests\VendorUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $vendor = Vendor::factory()->create();
        $team = Team::factory()->create();
        $name = $this->faker->name;
        $mailing_same_as_primary = $this->faker->boolean;
        $use_for_block_transfers = $this->faker->boolean;

        $response = $this->put(route('vendor.update', $vendor), [
            'team_id' => $team->id,
            'name' => $name,
            'mailing_same_as_primary' => $mailing_same_as_primary,
            'use_for_block_transfers' => $use_for_block_transfers,
        ]);

        $vendor->refresh();

        $response->assertRedirect(route('vendor.index'));
        $response->assertSessionHas('vendor.id', $vendor->id);

        $this->assertEquals($team->id, $vendor->team_id);
        $this->assertEquals($name, $vendor->name);
        $this->assertEquals($mailing_same_as_primary, $vendor->mailing_same_as_primary);
        $this->assertEquals($use_for_block_transfers, $vendor->use_for_block_transfers);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $vendor = Vendor::factory()->create();

        $response = $this->delete(route('vendor.destroy', $vendor));

        $response->assertRedirect(route('vendor.index'));

        $this->assertDeleted($vendor);
    }
}
