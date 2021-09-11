<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlockStoreRequest extends FormRequest
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
            'name' => ['required', 'string'],
            'nursery_location_id' => ['required', 'integer', 'exists:nursery_locations,id'],
            'has_places' => ['required'],
        ];
    }
}
