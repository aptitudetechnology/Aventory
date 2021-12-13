<?php

namespace App\Observers;

use App\Models\Order;

class OrderObserver
{
    // This ensures that the observer only applies after the model is saved in database.
    public $afterCommit = false;

    /**
     * When creating a new order, we create discounts for the order if the customer has a percentage discount.
     *
     * @param Order $order
     * @return void
     */
    public function created(Order $order)
    {
        if ($order->customer->discount_percentage) {
            $order->discounts()->create([
                'description' => "Discount of {$order->customer->discount_percentage}% will be applied to eligible products if paid within invoice terms.",
                'discount_percentage' => $order->customer->discount_percentage,
            ]);
        }
    }

    /**
     * When updating an order, we update the discount if the customer is changed.
     * We also need to remove the old discounts if the customer is changed.
     * 
     * @param Order $order
     * @return void
     */
    public function saved(Order $order)
    {
        if ($order->wasChanged('customer_id')) {
            $order->discounts()->whereNotNull('discount_percentage')->update([
                'description' => "Discount of {$order->customer->discount_percentage}% will be applied to eligible products if paid within invoice terms.",
                'discount_percentage' => $order->customer->discount_percentage,
            ]);
        }
    }
}
