<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Block;
use App\Models\NurseryLocation;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\BlockController
 */
class BlockControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $blocks = Block::factory()->count(3)->create();

        $response = $this->get(route('block.index'));

        $response->assertOk();
        $response->assertViewIs('block.index');
        $response->assertViewHas('blocks');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('block.create'));

        $response->assertOk();
        $response->assertViewIs('block.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\BlockController::class,
            'store',
            \App\Http\Requests\BlockStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $name = $this->faker->name;
        $nursery_location = NurseryLocation::factory()->create();
        $has_places = $this->faker->boolean;

        $response = $this->post(route('block.store'), [
            'name' => $name,
            'nursery_location_id' => $nursery_location->id,
            'has_places' => $has_places,
        ]);

        $blocks = Block::query()
            ->where('name', $name)
            ->where('nursery_location_id', $nursery_location->id)
            ->where('has_places', $has_places)
            ->get();
        $this->assertCount(1, $blocks);
        $block = $blocks->first();

        $response->assertRedirect(route('block.index'));
        $response->assertSessionHas('block.id', $block->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $block = Block::factory()->create();

        $response = $this->get(route('block.show', $block));

        $response->assertOk();
        $response->assertViewIs('block.show');
        $response->assertViewHas('block');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $block = Block::factory()->create();

        $response = $this->get(route('block.edit', $block));

        $response->assertOk();
        $response->assertViewIs('block.edit');
        $response->assertViewHas('block');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\BlockController::class,
            'update',
            \App\Http\Requests\BlockUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $block = Block::factory()->create();
        $name = $this->faker->name;
        $nursery_location = NurseryLocation::factory()->create();
        $has_places = $this->faker->boolean;

        $response = $this->put(route('block.update', $block), [
            'name' => $name,
            'nursery_location_id' => $nursery_location->id,
            'has_places' => $has_places,
        ]);

        $block->refresh();

        $response->assertRedirect(route('block.index'));
        $response->assertSessionHas('block.id', $block->id);

        $this->assertEquals($name, $block->name);
        $this->assertEquals($nursery_location->id, $block->nursery_location_id);
        $this->assertEquals($has_places, $block->has_places);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $block = Block::factory()->create();

        $response = $this->delete(route('block.destroy', $block));

        $response->assertRedirect(route('block.index'));

        $this->assertDeleted($block);
    }
}
