<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PurchaseItemUpdateRequest extends FormRequest
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
            'product_id' => ['required', 'integer', 'exists:products,id'],
            'original_size_id' => ['required', 'integer', 'exists:sizes,id'],
            'size_id' => ['required', 'integer', 'exists:sizes,id'],
            'unit_price' => ['required', 'numeric'],
            'quantity_ordered' => ['required', 'integer'],
            'quantity_confirmed' => ['required', 'integer'],
            'received' => ['boolean'],
            'ready_date' => ['required', 'date'],
        ];
    }
}
