<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PlaceStoreRequest extends FormRequest
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
            'num_rows' => ['required', 'integer'],
            'block_id' => ['required', 'exists:blocks,id'],
            'starting_row_num' => ['required', 'integer'],
            'num_plants_per_row' => ['required', 'integer'],
        ];
    }
}
