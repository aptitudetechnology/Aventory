<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderStoreRequest extends FormRequest
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
            'customer_id' => 'required|exists:customers,id',
            'team_member_id' => 'nullable|exists:users,id',
            'contact_id' => 'nullable|exists:contacts,id',
            'date' => 'required|date',
            'from_quote_id' => 'nullable|exists:orders,id',
            'notes' => 'nullable|string',
        ];
    }
}
