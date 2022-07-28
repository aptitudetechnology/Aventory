<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Size;
use Illuminate\Http\Request;

class ApiProductPriceController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Product  $product
     * @param  Size  $size
     * @return \Illuminate\Http\Response
     * @return list of product prices for size.
     */
    public function __invoke(Request $request, Product $product, Size $size)
    {
        // Map the base prices to a new collection of prices for the size and customer price levels.
        // If there are no customer price levels, then the base prices are returned.
        $priceLevels = $request->user()->priceLevels;

        $basePriceForSize = $product->basePrices()
            ->find($size->id);

        $prices = $priceLevels->map(function ($level) use ($basePriceForSize) {
            return [
                'price_level_id' => $level->id,
                'price' => $basePriceForSize ? $basePriceForSize->getPriceForLevel($level) : 0,
            ];
        });

        $prices->prepend([
            'price_level_id' => null,
            'price' => $basePriceForSize ? $basePriceForSize->unit_price : 0,
        ]);

        return $prices;
    }
}
