<?php

use App\Http\Controllers\Api\ApiBlocksController;
use App\Http\Controllers\Api\ApiCategoriesController;
use App\Http\Controllers\Api\ApiContactsController;
use App\Http\Controllers\Api\ApiDiscountsController;
use App\Http\Controllers\Api\ApiInventoryArchiveController;
use App\Http\Controllers\Api\ApiInventoryQuantitiesController;
use App\Http\Controllers\Api\ApiOrderInventoryController;
use App\Http\Controllers\Api\ApiOrderQuoteController;
use App\Http\Controllers\Api\ApiProductPriceController;
use App\Http\Controllers\Api\ApiProductsController;
use App\Http\Controllers\Api\ApiProductSizesController;
use App\Http\Controllers\Api\ApiProductsOrdersController;
use App\Http\Controllers\Api\ApiQuoteOrdersController;
use App\Http\Controllers\Api\Quotes\ApiQuotesController;
use App\Http\Controllers\Api\ApiRelatedOrdersController;
use App\Http\Controllers\Api\ApiSalesController;
use App\Http\Controllers\Api\Orders\ApiOrdersController;
use App\Http\Controllers\ArchivedCustomersController;
use App\Http\Controllers\ArchivedProductsController;
use App\Http\Controllers\ArchivedVendorsController;
use App\Http\Controllers\BlockController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ClearLocationController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CustomerPriceLevelController;
use App\Http\Controllers\FeatureController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\NurseryLocationController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderItemController;
use App\Http\Controllers\OrderPDFController;
use App\Http\Controllers\PlaceController;
use App\Http\Controllers\PlantFeaturesController;
use App\Http\Controllers\PriceController;
use App\Http\Controllers\PrintInventoryTagsController;
use App\Http\Controllers\PrintPurchaseItemsTagsController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\PurchaseItemController;
use App\Http\Controllers\QuoteController;
use App\Http\Controllers\RemovePurchaseItemFromInventory;
use App\Http\Controllers\Reports\ReportsController;
use App\Http\Controllers\ReprintQueueController;
use App\Http\Controllers\Sales\ConvertSaleController;
use App\Http\Controllers\SizeController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\ViewInventoryController;
use Illuminate\Http\Request;
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
    return redirect()->route('login');
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
    Route::get('customers/{customer}/contacts', [ApiContactsController::class, 'index'])->name('customers.contacts.index');

    /**This needs to be before the vendors resource as will return 403 if after. */
    Route::get('/vendors/archived', [ArchivedVendorsController::class, 'index'])->name('archived-vendors.index');
    Route::get('/vendors/archived/{vendorId}', [ArchivedVendorsController::class, 'show'])->name('archived-vendors.show');
    Route::post('/vendors/archived/{vendorId}', [ArchivedVendorsController::class, 'store'])->name('archived-vendors.restore');

    Route::resource('vendors', VendorController::class);

    /**This needs to be before the products resource as will return 403 if after. */
    Route::get('/products/archived', [ArchivedProductsController::class, 'index'])->name('archived-products.index');
    Route::get('/products/archived/{productId}', [ArchivedProductsController::class, 'show'])->name('archived-products.show');
    Route::post('/products/archived/{productId}', [ArchivedProductsController::class, 'store'])->name('archived-products.restore');

    Route::resource('products', ProductController::class)->except(['edit']);
    Route::get('api/products/{product}/orders', [ApiProductsOrdersController::class, 'index'])->name('api.products.orders.index');
    Route::resource('features', FeatureController::class);
    Route::get('api/products/{product}', [ApiProductsController::class, 'show'])->name('api.products.show');
    // Route to get a list of product sizes
    Route::get('api/products/{product}/sizes', [ApiProductSizesController::class, 'index'])->name('api.products.sizes.index');

    Route::resource('categories', CategoryController::class);

    Route::patch('plant-features/{plant}', [PlantFeaturesController::class, 'update'])->name('plant-features.update');

    Route::resource('sizes', SizeController::class)->only(['create', 'index', 'store', 'update', 'destroy']);
    Route::put('size-order', [SizeController::class, 'updateOrder'])->name('sizes.updateOrder');

    Route::resource('prices', PriceController::class)->only(['store', 'update', 'destroy']);

    Route::get('api/products', [ApiProductsController::class, 'index'])->name('api.products');
    Route::get('api/categories', [ApiCategoriesController::class, 'index'])->name('api.categories');

    Route::resource('purchases.purchase-item', PurchaseItemController::class)->only(['store', 'update', 'destroy'])->shallow();

    Route::resource('purchases', PurchaseController::class);

    Route::get('print-items-tags', PrintPurchaseItemsTagsController::class)->name('print-items-tags');

    Route::get('inventory/clear-locations', [ClearLocationController::class, 'index'])->name('inventory.clear-locations');
    Route::post('inventory/clear-locations/{block}', [ClearLocationController::class, 'clear'])->name('clear-locations.clear');
    Route::resource('inventory', InventoryController::class);

    Route::delete('inventory-purchase-items', RemovePurchaseItemFromInventory::class)->name('delete-inventory-purchase-item');

    Route::get('view', [ViewInventoryController::class, 'index'])->name('view.index');
    Route::get('view/{product}', [ViewInventoryController::class, 'show'])->name('view.show');

    Route::resource('locations', NurseryLocationController::class);

    Route::resource('blocks', BlockController::class);

    Route::get('api/{nursery}/blocks', [ApiBlocksController::class, 'index'])->name('api.blocks.index');
    Route::get('api/{block}/places/', [PlaceController::class, 'index'])->name('api.places.index');
    Route::post('places', [PlaceController::class, 'store'])->name('places.store');
    Route::patch('places', [PlaceController::class, 'update'])->name('places.update');

    Route::resource('orders', OrderController::class);
    Route::resource('quotes', QuoteController::class);

    Route::resource('sales.order-items', OrderItemController::class)->only(['store', 'update', 'destroy']);

    Route::post('sales/{sale}/convert', [ConvertSaleController::class, 'convert'])->name('sales.convert');

    Route::get('sales/{sale}/print', OrderPDFController::class)->name('orders.print');
    Route::apiResource('sales.discounts', ApiDiscountsController::class);

    Route::apiResource('sales.inventory', ApiOrderInventoryController::class)->only(['index', 'show', 'store'])
        ->missing(function (Request $request) {
            return response()->json(['message' => "No Inventory Found for ID: {$request['inventory']}"], 200);
        });

    Route::apiResource('inventory-archive', ApiInventoryArchiveController::class);

    Route::name('api.')->prefix('api')->group(function () {
        Route::apiResource('sales', ApiSalesController::class)->only(['index', 'show']);

        Route::get('quotes/{quote}/orders', ApiQuoteOrdersController::class)->name('quotes.orders.index');
        Route::get('orders/{order}/quote', ApiOrderQuoteController::class)->name('orders.quote.show');
        Route::get('orders/{order}/related', ApiRelatedOrdersController::class)->name('orders.related.index');

        Route::get('orders', [ApiOrdersController::class, 'index'])->name('orders.index');
        Route::get('quotes', [ApiQuotesController::class, 'index'])->name('quotes.index');


        Route::get('products/{product}/size/{size}/quantities', ApiInventoryQuantitiesController::class)->name('inventory.quantities');
        Route::get('products/{product}/size/{size}/prices', ApiProductPriceController::class)->name('product.prices');
    });


    // Reprint Queue
    Route::resource('reprint-queue', ReprintQueueController::class)->only('index', 'store', 'update', 'destroy');
    Route::get('reprint-tags', PrintInventoryTagsController::class)->name('reprint-tags');

    Route::post('teams/{team}/connect', [TeamController::class, 'connect'])->name('teams.connect');
    Route::delete('teams/{team}/disconnect', [TeamController::class, 'disconnect'])->name('teams.disconnect');
    Route::post('teams/{team}/logo', [TeamController::class, 'updateLogo'])->name('teams.logo');

    Route::post('{contactableType}/{contactableId}/contacts', [ContactController::class, 'store'])->whereIn('contactableType', ['customers', 'vendors'])->name('contacts.store');
    Route::put('contacts/{contact}', [ContactController::class, 'update'])->whereIn('contactableType', ['customers', 'vendors'])->name('contacts.update');
    Route::delete('contacts/{contact}', [ContactController::class, 'destroy'])->whereIn('contactableType', ['customers', 'vendors'])->name('contacts.destroy');

    Route::get('reports', [ReportsController::class, 'index'])->name('reports.index');
});
