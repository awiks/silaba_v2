<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UnitConversionRequest extends FormRequest
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
            'unit_id' => ['required','array'],
            'unit_id.*' => ['required'],

            'amount' => ['array'],
            'amount.*' => ['required'],

            'buy_price' => ['array'],
            'buy_price.*' => ['required'],

            'sell_price' => ['array'],
            'sell_price.*' => ['required'],

            'unit_type' => ['array'],
            'unit_type.*' => ['required'],
        ];
    }
}
