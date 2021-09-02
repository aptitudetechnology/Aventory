<?php

namespace App\Http\Requests;

use App\Models\BasePrice;
use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BasePriceStoreRequest extends FormRequest
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
            'product_id' => ['required', 'exists:products,id'],
            'size_id' => ['required', 'exists:sizes,id'],
            'size_id' => Rule::unique('base_prices', 'size_id')->where('product_id', $this->product_id),
            'unit_price' => ['required', 'numeric'],
            'custom_price' => ['nullable', 'numeric'],
            'show_on_availability' => ['boolean']
        ];
    }
}
