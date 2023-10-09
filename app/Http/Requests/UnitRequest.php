<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UnitRequest extends FormRequest
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
            'unit_name' => ['required','max:50',Rule::unique('units')->ignore($this->unit)],
        ];
    }

    public function messages()
    {
        return [
            'unit_name.required' => 'Nama Satuan harap diisi',
            'unit_name.max' => 'Nama Satuan tidak boleh lebih dari 50 karakter',
            'unit_name.unique' => 'Nama Satuan yang anda masukan sudah ada.',
        ];
    }
}
