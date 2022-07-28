<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClearLocationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->currentTeam == $this->block->team;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'starting_row' => ['required', 'exists:places,row_number'],
            'ending_row' => ['required', 'exists:places,row_number'],
        ];
    }
}
