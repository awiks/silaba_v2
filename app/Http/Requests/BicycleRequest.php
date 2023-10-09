<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BicycleRequest extends FormRequest
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
            'customer_id' => '',
            'police_number' => ['required','max:20',Rule::unique('bicycles')->ignore($this->bicycle)],
            'brand' => ['required','max:50'],
            'type' => ['required','max:50'],
            'description' => ['nullable','max:255'],
        ];
    }

    public function messages()
    {
        return [
            'police_number.required' => 'Nomor Kendaraan harap diisi',
            'police_number.max' => 'Nomor Kendaraan tidak boleh lebih dari 20 karakter',
            'police_number.unique' => 'Nomor Kendaraan yang anda masukan sudah ada.',

            'brand.required' => 'Merek harap diisi',
            'brand.max' => 'Merek tidak boleh lebih dari 50 karakter',

            'type.required' => 'Tipe harap diisi',
            'type.max' => 'Tipe tidak boleh lebih dari 50 karakter',

            'description.max' => 'Deskripsi tidak boleh lebih dari 255 karakter',

        ];
    }
}
