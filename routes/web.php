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

Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
Route::get('/', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');

Route::prefix('item')->group(function () {
    Route::get('{item}/unit_conversion', [ItemController::class, 'unit_conversion'])->name('item.unit_conversion');
    Route::put('unit/{item}', [ItemController::class, 'unit'])->name('item.unit');
    Route::post('modal_cat', [ItemController::class, 'modal_cat'])->name('item.modal_cat');
    Route::post('create_cat', [ItemController::class, 'create_cat'])->name('item.create_cat');

    Route::post('modal_brand', [ItemController::class, 'modal_brand'])->name('item.modal_brand');
    Route::post('create_brand', [ItemController::class, 'create_brand'])->name('item.create_brand');

    Route::post('modal_unit', [ItemController::class, 'modal_unit'])->name('item.modal_unit');
    Route::post('create_unit', [ItemController::class, 'create_unit'])->name('item.create_unit');
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

Route::get('contact/recycle_bin', [ContactController::class,'recycle_bin']);
Route::post('contact/recycle_bin', [ContactController::class,'restore']);

Route::resource('setting/unit', UnitController::class);
Route::resource('setting/brand', BrandController::class);
Route::resource('setting/category', CategoryController::class);

Route::resource('item', ItemController::class);

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