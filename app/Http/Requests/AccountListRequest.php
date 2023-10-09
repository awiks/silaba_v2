<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AccountListRequest extends FormRequest
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
            'category_id' => ['required'],
            'lists_code' => ['required',Rule::unique('account_lists')->ignore($this->account_list)],
            'lists_name' => ['required',Rule::unique('account_lists')->ignore($this->account_list)],
        ];
    }

    public function messages()
    {
        return [
            'category_id.required' => 'Kategori Akun harap dipilih',

            'lists_code.required' => 'Kode Akun harap diisi',
            'lists_code.unique' => 'Kode Akun yang anda masukan sudah ada atau sudah pernah dihapus.',
            
            'lists_name.required' => 'Nama Akun harap diisi',
            'lists_name.unique' => 'Nama Akun yang anda masukan sudah ada atau sudah pernah dihapus.',
        ];
    }
}
