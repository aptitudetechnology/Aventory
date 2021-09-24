<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InventoryUpdateRequest extends FormRequest
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
            'order_item_id' => ['required', 'integer', 'exists:order_items,id'],
            'product_id' => ['required', 'integer', 'exists:products,id'],
            'original_size_id' => ['required', 'integer', 'exists:sizes,id'],
            'size_id' => ['required', 'integer', 'exists:sizes,id'],
            'quantity' => ['required', 'integer'],
            'type' => ['required', 'in:group,individual'],
            'nursery_location_id' => ['required', 'exists:nursery_locations,id'],
            'block_id' => ['nullable','integer', 'exists:blocks,id'],
            'place_id' => ['nullable','integer', 'exists:places,id'],
        ];
    }
}
