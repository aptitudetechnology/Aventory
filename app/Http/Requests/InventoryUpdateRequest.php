<?php

namespace App\Http\Requests;

use App\Models\Inventory;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            'size_id' => ['sometimes','required', 'integer', 'exists:sizes,id'],
            'quantity' => ['sometimes','required', 'integer'],
            'nursery_location_id' => ['sometimes','required', 'exists:nursery_locations,id'],
            'block_id' => ['sometimes','nullable','integer', 'exists:blocks,id'],
            'place_id' => ['sometimes','nullable','integer', 'exists:places,id'],
            'confirm_replace' => [Rule::requiredIf(Inventory::whereNotNull('place_id')->where('place_id', $this->place_id)->where('id', '!=', $this->id)->first() ? true : false)]
        ];
    }
}
