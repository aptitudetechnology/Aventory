<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactUpdateRequest extends FormRequest
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
            'customer_id' => ['nullable', 'integer', 'exists:customers,id'],
            'first_name' => ['required', 'string', 'max:50'],
            'last_name' => ['string', 'max:50'],
            'email' => ['email', 'max:150'],
            'phone_1' => ['string', 'max:20'],
            'phone_2' => ['string', 'max:20'],
            'cell_phone' => ['string', 'max:20'],
            'fax' => ['string', 'max:20'],
            'notes' => ['string', 'max:8000'],
        ];
    }
}
