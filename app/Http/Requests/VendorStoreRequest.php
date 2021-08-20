<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VendorStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'team_id' => ['required', 'integer', 'exists:teams,id'],
            'name' => ['required', 'string'],
            'vendor_code' => ['string', 'max:50'],
            'address' => ['string'],
            'city' => ['string', 'max:50'],
            'state' => ['string', 'max:50'],
            'zip' => ['string', 'max:20'],
            'mailing_same_as_primary' => ['required'],
            'mailing_address' => ['string'],
            'mailing_city' => ['string', 'max:50'],
            'mailing_state' => ['string', 'max:50'],
            'mailing_zip' => ['string', 'max:20'],
            'notes' => ['string', 'max:8000'],
            'use_for_block_transfers' => ['required'],
        ];
    }
}
