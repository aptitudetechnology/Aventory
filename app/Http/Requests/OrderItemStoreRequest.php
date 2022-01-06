<?php

namespace App\Http\Requests;

use App\Models\Order;
use Illuminate\Foundation\Http\FormRequest;

class OrderItemStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('update', $this->order);
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
            'size_id'   => 'required|exists:sizes,id',
            'quantity'  => 'required|integer|min:0',
            'original_quantity' => 'required|integer|min:0',
            'unit_price' => 'required|numeric|min:0',
            'no_discount'  => 'required|boolean',
        ];
    }
}
