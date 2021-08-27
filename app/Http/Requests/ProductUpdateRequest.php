<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('update', $this->product);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'category_id' => ['nullable', 'integer', 'exists:categories,id'],
            'name' => ['required', 'string'],
            'type' => ['required', 'in:plant,inventory,non-inventory,service'],
            'description' => ['nullable', 'string', 'max:8000'],
            'scientific_name' => ['exclude_unless:type,plant', 'required', 'string'],
            'common_name' => ['exclude_unless:type,plant', 'required', 'string'],
            'zone' => ['exclude_unless:type,plant', 'nullable', 'string'],
            'height' => ['exclude_unless:type,plant', 'nullable', 'integer'],
            'spread' => ['exclude_unless:type,plant', 'nullable', 'integer'],
            'bloom_color' => ['exclude_unless:type,plant', 'nullable', 'string'],
            'fall_color' => ['exclude_unless:type,plant', 'nullable', 'string'],
            'growth_rate' => ['exclude_unless:type,plant', 'nullable', 'string'],
        ];
    }
}
