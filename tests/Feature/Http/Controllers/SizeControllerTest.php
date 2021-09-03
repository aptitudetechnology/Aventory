<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\NextSize;
use App\Models\Size;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\SizeController
 */
class SizeControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $sizes = Size::factory()->count(3)->create();

        $response = $this->get(route('size.index'));

        $response->assertOk();
        $response->assertViewIs('size.index');
        $response->assertViewHas('sizes');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('size.create'));

        $response->assertOk();
        $response->assertViewIs('size.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\SizeController::class,
            'store',
            \App\Http\Requests\SizeStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $name = $this->faker->name;
        $next_size = NextSize::factory()->create();

        $response = $this->post(route('size.store'), [
            'name' => $name,
            'next_size_id' => $next_size->id,
        ]);

        $sizes = Size::query()
            ->where('name', $name)
            ->where('next_size_id', $next_size->id)
            ->get();
        $this->assertCount(1, $sizes);
        $size = $sizes->first();

        $response->assertRedirect(route('size.index'));
        $response->assertSessionHas('size.id', $size->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $size = Size::factory()->create();

        $response = $this->get(route('size.show', $size));

        $response->assertOk();
        $response->assertViewIs('size.show');
        $response->assertViewHas('size');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $size = Size::factory()->create();

        $response = $this->get(route('size.edit', $size));

        $response->assertOk();
        $response->assertViewIs('size.edit');
        $response->assertViewHas('size');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\SizeController::class,
            'update',
            \App\Http\Requests\SizeUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $size = Size::factory()->create();
        $name = $this->faker->name;
        $next_size = NextSize::factory()->create();

        $response = $this->put(route('size.update', $size), [
            'name' => $name,
            'next_size_id' => $next_size->id,
        ]);

        $size->refresh();

        $response->assertRedirect(route('size.index'));
        $response->assertSessionHas('size.id', $size->id);

        $this->assertEquals($name, $size->name);
        $this->assertEquals($next_size->id, $size->next_size_id);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $size = Size::factory()->create();

        $response = $this->delete(route('size.destroy', $size));

        $response->assertRedirect(route('size.index'));

        $this->assertSoftDeleted($size);
    }
}
