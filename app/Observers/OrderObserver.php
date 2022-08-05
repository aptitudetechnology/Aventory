<?php

namespace App\Observers;

use App\Models\Order;

class OrderObserver
{
    /**
     * Handle events after all transactions are committed.
     *
     * @var bool
     */
    public $afterCommit = true;

    /**
     * When creating an order, we add the discount to the order
     *
     * @param  Order  $order
     * @return void
     */
    public function created(Order $order)
    {
        $order->updateTotals();
        $order->createCustomerDiscount();
    }

    /**
     * When deleting an order, we remove the associated items.
     *
     *
     * @param  Order  $order
     * @return void
     */
    public function deleting(Order $order)
    {
        $order->items->each->delete();
    }
}
