<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRoverRequest extends FormRequest
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
            'plateau_id' => 'required|integer',
            'x' => 'required|numeric',
            'y' => 'required|numeric',
            'direction' => 'required|string|in:N,S,E,W',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'id' => 'Rover',
            'plateau_id' => 'Plateau',
            'x' => 'Horizontal coordinate',
            'y' => 'Vertical coordinate',
            'direction' => 'Initial heading direction',
        ];
    }
}
