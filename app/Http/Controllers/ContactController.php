<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactStoreRequest;
use App\Http\Requests\ContactUpdateRequest;
use App\Models\Contact;

class ContactController extends Controller
{
    public function store($contactableType, $contactableId, ContactStoreRequest $request)
    {
        $validatedData = $request->validated();
        $validatedData['team_id'] = $request->user()->currentTeam->id;
        $validatedData['contactable_type'] = $contactableType;
        $validatedData['contactable_id'] = $contactableId;

        $contact = new Contact($validatedData);
        $contact->save();

        session()->flash('flash.banner', 'Created new contact!');
        session()->flash('flash.bannerStyle', 'success');

        return $this->redirectRoute($contact);
    }

    public function update(Contact $contact, ContactUpdateRequest $request)
    {
        $contact->update($request->validated());

        session()->flash('flash.banner', 'Saved changes to contact.');
        session()->flash('flash.bannerStyle', 'success');

        return $this->redirectRoute($contact);
    }

    public function destroy(Contact $contact)
    {
        $contact->delete();

        session()->flash('flash.banner', 'Deleted contact.');
        session()->flash('flash.bannerStyle', 'success');

        return $this->redirectRoute($contact);
    }

    protected function redirectRoute($contact)
    {
        return redirect()->route("{$contact->contactable_type}.show", $contact->contactable_id);
    }
}
