<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Contact;
use App\Models\Customer;
use App\Models\Team;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\ContactController
 */
class ContactControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $contacts = Contact::factory()->count(3)->create();

        $response = $this->get(route('contact.index'));

        $response->assertOk();
        $response->assertViewIs('contact.index');
        $response->assertViewHas('contacts');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('contact.create'));

        $response->assertOk();
        $response->assertViewIs('contact.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ContactController::class,
            'store',
            \App\Http\Requests\ContactStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $team = Team::factory()->create();
        $customer = Customer::factory()->create();
        $first_name = $this->faker->firstName;

        $response = $this->post(route('contact.store'), [
            'team_id' => $team->id,
            'customer_id' => $customer->id,
            'first_name' => $first_name,
        ]);

        $contacts = Contact::query()
            ->where('team_id', $team->id)
            ->where('customer_id', $customer->id)
            ->where('first_name', $first_name)
            ->get();
        $this->assertCount(1, $contacts);
        $contact = $contacts->first();

        $response->assertRedirect(route('contact.index'));
        $response->assertSessionHas('contact.id', $contact->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $contact = Contact::factory()->create();

        $response = $this->get(route('contact.show', $contact));

        $response->assertOk();
        $response->assertViewIs('contact.show');
        $response->assertViewHas('contact');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $contact = Contact::factory()->create();

        $response = $this->get(route('contact.edit', $contact));

        $response->assertOk();
        $response->assertViewIs('contact.edit');
        $response->assertViewHas('contact');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ContactController::class,
            'update',
            \App\Http\Requests\ContactUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $contact = Contact::factory()->create();
        $team = Team::factory()->create();
        $customer = Customer::factory()->create();
        $first_name = $this->faker->firstName;

        $response = $this->put(route('contact.update', $contact), [
            'team_id' => $team->id,
            'customer_id' => $customer->id,
            'first_name' => $first_name,
        ]);

        $contact->refresh();

        $response->assertRedirect(route('contact.index'));
        $response->assertSessionHas('contact.id', $contact->id);

        $this->assertEquals($team->id, $contact->team_id);
        $this->assertEquals($customer->id, $contact->customer_id);
        $this->assertEquals($first_name, $contact->first_name);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $contact = Contact::factory()->create();

        $response = $this->delete(route('contact.destroy', $contact));

        $response->assertRedirect(route('contact.index'));

        $this->assertDeleted($contact);
    }
}
