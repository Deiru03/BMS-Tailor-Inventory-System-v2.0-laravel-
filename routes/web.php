<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ViewController;
use App\Http\Controllers\Customer\CustomerController;
use App\Http\Controllers\Supplier\SupplierController;
use App\Http\Controllers\Material\MaterialsController;
use App\Http\Controllers\Product\ProductController;
use App\Http\Controllers\Sale\SaleController as SaleController;
use App\Http\Controllers\Sale\InvoiceController;
use App\Http\Controllers\Sale\ReturnController;
use App\Http\Controllers\SettingController;
use App\Models\SupplierInfo;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Artisan;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Check The User if the sessions expire or not
Route::get('/session-expired', function () {
    return redirect()->route('login')->with('expired', 'Your session has expired. Please log in again.');
})->name('session.expired');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
// ------------------------- Automations Route ------------------------- //
Route::get('/clear-cache', function () {
    Artisan::call('config:clear');
    Artisan::call('cache:clear');
    Artisan::call('route:clear');
    Artisan::call('view:clear');

    return response()->json([
        'message' => 'Application cache cleared successfully!'
    ]);
})->name('clear.cache');


//------------------------- Settings Routes ------------------------- //
route::post('/settings/product-action-store', [SettingController::class, 'productTypeStore'])->name('product-type.store');
route::get('/settings/product-action-edit', [SettingController::class, 'productTypeEdit'])->name('product-type.edit');
route::put('/settings/product-action/update/{id}', [SettingController::class, 'productTypeUpdate'])->name('product-type.update');
route::delete('/settings/product-action/destroy/{id}', [SettingController::class, 'productTypeDestroy'])->name('product-type.destroy');
Route::match(['get', 'post'], '/settings/company-info', [SettingController::class, 'companyInfo'])->name('settings.company-info');
route::post('/settings/supplier-action-store', [SettingController::class, 'supplierTypeStore'])->name('supplier-type.store');
route::get('/settings/supplier-action-edit', [SettingController::class, 'supplierTypeEdit'])->name('supplier-type.edit');
route::put('/settings/supplier-action/update/{id}', [SettingController::class, 'supplierTypeUpdate'])->name('supplier-type.update');
route::delete('/settings/supplier-action/destroy/{id}', [SettingController::class, 'supplierTypeDestroy'])->name('supplier-type.destroy');

//------------------------- Sidebar Buttons and Routes ------------------------- //
Route::get('/dashboard', [ViewController::class, 'dashboard'])->name('dashboard');
Route::get('/customers', [ViewController::class, 'customer'])->name('ViewCustomer');
Route::get('/suppliers', [ViewController::class, 'supplier'])->name('ViewSupplier');
Route::get('/materials', [ViewController::class, 'material'])->name('ViewMaterial');
Route::get('/products', [ViewController::class, 'product'])->name('ViewProduct');
Route::get('/settings', [SettingController::class, 'index'])->name('ViewSettings');
Route::get('/sales', [ViewController::class, 'sale'])->name('ViewSale');
Route::get('/reports/sales', [ViewController::class, 'salesReport'])->name('ViewSalesReport');
Route::get('/reports/expenses', [ViewController::class, 'expensesReport'])->name('ViewExpensesReport');
Route::get('/reports/invoices', [ViewController::class, 'invoiceReport'])->name('ViewInvoiceReport');


// Customer Resource Controller
Route::resource('customer-action', CustomerController::class);

// Supplier Resource Controller
Route::resource('supplier-action', SupplierController::class);

// Material Resource Controller
Route::resource('material-action', MaterialsController::class);
Route::get('/supplier-types/{supplierId}', function ($supplierId) {
    $supplier = SupplierInfo::with('types')->find($supplierId);
    if ($supplier) {
        return response()->json($supplier->types);
    }
    return response()->json([]);
});

// Product Resource Controller
Route::resource('product-action', ProductController::class);

// Sale Resource Controller
Route::resource('sale-action', SaleController::class);
Route::resource('invoice-action', InvoiceController::class);
Route::post('/sales/{sale}/pay', [SaleController::class, 'payRemainingBalance'])->name('sales.pay');
// Route for showing an invoice by sale ID
Route::get('/invoice-actions/sale/{invoiceId}', [InvoiceController::class, 'showDetail'])->name('invoice-action.showDetail');


require __DIR__.'/auth.php';
