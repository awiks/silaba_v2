<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CompanyRequest extends FormRequest
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
            'company_name' => ['required','string','max:255'],
            'images' => ['nullable','mimes:png','max:1024'],

            'address' => ['required','string'],
            'shipping_address' => ['required','string'],

            'npwp' => ['max:100'],
            'telephone' => ['max:100'],
            'fax' => ['max:100'],

            'email' => ['nullable','email','max:100',Rule::unique('companies')->ignore($this->company)],
        ];
    }

    public function messages()
    {
        return [
            'company_name.required' => 'Nama Perusahaan harap diisi',
            'company_name.max' => 'Kolom tidak boleh lebih dari 255 karakter',

            'logo.mimes' => 'Bidang gambar harus berupa file dengan tipe: png.',
            'logo.max' => 'Bidang gambar tidak boleh lebih besar dari 1024 kilobyte.',

            'address.required' => 'Alamat Perusahaan harap diisi',
            'shipping_address.required' => 'Alamat Pengiriman harap diisi',

            'npwp.max' => 'Kolom tidak boleh lebih dari 100 karakter',
            'telephone.max' => 'Kolom tidak boleh lebih dari 100 karakter',
            'fax.max' => 'Kolom tidak boleh lebih dari 100 karakter',
        ];
    }
}
