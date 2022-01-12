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
            'customer_id' => 'sometimes|required|exists:customers,id',
            'team_member_id' => 'sometimes|nullable|exists:users,id',
            'contact_id' => 'sometimes|nullable|exists:contacts,id',
            'date' => 'sometimes|required|date',
            'quote_expires' => 'sometimes|nullable|date',
            'hold_inventory' => 'sometimes|nullable',
            'from_quote_id' => 'sometimes|nullable|exists:orders,id',
            'notes' => 'sometimes|nullable|string',
            'shipping_method_id' => 'sometimes|nullable|exists:shipping_methods,id',
            'shipping_amount' => 'sometimes|nullable|numeric|min:0',
            'warranty_percentage' => 'sometimes|nullable|numeric|min:0',
            'is_taxable' => 'sometimes|nullable|boolean',
            'tax_percentage' => 'sometimes|nullable|numeric|min:0',
        ];
    }
}
