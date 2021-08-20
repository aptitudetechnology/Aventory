<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCustomerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('update', $this->customer);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'address' => ['nullable', 'string'],
            'city' => ['nullable', 'string'],
            'state' => ['nullable', 'string'],
            'zip' => ['nullable', 'string'],
            'mailing_same_as_primary' => ['boolean'],
            'mailing_address' => ['nullable', 'string'],
            'mailing_city' => ['nullable', 'string'],
            'mailing_state' => ['nullable', 'string'],
            'mailing_zip' => ['nullable', 'string'],
            'notes' => ['nullable', 'string'],
            'customer_price_level_id' => ['exists:customer_price_levels,id', 'nullable'],
            'is_retail' => ['nullable', 'boolean'],
            'no_auto_discount' => ['nullable', 'boolean'],
            'tax_percentage' => ['nullable', 'float'],
            'discount_override' => ['nullable', 'integer'],
            'reseller_permit_expiration' => ['nullable', 'date']
        ];
    }
}
