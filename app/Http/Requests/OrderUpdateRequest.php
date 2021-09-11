<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderUpdateRequest extends FormRequest
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
            'date' => ['required', 'date'],
            'vendor_id' => ['required', 'integer', 'exists:vendors,id'],
            'user_id' => ['integer', 'exists:users,id'],
            'order_number' => ['string', 'nullable'],
        ];
    }
}
