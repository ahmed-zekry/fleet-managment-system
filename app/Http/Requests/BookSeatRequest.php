<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookSeatRequest extends FormRequest
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
            'trip_id' => 'required|integer|gt:0',
            'seat_id' => 'required|integer|gt:0',
            'origin_city_id' => 'required|integer|gt:0|exists:cities,id',
            'destination_city_id' => 'required|integer|gt:0|exists:cities,id',
        ];
    }
}
