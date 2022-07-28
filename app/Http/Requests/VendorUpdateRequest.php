<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VendorUpdateRequest extends FormRequest
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
            'name' => ['required', 'string'],
            'vendor_code' => ['nullable', 'string', 'max:50'],
            'address' => ['nullable', 'string'],
            'city' => ['nullable', 'string', 'max:50'],
            'state' => ['nullable', 'string', 'max:50'],
            'zip' => ['nullable', 'string', 'max:20'],
            'mailing_same_as_primary' => ['nullable', 'required'],
            'mailing_address' => ['nullable', 'string'],
            'mailing_city' => ['nullable', 'string', 'max:50'],
            'mailing_state' => ['nullable', 'string', 'max:50'],
            'mailing_zip' => ['nullable', 'string', 'max:20'],
            'notes' => ['nullable', 'string', 'max:8000'],
            'use_for_block_transfers' => [
                'boolean',
                'required',
            ],
        ];
    }
}
