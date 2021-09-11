<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\NurseryLocation;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\NurseryLocationController
 */
class NurseryLocationControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $nurseryLocations = NurseryLocation::factory()->count(3)->create();

        $response = $this->get(route('nursery-location.index'));

        $response->assertOk();
        $response->assertViewIs('nurseryLocation.index');
        $response->assertViewHas('nurseryLocations');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('nursery-location.create'));

        $response->assertOk();
        $response->assertViewIs('nurseryLocation.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\NurseryLocationController::class,
            'store',
            \App\Http\Requests\NurseryLocationStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $name = $this->faker->name;

        $response = $this->post(route('nursery-location.store'), [
            'name' => $name,
        ]);

        $nurseryLocations = NurseryLocation::query()
            ->where('name', $name)
            ->get();
        $this->assertCount(1, $nurseryLocations);
        $nurseryLocation = $nurseryLocations->first();

        $response->assertRedirect(route('nurseryLocation.index'));
        $response->assertSessionHas('nurseryLocation.id', $nurseryLocation->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $nurseryLocation = NurseryLocation::factory()->create();

        $response = $this->get(route('nursery-location.show', $nurseryLocation));

        $response->assertOk();
        $response->assertViewIs('nurseryLocation.show');
        $response->assertViewHas('nurseryLocation');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $nurseryLocation = NurseryLocation::factory()->create();

        $response = $this->get(route('nursery-location.edit', $nurseryLocation));

        $response->assertOk();
        $response->assertViewIs('nurseryLocation.edit');
        $response->assertViewHas('nurseryLocation');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\NurseryLocationController::class,
            'update',
            \App\Http\Requests\NurseryLocationUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $nurseryLocation = NurseryLocation::factory()->create();
        $name = $this->faker->name;

        $response = $this->put(route('nursery-location.update', $nurseryLocation), [
            'name' => $name,
        ]);

        $nurseryLocation->refresh();

        $response->assertRedirect(route('nurseryLocation.index'));
        $response->assertSessionHas('nurseryLocation.id', $nurseryLocation->id);

        $this->assertEquals($name, $nurseryLocation->name);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $nurseryLocation = NurseryLocation::factory()->create();

        $response = $this->delete(route('nursery-location.destroy', $nurseryLocation));

        $response->assertRedirect(route('nurseryLocation.index'));

        $this->assertDeleted($nurseryLocation);
    }
}
