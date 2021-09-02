<?php

namespace App\Http\Requests;

use App\Models\Size;
use Illuminate\Foundation\Http\FormRequest;

class SizeStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('create', Size::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'next_size_id' => ['nullable', 'integer', 'exists:sizes,id'],
        ];
    }
}
