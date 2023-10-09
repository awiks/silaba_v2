<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AccountSubHeaderRequest extends FormRequest
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
            'header_id' => ['required'],
            'sub_header_code' => ['required',Rule::unique('account_sub_headers')->ignore($this->account_sub_header)],
            'header_sub_name' => ['required',Rule::unique('account_sub_headers')->ignore($this->account_sub_header)],
        ];
    }

    public function messages()
    {
        return [
            'header_id.required' => 'Header harap dipilih',

            'sub_header_code.required' => 'Kode Sub Header harap diisi',
            'sub_header_code.unique' => 'Kode Sub Header yang anda masukan sudah ada atau sudah pernah dihapus.',

            'header_sub_name.required' => 'Nama Sub Header harap diisi',
            'header_sub_name.unique' => 'Nama Sub Header yang anda masukan sudah ada atau sudah pernah dihapus.',

        ];
    }
}
