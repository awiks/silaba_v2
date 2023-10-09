<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AccountHeaderRequest extends FormRequest
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
            'header_code' => ['required','numeric',Rule::unique('account_headers')->ignore($this->account_header)],
            'header_name' => ['required',Rule::unique('account_headers')->ignore($this->account_header)],
            'serving_header' => ['required'],
            'normal_balance' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'header_code.required' => 'Kode Header harap diisi',
            'header_code.numeric' => 'Kode Header harus berupa angka.',
            'header_code.unique' => 'Kode Header yang anda masukan sudah ada atau sudah pernah dihapus.',

            'header_name.required' => 'Nama Header harap diisi',
            'header_name.unique' => 'Nama Header yang anda masukan sudah ada atau sudah pernah dihapus.',

            'serving_header.required' => 'Jenis Penyajian harap dipilih',
            'normal_balance.required' => 'Normal Akun harap dipilih',
        ];
    }
}
