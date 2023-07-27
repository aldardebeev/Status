<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDoorRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'paint_color' => 'required|string',
            'film_color' => 'required|string',
            'handle_color' => 'required|string',
            'width' => 'required|integer',
            'height' => 'required|integer',
            'opening' => 'required|string',
            'accessories' => 'required|array',
            'total_price' => 'required',
        ];
    }
}
