<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EmployeeRequest extends FormRequest
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
            'address' => ['nullable','max:255'],
            'phone' => ['required','max:20',Rule::unique('employees')->ignore($this->employee)],
            'email' => ['nullable','email','max:100',Rule::unique('employees')->ignore($this->employee)],
            'birtday' => ['required'],
            'status' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Nama harap diisi',
            'name.max' => 'Kolom Nama tidak boleh lebih dari 50 karakter',

            'phone.required' => 'No Handphone / Whatsapp harap diisi',
            'phone.max' => 'No Handphone / Whatsapp  tidak boleh lebih dari 20 karakter',
            'phone.unique' => 'No Handphone / Whatsapp yang anda masukan sudah ada.',

            'address.max' => 'Alamat tidak boleh lebih dari 255 karakter',

            'email.max' => 'Email tidak boleh lebih dari 100 karakter',
            'email.unique' => 'Email yang anda masukan sudah ada.',
            'email.email' => 'Kolom email harus berupa alamat email yang valid.',

            'birtday.required' => 'Tanggal Lahir harap diisi',
            'status.required' => 'Status harap dipilih',
        ];
    }
}
