<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BrandRequest extends FormRequest
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
            'name_brand' => ['required','max:50',Rule::unique('brands')->ignore($this->brand)],
        ];
    }

    public function messages()
    {
        return [
            'name_brand.required' => 'Nama Merek harap diisi',
            'name_brand.max' => 'Nama Merek tidak boleh lebih dari 50 karakter',
            'name_brand.unique' => 'Nama Merek yang anda masukan sudah ada.',
        ];
    }
}
