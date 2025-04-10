<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ViewController;
use App\Http\Controllers\Customer\CustomerController;
use App\Http\Controllers\Supplier\SupplierController;
use App\Http\Controllers\Material\MaterialsController;
use App\Http\Controllers\Product\ProductController;
use App\Http\Controllers\SettingController;;

//Models 
use App\Models\SupplierInfo;
use Illuminate\Contracts\View\View;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
// ------------------------- Automations Route ------------------------- //


//------------------------- Settings Routes ------------------------- //
route::post('/settings/product-action-store', [SettingController::class, 'productTypeStore'])->name('product-type.store');
route::get('/settings/product-action-edit', [SettingController::class, 'productTypeEdit'])->name('product-type.edit');
route::put('/settings/product-action/update/{id}', [SettingController::class, 'productTypeUpdate'])->name('product-type.update');
route::delete('/settings/product-action/destroy/{id}', [SettingController::class, 'productTypeDestroy'])->name('product-type.destroy');

//------------------------- Sidebar Buttons and Routes ------------------------- //
Route::get('/customers', [ViewController::class, 'customer'])->name('ViewCustomer');
Route::get('/suppliers', [ViewController::class, 'supplier'])->name('ViewSupplier');
Route::get('/materials', [ViewController::class, 'material'])->name('ViewMaterial');
Route::get('/products', [ViewController::class, 'product'])->name('ViewProduct');
Route::get('/settings', [SettingController::class, 'index'])->name('ViewSettings');

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


require __DIR__.'/auth.php';
