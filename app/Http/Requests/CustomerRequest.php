<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CustomerRequest extends FormRequest
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
            'name' => ['required','max:50'],
            'address' => ['required','max:255'],
            'contact' => ['required','max:20',Rule::unique('customers')->ignore($this->customer)],
            'email' => ['nullable','email','max:100',Rule::unique('customers')->ignore($this->customer)],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Nama harap diisi',
            'name.max' => 'Kolom Nama tidak boleh lebih dari 50 karakter',

            'contact.required' => 'No Handphone / Whatsapp harap diisi',
            'contact.max' => 'No Handphone / Whatsapp  tidak boleh lebih dari 20 karakter',
            'contact.unique' => 'No Handphone / Whatsapp yang anda masukan sudah ada.',

            'address.required' => 'Alamat harap diisi',
            'address.max' => 'Alamat tidak boleh lebih dari 255 karakter',

            'email.max' => 'Email tidak boleh lebih dari 100 karakter',
            'email.unique' => 'Email yang anda masukan sudah ada.',
            'email.email' => 'Kolom email harus berupa alamat email yang valid.',
        ];
    }
}
