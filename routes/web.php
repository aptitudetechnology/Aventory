<?php

use App\Http\Controllers\ArchivedCustomersController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CustomerPriceLevelController;
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

    Route::resource('customers', CustomerController::class);

    Route::resource('customer-price-levels', CustomerPriceLevelController::class);
});
