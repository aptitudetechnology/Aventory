<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PlantStoreRequest extends FormRequest
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
            'team_id' => ['required', 'integer', 'exists:teams,id'],
            'product_id' => ['required', 'integer', 'exists:products,id', 'unique:plants,product_id'],
            'scientific_name' => ['required', 'string'],
            'common_name' => ['required', 'string'],
            'zone' => ['string'],
            'height' => ['integer'],
            'spread' => ['integer'],
            'bloom_color' => ['string', 'max:50'],
            'fall_color' => ['string', 'max:50'],
            'growth_rate' => ['string', 'max:50'],
        ];
    }
}
