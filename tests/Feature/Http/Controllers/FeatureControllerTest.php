<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Feature;
use App\Models\Team;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\FeatureController
 */
class FeatureControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $features = Feature::factory()->count(3)->create();

        $response = $this->get(route('feature.index'));

        $response->assertOk();
        $response->assertViewIs('feature.index');
        $response->assertViewHas('features');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('feature.create'));

        $response->assertOk();
        $response->assertViewIs('feature.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\FeatureController::class,
            'store',
            \App\Http\Requests\FeatureStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $team = Team::factory()->create();
        $name = $this->faker->name;

        $response = $this->post(route('feature.store'), [
            'team_id' => $team->id,
            'name' => $name,
        ]);

        $features = Feature::query()
            ->where('team_id', $team->id)
            ->where('name', $name)
            ->get();
        $this->assertCount(1, $features);
        $feature = $features->first();

        $response->assertRedirect(route('feature.index'));
        $response->assertSessionHas('feature.id', $feature->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $feature = Feature::factory()->create();

        $response = $this->get(route('feature.show', $feature));

        $response->assertOk();
        $response->assertViewIs('feature.show');
        $response->assertViewHas('feature');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $feature = Feature::factory()->create();

        $response = $this->get(route('feature.edit', $feature));

        $response->assertOk();
        $response->assertViewIs('feature.edit');
        $response->assertViewHas('feature');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\FeatureController::class,
            'update',
            \App\Http\Requests\FeatureUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $feature = Feature::factory()->create();
        $team = Team::factory()->create();
        $name = $this->faker->name;

        $response = $this->put(route('feature.update', $feature), [
            'team_id' => $team->id,
            'name' => $name,
        ]);

        $feature->refresh();

        $response->assertRedirect(route('feature.index'));
        $response->assertSessionHas('feature.id', $feature->id);

        $this->assertEquals($team->id, $feature->team_id);
        $this->assertEquals($name, $feature->name);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $feature = Feature::factory()->create();

        $response = $this->delete(route('feature.destroy', $feature));

        $response->assertRedirect(route('feature.index'));

        $this->assertDeleted($feature);
    }
}
