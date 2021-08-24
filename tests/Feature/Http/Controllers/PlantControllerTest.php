<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Plant;
use App\Models\Product;
use App\Models\Team;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\PlantController
 */
class PlantControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $plants = Plant::factory()->count(3)->create();

        $response = $this->get(route('plant.index'));

        $response->assertOk();
        $response->assertViewIs('plant.index');
        $response->assertViewHas('plants');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('plant.create'));

        $response->assertOk();
        $response->assertViewIs('plant.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\PlantController::class,
            'store',
            \App\Http\Requests\PlantStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $team = Team::factory()->create();
        $product = Product::factory()->create();
        $scientific_name = $this->faker->word;
        $common_name = $this->faker->word;

        $response = $this->post(route('plant.store'), [
            'team_id' => $team->id,
            'product_id' => $product->id,
            'scientific_name' => $scientific_name,
            'common_name' => $common_name,
        ]);

        $plants = Plant::query()
            ->where('team_id', $team->id)
            ->where('product_id', $product->id)
            ->where('scientific_name', $scientific_name)
            ->where('common_name', $common_name)
            ->get();
        $this->assertCount(1, $plants);
        $plant = $plants->first();

        $response->assertRedirect(route('plant.index'));
        $response->assertSessionHas('plant.id', $plant->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $plant = Plant::factory()->create();

        $response = $this->get(route('plant.show', $plant));

        $response->assertOk();
        $response->assertViewIs('plant.show');
        $response->assertViewHas('plant');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $plant = Plant::factory()->create();

        $response = $this->get(route('plant.edit', $plant));

        $response->assertOk();
        $response->assertViewIs('plant.edit');
        $response->assertViewHas('plant');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\PlantController::class,
            'update',
            \App\Http\Requests\PlantUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $plant = Plant::factory()->create();
        $team = Team::factory()->create();
        $product = Product::factory()->create();
        $scientific_name = $this->faker->word;
        $common_name = $this->faker->word;

        $response = $this->put(route('plant.update', $plant), [
            'team_id' => $team->id,
            'product_id' => $product->id,
            'scientific_name' => $scientific_name,
            'common_name' => $common_name,
        ]);

        $plant->refresh();

        $response->assertRedirect(route('plant.index'));
        $response->assertSessionHas('plant.id', $plant->id);

        $this->assertEquals($team->id, $plant->team_id);
        $this->assertEquals($product->id, $plant->product_id);
        $this->assertEquals($scientific_name, $plant->scientific_name);
        $this->assertEquals($common_name, $plant->common_name);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $plant = Plant::factory()->create();

        $response = $this->delete(route('plant.destroy', $plant));

        $response->assertRedirect(route('plant.index'));

        $this->assertDeleted($plant);
    }
}
