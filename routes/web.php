<?php

use App\Http\Controllers\AccountCategoryController;
use App\Http\Controllers\AccountHeaderController;
use App\Http\Controllers\AccountListController;
use App\Http\Controllers\AccountSubHeaderController;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ExpensesController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\TaxController;
use App\Http\Controllers\UnitController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::post('supplier/ajax', [SupplierController::class, 'ajax'])->name('supplier.ajax');
Route::post('employee/ajax', [EmployeeController::class, 'ajax'])->name('employee.ajax');

Route::prefix('item')->group(function () {
    Route::get('{item}/unit_conversion', [ItemController::class, 'unit_conversion'])->name('item.unit_conversion');
    Route::post('unit', [ItemController::class, 'unit'])->name('item.unit');
});

Route::prefix('customer')->group(function () {
    Route::post('ajax', [CustomerController::class, 'ajax'])->name('customer.ajax');
    Route::get('bicycle/{customer}/create', [CustomerController::class, 'add'])->name('customer.add');
    Route::get('bicycle/{bicycle}/edit', [CustomerController::class, 'ubah'])->name('customer.ubah');
    Route::put('bicycle/{bicycle}', [CustomerController::class, 'perbarui'])->name('customer.perbarui');
    Route::delete('bicycle/{bicycle}', [CustomerController::class, 'hapus'])->name('customer.hapus');
    Route::post('bicycle/{customer}', [CustomerController::class, 'save'])->name('customer.save');
});

Route::prefix('purchase')->group(function () {
    Route::get('/', [PurchaseController::class, 'index'])->name('purchase.index');
    Route::get('/purchase_order', [PurchaseController::class, 'purchase_order'])->name('purchase.purchase_order');
});

Route::prefix('setting')->group(function () {
    Route::get('/', [SettingController::class, 'index'])->name('setting.index');
    
    Route::get('unit/recycle_bin', [UnitController::class,'recycle_bin']);
    
    Route::post('unit/recycle_bin', [UnitController::class,'restore']);
    Route::resource('unit', UnitController::class);

    Route::get('brand/recycle_bin', [BrandController::class,'recycle_bin']);
    Route::post('brand/recycle_bin', [BrandController::class,'restore']);
    Route::resource('brand', BrandController::class);
    
    Route::get('category/recycle_bin', [CategoryController::class,'recycle_bin']);
    Route::post('category/recycle_bin', [CategoryController::class,'restore']);
    Route::resource('category', CategoryController::class);

    Route::get('tax/recycle_bin', [TaxController::class,'recycle_bin']);
    Route::post('tax/recycle_bin', [TaxController::class,'restore']);
    Route::resource('tax', TaxController::class);

    Route::get('account_header/recycle_bin', [AccountHeaderController::class,'recycle_bin']);
    Route::post('account_header/recycle_bin', [AccountHeaderController::class,'restore']);
    Route::resource('account_header', AccountHeaderController::class);
    
    Route::post('account_sub_header/lists_code', [AccountSubHeaderController::class,'lists_code'])->name('account_sub_header.lists_code');
    Route::get('account_sub_header/recycle_bin', [AccountSubHeaderController::class,'recycle_bin']);
    Route::post('account_sub_header/recycle_bin', [AccountSubHeaderController::class,'restore']);
    Route::resource('account_sub_header', AccountSubHeaderController::class);
    
    Route::post('account_category/lists_code', [AccountCategoryController::class,'lists_code'])->name('account_category.lists_code');
    Route::get('account_category/recycle_bin', [AccountCategoryController::class,'recycle_bin']);
    Route::post('account_category/recycle_bin', [AccountCategoryController::class,'restore']);
    Route::resource('account_category', AccountCategoryController::class);
    
    Route::post('account_list/lists_code', [AccountListController::class,'lists_code'])->name('account_list.lists_code');
    Route::get('account_list/recycle_bin', [AccountListController::class,'recycle_bin']);
    Route::post('account_list/recycle_bin', [AccountListController::class,'restore']);
    Route::resource('account_list', AccountListController::class);
    
});

Route::resource('setting/unit', UnitController::class);
Route::resource('setting/brand', BrandController::class);
Route::resource('setting/category', CategoryController::class);

Route::resource('item', ItemController::class);
Route::resource('supplier', SupplierController::class);
Route::resource('employee', EmployeeController::class);
Route::resource('customer', CustomerController::class);

Route::resource('contact', ContactController::class);
Route::resource('expenses', ExpensesController::class);

Route::prefix('api')->group(function () {
    
    Route::get('ajax_product', [AjaxController::class, 'ajax_product'])->name('api.ajax_product');
    Route::get('ajax_brand', [AjaxController::class, 'ajax_brand'])->name('api.ajax_brand');
    Route::get('ajax_category', [AjaxController::class, 'ajax_category'])->name('api.ajax_category');
    Route::get('ajax_unit', [AjaxController::class, 'ajax_unit'])->name('api.ajax_unit');
    Route::get('ajax_account', [AjaxController::class, 'ajax_account'])->name('api.ajax_account');
    Route::get('ajax_tax', [AjaxController::class, 'ajax_tax'])->name('api.ajax_tax');
    Route::get('ajax_contact', [AjaxController::class, 'ajax_contact'])->name('api.ajax_contact');
});