<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class OrderItemUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('update', $this->order_item->sale);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'product_id' => 'required|exists:products,id',
            'size_id' => 'required|exists:sizes,id',
            'original_quantity' => 'required|integer|min:0',
            'quantity' => ['required', 'integer', 'min:0', function ($attribute, $value, $fail) {
                if ($this->order_item->quantity > $value) {
                    if ($this->order_item->matched_quantity > $value) {
                        $difference = $this->order_item->matched_quantity - $value;
                        $itemsString = Str::of('item')->plural($difference);
                        $fail("Please remove $difference matched inventory $itemsString before decreasing the quantity to $value.");
                    }
                }
            }],
            'unit_price' => 'required|numeric|min:0',
            'no_discount' => 'required|boolean',
        ];
    }
}
