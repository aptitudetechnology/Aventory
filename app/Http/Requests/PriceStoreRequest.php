<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PriceStoreRequest extends FormRequest
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
            'product_id' => ['nullable', 'exists:products,id'],
            'category_id' => ['nullable', 'exists:categories,id'],
            'size_id' => [
                'required', 'exists:sizes,id',
                $this->uniqueSize(),
            ],
            'unit_price' => ['required', 'numeric'],
            'show_on_availability' => ['boolean'],
        ];
    }

    protected function uniqueSize()
    {
        if ($this->product_id) {
            return Rule::unique('prices', 'size_id')->where('product_id', $this->product_id);
        } else {
            return Rule::unique('prices', 'size_id')->where('category_id', $this->category_id);
        }
    }
}
