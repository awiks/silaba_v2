<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ItemRequest extends FormRequest
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
            'code_sku' => ['required','sometimes','max:50',Rule::unique('items')->ignore($this->item)],
            'barcode' => ['nullable','sometimes','max:50',Rule::unique('items')->ignore($this->item)],
            //'brand_id' => ['required'],
            //'category_id' => ['required'],
            //'item_name' => ['required','max:225',Rule::unique('items')->ignore($this->item)],
            'description' => ['nullable'],
            'buy_checked' => ['sometimes'],
            'account_buy' => ['nullable','required_if:buy_checked,1'],
            'tax_buy_id' => ['nullable'],

            'sell_cheked' => ['sometimes'],
            'account_sell' => ['nullable','required_if:sell_cheked,1'],
            'tax_sell_id' => ['nullable'],

            'inventory_checked' => ['sometimes'],
            'minimum_stock' => ['nullable','required_if:inventory_checked,1','numeric'],
            'account_inventory' => ['nullable','required_if:inventory_checked,1'],
            'images' => ['array'],
            'images.*' => ['nullable','mimes:jpg,png,jpeg,svg,webp','max:3072'],

            //'unit_id' => ['required'],
            'buy_price' => ['nullable','required_if:buy_checked,1','numeric'],
            'sell_price' => ['nullable','required_if:sell_cheked,1','numeric'],
        ];
    }

    public function messages()
    {
        return [
            'brand_id.required' => 'Merek harap dipilih',
            'category_id.required' => 'Kategori harap dipilih',

            'code_sku.required' => 'Kode / SKU harap diisi',
            'code_sku.max' => 'Kode / SKU tidak boleh lebih dari 50 karakter',
            'code_sku.unique' => 'Kode / SKU yang anda masukan sudah ada.',

            'barcode.max' => 'Barcode tidak boleh lebih dari 50 karakter',
            'barcode.unique' => 'Barcode yang anda masukan sudah ada.',

            'item_name.required' => 'Nama Produk harap diisi',
            'item_name.max' => 'Nama Produk tidak boleh lebih dari 150 karakter',
            'item_name.unique' => 'Nama Produk yang anda masukan sudah ada.',

            'account_buy.required_if' => 'Akun Pembelian harap dipilih',

            'account_sell.required_if' => 'Akun Penjualan harap dipilih',

            'minimum_stock.required_if' => 'Batas Stok Minimum harap diisi.',
            'minimum_stock.numeric' => 'Bidang stok minimum harus berupa angka.',
            'account_inventory.required_if' => 'Akun Persediaan Barang harap dipilih',

            'images.*.mimes' => 'Bidang gambar harus berupa file dengan tipe: jpg, png, jpeg, svg.',
            'images.*.max' => 'Bidang gambar tidak boleh lebih besar dari 1024 kilobyte.',
        
            'unit_id.required' => 'Satuan harap dipilih',
            'buy_price.required_if' => 'Harga Beli Satuan harap diisi',
            'sell_price.required_if' => 'Harga Jual Satuan harap diisi',
            'buy_price.numeric' => 'Harga Beli harus berupa angka.',
            'sell_price.numeric' => 'Harga Jual harus berupa angka.',
        ];
    }
}
