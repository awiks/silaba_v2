<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AccountCategoryRequest extends FormRequest
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
            'sub_header_id' => ['required'],
            'category_code' => ['required',Rule::unique('account_categories')->ignore($this->account_category)],
            'categories_name' => ['required',Rule::unique('account_categories')->ignore($this->account_category)],
            
        ];
    }

    public function messages()
    {
        return [
            'sub_header_id.required' => 'Sub Header harap dipilih',

            'category_code.required' => 'Kode Kategori harap diisi',
            'category_code.unique' => 'Kode Kategori yang anda masukan sudah ada atau sudah pernah dihapus.',

            'categories_name.required' => 'Kategori Akun harap diisi',
            'categories_name.unique' => 'Kategori Akun yang anda masukan sudah ada atau sudah pernah dihapus.',

            
        ];
    }
}
