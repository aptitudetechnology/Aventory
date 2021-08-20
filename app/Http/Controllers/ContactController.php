<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactStoreRequest;
use App\Http\Requests\ContactUpdateRequest;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ContactController extends Controller
{

    /**
     * @param \App\Http\Requests\ContactStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ContactStoreRequest $request)
    {
        Gate::authorize('create', Contact::class);
        $contact = auth()->user()->currentTeam->contacts()->create($request->validated());

        $request->session()->flash('contact.id', $contact->id);
        if ($request->customer_id) {
            session()->flash('flash.banner', 'Created new contact!');
            session()->flash('flash.bannerStyle', 'success');
            return redirect(route('customers.show', $request->customer_id));
        }
    }


    /**
     * @param \App\Http\Requests\ContactUpdateRequest $request
     * @param \App\Models\Contact $contact
     * @return \Illuminate\Http\Response
     */
    public function update(ContactUpdateRequest $request, Contact $contact)
    {
        Gate::authorize('update', $contact);
        $contact->update($request->validated());
        session()->flash('flash.banner', 'Saved changes to contact.');
        session()->flash('flash.bannerStyle', 'success');
        return redirect(route('customers.show', $contact->customer->id));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Contact $contact
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Contact $contact)
    {
        Gate::authorize('delete', $contact);
        $contact->delete();
        session()->flash('flash.banner', 'Deleted contact.');
        session()->flash('flash.bannerStyle', 'success');
        return redirect(route('customers.show', $contact->customer_id));
    }
}
