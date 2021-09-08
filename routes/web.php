<?php

use App\Http\Controllers\Api\ApiCategoriesController;
use App\Http\Controllers\Api\ApiProductsController;
use App\Http\Controllers\ArchivedProductsController;
use App\Http\Controllers\ArchivedVendorsController;
use App\Http\Controllers\ArchivedCustomersController;
use App\Http\Controllers\PriceController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CustomerPriceLevelController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\PlantFeaturesController;
use App\Http\Controllers\SizeController;
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

    /**This needs to be before the products resource as will return 403 if after. */
    Route::get('/products/archived', [ArchivedProductsController::class, 'index'])->name('archived-products.index');
    Route::get('/products/archived/{productId}', [ArchivedProductsController::class, 'show'])->name('archived-products.show');
    Route::post('/products/archived/{productId}', [ArchivedProductsController::class, 'store'])->name('archived-products.restore');

    Route::resource('products', App\Http\Controllers\ProductController::class)->except(['edit']);

    Route::resource('features', App\Http\Controllers\FeatureController::class);

    Route::resource('categories', App\Http\Controllers\CategoryController::class);

    Route::patch('plant-features/{plant}', [PlantFeaturesController::class, 'update'])->name('plant-features.update');

    Route::resource('sizes', App\Http\Controllers\SizeController::class)->only(['create', 'index', 'store', 'update', 'destroy']);
    Route::put('size-order', [SizeController::class, 'updateOrder'])->name('sizes.updateOrder');

    Route::resource('prices', PriceController::class)->only(['store', 'update', 'destroy']);

    Route::get('api/products', [ApiProductsController::class, 'index'])->name('api.products');
    Route::get('api/categories', [ApiCategoriesController::class, 'index'])->name('api.categories');

    Route::resource('orders', App\Http\Controllers\OrderController::class);

    Route::resource('orders.order-item', App\Http\Controllers\OrderItemController::class)->only(['store', 'update', 'delete'])->shallow();
});
