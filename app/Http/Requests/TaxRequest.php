<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TaxRequest extends FormRequest
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
            'tax_name' => ['required','max:50',Rule::unique('taxes')->ignore($this->tax)],
            'percentage' => ['required','numeric'],
        ];
    }

    public function messages()
    {
        return [
            'tax_name.required' => 'Nama Pajak harap diisi',
            'tax_name.max' => 'Nama Pajak tidak boleh lebih dari 50 karakter',
            'tax_name.unique' => 'Nama Pajak yang anda masukan sudah ada.',

            'percentage.required' => 'Persentase harap diisi.',
            'percentage.numeric' => 'Bidang persentase harus berupa angka.',
        ];
    }
}
