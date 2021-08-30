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
        $contact = auth()->user()->currentTeam->contacts()->create($request->validated());

        session()->flash('flash.banner', 'Created new contact!');
        session()->flash('flash.bannerStyle', 'success');

        return $this->redirectRoute($contact);
    }


    /**
     * @param \App\Http\Requests\ContactUpdateRequest $request
     * @param \App\Models\Contact $contact
     * @return \Illuminate\Http\Response
     */
    public function update(ContactUpdateRequest $request, Contact $contact)
    {
        $contact->update($request->validated());

        session()->flash('flash.banner', 'Saved changes to contact.');
        session()->flash('flash.bannerStyle', 'success');

        return $this->redirectRoute($contact);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Contact $contact
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Contact $contact)
    {


        $contact->delete();

        session()->flash('flash.banner', 'Deleted contact.');
        session()->flash('flash.bannerStyle', 'success');

        return $this->redirectRoute($contact);
    }

    public function redirectRoute($contact)
    {
        if ($contact->customer_id) {
            return redirect(route('customers.show', $contact->customer_id));
        } elseif ($contact->vendor_id) {
            return redirect(route('vendors.show', $contact->vendor_id));
        }
    }
}
