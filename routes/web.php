<?php

use App\Http\Controllers\ArchivedVendorsController;
use App\Http\Controllers\ArchivedCustomersController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CustomerPriceLevelController;
use App\Http\Controllers\ContactController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});


Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    /**This needs to be before the customers resource as will return 403 if after. */
    Route::get('/customers/archived', [ArchivedCustomersController::class, 'index'])->name('archived-customers.index');
    Route::get('/customers/archived/{customerId}', [ArchivedCustomersController::class, 'show'])->name('archived-customers.show');
    Route::post('/customers/archived/{customerId}', [ArchivedCustomersController::class, 'store'])->name('archived-customers.restore');

    Route::resource('customer-price-levels', CustomerPriceLevelController::class);

    Route::resource('customers', CustomerController::class);

    Route::resource('contacts', ContactController::class)->only(['store', 'update', 'destroy']);

    /**This needs to be before the vendors resource as will return 403 if after. */
    Route::get('/vendors/archived', [ArchivedVendorsController::class, 'index'])->name('archived-vendors.index');
    Route::get('/vendors/archived/{vendorId}', [ArchivedVendorsController::class, 'show'])->name('archived-vendors.show');
    Route::post('/vendors/archived/{vendorId}', [ArchivedVendorsController::class, 'store'])->name('archived-vendors.restore');

    Route::resource('vendors', App\Http\Controllers\VendorController::class);

    Route::resource('products', App\Http\Controllers\ProductController::class);

    Route::resource('features', App\Http\Controllers\FeatureController::class);

    Route::resource('categories', App\Http\Controllers\CategoryController::class);

    Route::resource('plants', App\Http\Controllers\PlantController::class);
});
