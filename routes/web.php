<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ViewController;
use App\Http\Controllers\Customer\CustomerController;
use App\Http\Controllers\Supplier\SupplierController;
use App\Http\Controllers\Material\MaterialsController;

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

//------------------------- Sidebar Buttons and Routes ------------------------- //
Route::get('/customers', [ViewController::class, 'customer'])->name('ViewCustomer');
Route::get('/suppliers', [ViewController::class, 'supplier'])->name('ViewSupplier');
Route::get('/materials', [ViewController::class, 'material'])->name('ViewMaterial');

// Customer Resource Controller
Route::resource('customer-action', CustomerController::class);

// Supplier Resource Controller
Route::resource('supplier-action', SupplierController::class);

// Material Resource Controller
Route::resource('material-action', MaterialsController::class);


require __DIR__.'/auth.php';
