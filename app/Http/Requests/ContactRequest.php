<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ContactRequest extends FormRequest
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
            'nickname' => ['required','string','max:50'],
            'contact_type' => ['required','array','min:1'],

            'contact_name' => ['required','max:100'],
            'handphone' => ['nullable','max:50',Rule::unique('contacts')->ignore($this->contact)],
            'identity_type' => ['nullable'],
            'identity_number' => ['nullable','max:50'],
            'emails' => [
                'nullable',
                function ($attribute, $value, $fail) {
                    $emails = array_map('trim', explode(',', $value));
                    $validator = Validator::make([$attribute => $emails], [$attribute.'.*' => 'required|email|unique:contacts,id']);
                    if ($validator->fails()) {
                        $fail('Semua alamat email harus valid.');
                    }
                },
            ],
            'other_info' =>['nullable','max:225'],
            'company_name' =>['nullable','max:150'],
            'telephone' =>['nullable','max:50',Rule::unique('contacts')->ignore($this->contact)],
            'fax' =>['nullable','max:50',Rule::unique('contacts')->ignore($this->contact)],
            'npwp' =>['nullable','max:50',Rule::unique('contacts')->ignore($this->contact)],
            'payment_address' => ['nullable','max:225'],
            'shipping_address' => ['nullable','max:225'],

            'receivable_account' => ['nullable'],
            'accounts_payable' => ['nullable'],

            'receivable_checked' => ['sometimes'],
            'credit_limit' => ['nullable','required_if:receivable_checked,1','numeric'],
            'payable_checked' => ['sometimes'],
            'payable_limit' => ['nullable','required_if:payable_checked,1','numeric'],
            'profile' => ['nullable','mimes:jpg,png,jpeg','max:1024'],
        ];
    }

    public function messages()
    {
        return [
            'nickname.required' => 'Nama harap diisi',
            'nickname.max' => 'Kolom tidak boleh lebih dari 50 karakter',
            
            'contact_type.required' => 'Tipe Kontak wajib dipilih',

            'emails.unique' => 'Email yang anda masukan sudah ada.',

            'contact_name.required' => 'Kolom nama kontak wajib diisi.',
            'handphone.max' => 'Kolom tidak boleh lebih dari 50 karakter',
            'contact_name.max' => 'Kolom tidak boleh lebih dari 100 karakter',
            'identity_number.max' => 'Kolom tidak boleh lebih dari 50 karakter',

            'emails.email' => 'Kolom email harus berupa alamat email yang valid.',
            'other_info.max' => 'Kolom tidak boleh lebih dari 225 karakter',
            'company_name.max' => 'Kolom tidak boleh lebih dari 150 karakter',
            
            'telephone.max' => 'Kolom tidak boleh lebih dari 50 karakter',
            'telephone.unique' => 'Telepon yang anda masukan sudah ada.',

            'fax.max' => 'Kolom tidak boleh lebih dari 50 karakter',
            'fax.unique' => 'Fax yang anda masukan sudah ada.',

            'npwp.max' => 'Kolom tidak boleh lebih dari 50 karakter',
            'npwp.unique' => 'NPWP yang anda masukan sudah ada.',

            'payment_address.max' => 'Kolom tidak boleh lebih dari 225 karakter',
            'shipping_address.max' => 'Kolom tidak boleh lebih dari 225 karakter',

            'credit_limit.required_if' => 'Maksimal Piutang harap diisi',
            'payable_limit.required_if' => 'Hutang Maksimal harap diisi',

            'credit_limit.numeric' => 'Harus berupa angka',
            'payable_limit.numeric' => 'Harus berupa angka',

            'profile.mimes' => 'Bidang gambar harus berupa file dengan tipe: jpg, png, jpeg.',
            'profile.max' => 'Bidang gambar tidak boleh lebih besar dari 1024 kilobyte.',
        ];
    }
}
